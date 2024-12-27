<?php
require_once '../db.php';
require_once '../pages/car.php';

$database = new Database();
$carManager = new Car($database);

$cars = $carManager->getAllCars();

?>


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
                            <li class="text-orange-600"><a href="./Listings.php">Listings</a></li>
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


        <!-- Cars Grid -->
        <section class="container mx-auto px-4">
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6 py-6">
            <?php if (!empty($cars)): ?>
                <?php foreach ($cars as $car): ?>
                    <div class="bg-white shadow-lg rounded-lg overflow-hidden border">
                        <img src="<?= htmlspecialchars($car['car_img']) ?>" alt="<?= htmlspecialchars($car['brand'] . ' ' . $car['model']) ?>" class="w-full h-60 object-contain p-4">
                        <div class="p-4">
                            <span class="bg-gray-200 text-gray-700 text-sm font-medium px-2 py-1 rounded"><?= htmlspecialchars($car['year']) ?></span>
                            <h2 class="text-lg font-semibold mt-2"><?= htmlspecialchars($car['brand'] . ' ' . $car['model']) ?></h2>
                            <div class="mt-4 text-sm text-gray-600">
                                <div class="flex items-center gap-2">
                                    <i class="ri-door-line text-gray-500 text-lg"></i>
                                    <span>Doors</span>
                                    <span class="ml-auto"><?= htmlspecialchars($car['doors']) ?></span>
                                </div>
                                <div class="flex items-center gap-2 mt-2">
                                    <i class="ri-user-line text-gray-500 text-lg"></i>
                                    <span>Passengers</span>
                                    <span class="ml-auto"><?= htmlspecialchars($car['passengers']) ?></span>
                                </div>
                            </div>
                        </div>
                        <div class="p-4 border-t">
                            <div class="flex items-center justify-between">
                                <div>
                                    <span class="text-xl font-bold">$<?= htmlspecialchars($car['price_per_day']) ?></span>
                                    <span class="text-sm text-gray-500">/Per Day</span>
                                </div>
                                
                                <form action="bookcar.php" method="POST">
                                    <input type="hidden" name="car_id" value="<?= htmlspecialchars($car['id']) ?>">
                                    <button type="submit" class="bg-orange-500 px-3 hover:bg-black hover:text-white text-white p-2 rounded-full">
                                        Book Now
                                        <i class="ri-arrow-right-line"></i>
                                    </button> 
                                </form>

                            </div>
                        </div>
                    </div>
                <?php endforeach; ?>
            <?php else: ?>
                <p class="text-center col-span-full">No cars available.</p>
            <?php endif; ?>
        </div>
    </section>


    <!-- footer -->
    <footer class="bg-black text-white py-10 rounded-2xl mt-6 mb-6">
        <div class="max-w-7xl mx-6 px-6 grid grid-cols-1 md:grid-cols-4 gap-8">
            <div>
                <a href="../index.php">
                    <img src="../assets/gorent-logo.svg" width="160px">
                </a>
                <p class="mt-4 text-white">
                    Experience the ease and convenience of renting a car with Go rent.
                </p>
            </div>

            <div class="md:ml-36">
                <h2 class="text-lg font-semibold">Legal Policy</h2>
                <ul class="mt-4 space-y-2">
                    <li><a href="#" class="hover:text-orange-500">Term & Condition</a></li>
                    <li><a href="#" class="hover:text-orange-500">Privacy Policy</a></li>
                    <li><a href="#" class="hover:text-orange-500">Legal Notice</a></li>
                    <li><a href="#" class="hover:text-orange-500">Accessibility</a></li>
                </ul>
            </div>

            <div class="md:ml-24">
                <h2 class="text-lg font-semibold">Quick Links</h2>
                <ul class="mt-4 space-y-2">
                    <li><a href="#" class="hover:text-orange-500">Home</a></li>
                    <li><a href="#" class="hover:text-orange-500">About Us</a></li>
                    <li><a href="#" class="hover:text-orange-500">Car Type</a></li>
                    <li><a href="#" class="hover:text-orange-500">Service</a></li>
                </ul>
            </div>


            <div>
                <h2 class="text-lg font-semibold">Subscribe To The Newsletters</h2>
                <form class="mt-4 flex">
                    <input type="email" placeholder="Email..."
                        class="flex-1 px-4 py-2 rounded-l-lg bg-gray-800 text-white focus:outline-none" />
                    <button type="submit" class="bg-orange-500 px-4 py-2 rounded-r-lg hover:bg-orange-600">
                        <i class="ri-send-plane-fill text-white text-xl"></i>
                    </button>
                </form>
            </div>
        </div>


        <div class="border-t border-gray-700 mt-10 pt-6 text-center flex flex-row justify-between items-center mx-12">
            <p class="text-sm text-white">&copy; 2024 Gorent. All rights reserved.</p>
            <div class="flex justify-center space-x-4 mt-4">
                <a href="#" class="hover:text-orange-500">
                    <i class="ri-youtube-fill text-2xl"></i>
                </a>
                <a href="#" class="hover:text-orange-500">
                    <i class="ri-facebook-fill text-2xl"></i>
                </a>
                <a href="#" class="hover:text-orange-500">
                    <i class="ri-twitter-fill text-2xl"></i>
                </a>
                <a href="#" class="hover:text-orange-500">
                    <i class="ri-instagram-fill text-2xl"></i>
                </a>
                <a href="#" class="hover:text-orange-500">
                    <i class="ri-linkedin-fill text-2xl"></i>
                </a>
            </div>
        </div>
    </footer>




</body>

</html>