<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Input Method</title>
    @vite('resources/css/app.css')
</head>
<script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
    <body>
        <div class="flex flex-col items-center justify-center min-h-screen">
            <h1 class="text-3xl font-bold mb-4">Input Method</h1>
            <div x-data="select" class="relative w-[20rem]" @click.outside="open = false">
                <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
                <button @click="toggle" :class="(open) && 'ring-blue-600'" class="flex w-full items-center justify-between rounded-[25px] bg-white p-2 ring-1 border-blue-300">
                    <span x-text="(language == '') ? 'Choose method' : language" class="px-4"></span>
                    <i class="fas fa-chevron-down text-xl px-2"></i>
                </button>
        
                <ul class="z-2 absolute mt-1 w-full rounded bg-gray-50 ring-1 ring-gray-300" x-show="open">
                    <li class="cursor-pointer select-none p-2 hover:bg-blue-200" @click="setLanguage('Web URL')">Web URL</li>
                    <li class="cursor-pointer select-none p-2 hover:bg-blue-200" @click="setLanguage('Image URL')">Image URL</li>
                    <li class="cursor-pointer select-none p-2 hover:bg-blue-200" @click="setLanguage('Image File')">Image File</li>
                </ul>
            </div>

            <div x-show="language === 'Web URL'" id="webUrlForm" class="container mx-auto mt-8 hidden">
                <h1 class="text-2xl font-bold mb-4">Web URL :</h1>
                <form method="POST" action="{{ route('ImageScrape') }}">
                    @csrf
                    <div class="mb-4">
                        <input type="text" required id="website_url" name="website_url" placeholder="Enter website URL" class="border border-blue-400 px-4 py-2 rounded-[25px] w-full">
                    </div>
                    <div class="w-full flex justify-center items-center my-4">
                        <button type="submit" class="bg-blue-500 hover:bg-blue-600 text-white px-4 py-2 rounded-[25px] w-[10rem]">Get Images</button>                        
                    </div>
                </form>
            </div>
    
            <div x-show="language === 'Image URL'" id="imageUrlForm" class="container mx-auto mt-8 hidden">
                <h1 class="text-2xl font-bold mb-4">Images URL :</h1>
                <form method="POST" action="{{ route('images.storeByUrl') }}" enctype="multipart/form-data">
                    @csrf
                    <div class="mb-4">
                        <input type="text" required id="image" name="image" placeholder="Enter image URL" class="border border-blue-400 px-4 py-2 rounded-[25px] w-full">
                    </div>
                    <div class="w-full flex justify-center items-center my-4">
                        <button type="submit" class="bg-blue-500 hover:bg-blue-600 text-white px-4 py-2 rounded-[25px] w-[10rem]">Generate</button>
                    </div>
                </form>
            </div>
    
            <div x-show="language === 'Image File'" id="imageFileForm" class="container mx-auto mt-8 hidden"> 
                <h1 class="text-2xl font-bold mb-4">Upload Image</h1>
                <form action="{{ route('images.storeByFile') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="flex items-center justify-center w-full">
                        <label for="image_file" class="flex flex-col items-center justify-center w-full h-64 border-2 border-blue-400 border-dashed rounded-lg cursor-pointer bg-gray-50 dark:hover:bg-bray-800 dark:bg-gray-700 hover:bg-gray-100 dark:border-gray-600 dark:hover:border-gray-500 dark:hover:bg-gray-600">
                            <div class="flex flex-col items-center justify-center pt-5 pb-6">
                                <svg aria-hidden="true" class="w-10 h-10 mb-3 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 16a4 4 0 01-.88-7.903A5 5 0 1115.9 6L16 6a5 5 0 011 9.9M15 13l-3-3m0 0l-3 3m3-3v12"></path></svg>
                                <p class="mb-2 text-sm text-gray-500 dark:text-gray-400"><span class="font-semibold">Click to upload</span> or drag and drop</p>
                                <p class="text-xs text-gray-500 dark:text-gray-400">Image file</p>
                            </div>
                            <input id="image_file" required type="file" name="image_file" class="hidden" />
                        </label>
                    </div>
                    <div class="w-full flex justify-center items-center my-4">
                        <button type="submit" class="bg-blue-500 hover:bg-blue-600 text-white px-4 py-2 rounded-[25px] w-[10rem]">Upload</button>
                    </div>
                </form>
            </div>
        </div>
        
        <div class="fixed top-0 flex hidden justify-center items-center bg-blue-500 text-white text-sm font-bold px-4 py-3 w-screen" role="alert">
            <svg class="fill-current w-4 h-4 mr-2" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"><path d="M12.432 0c1.34 0 2.01.912 2.01 1.957 0 1.305-1.164 2.512-2.679 2.512-1.269 0-2.009-.75-1.974-1.99C9.789 1.436 10.67 0 12.432 0zM8.309 20c-1.058 0-1.833-.652-1.093-3.524l1.214-5.092c.211-.814.246-1.141 0-1.141-.317 0-1.689.562-2.502 1.117l-.528-.88c2.572-2.186 5.531-3.467 6.801-3.467 1.057 0 1.233 1.273.705 3.23l-1.391 5.352c-.246.945-.141 1.271.106 1.271.317 0 1.357-.392 2.379-1.207l.6.814C12.098 19.02 9.365 20 8.309 20z"/></svg>
            <p>Semakin besar ukuran file gambar, semakin lama proses color shifting.</p>
        </div>
        <script>
            document.addEventListener("alpine:init", () => {
                Alpine.data("select", () => ({
                    open: false,
                    language: "",

                    toggle() {
                        this.open = !this.open;
                    },

                    setLanguage(val) {
                        this.language = val;
                        this.open = false;

                        document.getElementById('webUrlForm').classList.add('hidden');
                        document.getElementById('imageUrlForm').classList.add('hidden');
                        document.getElementById('imageFileForm').classList.add('hidden');
                        if (this.language === 'Web URL'){
                            document.getElementById('webUrlForm').classList.remove('hidden');
                        }else if (this.language === 'Image URL'){
                            document.getElementById('imageUrlForm').classList.remove('hidden');
                        }else if (this.language === 'Image File'){
                            document.getElementById('imageFileForm').classList.remove('hidden');
                        }
                    },
                }));
            });
        </script>
    </body>
    <footer class="footer footer-center  w-full p-4 bg-white text-gray-800">
        <div class="text-center">
          <p>
            Copyright © 2023 -
            <a class="font-semibold" href="mailto:pujaastawa45@gmail.com"
              >Puja Astawa</a
            >
          </p>
        </div>
    </footer>
</html>



