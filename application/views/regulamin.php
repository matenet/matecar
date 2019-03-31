<?php 
$page = "regulamin.php";
include 'partials/header.php'; ?>
  
   <style>.slider-section {display: block;background-image: url("<?php echo base_url(); ?>assets/img/slider_regulamin.jpg");}</style>
    <section class="slider-section"></section>
    <h1 style="text-align:center;">WYNAJEM SAMOCHODÓW  tel. 123–456-789</h1>
    <article class="page-wrapper">
        <section class="left-content-wrapper">
            <div class="title-wrapper">
                <h1 class="site-title">REGULAMIN</h1>
            </div>
        </section>
        <section class="right-content-wrapper">
            <div class="text-wrapper">
                 <h3>POSTANOWIENIA OGÓLNE:</h3>
                <p>
                    Odbiór osobisty pojazdu: <b>Kraków, parking pod Biedronką</b><br>
                    Dowóz na podany adres: <b>DODATKOWA OPŁATA.</b><br>
                    <b>Brak możliwości wystawienia faktury VAT.</b><br>
                    Powyższa oferta ma charakter informacyjny i nie stanowi oferty handlowej w rozumieniu art. 66 §1 Kodeksu Cywilnego.
                </p>
            </div>
            <div class="regulamin-link"><a target="_blank" href="<?php echo base_url(); ?>uploads/regulamin_matecar.pdf" class="regulamin-link">Pobierz pełny regulamin</a></div>
        </section>
    </article>
    
<?php include 'partials/footer.php'?>