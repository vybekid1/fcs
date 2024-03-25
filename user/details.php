<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo $_GET['title']; ?></title>
    </style>
</head>
<style>
    body {
        background: #afabd4;
        width: 100%;
    }

    .container {
        align-self: center;
        padding: 20px 50px;
        width: max-content;
    }

    h1 {
        font-size: 44px;
        align-self: center;
    }

    .user_details{
        margin-top: -40px;
        width: auto;
        display: flex;
        align-items: center;
        padding: 10px;
        justify-content: space-between;
    }
</style>

<body>
    <div class="container">
        <?php
        require '../db/db.php';

        $id = $_GET['id'];
        $title = $_GET['title'];

        $askdetails = $conn->query("SELECT * FROM jobs where id ='$id'");

        if ($askdetails->num_rows > 0) {
            while ($details = $askdetails->fetch_assoc()) {

        ?>
                <div class="job-row">
                    <div class="title">
                        <h1>
                            <?php echo $details['title'];
                            ?>
                        </h1>
                    </div>
                    <div class="user_details">
                        <h4>By
                            <?php
                            $userid = $details['user_id'];
                            $askname = $conn->query("SELECT * FROM users WHERE id='$userid' ");
                            if ($askname->num_rows > 0) {
                                $name = $askname->fetch_assoc();
                            }
                            ?>
                            <?php echo $name['fullName'];
                            ?>
                        </h4>
                        <h4>
                            <?php echo "KSH " . $details['price'];
                            ?>
                        </h4>
                    </div>
                    <p>
                        <?php echo $details['details']; ?>
                    </p>
                </div>
        <?php }
        } ?>
    </div>
</body>

</html>