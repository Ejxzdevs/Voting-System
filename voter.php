<?php 
require_once 'config/connection.php';
require_once 'services/candidates_service.php';

// Start session to store vote state
session_start();

$name = $_SESSION['voter_name'];
$id = $_SESSION['voter_id'];
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://cdn.tailwindcss.com"></script>
    <title>User Voting</title>
    <style>
        /* Animation for table rows */
        .fadeInUp {
            animation: fadeInUp 0.5s ease-out;
        }

        @keyframes fadeInUp {
            0% {
                opacity: 0;
                transform: translateY(10px);
            }
            100% {
                opacity: 1;
                transform: translateY(0);
            }
        }

        /* Button hover effects */
        .hover-scale {
            transition: transform 0.3s ease;
        }

        .hover-scale:hover {
            transform: scale(1.05);
        }
    </style>
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
                    <?php foreach ($candidates as $candidate): ?>
                        <tr class="fadeInUp">
                            <td class="px-6 py-4 whitespace-nowrap">
                                <img class="shadow-md rounded-md h-12 w-12 object-cover" src="<?php echo htmlspecialchars($candidate['image_url']); ?>" alt="<?php echo htmlspecialchars($candidate['Name']); ?>">
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900"><?php echo htmlspecialchars($candidate['Name']); ?></td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                                <a href="votes.php?candidate_id=<?php echo $candidate['id']; ?>&voter_id=<?php echo $id ?>" 
                                   class="inline-block px-4 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700 transition duration-300 hover-scale"
                                   >Vote</a>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>
    <?php endforeach; ?>
</div>

</body>
</html>
