<?php
// Database Connection
$host = 'localhost';
$dbname = 'gorent';
$username = 'root';
$password = 'safaa';

$conn = new mysqli($host, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}


?>

<!-- Html Page Struct -->
<html>

<head>

    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Go Rent - Car Rental</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://cdn.jsdelivr.net/npm/remixicon/fonts/remixicon.css" rel="stylesheet">
    <link rel="icon" type="image/x-icon" href="../assets/gorent.svg">
    <script src="../scripts/contrats.js" defer></script>

</head>

<body class="bg-gray-50 text-gray-700">

    <!-- Pdf file Header -->
    <div class="flex justify-between p-6 mx-2 mt-8 pdfHeader hidden">
        <img src="../assets/gorent-logo.svg">
        <div>
            <h2>Agent : Yassir ZBIDA</h2>
            <h2>Tel : +212 772508881</h2>
        </div>
    </div>

    <!-- main container -->
    <div class="flex flex-col lg:flex-row min-h-screen ">
        <!-- Sidebar -->
        <aside class="w-full lg:w-64 bg-white border-r" id="sidebar">
            <div class="p-6 border-b flex flex-row justify-between items-center">
                <img src="../assets/gorent-logo.svg">
            </div>
            <nav class="p-6">
                <ul class="space-y-6">
                    <li class="text-orange-600">
                        <a href="../index.php" class="flex items-center space-x-4 text-gray-600 hover:text-orange-600">
                            <i class="ri-dashboard-line"></i>
                            <span>Dashboard</span>
                        </a>
                    </li>
                    <li>
                        <a href="./clients.php" class="flex items-center space-x-4 text-gray-600 hover:text-orange-600">
                            <i class="ri-group-line"></i>
                            <span>Clients</span>
                        </a>
                    </li>
                    <li>
                        <a href="./cars.php" class="flex items-center space-x-4 text-gray-600 hover:text-orange-600">
                            <i class="ri-car-line "></i>
                            <span>Cars</span>
                        </a>
                    </li>
                    <li>
                        <a href="./contrats.php"
                            class="flex items-center space-x-4 text-orange-600 hover:text-orange-600">
                            <i class="ri-save-line"></i>
                            <span class="text-orange-600">Contrats</span>
                        </a>
                    </li>
                </ul>
                <hr class="my-6">
                <ul class="space-y-6">
                    <li>
                        <a href="#" class="flex items-center space-x-4 text-gray-600 hover:text-orange-600">
                            <i class="ri-exchange-dollar-line"></i>
                            <span>Transactions</span>
                        </a>
                    </li>
                    <li>
                        <a href="#" class="flex items-center space-x-4 text-gray-600 hover:text-orange-600">
                            <i class="ri-bar-chart-box-line"></i>
                            <span>Statistiques</span>
                        </a>
                    </li>
                </ul>
            </nav>
        </aside>

        <section class="flex-1 p-4 md:p-6 space-y-6">
            <!-- Header -->
            <header
                class="header flex flex-col md:flex-row items-start md:items-center justify-between space-y-4 md:space-y-0">
                <i class="ri-sidebar-fold-line text-2xl mt-2 text-orange-600 hover:text-gray-700 transition"
                    id="sidebarIcon"></i>
                <h2 class="text-2xl font-bold">Contrats</h2>
                <div class="flex items-center space-x-4">
                    <button class="text-gray-500 hover:text-gray-700">
                        <i class="ri-notification-line text-xl"></i>
                    </button>
                    <img src="../assets/profile.png" alt="User" class="w-10 h-10 rounded-full">
                </div>
            </header>

            <!-- Header Options section-->
            <div class="headerOptions bg-white flex items-center justify-between w-full  p-4 shadow rounded-md mb-4">
                <div class="w-full flex items-center justify-between space-x-4">
                    <!-- Search -->
                    <div class="relative">
                        <input type="text" placeholder="Search for contrat..."
                            class="w-64 pl-10 pr-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring focus:ring-orange-200 text-sm text-gray-600" />
                        <i class="ri-search-line absolute left-3 top-2 text-gray-400"></i>
                    </div>
                    <!-- Add Contract -->
                    <div class="flex gap-4">
                        <button
                            class="transition duration-200flex items-center bg-orange-600 hover:bg-transparent hover:text-orange-600 text-white px-4 py-2 rounded-lg shadow text-sm font-medium"
                            id="addContratBtn">
                            <i class="ri-sticky-note-add-line text-lg mr-2"></i> Add Contrat
                        </button>
                        <button id="printPdf"
                            class="transition duration-200flex items-center bg-orange-600 hover:bg-transparent hover:text-orange-600 text-white px-4 py-2 rounded-lg shadow text-sm font-medium"
                            id="addContratBtn">
                            <i class="ri-printer-line text-lg mr-2"></i> Print Pdf
                        </button>
                    </div>

                </div>
            </div>

            <div class="grid grid-cols-1 lg:grid-cols-1 gap-6">
                <!-- cars table -->
                <div class=" bg-white p-6 rounded-lg shadow">
                    <h4 class="text-lg font-bold mb-4">Go Rent Contrats</h4>
                    <div class="overflow-x-auto bg-white shadow rounded-lg">
                        <table class="border w-full border-collapse text-sm text-gray-600">

                            <thead>
                                <tr class="bg-gray-100 text-left">
                                    <th class="py-2 px-4 border-b">ID</th>
                                    <th class="py-2 px-4 border-b">Client ID</th>
                                    <th class="py-2 px-4 border-b">Car ID</th>
                                    <th class="py-2 px-4 border-b">Start Date</th>
                                    <th class="py-2 px-4 border-b">End Date</th>
                                    <th class="py-2 px-4 border-b">Total</th>
                                    <th class="py-2 px-4 border-b">Status</th>
                                    <th class="py-2 px-4 border-b text-center thActions">Actions</th>
                                </tr>
                            </thead>

                            <tbody>
                                <?php
                                $servername = "localhost";
                                $username = "root";
                                $password = "safaa";
                                $dbname = "gorent";

                                $conn = new mysqli($servername, $username, $password, $dbname);

                                if ($conn->connect_error) {
                                    die("Connection failed: " . $conn->connect_error);
                                }

                                $sql = "
    SELECT 
        contracts.ID,
        CONCAT(clients.`First_Name`, ' ', clients.`Last_Name`) AS ClientName,
        CONCAT(cars.Brand, ' ', cars.Model) AS Car_Name,  
        contracts.Start_Date,
        contracts.End_Date,
        contracts.Total,
        contracts.Client_ID,
        contracts.Car_ID
    FROM contracts
    JOIN clients ON contracts.Client_ID = clients.ID
    JOIN cars ON contracts.Car_ID = cars.ID;
";

                                $result = $conn->query($sql);
                                if (!$result) {
                                    die("Invalid query: " . $conn->error);
                                }

                                // Output the table rows
                                while ($row = $result->fetch_assoc()) {
                                    echo '
    <tr class="hover:bg-gray-50">
        <td class="py-3 px-4 border-b">' . htmlspecialchars($row["ID"]) . '</td>
        <td class="py-3 px-4 border-b">' . htmlspecialchars($row["ClientName"]) . '</td> 
        <td class="py-3 px-4 border-b">' . htmlspecialchars($row["Car_Name"]) . '</td> 
        <td class="py-3 px-4 border-b">' . htmlspecialchars($row["Start_Date"]) . '</td>
        <td class="py-3 px-4 border-b">' . htmlspecialchars($row["End_Date"]) . '</td>
        <td class="py-3 px-4 border-b">' . htmlspecialchars($row["Total"]) . '</td>
        <td class="py-3 px-4 border-b">
            <span class="bg-green-100 text-green-600 py-1 px-3 rounded-full">Active</span>
        </td>
        <td class="py-3 px-4 border-b text-center space-x-2">
            <button 
                class="text-blue-500 hover:text-blue-600 editContractBtn" 
                onclick="openEditModal(
                    ' . htmlspecialchars($row["ID"]) . ', 
                    \'' . htmlspecialchars($row["Start_Date"]) . '\', 
                    \'' . htmlspecialchars($row["End_Date"]) . '\', 
                    ' . htmlspecialchars($row["Total"]) . ', 
                    ' . htmlspecialchars($row["Client_ID"]) . ', 
                    ' . htmlspecialchars($row["Car_ID"]) . '
                )">
                <i class="ri-eye-line text-lg"></i>
            </button>
            <a href="../phpFunction/deleteContract.php?id=' . htmlspecialchars($row["ID"]) . '" class="btnDelete">
                <i class="ri-delete-bin-line text-lg text-red-500 hover:text-red-700"></i>
            </a>
        </td>
    </tr>';
                                }


                                ?>

                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </section>
    </div>

    <!-- Add New contrat modal  -->

    <div id="addContratModal" class="fixed inset-0 z-50 flex items-center justify-center bg-black bg-opacity-50 hidden">
        <div class="bg-white rounded-lg shadow-lg w-full max-w-2xl p-6">

            <div class="flex justify-between items-center mb-4">
                <h3 class="text-xl  font-semibold text-orange-600">Add New Contrat</h3>
                <button class="text-gray-500 hover:text-gray-700 closeAddContrat"><i
                        class="ri-close-circle-line text-2xl text-orange-600"></i></button>
            </div>

            <form action="../phpFunction/addContract.php" method="post">
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <div>
                        <label for="clientId" class="mb-2 block text-sm font-medium text-gray-700">Client ID</label>
                        <select
                            class="mt-1 block w-full border border-gray-300 rounded-md p-2 focus:ring-orange-500 focus:border-orange-500"
                            name="clientId">
                            <option value="" disabled selected>Select a Client</option>
                            <?php
                            $clients = $conn->query("SELECT id, CONCAT(First_Name, ' ',Last_Name) AS Full_Name FROM clients");
                            while ($client = $clients->fetch_assoc()) {
                                echo "<option value='{$client['id']}'>{$client['Full_Name']}</option>";
                            }
                            ?>
                        </select>
                    </div>

                    <div>
                        <label for="carId" class="mb-2 block text-sm font-medium text-gray-700">Car ID</label>
                        <select id="car" name="carId"
                            class="mt-1 block w-full border border-gray-300 rounded-md p-2 focus:ring-orange-500 focus:border-orange-500"
                            required>
                            <option value="" disabled selected>Select a car </option>
                            <?php
                            $cars = $conn->query("SELECT ID, CONCAT(Brand, ' ', Model) AS cars FROM cars ");
                            while ($car = $cars->fetch_assoc()) {
                                echo "<option value='{$car['ID']}'>{$car['cars']}</option>";
                            }
                            ?>
                        </select>
                    </div>

                    <div>
                        <label for="start-date" class="mb-2 block text-sm font-medium text-gray-700">Start Date</label>
                        <input placeholder="Enter rent start date" type="date" id="startDate" name="startDate"
                            class="mt-1 block w-full border border-gray-300 rounded-md p-2 focus:ring-orange-500 focus:border-orange-500"
                            required />
                    </div>

                    <div>
                        <label for="end-date" class="mb-2 block text-sm font-medium text-gray-700">End Date</label>
                        <input placeholder="Enter rent end date" type="date" id="endDate" name="endDate"
                            class="mt-1 block w-full border border-gray-300 rounded-md p-2 focus:ring-orange-500 focus:border-orange-500"
                            required />
                    </div>

                    <div class="col-span-2">
                        <label for="total" class="mb-2 block text-sm font-medium text-gray-700">Total</label>
                        <input placeholder="Enter total price" type="number" id="total" name="total"
                            class="mt-1 block w-full border border-gray-300 rounded-md p-2 focus:ring-orange-500 focus:border-orange-500"
                            required />
                    </div>
                </div>

                <div class="mt-6 flex justify-end space-x-2">
                    <button type="button"
                        class="px-4 py-2 bg-gray-200 text-gray-700 rounded-md hover:bg-gray-300 closeAddContrat">Cancel</button>
                    <button type="submit" name="submit"
                        class="px-8 py-2 bg-orange-500 text-white rounded-md hover:bg-orange-600">Save</button>
                </div>
            </form>
        </div>
    </div>

    <!-- Edit Contract Modal  -->

    <div id="editContratModal"
        class="fixed inset-0 z-50 flex items-center justify-center bg-black bg-opacity-50 hidden">
        <div class="bg-white rounded-lg shadow-lg w-full max-w-2xl p-6">

            <div class="flex justify-between items-center mb-4">
                <h3 class="text-xl  font-semibold text-orange-600">Edit Contract</h3>
                <button class="text-gray-500 hover:text-gray-700 closeEditContrat"><i
                        class="ri-close-circle-line text-2xl text-orange-600"></i></button>
            </div>

            <form action="../phpFunction/editContract.php" method="post">
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <div>
                        <label for="clientId" class="mb-2 block text-sm font-medium text-gray-700">Client ID</label>
                        <select
                            class="mt-1 block w-full border border-gray-300 rounded-md p-2 focus:ring-orange-500 focus:border-orange-500"
                            name="clientIdEdit" id="clientIdEdit">
                            <option value="" disabled selected>Select a Client</option>
                            <?php
                            $clients = $conn->query("SELECT id, CONCAT(First_Name, ' ',Last_Name) AS Full_Name FROM clients");
                            while ($client = $clients->fetch_assoc()) {
                                echo "<option value='{$client['id']}'>{$client['Full_Name']}</option>";
                            }
                            ?>
                        </select>
                    </div>

                    <div>
                        <label for="carId" class="mb-2 block text-sm font-medium text-gray-700">Car ID</label>
                        <select name="carIdEdit" id="carIdEdit"
                            class="mt-1 block w-full border border-gray-300 rounded-md p-2 focus:ring-orange-500 focus:border-orange-500"
                            required>
                            <option>Select a car </option>
                            <?php
                            $cars = $conn->query("SELECT ID, CONCAT(Brand, ' ', Model) AS cars FROM cars ");
                            while ($car = $cars->fetch_assoc()) {
                                echo "<option value='{$car['ID']}'>{$car['cars']}</option>";
                            }
                            ?>
                        </select>
                    </div>
                    <input type="hidden" id="ContractEdit" name="ContractEdit">
                    <div>
                        <label for="start-date" class="mb-2 block text-sm font-medium text-gray-700">Start Date</label>
                        <input placeholder="Enter rent start date" type="date" id="startDateEdit" name="startDateEdit"
                            class="mt-1 block w-full border border-gray-300 rounded-md p-2 focus:ring-orange-500 focus:border-orange-500"
                            required />
                    </div>

                    <div>
                        <label for="end-date" class="mb-2 block text-sm font-medium text-gray-700">End Date</label>
                        <input placeholder="Enter rent end date" type="date" name="endDateEdit" id="endDateEdit"
                            class="mt-1 block w-full border border-gray-300 rounded-md p-2 focus:ring-orange-500 focus:border-orange-500"
                            required />
                    </div>

                    <div class="col-span-2">
                        <label for="total" class="mb-2 block text-sm font-medium text-gray-700">Total</label>
                        <input placeholder="Enter total price" type="number" id="totalEdit" name="totalEdit"
                            class="mt-1 block w-full border border-gray-300 rounded-md p-2 focus:ring-orange-500 focus:border-orange-500"
                            required />
                    </div>
                </div>

                <div class="mt-6 flex justify-end space-x-2">
                    <button type="button"
                        class="px-4 py-2 bg-gray-200 text-gray-700 rounded-md hover:bg-gray-300 closeEditContrat">Cancel</button>
                    <button type="submit" name="submit"
                        class="px-8 py-2 bg-orange-500 text-white rounded-md hover:bg-orange-600">Save</button>
                </div>
            </form>
        </div>
    </div>


    <style>
        @media print {

            #sidebar {
                display: none;
            }

            #editClientBtn,
            .btn-delete {
                visibility: hidden;
            }

            .header,
            .thActions,
            .editContractBtn,
            .btnDelete,
            .header,
            .headerOptions {
                display: none;
            }

            .pdfHeader {
                display: flex;
                flex-direction: row;
            }

            @page {
                size: landscape;
            }


        }
    </style>

</body>

</html>