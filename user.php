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
</head>
<body class="bg-gray-200">
<div class="container mx-auto px-4 py-8">
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
        <div class="mb-8">
            <h2 class="text-2xl font-semibold mb-4"><?php echo $officer; ?></h2>
            <table class="min-w-full divide-y divide-gray-300">
                <thead class="bg-gray-200">
                    <tr>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Name</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Action</th>
                    </tr>
                </thead>
                <tbody class="bg-white divide-y divide-gray-300">
                    <?php foreach ($voters as $voter): ?>
                        <tr>
                            <td class="px-6 py-4 whitespace-nowrap"><?php echo $voter['name']; ?></td>
                            <td class="px-6 py-4 whitespace-nowrap"><a href="#" class="text-blue-500 hover:text-blue-700">Vote</a></td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
           </table>
        </div>
    <?php endforeach; ?>
</div>
</body>
</html>
