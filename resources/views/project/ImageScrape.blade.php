<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Image Scrape</title>
    @vite('resources/css/app.css')
</head>
<body class="container mx-auto h-screen w-screen">
    <h3 class="p-4 text-xl text-semibold">Image Scraped</h3>
    <div class="w-full max-w-5xl p-5 pb-10 mx-auto mb-10 columns-3 space-y-5">
        @foreach ($images as $image)
            <img src="{{ $image }}" alt="Scraped Image" class="" onclick="openModal('{{ $image }}')">
        @endforeach
    </div>
    
    <div id="modal" class="fixed inset-0 bg-black bg-opacity-80 w-screen h-screen flex items-center justify-center hidden flex-col">
        <div class="bg-white rounded-lg overflow-hidden max-h-screen w-auto">
            <div class="overflow-hidden max-h-[85vh] w-auto">
                <div class="relative">
                    <button type="button" class="absolute top-2 right-2 p-2 bg-white rounded-full shadow-lg z-10" onclick="closeModal()" aria-label="Close Modal">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-gray-500 hover:text-gray-700" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                        </svg>
                    </button>
                    <div class="flex items-center justify-center">
                        <img id="modal-image" src="" alt="Modal Image" class="object-fit w-auto max-h-[85vh] filter hue-rotate">
                    </div>
                </div>
            </div>
            <div class="max-h-[10vh] max-w-full">
                <div class="w-auto flex justify-center items-center">
                    <div class="p-4">
                        <form action="{{ route('images.storeByUrl') }}" method="post" enctype="multipart/form-data" id="imageForm">
                            @csrf
                            <input type="hidden" name="image" id="modal-image-input">
                            <button type="submit" class="px-4 py-2 bg-blue-500 text-white rounded-lg hover:bg-blue-600">Generate</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
        function openModal(imageUrl) {
            const modal = document.getElementById("modal");
            const modalImage = document.getElementById("modal-image");
    
            modalImage.src = imageUrl;
    
            modal.classList.remove("hidden");
            document.body.classList.add("modal-active");
        }
    
        function closeModal() {
            const modal = document.getElementById("modal");
        
            modal.classList.add("hidden");
            document.body.classList.remove("modal-active");
        }

        $(document).ready(function() {
        $('#imageForm').submit(function() {
            var imageUrl = $('#modal-image').attr('src');
                $('#modal-image-input').val(imageUrl);
            });
        });

      </script>
</body>
</html>