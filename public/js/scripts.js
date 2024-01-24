

//How Work slider
$('.workSlider').slick({
    slidesToShow: 3,
    slidesToScroll: 1,
    focusOnSelect: true,
    autoplay: false,
    infinite: true,
    draggable: true,
    swipeToSlide: true,
    dots: true,
    pauseOnHover: true,
    centerMode: false,
    appendArrows: $('.workSlider-nav'),
    responsive: [
        {
            breakpoint: 1599.98,
            settings: {slidesToShow: 2,}
        },
        {
            breakpoint: 991.98,
            settings: {slidesToShow: 2,}
        },
        {
            breakpoint: 766.98,
            settings: {slidesToShow: 2,}
        },
        {
            breakpoint: 524.98,
            settings: {slidesToShow: 1,}
        },
    ]
});
//How Work slider

//How Work slider
$('.yourRideSlider').slick({
    slidesToShow: 3,
    slidesToScroll: 1,
    focusOnSelect: true,
    autoplay: false,
    infinite: true,
    draggable: true,
    swipeToSlide: true,
    dots: true,
    arrows:false,
    pauseOnHover: true,
    centerMode: false,
    responsive: [
        {
            breakpoint: 1599.98,
            settings: {slidesToShow: 3,}
        },
        {
            breakpoint: 991.98,
            settings: {slidesToShow: 2,}
        },
        {
            breakpoint: 766.98,
            settings: {slidesToShow: 2,}
        },
        {
            breakpoint: 524.98,
            settings: {slidesToShow: 1,}
        },
    ]
});
//How Work slider

//sticky header
$(window).scroll(function () {
    if ($(this).scrollTop() > 150) {
        $('header').addClass('sticky')
    } else {
        $('header').removeClass('sticky')
    }
});
//sticky header

// Booking Section Start
// Location Favorite
$(".locationFavorite").click(function(){
    $(this).toggleClass("fill")  ;
})
// Location Favorite

// Note Show
$(function () {
    $("#driverNoteCheck").click(function () {
        if ($(this).is(":checked")) {
            $(".noteBox").show();
        } else {
            $(".noteBox").hide();
        }
    });
});
// Note Show

//Ride type radio
function show1(){
    document.getElementById('typeRide').style.display = 'block';
    document.getElementById('typeSchedule').style.display ='none';
}
function show2(){
    document.getElementById('typeRide').style.display ='none';
    document.getElementById('typeSchedule').style.display = 'block';
}
//Ride type radio

$("#paymentBtn").click(function(){
    $('.paymentOptions').removeClass("d-none") ;
    $('.locationFrame').addClass("d-none") ;
});

$(".paymentOptions #backBtn").click(function(){
    $('.paymentOptions').addClass("d-none") ;
    $('.locationFrame').removeClass("d-none") ;
});

$("#debitCredit").click(function(){
    $('.cardDetails').removeClass("d-none") ;
    $('.paymentOptions').addClass("d-none") ;
});

$(".cardDetails #backBtn").click(function(){
    $('.cardDetails').addClass("d-none") ;
    $('.paymentOptions').removeClass("d-none") ;
});

$(".cardDetails #saveCard").click(function(){
    $('.cardDetails').addClass("d-none") ;
    $('.locationFrame').removeClass("d-none") ;
});

$("#upi").click(function(){
    $('.upiDetails').removeClass("d-none") ;
    $('.paymentOptions').addClass("d-none") ;
});

$(".upiDetails #backBtn").click(function(){
    $('.upiDetails').addClass("d-none") ;
    $('.paymentOptions').removeClass("d-none") ;
});

$(".upiDetails #saveUpi").click(function(){
    $('.upiDetails').addClass("d-none") ;
    $('.locationFrame').removeClass("d-none") ;
});


$(".paymentOptions #savePaymentOptions").click(function(){
    $('.paymentOptions').addClass("d-none") ;
    $('.locationFrame').removeClass("d-none") ;
});


$("#scheduleRideBtn").click(function(){
    $('.locationFrame').addClass("d-none") ;
    $('.scheduleRide').removeClass("d-none") ;
});

$(".scheduleRide #backBtn").click(function(){
    $('.scheduleRide').addClass("d-none") ;
    $('.locationFrame').removeClass("d-none") ;
});

$("#scheduledRideBtn").click(function(){
    $('.scheduleRide').addClass("d-none") ;
    $('.scheduledRide').removeClass("d-none") ;
});

$("#scheduledRideDone").click(function(){
    $('.scheduledRide').addClass("d-none") ;
    $('.locationFrame').removeClass("d-none") ;
});

$("#bookRideBtn").click(function(){
    $('.locationFrame').addClass("d-none") ;
    $('.servicesList').removeClass("d-none") ;
});

$(".servicesList #backBtn").click(function(){
    $('.servicesList ').addClass("d-none") ;
    $('.locationFrame').removeClass("d-none") ;
});

$("#confirmRideBtn").click(function(){
    $('.servicesList').addClass("d-none") ;
    $('.confirmRide').removeClass("d-none") ;
});

$("#confirmRideDone").click(function(){
    $('.confirmRide').addClass("d-none") ;
    $('.rideComplete').removeClass("d-none") ;
});

$("#bookNewRide").click(function(){
    $('.rideComplete').addClass("d-none") ;
    $('.locationFrame').removeClass("d-none") ;
});

$("#writeReviewBtn").click(function(){
    $('.rideComplete').addClass("d-none") ;
    $('.reviewBox').removeClass("d-none") ;
});

$("#writeTextReview").click(function(){
    $('.reviewBox').addClass("d-none") ;
    $('.writeReviewBox').removeClass("d-none") ;
});

$(".writeReviewBox #backBtn").click(function(){
    $('.writeReviewBox ').addClass("d-none") ;
    $('.reviewBox').removeClass("d-none") ;
});


$("#rideCompleteBtn").click(function(){
    $('.rideComplete').addClass("d-none") ;
    $('.rideCompleteDetail').removeClass("d-none") ;
});

$(".rideCompleteDetail #backBtn").click(function(){
    $('.rideCompleteDetail ').addClass("d-none") ;
    $('.rideComplete').removeClass("d-none") ;
});

// Booking Section End

//Profile Section Start

$("#editName").click(function(){
    $('.profileDetailsWrap').addClass("d-none") ;
    $('.editNameCard').removeClass("d-none") ;
});

$(".editNameCard #cancel").click(function(){
    $('.editNameCard ').addClass("d-none") ;
    $('.profileDetailsWrap').removeClass("d-none") ;
});

$("#editNumber").click(function(){
    $('.profileDetailsWrap').addClass("d-none") ;
    $('.editNumberCard').removeClass("d-none") ;
});

$(".editNumberCard #cancel").click(function(){
    $('.editNumberCard ').addClass("d-none") ;
    $('.profileDetailsWrap').removeClass("d-none") ;
});

$("#editEmail").click(function(){
    $('.profileDetailsWrap').addClass("d-none") ;
    $('.editEmailCard').removeClass("d-none") ;
});

$(".editEmailCard #cancel").click(function(){
    $('.editEmailCard ').addClass("d-none") ;
    $('.profileDetailsWrap').removeClass("d-none") ;
});

//Profile Section End


//date picker
$( function() {
    // var natDays = [
    //     [1, 26, 'au'], [2, 6, 'nz'], [3, 17, 'ie'],
    //     [4, 27, 'za'], [5, 25, 'ar'], [6, 6, 'se'],
    //     [7, 4, 'us'], [8, 17, 'id'], [9, 7, 'br'],
    //     [10, 1, 'cn'], [11, 22, 'lb'], [12, 12, 'ke']
    // ];
    var natDays = [
        ['au'], ['nz'], ['ie'],
        ['za'], ['ar'], ['se'],
        ['us'], ['id'], ['br'],
        ['cn'], ['lb'], ['ke']
    ];
    // console.log(natDays);
    $( "#datepicker" ).datepicker({
        minDate: 0,
        // beforeShowDay: noWeekendsOrHolidays
    });

    function noWeekendsOrHolidays(date) {
        var noWeekend = $.datepicker.noWeekends(date);
        if (noWeekend[0]) {
            return nationalDays(date);
        } else {
            return noWeekend;
        }
    }
    function nationalDays(date) {
        for (i = 0; i < natDays.length; i++) {
            if (date.getMonth() == natDays[i][0] - 1
                && date.getDate() == natDays[i][1]) {
                return [false, natDays[i][2] + '_day'];
            }
        }
        return [true, ''];
    }
} );
//date picker

//Profile Image Start

function readURL(input) {
    if (input.files && input.files[0]) {
        var reader = new FileReader();
        reader.onload = function(e) {
            $('#imagePreview').css('background-image', 'url('+e.target.result +')');
            $('#imagePreview').hide();
            $('#imagePreview').fadeIn(650);
        }
        reader.readAsDataURL(input.files[0]);
    }
}
$("#imageInput01").change(function() {
    readURL(this);
});

//Profile Image End

// Booking History Start
$(document).ready(function(){

    $(".filter-button").click(function(){
        var value = $(this).attr('data-filter');
        console.log('yes');
        if(value == "all")
        {
            //$('.filter').removeClass('hidden');
            $('.filter').show('1000');
        }
        else
        {
//            $('.filter[filter-item="'+value+'"]').removeClass('hidden');
//            $(".filter").not('.filter[filter-item="'+value+'"]').addClass('hidden');
            $(".filter").not('.'+value).hide('3000');
            $('.filter').filter('.'+value).show('3000');

        }

        if ($(".filter-button").removeClass("active")) {
            $(this).removeClass("active");
        }
        $(this).addClass("active");
    });

});

// Booking History End

// File Upload Start

$('document').ready(function(){

    var $file = $('#file-input'),
        $label = $file.next('label'),
        $labelText = $label.find('span'),
        $labelRemove = $('i.remove'),
        labelDefault = $labelText.text();

    // on file change
    $file.on('change', function(event){
        var fileName = $file.val().split( '\\' ).pop();
        if( fileName ){
            console.log($file)
            $labelText.text(fileName);
            $labelRemove.show();
        }else{
            $labelText.text(labelDefault);
            $labelRemove.hide();
        }
    });
})

// File Upload End
