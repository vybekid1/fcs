<?php
session_start();
if (!isset($_SESSION['freelancer'])) {
    header('location:../auth/login.php');
}

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>FCS- Freelancer Dashboard</title>
    <link rel="stylesheet" href="assets/css/main.css">
</head>

<body>
    <div class="container">
        <section class="sidebar">
            <div class="logo">
                <img src="../assets/images/logo.png" alt="fcs-logo">
            </div>
            <div class="nav">
                <a href="#pending"><ion-icon name="reload-circle-outline"></ion-icon><span>Pending Tasks</span></a>
                <a href="#awaiting"><ion-icon name="reload-circle-outline"></ion-icon><span>Awaiting Tasks</span></a>
                <a href="#completed"><ion-icon name="checkmark-done-circle-outline"></ion-icon><span>Completed Tasks</span></a>
                <div class="hidden">
                    ggggg
                </div>
                <div class="profile">
                    <a href="profile.php?username=<?php echo $_SESSION['username']; ?>&id=<?php echo $_SESSION['freelancer']; ?>"><ion-icon name="person-circle-outline"></ion-icon><span>Profile</span></a>
                </div>
            </div>
        </section>
        <div class="mainbar">
            <section id="pending" class="section">
                <div class="title">
                    <h1>Pending Tasks</h1>

                    <?php

                    if (isset($_GET['status'])) {
                        $status = $_GET['status'];
                        if ($status = 'success') {
                            $message = $_GET['message'];
                            echo "<span>$message</span>";
                        }
                    } else {
                    }
                    ?>
                    <?php
                    require '../db/db.php';
                    $fid = $_SESSION['freelancer'];
                    $total = $conn->query("SELECT COUNT(*) as total FROM tasks WHERE status ='pending' AND fid = '$fid'");
                    if ($total->num_rows > 0) {
                        // Fetch the result as an associative array
                        $row = $total->fetch_assoc();
                    }
                    ?>
                    <h4>You Have (<?php echo $row['total']; ?>) pending tasks</h4>
                    <div class="cards">
                        <?php
                        $fid = $_SESSION['freelancer'];
                        $asktasks = $conn->query("SELECT * FROM tasks WHERE fid='$fid' AND status='pending'");
                        if ($asktasks->num_rows > 0) {
                            while ($task = $asktasks->fetch_assoc()) { ?>

                                <div class="card">
                                    <div class="card_title">
                                        <h3><?php echo $task['title']; ?></h3>
                                    </div>
                                    <div class="sender">
                                        <?php
                                        $senderid = $task['uid'];
                                        $senders = $conn->query("SELECT * FROM users WHERE id='$senderid'");
                                        if ($senders->num_rows > 0) {
                                            $sender = $senders->fetch_assoc();
                                        }
                                        ?>
                                        <h6>Sender Details</h6>
                                        <p>
                                            <?php echo $sender['fullName']; ?>
                                        </p>
                                        <p>
                                            <?php echo $sender['email']; ?>
                                        </p>
                                    </div>
                                    <form action="../db/auth.php?taskid=<?php echo $task['id']; ?>" method="post">
                                        <input class="button" type="submit" name="complete" value="COMPLETE">
                                    </form>
                                </div>

                        <?php }
                        } ?>
                    </div>

                </div>
            </section>
            <section id="awaiting" class="section">
                <div class="title">
                    <h1>Awaiting User Approval</h1>
                    <?php
                    require '../db/db.php';
                    $fid = $_SESSION['freelancer'];
                    $total = $conn->query("SELECT COUNT(*) as total FROM tasks WHERE status ='completed'AND user_status='awaiting' AND fid = '$fid'");
                    if ($total->num_rows > 0) {
                        // Fetch the result as an associative array
                        $row = $total->fetch_assoc();
                    }
                    ?>
                    <h4>You Have (<?php echo $row['total']; ?>) tasks awaiting user Approval</h4>
                    <div class="cards">
                        <?php
                        $fid = $_SESSION['freelancer'];
                        $asktasks = $conn->query("SELECT * FROM tasks WHERE fid='$fid' AND status='completed' AND user_status='awaiting'");
                        if ($asktasks->num_rows > 0) {
                            while ($task = $asktasks->fetch_assoc()) { ?>

                                <div class="card">
                                    <div class="card_title">
                                        <h3><?php echo $task['title']; ?></h3>
                                    </div>
                                    <div class="sender">
                                        <?php
                                        $senderid = $task['uid'];
                                        $senders = $conn->query("SELECT * FROM users WHERE id='$senderid'");
                                        if ($senders->num_rows > 0) {
                                            $sender = $senders->fetch_assoc();
                                        }
                                        ?>
                                        <h6>Sender Details</h6>
                                        <p>
                                            <?php echo $sender['fullName']; ?>
                                        </p>
                                        <p>
                                            <?php echo $sender['email']; ?>
                                        </p>
                                    </div>
                                    <form action="../db/auth.php?taskid=<?php echo $task['id']; ?>" method="post">
                                        <input class="button" type="submit" name="undo" value="UNDO">
                                    </form>
                                </div>

                        <?php }
                        } ?>
                    </div>

                </div>
            </section>
            <section id="completed" class="section">
                <h1>Completed Tasks</h1>
                <?php
                require '../db/db.php';
                $fid = $_SESSION['freelancer'];
                $total = $conn->query("SELECT COUNT(*) as total_rows FROM tasks WHERE fid='$fid' AND status ='completed' AND user_status='approved'");
                if ($total->num_rows > 0) {
                    // Fetch the result as an associative array
                    $row = $total->fetch_assoc();
                } ?>
                <h4>You Have (<?php echo $row['total_rows']; ?>) completed task(s)</h4>
                <br>
                <div class="cards">
                    <?php

                    $fid = $_SESSION['freelancer'];
                    $asktasks = $conn->query("SELECT * FROM tasks WHERE fid='$fid' AND status='completed' AND user_status='approved'");
                    if ($asktasks->num_rows > 0) {
                        while ($task = $asktasks->fetch_assoc()) { ?>
                            <div class="card">
                                <div class="card_title">
                                    <h3><?php echo $task['title']; ?></h3>
                                </div>
                                <div class="sender">
                                    <?php
                                    $senderid = $task['uid'];
                                    $senders = $conn->query("SELECT * FROM users WHERE id='$senderid'");
                                    if ($senders->num_rows > 0) {
                                        $sender = $senders->fetch_assoc();
                                    }
                                    ?>
                                    <h6>Sender Details</h6>
                                    <p>
                                        <?php echo $sender['fullName']; ?>
                                    </p>
                                    <p>
                                        <?php echo $sender['email']; ?>
                                    </p>
                                </div>
                            </div>

                    <?php }
                    } ?>
                </div>
        </div>
    </div>

    <script type="module" src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.esm.js"></script>
    <script nomodule src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.js"></script>
</body>

</html>