<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <base href="<?php echo base_url(); ?>">
        <title>Zaplecze Matecar</title>
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta name="author" content="Emuart">
        <link rel="stylesheet" href="<?php echo base_url(); ?>assets/css/admin-style.css">
        <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.3.1/css/all.css" integrity="sha384-mzrmE5qonljUremFsqc01SB46JvROS7bZs3IO2EmfFsd15uHvIt+Y8vEf7N7fWAU" crossorigin="anonymous">
        <script src="<?php echo base_url(); ?>assets/js/jquery-3.3.1.min.js"></script>
    </head>
        <body>
           <section id="main-content-wrapper">
            <header class="top-header">
                <?php if ($this->session->userdata('user_id')): ?>
                <ul>
                    <li><a href="<?php echo site_url('zaplecze/index'); ?>">Home</a></li>
                    <li><a href="<?php echo site_url('zaplecze/wszystkie_auta'); ?>">Auta</a></li>
                    <li><a href="<?php echo site_url('zaplecze/wszystkie_rezerwacje'); ?>">Rezerwacje</a></li>    
                    <?php if ($this->session->userdata('user_id')): ?>
                        <li><a href="<?php echo site_url('zaplecze/logout'); ?>">Wyloguj</a></li>                    
                    <?php endif; ?>
                </ul>
                <?php else: ?>
                    <ul>
                        <li>Zaplecze Matecar</li>
                    </ul>
              <?php endif; ?>  
            </header>
            <div class="container">
                <?php if (!$this->session->userdata('user_id')): ?>
                    <?php if (current_url()==base_url().'zaplecze/login'): ?>
                       <?php echo '<h2>Logowanie</h2>' ?>
                    <?php else: ?>
                       <? redirect('zaplecze/login'); ?>
                    <?php endif; ?>
                <?php endif; ?>                
                <?php if (validation_errors()): ?>      
                      <?php $errors = validation_errors(); 
                    echo '<p>' . $errors . '</p>' ?>
                  <?php endif; ?>
                  <?php if ($this->session->flashdata('error')): ?>
                      <?php echo $this->session->flashdata('error'); ?>
                <?php endif; ?>
            