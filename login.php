<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Login</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" rel="stylesheet">
</head>

<body class="flex items-center justify-center h-screen bg-cover bg-center relative before:absolute before:inset-0 before:bg-black/50" 
    style="background-image: url('voting.jpg');">

    <div class="bg-white bg-opacity-80 backdrop-filter backdrop-blur-lg p-12 rounded-xl shadow-2xl w-full max-w-md relative z-10">
        <div class="text-center mb-8">
            <h1 class="text-3xl font-semibold text-gray-800 mb-2">Voting Management System</h1>
            <h2 class="text-lg text-gray-600">Admin Login</h2>
        </div>

        <form action="./api/user.php" method="POST">
            <div class="relative mb-6">
                <input type="text" id="username" name="username" placeholder="Username"
                    class="w-full p-4 pl-12 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 transition duration-200">
                <i class="fas fa-user absolute left-4 top-1/2 -translate-y-1/2 text-gray-400"></i>
            </div>

            <div class="relative mb-8">
                <input type="password" id="password" name="password" placeholder="Password"
                    class="w-full p-4 pl-12 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 transition duration-200">
                <i class="fas fa-lock absolute left-4 top-1/2 -translate-y-1/2 text-gray-400"></i>
            </div>

            <button type="submit"
                class="w-full py-3 bg-blue-600 text-white rounded-lg hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-500 transition duration-200">
                Login
            </button>
        </form>

        <div class="mt-6 text-center">
            <a href="#" class="text-sm text-gray-500 hover:underline">Forgot Password?</a>
        </div>
    </div>

</body>

</html>