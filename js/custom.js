// Get Current Year
function getCurrentYear() {
    var d = new Date();
    var year = d.getFullYear();
    document.querySelector("#displayDateYear").innerText = year;
}
getCurrentYear()

$(document).ready(function() {


    $("#owl-demo").owlCarousel({
        navigation : true, // Show next and prev buttons
        slideSpeed : 300,
        paginationSpeed : 400,
        loop: true,
        autoplay: true,
        autoPlaySpeed: 1000,
        autoPlayTimeout: 1000,
        items : 1,
        itemsDesktop : false,
        itemsDesktopSmall : false,
        itemsTablet: false,
        itemsMobile : false
    });

});

function goToAbout() {
    const select = document.querySelector('#about-sec');
    $('html, body').animate({scrollTop: select.offsetTop}, 'slow');
}

function goToEvent() {
    const select = document.querySelector('#upcoming-event');
    $('html, body').animate({scrollTop: select.offsetTop}, 'slow');
}


function register() {
    window.location.href = 'https://docs.google.com/forms/d/e/1FAIpQLSfsl6PW1S3CUUAMPZGY4oQBVZcJjkNNDJZ-s3_PKIxlGrfHrg/viewform';
}

