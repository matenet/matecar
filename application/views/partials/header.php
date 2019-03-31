<!DOCTYPE html>
<html>

    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <title>Matecar</title>
        <meta name="description" content="Matenet portfolio">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" href="<?php echo base_url(); ?>assets/css/style.css">
        <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.3.1/css/all.css" integrity="sha384-mzrmE5qonljUremFsqc01SB46JvROS7bZs3IO2EmfFsd15uHvIt+Y8vEf7N7fWAU" crossorigin="anonymous">
    </head>
    <body>
    <div id="main-content-wrapper">
    <header class="top-header">
       <div class="logo-wrapper">
            <a href="<? echo base_url(); ?>" class="logo-link">
               <img src="<?php echo site_url(); ?>assets/img/matecar_logo.jpg" alt="logo matecar" class="header-logo">
            </a>
        </div>
        <button id="hamburger-menu" onclick="menuOpener()"></button>
        <nav id="main-nav">
            <ul>
                <li><a href="<? echo base_url(); ?>" class="<?php if($page=='index.php'){echo 'active-header-link';} ?>">O NAS</a></li>
                <li><a href="<? echo base_url(); ?>auta" class="<?php if($page=='auta.php'){echo 'active-header-link';} ?>">AUTA</a></li>
                <li><a href="<? echo base_url(); ?>regulamin" class="<?php if($page=='regulamin.php'){echo 'active-header-link';} ?>">REGULAMIN</a></li>
                <li><a href="<? echo base_url(); ?>kontakt" class="<?php if($page=='kontakt.php'){echo 'active-header-link';} ?>">KONTAKT</a></li>
            </ul>
        </nav>
        <script>
            var menuContent = document.getElementById("main-nav");
            var openStatus=false;
            function menuOpener () {
                if (openStatus==false ){
                    menuContent.style.display = "block";
                    document.getElementById("hamburger-menu").focus();
                    openStatus=true;
                }
                else {
                    menuContent.style.display = "none";
                    document.getElementById("hamburger-menu").blur();
                    openStatus=false;
                }
            }
        </script>
    </header>
    