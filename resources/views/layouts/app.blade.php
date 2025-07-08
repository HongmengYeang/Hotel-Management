<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Document</title>

    <!-- Your custom CSS -->
    <link rel="stylesheet" href="{{ asset('css/style.css') }}" />

    <!-- Tailwind CSS CDN -->
    <script src="https://cdn.tailwindcss.com"></script>

    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css"
        integrity="sha512-Evv84Mr4kqVGRNSgIGL/F/aIDqQb7xQ2vcrdIwxfjThSH8CSR7PBEakCr51Ck+w+/U6swU2Im1vVX0SVk9ABhg=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />

    <link href="https://cdn.jsdelivr.net/npm/tom-select@2.2.2/dist/css/tom-select.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/tom-select@2.2.2/dist/js/tom-select.complete.min.js"></script>
    <script src="https://unpkg.com/heroicons@2.0.16/dist/heroicons.min.js"></script>


</head>



<body>
    @if (session('error'))
        <div class="fixed top-4 left-1/2 transform -translate-x-1/2 z-50 w-full max-w-md" id="error-alert"
            role="alert">
            <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative shadow">
                <strong class="font-bold">Error:</strong>
                <span class="block sm:inline">{{ session('error') }}</span>
                <span id="error-countdown" class="block sm:inline ml-2 text-sm text-red-600"></span>

                <button type="button" onclick="this.parentElement.parentElement.remove()"
                    class="absolute top-0 bottom-0 right-0 px-4 py-3 text-red-700">
                    <svg class="fill-current h-6 w-6" viewBox="0 0 20 20">
                        <path
                            d="M14.348 5.652a1 1 0 00-1.414 0L10 8.586 7.066 5.652a1 1 0 00-1.414 1.414L8.586 10l-2.934 2.934a1 1 0 001.414 1.414L10 11.414l2.934 2.934a1 1 0 001.414-1.414L11.414 10l2.934-2.934a1 1 0 000-1.414z" />
                    </svg>
                </button>
            </div>
        </div>

        <script>
            let errorSeconds = 3;
            const errorCountdown = document.getElementById('error-countdown');
            const errorAlert = document.getElementById('error-alert');

            const errorInterval = setInterval(() => {
                errorCountdown.textContent = `Closing in ${errorSeconds}...`;
                errorSeconds--;

                if (errorSeconds < 0) {
                    clearInterval(errorInterval);
                    if (errorAlert) errorAlert.remove();
                }
            }, 1000);
        </script>
    @endif

    @if (session('success'))
        <div class="fixed top-4 left-1/2 transform -translate-x-1/2 z-50 w-full max-w-md" id="success-alert"
            role="alert">
            <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative shadow">
                <strong class="font-bold">Success:</strong>
                <span class="block sm:inline">{{ session('success') }}</span>
                <span id="countdown" class="block sm:inline ml-2 text-sm text-green-600"></span>

                <button type="button" onclick="this.parentElement.parentElement.remove()"
                    class="absolute top-0 bottom-0 right-0 px-4 py-3 text-green-700">
                    <svg class="fill-current h-6 w-6" viewBox="0 0 20 20">
                        <title>Close</title>
                        <path
                            d="M14.348 5.652a1 1 0 00-1.414 0L10 8.586 7.066 5.652a1 1 0 10-1.414 1.414L8.586 10l-2.934 2.934a1 1 0 101.414 1.414L10 11.414l2.934 2.934a1 1 0 001.414-1.414L11.414 10l2.934-2.934a1 1 0 000-1.414z" />
                    </svg>
                </button>
            </div>
        </div>

        <script>
            let seconds = 3;
            const countdownSpan = document.getElementById('countdown');
            const alertBox = document.getElementById('success-alert');

            const interval = setInterval(() => {
                countdownSpan.textContent = `Closing in ${seconds}...`;
                seconds--;

                if (seconds < 0) {
                    clearInterval(interval);
                    alertBox.remove();
                }
            }, 1000);
        </script>
    @endif





    <div class="main">
        <div class="side-bar" id="side-bar">
            <div class="top-menu ">
                <i class="fa-solid fa-angle-left mt-3" id="close-menu"></i>
            </div>
            <p style="text-align: center" class="text-4xl font-bold mb-6">HOTEL ROOM BOOKING SYSTEM</p>
            <x-menu></x-menu>
        </div>
        <div class="body">
            <div class="header">
                <button id="menu" class="menu">
                    <i class="fa-solid fa-bars-staggered"></i>
                </button>
                <div class="clock">
                    <i class="fa-regular fa-clock"></i>
                    <div id="clock">--:--:--</div>
                </div>
            </div>
            <div class="main-body">
                @yield('body')
            </div>
        </div>
    </div>
</body>

</html>

<script src="{{ asset('js/script.js') }}"></script>
