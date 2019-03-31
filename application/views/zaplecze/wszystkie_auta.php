    <h2>Wszystkie samochody</h2>
      <a href="zaplecze/dodaj_auto" class="panel-classic-button">Dodaj nowe auto</a>
       <section class="show-cars-wrapper">
        <?php foreach($auta as $row):
                $zdjecie_glowne = $row->zdjecie_glowne;
        ?>
           <a href="zaplecze/wybrane_auto/<?php echo $row->id_auta; ?>" class="show-car-row-link" > 
            <div class="show-single-car-container">
                                       
                        <?php if (!empty($zdjecie_glowne)): ?>
                            <img src="<?php echo $zdjecie_glowne ; ?>" alt="<?php echo $row->marka." ".$row->model." ".$row->moc." KM ".$row->rodzaj_paliwa; ?>">
                        <?php else:?>
                        <img src="<?php echo base_url() ?>uploads/zdjecia/brak-zdjecia-auta.jpg" alt="<?php echo $row->marka." ".$row->model." ".$row->moc." KM ".$row->rodzaj_paliwa; ?>">
                        <?php endif;?>
                <div class="show-single-car-model">
                    <?php echo $row->marka." ".$row->model."<br>".$row->nr_rejestracyjny." | ".$row->cena." PLN"; ?>
                </div>
            </div>
          </a>  
         <?php endforeach;?> 
    </section>  
</div>