<?php 
    require_once 'connection.php';
    require_once 'http.php';
    require_once 'candidates_service.php';
    require_once 'positions_service.php';
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <script src="https://cdn.tailwindcss.com"></script>
    <title>Admin/Candidates</title>
</head>
<body class="bg-[#1686C7]">
<div class="text-white flex flex-col ">
        <label class="flex items-center justify-center bg-[#1686C7]  uppercase text-[18px] font-[Verdana]  font-semibold h-[50px] tracking-wide">Voting Management System</label>
        <div class="bg-[#E5E6E6] h-[50px] flex flex-row w-[98%] ms-4 rounded-sm ">
            <div class="flex flex-row gap-2 ps-5 items-center w-[50%]">
                <?php require_once 'route.php'; ?>
            </div>
            <div class="flex flex-row gap-5 ps-5 items-center justify-end w-[50%] pe-6 text-gray-500 text-[16px]">
                <?php require_once 'options.php'; ?>
            </div>
        </div>
        <form class="flex flex-row gap-2 items-center pl-9 font-semibold h-[60px] " action="" method="post" enctype="multipart/form-data">
            <img id="previewImage" class="border border-gray-700 shadow-md rounded-sm h-[40px] w-[50px] " src="" hidden> 
            <label id="imageLabel" for="imageInput" class="border border-green-700 bg-green-500 hover:bg-green-700 px-2 h-9 flex justify-center items-center rounded-md shadow-md text-white cursor-pointer bg-[#D3D3D3] hover:bg-blue-500">Upload Image</label>
            <input onchange="ImagePreview(this)" id="imageInput" type="file" name="image" hidden required>
            <input id="candidate_name" type="text" name="name" placeholder="Candidate" class="text-gray-800 w-45 h-9 px-3 py-1 border border-gray-700 rounded-md focus:outline-none focus:border-blue-500 " required>
            <input id="candidate_id" type="text" name="id" hidden>
            <select id="position_id"  name="position_id" class="text-gray-800 w-40 h-9 px-4 py-1 border border-gray-700 rounded-md focus:outline-none focus:border-blue-500">
                <?php foreach($positions as $position):?>
                    <option value="<?php echo $position['position_id']; ?>"><?php echo $position['position_name']; ?></option>
                <?php endforeach; ?>
            </select>
            <button id="insert" type="submit" name="insert" class="w-[90px] h-9 px-2 border border-blue-700 bg-blue-500 hover:bg-blue-700 cursor-pointer shadow-md rounded ">Insert</button>
            <button id="cancel" type="submit" class="w-[90px] h-9 px-2 border border-red-700 bg-red-500 hover:bg-red-700 cursor-pointer shadow-md rounded" hidden>Cancel</button>
            <button id="update" type="submit" name="update" class="w-[90px] h-9 px-2 border border-blue-700 bg-gray-500 hover:bg-gray-700 cursor-not-allowed shadow-md rounded" disabled>Update</button>
        </form>
</div>

<div class="px-4  bg-[#1686C7]  ">
    <table class="min-w-[97vw] divide-y divide-gray-200 shadow-md rounded-md text-center">
        <thead>
            <tr>
                <th class="px-6 py-3 bg-gray-50  text-xs font-medium text-gray-500 uppercase tracking-wider">Images</th>
                <th class="px-6 py-3 bg-gray-50  text-xs font-medium text-gray-500 uppercase tracking-wider">Name</th>
                <th class="px-6 py-3 bg-gray-50  text-xs font-medium text-gray-500 uppercase tracking-wider">Position</th>
                <th class="px-6 py-3 bg-gray-50  text-xs font-medium text-gray-500 uppercase tracking-wider">Count</th>
                <th class="px-6 py-3 bg-gray-50  text-xs font-medium text-gray-500 uppercase tracking-wider">Action</th>
            </tr>
        </thead>
        <tbody class="bg-white divide-y divide-gray-200">
            <?php foreach ($candidates as $candidate): ?>
                <tr>
                    <td class="px-6 py-4 whitespace-nowrap flex justify-center items-center ">
                       <img class="shadow-md rounded-md h-[40px] w-[50px]" src="<?php echo $candidate['image_url']; ?>" alt="<?php echo $candidate['image_url']; ?>"> 
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap"><?php echo $candidate['Name']; ?></td>
                    <td class="px-6 py-4 whitespace-nowrap"><?php echo $candidate['position_name']; ?></td>
                    <td class="px-6 py-4 whitespace-nowrap"><?php echo $candidate['Count']; ?></td>
                    <td class="px-6 py-4 whitespace-nowrap flex flex-row gap-6 justify-center items-center ">
                        <a id="editBtn" href="javascript:void(0);" class="edit-link text-blue-500 hover:text-blue-700" data='<?php echo htmlspecialchars(json_encode($candidate), ENT_QUOTES, 'UTF-8'); ?>'><i class="fas fa-edit"></i></a>
                        <a href="?delete=<?php echo $candidate['id']; ?>" class="text-red-500 hover:text-red-700 mr-2"><i class="fas fa-trash"></i></a>
                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</div>
    <script src="./footer.js"></script>
</body>
</html>
