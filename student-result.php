<?php include('header.php'); ?>
<?php include('student-top.php'); ?>

<?php
if (!isset($_SESSION['user'])) {
    header('location: login.php');
    exit;
}

if (isset($_POST['student_id'])) {
    $student_id = $_POST['student_id'];
} else {
    header('location: student-view.php');
    exit;
}

$statement = $pdo->prepare("SELECT 
    results.student_id, 
    results.semester_id, 
    results.subject_code, 
    results.result, 
    student.name, 
    student.student_id AS id, 
    student.batch, 
    student.address, 
    student.department 
FROM 
    results 
JOIN 
    student ON results.student_id = student.student_id 
WHERE 
    results.student_id = ?");
$statement->execute(array($student_id));

$result = $statement->fetchAll(PDO::FETCH_ASSOC);

if ($result) {
    $student_info = $result[0];
?>

<style>
    .student-info {
        background-color: #f9f9f9;
        border: 1px solid #ddd;
        padding: 15px;
        margin-bottom: 20px;
        border-radius: 5px;
    }

    .student-info h2, .result-table h3 {
        color: #333;
        border-bottom: 2px solid #ddd;
        padding-bottom: 8px;
        margin-bottom: 15px;
    }

    .student-info p {
        font-size: 16px;
        color: #555;
        margin: 5px 0;
    }

    .result-table .table {
        background-color: #f9f9f9;
        margin-bottom: 0;
    }

    .result-table .table thead th {
        background-color: #333;
        color: black;
        text-align: center;
    }

    .result-table .table td {
        text-align: center;
        vertical-align: middle;
    }

    .result-table button {
        color: white;
        background-color: #007bff;
        margin: 2px;
    }
</style>

<div class="student-info" style="position: relative; left: 50%; transform: translateX(-50%);">
    <h2>Student Information</h2>
    <p><strong>Name:</strong> <?php echo $student_info['name']; ?></p>
    <p><strong>ID:</strong> <?php echo $student_info['id']; ?></p>
    <p><strong>Batch:</strong> <?php echo $student_info['batch']; ?></p>
    <p><strong>Address:</strong> <?php echo $student_info['address']; ?></p>
    <p><strong>Department:</strong> <?php echo $student_info['department']; ?></p>
</div>
<div class="result-table">
    <h3>Semester Results</h3>
    <table class="table table-bordered">
        <thead>
            <tr>
                <th>Semester ID</th>
                <th>Subject Code</th>
                <th>Result</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($result as $row): ?>
                <tr id="row-<?php echo $row['student_id']; ?>-<?php echo $row['semester_id']; ?>-<?php echo $row['subject_code']; ?>">
                    <td><?php echo $row['semester_id']; ?></td>
                    <td><?php echo $row['subject_code']; ?></td>
                    <td>
                        <input type="text" name="result" value="<?php echo $row['result']; ?>" id="result-<?php echo $row['student_id']; ?>-<?php echo $row['semester_id']; ?>-<?php echo $row['subject_code']; ?>" disabled />
                    </td>
                    <td>
                        <button type="button" onclick="enableEdit('<?php echo $row['student_id']; ?>', '<?php echo $row['semester_id']; ?>', '<?php echo $row['subject_code']; ?>')">Edit</button>
                        <button type="button" onclick="saveResult('<?php echo $row['student_id']; ?>', '<?php echo $row['semester_id']; ?>', '<?php echo $row['subject_code']; ?>')" id="save-<?php echo $row['student_id']; ?>-<?php echo $row['semester_id']; ?>-<?php echo $row['subject_code']; ?>" disabled>Save</button>
                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</div>

<script>
    function enableEdit(studentId, semesterId, subjectCode) {
        const resultInput = document.getElementById(`result-${studentId}-${semesterId}-${subjectCode}`);
        const saveButton = document.getElementById(`save-${studentId}-${semesterId}-${subjectCode}`);
        
        resultInput.disabled = false;
        saveButton.disabled = false;
    }

    function saveResult(studentId, semesterId, subjectCode) {
        const resultInput = document.getElementById(`result-${studentId}-${semesterId}-${subjectCode}`);
        const resultValue = resultInput.value;
        const saveButton = document.getElementById(`save-${studentId}-${semesterId}-${subjectCode}`);
        
        saveButton.disabled = true;

        const xhr = new XMLHttpRequest();
        xhr.open("POST", "result-view.php", true);
        xhr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
        
        xhr.onreadystatechange = function () {
            if (xhr.readyState === 4 && xhr.status === 200) {
                if (xhr.responseText.trim() === "success") {
                    alert("Result updated successfully!");
                    resultInput.disabled = true;
                } else {
                    alert("Failed to update result: " + xhr.responseText);
                    saveButton.disabled = false;
                }
            }
        };

        xhr.send(`action=update&student_id=${studentId}&semester_id=${semesterId}&subject_code=${subjectCode}&result=${resultValue}`);
    }
</script>

<?php
} else {
    echo "No results found.";
}

// Handle AJAX update request
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['action']) && $_POST['action'] === 'update') {
    $student_id = $_POST['student_id'];
    $semester_id = $_POST['semester_id'];
    $subject_code = $_POST['subject_code'];
    $result = $_POST['result'];

    $statement = $pdo->prepare("UPDATE results SET result = ? WHERE student_id = ? AND semester_id = ? AND subject_code = ?");
    
    try {
        $statement->execute([$result, $student_id, $semester_id, $subject_code]);
        echo "success";
    } catch (PDOException $e) {
        echo "Error: " . $e->getMessage();
    }
    exit;
}
?>

<?php include('footer.php'); ?>
