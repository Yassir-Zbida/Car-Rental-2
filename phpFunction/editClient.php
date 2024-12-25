<?php
// Classe de gestion de la base de données
class Database {
    private $host = "localhost";
    private $username = "root";
    private $password = "safaa";
    private $dbName = "gorent";
    private $connection;

    public function connect() {
        $this->connection = new mysqli($this->host, $this->username, $this->password, $this->dbName);
        if ($this->connection->connect_error) {
            die("Connection failed: " . $this->connection->connect_error);
        }
        return $this->connection;
    }
}

// Classe de gestion des clients
class Client {
    private $connection;

    public function __construct($dbConnection) {
        $this->connection = $dbConnection;
    }

    // Récupère les informations d'un client par son ID
    public function getClientById($id) {
        $stmt = $this->connection->prepare("SELECT * FROM clients WHERE id = ?");
        $stmt->bind_param("i", $id);
        $stmt->execute();
        return $stmt->get_result()->fetch_assoc();
    }

    // Met à jour les informations d'un client
    public function updateClient($id, $firstName, $lastName, $email, $phone, $address) {
        $stmt = $this->connection->prepare("UPDATE clients SET First_Name = ?, Last_Name = ?, Email = ?, Phone = ?, Address = ? WHERE id = ?");
        $stmt->bind_param("sssssi", $firstName, $lastName, $email, $phone, $address, $id);
        return $stmt->execute();
    }
}

// Vérifie si l'ID est passé dans l'URL
if (isset($_GET['id'])) {
    $clientId = $_GET['id'];

    // Connexion à la base de données
    $database = new Database();
    $connection = $database->connect();

    // Création de l'objet Client pour gérer les clients
    $client = new Client($connection);

    // Récupère les détails du client
    $clientDetails = $client->getClientById($clientId);

    // Si le client existe
    if (!$clientDetails) {
        echo "Client ID is missing or invalid.";
        exit;
    }

    // Traitement du formulaire de mise à jour
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        $firstName = $_POST['first-name'];
        $lastName = $_POST['last-name'];
        $email = $_POST['email'];
        $phone = $_POST['phone'];
        $address = $_POST['address'];

        // Met à jour les informations du client
        if ($client->updateClient($clientId, $firstName, $lastName, $email, $phone, $address)) {
            header("Location: ../pages/clients.php");
            exit;
        } else {
            echo "Error updating client: " . $connection->error;
        }
    }
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
                        <input type="text" id="firstNameEdit" name="first-name" class="mt-1 block w-full border border-gray-300 rounded-md p-2 focus:ring-orange-500 focus:border-orange-500" value="<?php echo $clientDetails['First_Name']; ?>" required />
                    </div>
                    <div>
                        <label for="last-name" class="mb-2 block text-sm font-medium text-gray-700">Last Name</label>
                        <input type="text" id="lastNameEdit" name="last-name" class="mt-1 block w-full border border-gray-300 rounded-md p-2 focus:ring-orange-500 focus:border-orange-500" value="<?php echo $clientDetails['Last_Name']; ?>" required />
                    </div>
                    <div>
                        <label for="email" class="mb-2 block text-sm font-medium text-gray-700">Email</label>
                        <input type="email" id="emailEdit" name="email" class="mt-1 block w-full border border-gray-300 rounded-md p-2 focus:ring-orange-500 focus:border-orange-500" value="<?php echo $clientDetails['Email']; ?>" required />
                    </div>
                    <div>
                        <label for="phone" class="mb-2 block text-sm font-medium text-gray-700">Phone</label>
                        <input type="text" id="phoneEdit" name="phone" class="mt-1 block w-full border border-gray-300 rounded-md p-2 focus:ring-orange-500 focus:border-orange-500" value="<?php echo $clientDetails['Phone']; ?>" required />
                    </div>
                </div>

                <div class="mt-4">
                    <label for="address" class="mb-2 block text-sm font-medium text-gray-700">Address</label>
                    <textarea id="address" name="address" rows="3" class="mt-1 block w-full border border-gray-300 rounded-md p-2 focus:ring-orange-500 focus:border-orange-500" required><?php echo $clientDetails['Address']; ?></textarea>
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
