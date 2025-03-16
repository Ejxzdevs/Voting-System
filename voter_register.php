<?php 
    require_once 'config/connection.php';
    require_once 'api/voter.php';
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Register - Voting System</title>
  <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-[#1686C7] flex items-center justify-center min-h-screen">

  <div class="w-full max-w-md p-6 bg-white rounded-lg shadow-lg">
    <h2 class="text-3xl font-semibold text-center text-gray-800 mb-6">Voter Registration</h2>
    
    <!-- Registration Instructions -->
    <p class="text-sm text-gray-600 mb-4 text-center">
      Please provide your full name below to register. You need to register first in order to participate in the voting process.
      Your information will be used solely for voting purposes and will not be shared or used for any other reason.
    </p>
    
    <form action="#" method="POST">
      <div class="mb-4">
        <label for="name" class="block text-sm font-medium text-gray-700">Full Name</label>
        <input type="text" id="name" name="voter_name" required class="mt-1 block w-full px-4 py-2 text-gray-800 border border-gray-300 rounded-md focus:ring-indigo-500 focus:border-indigo-500 shadow-sm" placeholder="Enter your full name">
      </div>

    
      <div class="mb-4">
        <p class="text-xs text-gray-500">
          <strong>Note:</strong> Please ensure that your name matches the one on your official identification to avoid registration issues.
        </p>
      </div>

      <div class="flex justify-center">
        <button type="submit" name="add_voter" class="w-full py-2 px-4 bg-blue-600 text-white font-semibold rounded-md hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-opacity-50">
          Register
        </button>
      </div>
    </form>
    

    <div class="mt-4 text-sm text-gray-500 text-center">
      <p>By registering, you confirm that the information provided is accurate and that you are eligible to vote.</p>
    </div>
  </div>

</body>
</html>
