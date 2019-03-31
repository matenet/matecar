    <h2>Dodaj auto - podsumowanie</h2>
          
        <section class="add-car-summary-wrapper">
            <b>Kategoria: </b><?php echo $kategoria; ?> | <b>Nadwozie: </b><?php echo $nadwozie; ?><br>     
            <b>Marka: </b><?php echo $marka; ?> | <b>Model: </b><?php echo $model; ?> | <b>Nr rejestracyjny: </b><?php echo $nr_rejestracyjny; ?><br>     
            <b>Pojemność silnika: </b><?php echo $pojemnosc_silnika; ?> | <b>Rodzaj paliwa: </b><?php echo $rodzaj_paliwa; ?><br>   
            <b>Moc: </b><?php echo $moc; ?> KM | <b>Spalanie: </b><?php echo $spalanie; ?> l/100km<br>           
            <b>Skrzynia biegów: </b><?php echo $skrzynia_biegow; ?> | <b>Napęd: </b><?php echo $naped; ?><br>      
            <b>Liczba miejsc: </b><?php echo $liczba_miejsc; ?> | <b>Liczba drzwi: </b><?php echo $liczba_drzwi; ?> | <b>Pojemność bagażnika: </b><?php echo $pojemnosc_bagaznika; ?> l<br>   
            <b>Przebieg: </b><?php echo $przebieg; ?> km | <b>Kolor: </b><?php echo $kolor; ?> | <b>Cena: </b><?php echo $cena; ?> PLN | <b>Kaucja: </b><?php echo $kaucja; ?> PLN<br> 
            <div class="equipement-list">
                <h3>Wyposażenie:</h3>
                <?php echo $wyposazenie_dodatkowe; ?>
            </div>
            <?php echo form_open('zaplecze/dodaj_auto_do_bazy'); ?>
                <input type="hidden" name="kategoria" value="<?php echo $kategoria; ?>">
                <input type="hidden" name="nadwozie" value="<?php echo $nadwozie; ?>">
                <input type="hidden" name="marka" value="<?php echo $marka; ?>">
                <input type="hidden" name="model" value="<?php echo $model; ?>">
                <input type="hidden" name="nr_rejestracyjny" value="<?php echo $nr_rejestracyjny; ?>">
                <input type="hidden" name="pojemnosc_silnika" value="<?php echo $pojemnosc_silnika; ?>">
                <input type="hidden" name="rodzaj_paliwa" value="<?php echo $rodzaj_paliwa; ?>">
                <input type="hidden" name="moc" value="<?php echo $moc; ?>">
                <input type="hidden" name="spalanie" value="<?php echo $spalanie; ?>">
                <input type="hidden" name="skrzynia_biegow" value="<?php echo $skrzynia_biegow; ?>">
                <input type="hidden" name="naped" value="<?php echo $naped; ?>">
                <input type="hidden" name="liczba_miejsc" value="<?php echo $liczba_miejsc; ?>">
                <input type="hidden" name="liczba_drzwi" value="<?php echo $liczba_drzwi; ?>">
                <input type="hidden" name="pojemnosc_bagaznika" value="<?php echo $pojemnosc_bagaznika; ?>">
                <input type="hidden" name="przebieg" value="<?php echo $przebieg; ?>">
                <input type="hidden" name="kolor" value="<?php echo $kolor; ?>">
                <input type="hidden" name="cena" value="<?php echo $cena; ?>">
                <input type="hidden" name="kaucja" value="<?php echo $kaucja; ?>">
                <input type="hidden" name="wyposazenie_dodatkowe" value="<?php echo $wyposazenie_dodatkowe; ?>">
                <?php echo form_submit('wyslij_dane','Zatwierdź dane'); ?>
            <?php echo form_close(); ?>                
            
        </section>
</div>

