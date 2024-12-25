<?php
$connection = new mysqli("localhost", "root", "yassir", "gorent");
if ($connection->connect_error) {
    die("Connection failed: " . $connection->connect_error);
}
if (isset($_GET['id'])) {
    $clientId = $_GET['id'];

    $query = "SELECT * FROM cars WHERE ID = $clientId";
    $result = $connection->query($query);


    if ($result->num_rows > 0) {
        $client = $result->fetch_assoc();
    } else {
        echo "Client ID is missing.";
        exit;
    }
} else {
    echo "Client ID is missing.";
    exit;
}


if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $brandName = $_POST['brandName'];
    $model = $_POST['model'];
    $priceDay = $_POST['priceDay'];
    $year = $_POST['year'];



    $updateSql = "update cars set Brand='$brandName', Model='$model'  , Year='$year' ,`Price/Day`='$priceDay' where ID = $clientId";

    if ($connection->query($updateSql) === TRUE) {
        echo "Client updated successfully!";
        header("Location: ../pages/clients.php");
        exit;
    } else {
        echo "Error updating client: " . $connection->error;
    }



}


?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<body>


    <?php include '../pages/cars.php' ?>

    <!-- Edit client Modal  -->

    <div id="addCarModal" class=" fixed inset-0 z-50 flex items-center justify-center bg-black bg-opacity-50 ">
        <div class="bg-white rounded-lg shadow-lg w-full max-w-2xl p-6">

            <div class="flex justify-between items-center mb-4">
                <h3 class="text-xl  font-semibold text-orange-600">Add New Car</h3>
                <button class="text-gray-500 hover:text-gray-700 closeAddCar"><i
                        class="ri-close-circle-line text-2xl text-orange-600"></i></button>
            </div>

            <form action="../phpFunction/editCar.php?id=<?php echo $clientId ?>" method="post">
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mt-6">



                    <div class="col">
                        <label for="Brand Name" class="mb-2 block text-sm font-medium text-gray-700">Brand Name</label>
                        <input placeholder="Enter car brand name" type="text" id="brandName" name="brandName"
                            class="mt-1 block w-full border border-gray-300 rounded-md p-2 focus:ring-orange-500 focus:border-orange-500"
                            value="<?php echo $client['Brand'] ?>" required />
                    </div>

                    <div>
                        <label for="Model" class="mb-2 block text-sm font-medium text-gray-700">Model</label>
                        <input placeholder="Enter model name" type="text" id="model" name="model"
                            class="mt-1 block w-full border border-gray-300 rounded-md p-2 focus:ring-orange-500 focus:border-orange-500"
                            value="<?php echo $client['Model'] ?>" required />
                    </div>

                    <div>
                        <label for="Price/Day" class="mb-2 block text-sm font-medium text-gray-700">Price/Day</label>
                        <input placeholder="Enter price amount per 1 day" type="text" id="priceDay	" name="priceDay"
                            class="mt-1 block w-full border border-gray-300 rounded-md p-2 focus:ring-orange-500 focus:border-orange-500"
                            value="<?php echo $client['Price/Day'] ?>" required />
                    </div>

                    <div>
                        <label for="year" class="mb-2 block text-sm font-medium text-gray-700">Year</label>
                        <input placeholder="Enter modal year" type="text" id="year" name="year"
                            class="mt-1 block w-full border border-gray-300 rounded-md p-2 focus:ring-orange-500 focus:border-orange-500"
                            value="<?php echo $client['Year'] ?>" required />
                    </div>
                </div>


                <div class="mt-6 flex justify-end space-x-2">
                    <button type="button"
                        class="px-4 py-2 bg-gray-200 text-gray-700 rounded-md hover:bg-gray-300 closeAddCar">Cancel</button>
                    <button type="submit" name="submit"
                        class="px-8 py-2 bg-orange-500 text-white rounded-md hover:bg-orange-600">Save</button>
                </div>
            </form>
        </div>
    </div>

    <script>
        // close and update  
        const closeEditClient = document.querySelectorAll('.closeEditClient');
        const editClientModal = document.getElementById('editClientModal');

        closeEditClient.forEach(button => {
            button.addEventListener('click', () => {
                window.location.href = '../pages/cars.php';
            });
        }); 
    </script>
</body>

</html>