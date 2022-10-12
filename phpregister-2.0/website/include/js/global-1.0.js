(function($) {
    $.fn.btn = function(action) {
        if (action === "loading" && this.data("loading-text")) {
            this.data("original-text", this.html()).html(this.data("loading-text")).prop("disabled", true);
        }
        if (action === "reset" && this.data("original-text")) {
            this.html(this.data("original-text")).prop("disabled", false).blur();
        }
    };
}(jQuery));


(function($) {
    $.fn.blink = function(number = 3) {
        if(number === 0) {
            while(1) {
                this.fadeTo("slow", 0).delay(200).fadeTo("fast", 1).delay(200);
            }
        } else {
            var i = 0;
            while(i < number) {
                this.fadeTo("slow", 0).delay(200).fadeTo("fast", 1).delay(200);
                i++;
            }
    }
    };
}(jQuery));

function pageScrollTop() {
  $("html, body").animate({ scrollTop: 0 }, 300);
}

function scrollToElem(e, phoneXTop = 0, PCXTop = 0) {
    var xTop = 0;
    if(phoneXTop != 0 && !$("#NavbarPhone").hasClass("dis-n")) {
        xTop = phoneXTop;
    }
    if(PCXTop != 0 && $("#NavbarPhone").hasClass("dis-n")) {
        xTop = PCXTop;
    }
    $("html, body").animate({
        scrollTop: ((e.offset().top) + xTop)
    }, 500);
}


function scrollToElemMiddle(el, phoneXTop = 0, PCXTop = 0) {
    var elOffset = el.offset().top;
    var elHeight = el.height();
    var windowHeight = $(window).height();
    var offset;
    var xTop = 0;    
    if(phoneXTop != 0 && !$("#NavbarPhone").hasClass("dis-n")) {
        xTop = phoneXTop;
    }
    if(PCXTop != 0 && $("#NavbarPhone").hasClass("dis-n")) {
        xTop = PCXTop;
    }
    if (elHeight < windowHeight) {
        offset = elOffset - ((windowHeight / 2) - (elHeight / 2));
    }
    else {
        offset = elOffset;
    }    
    $("html, body").animate({
        scrollTop: (offset + xTop)
    }, 500);
    return false;
}

$("input[type=radio]").change(function() {
    $("input[type=radio]").blur();
});

$("input[type=checkbox]").change(function() {
    $("input[type=checkbox]").blur();
});

$(document).on("change", "select" , function() {
    setTimeout(function() { $("select").blur(); }, 400);
});

/**
 * Auto menu on mouseover
 */
var blockClick = 0;
$("document").ready(function(){
    $(".menubutton").on("click", function(e) {
        if(blockClick == 1) {
            e.stopImmediatePropagation();
            e.stopPropagation();e.preventDefault(); 
        }
    });
    $(".menuauto").hover(function() {
        var elmId = "#" + this.id;
        $(this).data("timeout", window.setTimeout(function() {
            if(!$(elmId).find(".dropdown-menu").is(":visible") && blockClick == 0) {
                blockClick = 1;
                $(elmId).find(".menubutton").dropdown("toggle");
                setTimeout(function() { blockClick = 0;}, 2000); // How long we prevent click not to close the menu just after having opened on mouse over
            }
        }, 400)); // How long must be the mouse over the element before auto open the menu
    }, function() {
        clearTimeout($(this).data("timeout"));
    });
});


/**
 * Code for Phone Navbar / Menus
 */
var scrollPos = 0;
$("#MenuPhoneMainPages").css({"left": -(windowWidth-10) + "px"});
$("#BugerMenuPhoneMainPages").on("click", function(event) {
    if(!$("#MenuPhoneUser").hasClass("opa-0")) {
        $("#CloseMenuPhoneUser").click();
    }
    if(!$("#BugerMenuPhoneMainPages").hasClass("is-active")) {
        scrollPos = $(window).scrollTop();
        $("#MenuPhoneMainPages").scrollTop(0);
        $("#MenuPhoneMainPages").removeClass("opa-0");
        $("#MenuPhoneMainPages").css({"left": "0px"});
        $("#MenuPhoneMainPages").show();
        $("#BugerMenuPhoneMainPages").toggleClass("is-active");
        $("#DivSail").addClass("show").css({"background":"rgba(51,51,51,.7)"});
    } else {
        $(window).scrollTop(scrollPos);
        $("#MenuPhoneMainPages").css({"left": -(windowWidth-10) + "px"});
        setTimeout(function() {$("#MenuPhoneMainPages").addClass("opa-0");$("#DivSail").removeClass("show");}, 500);
        $("#BugerMenuPhoneMainPages").toggleClass("is-active");
        $("#DivSail").css({"background":"rgba(51,51,51,0)"});
  }
});
$("#DivSail").on("click", function() {
    $("#BugerMenuPhoneMainPages").click();
});
$("#MenuPhoneUser").css({"left": (windowWidth-10) + "px"});
$("#IconNavbarPhoneUser").on("click", function(event) {
    if($("#BugerMenuPhoneMainPages").hasClass("is-active")) {
        $("#BugerMenuPhoneMainPages").click();
    }
    setTimeout(function() {$("#CloseMenuPhoneUser").removeClass("opa-0");}, 200);
    $("#MenuPhoneUser").scrollTop(0);
    $("#MenuPhoneUser").removeClass("opa-0");
    scrollPos = $(window).scrollTop();
    $("#MenuPhoneUser").css({"left": "0px"});
});

$("#CloseMenuPhoneUser").on("click", function(event) {
    $(window).scrollTop(scrollPos);
    $("#MenuPhoneUser").css({"left": (windowWidth) + "px"});
    setTimeout(function() {$("#CloseMenuPhoneUser").addClass("opa-0");}, 200);
    setTimeout(function() {$("#MenuPhoneUser").addClass("opa-0");}, 500);
});
$(window).resize(function(){
    if(!$("#BugerMenuPhoneMainPages").hasClass("is-active")) {
        setTimeout(function() {$("#MenuPhoneMainPages").css({"left": -(windowWidth-10) + "px"});}, 500);
    }
    if($("#MenuPhoneUser").hasClass("opa-0")) {
        setTimeout(function() {$("#MenuPhoneUser").css({"left": (windowWidth) + "px"});}, 500);
    }
});
/**  * End Code for Phone Navbar / Menus */
