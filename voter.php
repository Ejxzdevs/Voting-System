<?php
session_start(); 
require_once 'config/connection.php';
require_once 'services/candidates_service.php';

$name = $_SESSION['voter_name'];
$id = $_SESSION['voter_id'];

// Fetch the positions the user has voted for (assuming it's in session)
$position_array = isset($_SESSION['position_array']) ? $_SESSION['position_array'] : [];
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="assets/css/style.css">
    <script src="https://cdn.tailwindcss.com"></script>
    <title>Voting System</title>
</head>
<body class="bg-[#1686C7]">

<!-- Header Section -->
<div class="bg-blue-800 text-white py-6 px-4">
    <div class="container mx-auto text-center">
        <h1 class="text-4xl font-semibold animate__animated animate__fadeIn">Welcome, <?php echo htmlspecialchars($name); ?>!</h1>
        <p class="mt-2 text-lg">Please select your preferred candidate below and cast your vote.</p>
    </div>
</div>

<!-- Main Content -->
<div class="container mx-auto px-4 py-8">
    <?php 
        foreach ($candidates_by_type as $Position => $candidates):
    ?>
    <div class="mb-8">
        <h2 class="text-3xl font-semibold mb-4 text-white"><?php echo htmlspecialchars($Position); ?></h2>

        <!-- Table -->
        <div class="overflow-x-auto bg-white shadow-md rounded-lg">
            <table class="min-w-full divide-y divide-gray-200">
                <thead class="bg-gray-50">
                    <tr>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Image</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Name</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Action</th>
                    </tr>
                </thead>
                <tbody class="bg-white divide-y divide-gray-200">
                    <?php foreach ($candidates as $candidate): 
                        // Check if the user has already voted for this position
                        $isVoted = in_array($candidate['position_name'], $position_array);
                    ?>
                        <tr class="fadeInUp">
                            <td class="px-6 py-4 whitespace-nowrap">
                                <img class="shadow-md rounded-md h-12 w-12 object-cover" src="<?php echo htmlspecialchars($candidate['image_url']); ?>" alt="<?php echo htmlspecialchars($candidate['Name']); ?>">
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900"><?php echo htmlspecialchars($candidate['Name']); ?></td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                    
                                <a href="<?php echo $isVoted ? '#' : 'votes.php?candidate_id=' . $candidate['id'] . '&voter_id=' . $id . '&position=' . $candidate['position_name']; ?>" 
                                   class="inline-block px-4 py-2 bg-blue-600 text-white rounded-lg 
                                          <?php echo $isVoted ? 'cursor-not-allowed bg-gray-500' : 'hover:bg-blue-700 transition duration-300'; ?>"
                                   <?php echo $isVoted ? 'disabled' : ''; ?>
                                   ><?php echo $isVoted ? 'Voted' : 'Vote'; ?></a>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>
    <?php endforeach; ?>
</div>

<div class="h-[100px] flex justify-center items-center">
    <a href="logout.php" class="bg-white text-blue-700 font-semibold py-2 px-6 rounded-lg shadow-md hover:bg-blue-700 hover:text-white transition duration-300 sm:py-3 sm:px-8 md:py-3 md:px-10">
        Finish Vote
    </a>
</div>


</body>
</html>
