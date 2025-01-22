<?php
    session_start();

    if(!isset($_SESSION['logged_in']) || $_SESSION['logged_in'] === false) {
        header("Location: login.php");
        exit(); // Always call exit after redirect
    }
    // var_dump($_SESSION['email']);

    include './config/db.php';
    ?>

    <!DOCTYPE html>
    <html lang="en">

    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Document</title>

        <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
        <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
        <link href="https://cdn.jsdelivr.net/npm/remixicon@4.3.0/fonts/remixicon.css" rel="stylesheet" />
    </head>

    <body>