<?php 
require_once('connection.php');

$sql_fetch_data = "SELECT id ,Name ,Position ,image_url FROM Candidates";
$stmt = $conn->query($sql_fetch_data);
$candidates = $stmt->fetchAll(PDO::FETCH_ASSOC);
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
    $candidates_by_type = array(
        'President' => array(),
        'Vice President' => array(),
        'Surgent' => array(),
        'Author' => array(),
        'Secretary' => array()
    );

    // Group voters by Position
    foreach ($candidates as $candidate) {
        $candidates_by_type[$candidate['Position']][] = $candidate;
    }

    // Display voters by officer type
    foreach ($candidates_by_type as $Position => $candidates):
    ?>
<div class="mb-8">
    <h2 class="text-2xl font-semibold mb-4 mt-4 "><?php echo $Position; ?></h2>
        <table class="min-w-full divide-y divide-gray-300">
                <thead class="bg-gray-200">
                    <tr>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Image</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Name</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Action</th>
                    </tr>
                </thead>
                <tbody class="bg-white divide-y divide-gray-300">
                    <?php foreach ($candidates as $candidate): ?>
                        <tr>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <img class="shadow-md rounded-md h-[40px] w-[50px]" src="<?php echo     $candidate['image_url']; ?>" alt="<?php echo $candidate['image_url']; ?>">
                                </td>
                            <td class="px-6 py-4 whitespace-nowrap"><?php echo $candidate['Name']; ?></td>
                            <td class="px-6 py-4 whitespace-nowrap"><a href="vote.php?id=<?php echo $candidate['id']; ?>" class="text-blue-500 hover:text-blue-700">Vote</a></td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
        </table>
        </div>
    <?php endforeach; ?>
</div>
</body>
</html>
