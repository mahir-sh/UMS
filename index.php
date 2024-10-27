<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Welcome to Student Management Software</title>
    <style>
        * {
            box-sizing: border-box;
            margin: 0;
            padding: 0;
            font-family: Arial, sans-serif;
        }

        body {
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            background-image: url('./images/uni.jpg'); /* Replace with your background image URL */
            background-size: cover;
            background-position: center;
            color: #fff; /* Change text color for better contrast */
        }

        .welcome-container {
            text-align: center;
            padding: 40px;
            background-color: rgba(0, 0, 0, 0.7); /* Semi-transparent background for readability */
            border-radius: 8px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
            max-width: 400px;
            width: 90%;
        }

        h1 {
            font-size: 28px;
            margin-bottom: 20px;
        }

        p {
            font-size: 18px;
            margin-bottom: 30px;
        }

        .button-container {
            display: flex;
            flex-direction: column;
            gap: 15px;
        }

        .button {
            display: flex;
            align-items: center; /* Align logo and text */
            justify-content: center; /* Center the content */
            width: 100%;
            padding: 15px;
            font-size: 18px;
            color: #fff;
            background-color: #007bff;
            text-decoration: none;
            border-radius: 4px;
            transition: background-color 0.3s ease;
        }

        .button:hover {
            background-color: #0056b3;
        }

        .button:active {
            background-color: #004080;
        }

        .button img {
            width: 30px; /* Adjust logo size */
            height: auto;
            margin-right: 10px; /* Space between logo and text */
        }
    </style>
</head>
<body>
    <div class="welcome-container">
        <h1>Welcome to Student Management Software</h1>
        <p>Select your login type to proceed:</p>
        <div class="button-container">
            <a href="student-login.php" class="button">
                Login as Student
            </a>
            <a href="login.php" class="button">
                Login as Admin
            </a>
        </div>
    </div>
</body>
</html>
