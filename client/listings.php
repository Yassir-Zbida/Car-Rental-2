<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="icon" type="image/x-icon" href="../assets/favicon.svg">
    <link href="https://cdn.jsdelivr.net/npm/remixicon@3.2.0/fonts/remixicon.css" rel="stylesheet" />
    <link href="https://fonts.googleapis.com/css2?family=Epilogue:ital,wght@0,100..900;1,100..900&display=swap"
        rel="stylesheet">
    <title>Listings - Gorent</title>
</head>
<style>
    div#scrollable {
        border: 5px red solid;
        width: 150px;
        height: 200px;
        overflow-y: scroll;
    }

    ::-webkit-scrollbar {
        width: 10px;
    }

    ::-webkit-scrollbar-track {
        background: white;
    }

    ::-webkit-scrollbar-thumb {
        background: lightgray;
        border-radius: 10px;
    }

    div:hover::-webkit-scrollbar-thumb {
        background: #737373;
    }

    ::-webkit-scrollbar-thumb:hover {
        background: #f65519;
    }
</style>

<body class="bg-gray-50 mx-12">


    <section class="relative mt-3 flex  rounded-2xl text-white mb-6">
        <div class="container flex flex-col justify-between">
            <header class=" top-0 z-50">
                <div class="container flex items-center justify-between py-4">

                    <div class="flex items-center space-x-2 text-gray-800 font-semibold">
                        <a href="../index.php">
                            <img src="../assets/gorent-logo.svg" width="160px">
                        </a>
                    </div>

                    <div>
                        <ul class="text-black flex flex-row gap-6 text-[18px] font-semibold font-epilogue">
                            <li class="text-orange-600"><a href="">Home</a></li>
                            <li class="hover:text-orange-600"><a href="">Bookings</a></li>
                            <li class="hover:text-orange-600"><a href="">About</a></li>
                            <li class="hover:text-orange-600"><a href="">Contact</a></li>
                        </ul>
                    </div>

                    <div class="hidden md:flex items-center space-x-4">
                        <button
                            class="px-6 py-2 bg-orange-600 text-white text-lg rounded-full hover:bg-[#737373] hover:text-white">
                            <a href="../logout.php">Logout</a>
                        </button>
                    </div>

                </div>
            </header>

        </div>
    </section>


    <!-- cars grid -->
    <section>

        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6 py-6">

            <div class="bg-white shadow-lg rounded-lg overflow-hidden border">
                <img src="car1.jpg" alt="Voyager Hybrid" class="w-full h-40 object-contain p-4">
                <div class="p-4">
                    <span class="bg-gray-200 text-gray-700 text-sm font-medium px-2 py-1 rounded">Electric Car</span>
                    <h2 class="text-lg font-semibold mt-2">Voyager Hybrid</h2>
                    <div class="mt-4 text-sm text-gray-600">
                        <div class="flex items-center gap-2">
                            <i class="ri-door-line text-gray-500 text-lg"></i>
                            <span>Doors</span>
                            <span class="ml-auto">4</span>
                        </div>
                        <div class="flex items-center gap-2 mt-2">
                            <i class="ri-user-line text-gray-500 text-lg"></i>
                            <span>Passengers</span>
                            <span class="ml-auto">2</span>
                        </div>
                    </div>
                </div>
                <div class="p-4 border-t">
                    <div class="flex items-center justify-between">
                        <div>
                            <span class="text-xl font-bold">$248</span>
                            <span class="text-sm text-gray-500">/Per Day</span>
                        </div>
                        <button class="bg-red-500 text-white p-2 rounded-full">
                            <i class="ri-arrow-right-line"></i>
                        </button>
                    </div>
                </div>
            </div>


            <div class="bg-white shadow-lg rounded-lg overflow-hidden border">
                <img src="car2.jpg" alt="Sapphire Convertible" class="w-full h-40 object-contain p-4">
                <div class="p-4">
                    <span class="bg-gray-200 text-gray-700 text-sm font-medium px-2 py-1 rounded">Coupe Car</span>
                    <h2 class="text-lg font-semibold mt-2">Sapphire Convertible</h2>
                    <div class="mt-4 text-sm text-gray-600">
                        <div class="flex items-center gap-2">
                            <i class="ri-door-line text-gray-500 text-lg"></i>
                            <span>Doors</span>
                            <span class="ml-auto">4</span>
                        </div>
                        <div class="flex items-center gap-2 mt-2">
                            <i class="ri-user-line text-gray-500 text-lg"></i>
                            <span>Passengers</span>
                            <span class="ml-auto">2</span>
                        </div>
                    </div>
                </div>
                <div class="p-4 border-t">
                    <div class="flex items-center justify-between">
                        <div>
                            <span class="text-xl font-bold">$219</span>
                            <span class="text-sm text-gray-500">/Per Day</span>
                        </div>
                        <button class="bg-red-500 text-white p-2 rounded-full">
                            <i class="ri-arrow-right-line"></i>
                        </button>
                    </div>
                </div>
            </div>

            <!-- Card 3 -->
            <div class="bg-white shadow-lg rounded-lg overflow-hidden border">
                <img src="car3.jpg" alt="Harrier Wagon" class="w-full h-40 object-contain p-4">
                <div class="p-4">
                    <span class="bg-gray-200 text-gray-700 text-sm font-medium px-2 py-1 rounded">Coupe Car</span>
                    <h2 class="text-lg font-semibold mt-2">Harrier Wagon</h2>
                    <div class="mt-4 text-sm text-gray-600">
                        <div class="flex items-center gap-2">
                            <i class="ri-door-line text-gray-500 text-lg"></i>
                            <span>Doors</span>
                            <span class="ml-auto">4</span>
                        </div>
                        <div class="flex items-center gap-2 mt-2">
                            <i class="ri-user-line text-gray-500 text-lg"></i>
                            <span>Passengers</span>
                            <span class="ml-auto">2</span>
                        </div>
                    </div>
                </div>
                <div class="p-4 border-t">
                    <div class="flex items-center justify-between">
                        <div>
                            <span class="text-xl font-bold">$169</span>
                            <span class="text-sm text-gray-500">/Per Day</span>
                        </div>
                        <button class="bg-red-500 text-white p-2 rounded-full">
                            <i class="ri-arrow-right-line"></i>
                        </button>
                    </div>
                </div>
            </div>
        </div>


    </section>


</body>

</html>