<?php

    include_once('functions.php');

    $updateuser = new DB_conn();

    $userid = $_GET['id'];

    $sql = $updateuser->fetchuser($userid);

    if (isset($_POST['update'])) {
        $fname = $_POST['firstname'];
        $lname = $_POST['lastname'];
        $email = $_POST['email'];
        $phonenumber = $_POST['phonenumber'];
        $address = $_POST['address'];

        $sql = $updateuser->update($fname, $lname, $email, $phonenumber, $address, $userid);

        if ($sql) {
            echo "<script>alert('Record Updated Successfully!');</script>";
            echo "<script>window.location.href='index.php';</script>";
        } else {
            echo "<script>alert('Something went wrong!');</script>";
            echo "<script>window.location.href='update.php?id=$userid';</script>";
        }
    }
?>
<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>CRUD OOP</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-9ndCyUaIbzAi2FUVXJi0CjmCapSmO7SnpJef0486qhLnuZ2cdeRhO02iuK6FUUVM" crossorigin="anonymous">
</head>

<body>
    <div class="container">
        <h1 class="mt-5">Update Page</h1>
        <hr>
        <form action="" method="post">
        <?php
            while ($row = mysqli_fetch_array($sql)) {
        ?>
        <div class="mb-3">
            <label for="firstname" class="form-label">First name</label>
            <input type="text" class="form-control" name="firstname" value="<?php echo $row['firstname']; ?>" required>
        </div>
        <div class="mb-3">
            <label for="lastname" class="form-label">Last name</label>
            <input type="text" class="form-control" name="lastname" value="<?php echo $row['lastname']; ?>" required>
        </div>
        <div class="mb-3">
            <label for="email" class="form-label">Email</label>
            <input type="email" class="form-control" name="email" value="<?php echo $row['email']; ?>" required>
        </div>
        <div class="mb-3">
            <label for="phonenumber" class="form-label">Phonenumber</label>
            <input type="text" class="form-control" name="phonenumber" value="<?php echo $row['phonenumber']; ?>" required>
        </div>
        <div class="mb-3">
            <label for="address" class="form-label">Address</label>
            <textarea class="form-control" name="address" rows="3" required><?php echo $row['address']; ?></textarea>
        </div>
        <?php } ?>
        <button class="btn btn-primary" name="update" type="submit">Save</button>
        <a class="btn btn-danger" href="index.php" role="button">Cancel</a>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-geWF76RCwLtnZ8qwWowPQNguL3RmwHVBC9FhGdlKrxdiJJigb/j/68SIy3Te4Bkz" crossorigin="anonymous"></script>
</body>

</html>