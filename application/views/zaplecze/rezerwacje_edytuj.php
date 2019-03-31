<script type="text/javascript" src="<?php echo base_url(); ?>assets/js/calendar.min.js"></script>
<link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>assets/css/calendar.css">
   
   <?php
    $id_auta = $this->input->post("id_auta");
    $marka = $this->input->post("marka");
    $model = $this->input->post("model"); 
    $od_kiedy = array_column($rezerwacje, 'od_kiedy');
    $do_kiedy = array_column($rezerwacje, 'do_kiedy');
    $tytul_rezerwacji = array_column($rezerwacje, 'tytul_rezerwacji');
    ?>
    
   <h2><?php echo 'Edytuj rezerwację - ' . $marka . ' ' . $model; ?></h2>
 
    <?php if(!empty($rezerwacje['blad']))
     {
        echo '<h3 style="color:red;">Brak rezerwacji w wybranym dniu!</h3>';
        echo '<a href="zaplecze/wybrane_auto/' . $id_auta. '" class="panel-classic-button">Powrót</a>';
     }
     else { ?>
      <div class="">
       <h4>Wybrana rezerwacja</h4>
          <div style="display:inline-block">Od dnia: <b><?php echo $od_kiedy[0]; ?> | </b></div>
          <div style="display:inline-block">Do dnia: <b><?php echo $do_kiedy[0]; ?> | </b></div>
          <div style="display:inline-block">Status pojazdu: <b><?php echo $tytul_rezerwacji[0]; ?> </b></div>
          <h4>Nowe dane rezerwacji</h4>
        <?php echo form_open('zaplecze/rezerwacje_edytuj_potwierdzenie'); ?>
            <?php $date = date("Y-m-d"); ?>
            <div style="width:20%;box-sizing:border-box;display:inline-block">Od dnia: <input type="date" name="od_kiedy" class="date-field" value="<?php echo $date ?>" required></div>
            <div style="width:20%;box-sizing:border-box;display:inline-block">Do dnia: <input type="date" name="do_kiedy" class="date-field" value="<?php echo $date ?>" required></div><br>
            <select name="tytul_rezerwacji" id="tytul_rezerwacji" class="add-car-form-field" required>
               <option value="" disabled selected>Status pojazdu</option>
               <option value="Wypożyczony" >Wypożyczony</option>                   
               <option value="Prywatne wypożyczenie" >Prywatne wypożyczenie</option>
               <option value="Serwis" >Serwis</option>
                </select>
            <input type="hidden" name="id_auta" value="<?php echo $id_auta; ?>">
        <?php echo form_submit('edytuj-rezerwacje-submit','Zapisz zmiany'); ?>    
        <?php echo form_close(); ?>
    </div>
   <?php } ?>  
</div>

