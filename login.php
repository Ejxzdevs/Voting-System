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

    <div class="bg-white/40 backdrop-blur-lg p-10 rounded-lg shadow-lg w-full max-w-md relative z-10">
        <h1 class="text-3xl font-semibold text-center text-white mb-4">Voting Management System</h1>
        <h2 class="text-xl text-center text-white mb-6">Welcome, Admin!</h2>

        <form action="./api/user.php" method="POST">
            <div class="relative mb-6">
                <input type="text" id="username" name="username" placeholder="Username"
                    class="w-full p-4 pl-12 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition duration-200 bg-white/40 backdrop-blur-md">
                <i class="fas fa-user absolute left-4 top-1/2 -translate-y-1/2 text-gray-400"></i>
            </div>

            <div class="relative mb-6">
                <input type="password" id="password" name="password" placeholder="Password"
                    class="w-full p-4 pl-12 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition duration-200 bg-white/40 backdrop-blur-md">
                <i class="fas fa-lock absolute left-4 top-1/2 -translate-y-1/2 text-gray-400"></i>
            </div>

            <button type="submit"
                class="w-full py-3 bg-blue-500 text-white rounded-md hover:bg-blue-600 focus:outline-none focus:ring-2 focus:ring-blue-500 transition duration-200">
                Login
            </button>
        </form>
    </div>

</body>

</html>
