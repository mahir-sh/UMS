<?php
$arr = [1 => 1, 5 => 1, 6 => 1, 7 => 1, 8 => 1]; // Example data for demonstration
?>

<nav id="sidebarMenu" class="col-md-3 col-lg-3 d-md-block bg-light sidebar collapse">
    <div class="position-sticky pt-3 sidebar-sticky">
        <ul class="nav flex-column">

            <li class="nav-item">
                <a class="nav-link" aria-current="page" href="index.php">
                    <span data-feather="home" class="align-text-bottom"></span>
                    Dashboard
                </a>
            </li>

            <?php if($arr[1] == 1): ?>
            <li class="nav-item">
                <a class="nav-link" href="feature-view.php">
                    <span data-feather="file-text" class="align-text-bottom"></span>
                    Features
                </a>
            </li>
            <?php endif; ?>

            <?php if($arr[5] == 1): ?>
            <li class="nav-item">
                <a class="nav-link" href="role-view.php">
                    <span data-feather="file-text" class="align-text-bottom"></span>
                    Roles
                </a>
            </li>
            <?php endif; ?>

            <?php if($arr[6] == 1): ?>
            <li class="nav-item">
                <a class="nav-link" href="student.php">
                    <span data-feather="file-text" class="align-text-bottom"></span>
                    Add Student
                </a>
            </li>
            <?php endif; ?>

            <?php if($arr[7] == 1): ?>
            <li class="nav-item">
                <a class="nav-link" href="add_result.php">
                    <span data-feather="file-text" class="align-text-bottom"></span>
                    Add Result
                </a>
            </li>
            <?php endif; ?>

            <?php if($arr[7] == 1): ?>
            <li class="nav-item">
                <a class="nav-link" href="student-view.php">
                    <span data-feather="file-text" class="align-text-bottom"></span>
                     Student View
                </a>
            </li>
            <?php endif; ?>

        </ul>
    </div>
</nav>