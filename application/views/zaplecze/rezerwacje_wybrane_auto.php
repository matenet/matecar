<link rel="stylesheet" href="<?php echo base_url(); ?>assets/fancybox/jquery.fancybox-1.3.4.css" type="text/css" media="screen" />
<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.4/jquery.min.js"></script>
<script type="text/javascript" src="<?php echo base_url(); ?>assets/fancybox/jquery.fancybox-1.3.4.pack.js"></script>
<script type="text/javascript" src="<?php echo base_url(); ?>assets/js/calendar.min.js"></script>
<link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>assets/css/calendar.css">
<style>.grouped_elements{text-decoration: none;} </style>  
    <?php
        $id_auta = array_column($auta, 'id_auta');
        $marka = array_column($auta, 'marka');
        $model = array_column($auta, 'model');
        $nr_rejestracyjny = array_column($auta, 'nr_rejestracyjny');
        if(null !== array_column($auta, 'zdjecie_glowne'))
        {
            $zdjecie_glowne = array_column($auta, 'zdjecie_glowne'); 
        }
            
    ?>
    
   <h2><?php echo $marka[0].' '.$model[0] . ' - ' . $nr_rejestracyjny[0]; ?></h2>
 <section class="show-single-car-wrapper">
                <?php if (isset($zdjecie_glowne[0])): ?>
                    <a class="grouped_elements" rel="group1" href="<?php echo $zdjecie_glowne[0]; ?>">
                        <div class="show-single-car-container">
                           <img src="<?php echo $zdjecie_glowne[0]; ?>" alt="" class="show-car-img"> 
                        </div>
                    </a>             
                <?php else: ?>
                    <div class="show-single-car-container">
                         <img src="<?php echo base_url(); ?>uploads/zdjecia/brak-zdjecia-auta.jpg" alt="<?php echo $row->marka." ".$row->model." ".$row->moc." KM ".$row->rodzaj_paliwa; ?>">
                    </div>
               <?php endif; ?>
               
<div id="calendar">
    <?php
        if(!empty($rezerwacje['blad']))
        {
            echo"<h2>Brak rezerwacji dla tego pojazdu</h2><h3>Kalendarz nie został wyświetlony</h3></div></section>";    
        }
        else{ ?>
        <script>
            function changeColors(events){
                
        var settings = {};
        var element = document.getElementById('calendar');
        caleandar(element, events, settings);
        $(".cld-number.eventday" ).each(function( i ) {
          if($(this).find(".cld-title").text()=='Zarezerwowany')
          {
            this.style.background = "#ffdbbc"; 
            $(this).hover(function(){
            $(this).css("background-color", "#b3b3b3");
            }, function(){
            $(this).css("background-color", "#ffdbbc");
             });   
          }
          if($(this).find(".cld-title").text()=='Wypożyczony')
          {
            this.style.background = "#ffa9a9"; 
            $(this).hover(function(){
            $(this).css("background-color", "#b3b3b3");
            }, function(){
            $(this).css("background-color", "#ffa9a9");
             });   
          }
          if($(this).find(".cld-title").text()=='Prywatne wypożyczenie')
          {
            this.style.background = "#c2adff"; 
            $(this).hover(function(){
            $(this).css("background-color", "#b3b3b3");
            }, function(){
            $(this).css("background-color", "#c2adff");
             });   
          }
          if($(this).find(".cld-title").text()=='Serwis')
          {
            this.style.background = "#bce6ff"; 
            $(this).hover(function(){
            $(this).css("background-color", "#b3b3b3");
            }, function(){
            $(this).css("background-color", "#bce6ff");
             });   
          }
            }); 
        }
            
        $(document).ready(function(){
            var events = [
         <?php 
            foreach($rezerwacje as $row):
            $date1 = new DateTime($row->od_kiedy);
            $date2 = new DateTime($row->do_kiedy);
            $interval = date_diff($date1, $date2);
            $liczba_dni = $interval->format('%a')+1;
            $status_rezerwacji = $row->tytul_rezerwacji;
            $date = date('Y-m-d',strtotime($row->od_kiedy . "-1 days"));
          
            for($i=0;$i<$liczba_dni;$i++)
            {
                $date1 = str_replace('-', '/', $date);
                $date = date('Y-m-d',strtotime($date1 . "+1 days"));
                $data_to_calendar = explode("-", $date);
                echo '{"Date": new Date(' . $data_to_calendar[0] . ', ' . $data_to_calendar[1] . ', ' . $data_to_calendar[2] . '), "Title": "' . $status_rezerwacji . '", "Link": "' . current_url() . '#"},';
            }
        endforeach; 
            ?>
        ];
            
        changeColors(events);
      
            
        }); 
        
    </script>
</div>
    </section>
    <?php } ?>
<section class="calendar-management-wrapper">
   <h3>Zarządzenie rezerwacjami</h3>    
    <div class="calendar-management">
       <h4>Dodaj rezerwację</h4>
        <?php echo form_open('zaplecze/rezerwacje_dodaj'); ?>
           <?php $date = date("Y-m-d"); ?>
            <div style="width:48%;box-sizing:border-box;display:inline-block">Pierwszy dzień rezerwacji: <input type="date" name="od_kiedy" class="date-field" value="<?php echo $date ?>" required></div>
            <div style="width:48%;box-sizing:border-box;display:inline-block">Ostatni dzień rezerwacji: <input type="date" name="do_kiedy" class="date-field" value="<?php echo $date ?>" required></div><br>
            <select name="tytul_rezerwacji" id="tytul_rezerwacji" class="add-car-form-field" required>
                   <option value="" disabled selected>Status pojazdu</option>
                   <option value="Zarezerwowany" >Zarezerwowany</option> 
                   <option value="Wypożyczony" >Wypożyczony</option>                   
                   <option value="Prywatne wypożyczenie" >Prywatne wypożyczenie</option>
                   <option value="Serwis" >Serwis</option>
                </select>
            <input type="hidden" name="id_auta" value="<?php echo $id_auta[0]; ?>">
        <?php echo form_submit('dodaj-rezerwacje-submit','Dodaj rezerwację'); ?>    
        <?php echo form_close(); ?>
    </div>
     
    <div class="calendar-management">
       <h4>Usuń rezerwację</h4>
        <?php echo form_open('zaplecze/rezerwacje_usun'); ?>
           <?php $date = date("Y-m-d"); ?>
            <div style="width:200px;display:inline-block">Pierwszy dzień rezerwacji: <input type="date" name="od_kiedy" class="date-field" value="<?php echo $date ?>" required></div><br>
            <input type="hidden" name="id_auta" value="<?php echo $id_auta[0]; ?>">
        <?php echo form_submit('usun-rezerwacje-submit','Usuń rezerwację'); ?>    
        <?php echo form_close(); ?>
    </div>  
</section> 
<script>
    $(document).ready(function() {
	$("a.grouped_elements").fancybox({
		'transitionIn'	:	'fade',
		'transitionOut'	:	'fade',
		'speedIn'		:	300, 
		'speedOut'		:	200, 
        'titlePosition' 	: 'over',
        'titleFormat'		: function(title, currentArray, currentIndex, currentOpts) {
					return '<span id="fancybox-title-over">Zdjęcie ' + (currentIndex + 1) + ' z ' + currentArray.length + (title.length ? ' &nbsp; ' + title : '') + '</span>';
				}
	});
});
</script>
</div>