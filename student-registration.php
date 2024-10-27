<?php

include('header.php');



// Redirect if user is already logged in


// Form submission handling
if (isset($_POST['form_register'])) {
    try {
        // Validation
        if (empty($_POST['name'])) throw new Exception("Name cannot be empty");
        if (empty($_POST['batch'])) throw new Exception("Batch cannot be empty");
        if (empty($_POST['address'])) throw new Exception("Address cannot be empty");
        if (empty($_POST['department'])) throw new Exception("Department cannot be empty");
        if (empty($_POST['email'])) throw new Exception("Email cannot be empty");
        if (!filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)) throw new Exception("Email is invalid");
        if (empty($_POST['password'])) throw new Exception("Password cannot be empty");

        // Check if email already exists
        $stmt = $pdo->prepare("SELECT * FROM student WHERE email = ?");
        $stmt->execute([$_POST['email']]);
        if ($stmt->rowCount() > 0) throw new Exception("Email already exists");

        // Generate Student ID
        $batch_id = $_POST['batch'];
        $department_id = $_POST['department'];
        $random_number = str_pad(rand(0, 9999), 4, '0', STR_PAD_LEFT);
        $student_id = $department_id . $batch_id . $random_number;

        // Insert new student
        $hashed_password = password_hash($_POST['password'], PASSWORD_DEFAULT);
        $stmt = $pdo->prepare("INSERT INTO student (student_id, name, batch, address, department, email, password) VALUES (?, ?, ?, ?, ?, ?, ?)");
        $stmt->execute([
            $student_id,
            $_POST['name'],
            $_POST['batch'],
            $_POST['address'],
            $_POST['department'],
            $_POST['email'],
            $hashed_password
        ]);

        // Redirect to login page after successful registration
        header('Location: student-login.php');
        exit;
    } catch (Exception $e) {
        $error_message = $e->getMessage();
        $_SESSION['error_message'] = $error_message;
    }
}
?>

<div class="container">
    <div class="row justify-content-center mt-5">
        <div class="col-md-8 col-lg-6">
            <div class="card">
                <div class="card-header text-center">
                    <h2>Register Student</h2>
                </div>
                <div class="card-body">
                    <?php
                    if (isset($_SESSION['error_message'])) {
                        echo '<div class="alert alert-danger" role="alert">' . $_SESSION['error_message'] . '</div>';
                        unset($_SESSION['error_message']);
                    }
                    ?>
                    <form action="" method="post">
                        <div class="mb-3">
                            <label for="floatingName" class="form-label">Name</label>
                            <input type="text" name="name" class="form-control" id="floatingName" placeholder="Name" required>
                        </div>
                        <div class="mb-3">
                            <label for="floatingBatch" class="form-label">Batch</label>
                            <input type="text" name="batch" class="form-control" id="floatingBatch" placeholder="Batch" required>
                        </div>
                        <div class="mb-3">
                            <label for="floatingAddress" class="form-label">Address</label>
                            <input type="text" name="address" class="form-control" id="floatingAddress" placeholder="Address" required>
                        </div>
                        <div class="mb-3">
                            <label for="floatingDepartment" class="form-label">Department</label>
                            <select name="department" id="floatingDepartment" class="form-control" required>
                                <option value="">Select Department</option>
                                <option value="121">EEE</option>
                                <option value="111">CSE</option>
                                <option value="124">BBA</option>
                                <option value="187">MBA</option>
                            </select>
                        </div>
                        <div class="mb-3">
                            <label for="floatingEmail" class="form-label">Email address</label>
                            <input type="email" name="email" class="form-control" id="floatingEmail" placeholder="name@example.com" required>
                        </div>
                        <div class="mb-3">
                            <label for="floatingPassword" class="form-label">Password</label>
                            <input type="password" name="password" class="form-control" id="floatingPassword" placeholder="Password" required>
                        </div>
                        <button class="btn btn-primary w-100" type="submit" name="form_register">Register</button>
                    </form>
                    <p class="mt-3 mb-0 text-center">Already have an account? <a href="student-login.php" class="text-decoration-none">Login here</a></p>
                </div>
            </div>
        </div>
    </div>
</div>

<?php include('footer.php'); ?>
