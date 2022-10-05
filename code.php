<?php
session_start();
require 'function.php';

if (isset($_POST['delete_note'])) {
    $note_id = mysqli_real_escape_string($conn, $_POST['delete_note']);

    $query = "DELETE FROM note WHERE id='$note_id' ";

    $query_run = mysqli_query($conn, $query);
    if ($query_run) {
        header("Location: welcome.php");
        exit(0);
    } else {
        header("Location: welcome.php");
        exit(0);
    }
}

if (isset($_POST['update_catatan'])) {
    $note_id = mysqli_real_escape_string($conn, $_POST['note_id']);

    $judul = mysqli_real_escape_string($conn, $_POST['judul']);
    $deadline = mysqli_real_escape_string($conn, $_POST['deadline']);
    $catatan = mysqli_real_escape_string($conn, $_POST['catatan']);

    $query = "UPDATE note SET judul='$judul', deadline='$deadline', catatan='$catatan' WHERE id='$note_id' ";

    $query_run = mysqli_query($conn, $query);
    if ($query_run) {
        header("Location: welcome.php");
        exit(0);
    } else {
        header("Location: welcome.php");
        exit(0);
    }
}


if (isset($_POST['save_catatan'])) {
    $judul = mysqli_real_escape_string($conn, $_POST['judul']);
    $deadline = mysqli_real_escape_string($conn, $_POST['deadline']);
    $catatan = mysqli_real_escape_string($conn, $_POST['catatan']);

    $query = "INSERT INTO note (judul,deadline,catatan) VALUES ('$judul','$deadline','$catatan')";

    $query_run = mysqli_query($conn, $query);
    if ($query_run) {
        header("Location: welcome.php");
        exit(0);
    } else {
        header("Location: welcome.php");
        exit(0);
    }
}
