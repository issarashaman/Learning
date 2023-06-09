<?php

    include_once('functions.php');

    if(isset($_GET['id'])) {
        $userid = $_GET['id'];
        $deletedata = new DB_conn();
        $sql = $deletedata->delete($userid);

        if ($sql) {
            echo "<script>alert('Record Deleted Successfully!');</script>";
            echo "<script>window.location.href='index.php';</script>";
        }
    }

?>