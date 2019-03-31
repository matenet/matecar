<?php 
$page = "auta.php";
include 'partials/header.php'; ?>
    
     <style>.slider-section {display: block;background-image: url("<?php echo base_url(); ?>assets/img/slider_auta.jpg");}
         @media only screen and (max-width: 796px){.slider-section{display:none;}}</style>  
      <section class="slider-section"></section>
      <h1 style="text-align:center;">WYNAJEM SAMOCHODÓW  tel. 123–456-789</h1>
    <article class="page-wrapper">
        <section class="left-content-wrapper">
            <div class="title-wrapper">
                <h1 class="site-title">AUTA</h1>
            </div>
        </section>
        <section class="right-content-wrapper">
       <div class="cars-grid-wrapper">
       
   <?php foreach($auta as $row):
                $zdjecie_glowne = $row->zdjecie_glowne;
        ?>
              <?php $marka = str_replace(" ","_",$row->marka); ?>
              <?php $model = str_replace(" ","_",$row->model); ?>
           <a href="auta/wybrane_auto/<?php echo $marka; ?>_<?php echo $model; ?>/<?php echo $row->id_auta; ?>" class="single-car-link"> 
            <div class="single-car">
             <div class="single-car-read-more">Zobacz więcej <i class="fas fa-arrow-circle-right"></i></div> 
             <div class="single-car-white-mask"></div>
                        <?php if (!empty($row->zdjecie_glowne)): ?>
                            <img src="<?php echo $row->zdjecie_glowne; ?>" alt="<?php echo $row->marka." ".$row->model." ".$row->moc." KM ".$row->rodzaj_paliwa; ?>" class="car-img">
                        <?php else:?>
                            <img src="<?php echo base_url(); ?>uploads/zdjecia/brak-zdjecia-auta.jpg" alt="<?php echo $row->marka." ".$row->model." ".$row->moc." KM ".$row->rodzaj_paliwa; ?>" class="car-img">
                        <?php endif;?>                              
                <div class="car-text-on-img">
                    <p><?php echo $row->marka.' '.$row->model.'</p><p class="single-car-price-text">'.$row->cena. 'PLN/DOBA</p>'?>
                </div>
                
            </div>
            
          </a>  
         <?php endforeach;?> 

            </div>
        </section>
    </article>
<?php include 'partials/footer.php'?>
