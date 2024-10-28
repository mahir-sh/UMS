<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Top Bar</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100">

    <!-- Top Bar -->
    <div class="w-full bg-indigo-600 p-4 flex justify-between items-center shadow-lg">
        <!-- User Name Display -->
        <div class="text-white text-lg font-semibold">
            Welcome, <?php echo $_SESSION['user']['name']; ?>
        </div>

        <!-- Logout Button -->
        <form action="logout.php" method="POST">
            <button type="submit" class="px-4 py-2 bg-red-500 text-white rounded-lg hover:bg-red-600 font-semibold">
                Logout
            </button>
        </form>
    </div>

</body>
</html>
