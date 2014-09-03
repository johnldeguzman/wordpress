var $ = jQuery.noConflict();

(function($,sr){

  var debounce = function (func, threshold, execAsap) {
      var timeout;

      return function debounced () {
          var obj = this, args = arguments;
          function delayed () {
              if (!execAsap)
                  func.apply(obj, args);
              timeout = null;
          };

          if (timeout)
              clearTimeout(timeout);
          else if (execAsap)
              func.apply(obj, args);

          timeout = setTimeout(delayed, threshold || 100);
      };
  }

  jQuery.fn[sr] = function(fn){  return fn ? this.bind('resize', debounce(fn)) : this.trigger(sr); };

})(jQuery,'smartresize');


function sliderResize(){
    $('.pb_slider').each(function(){
        $(this).height($(this).find('.slide.active .slide-wrapper').height());
    });
}

jQuery(window).load(function(){
    var angle = 0;

    $('.pb_slider').each(function(){
        $(this).find('.slide:odd').addClass('odd');
    });

    $('.pb_slider .navigation-right').click(function(){
        if ($(this).parent().find('.active').is(':last-child') == false) {
            angle = (-180 * ($(this).parent().find('.active').index()+1));
            var angledeg = 'rotateY(' + angle + 'deg)';

            $(this).parent().find('.rotator').css({
                "-webkit-transform": angledeg,
                "-moz-transform": angledeg,
                "-o-transform": angledeg,
                "-ms-transform": angledeg,
                "transform": angledeg
            });
            $(this).parent().find('.active').next().toggleClass('active');
            $(this).parent().find('.active:first').toggleClass('active');
        }
        else {
            angle = 0;
            var angledeg = 'rotateY(' + angle + 'deg)';

            $(this).parent().find('.rotator').css({
                "-webkit-transform": angledeg,
                "-moz-transform": angledeg,
                "-o-transform": angledeg,
                "-ms-transform": angledeg,
                "transform": angledeg
            });
            $(this).parent().find('.active:last').toggleClass('active');
            $(this).parent().find('.slide').css("opacity","1").delay(250).queue(function(){
                $(this).parent().find('.slide').removeAttr('style').stop();
            });
            $(this).parent().find('.slide:first').toggleClass('active');
        }
        $(this).parent().height($(this).parent().find('.slide.active .slide-wrapper').height());
    });

    $('.pb_slider .navigation-left').click(function(){

        if ($(this).parent().find('.active').is(':first-child') == false) {
            angle = -1* (180 * ($(this).parent().find('.active').index()-1));

            var angledeg = 'rotateY(' + angle + 'deg)';

            $(this).parent().find('.rotator').css({
                "-webkit-transform": angledeg,
                "-moz-transform": angledeg,
                "-o-transform": angledeg,
                "-ms-transform": angledeg,
                "transform": angledeg
            });
            $(this).parent().find('.active').prev().toggleClass('active');
            $(this).parent().find('.active:last').toggleClass('active');
        }
        else {
            angle = -180 * $(this).parent().find('.rotator > .slide').length + 180;
            var angledeg = 'rotateY(' + angle + 'deg)';

            $(this).parent().find('.rotator').css({
                "-webkit-transform": angledeg,
                "-moz-transform": angledeg,
                "-o-transform": angledeg,
                "-ms-transform": angledeg,
                "transform": angledeg
            });
            $(this).parent().find('.active:first').toggleClass('active');
            $(this).parent().find('.slide').css("opacity","1").delay(250).queue(function(){
                $(this).parent().find('.slide').removeAttr('style').stop();
            });
            $(this).parent().find('.slide:last').toggleClass('active');

        }
        $(this).parent().height($(this).parent().find('.slide.active .slide-wrapper').height());
    });

    $('.pb_slider').each(function(){
        $(this).find('.slide:first').addClass("active");
    });
	
    $('.pb_slider').height($('.slide.active .slide-wrapper').height());

});

jQuery(window).smartresize(function(){
    sliderResize();
});