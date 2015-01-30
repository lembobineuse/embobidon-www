(function (window, $) {
"use strict";

// DOMContentLoaded handler
$(function()
{
    $('.fancybox').fancybox({
        padding: 0,
        helpers : {
            media : {}
        }
    });
    // Scrape campaign results HelloAsso using YQL API
    // See: https://developer.yahoo.com/yql/console 
    $.getJSON(
        $('.campaign-results').attr('data-href'),
        function (data) {
            console.log(data);
            $('.campaign-amount').html(data.amount);
            $('.campaign-donators').html(data.number);
        }
    );

});

}(this, this.jQuery));
