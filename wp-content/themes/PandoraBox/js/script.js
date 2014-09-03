var $ = jQuery.noConflict();

jQuery(window).load(function(){

//===== "Send mail" button =====
    $('.mailbutton').click(function(){
        $('.contactsblock .input-container').toggleClass('active');

        if ($('.contactsblock .input-container').hasClass('active')){
            $(this).addClass('active');
        } else {
            $(this).removeClass('active');
        }
        
    });

    $('.contactsblock .input-container form').on("submit", function(){
        if ($(window).width() >= 1024) {
            $(".contactsblock").delay(500).queue(function(){
                $(".contactsblock").height($(".contactsblock .input-container").outerHeight() + 200);
            }); 
        }
    });

//====== Twitter messages rotator ======
    $('.twitterblock .messages-container .imgdisplay:first').addClass('active');

        setInterval(function(){
            $('.twitterblock .messages-container').find('.active').addClass('post-active');
            $('.twitterblock .messages-container').find('.active').removeClass('active');
            $('.twitterblock .messages-container').find('.post-active').next().addClass('active');

            if($('.twitterblock .imgdisplay:last').is('.post-active')){
                $('.twitterblock .imgdisplay:first').addClass('active');
            };

            $('.twitterblock .messages-container').find('.post-active').removeClass('post-active');

        }, 10000);
     
        $('#picture-home').delay(500).queue(function(){
            $(this).addClass('active');
        });
        $('#description-home').addClass('active');

//====== Other ======      

    $('a[href*=#]').on("click", function(e){
        var anchor = $(this);
        var locate =  $.attr(this, 'href').substr($.attr(this, 'href').indexOf('#')+1);

            if ($(window).width() >= 800 || !$(this).parent().hasClass("menu-item-has-children") ){
                $('html, body').stop().animate({
                    scrollTop: $('[id="' + locate + '"]').offset().top
                }, 800, "swing");
            
                $(this).delay(800).queue(function(){ window.location.hash = locate; });
            }
            e.preventDefault();
    });

    $('.gallery').find('br').remove();
});

$(document).ready(function(){
    $('.iconmenu').on("click", function(){
        $('.mainmenu').toggleClass('active');
        $('.iconmenu').toggleClass('active');
        $(document).scrollTop(0);
    });

    $('.menu-item a').on("click", function(){
        if ($(this).parent().hasClass("menu-item-has-children")) {
            $(this).parent().toggleClass('active');
            return false;
        }
        else {
            $('.mainmenu').removeClass('active');
            $('.iconmenu').removeClass('active');
        }

    });
});