<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manage Positions</title>
    <script src="https://kit.fontawesome.com/your-fontawesome-kit.js" crossorigin="anonymous"></script>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100">

<!-- Header with Settings and Logout -->
<div class="flex space-x-4 p-4">
    <a href="#" onclick="openModal()" class="text-xl text-gray-700 hover:text-gray-900">
        <i class="fa fa-cogs"></i>
    </a>
    <a href="index.php" class="text-xl text-gray-700 hover:text-gray-900">
        <i class="fa fa-sign-out-alt"></i>
    </a>
</div>

<!-- Positions Modal -->
<div id="modal" class="fixed inset-0 bg-gray-900 bg-opacity-50 flex items-center justify-center hidden text-[14px]">
    <div class="bg-white rounded-lg p-8 w-full sm:w-96 relative">
        
        <!-- Close Button (Top Right) -->
     

        <div class="flex justify-between items-center mb-4">
            <h2 class="text-xl font-semibold text-center">Positions</h2>
            <button onclick="openAddPositionModal()" class="w-[90px] h-9 px-2 border border-blue-700 bg-blue-500 hover:bg-blue-700 cursor-pointer shadow-md rounded text-white">
                Create
            </button>
        </div>

        <div class="mb-4 h-60 overflow-y-auto">
            <ul class="space-y-2">
                <?php foreach($positions as $position): ?>
                    <li class="flex justify-between items-center py-2 px-4 bg-gray-100 rounded-md hover:bg-gray-200">
                        <span class="text-gray-800"><?php echo htmlspecialchars($position['position_name']); ?></span>
                        
                        <div class="flex flex-row gap-2">
                            <!-- Edit Button -->
                            <button onclick="openEditPositionModal(<?php echo $position['position_id']; ?>, '<?php echo htmlspecialchars($position['position_name']); ?>')" class="text-blue-600 hover:text-blue-800">
                                <i class="fa fa-edit text-xl"></i>
                            </button>

                            <!-- Delete Button -->
                            <form method="POST" action="" class="flex items-center space-x-2">
                                <input type="hidden" name="position_id" value="<?php echo $position['position_id']; ?>">
                                <button type="submit" name="delete_position" class="text-red-600 hover:text-red-800 bg-transparent border-none">
                                    <i class="fa fa-trash text-xl"></i>
                                </button>
                            </form>
                        </div>
                    </li>
                <?php endforeach; ?>
            </ul>
        </div>
        <div class="w-full flex justify-center items-center">
        <button onclick="closeModal()" class="w-[90px] h-9 px-2 border border-blue-700 bg-gray-500 text-white hover:bg-gray-700 shadow-md rounded">
            Close
        </button>
        </div>
    </div>
</div>


<!-- Add Position Modal -->
<div id="addPositionModal" class="fixed inset-0 bg-gray-900 bg-opacity-50 flex items-center justify-center hidden">
    <div class="bg-white rounded-lg p-8 w-full sm:w-96">
        <h2 class="text-xl font-semibold mb-4 text-center">New Position</h2>
        <form method="POST" action="">
            <div class="mb-4">
                <label for="position" class="block text-sm font-medium text-gray-700">Position Name</label>
                <input type="text" id="position" name="position_name" class="mt-1 block w-full px-4 py-2 border border-gray-300 rounded-md focus:ring-indigo-500 focus:border-indigo-500" required>
            </div>
            <div class="flex justify-end space-x-4">
                <button type="button" onclick="closeAddPositionModal()" class="px-4 py-2 bg-gray-300 text-gray-800 rounded-lg hover:bg-gray-400">Cancel</button>
                <button type="submit" name="add_position" class="px-4 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700">Save Position</button>
            </div>
        </form>
    </div>
</div>

<!-- Edit Position Modal -->
<div id="editPositionModal" class="fixed inset-0 bg-gray-900 bg-opacity-50 flex items-center justify-center hidden">
    <div class="bg-white rounded-lg p-8 w-full sm:w-96">
        <h2 class="text-xl font-semibold mb-4 text-center">Edit Position</h2>
        <form method="POST" action="">
            <div class="mb-4">
                <label for="edit_position" class="block text-sm font-medium text-gray-700">Position Name</label>
                <input type="text" id="edit_position" name="position_name" class="mt-1 block w-full px-4 py-2 border border-gray-300 rounded-md focus:ring-indigo-500 focus:border-indigo-500" required>
                <input type="hidden" name="position_id" id="edit_position_id">
            </div>
            <div class="flex justify-end space-x-4">
                <button type="button" onclick="closeEditPositionModal()" class="px-4 py-2 bg-gray-300 text-gray-800 rounded-lg hover:bg-gray-400">Cancel</button>
                <button type="submit" name="edit_position" class="px-4 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700">Save Changes</button>
            </div>
        </form>
    </div>
</div>
    <script src="./assets/js/option.js"></script>
</body>
</html>
