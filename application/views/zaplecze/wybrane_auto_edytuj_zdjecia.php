    <h2>Edytuj auto</h2>
        <?php
    $marka = array_column($auta, 'marka');
    $model = array_column($auta, 'model');
    $nr_rejestracyjny = array_column($auta, 'nr_rejestracyjny');
    $cena = array_column($auta, 'cena');
    $kaucja = array_column($auta, 'kaucja');
    $pojemnosc_silnika = array_column($auta, 'pojemnosc_silnika');
    $moc = array_column($auta, 'moc');
    $spalanie = array_column($auta, 'spalanie');
    $kategoria = array_column($auta, 'kategoria');
    $nadwozie = array_column($auta, 'nadwozie');
    $rodzaj_paliwa = array_column($auta, 'rodzaj_paliwa');
    $skrzynia_biegow = array_column($auta, 'skrzynia_biegow');
    $naped = array_column($auta, 'naped');
    $liczba_drzwi = array_column($auta, 'liczba_drzwi');
    $pojemnosc_bagaznika = array_column($auta, 'pojemnosc_bagaznika');
    $liczba_miejsc = array_column($auta, 'liczba_miejsc');
    $kolor = array_column($auta, 'kolor');
    $przebieg = array_column($auta, 'przebieg');
    $wyposazenie_dodatkowe = array_column($auta, 'wyposazenie_dodatkowe'); 
    $linki_zdjec = array_column($auta, 'linki_zdjec');
    ?>       
           <?php 
                $polaczone_linki = $linki_zdjec[0];
                        try
                        {
                            $rozbite_linki = explode(", ",$linki_zdjec[0]); 
                        }
                        catch(Exception $e)
                        {
                            $rozbite_linki = $linki_zdjec[0];
                        } 
            ?>
                <div class="cars-grid-wrapper">
                    <div class="car-img-wrapper"> 
            <?php   
                    if (isset($rozbite_linki[1])):           
                        for($i=0; $i<10;$i++): 
                           if (isset($rozbite_linki [$i])): 
            ?>
                                <img src="<?php echo $rozbite_linki [$i]; ?>" alt="" class="show-car-img">
                            <?php endif; ?>
                        <?php endfor; ?>
                    <?php else: ?>
                        <img src="<?php echo $rozbite_linki [0]; ?>" alt="" class="show-car-img">
                    <?php endif; ?>
                    </div>
</div>
            <?php function zrobLinkiZdjec()
            {
                $ci =& get_instance();
                $ilosc_img=$ci->session->userdata('ilosc_zdjec');
                for($i=0; $i<=$ilosc_img; $i++)
                {
                   $link_number="image-link-".$i;
                   echo '<img src="' . $ci->input->post($link_number) . '" ' . 'class="dodaj-auto-img">'; 
                }
            }
            function polaczLinkiZdjec()
            {
                $ci =& get_instance();
                $ilosc_img=$ci->session->userdata('ilosc_zdjec');
                $output='';
                for($i=0; $i<=$ilosc_img; $i++)
                {
                    $link_number="image-link-".$i;
                    if($i==0)
                    {
                        $output = $ci->input->post($link_number);
                    }
                    else
                    {
                        $output .= ', ' . $ci->input->post($link_number); 
                    }
                }
                return $output;
            }
    ?>   
        <section class="add-car-summary-wrapper">
            <?php echo form_open('zaplecze/dodaj_auto_do_bazy'); ?>
                <input type="text" name="kategoria" value="<?php echo $kategoria[0]; ?>">
                <input type="text" name="nadwozie" value="<?php echo $nadwozie[0]; ?>">
                <input type="text" name="marka" value="<?php echo $marka[0]; ?>">
                <input type="text" name="model" value="<?php echo $model[0]; ?>">
                <input type="text" name="nr_rejestracyjny" value="<?php echo $nr_rejestracyjny[0]; ?>">
                <input type="number" name="pojemnosc_silnika" value="<?php echo $pojemnosc_silnika[0]; ?>">
                <input type="text" name="rodzaj_paliwa" value="<?php echo $rodzaj_paliwa[0]; ?>">
                <input type="hidden" name="moc" value="<?php echo $moc[0]; ?>">
                <input type="hidden" name="spalanie" value="<?php echo $spalanie[0]; ?>">
                <input type="text" name="skrzynia_biegow" value="<?php echo $skrzynia_biegow[0]; ?>">
                <input type="text" name="naped" value="<?php echo $naped[0]; ?>">
                <input type="hidden" name="liczba_miejsc" value="<?php echo $liczba_miejsc[0]; ?>">
                <input type="hidden" name="liczba_drzwi" value="<?php echo $liczba_drzwi[0]; ?>">
                <input type="hidden" name="pojemnosc_bagaznika" value="<?php echo $pojemnosc_bagaznika[0]; ?>">
                <input type="hidden" name="przebieg" value="<?php echo $przebieg[0]; ?>">
                <input type="text" name="kolor" value="<?php echo $kolor[0]; ?>">
                <input type="hidden" name="cena" value="<?php echo $cena[0]; ?>">
                <input type="hidden" name="kaucja" value="<?php echo $kaucja[0]; ?>">
                <input type="text" name="wyposazenie_dodatkowe" value="<?php echo $wyposazenie_dodatkowe[0]; ?>">
                <input type="hidden" name="linki_zdjec" value="<?php echo polaczLinkiZdjec(); ?>">
                <?php echo form_submit('wyslij_dane','Zapisz zmiany'); ?>
            <?php echo form_close(); ?>                
            
        </section>
</div>

