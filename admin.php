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
    $sql_fetch_data = "SELECT id, name, officer FROM voters";
    $stmt = $conn->query($sql_fetch_data);
    $voters = $stmt->fetchAll(PDO::FETCH_ASSOC);

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./admin.css">
    <title>Voting system</title>
</head>
<body>
    <h1>Admin panel</h1>
    <form action="" method="post">
        <input type="hidden" name="id" value="">
        <input type="text" name="name" placeholder="name">
        <select name="officer">
            <option value="President">President</option>
            <option value="Vice President">Vice President</option>
            <option value="Secretary">Secretary</option>
            <option value="Author">Author</option>
            <option value="Surgent">Surgent</option>
        </select>
        <button type="submit" name="insert">Insert</button>
        <button type="submit" name="update" class="bg-sky-500 hover:bg-sky-700">Update</button>
        <button class="bg-violet-500 hover:bg-violet-600 active:bg-violet-700 focus:outline-none focus:ring focus:ring-violet-300 text-white font-bold py-2 px-4 rounded">
  Save changes
</button>

<p class="underline underline-offset-8 ...">The quick brown fox...</p>
        
    </form>
 
    <table>
        <thead>
            <tr>
                <th>Name</th>
                <th>Officer</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($voters as $voter): ?>
                <tr>
                    <td><?php echo $voter['name']; ?></td>
                    <td><?php echo $voter['officer']; ?></td>
                    <td>
                        <a href="?delete=<?php echo $voter['id']; ?>">Delete</a>
                        <a href="?edit=<?php echo $voter['id']; ?>">Edit</a>
                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
    
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
</html>