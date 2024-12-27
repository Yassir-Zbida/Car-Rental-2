<?php
require_once("../db.php");
require_once("../pages/user.php");

if (isset($_GET['id'])) {
    $clientId = $_GET['id'];
    $db = new Database();
    $user = new User($db);

    // Récupère les détails du client
    $clientDetails = $user->getUserById($clientId);

    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        $firstName = $_POST['first-name'];
        $lastName = $_POST['last-name'];
        $email = $_POST['email'];
        $phone = $_POST['phone'];
        $address = $_POST['address'];

        $updateResult = $user->updateUser($clientId, null, $email, $firstName, $lastName, $phone, $address);
        if ($updateResult === "Les informations de l'utilisateur ont été mises à jour avec succès.") {
          header("Location: ../pages/clients.php");
        } else {
           echo json_encode(['success' => false, 'message' => 'Error updating client: ' . $updateResult]);
           exit;
        }
    }

} else {
    echo json_encode(['success' => false, 'message' => 'Client ID is missing or invalid.']);
    exit;
}

?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Client</title>
</head>
<body>
    <?php include '../pages/clients.php'; ?>
<?php echo "tedt" ?>
    <!-- Modal Edit Client Form -->
    <div id="editClientModal" class="fixed inset-0 z-50 flex items-center justify-center bg-black bg-opacity-50">
        <div class="bg-white rounded-lg shadow-lg w-full max-w-2xl p-6">
            <div class="flex justify-between items-center mb-4">
                <h3 class="text-xl font-semibold text-orange-600">Edit Client</h3>
                <button class="text-gray-500 hover:text-gray-700 closeEditClient"><i class="ri-close-circle-line text-2xl text-orange-600"></i></button>
            </div>

            <form action="editClient.php?id=<?php echo $clientId; ?>" method="post">
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mt-6">
                    <div>
                        <label for="first-name" class="mb-2 block text-sm font-medium text-gray-700">First Name</label>
                        <input type="text" id="firstNameEdit" name="first-name" class="mt-1 block w-full border border-gray-300 rounded-md p-2 focus:ring-orange-500 focus:border-orange-500" value="<?php echo $clientDetails['first_name']; ?>" required />
                    </div>
                    <div>
                        <label for="last-name" class="mb-2 block text-sm font-medium text-gray-700">Last Name</label>
                        <input type="text" id="lastNameEdit" name="last-name" class="mt-1 block w-full border border-gray-300 rounded-md p-2 focus:ring-orange-500 focus:border-orange-500" value="<?php echo $clientDetails['last_name']; ?>" required />
                    </div>
                    <div>
                        <label for="email" class="mb-2 block text-sm font-medium text-gray-700">Email</label>
                        <input type="email" id="emailEdit" name="email" class="mt-1 block w-full border border-gray-300 rounded-md p-2 focus:ring-orange-500 focus:border-orange-500" value="<?php echo $clientDetails['email']; ?>" required />
                    </div>
                    <div>
                        <label for="phone" class="mb-2 block text-sm font-medium text-gray-700">Phone</label>
                        <input type="text" id="phoneEdit" name="phone" class="mt-1 block w-full border border-gray-300 rounded-md p-2 focus:ring-orange-500 focus:border-orange-500" value="<?php echo $clientDetails['phone']; ?>" required />
                    </div>
                </div>

                <div class="mt-4">
                    <label for="address" class="mb-2 block text-sm font-medium text-gray-700">Address</label>
                    <textarea id="address" name="address" rows="3" class="mt-1 block w-full border border-gray-300 rounded-md p-2 focus:ring-orange-500 focus:border-orange-500" required><?php echo $clientDetails['address']; ?></textarea>
                </div>

                <div class="mt-6 flex justify-end space-x-2">
                    <button type="button" class="px-4 py-2 bg-gray-200 text-gray-700 rounded-md hover:bg-gray-300 closeEditClient">Cancel</button>
                    <button type="submit" class="px-8 py-2 bg-orange-500 text-white rounded-md hover:bg-orange-600">Save</button>
                </div>
            </form>
        </div>
    </div>

    <script>
        // Close modal on cancel
        const closeEditClient = document.querySelectorAll('.closeEditClient');
        closeEditClient.forEach(button => {
            button.addEventListener('click', () => {
                window.location.href = '../pages/clients.php';
            });
        });
    </script>
</body>
</html>
