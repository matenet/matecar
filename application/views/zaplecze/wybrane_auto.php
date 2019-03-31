
<style>.grouped_elements{text-decoration: none;} </style>  
    <?php
        $id_auta = array_column($auta, 'id_auta');
        $marka = array_column($auta, 'marka');
        $model = array_column($auta, 'model');
        $moc = array_column($auta, 'moc');
        $rodzaj_paliwa = array_column($auta, 'rodzaj_paliwa');
        $nr_rejestracyjny = array_column($auta, 'nr_rejestracyjny'); 
        if($zdjecia!=null && !is_string($zdjecia))
        { 
            $linki_zdjec = array_column($zdjecia, 'linki_zdjec');
        }
    ?>
    
   <h2><?php echo $marka[0].' '.$model[0] . ' - ' . $nr_rejestracyjny[0]; ?></h2>
   <style>.show-single-car-wrapper{width: 100%;}</style>
 <section class="show-single-car-wrapper">
                <?php if (isset($linki_zdjec[0])):           
                        for($i=0; $i<10;$i++): 
                           if (isset($linki_zdjec [$i])): ?>
                             
                                <div class="show-single-car-container">
                                    <img src="<?php echo $linki_zdjec [$i]; ?>" alt="" class="show-car-img">
                                     <div class="show-single-car-change-link-container">
                                        <div class="show-single-car-change-link-wrapper">
                                            <form class="show-car-image-form" method='post' action='<?php echo base_url()."zaplecze/ustaw_zdjecie_glowne_auta/".$id_auta[0]; ?>'>
                                                <input type="hidden" name="linki_zdjec" value="<?php echo $linki_zdjec[$i]; ?>">
                                                <button type="submit" name="ustaw-zdjecie-glowne-button" class="show-car-image-button"><i class="show-single-car-change-link fas fa-camera"></i></button>
                                            </form>
                                            <form class="show-car-image-form" method='post' action='<?php echo base_url()."zaplecze/usun_zdjecie_auta/".$id_auta[0]; ?>'>
                                                <input type="hidden" name="linki_zdjec" value="<?php echo $linki_zdjec[$i]; ?>">
                                                <button type="submit" name="usun-zdjecie-button" class="show-car-image-button"><i class="show-single-car-change-link fas fa-trash-alt"></i></button>
                                            </form>
                                        </div> 
                                    </div>
                                </div>
                            <?php endif; ?>
                        <?php endfor; ?>
                        <div class="show-single-car-container">
                             <a href='<?php echo base_url()."zaplecze/dodaj_zdjecia_auta/" . $id_auta[0] ?>' class="show-single-car-add-photo-link"><i class="fas fa-plus"></i><br>Dodaj zdjęcia</a>
                        </div>     
                    <?php else: ?>
                    <div class="show-single-car-container">
                             <a href='<?php echo base_url()."zaplecze/dodaj_zdjecia_auta/" . $id_auta[0] ?>' class="show-single-car-add-photo-link"><i class="fas fa-plus"></i><br>Dodaj zdjęcia</a>
                        </div> 

               <?php endif; ?>
            
         <div>
            <?php echo '<a href="zaplecze/wybrane_auto_edytuj_dane/' . $id_auta[0] . '" class="panel-classic-button" >Edytuj dane</a>'; ?>
            <?php echo '<a href="zaplecze/usun_auto/' . $id_auta[0] . '" class="panel-classic-button" id="potwierdz" >Usuń auto</a>'; ?> 
         </div> 
    </section> 
<script type="text/javascript">
    $('#potwierdz').on('click', function () {
        return confirm('Czy na pewno chcesz usunąć to auto?');
    });
</script>

</div>

