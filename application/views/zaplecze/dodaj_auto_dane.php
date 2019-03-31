    <h2>Dodaj auto - wprowadź dane</h2>
        <?php            
            function zrobUkrytePolaZdjec()
            {   
                $ci =& get_instance();
                $ilosc_img=$ci->session->userdata('ilosc_zdjec');
                for($i=0; $i<=$ilosc_img; $i++)
                {
                   $link_number="zdjecie_".$i;
                   echo '<input type="hidden" name="image-link-' . $i . '" id="image-link-' . $i . '" value="'. $ci->session->userdata($link_number) .'" />'; 
                }
            }        
        ?>   
        <section class="add-car-form-wrapper">
            <div class="add-car-form-fields-container">
               <?php echo form_open('zaplecze/dodaj_auto_podsumowanie'); ?>
                <select name="kategoria" id="kategoria" class="add-car-form-field" required>
                   <option value="" disabled selected>Kategoria *</option>
                    <?php 
                        foreach($kategorie as $row)
                        {
                            echo '<option value="' . $row->kategoria . '">' . $row->kategoria . '</option>';
                        }
                    ?>
                </select><br>
                <select name="nadwozie" id="nadwozie" class="add-car-form-field" required>
                   <option value="" disabled selected>Typ nadwozia *</option>
                    <?php 
                        foreach($nadwozia as $row)
                        {
                            echo '<option value="' . $row->nadwozie . '">' . $row->nadwozie . '</option>';
                        }
                    ?>
                </select><br>
                <input type="text" id="marka" class="add-car-form-field" name="marka" placeholder="Marka *" maxlength="60" required>
                <input type="text" id="model" class="add-car-form-field" name="model" placeholder="Model *" maxlength="60" required>
                <input type="number" id="rok_produkcji" class="add-car-form-field" name="rok_porodukcji" placeholder="Rok produkcji" maxlength="4" min="0" max="9999">
                <input type="text" id="nr_rejestracyjny" class="add-car-form-field" name="nr_rejestracyjny" placeholder="Nr rejestracyjny *" maxlength="9" required>
                <input type="number" id="pojemnosc_sinika" class="add-car-form-field" name="pojemnosc_sinika" placeholder="Poj. silnika w cm3" maxlength="6" min="0" max="999999">
                <select name="rodzaj_paliwa" id="rodzaj_paliwa" class="add-car-form-field" required>
                   <option value="" disabled selected>Rodzaj paliwa *</option>
                    <?php 
                        foreach($paliwa as $row)
                        {
                            echo '<option value="' . $row->rodzaj_paliwa . '">' . $row->rodzaj_paliwa . '</option>';
                        }
                    ?>
                </select>
                <input type="number" id="moc" class="add-car-form-field" name="moc" placeholder="Moc silnika w KM" maxlength="4" min="0" max="9999">
                <input type="number" id="spalanie" class="add-car-form-field" name="spalanie" placeholder="Spalanie l\100km" maxlength="3" min="0" max="999">
                <select name="skrzynia_biegow" id="skrzynia_biegow" class="add-car-form-field" required>
                   <option value="" disabled selected>Skrzynia biegów <span style="color:blue">*</span></option>
                    <?php 
                        foreach($skrzynia_biegow as $row)
                        {
                            echo '<option value="' . $row->skrzynia_biegow . '">' . $row->skrzynia_biegow . '</option>';
                        }
                    ?>
            </select>
            <select name="naped" id="naped" class="add-car-form-field">
                   <option value="" disabled selected>Napęd</option>
                    <?php 
                        foreach($naped as $row)
                        {
                            echo '<option value="' . $row->naped . '">' . $row->naped . '</option>';
                        }
                    ?>
            </select>      
            <input type="number" id="przebieg" class="add-car-form-field" name="przebieg" placeholder="Przebieg w km" maxlength="7 "min="0" max="9999999">
            <input type="text" id="kolor" class="add-car-form-field" name="kolor" placeholder="Kolor" maxlength="50">
            <input type="number" id="liczba_miejsc" class="add-car-form-field" name="liczba_miejsc" placeholder="Liczba miejsc" maxlength="3" min="0" max="999"><br>
            <select name="liczba_drzwi" id="liczba_drzwi" class="add-car-form-field">
                <option value="liczba_drzwi" disabled selected>naped</option>
                <option value="2/3">2/3</option>
                <option value="3/4">3/4</option>
                <option value="4/5">4/5</option>
            </select><br>
            <input type="number" id="pojemnosc_bagaznika" class="add-car-form-field" name="pojemnosc_bagaznika" placeholder="Poj. bagażnika w litrach" maxlength="5" min="0" max="99999">
            
            <input type="number" id="cena" class="add-car-form-field" name="cena" placeholder="Cena w PLN" maxlength="6" min="0" max="999999">
            <input type="number" id="kaucja" class="add-car-form-field" name="kaucja" placeholder="Kaucja w PLN" maxlength="6" min="0" max="999999">
            </div>
            <br>
                <h4>Wybierz wyposażenie dodatkowe:</h4>
                <div class="add-car-extra-equipment">
                    <?php 
                        foreach($wyposazenie_dodatkowe as $row)
                        {
                            echo '<label class="add-car-checkbox-label" style="cursor:pointer;margin:0;"><input style="margin: 10px 3px;" type="checkbox" id="' . $row->wyposazenie_dodatkowe . '"  name="wyposazenie_dodatkowe[]" value="'. $row->wyposazenie_dodatkowe . '" >' . $row->wyposazenie_dodatkowe . '</label><br>';
                        }
                    ?>
                </div>
                    <br><br>
            <?php echo zrobUkrytePolaZdjec(); ?>  
             
            <?php echo form_submit('form-submit', 'Przejdź dalej', 'id="wyslij_dane"'); ?>
            <?php echo form_close(); ?>
            <br><br>
        </section>
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

