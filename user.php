<?php 
require_once('connection.php');

$sql_fetch_data = "SELECT id, name, officer FROM voters";
$stmt = $conn->query($sql_fetch_data);
$voters = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://cdn.tailwindcss.com"></script>
    <title>User</title>
    <style>
        .container {
            display: flex;
            flex-wrap: wrap;
            justify-content: space-between;
        }
        .container > div {
            width: 30%;
            border: 1px solid #ccc;
            padding: 10px;
            margin-bottom: 20px;
        }
        h2 {
            margin-top: 0;
        }
    </style>
</head>
<body>
<div class="container">
    <?php 
    // Array to store voters based on officer type
    $voters_by_type = array(
        'President' => array(),
        'Vice President' => array(),
        'Surgent' => array(),
        'Author' => array(),
        'Secretary' => array()
    );

    // Group voters by officer type
    foreach ($voters as $voter) {
        $voters_by_type[$voter['officer']][] = $voter;
    }

    // Display voters by officer type
    foreach ($voters_by_type as $officer => $voters):
    ?>
        <div class="<?php echo strtolower(str_replace(' ', '-', $officer)); ?>-container">
            <h2><?php echo $officer; ?></h2>
            <table>
                <thead>
                    <tr>
                        <th>Name</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <?php foreach ($voters as $voter): ?>
                    <tbody>
                        <tr>
                    <td><?php echo $voter['name']; ?></td>
                    <td><a href="">Vote</a></td>
                    </tr>
                    </tbody>
                <?php endforeach; ?>
           </table>
        </div>
    <?php endforeach; ?>
</div>
</body>
</html>