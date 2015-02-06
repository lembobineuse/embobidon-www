(function (window, $) {
"use strict";

var Embobidon = window.Embobidon;

function getComments ()
{
    return $.ajax({
        url: Embobidon.api.comment_list,
        dataType: 'json'
    });
}

function renderComments (data)
{
    var container = $('<div class="comment-list"/>'),
        html = ''
    ;
    $.each(data.result, function (i, item) {
        html +=
            '<div class="comment">' +
                '<div class="comment__donation">' +
                    item.donation +
                '</div>' +
                '<div class="comment__supporter">' +
                    item.name +
                '</div>' +
                '<div class="comment__content">' +
                    item.comment +
                '</div>' +
            '</div>'
        ;
    });
    return container.html(html);
}

$(function()
{
    $('html').removeClass('no-js').addClass('js');

    $('.fancybox').fancybox({
        padding: 0,
        helpers : {
            media : {}
        }
    });

    $.getJSON(
        'http://api.helloasso.com/l-embobineuse',
        function (data) {
            $('.campaign-amount').html(data.funding + ' €');
            $('.campaign-contributors')
                .html(data.supporters)
                .parent()
                    .css('cursor', 'pointer')
                    .on('click', function () {
                        $.fancybox.showLoading();
                        getComments().done(function (data) {
                            var el = renderComments(data);
                            $.fancybox(el, { maxWidth: 720 });
                        }).always(function () {
                            $.fancybox.hideLoading();
                        });
                    })
            ;
        }
    );

    $('.image-wall').imageWall({ maxHeight: 300 });

    if ($('#supporters').length) {
        $.fancybox.showLoading();
        getComments().done(function (data) {
            var el = renderComments(data);
            $('#supporters').append(el);
        }).always(function () {
            $.fancybox.hideLoading();
        });
    }

});

}(this, this.jQuery));
