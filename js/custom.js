$(document).ready(function () {
    // Navbar Responsive
    $(".header .container .navbar .list").on("click", function () {
        $(".navbarR").fadeIn();
        $(".header .container .navbar, .footer ,main").css("opacity","0.2");
    });

    $(".navbarR .close").on("click", function () {
        $(".navbarR").fadeOut();
        $(".header .container .navbar, .footer ,main").css("opacity","1");
    });


    // Arrow Button
    $(window).on("scroll", function () {
        $(".arrow").fadeIn();
        if($(window).scrollTop() == 0){
            $(".arrow").fadeOut();
        }
    });
    $(".arrow").on("click", function() {
        $(window).scrollTop(0);
    });


        
    // increment $ decrement button
    $(".incrementButton").on("click", function (e) {
        e.preventDefault();
        
        var quantity = $(".qty").val();
        var value = parseInt(quantity , 10);
        value = isNaN(value) ? 0 : value;
        if(value < 10 ){
            value++;
            $(".qty").val(value);
        }
    });
    
    $(".decrementButton").on("click", function (e) {
        e.preventDefault();
        
        var quantity = $(".qty").val();
        var value = parseInt(quantity , 10);
        value = isNaN(value) ? 0 : value;
        if(value > 1 ){
            value--;
            $(".qty").val(value);
        }
    });

})