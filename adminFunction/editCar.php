<?php

require_once("../db.php");
require_once("../pages/car.php");

if (isset($_GET['id'])) {
    $carId = $_GET['id'];
    $db = new Database();
    $car = new Car($db);
    $carDetails = $car->getCarById($carId);
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        $brandName = $_POST['brandName'];
        $model = $_POST['model'];
        $priceDay = $_POST['priceDay'];
        $year = $_POST['year'];

 
        if ($car->updateCar($carId, $brandName, $model, $priceDay, $year)) {
            header("Location: ../pages/cars.php");
            exit;
        } else {
            echo "Error updating car: " . $connection->error;
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Car</title>
</head>

<body>
    <?php include '../pages/cars.php'; ?>

    <!-- Modal Edit Car Form -->
    <div id="editCarModal" class="fixed inset-0 z-50 flex items-center justify-center bg-black bg-opacity-50">
        <div class="bg-white rounded-lg shadow-lg w-full max-w-2xl p-6">
            <div class="flex justify-between items-center mb-4">
                <h3 class="text-xl font-semibold text-orange-600">Edit Car Details</h3>
                <button class="text-gray-500 hover:text-gray-700 closeEditCar"><i class="ri-close-circle-line text-2xl text-orange-600"></i></button>
            </div>

            <form action="editCar.php?id=<?php echo $carId; ?>" method="post">
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mt-6">
                    <div>
                        <label for="brandName" class="mb-2 block text-sm font-medium text-gray-700">Brand Name</label>
                        <input type="text" id="brandName" name="brandName" class="mt-1 block w-full border border-gray-300 rounded-md p-2 focus:ring-orange-500 focus:border-orange-500" value="<?php echo $carDetails['brand']; ?>" required />
                    </div>
                    <div>
                        <label for="model" class="mb-2 block text-sm font-medium text-gray-700">Model</label>
                        <input type="text" id="model" name="model" class="mt-1 block w-full border border-gray-300 rounded-md p-2 focus:ring-orange-500 focus:border-orange-500" value="<?php echo $carDetails['model']; ?>" required />
                    </div>
                    <div>
                        <label for="priceDay" class="mb-2 block text-sm font-medium text-gray-700">Price/Day</label>
                        <input type="text" id="priceDay" name="priceDay" class="mt-1 block w-full border border-gray-300 rounded-md p-2 focus:ring-orange-500 focus:border-orange-500" value="<?php echo $carDetails['price_per_day']; ?>" required />
                    </div>
                    <div>
                        <label for="year" class="mb-2 block text-sm font-medium text-gray-700">Year</label>
                        <input type="text" id="year" name="year" class="mt-1 block w-full border border-gray-300 rounded-md p-2 focus:ring-orange-500 focus:border-orange-500" value="<?php echo $carDetails['year']; ?>" required />
                    </div>
                </div>

                <div class="mt-6 flex justify-end space-x-2">
                    <button type="button" class="px-4 py-2 bg-gray-200 text-gray-700 rounded-md hover:bg-gray-300 closeEditCar">Cancel</button>
                    <button type="submit" class="px-8 py-2 bg-orange-500 text-white rounded-md hover:bg-orange-600">Save</button>
                </div>
            </form>
        </div>
    </div>

    <script>
        // Close modal when clicking on cancel or close button
        const closeEditCar = document.querySelectorAll('.closeEditCar');
        closeEditCar.forEach(button => {
            button.addEventListener('click', () => {
                window.location.href = '../pages/cars.php';
            });
        });
    </script>
</body>

</html>
