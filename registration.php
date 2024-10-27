<?php include('header.php'); ?>


<?php
if(isset($_SESSION['user'])) {
    header('location: index.php');
    exit;
}
?>

<?php
if(isset($_POST['form_registration'])) {
    try {
        if($_POST['name'] == '') {
            throw new Exception("name can not be empty");
        }
        if($_POST['email'] == '') {
            throw new Exception("Email can not be empty");
        }
        if(!filter_var($_POST['email'],FILTER_VALIDATE_EMAIL)) {
            throw new Exception("Email is invalid");
        }
        if($_POST['password'] == '') {
            throw new Exception("Password can not be empty");
        }
        if(!in_array($_POST['role_id'], [1,2,3,4])) {
            throw new Exception("Role is invalid");
        }
        $q = $pdo->prepare("SELECT * FROM users WHERE email=?");
        $q->execute([$_POST['email']]);
        $total = $q->rowCount();
        if($total) {
            throw new Exception("Email is already registered");
        } else {
            $q = $pdo->prepare("INSERT INTO users (name, email, password, role_id) VALUES (:name, :email, :password, :role_id)");
            $q->execute([
                'name' => $_POST['name'],
                'email' => $_POST['email'],
                'password' => password_hash($_POST['password'], PASSWORD_DEFAULT),
                'role_id' => $_POST['role_id']
            ]);
            header('location: login.php');
            exit;
        }
    } catch (Exception $e) {
        $_SESSION['error_message'] = $e->getMessage();
        header('location: registration.php');
        exit;   
    }
}

?>


<style>
    .container-registration {
        max-width: 500px;
        margin: 100px auto;
        padding: 20px;
        border: 1px solid #eee;
        box-shadow: 0 2px 3px #ccc;
    }

    .form-registration {
        width: 100%;
    }

    .form-registration label {
        display: block;
        margin-bottom: 10px;
    }

    .form-registration input[type="text"],
    .form-registration input[type="email"],
    .form-registration input[type="password"] {
        width: 100%;
        padding: 10px;
        margin-bottom: 20px;
        border: 1px solid #eee;
    }

    .form-registration select {
        width: 100%;
        padding: 10px;
        margin-bottom: 20px;
        border: 1px solid #eee;
    }

    .form-registration button[type="submit"] {
        background-color: #4CAF50;
        color: white;
        padding: 10px 20px;
        border: none;
        border-radius: 5px;
        cursor: pointer;
    }

    .form-registration button[type="submit"]:hover {
        background-color: #45a049;
    }

</style>

<div class="container-registration">
    <form class="form-registration" action="" method="post">
        <h1>Registration</h1>
        <?php
        if(isset($_SESSION['error_message'])) {
            echo '<div class="alert alert-danger" role="alert">'.$_SESSION['error_message'].'</div>';
            unset($_SESSION['error_message']);
        }
        ?>
        <label for="name">name</label>
        <input type="text" name="name" id="name" class="form-control" required>
        <label for="email">Email</label>
        <input type="email" name="email" id="email" class="form-control" required>
        <label for="password">Password</label>
        <input type="password" name="password" id="password" class="form-control" required>
        <label for="role_id">Role</label>
        <select name="role_id" id="role_id" class="form-control" required>
            <option value="">Select Role</option>
            <option value="1">Super Admin</option>
            <option value="2">Admin</option>
            <option value="3">Teacher</option>
            <option value="4">Student</option>
        </select>
        <button type="submit" name="form_registration">Registration</button>
    </form>
    <p style="text-align: left; padding: 2px"><a href="login.php" class="btn btn-secondary">Back to Login</a></p>
</div>


<?php include('footer.php'); ?>
