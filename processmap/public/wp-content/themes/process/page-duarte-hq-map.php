<?php
get_header(); 
the_post();
?>

<script>
    <?php

        $seatCapacityTotal = 178;


// PEOPLE SEARCH
        $HQcount = 0;
        $teamCount = 0;
        $teamList = array();
        $args = array(
            'post_type'   => 'people', 
            'order'       => 'asc', 
            'orderby'     => 'title', 
            'numberposts' => -1, 
            'post_status' => 'publish', 
            'post_parent' => null
        ); 
        $i=0;
        $attachments = get_posts( $args );

        if ($attachments) {
            foreach ( $attachments as $person ) {
                // echo "<li>";
                $post = $person;
                setup_postdata($post);
                
                $cat = get_the_category($post->ID);
                $name = $post->post_title;

                $firstName = get_field('people-first-name');
                $personLink = get_permalink();
                $pictureLink = get_field('people-bio-photo');
                // echo $pictureLink;
                $seatNumber = get_field('people-seat-number');
                $email = get_field('people-email-address');
                $location = get_field('people-location');
                

                $posts = get_field('people-team');

                if( $posts ) {
                    foreach( $posts as $post) { // variable must be called $post (IMPORTANT) 
                        setup_postdata($post); 
                        $teamLink = get_permalink();
                        $teamTitle = get_the_title();
                    }
                    wp_reset_postdata(); // IMPORTANT - reset the $post object so the rest of the page works correctly 
                }

                $post = $person;
                setup_postdata($post);
                // if (is_numeric($teamTitle)) {
                //                     $teamTitle = "Team ".$teamTitle;
                //                 }

                $teamList[$i]=$teamTitle;


                // write to the 'seats' array
                $seats[$i] = array(
                    'type'=>"person", 'seatNumber'=>$seatNumber, 'name'=>$name, 'team'=>$teamTitle, 'pictureLink'=>$pictureLink, 'email'=>$email, 'location'=>$location
                );

                if ($location == 'Silicon Valley') {$HQcount++;} // How many people work at the HQ


                $i++;
            }
        }

        $peopleCount = $i;
        
        $teamList = array_unique($teamList);
        sort($teamList);
        $teamCount=count($teamList);

        // var_dump($teamList);

        $arrayTicker = $i;


// PRINTERS SEARCH
        $args = array(
            'post_type'   => 'printers', 
            'order'       => 'asc', 
            'orderby'     => 'title', 
            'numberposts' => -1, 
            'post_status' => 'publish', 
            'post_parent' => null
        ); 

        $i=1;
        

        $attachments = get_posts( $args );
        if ($attachments) {
            foreach ( $attachments as $printer ) {
                // echo "<li>";
                $post = $printer;
                setup_postdata($post);
                
                $cat = get_the_category($post->ID);

                // pull data from WordPress
                $printerName = $post->post_title;
                if (get_field('printers-address')) {
                    $printerAddress = "IP ".get_field('printers-address');
                } else { $printerAddress = "No IP address on file.";}

                $seatNumber = get_field('printers-seat-number');
                if (get_field('printers-color')) {
                    $color = "Color printer.";
                } else {$color = "Black and white printer.";}

                $notes = get_field('printers-notes');

                // load the data into an array
                $seats[$arrayTicker+$i] = array(
                    'type'=>"printer", 'seatNumber'=>$seatNumber, 'name'=>$printerName, 'address'=>$printerAddress, 'printerColor'=>$color, 'notes'=>$notes);

                

                $i++;
            }
        }

        $printerCount = $i;
        $seatCapacity = $seatCapacityTotal-$printerCount;
        $capacity = round(100*$HQcount/$seatCapacity,1);

        $arrayTicker = $peopleCount + $printerCount;



// ROOMS SEARCH
        $args = array(
            'post_type'   => 'rooms', 
            'order'       => 'asc', 
            'orderby'     => 'title', 
            'numberposts' => -1, 
            'post_status' => 'publish', 
            'post_parent' => null
        ); 

        

        $attachments = get_posts( $args );
        if ($attachments) {
            foreach ( $attachments as $room ) {
                // echo "<li>";
                $post = $room;
                setup_postdata($post);
                
                $cat = get_the_category($post->ID);

                // pull data from WordPress
                $roomName = get_field('rooms-name');
                $seatNumber = get_field('rooms-seat-number');
                $roomSeats = get_field('rooms-seats');
                $roomCapabilities = get_field('rooms-capabilities');
                $roomType = get_field('rooms-type');
                if (get_field('rooms-phone-number')) {
                $roomPhone = get_field('rooms-phone-number');
                } else {$roomPhone = "No phone # on file.";}
                if (get_field('rooms-whiteboard')) {
                    $roomWhiteboard = "This room has a whiteboard.";
                } else {$roomWhiteboard = "This room does not have a whiteboard.";};

                $roomPicture = get_field('rooms-picture');

                // load the data into an array
                $seats[$arrayTicker+$i] = array(
                    'type'=>"room", 'seatNumber'=>$seatNumber, 'name'=>$roomName, 'roomSeats'=>$roomSeats, 'roomCapabilities'=>$roomCapabilities, 'roomType'=>$roomType,'roomPhone'=>$roomPhone, 'roomWhiteboard'=>$roomWhiteboard, 'roomPicture'=>$roomPicture);

                $i++;
            }
        }

        // transfer the "seats" array into javascript from php

        echo "var seats = new Array();";
        for ($i==0;$i<=$peopleCount;$i++) {
        echo " var seats = " . json_encode( $seats ) .";";
        }
    ?>
</script>

<script type="text/javascript" >

    var thisSeat,
    emptySeat = '#8DB6BA',
    highlightColor = 'rgb(133, 135, 5)',
    safetyColor = 'rgb(189, 56, 38)',
    personColor = '#009bb3',
    printerColor = '#cca147',
    roomColor = '#8c8a7a',
    lastTeam;

    $(function(){
        r = new XMLHttpRequest();

        r.open("GET", "../wp-content/themes/process/img/duarte-hq-map-03.svg", true);
        r.onload = function(data){
            svg = r.responseText;
            $('#map').append( svg );
            markSeats();
            
            // console.log("hello");
            setTimeout(function(){$('#fire').fadeOut(2000);},1000);
            var fireViz = false;
            $('#safetymap').on('click',function(){
                if (fireViz) {
                   $('#fire').fadeOut(500);
                   fireViz = false;
                } else {
                    $('#fire').fadeIn(500);
                    fireViz = true;
                }

            });
        };
        r.send();
    });

    function markSeats(){

        var lastSeat;

        $.each( seats, function( key, value ) {
            var seat = this;
            var positionDot = $('#pos'+ seat.seatNumber).find('circle, rect, polygon');
            var lastPositionDot = $('#pos'+ lastSeat).find('circle, rect, polygon');
            var position = $('#pos'+ seat.seatNumber).find('g');
            var radius = positionDot.attr('r');
            var newRadius = radius * 1.4;
            positionDot.attr('stroke', 'none');
            
            if (seat.type =='person') {
                positionDot.attr('fill', personColor);
                positionDot.attr('class',seat.team);
                $("<div />").attr('id',"popup"+seat.seatNumber).appendTo('#map').addClass('seatPopup').html('<div class="text-left"><img style="width:175px" src="'+seat.pictureLink+'"></img><h4 class="thin" style="margin:0; font-style:oblique">'+seat.name+'</h4><small class="color-taupe">'+seat.team+' / <a href="mailto:'+seat.email+'">'+seat.email+'</small></div>').hide();

            }

            if (seat.type =='printer') {
                positionDot.attr('fill', printerColor);
                $("<div />").attr('id',"popup"+seat.seatNumber).appendTo('#map').addClass('seatPopup').html('<div class="text-left"><h4 class="thin" style="margin:0">'+seat.name+'</h4><small class="color-bondi-blue" style = "line-height:1.4">'+seat.address+'<br>'+seat.printerColor+'</small></div>').hide();
            }

            if (seat.type =='room') {
                // $('#pos'+seat.seatNumber).addClass('roomPos');

                

                positionDot.on('mouseover',function(){
                    if ($('#room'+seat.seatNumber).is(":visible")) {
                        return;
                    }
                    positionDot.attr('fill', roomColor);
                }).
                on('mouseout',function(){
                    if ($('#room'+seat.seatNumber).is(":visible")) {return;}
                    positionDot.attr('fill','#e3e3dd');
                }).
                on('click',function(event){
                    $('#roomLayer').find('rect, polygon').attr('fill','#e3e3dd');
                    
                    if ($('#room'+seat.seatNumber).is(":visible")) {
                        return;
                    }
                    thisSeat = positionDot;
                    //lastPositionDot.attr('fill','#e3e3dd');
                    $('.roomPopup').hide();
                    var position = $('#sideBar').offset();
                    $('#room'+seat.seatNumber).fadeIn(200);
                    if ($('#room'+seat.seatNumber).is(":visible")) {
                        positionDot.attr('fill',highlightColor);
                    }
                    
                    event.stopPropagation();
                });
                $("<div />").attr('id',"room"+seat.seatNumber).appendTo('#sideBar').addClass('roomPopup').html('<div class="text-left"><img src="'+seat.roomPicture+'" class="roomPic"><h4 class="thin" style="margin:0">'+seat.name+'</h4><small class="color-bondi-blue" style="line-height:1.4">Room #'+seat.seatNumber+'<br>Seats: <b>'+seat.roomSeats+'</b><br><br>Type: <br>'+'<br>Phone: <b>'+seat.roomPhone+'</b><br><br>Type: <br><b>'+seat.roomType+'</b><br><br>Equipment: <br><b>'+seat.roomCapabilities+'</b><br></small></div>').hide();
            }
            

            positionDot.on('mouseover', function(){
                positionDot.attr('r',newRadius);
            }).
            on('mouseout',function(){
                positionDot.attr('r',radius);
            }).
            on('mouseover',function(event){
                if ($('#popup'+seat.seatNumber).is(":visible")) {return;}
                thisSeat = positionDot;
                $('.seatPopup').fadeOut(200);
                var position = positionDot.offset();
                $('#popup'+seat.seatNumber).css({ position:"absolute",left:position.left-200,top:position.top-220}).fadeIn(200);
                event.stopPropagation();
            });
        });

        $('body').on('click', function(){
            $('.seatPopup').fadeOut(200);
        });
    }

    function teamFilter(team) {
        
        var radius = $("."+team).attr('r');
        var newRadius = radius * 1.4;

        if(team==lastTeam) {    // if user clicks on the same one twice in a row
            $("."+team).fadeOut(50);
            $("."+team).fadeIn(50);
            $("."+team).fadeOut(50);
            $("."+team).fadeIn(50);
            return;
        }
        $("."+team).css( "fill", highlightColor);
        $("."+lastTeam).css( "fill", personColor );
        $("."+team).fadeOut(50); 
        $("."+team).fadeIn(50);
        $("."+team).fadeOut(50);
        $("."+team).fadeIn(50);
        lastTeam = team;
    }

</script>  

<section>
    <div class="row">
        <div class="two columns" id="sideBar" style="float:left">

            
            
            <div class="button dropdown black small expand text-left" >

                <span>Teams</span>

                <ul class="no-hover tiny">

                    <?php 
                        echo "<li onclick='teamFilter(\"all\");'><a >All</a></li>";

                        foreach($teamList as $team) {
                            
                            echo "<li onclick='teamFilter(\"".$team."\");'><a >";
                            if (is_numeric($team)) {
                                    $team = "Team ".$team;
                                }
                            echo $team."</a></li>";
                        }

                    ?>  
                    
                </ul>

            </div>

            

            <div class="button black small expand text-left" style="margin-bottom:10px;" id="safetymap">

                <span>Safety Map</span>

            </div>
            
            


        </div>
        
        <div class="ten columns text-left">
            
            
            <div id="map"></div>
        </div>
    </div>  

    <small class="color-taupe" style="margin-top:20px">General</small>

            <p class="thin" id="capacity" style="margin:0">

                <?php echo "Capacity - $capacity%<br>";
                    echo "Seats - $HQcount/$seatCapacity<br>"; 
                    echo "Teams - $teamCount";
                ?>
            </p>

            <div class="roomPic">
                <img src="http://blog.gettyimages.com/wp-content/uploads/2013/01/Siberian-Tiger-Running-Through-Snow-Tom-Brakefield-Getty-Images-200353826-001.jpg" alt="">
            </div>

</section>

<?php get_footer(); ?>
