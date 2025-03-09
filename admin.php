<?php require_once('crud_operations.php'); ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <script src="https://cdn.tailwindcss.com"></script>
    <title>Admin</title>
</head>
<body class="bg-[#D0D0D0]" style="height: 100vh;">
<header class="text-white flex flex-col " style="height: 20vh;">
        <h1 class="flex items-center justify-center bg-[#1686C7] uppercase text-xl font-[Verdana]  font-semibold h-[350px] tracking-wide">Voting Management System</h1>
        <form class="flex flex-row gap-2 items-center pl-4" action="" method="post" style="height: 60vh">
            <input id="candidate_name" type="text" name="name" placeholder="Candidate" class="text-gray-800 w-50 h-10 px-4 py-2 border border-gray-700 rounded-md focus:outline-none focus:border-blue-500" required>
            <input id="candidate_id" type="text" name="id" hidden>
            <select id="position"  name="position" class="text-gray-800 w-50 h-10 px-4 py-2 border border-gray-700 rounded-md focus:outline-none focus:border-blue-500">
                <option value="President">President</option>
                <option value="Vice President">Vice President</option>
                <option value="Secretary">Secretary</option>
                <option value="Author">Author</option>
                <option value="Sergeant">Sergeant</option>
            </select>
            <button id="insert" type="submit" name="insert" class="w-[120px] py-[5px] px-2 border border-green-700 bg-green-500 hover:bg-green-700 cursor-pointer shadow-md rounded">Insert</button>
            <button id="update" type="submit" name="update" class="w-[120px] py-[5px] px-2 border border-blue-700 bg-gray-500 hover:bg-gray-700 cursor-not-allowed shadow-md rounded" disabled>Update</button>
        </form>
</header>

<div class="px-4">
    <table class="min-w-full divide-y divide-gray-200 shadow-md rounded-md text-center" style="width:80vw;">
        <thead>
            <tr>
                <th class="px-6 py-3 bg-gray-50  text-xs font-medium text-gray-500 uppercase tracking-wider">Name</th>
                <th class="px-6 py-3 bg-gray-50  text-xs font-medium text-gray-500 uppercase tracking-wider">Position</th>
                <th class="px-6 py-3 bg-gray-50  text-xs font-medium text-gray-500 uppercase tracking-wider">Count</th>
                <th class="px-6 py-3 bg-gray-50  text-xs font-medium text-gray-500 uppercase tracking-wider">Action</th>
            </tr>
        </thead>
        <tbody class="bg-white divide-y divide-gray-200">
            <?php foreach ($voters as $voter): ?>
                <tr>
                    <td class="px-6 py-4 whitespace-nowrap"><?php echo $voter['Name']; ?></td>
                    <td class="px-6 py-4 whitespace-nowrap"><?php echo $voter['Position']; ?></td>
                    <td class="px-6 py-4 whitespace-nowrap"><?php echo $voter['Count']; ?></td>
                    <td class="px-6 py-4 whitespace-nowrap flex flex-row gap-6 justify-center items-center ">
                        <a id="editBtn" href="javascript:void(0);" class="edit-link text-blue-500 hover:text-blue-700" data='<?php echo htmlspecialchars(json_encode($voter), ENT_QUOTES, 'UTF-8'); ?>'><i class="fas fa-edit"></i></a>
                        <a href="?delete=<?php echo $voter['id']; ?>" class="text-red-500 hover:text-red-700 mr-2"><i class="fas fa-trash"></i></a>
                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</div>
    <script src="./footer.js"></script>
</body>
</html>
