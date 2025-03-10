<?php
require_once 'connection.php'; 
require_once 'candidates_service.php'; 
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <script src="https://cdn.tailwindcss.com"></script>
    <title>Admin/Dashboard</title>
</head>
<body>
    <!-- Header Section -->
    <div class="text-white flex flex-col">
        <label class="flex items-center justify-center bg-[#1686C7] uppercase text-[18px] font-[Verdana] font-semibold h-[50px] tracking-wide">
            Voting Management System
        </label>
        <div class="bg-[#E5E6E6] h-[50px] flex flex-row w-[98%] ms-4 rounded-sm">
            <div class="flex flex-row gap-2 ps-5 items-center w-[50%]">
                <?php require_once 'route.php'; ?>
            </div>
            <div class="flex flex-row gap-5 ps-5 items-center justify-end w-[50%] pe-6 text-gray-500 text-[16px]">
                <?php require_once 'options.php'; ?>
            </div>
        </div>
    </div>

    <!-- Candidates Grid Section -->
    <div class="px-4">
        <div class="min-w-[97vw] shadow-md rounded-md bg-white h-[auto] mt-5 flex flex-wrap justify-evenly items-center gap-8 p-4">
            <?php 
                // Loop through the positions and candidates
                foreach ($candidates_by_type as $Position => $candidates):
            ?>
                <div class="mb-8 w-[330px] h-[400px] border border-gray-500 bg-[#1686C7] rounded-md">
                    <h2 class="text-2xl font-semibold mb-4 mt-4 text-center"><?php echo $Position; ?></h2>
                    <div class="p-4">
                        <?php foreach ($candidates as $candidate): ?>
                            <div class="candidate mb-4 p-2 bg-white rounded-md shadow-sm">
                                <p class="font-semibold"><?php echo $candidate['Name']; ?></p>
                            </div>
                        <?php endforeach; ?>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
    </div>
</body>
</html>
