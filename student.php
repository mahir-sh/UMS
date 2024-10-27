<?php include('header.php'); ?>
<?php include('top.php'); ?>

    <?php
    if(!isset($_SESSION['user'])) {
        header('location: login.php');
        exit;
    }
   
    if(isset($_POST['form_student'])) {
        $name = $_POST['name'];
        $batch = $_POST['batch'];
        $id = $_POST['id'];
        $address = $_POST['address'];
        $department = $_POST['department'];

        $statement = $pdo->prepare("INSERT INTO student (name, batch, id, address, department) VALUES (?,?,?,?,?)");
        $statement->execute(array($name, $batch, $id, $address, $department));

        $_SESSION['success_message'] = "Student has been added successfully";
        header('location: student.php');
        exit;
    }

    if(isset($_SESSION['success_message'])) {
        echo '<div class="alert alert-success" role="alert">'.$_SESSION['success_message'].'</div>';
        unset($_SESSION['success_message']);
    }
    ?>
    <form class="form-student" action="" method="post">
        <h1>Add Student</h1>
        <label for="name">Name</label>
        <input type="text" name="name" id="name" class="form-control" required><br>
        <label for="batch">Batch</label>
        <input type="text" name="batch" id="batch" class="form-control" required><br>
        <label for="id">ID</label>
        <input type="text" name="id" id="id" class="form-control" required><br>
        <label for="address">Address</label>
        <textarea name="address" id="address" class="form-control" required></textarea><br>
        <label for="department">Department</label>
        <select name="department" id="department" class="form-control" required>
            <option value="">Select Department</option>
            <option value="CSE">CSE</option>
            <option value="EEE">EEE</option>
            <option value="ME">ME</option>
            <option value="CE">CE</option>
        </select><br>
        <button type="submit" name="form_student">Add</button>
    </form>
<style>
    .form-student {
        max-width: 600px;
        margin: 50px auto;
        padding: 30px;
        border-radius: 8px;
        background-color: #f9f9f9;
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
    }

    .form-student h1 {
        text-align: center;
        color: #4e73df;
        margin-bottom: 20px;
    }

    .form-student label {
        display: block;
        margin-bottom: 8px;
        font-weight: bold;
        color: #333;
    }

    .form-student input[type="text"],
    .form-student textarea,
    .form-student select {
        width: 100%;
        padding: 10px;
        margin-bottom: 15px;
        border: 1px solid #ccc;
        border-radius: 4px;
        font-size: 14px;
    }

    .form-student button[type="submit"] {
        width: 100%;
        padding: 12px;
        background-color: #4e73df;
        color: white;
        border: none;
        border-radius: 5px;
        cursor: pointer;
        font-size: 16px;
    }

    .form-student button[type="submit"]:hover {
        background-color: #3a5bbf;
    }

    .alert-success {
        margin: 20px auto;
        padding: 15px;
        border-radius: 5px;
        color: #155724;
        background-color: #d4edda;
        border-color: #c3e6cb;
        text-align: center;
    }
</style>

<?php include('footer.php'); ?>
