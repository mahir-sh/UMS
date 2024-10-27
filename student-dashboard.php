<?php
include('header.php');
if(!isset($_SESSION['user'])) {
    header('location: login.php');
    exit;
}
$statement = $pdo->prepare("SELECT * FROM student WHERE id=?");
$statement->execute(array($_SESSION['user']['id']));
$result = $statement->fetchAll(PDO::FETCH_ASSOC);
if($result) {
    foreach ($result as $row) {
        $name = $row['name'];
        $id = $row['id'];
        $batch = $row['batch'];
        $email = $row['email'];
    }
}
?>

<div class="container mt-5">
    <div class="row">
        <div class="col-md-12">
            <h1>Student Dashboard</h1>
            <table class="table table-bordered">
                <tr>
                    <th>Name</th>
                    <th>ID</th>
                    <th>Batch</th>
                    <th>Email</th>
                </tr>
                <tr>
                    <td><?php echo $name; ?></td>
                    <td><?php echo $id; ?></td>
                    <td><?php echo $batch; ?></td>
                    <td><?php echo $email; ?></td>
                </tr>
            </table>
        </div>
    </div>
</div>
?>
