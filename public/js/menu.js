$(document).ready(function () {
     $('.btn-menuweb').click(function () {
        if ($('.contenedor-menu').hasClass('active')) {
            
            $('.contenedor-menu').removeClass('active');
            $('.contenedor-menu').animate({right: "-=300px"});
            $(this).removeClass('active-btn');   
            $(this).animate({right: "0px"});
            $('body').removeClass('margin');

        } else {
             if ($(document).width() > 1000) {
                    $(this).addClass('active-btn');
                    $(this).animate({right: "280px"});
             }else{
                 $(this).addClass('active-btn');
                 $(this).animate({right: "250px"});  
             }
            $('.contenedor-menu').addClass('active');
            $('.contenedor-menu').animate({right: "00px"});
            
            $('body').addClass('margin');
        } 
    });
/*cuando le demos click al li que contiene submenu eje cuta esta funcion*/
    $('.menu li:has(ul)').click(function (e) {
        //evita que redireccione
        e.preventDefault();
        //si el li que clikeamos tiene la clase activado hacemos eso
        if ($(this).hasClass('activado')) {
            //si damos clik y tiene la clase se la quitamos y hacemos que se esconda el submenu con slideup
            $(this).removeClass('activado');
            $(this).children('ul').slideUp();
            //si le damos click y no tiene la clase activado hacemos eso
        } else {
            //si damos click y no tiene la clase escondemos todos los submenu y mostramos solo al que le dieron click
            $('.menu li ul').slideUp();
            $('.menu li').removeClass('activado');
            $(this).addClass('activado');
            $(this).children('ul').slideDown();
        }
    });
    //mostar el menu con el boton
    $('.btn-menu').click(function () {
        $('.contenedor-menu .menu').slideToggle();
    });

    $(window).resize(function () {
        if ($(document).width() > 450) {
            $('.contenedor-menu .menu').css({
                'display': 'block'
            });
        }

        if ($(document).width() < 450) {
            $('.contenedor-menu .menu').css({
                'display': 'none'
            });
            $('.menu li ul').slideUp();
            $('.menu li').removeClass('activado');
        }

    });
    $('.menu li ul li a').click(function(){
       window.location.href= $(this).attr("href"); 
    });
});
 