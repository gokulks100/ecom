$(document).ready(function () {

    $(".my-rating-readonly").starRating({
        totalStars: 5,
        starShape: 'rounded',
        starSize: 15,
        emptyColor: 'lightgray',
        hoverColor: '#F3DB01',
        activeColor: '#F3DB01',
        useGradient: false,
        readOnly: true,
    });

    $(".my-rating").starRating({
        totalStars: 5,
        starSize: 20,
        emptyColor: 'lightgray',
        hoverColor: '#F3DB01',
        activeColor: 'lightgray',
        useGradient: false,
        disableAfterRate: false,
        ratedColor: '#F3DB01',
        emptyColor: 'lightgray',
        useFullStars: true,
        callback: function (currentRating, $el) {
            $('#rating').val(currentRating);
            console.log('DOM element ', $el);
        }
    });

});
