var findseat = 209, 
paper, 
darkcolor = '#442255',
lightcolor = '#2398d4';

$(function(){
    r = new XMLHttpRequest();

    r.open("GET", "img/duarte-hq-map.svg", true);
    r.onload = function(data){
        svg = r.responseText;
        $('body').append( svg );
        dostuff();
        // console.log("hello");
    };
    r.send();
});

function dostuff(){

    seat = $('#pos'+findseat).find('circle');
    seat.attr('fill', darkcolor);

    seat.on('mouseover', function(){
        seat.attr('fill', lightcolor);
    }).
    on('mouseout', function(){
        seat.attr('fill', darkcolor)
    })
    .on('click', function(){
        alert(findseat);
    });
}
    