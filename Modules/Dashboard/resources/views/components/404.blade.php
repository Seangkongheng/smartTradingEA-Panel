<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>404 Not Found</title>
    <!-- Tailwind CSS CDN -->
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <!-- Animate.css for animations -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css" rel="stylesheet">
    <style>
        /* Custom styles */
        body {
            background: linear-gradient(135deg, #f1f5f9, #e5e7eb);
        }
        .error-image {
            max-width: 100%;
            height: auto;
            filter: drop-shadow(0 4px 8px rgba(0, 0, 0, 0.1));
            transition: transform 0.3s ease;
        }
        .error-image:hover {
            transform: scale(1.03);
        }
        .text-shadow {
            text-shadow: 0 1px 3px rgba(0, 0, 0, 0.1);
        }
        .btn-custom {
            background-color: #00c4b4;
            transition: all 0.3s ease;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
        }
        .btn-custom:hover {
            background-color: #00b3a4;
            transform: translateY(-2px);
            box-shadow: 0 6px 16px rgba(0, 0, 0, 0.15);
        }
        .overlay-text {
            background: rgba(255, 255, 255, 0.8);
            backdrop-filter: blur(5px);
            border-radius: 10px;
        }
    </style>
</head>
<body>
    <div class="flex items-center justify-center min-h-screen bg-gray-50">
        <div class="text-center relative">
            <!-- 403 Image (illustration with characters, door, and "403") -->
            <img src="{{ asset('images/404.png') }}" alt="403 Forbidden" class="mx-auto w-full max-w-lg md:max-w-2xl mb-4 error-image animate__animated animate__fadeIn">
            <div class="overlay-text p-6 mx-4 md:mx-0">
                <h1 class="text-3xl md:text-4xl font-bold text-teal-900 animate__animated animate__fadeInUp text-shadow">We are Sorry...</h1>
                <p class="mt-2 text-sm md:text-base text-gray-600 animate__animated animate__fadeInUp">
                    The resource requested could not be found on this server!
                </p>
                <a href=""  class="mt-4 inline-block px-8 py-3 bg-green-500 text-white text-base font-semibold rounded-full btn-custom animate__animated animate__fadeInUp">
                    Go Back
                </a>

            </div>
        </div>
    </div>

    <script>
        // Optional: Add interactivity to the image
        document.querySelector('.error-image').addEventListener('click', function() {
            this.classList.add('animate__tada');
            setTimeout(() => {
                this.classList.remove('animate__tada');
            }, 1000);
        });
    </script>
</body>
</html>
