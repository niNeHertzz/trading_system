$(document).ready(function () {

    var vph = $(window).height();
    //alert(vph);
    //alert($(document).height());
    $("#sidebar").css({ "height": vph + "px" });
    $(window).resize(function () {
        var vph = $(window).height();
        //alert(vph);
        $("#sidebar").css({ "height": vph + "px" });
    });
});
