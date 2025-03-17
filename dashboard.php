<?php
session_start();
if(!isset($_SESSION['username'])){
    header("Location: login.php");
}
require_once 'config/connection.php'; 
require_once 'api/candidates.php';
require_once 'services/candidates_service.php';
require_once 'services/positions_service.php';
require_once 'services/voter_service.php';
require_once 'services/votes_service.php';
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
<body class="bg-[#1686C7]">
    <div class="text-white flex flex-col">
        <label class="flex items-center justify-center bg-[#1686C7] uppercase text-[18px] font-[Verdana] font-semibold h-[50px] tracking-wide">
            Voting Management System
        </label>
        <div class="bg-[#E5E6E6] h-[50px] flex flex-row w-[98%] ms-4 rounded-sm">
            <div class="flex flex-row gap-2 ps-5 items-center w-[50%]">
                <?php require_once 'components/route.php'; ?>
            </div>
            <div class="flex flex-row gap-5 ps-5 items-center justify-end w-[50%] pe-6 text-gray-500 text-[16px]">
                <?php require_once 'components/options.php'; ?>
            </div>
        </div>
    </div>

    <div class="min-w-[97vw] flex flex-col justify-between md:flex-row mt-3 h-auto px-4">
        <div class="grid grid-cols-2 grid-rows-2 gap-6 w-full md:w-[62%]">
            <div class="border border-gray-800 h-[150px] w-full rounded-lg flex flex-col items-center justify-center bg-gray-100 shadow-lg p-4">
                <div class="text-4xl text-green-700 mb-4">
                    <i class="fas fa-thumbs-up"></i>
                </div>
                <p class="text-lg font-semibold text-gray-700">Total Votes</p>
                <p class="text-2xl text-gray-900"><?php echo count($votes)?></p>
            </div>

            <div class="border border-gray-800 h-[150px] w-full rounded-lg flex flex-col items-center justify-center bg-gray-100 shadow-lg p-4">
                <div class="text-4xl text-blue-600 mb-4">
                    <i class="fas fa-users"></i>
                </div>
                <p class="text-lg font-semibold text-gray-700">Total Voters</p>
                <p class="text-2xl text-gray-900"><?php echo count($voters ); ?></p>
            </div>

            <div class="border border-gray-800 h-[150px] w-full rounded-lg flex flex-col items-center justify-center bg-gray-100 shadow-lg p-4">
                <div class="text-4xl text-yellow-600 mb-4">
                    <i class="fas fa-user-tie"></i>
                </div>
                <p class="text-lg font-semibold text-gray-700">Total Candidates</p>
                <p class="text-2xl text-gray-900"><?php echo count($candidates); ?></p>
            </div>

            <div class="border border-gray-800 h-[150px] w-full rounded-lg flex flex-col items-center justify-center bg-gray-100 shadow-lg p-4">
                <div class="text-4xl text-purple-600 mb-4">
                    <i class="fas fa-user-tie"></i>
                </div>
                <p class="text-lg font-semibold text-gray-700">Total Position</p>
                <p class="text-2xl text-gray-900"><?php echo count($positions); ?></p>
            </div>
        </div>

        <div class="md:w-[37%] bg-white w-full border border-gray-500 overflow-hidden py-4 rounded-lg shadow-lg mt-6 md:mt-0">
            <label class="ml-4 text-gray-700 text-[16px] font-semibold">Latest Voters</label>
            <div class="container mx-auto h-[300px] overflow-y-auto border-t border-gray-500 mt-4">
                <table class="min-w-full divide-y divide-gray-200 table-auto text-center">
                    <thead class="bg-gray-100">
                        <tr>
                            <th class="px-6 py-3 text-xs font-medium text-gray-700 uppercase tracking-wider w-[10%]">ID</th>
                            <th class="px-6 py-3 text-xs font-medium text-gray-700 uppercase tracking-wider w-[60%]">Name</th>
                            <th class="px-6 py-3 text-xs font-medium text-gray-700 uppercase tracking-wider w-[30%]">Action</th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-gray-200 pb-4">
                        <?php foreach($voters as $voter): ?>
                            <tr class="hover:bg-gray-50 transition-colors duration-300 whitespace-nowrap text-sm text-gray-900">
                                <td class="px-6 py-4"><?php echo $voter['voter_id']; ?></td>
                                <td class="px-6 py-4"><?php echo $voter['voter_name']; ?></td>
                                <td class="px-6 py-4">
                                    <a href="javascript:void(0);" class="view-votes text-blue-500 hover:text-blue-700 cursor-pointer"
                                       data-votes='<?php echo htmlspecialchars(json_encode(getVotes($voter['voter_id'])), ENT_QUOTES, 'UTF-8'); ?>'>
                                        <i class="fas fa-eye"></i>
                                    </a>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <div class="px-4 mt-6">
        <div class="min-w-[97vw] shadow-md rounded-md bg-white h-[auto] grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-8 p-4">
            <?php 
                foreach ($candidates_by_type as $Position => $candidates):
            ?>
                <div class="w-full h-[300px] border border-gray-500 bg-[#1686C7] rounded-md shadow-lg">
                    <h2 class="text-2xl font-semibold mb-4 mt-4 text-center text-white"><?php echo $Position; ?></h2>
                    <div class="p-4 overflow-y-auto h-[200px]">
                        <?php foreach ($candidates as $candidate): ?>
                            <div class="candidate mb-4 p-4 bg-white rounded-md shadow-sm h-[30px] flex items-center justify-between">
                                <p class="font-semibold text-gray-700"><?php echo $candidate['Name']; ?></p>
                                <p class="font-semibold text-gray-700"><?php echo $candidate['total_votes']; ?></p>
                            </div>
                        <?php endforeach; ?>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
    </div>


    <!-- Pop-up Modal -->
    <div id="voteModal" class="hidden fixed inset-0 flex items-center justify-center bg-gray-900 bg-opacity-50 backdrop-blur-sm transition-opacity duration-300">
        <div class="bg-white p-6 rounded-lg shadow-xl w-[90%] max-w-md relative animate-fadeIn">
            <h2 class="text-xl font-semibold text-gray-800 mb-4 border-b pb-2">Voted Candidates</h2>
            <ul id="voteList" class="text-gray-900 space-y-2 max-h-60 overflow-y-auto p-2 border rounded-md bg-gray-50"></ul>
            <button id="closeModal" class="absolute top-6 right-8 text-gray-500 hover:text-gray-700 text-xl">
                <i class="fa-solid fa-xmark"></i>
            </button>
        </div>
    </div>
    <script src="assets/js/dashboard.js"></script>
</body>
</html>
