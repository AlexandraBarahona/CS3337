
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <script type="text/javascript" src="https://unpkg.com/dropzone@5/dist/min/dropzone.min.js"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ho+j7jyWK8fNQe+A12Hb8AhRq26LrZ/JpcUGGOn+Y7RsweNrtN/tE3MoK7ZeZDyx" crossorigin="anonymous"></script> 
    <link rel="stylesheet" href="https://unpkg.com/dropzone@5/dist/min/dropzone.min.css" type="text/css" />
    <link rel="stylesheet" type="text/css" href="public/css/style.css?version=<%= Common.GetVersion%" /> 
    <link rel="shortcut icon" href="public/cat.png" type="image/x-icon">
    <title><?php echo $title; ?></title>
</head>
<body>
<!-- Dylan- I Added the navbar into the header file to remove clutter from view pages. 
    By adding the following line to the index function of each controller it can be 
    decided if you want the navbar to be visible    
    $data['showNavbar'] = true; 
-->
<?php if (isset($showNavbar) && $showNavbar): ?>
    <?php
$current_page = basename($_SERVER['REQUEST_URI'], ".php");
?>

<nav class="navbar navbar-expand-lg navbar-light bg-light">
    <a class="navbar-brand" href="#"> </a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarText" aria-controls="navbarText" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>
    <img src="public/cat.png" alt="Cat" style="width: 70px; height: auto;">
    <div class="collapse navbar-collapse" id="navbarText">
        <ul class="navbar-nav mr-auto ">
            <li class="nav-item <?php if($current_page == 'home') {echo 'active';} ?>">
                <a class="nav-link" href="/home">Home</a>
            </li>
            <li class="nav-item <?php if($current_page == 'image') {echo 'active';} ?>">
                <a class="nav-link" href="/image">Image</a>
            </li>
            <li class="nav-item <?php if($current_page == 'audioPage') {echo 'active';} ?>">
                <a class="nav-link" href="/audioPage">Audio</a>
            </li>
            <li class="nav-item <?php if($current_page == 'videoPage') {echo 'active';} ?>">
                <a class="nav-link" href="videoPage">Video</a>
            </li>
        </ul>
    </div>
    <a class="nav-item nav-link px-5 " href="/logout">Logout</a>
</nav>

<?php endif; ?>

