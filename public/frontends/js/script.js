// back to top
// When the user scrolls down 20px from the top of the document, show the button

window.onscroll = function() { scrollFunction() };

function scrollFunction() {
    if (document.body.scrollTop > 200 || document.documentElement.scrollTop > 200) {
        document.getElementById("myBtn").style.display = "block";
    } else {
        document.getElementById("myBtn").style.display = "none";
    }
}

// When the user clicks on the button, scroll to the top of the document
function topFunction() {
    document.body.scrollTop = 0;
    document.documentElement.scrollTop = 0;
}

// navbar
$(window).scroll(function() {
    if ($(this).scrollTop() > 0) {
        $(".navbar-me").addClass("fixed-me");
        $(".top-nav").css("display", "none");
        $(".fix-nav").css("display", "block");


    } else {
        $(".navbar-me").removeClass("fixed-me");
        $(".top-nav").css("display", "block");
        $(".fix-nav").css("display", "none");
    }
});
// partical js