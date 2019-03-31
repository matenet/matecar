<?php 

$page = "auta.php";
include 'partials/header.php'; ?>
 
<link rel="stylesheet" href="<?php echo base_url(); ?>assets/fancybox/jquery.fancybox-1.3.4.css" type="text/css" media="screen" />
<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.4/jquery.min.js"></script>
<script type="text/javascript" src="<?php echo base_url(); ?>assets/fancybox/jquery.fancybox-1.3.4.pack.js"></script>
<style>.grouped_elements{text-decoration: none;} </style>  
       
   <?php
    $marka = array_column($auta, 'marka');
    $model = array_column($auta, 'model');
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
    if($zdjecia!=null && !is_string($zdjecia))
        { 
            $linki_zdjec = array_column($zdjecia, 'linki_zdjec');
        }
    ?>
    <article class="page-wrapper">
       <section class="left-content-wrapper">
        <div class="title-wrapper">
            <h1 class="car-title"><?php echo $marka[0].' '.$model[0]; ?></h1>
        </div>
        <div class="parameters">
		<h4>Cena: <?php echo $cena[0]; ?> PLN</h4>
		<h4>Kaucja: <?php echo $kaucja[0]; ?> PLN</h4>
            <h4>Parametry</h4>
            <b>Kategoria: </b><?php echo $kategoria[0]; ?><br>
            <b>Nadwozie: </b><?php echo $nadwozie[0]; ?><br>
            <?php if(isset($pojemnosc_silnika[0]) && $pojemnosc_silnika[0] != 0): ?>
                <b>Pojemność silnika: </b><?php echo $pojemnosc_silnika[0]; ?> cm³<br>
            <?php endif; ?> 
            <?php if(isset($moc[0]) && $moc[0] != 0): ?>
                <b>Moc: </b><?php echo $moc[0]; ?> KM<br>
            <?php endif; ?> 
                <b>Rodzaj paliwa: </b><?php echo $rodzaj_paliwa[0]; ?><br>
            <?php if(isset($spalanie[0]) && $spalanie[0] != 0): ?>
                <b>Spalanie: </b><?php echo $spalanie[0]; ?> l/100km<br>
            <?php endif; ?> 
                <b>Skrzynia biegów: </b><?php echo $skrzynia_biegow[0]; ?><br>
            <?php if(isset($naped[0]) && $naped[0] != 0): ?>
                <b>Napęd: </b><?php echo $naped[0]; ?><br>            
            <?php endif; ?> 
            <?php if(isset($przebieg[0]) && $przebieg[0] != 0): ?>
                <b>Przebieg: </b> <?php echo $przebieg[0] . ' km'; ?><br>
            <?php endif; ?> 
            <?php if(isset($liczba_drzwi[0]) && $liczba_drzwi[0] != 0): ?>
                <b>Liczba drzwi: </b><?php echo $liczba_drzwi[0]; ?><br>
            <?php endif; ?> 
            <?php if(isset($liczba_miejsc[0]) && $liczba_miejsc[0] != 0): ?>
                <b>Liczba miejsc: </b><?php echo $liczba_miejsc[0]; ?><br>
            <?php endif; ?> 
            <?php if(isset($pojemnosc_bagaznika[0]) && $pojemnosc_bagaznika[0] != 0): ?>
                <b>Pojemność bagażnika: </b><?php echo $pojemnosc_bagaznika[0]; ?> l<br>
            <?php endif; ?> 
            <?php if(isset($kolor[0]) && $kolor[0] != 0): ?>
                <b>Kolor: </b><?php echo $kolor[0]; ?><br> 
            <?php endif; ?> 
            <?php if(isset($wyposazenie_dodatkowe[0]) && $wyposazenie_dodatkowe[0] != ''): ?>
                <b>Wyposażenie dodatkowe: </b><br><?php echo $wyposazenie_dodatkowe[0]; ?>
            <?php endif; ?> 
        </div>
        </section>
        <section class="right-content-wrapper">
            <div class="cars-grid-wrapper">
                <div class="car-img-wrapper">
                    <?php if (isset($linki_zdjec[0])):           
                        for($i=0; $i<10;$i++): 
                           if (isset($linki_zdjec [$i])): ?>
                                <a class="grouped_elements" rel="group1" href="<?php echo $linki_zdjec[$i]; ?>">
                                    <img src="<?php echo $linki_zdjec[$i]; ?>" alt="" class="show-car-img">
                                </a>
                            <?php endif; ?>
                        <?php endfor; ?>            
                    <?php else: ?>
                     <img src="<?php echo base_url(); ?>uploads/zdjecia/brak-zdjecia-auta.jpg" alt="wynajem-aut<?php echo $marka[0]."-".$model[0]; ?>">
                    <?php endif; ?>
                </div>
            </div>
        </section>
    </article>
    <script>
    $(document).ready(function() {
	$("a.grouped_elements").fancybox({
		'transitionIn'	:	'elastic',
		'transitionOut'	:	'elastic',
		'speedIn'		:	300, 
		'speedOut'		:	200, 
        'titlePosition' 	: 'over',
        'titleFormat'		: function(title, currentArray, currentIndex, currentOpts) {
					return '<span id="fancybox-title-over">Zdjęcie ' + (currentIndex + 1) + ' z ' + currentArray.length + (title.length ? ' &nbsp; ' + title : '') + '</span>';
				}
	});
	
});
</script>
<?php include 'partials/footer.php'?>