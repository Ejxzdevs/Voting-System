<?php
require_once('connection.php');

    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        // Check if form is for inserting new record or updating existing record
        if (isset($_POST['insert'])) {
            // Prepare an SQL statement for insertion
            $stmt = $conn->prepare("INSERT INTO voters (name, officer) VALUES (:name, :officer)");
            
            // Bind parameters to the named placeholders
            $stmt->bindParam(':name', $name);
            $stmt->bindParam(':officer', $officer);
            
            // Set parameters and execute the statement for insertion
            $name = $_POST['name'];
            $officer = $_POST['officer'];
            $stmt->execute();
            
            header("Location: admin.php");
        } elseif (isset($_POST['update'])) {
            // Prepare an SQL statement for updating
            $stmt = $conn->prepare("UPDATE voters SET name = :name, officer = :officer WHERE id = :id");
            
            // Bind parameters to the named placeholders
            $stmt->bindParam(':name', $name);
            $stmt->bindParam(':officer', $officer);
            $stmt->bindParam(':id', $id);
            
            // Set parameters and execute the statement for updating
            $name = $_POST['name'];
            $officer = $_POST['officer'];
            $id = $_POST['id'];
            $stmt->execute();
            
            header("Location: admin.php");
        }
    }

    // Fetch voters data
    $sql_fetch_data = "SELECT id, name, officer, Count FROM voters";
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
            <select name="officer" class="text-gray-800 w-50 h-10 px-4 py-2 border border-gray-300 rounded-md focus:outline-none focus:border-blue-500">
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
<div class="container px-4 bg-gray-300" style="height: 80vh;">
    
        <table class="min-w-full divide-y divide-gray-200">
            <thead>
                <tr>
                    <th class="text-center py-3 bg-gray-50 text-left text-xs leading-4 font-medium text-gray-500 uppercase tracking-wider">Name</th>
                    <th class="text-center py-3 bg-gray-50 text-left text-xs leading-4 font-medium text-gray-500 uppercase tracking-wider">Officer</th>
                    <th class="text-center py-3 bg-gray-50 text-left text-xs leading-4 font-medium text-gray-500 uppercase tracking-wider">Count</th>
                    <th class="text-center py-3 bg-gray-50 text-left text-xs leading-4 font-medium text-gray-500 uppercase tracking-wider">Action</th>
                </tr>
            </thead>
            <tbody class="bg-white divide-y divide-gray-200">
                <?php foreach ($voters as $voter): ?>
                    <tr>
                        <td class="text-center px-24 py-4 whitespace-no-wrap"><?php echo $voter['name']; ?></td>
                        <td class="text-center px-16 py-4 whitespace-no-wrap"><?php echo $voter['officer']; ?></td>
                        <td class="text-center px-8 py-4 whitespace-no-wrap"><?php echo $voter['Count']; ?></td>
                        <td class="text-center py-2 whitespace-no-wrap">
                            <a class="text-center inline-block  w-32 h-10 px-4 py-2 bg-red-500 text-white rounded-md hover:bg-red-600 focus:outline-none focus:bg-red-600" href="?delete=<?php echo $voter['id']; ?>">Delete</a>
                            <a class="text-center inline-block w-32 h-10 px-4 py-2 bg-blue-500 text-white rounded-md hover:bg-blue-600 focus:outline-none focus:bg-blue-600" href="?edit=<?php echo $voter['id']; ?>">Edit</a>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
    <?php
    if (isset($_GET['edit'])) {
        $id = $_GET['edit'];
        $sql_fetch_record = "SELECT name, officer FROM voters WHERE id = :id";
        $stmt = $conn->prepare($sql_fetch_record);
        $stmt->bindParam(':id', $id);
        $stmt->execute();
        $record = $stmt->fetch(PDO::FETCH_ASSOC);
    ?>
        <script>
            document.getElementsByName('name')[0].value = "<?php echo $record['name']; ?>";
            document.getElementsByName('officer')[0].value = "<?php echo $record['officer']; ?>";
            document.getElementsByName('id')[0].value = "<?php echo $id; ?>";
            document.getElementsByName('name')[0].focus();
        </script>
    <?php } ?>
    
    <?php
    if (isset($_GET['delete'])) {
        $id = $_GET['delete'];
        $sql_delete_record = "DELETE FROM voters WHERE id = :id";
        $stmt = $conn->prepare($sql_delete_record);
        $stmt->bindParam(':id', $id);
        $stmt->execute();
        header("Location: admin.php");
    }
    ?>
</body>
    <script>
        let btnUpdate = document.getElementById("update").disabled = true;
    </script>
</html>