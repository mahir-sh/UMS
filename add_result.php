<?php include('header.php'); ?>
<?php include('top.php'); ?>
    <?php
    if(!isset($_SESSION['user'])) {
        header('location: login.php');
        exit;
    }
   
if(isset($_POST['form_result'])) {
    $semester_id = $_POST['semester_id'];
    $student_id = $_POST['student_id'];
    $subject_code = $_POST['subject_code'];
    $result = $_POST['result'];

    // Validate required fields
    if(empty($semester_id) || empty($student_id) || empty($subject_code) || empty($result)) {
        $_SESSION['error_message'] = "All fields are required";
    } else {
        // Store data in results table
        $statement = $pdo->prepare("INSERT INTO results (semester_id, student_id, subject_code, result) VALUES (?,?,?,?)");
        $statement->execute(array($semester_id, $student_id, $subject_code, $result));

        $_SESSION['success_message'] = "Result has been added successfully";
        header('location: add_result.php');
        exit;
    }
}

if(isset($_SESSION['success_message'])) {
    echo '<div class="alert alert-success" role="alert">'.$_SESSION['success_message'].'</div>';
    unset($_SESSION['success_message']);
}

if(isset($_SESSION['error_message'])) {
    echo '<div class="alert alert-danger" role="alert">'.$_SESSION['error_message'].'</div>';
    unset($_SESSION['error_message']);
}
?>

<form class="form-result" action="" method="post">
    <h1>Add Result</h1>
    <label for="semester_id">Semester ID</label>
    <input type="text" name="semester_id" id="semester_id" class="form-control" required><br>
    <label for="student_id">Student ID</label>
    <input type="text" name="student_id" id="student_id" class="form-control" required><br>
    <label for="subject_code">Subject Code</label>
    <input type="text" name="subject_code" id="subject_code" class="form-control" required><br>
    <label for="result">Result</label>
    <input type="text" name="result" id="result" class="form-control" required><br>
    <button type="submit" name="form_result">Add Result</button>
</form>

<style>
    .form-result {
        max-width: 600px;
        margin: 50px auto;
        padding: 30px;
        border-radius: 8px;
        background-color: #f9f9f9;
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
    }

    .form-result h1 {
        text-align: center;
        color: #4e73df;
        margin-bottom: 20px;
    }

    .form-result label {
        display: block;
        margin-bottom: 8px;
        font-weight: bold;
        color: #333;
    }

    .form-result input[type="text"] {
        width: 100%;
        padding: 10px;
        margin-bottom: 15px;
        border: 1px solid #ccc;
        border-radius: 4px;
        font-size: 14px;
    }

    .form-result button[type="submit"] {
        width: 100%;
        padding: 12px;
        background-color: #4e73df;
        color: white;
        border: none;
        border-radius: 5px;
        cursor: pointer;
        font-size: 16px;
    }

    .form-result button[type="submit"]:hover {
        background-color: #3a5bbf;
    }
</style>
