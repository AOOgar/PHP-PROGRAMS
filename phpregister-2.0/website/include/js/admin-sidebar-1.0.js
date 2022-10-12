var heightWindow = window.innerHeight ? window.innerHeight : $(window).height();

function getScrollbarWidth() {
    var outer = document.createElement("div");
    outer.style.visibility = "hidden";
    outer.style.width = "100px";
    document.body.appendChild(outer);
    var widthNoScroll = outer.offsetWidth;
    outer.style.overflow = "scroll";
    var inner = document.createElement("div");
    inner.style.width = "100%";
    outer.appendChild(inner);        
    var widthWithScroll = inner.offsetWidth;
    outer.parentNode.removeChild(outer);
    return widthNoScroll - widthWithScroll;
}
if(getScrollbarWidth() == 0) {
    $("#SideNavContent").css({"padding-right": "0px", "width": "250px"});
}

/* Set the sidebar navigation maring-left to -243px */
function sidebarClose() {
    $("#mySidenav").css("margin-left", "-243px");
    setTimeout(function () {
        $("#SideNavContent").addClass("dis-n");
    }, 500);
    $("#DivWraper").removeClass("openSidebar");
    setTimeout(function () { $("#DivOpenSidebar").fadeTo("fast", 1) }, 500);
}

/* Set the width of the side navigation to 250px */
function sidebarOpen() {
    $("#SideNavContent").removeClass("dis-n");
    $("#mySidenav").css("margin-left", "0px");
    $("#DivOpenSidebar").fadeTo("fast", 0);
    setTimeout(function() {
        $("#SideNavContent").show();
    }, 200);
    if(window.innerWidth > 800) {
        $("#DivWraper").addClass("openSidebar");
    }
}

function sidebarSetHeight() {
    heightWindow = window.innerHeight ? window.innerHeight : $(window).height();
    $("#SideNavContent").height(heightWindow);
}

$(window).on("load", function() {
    sidebarSetHeight();
    $("div #SideNavContent").on("hidden.bs.collapse", function () {
        sidebarSetHeight();
    }).on("shown.bs.collapse", function () {
        sidebarSetHeight();
    });
    
    if(window.innerWidth <= 800) {
        setTimeout("sidebarClose()", 2000);
    }
    $("#mySidenav").click(function() {
        if($("#mySidenav").css("margin-left") == "-243px") {
            sidebarOpen();
        }
    });
});

$(window).resize(function(){
    heightWindow = window.innerHeight ? window.innerHeight : $(window).height();
    $("#SideNavContent").height(heightWindow);
});

function copyToClipboard(TextareaId, BlinkId) {
    var copyText = $("#" + TextareaId);
    copyText.select();
    document.execCommand("copy");
    $("#" + BlinkId).blink(2);
};
