<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>ChroMata</title>
    @vite('resources/css/app.css')
</head>
<body class="w-screen h-auto">
    <section id="landing">
        <div class="bg-center bg-cover w-screen h-screen"
        style="background-image: url(https://images.unsplash.com/photo-1501621667575-af81f1f0bacc?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=870&q=80);">    
            <div class="w-12/12 h-auto bg-black bg-opacity-50">
                <div class="w-12/12 h-1/2 bg-gradient-to-t from-slate-900">
                    <div class="w-full h-screen flex justify-center items-center">
                        <div class="max-w-[1000px] m-2">
                            <div class="flex items-center">
                                <img src="{{ asset('ChroMata.png') }}" alt="ChroMata Logo" class="max-h-[60px] w-auto mr-4">
                                <h1 class="text-white font-bold text-3xl md:text-6xl">Chro</h1>
                                <h1 class="font-bold text-3xl md:text-6xl text-transparent bg-gradient-to-r from-blue-200 to-blue-700 bg-clip-text">Mata</h1>
                            </div>
                            <p class="text-white text-justify font-semibold text-base mt-6 mb-[60px] mr-3">Selamat datang di Desain Interaksi Modern: Website Color Shifting! Kami hadir untuk membantu pengguna buta warna merah-hijau memahami konten visual dengan lebih baik. Dengan teknologi color shifting, kami mengubah kombinasi warna pada gambar agar dapat dilihat dengan jelas. Gunakan fitur kami untuk melakukan color shifting pada gambar dari URL website, URL gambar, atau mengunggah gambar pribadi Anda. Bergabunglah dengan kami untuk menciptakan pengalaman visual yang inklusif bagi pengguna buta warna merah-hijau.</p>
        
                            <div class="flex justify-center">
                                <a href="{{ route('Try') }}" class="relative p-0.5 inline-flex items-center justify-center font-bold overflow-hidden group rounded-[25px]">
                                    <span class="w-full h-full bg-gradient-to-br from-blue-500 via-blue-600 to-blue-700 group-hover:from-blue-700 group-hover:via-blue-600 group-hover:to-blue-500 absolute"></span>
                                    <span class="relative px-6 py-3 transition-all ease-out bg-gray-900 rounded-[25px] group-hover:bg-opacity-0 duration-400">
                                    <span class="relative text-white">Try Now</span>
                                    </span>
                                </a>
                            </div>
                            
                        </div>
                    </div>
                </div>
                
            </div>
        </div>
    </section>
</body>
</html>