<?php include('header.php'); ?>
<?php include('top.php'); ?>
    <?php
    if(!isset($_SESSION['user'])) {
        header('location: login.php');
        exit;
    }


    if(isset($_POST['search'])) {
        $student_id = $_POST['student_id'];
        $statement = $pdo->prepare("SELECT * FROM student WHERE id=?");
        $statement->execute(array($student_id));
        $result = $statement->fetchAll(PDO::FETCH_ASSOC);
        if($result) {
            foreach ($result as $row) {
                $name = $row['name'];
                $id = $row['id'];
                $batch = $row['batch'];
                $email = $row['email'];
                ?>
                <div class="row">
                    <div class="col-md-12">
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
                <?php
            }
            $statement = $pdo->prepare("SELECT results.id, results.semester_id, results.subject_code, results.result FROM results WHERE student_id=?");
            $statement->execute(array($student_id));
            $result = $statement->fetchAll(PDO::FETCH_ASSOC);
            if($result) {
                ?>
                <div class="row">
                    <div class="col-md-12">
                        <table class="table table-bordered">
                            <tr>
                                <th>Semester ID</th>
                                <th>Subject Code</th>
                                <th>Result</th>
                            </tr>
                            <?php
                            foreach ($result as $row) {
                                ?>
                                <tr>
                                    <td><?php echo $row['semester_id']; ?></td>
                                    <td><?php echo $row['subject_code']; ?></td>
                                    <td><?php echo $row['result']; ?></td>
                                </tr>
                                <?php
                            }
                            ?>
                        </table>
                    </div>
                </div>
                <?php
            }
        }
    }

    ?>

    <br>  <br>
      <div class="col-md-6" style="position: relative; left: 50%; transform: translateX(-50%);">
            <h3 class="text-center" style="color: #4e73df;">Student Information</h3>
            <form action="result-view.php" method="post">
                <div class="form-group" style="border: 1px solid #4e73df; padding: 20px; border-radius: 10px; background-color: #f9f9f9;">
                
                <label for="student_id">Student ID</label>
                    <input type="text" name="student_id" id="student_id" class="form-control" placeholder="Enter Student ID" required style="height: 50px; font-size: 20px;">
                </div>
                <button type="submit" name="search" class="btn btn-primary btn-block" style="position: relative; left: 50%; transform: translateX(-50%); height: 50px; font-size: 20px;">Search</button>
            </form>
        </div>
    

