<!DOCTYPE html>
<html lang="en">
<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <!-- Bootstrap Icons -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <!-- Header CSS file -->
    <link type=text/css rel="stylesheet" href="Header.css?version=1">
    <!-- Favicon -->
    <link rel="icon" type="image/png" href="Assets/favicon.png">
    <!-- Icon library for 'close' icon on mobile menu -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <!-- Font -->
    <link href="https://fonts.googleapis.com/css?family=Montserrat" rel="stylesheet">
    <!-- JQuery Library -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <!-- Header JavaScript file -->
    <title>BetterFace</title>
</head>
<body>
<div class="container-fluid">
    <div class="row">
        <!-- Mobile logo, hidden by default -->
        <div class="logo">
            <img id="menu" src="Assets/logo_transparent6.png" alt="logo_menu">
        </div>
        <!-- left side header nav bar -->
        <div class="col" id="links">
            <a href="jobs.php"><span class="hvr-underline-from-center">Jobs</span></a>
            <a href="Under_construction.html"><span class="hvr-underline-from-center">Create</span></a>
            <a href="Under_construction.html"><span class="hvr-underline-from-center">Forum</span></a>
        </div>
        <!-- Logo -->
        <div class="col" id="logo">
            <a href="Header.html"><img src="Assets/logo_transparent6.png" height="100px" width="100px"></a>
        </div>
        <!-- Right side nav and search bar -->
        <div class="col" id="social">
            <input type="text" id="search" name="search" placeholder="Search..">
            <span class="glyphicon glyphicon-cog" id="cog"></span>
            <span class="glyphicon glyphicon-user" id="icons"></span>
            <span class="glyphicon glyphicon-bell" id="icons2"></span>
            <span class="glyphicon glyphicon-envelope" id="icons3"></span>
        </div>
    </div>
    <!-- Mobile menu, hidden by default -->
    <div id="mySidenav" class="sidenav">
        <i id="close" class="fa fa-times-circle-o" aria-hidden="true"></i>
        <a href="Header.html">Home</a>
        <a href="jobs.php">Jobs</a>
        <a href="Under_construction.html">Create</a>
        <a href="Under_construction.html" target="_blank">Forum</a>
    </div>
    <!-- Mobile search bar, hidden by default -->
    <input type="text" id="mobile-search" name="search" placeholder="Search..">
</div>
<script src="Header.js?version=1"></script>
</body>
</html>
