(function (window, $) {
"use strict";

// DOMContentLoaded handler
$(function()
{
    $('.fancybox').fancybox();
    $('.fancy_vimeo').click(function() {
        $.fancybox({
            padding: 0,
            autoScale: false,
            transitionIn: 'none',
            transitionOut: 'none',
            title: this.title,
            width: 800,
            height: 500,
            href: 'http://player.vimeo.com/video/' + this.getAttribute('data-video-id') + '?autoplay=1',
            type: 'iframe'
        });
        return false;
    });
});
    
}(this, this.jQuery));
