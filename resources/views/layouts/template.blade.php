<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>ChroMata</title>
    @vite('resources/css/app.css')
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="w-screen h-screen">
    <header>
        <nav class="bg-white shadow-lg fixed top-0 left-0 w-full">
            <div class="max-w-6xl mx-auto px-4">
                <div class="flex justify-between">
                    <div class="flex space-x-7">
                        <div>
                            <a href="/" class="flex items-center py-4 px-2">
                                <img src="logo.png" alt="Logo" class="h-8 w-8 mr-2">
                                <span class="font-semibold text-gray-500 text-lg">ChroMata</span>
                            </a>
                        </div>

                        <div class="hidden md:flex items-center space-x-1">
                            <a href="/" class="py-4 px-2 text-gray-500 font-semibold hover:text-blue-500 transition duration-300">Home</a>
                            <a href="" class="py-4 px-2 text-gray-500 font-semibold hover:text-blue-500 transition duration-300">Services</a>
                            <a href="" class="py-4 px-2 text-gray-500 font-semibold hover:text-blue-500 transition duration-300">About</a>
                            
                        </div>
                    </div>
    
                    <div class="md:hidden flex items-center">
                        <button class="outline-none mobile-menu-button">
                        <svg class=" w-6 h-6 text-gray-500 hover:text-blue-500 "
                            x-show="!showMenu"
                            fill="none"
                            stroke-linecap="round"
                            stroke-linejoin="round"
                            stroke-width="2"
                            viewBox="0 0 24 24"
                            stroke="currentColor">
                            <path d="M4 6h16M4 12h16M4 18h16"></path>
                        </svg>
                    </button>
                    </div>
                </div>
            </div>

            <div class="hidden mobile-menu">
                <ul class="">
                    <li><a href="/" class="block text-sm px-2 py-4 hover:bg-blue-500 transition duration-300">Home</a></li>
                    <li><a href="#services" class="block text-sm px-2 py-4 hover:bg-blue-500 transition duration-300">Services</a></li>
                    <li><a href="#about" class="block text-sm px-2 py-4 hover:bg-blue-500 transition duration-300">About</a></li>
                </ul>
            </div>
    </header>
    <main>
        {{ $slot }}
    </main>
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
    
    <script>
    const btn = document.querySelector(".mobile-menu-button");
    const menu = document.querySelector(".mobile-menu");
    const mediaQuery = window.matchMedia("(min-width: 1024px)");

    const hideMobileMenu = () => {
        menu.classList.add("hidden");
    };

    const handleResize = (event) => {
        if (event.matches) {
            hideMobileMenu();
        }
    };

    mediaQuery.addEventListener("change", handleResize);

    btn.addEventListener("click", () => {
        menu.classList.toggle("hidden");
    });

    if (mediaQuery.matches) {
        hideMobileMenu();
    }
    </script>
</body>
</html>