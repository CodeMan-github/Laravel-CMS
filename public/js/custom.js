$(document).ready(function () {

    $('.read_only_raty').raty({
        readOnly: true,
        starHalf: '/plugins/raty/images/star-half.png',
        starOff: '/plugins/raty/images/star-off.png',
        starOn: '/plugins/raty/images/star-on.png',
        score: function() {
            return $(this).attr('data-score');
        }
    });

    $('.article_raty').raty({
        readOnly: true,
        starHalf: '/plugins/raty/images/star-half.png',
        starOff: '/plugins/raty/images/star-off.png',
        starOn: '/plugins/raty/images/star-on.png',
        score: function() {
            return $(this).attr('data-score');
        }
    });

    $('#ratyRating').raty({
        starHalf: '/plugins/raty/images/star-half.png',
        starOff: '/plugins/raty/images/star-off.png',
        starOn: '/plugins/raty/images/star-on.png',
        scoreName: 'star'
    });

    $('.go_page').on('click',function(){
        window.location = $(this).data('href');
    });
});