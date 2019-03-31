<script src="<?php echo base_url(); ?>assets/js/moment.min.js"></script>
<style>@media screen and (min-height:786px){#push{display:none;}}</style>     
<?php
    
    $miesiac = date('n');
    $miesiac_pl = array(1 => 'Styczeń', 'Luty', 'Marzec', 'Kwiecień', 'Maj', 'Czerwiec', 'Lipiec', 'Sierpień', 'Wrzesień', 'Październik', 'Listopad', 'Grudzień');
    $dzien_tyg_pl = array('Mon' => 'Pon', 'Tue' => 'Wto', 'Wed' => 'Śro', 'Thu' => 'Czw', 'Fri' => 'Pią', 'Sat' => 'Sob', 'Sun' => 'Nie');                
?>
  <section>
       
   <h1 class="car-title">Wszystkie rezerwacje</h1>
    <div class="calendar-wrapper">
        <div class="calendar-header-wrapper" id="calendar-header-wrapper-id">
            <div class="calendar-car-header-holder">Pojazdy</div>
            <div class="calendar-month-day-holder">
                <div class="calendar-month-holder">
                    <span><?php echo $miesiac_pl[$miesiac]." ".date('Y'); //miesiąc i zakres dni ?></span>
                    <div class="calendar-month-changer">
                        <i id="left-arrow-calendar-month-changer" class="fas fa-chevron-circle-left"></i>
                        <i id="right-arrow-calendar-month-changer" class="fas fa-chevron-circle-right"></i>
                    </div>
                </div>
                
                <?php for($i=0;$i<7;$i++): ?> 
                        <?php echo '<div class="calendar-day-holder" id="day-of-week-holder-'.$i.'">'; //Dzień z kalendarza ?>
                            <?php 
                                $monday= strtotime('today');
                                $monday = date('y-m-d', $monday);
                                $monday = date_create($monday);
                                date_add($monday, date_interval_create_from_date_string($i. ' days'));
                                echo date_format($monday, 'd')." ";
                                $dzien_tyg = date_format($monday, 'D');
                                $dzien_tyg = $dzien_tyg_pl[$dzien_tyg];
                                echo $dzien_tyg;
                            ?>
                        </div>
                    <?php endfor; ?>
                </div>
            </div>
        <?php $iterator = 0; ?>
        <div class="calendar-all-day-holder">
        <?php foreach($auta as $row): //petla foreach do wyświetlania pojazdów ?> 
                <div class="calendar-single-line-wrapper"> 
                        <?php 
                            echo '<a href="zaplecze/rezerwacje_wybrane_auto/'.$row->id_auta.'" class="show-car-row-link" id="car-row-link-'.$iterator.'">'; 
                            echo '<div class="calendar-single-car-holder" id="single-car-holder-'.$iterator.'">';
                            echo $row->marka." ".$row->model."<br>".$row->nr_rejestracyjny." | ".$row->cena." PLN"; 
                        //nazwa auta i link ?>
                        </div>
                    </a>
                    <div class="calendar-all-day-wrapper">
                        <?php for($i=0;$i<7;$i++): ?> 
                            <?php echo '<div class="calendar-single-day-holder" id="single-day-of-week-holder-'.$iterator.'-'.$i.'">' //Dzień z kalendarza ?>

                            </div>
                            
                        <?php endfor; ?>
                    </div>
                </div>   
                <?php $iterator++; ?> 
        <?php endforeach;?> 
        </div>
     </div>
    </div>
</section>
</div>

<script>
    $(function(){
        window.justNow = moment().format('D-MM-YYYY');
        
        downloadReservations(justNow);
        
        $('#left-arrow-calendar-month-changer').click(function() { changeDays(-7) });
        $('#right-arrow-calendar-month-changer').click(function() { changeDays(7) });
});
    
$(window).resize(function() {
    downloadReservations(justNow);
});

    function downloadReservations(justNow) {
        
        var fromDay = moment(justNow, 'D-MM-YYYY').format('YYYY-MM-D');
        var toDay = moment(justNow, 'D-MM-YYYY').add(6, 'days').format('YYYY-MM-D');
        var numLines = $('.calendar-single-car-holder').length;
        var numColumns = ($('.calendar-single-day-holder').length) / numLines;
        
        $('.calendar-month-holder span').text(moment(fromDay).format('D MMM YYYY')+' - '+moment(toDay).format('D MMM YYYY'))
        
        $.ajax({
            url: "<?php echo base_url(); ?>zaplecze/pobierz_wszystkie_rezerwacje",
            method: "POST",
            dataType: "json",
            data: {"odkiedy" : fromDay, "dokiedy" : toDay},
            success: function(rezerwacje) {
                if (rezerwacje == null)
                {
                    for(j=0; j<numLines; j++)
                    {
                        for (k=0; k<numColumns; k++)
                        {
                            $('#single-day-of-week-holder-'+j+'-'+k).text('');
                        }
                    }
                }
                else
                {
                    var doKiedy = '';
                    for(j=0; j<numLines; j++)
                    {
                        var url = $('#car-row-link-'+j).attr("href");
                        var piecesOfUrl = url.split("/");
                        var dayCounter = 0;
                        for (k=0; k<numColumns; k++)
                        {
                            var nextDay = moment(justNow, 'D-MM-YYYY').add(k, 'days').format('YYYY-MM-D');
                            
                            $.each(rezerwacje, function(i, item) {
                                
                                if(piecesOfUrl[2] == rezerwacje[i].id_auta)
                                { 
                                    //console.log('id_ok'); 
                                    if (moment(nextDay, 'YYYY-MM-D').isSameOrBefore(rezerwacje[i].do_kiedy)  && moment(nextDay, 'YYYY-MM-D').isSameOrAfter(rezerwacje[i].od_kiedy))
                                    {
                                        if ($('#reservation-'+j+'-'+(k-1)) && rezerwacje[i].do_kiedy == doKiedy)
                                        {
                                            dayCounter++;
                                            if(dayCounter > 1 && $('#single-day-of-week-holder-'+j+'-'+k + '> div:first-child'))
                                                {
                                                    $('#single-day-of-week-holder-'+j+'-'+k + '> div:first-child').remove();
                                                }
                                            //console.log(dayCounter);
                                            var reservationWidth = $('#reservation-'+j+'-'+(k-dayCounter+1)).width();
                                            var singleDayWidth = $('#single-day-of-week-holder-'+j+'-'+k).width();
                                            
                                            if(dayCounter == 2)
                                            {
                                                $('#reservation-'+j+'-'+(k-dayCounter+1)).width(reservationWidth+singleDayWidth+1);    
                                            }
                                            if(dayCounter == 3 || dayCounter == 5 || dayCounter == 7)
                                            {
                                                $('#reservation-'+j+'-'+(k-dayCounter+1)).width(reservationWidth+singleDayWidth+1);    
                                            }
                                            if(dayCounter == 4 || dayCounter == 6)
                                            {
                                                $('#reservation-'+j+'-'+(k-dayCounter+1)).width(reservationWidth+singleDayWidth+1);    
                                            }
                                            
                                            //console.log('poszerzam div');
                                            return false;
                                        }
                                        else
                                        {
                                            var reserevationTitle = rezerwacje[i].tytul_rezerwacji;
                                            var reservationFromDay = moment(rezerwacje[i].od_kiedy);
                                            var reservationToDay = moment(rezerwacje[i].do_kiedy);
                                            $('#single-day-of-week-holder-'+j+'-'+k + '> div:first-child').remove();
                                            $('#single-day-of-week-holder-'+j+'-'+k).append( '<div class="reservation-exists" id="reservation-'+j+'-'+k+'"></div>' );
                                            
                                            if(reserevationTitle == "Wypożyczony")
                                            {
                                               $('#reservation-'+j+'-'+k).css({ background: "#ffa9a9"});
                                               $('#reservation-'+j+'-'+k).html(moment(reservationFromDay).format('D MMM')+' '+' - '+moment(reservationToDay).format('D MMM')+'<br>Wyp.');
                                            }
                                            if(reserevationTitle == "Prywatne wypożyczenie")
                                            {
                                               $('#reservation-'+j+'-'+k).css({ background: "#c2adff"});
                                                $('#reservation-'+j+'-'+k).html(moment(reservationFromDay).format('D MMM')+' '+' - '+moment(reservationToDay).format('D MMM')+'<br>Pryw. wyp.');
                                            }
                                            if(reserevationTitle == "Zarezerwowany")
                                            {
                                               $('#reservation-'+j+'-'+k).css({ background: "#ffdbbc"});
                                                $('#reservation-'+j+'-'+k).html(moment(reservationFromDay).format('D MMM')+' '+' - '+moment(reservationToDay).format('D MMM')+'<br>Zarez.');
                                            }
                                            if(reserevationTitle == "Serwis")
                                            {
                                               $('#reservation-'+j+'-'+k).css({ background: "#bce6ff"});
                                                $('#reservation-'+j+'-'+k).html(moment(reservationFromDay).format('D MMM')+' '+' - '+moment(reservationToDay).format('D MMM')+'<br>Serwis');
                                            }
                                            //console.log('dodaje div');
                                            doKiedy = rezerwacje[i].do_kiedy;
                                            dayCounter = 1;
                                            
                                        }
                                        //console.log('jest rezerwacja');
                                            return false;
                                    }
                                    else
                                    {
                                        $('#single-day-of-week-holder-'+j+'-'+k).text('');
                                        //console.log(dayCounter);
                                    } 
                                }
                                else
                                {
                                    $('#single-day-of-week-holder-'+j+'-'+k).text('');
                                    //console.log('zle id');
                                }
                            });
                        }
                    }
                }
            },
            error: function() {
                console.log('error in ajax request!');
            }
        })    
    }
    
    function changeDays(amountDays) {
    
    var counter = 7;
    
    if(amountDays < 0)
    {
        for(i=0; i<7; i++)
        {   
            var id = '#day-of-week-holder-' + i; 
            var dataWstecz = moment(justNow, 'D-MM-YYYY').subtract(counter, 'days').format('D ddd');
            counter--;
            $(id).text(dataWstecz);
        }
        justNow = moment(justNow, 'D-MM-YYYY').subtract(7, 'days').format('D-MM-YYYY');
    }
    if(amountDays > 0)
    {
        for(i=0; i<7; i++)
        {
            var id = '#day-of-week-holder-' + i; 
            var dataWstecz = moment(justNow, 'D-MM-YYYY').add(counter, 'days').format('D ddd');
            counter++;
            $(id).text(dataWstecz);
        }
        justNow = moment(justNow, 'D-MM-YYYY').add(7, 'days').format('D-MM-YYYY');
    }
        downloadReservations(justNow);
}
</script>
