<?php
    $id_auta = array_column($auta, 'id_auta');
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
    $wyposazenie_nierozbite = array_column($auta, 'wyposazenie_dodatkowe');
                try
                {
                    $wyposazenie_rozbite = explode(", ", $wyposazenie_nierozbite[0]);
                }
                catch(Exception $e)
                {
                    if(isset($row->$wyposazenie_nierozbite[0]))
                    {
                        $wyposazenie_rozbite = $row->$wyposazenie_nierozbite[0];    
                    }                    
                }
?> 
       <h2><?php echo 'Edytuj dane auta - ' . $marka[0] . ' ' . $model[0]; ?></h2>                  
        <section class="add-car-form-wrapper">
           <div class="add-car-form-fields-container">
            <?php echo form_open('zaplecze/wybrane_auto_edytuj_dane_potwierdzenie'); ?>
               <input type="hidden" name="id_auta" value="<?php echo $id_auta[0]; ?>">
                Kategoria: <select name="kategoria" id="kategoria" class="add-car-form-field" required>
                   <option value="<?php echo $kategoria[0]; ?>" selected><?php echo $kategoria[0]; ?></option>
                    <?php 
                        foreach($kategorie as $row)
                        {
                            if($row->kategoria != $kategoria[0])
                            {
                            echo '<option value="' . $row->kategoria . '">' . $row->kategoria . '</option>';
                            }
                        }
                    ?>
                </select>
                
                Nadwozie: <select name="nadwozie" id="nadwozie" class="add-car-form-field" required>
                   <option value="<?php echo $nadwozie[0]; ?>"  selected><?php echo $nadwozie[0]; ?></option>
                    <?php 
                        foreach($nadwozia as $row)
                        {
                            if($row->nadwozie != $nadwozie[0])
                            {
                                echo '<option value="' . $row->nadwozie . '">' . $row->nadwozie . '</option>';
                            }
                        }
                    ?>
                </select><br>
                Marka: <input class="add-car-form-field" type="text" name="marka" value="<?php echo $marka[0]; ?>">
                Model: <input class="add-car-form-field" type="text" name="model" value="<?php echo $model[0]; ?>"><br>
                Nr rejestracyjny: <input class="add-car-form-field" type="text" name="nr_rejestracyjny" value="<?php echo $nr_rejestracyjny[0]; ?>">
                Pojemność silnika [cm<sup>3</sup>]:<input class="add-car-form-field" type="number" name="pojemnosc_silnika" value="<?php echo $pojemnosc_silnika[0]; ?>"><br>
                Rodaj paliwa: <select name="rodzaj_paliwa" id="rodzaj_paliwa" class="add-car-form-field" required>
                   <option value="<?php echo $rodzaj_paliwa[0]; ?>" selected><?php echo $rodzaj_paliwa[0]; ?></option>
                    <?php 
                        foreach($paliwa as $row)
                        {
                            if($row->rodzaj_paliwa != $rodzaj_paliwa[0])
                            {
                            echo '<option value="' . $row->rodzaj_paliwa . '">' . $row->rodzaj_paliwa . '</option>';
                            }
                        }
                    ?>
                </select>
                Moc [KM]: <input class="add-car-form-field" type="number" name="moc" value="<?php echo $moc[0]; ?>"><br>
                Spalanie [l/100km]: <input class="add-car-form-field" type="number" name="spalanie" value="<?php echo $spalanie[0]; ?>">        
                Skrzynia biegów: <select name="skrzynia_biegow" id="skrzynia_biegow" class="add-car-form-field" required>
                   <option value="<?php echo $skrzynia_biegow[0]; ?>" selected><?php echo $skrzynia_biegow[0]; ?></option>
                    <?php 
                        foreach($skrzynie_biegow as $row)
                        {
                            if($row->skrzynia_biegow != $skrzynia_biegow[0])
                            {
                            echo '<option value="' . $row->skrzynia_biegow . '">' . $row->skrzynia_biegow . '</option>';
                            }
                        }
                    ?>
            </select><br>
                Napęd: <select name="naped" id="naped" class="add-car-form-field">
                   <option value="<?php echo $naped[0]; ?>" selected><?php echo $naped[0]; ?></option>
                    <?php 
                        foreach($napedy as $row)
                        {
                            if($row->naped != $naped[0])
                            {
                            echo '<option value="' . $row->naped . '">' . $row->naped . '</option>';
                            }
                        }
                    ?>
            </select> 
                Liczba miejsc: <input class="add-car-form-field" type="number" name="liczba_miejsc" value="<?php echo $liczba_miejsc[0]; ?>"><br>
                Liczba drzwi: <select name="liczba_drzwi" id="liczba_drzwi" class="add-car-form-field">
                <option value="<?php echo $liczba_drzwi[0]; ?>" selected><?php echo $liczba_drzwi[0]; ?></option>
                <?php if($liczba_drzwi[0]!='2/3')
                    { echo '<option value="2/3">2/3</option>'; } ?>
                <?php if($liczba_drzwi[0]!='3/4')
                            { echo '<option value="3/4">3/4</option>'; } ?>
                <?php if($liczba_drzwi[0]!='4/5')
                            { echo '<option value="4/5">4/5</option>'; } ?>
            </select>
                Pojemność bagażnika [l]: <input class="add-car-form-field" type="number" name="pojemnosc_bagaznika" value="<?php echo $pojemnosc_bagaznika[0]; ?>"><br>
                Przebieg [km]: <input class="add-car-form-field" type="number" name="przebieg" value="<?php echo $przebieg[0]; ?>">
                Kolor: <input class="add-car-form-field" type="text" name="kolor" value="<?php echo $kolor[0]; ?>"><br>
                Cena [zł/doba]: <input class="add-car-form-field" type="number" name="cena" value="<?php echo $cena[0]; ?>">
                Kaucja [zł/doba]: <input class="add-car-form-field" type="number" name="kaucja" value="<?php echo $kaucja[0]; ?>"><br>
            </div>
                <h4>Wybierz wyposażenie dodatkowe:</h4>
                    <div class="add-car-extra-equipment">
                       <?php
                        $zaznacz = '';
                        $ilosc_wyposazen = count ($wyposazenie_dodatkowe_lista);
                        foreach($wyposazenie_dodatkowe_lista as $row)
                        { 
                            $zaznacz = '';
                                for($i=0; $i<$ilosc_wyposazen; $i++)
                                {                
                                    if(isset($wyposazenie_rozbite[$i]))
                                    {    
                                        if($row->wyposazenie_dodatkowe==$wyposazenie_rozbite[$i])
                                            { 
                                                $zaznacz = 'checked';
                                            break;
                                            }
                                    }
                                }
                                echo '<label class="add-car-checkbox-label" style="cursor:pointer;margin:0;"><input style="margin: 10px 3px;" type="checkbox" id="' . $row->wyposazenie_dodatkowe . '" name="wyposazenie_dodatkowe[]" value="' . $row->wyposazenie_dodatkowe . '" ' . $zaznacz . '>' . $row->wyposazenie_dodatkowe . '</label><br>';
                        }
                    ?>
            </div>
                <br> <br>
                <?php echo form_submit('wyslij_dane','Zapisz zmiany','id="wyslij_dane"'); ?>
            <?php echo form_close(); ?>                
        </section>
        <br>
<script type="text/javascript">
$(document).ready(function () {
    $('#wyslij_dane').click(function() {
      checked = $("input[type=checkbox]:checked").length;

      if(!checked) {
        alert('Musisz zaznaczyć przynajmniej jedno dodatkowe wyposażenie. Jeśli go nie ma, to zaznacz opcję  "Brak".');
        return false;
      }

    });
});

</script>
       
</div>


