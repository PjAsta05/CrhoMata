<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Color Shifting</title>
    @vite('resources/css/app.css')
</head>
<body>
    <div id="modal" class="fixed inset-0 bg-black bg-opacity-80 w-screen h-screen flex items-center justify-center flex-col">
        <div class="bg-white rounded-lg overflow-hidden max-h-screen w-auto">
            <div class="overflow-hidden max-h-[85vh] w-auto">
                <div class="relative">
                    <a href="{{ route('Try') }}" class="absolute top-2 right-2 p-2 bg-white rounded-full shadow-lg z-10" aria-label="Close Modal">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-gray-500 hover:text-gray-700" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                        </svg>
                    </a>
                    <div class="flex items-center justify-center">
                        <img id="currentImage" src="{{ asset('storage/Python/Output/1'.$filename) }}" class="w-full object-fit w-auto max-h-[85vh]" onclick="openModal('{{ asset('storage/Python/Output/1'.$filename) }}')">
                    </div>
                </div>
            </div>
            <div class="max-h-[10vh] max-w-full">
                <div class="w-auto flex justify-center items-center">
                    <div>
                        <label for="imageRange">Hue Rotation : <span id="rotationValue">0.0</span></label>
                    </div>
                    <div class="p-4">
                        <input type="range" id="imageRange" min="1" max="10" value="1" onchange="changeImage(this.value)">
                    </div>
                    <div class="p-4">
                        <form action="/DownloadImage" method="POST" id="downloadForm">
                            @csrf
                            <input type="hidden" id="imagePathInput" name="imagePath">
                            <button type="submit" class="px-4 py-2 bg-blue-500 text-white rounded-lg hover:bg-blue-600" onclick="downloadImage()">Download</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
      
    <script>
    function changeImage(value) {
        const image = document.getElementById("currentImage");
        const imageName = value + "{{ isset($filename) ? $filename : '' }}";
        const imagePath = "{{ asset('storage/Python/Output/') }}/" + imageName;
        image.src = imagePath;
        image.onclick = function() {
            openModal(imagePath);
        };

        const rotationValue = document.getElementById("rotationValue");
        const hueRotation = (value - 1) / 10;
        rotationValue.textContent = hueRotation.toFixed(1);

        document.getElementById("imagePathInput").value = imageName;
    }

    function downloadImage() {
        var imagePath = document.getElementById("imagePathInput").value;
        document.getElementById("imagePathInput").value = imagePath;
        document.getElementById("downloadForm").submit();
    }
    </script>
</body>
</html>