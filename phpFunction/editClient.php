
<?php
$connection = new mysqli("localhost", "root", "yassir", "gorent");
if ($connection->connect_error) {
    die("Connection failed: " . $connection->connect_error);
}
if (isset($_GET['id']) ) {
    $clientId = $_GET['id'];

    $query = "SELECT * FROM clients WHERE id = $clientId";
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
    $nom = $_POST['first-name'];
    $prenom= $_POST['last-name'];
    $email = $_POST['email'];
    $telephone = $_POST['phone'];
    $adresse = $_POST['address'];
    

    $updateSql = "update clients set First_Name='$nom', Last_Name='$prenom', Email='$email' ,Phone='$telephone' ,Address='$adresse' where id = $clientId";

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


    <?php include'../pages/clients.php'?>
<!-- Edit client Modal  -->

<div id="editClientModal" class="fixed inset-0 z-50 flex items-center justify-center bg-black bg-opacity-50 ">
        <div class="bg-white rounded-lg shadow-lg w-full max-w-2xl p-6">

            <div class="flex justify-between items-center mb-4">
                <h3 class="text-xl  font-semibold text-orange-600">Edit Client</h3>
                <button class="text-gray-500 hover:text-gray-700 closeEditClient"><i
                        class="ri-close-circle-line text-2xl text-orange-600"></i></button>
            </div>

            <form action="../phpFunction/editClient.php?id=<?php echo $clientId ?>" method="post">
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mt-6">

                    <div>
                        <label for="first-name" class="mb-2 block text-sm font-medium text-gray-700">First Name</label>
                        <input placeholder="Enter your first name" type="text" id="firstNameEdit" name="first-name"
                            class="mt-1 block w-full border border-gray-300 rounded-md p-2 focus:ring-orange-500 focus:border-orange-500"
                            value="<?php echo $client['First_Name'] ?> "required />
                    </div>

                    <div>
                        <label for="last-name" class="mb-2 block text-sm font-medium text-gray-700">Last Name</label>
                        <input placeholder="Enter your last name" type="text" id="lastNameEdit" name="last-name"
                            class="mt-1 block w-full border border-gray-300 rounded-md p-2 focus:ring-orange-500 focus:border-orange-500"
                            required value="<?php echo $client['Last_Name'] ?> " />
                    </div>

                    <div>
                        <label for="email" class="mb-2 block text-sm font-medium text-gray-700">Email</label>
                        <input placeholder="Enter your email address" type="email" id="emailEdit" name="email"
                            class="mt-1 block w-full border border-gray-300 rounded-md p-2 focus:ring-orange-500 focus:border-orange-500"
                            required value="<?php echo $client['Email'] ?> " />
                    </div>

                    <div>
                        <label for="phone" class="mb-2 block text-sm font-medium text-gray-700">Phone</label>
                        <input placeholder="Enter your phone number" type="text" id="phoneEdit" name="phone"
                            class="mt-1 block w-full border border-gray-300 rounded-md p-2 focus:ring-orange-500 focus:border-orange-500"
                            required value="<?php echo $client['Phone'] ?> " />
                    </div>
                </div>

                <div class="mt-4">
                    <label for="address" class="mb-2 block text-sm font-medium text-gray-700">Address</label>
                    <textarea placeholder="Enter your message" id="address" name="address" rows="3"
                        class="mt-1 block w-full border border-gray-300 rounded-md p-2 focus:ring-orange-500 focus:border-orange-500"
                        required ><?php echo $client['Address'] ?></textarea>
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


<script>
    // close and update  
const closeEditClient = document.querySelectorAll('.closeEditClient');
const editClientModal = document.getElementById('editClientModal');

closeEditClient.forEach(button => {
    button.addEventListener('click', () => {
        window.location.href='../pages/clients.php';
    });
  }); 
</script>
</body>
</html>
