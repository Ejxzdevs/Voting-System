<?php
require_once('connection.php');

    if ($_SERVER['REQUEST_METHOD'] === 'POST' || $_SERVER['REQUEST_METHOD'] === 'GET' ) {
        // Check if form is for inserting new record or updating existing record
        if (isset($_POST['insert'])) {
            // Prepare an SQL statement for insertion
            $stmt = $conn->prepare("INSERT INTO Candidates (Name, Position) VALUES (:name, :position)");
            
            // Bind parameters to the named placeholders
            $stmt->bindParam(':name', $name);
            $stmt->bindParam(':position', $position);
            
            // Set parameters and execute the statement for insertion
            $name = $_POST['name'];
            $position = $_POST['position'];
            $stmt->execute();
            
            header("Location: admin.php");
        } elseif (isset($_POST['update'])) {
            // Prepare an SQL statement for updating
            $stmt = $conn->prepare("UPDATE Candidates SET Name = :name, Position = :position WHERE id = :id");
            
            // Bind parameters to the named placeholders
            $stmt->bindParam(':name', $name);
            $stmt->bindParam(':position', $position);
            $stmt->bindParam(':id', $id);
            
            // Set parameters and execute the statement for updating
            $name = $_POST['name'];
            $position = $_POST['position'];
            $id = $_POST['id'];
            $stmt->execute();
            
            header("Location: admin.php");
        }elseif(isset($_GET['delete'])) {
            $id = $_GET['delete'];
            $sql_delete_record = "DELETE FROM Candidates WHERE id = :id";
            $stmt = $conn->prepare($sql_delete_record);
            $stmt->bindParam(':id', $id);
            $stmt->execute();
            header("Location: admin.php");
        }
    }

    // Fetch voters data
    $sql_fetch_data = "SELECT id, Name, Position, Count FROM Candidates";
    $stmt = $conn->query($sql_fetch_data);
    $voters = $stmt->fetchAll(PDO::FETCH_ASSOC);

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://cdn.tailwindcss.com"></script>
    <title>Admin</title>
</head>
<body style="height: 100vh;" >
<header class="bg-gray-300 text-white flex flex-col " style="height: 20vh;">
        <h1 class="flex items-center justify-center bg-gray-800 uppercase text-xl font-sans font-semibold " style="height: 40vh">Admin panel</h1>
        <form class="flex flex-row gap-2 items-center pl-4 bg-gray-300  " action="" method="post" style="height: 60vh" >
            <input type="text" name="name" placeholder="Insert Candidate" class="text-gray-800 w-50 h-10 px-4 py-2 border border-gray-300 rounded-md focus:outline-none focus:border-blue-500">
            <input type="text" name="id" hidden>
            <select name="position" class="text-gray-800 w-50 h-10 px-4 py-2 border border-gray-300 rounded-md focus:outline-none focus:border-blue-500">
                <option value="President">President</option>
                <option value="Vice President">Vice President</option>
                <option value="Secretary">Secretary</option>
                <option value="Author">Author</option>
                <option value="Surgent">Surgent</option>
            </select>
            <button type="submit" name="insert" class="bg-green-500 hover:bg-green-600 text-white font-bold py-2 px-4 rounded w-32 h-10">Insert</button>
            <button id="update" type="submit" name="update" class="bg-blue-500 hover:bg-blue-600 text-white font-bold py-2 px-4 rounded w-32 h-10" >Update</button>        
        </form>
</header>
<div class="bg-yellow-300">
    <table class="min-w-full divide-y divide-gray-200 " style="width:80vw;">
    <thead>
        <tr>
            <th class="px-6 py-3 bg-gray-50 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Name</th>
            <th class="px-6 py-3 bg-gray-50 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Position</th>
            <th class="px-6 py-3 bg-gray-50 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Count</th>
            <th class="px-6 py-3 bg-gray-50 text-center text-xs font-medium text-gray-500 uppercase tracking-wider">Action</th>
        </tr>
    </thead>
    <tbody class="bg-white divide-y divide-gray-200">
        <?php foreach ($voters as $voter): ?>
            <tr>
                <td class="px-6 py-4 whitespace-nowrap"><?php echo $voter['Name']; ?></td>
                <td class="px-6 py-4 whitespace-nowrap"><?php echo $voter['Position']; ?></td>
                <td class="px-6 py-4 whitespace-nowrap"><?php echo $voter['Count']; ?></td>
                <td class="px-6 py-4 whitespace-nowrap text-center">
                    <a href="?delete=<?php echo $voter['id']; ?>" class="text-red-500 hover:text-red-700 mr-2">Delete</a>
                    <a href="?edit=<?php echo $voter['id']; ?>" class="text-blue-500 hover:text-blue-700">Edit</a>
                </td>
            </tr>
        <?php endforeach; ?>
    </tbody>
    </table>
</div>
<?php
if (isset($_GET['edit'])) {
    $id = $_GET['edit'];
    $sql_fetch_record = "SELECT Name, Position FROM Candidates WHERE id = :id";
    $stmt = $conn->prepare($sql_fetch_record);
    $stmt->bindParam(':id', $id);
    $stmt->execute();
    $record = $stmt->fetch(PDO::FETCH_ASSOC);

    echo <<<HTML
    <script>
        document.getElementsByName('name')[0].value = "{$record['Name']}";
        document.getElementsByName('position')[0].value = "{$record['Position']}";
        document.getElementsByName('id')[0].value = "{$id}";
        document.getElementsByName('name')[0].focus();
    </script>
HTML;
}
?>

    
</body>
</html>