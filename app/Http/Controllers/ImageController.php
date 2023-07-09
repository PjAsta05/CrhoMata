<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\Facades\Image;
use Intervention\Image\ImageManager;
use GuzzleHttp\Client;
use Symfony\Component\DomCrawler\Crawler;
use Symfony\Component\Process\Process;
use Symfony\Component\Process\Exception\ProcessFailedException;

class ImageController extends Controller
{
    //
    public function landing(){
        return view('project/landing');
    }

    public function input(){
        return view('project/Index');
    }

    public function scrape(Request $request)
    {
        $websiteUrl = $request->input('website_url');
        $images = $this->scrapeImages($websiteUrl);

        return view('project/ImageScrape', compact('images'));
    }

    private function scrapeImages($url)
    {
        // Ambil base url
        $parsedUrl = parse_url($url);
        $baseUrl = $parsedUrl['scheme'] . '://' . $parsedUrl['host'];

        // Ambil body dari html url
        $client = new Client();
        $response = $client->get($url);
        $html = $response->getBody()->getContents();

        // Filter img pada body html
        $crawler = new Crawler($html);
        $imageElements = $crawler->filter('img');

        // Ambil src pada setiap img, tambahkan base url jika tidak isi base url pada src
        $images = [];
        $imageElements->each(function (Crawler $node) use (&$images, $baseUrl) {
            $imageUrl = $node->attr('src');
            if ($imageUrl && strpos($imageUrl, 'http://') !== 0 && strpos($imageUrl, 'https://') !== 0) {
                $fullUrl = rtrim($baseUrl, '/') . '/' . ltrim($imageUrl, '/');
                $images[] = $fullUrl;
            } else {
                $images[] = $imageUrl;
            }
        });

        return $images;
    }

    public function storeByUrl(Request $request){
        $imageUrl = $request->input('image');
        $imageData = file_get_contents($imageUrl);

        $image = Image::make($imageData);
        $filename = uniqid().'.png';
        $image->save(storage_path('app/public/Python/Input/'.$filename));

        $this->process($filename);
        
        return view('project/ColorShifting', compact('filename'));
    }

    public function storeByFile(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'image_file' => 'required|image',
        ]);
        
        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator);
        }
        
        $image = $request->file('image_file');
        $imagePath = 'public/Python/Input/';
        $filenameWithoutExtension = pathinfo($image->getClientOriginalName(), PATHINFO_FILENAME);

        $ext = 'png';
        // Check if the image is not in PNG format
        if ($image->getClientOriginalExtension() !== 'png') {
            // Convert the image to PNG format
            $pngImage = \Image::make($image->getRealPath())->stream($ext);
            // Save the PNG image
            Storage::put($imagePath.$filenameWithoutExtension.'.'.$ext,$pngImage);
        }else{
            Storage::putFileAs($imagePath, $image, $filenameWithoutExtension . '.' . $ext);
        }

        $filename = $filenameWithoutExtension.'.'.$ext;
        $this->process($filename);
        
        return view('project/ColorShifting', compact('filename'));
    }

    public function process($filename){
        $pythonScriptPath = base_path('storage/app/public/Python/Image_processing.py');
        $process = new Process(['python', $pythonScriptPath, $filename], env: [
            'SYSTEMROOT' => getenv('SYSTEMROOT'),
            'PATH' => getenv('PATH')
        ]);
        // Mulai proses
        $process->setTimeout(360);
        $process->start();
        $process->wait();
        // Cek Error
        if (!$process->isSuccessful()) {
            throw new ProcessFailedException($process);
        }
    }

    public function download(Request $request)
    {
        $filePath = public_path('storage/Python/Output');
        $imagePath = $request->input('imagePath');
        $imageFile = $filePath . '/' . $imagePath;
        return Response::download($imageFile);
    }
}
