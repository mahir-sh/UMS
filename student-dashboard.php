<?php include('header.php'); ?>
<?php include('student-top.php'); ?>

<title>Colorful Student Info Page with Clock</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <style>
        /* Smooth transition for background changes */
        body {
            transition: background-color 0.5s ease-in-out;
        }
    </style>
    <script>
        // JavaScript to change background color on page load and update clock
        document.addEventListener("DOMContentLoaded", function () {
            const colors = ["#FFEDD5", "#D9F99D", "#E0E7FF", "#FECACA", "#C7D2FE"];
            document.body.style.backgroundColor = colors[Math.floor(Math.random() * colors.length)];
            updateClock();
            setInterval(updateClock, 1000);
        });

        function updateClock() {
            const now = new Date();
            const date = now.toLocaleDateString();
            const time = now.toLocaleTimeString();
            document.getElementById("date").innerText = date;
            document.getElementById("time").innerText = time;
        }
    </script>
</head>
<body class="flex items-center justify-center min-h-screen">

    <div class="container mx-auto p-6 bg-white shadow-xl rounded-lg max-w-md text-center">
        <!-- Clock and Date Display -->
        <div class="mb-8">
            <h2 id="date" class="text-xl font-semibold text-gray-500"></h2>
            <h2 id="time" class="text-2xl font-bold text-indigo-600"></h2>
        </div>

        <!-- User Greeting -->
        <div class="text-center mb-8">
            <h1 class="text-4xl font-extrabold text-indigo-600 mb-4">Hello, <?php echo $_SESSION['user']['name']; ?></h1>
            <p class="text-gray-600">Here is your student information</p>
        </div>
        
        <!-- User Information Cards -->
        <div class="space-y-6">
            <!-- Student ID -->
            <div class="p-4 bg-gradient-to-r from-indigo-100 to-blue-200 rounded-lg shadow">
                <h2 class="text-lg font-bold text-indigo-800">Student ID</h2>
                <p class="text-gray-700"><?php echo $_SESSION['user']['student_id']; ?></p>
            </div>

            <!-- Email -->
            <div class="p-4 bg-gradient-to-r from-purple-100 to-pink-200 rounded-lg shadow">
                <h2 class="text-lg font-bold text-purple-800">Email</h2>
                <p class="text-gray-700"><?php echo $_SESSION['user']['email']; ?></p>
            </div>

            <!-- Batch -->
            <div class="p-4 bg-gradient-to-r from-green-100 to-teal-200 rounded-lg shadow">
                <h2 class="text-lg font-bold text-green-800">Batch</h2>
                <p class="text-gray-700"><?php echo $_SESSION['user']['batch']; ?></p>
            </div>

            <!-- Address -->
            <div class="p-4 bg-gradient-to-r from-yellow-100 to-orange-200 rounded-lg shadow">
                <h2 class="text-lg font-bold text-yellow-800">Address</h2>
                <p class="text-gray-700"><?php echo $_SESSION['user']['address']; ?></p>
            </div>
        </div>

          <!-- View Result Button -->
          <form action="student-result.php" method="POST" class="mt-8">
            <input type="hidden" name="student_id" value="<?php echo $_SESSION['user']['student_id']; ?>">
            <button type="submit" class="px-6 py-2 bg-indigo-600 text-white font-semibold rounded-lg shadow hover:bg-indigo-700">
                View Result
            </button>
        </form>

    </div>

</body>