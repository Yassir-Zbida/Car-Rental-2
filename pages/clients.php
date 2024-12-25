<!-- Html Page Struct -->
<html>

<head>

    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Go Rent - Car Rental</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://cdn.jsdelivr.net/npm/remixicon/fonts/remixicon.css" rel="stylesheet">
    <link rel="icon" type="image/x-icon" href="../assets/gorent.svg">
    <script src="../scripts/clients.js" defer></script>

</head>

<body class="bg-gray-50 text-gray-700">

     <!-- Pdf file Header -->
     <div class="flex justify-between p-6 mx-2 mt-8 pdfHeader hidden">
         <img src="../assets/gorent-logo.svg">
         <div>
            <h2>Agent : Yassir ZBIDA</h2>
            <h2>Tel   : +212 772508881</h2>
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
                            <span">Dashboard</span>
                        </a>
                    </li>
                    <li>
                        <a href="./clients.php"
                            class="flex items-center space-x-4 text-orange-600 hover:text-orange-600">
                            <i class="ri-group-line"></i>
                            <span class="text-orange-600">Clients</span>
                        </a>
                    </li>
                    <li>
                        <a href="./cars.php" class="flex items-center space-x-4 text-gray-600 hover:text-orange-600">
                            <i class="ri-car-line"></i>
                            <span>Cars</span>
                        </a>
                    </li>
                    <li>
                        <a href="./contrats.php" class="flex items-center space-x-4 text-gray-600 hover:text-orange-600">
                            <i class="ri-save-line"></i>
                            <span>Contrats</span>
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
                <h2 class="text-2xl font-bold">Clients</h2>
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

                    <div class="relative">
                        <input type="text" placeholder="Search for clients..."
                            class="w-64 pl-10 pr-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring focus:ring-orange-200 text-sm text-gray-600" />
                        <i class="ri-search-line absolute left-3 top-2 text-gray-400"></i>
                    </div>

                    <div class="flex gap-4">
                    <button
                        class="flex items-center bg-orange-600 hover:bg-transparent hover:text-orange-600 text-white px-4 py-2 rounded-lg shadow text-sm font-medium" id="addClientBtn">
                        <i class="ri-user-add-line text-lg mr-2"></i> Add Client
                    </button>
                    <button
                        class="flex items-center bg-orange-600 hover:bg-transparent hover:text-orange-600 text-white px-4 py-2 rounded-lg shadow text-sm font-medium" id="printPdf">
                        <i class="ri-printer-line text-lg mr-2"></i> Print Pdf
                    </button>
                    </div>
                </div>
            </div>

            <div class="grid grid-cols-1 lg:grid-cols-1 gap-6">
                <!-- clients table -->
                <div class=" bg-white p-6 rounded-lg shadow clientsPlayers">
                    <div class="flex justify-between ">
                       <h4 class="text-lg font-bold mb-4">Go Rent Clients</h4>
                       
                    </div>
                    <div class="rounded-lg overflow-x-auto">
                        <table class="border w-full border-collapse text-sm text-gray-600">
                            <!-- Table Head -->
                           
                               <thead>
                               <tr class="bg-gray-100 text-left">
                                 <th class="py-2 px-4 border-b">ID</th>
                                 <th class="py-2 px-4 border-b">First Name</th>
                                 <th class="py-2 px-4 border-b">Last Name</th>
                                 <th class="py-2 px-4 border-b">Email</th>
                                 <th class="py-2 px-4 border-b">Phone</th>
                                 <th class="py-2 px-4 border-b">Address</th>
                                 <th class="thActions py-2 px-4 border-b text-center">Actions</th>
                               </tr>
                             </thead>
                            
                            <!-- Table Body -->
                            <tbody>
                              <?php
                                 $host = 'localhost';     
                                 $dbname = 'gorent';  
                                 $username = 'root';     
                                 $password = 'yassir'; 

                                 $connection = new mysqli($host, $username, $password, $dbname);
                                 if ($connection->connect_error) {
                                    die("Connection failed: " . $connection->connect_error);
                                }

                                $sql = "SELECT * FROM clients";
                                $result = $connection->query($sql);
                                if(!$result){
                                    die("invalid query:".$connection->error);
                                }
                                while($row = $result->fetch_assoc()){
                                    echo'
                                    <tr class="hover:bg-gray-50">
                                       <td class="py-3 px-4 border-b">'. $row["id"] .'</td>
                                       <td class="py-3 px-4 border-b">'. $row["First_Name"] .'</td>
                                       <td class="py-3 px-4 border-b">'. $row["Last_Name"] .'</td>
                                       <td class="py-3 px-4 border-b">'. $row["Email"] .'</td>
                                       <td class="py-3 px-4 border-b">'. $row["Phone"] .'</td>
                                       <td class="py-3 px-4 border-b">'. $row["Address"] .'</td>
                                       <td class="py-3 px-4 border-b text-center space-x-2">
                                       
                                       <a href="../phpFunction/editClient.php?id='.$row["id"].'" class="text-blue-500 hover:text-blue-600 editClientBtn">
                                        <i class="ri-edit-line text-lg"></i>
                                       </a>
                                       
                                       <a href="../phpFunction/deleteClient.php?id='.$row["id"].'" class="btnDelete">
                                             <i class="ri-delete-bin-line text-lg text-red-500 hover:text-red-700"></i>
                                       </a>
                                    </td>
                                   </tr>
                                    ';
                                }
                              ?>
                            </tbody>
                          </table>
                    </div>
                </div>
            </div>
        </section>
    </div>

<!-- add new client modal -->
     
    <div id="addClient" class="hidden fixed inset-0 z-50 flex items-center justify-center bg-black bg-opacity-50 ">
        <div class="bg-white rounded-lg shadow-lg w-full max-w-2xl p-6">

            <div class="flex justify-between items-center mb-4">
                <h3 class="text-xl  font-semibold text-orange-600">Add New Client</h3>
                <button class="text-gray-500 hover:text-gray-700 closeAddClient"><i
                        class="ri-close-circle-line text-2xl text-orange-600"></i></button>
            </div>

            <form action="../phpFunction/addClient.php" method="post">
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mt-6">

                    <div>
                        <label for="first-name" class="mb-2 block text-sm font-medium text-gray-700">First Name</label>
                        <input placeholder="Enter your first name" type="text" id="first-name" name="first-name"
                            class="mt-1 block w-full border border-gray-300 rounded-md p-2 focus:ring-orange-500 focus:border-orange-500"
                            required />
                    </div>

                    <div>
                        <label for="last-name" class="mb-2 block text-sm font-medium text-gray-700">Last Name</label>
                        <input placeholder="Enter your last name" type="text" id="last-name" name="last-name"
                            class="mt-1 block w-full border border-gray-300 rounded-md p-2 focus:ring-orange-500 focus:border-orange-500"
                            required />
                    </div>

                    <div>
                        <label for="email" class="mb-2 block text-sm font-medium text-gray-700">Email</label>
                        <input placeholder="Enter your email address" type="email" id="email" name="email"
                            class="mt-1 block w-full border border-gray-300 rounded-md p-2 focus:ring-orange-500 focus:border-orange-500"
                            required />
                    </div>

                    <div>
                        <label for="phone" class="mb-2 block text-sm font-medium text-gray-700">Phone</label>
                        <input placeholder="Enter your phone number" type="text" id="phone" name="phone"
                            class="mt-1 block w-full border border-gray-300 rounded-md p-2 focus:ring-orange-500 focus:border-orange-500"
                            required />
                    </div>
                </div>

                <div class="mt-4">
                    <label for="address" class="mb-2 block text-sm font-medium text-gray-700">Address</label>
                    <textarea placeholder="Enter your message" id="address" name="address" rows="3"
                        class="mt-1 block w-full border border-gray-300 rounded-md p-2 focus:ring-orange-500 focus:border-orange-500"
                        required></textarea>
                </div>

                <div class="mt-6 flex justify-end space-x-2">
                    <button type="button"
                        class="px-4 py-2 bg-gray-200 text-gray-700 rounded-md hover:bg-gray-300 closeAddClient">Cancel</button>
                    <button type="submit" name="submit"
                        class="px-8 py-2 bg-orange-500 text-white rounded-md hover:bg-orange-600">Save</button>
                </div>
            </form>
        </div>
    </div>    

<!-- Edit client Modal  -->
     
<div id="editClientModal" class="hidden fixed inset-0 z-50 flex items-center justify-center bg-black bg-opacity-50 ">
        <div class="bg-white rounded-lg shadow-lg w-full max-w-2xl p-6">

            <div class="flex justify-between items-center mb-4">
                <h3 class="text-xl  font-semibold text-orange-600">Edit Client</h3>
                <button class="text-gray-500 hover:text-gray-700 closeEditClient"><i
                        class="ri-close-circle-line text-2xl text-orange-600"></i></button>
            </div>

            <form action="../phpFunction/editClient.php" method="post">
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mt-6">

                    <div>
                        <label for="first-name" class="mb-2 block text-sm font-medium text-gray-700">First Name</label>
                        <input placeholder="Enter your first name" type="text" id="firstNameEdit" name="first-name"
                            class="mt-1 block w-full border border-gray-300 rounded-md p-2 focus:ring-orange-500 focus:border-orange-500"
                            required />
                    </div>

                    <div>
                        <label for="last-name" class="mb-2 block text-sm font-medium text-gray-700">Last Name</label>
                        <input placeholder="Enter your last name" type="text" id="lastNameEdit" name="last-name"
                            class="mt-1 block w-full border border-gray-300 rounded-md p-2 focus:ring-orange-500 focus:border-orange-500"
                            required />
                    </div>

                    <div>
                        <label for="email" class="mb-2 block text-sm font-medium text-gray-700">Email</label>
                        <input placeholder="Enter your email address" type="email" id="emailEdit" name="email"
                            class="mt-1 block w-full border border-gray-300 rounded-md p-2 focus:ring-orange-500 focus:border-orange-500"
                            required />
                    </div>

                    <div>
                        <label for="phone" class="mb-2 block text-sm font-medium text-gray-700">Phone</label>
                        <input placeholder="Enter your phone number" type="text" id="phoneEdit" name="phone"
                            class="mt-1 block w-full border border-gray-300 rounded-md p-2 focus:ring-orange-500 focus:border-orange-500"
                            required />
                    </div>
                </div>

                <div class="mt-4">
                    <label for="address" class="mb-2 block text-sm font-medium text-gray-700">Address</label>
                    <textarea placeholder="Enter your message" id="address" name="addressEdit" rows="3"
                        class="mt-1 block w-full border border-gray-300 rounded-md p-2 focus:ring-orange-500 focus:border-orange-500"
                        required></textarea>
                </div>

                <div class="mt-6 flex justify-end space-x-2">
                    <button type="button"
                        class="px-4 py-2 bg-gray-200 text-gray-700 rounded-md hover:bg-gray-300 closeEditClient">Cancel</button>
                    <button type="submit" name="submit"
                        class="px-8 py-2 bg-orange-500 text-white rounded-md hover:bg-orange-600">Save</button>
                </div>
            </form>
        </div>
</div>

<style>
    @media print {
        @page {
        size: landscape;
        }
       #sidebar{
        display: none;
       }
      .clientsPlayers * {
        visibility: visible;
      }
      #editClientBtn, .btn-delete{
        visibility: hidden;
      }
      .header , .headerOptions , .thActions , .editClientBtn , .btnDelete{ 
        display: none;
      }
      .pdfHeader{
        display: flex; 
        flex-direction: row;
      }
    }
</style>

</body>

</html>