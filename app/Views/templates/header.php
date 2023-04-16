<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <script src="public/javascript/dropzone.min.js"></script>
    <link rel="stylesheet" href="public/css/bootstrap.min.css">
    <script src="public/javascript/jquery-3.5.1.slim.min.js"></script>
    <script src="public/javascript/bootstrap.bundle.min.js"></script>
    <link rel="stylesheet" type="text/css" href="public/css/dropzone.min.css" /> 
    <link rel="stylesheet" type="text/css" href="public/css/style.css?version=<%= Common.GetVersion%" /> 
    <link rel="shortcut icon" href="public/cat.png" type="image/x-icon">

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"></script>
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
                <a class="nav-link" href="<?=base_url('/home')?>">Home</a>
            </li>
            <li class="nav-item <?php if($current_page == 'image') {echo 'active';} ?>">
                <a class="nav-link" href="<?=base_url('image')?>">Image</a>
            </li>
            <li class="nav-item <?php if($current_page == 'audio') {echo 'active';} ?>">
                <a class="nav-link" href="<?=base_url('/audio')?>">Audio</a>
            </li>
            <li class="nav-item <?php if($current_page == 'video') {echo 'active';} ?>">
                <a class="nav-link" href="<?=base_url('/video')?>">Video</a>
            </li>
        </ul>
    </div>
    <form action="<?=base_url()?>/search" method="get">
      <div class="input-group">
        <input type="text" class="form-control" name="query" placeholder="Search..." aria-label="Search">
        <div class="input-group-append">
          <button class="btn btn-primary" type="submit"><i class="fas fa-search"></i></button>
        </div>
      </div>
    </form>
    <a class="nav-item nav-link px-5 " href="<?=base_url('/logout')?>">Logout</a>
</nav>

<?php endif; ?>

