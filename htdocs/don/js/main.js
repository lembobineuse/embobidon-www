(function (window, $) {
"use strict";

var Embobidon = window.Embobidon;

$(function()
{
    $('.fancybox').fancybox({
        padding: 0,
        helpers : {
            media : {}
        }
    });
    $.getJSON(
        Embobidon.api.stats,
        function (data) {
            console.log(data);
            $('.campaign-amount').html(data.amount);
            $('.campaign-donators').html(data.number);
        }
    );
});

}(this, this.jQuery));
