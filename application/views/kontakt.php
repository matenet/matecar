<?php
$page = "kontakt.php";
include 'partials/header.php'; ?>
   <style>.slider-section {display: block;background-image: url("<?php echo base_url(); ?>assets/img/slider_contact.jpg");}
       #show-contact:hover{cursor:pointer;}
    </style>  
    <section class="slider-section"></section>
    <h1 style="text-align:center;">WYNAJEM SAMOCHODÓW  tel. 123–456-789</h1>
    <article class="page-wrapper">
        <section class="left-content-wrapper">
            <div class="title-wrapper">
                <h1 class="site-title">KONTAKT</h1>
            </div>
        </section>
        <section class="right-content-wrapper">
            <div class="text-wrapper">
                 <p>
                    Jesteśmy dostępni pod numerem tel. <b>123–456-789</b><br>
                    E-mail: <b><span id="show-contact" onclick="showContact()">Pokaż</span></b><br>
                    Adres odbioru: <b>Kraków, parking pod Biedronką...</b>
                 </p>   
            </div>
        </section>
    </article>
    <script>
        function showContact() {
            document.getElementById('show-contact').innerHTML ='info[at]example.com';
        }   
    </script>
<?php include 'partials/footer.php'?>