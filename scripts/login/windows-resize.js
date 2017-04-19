$(document).ready(function () {

    var vph = $(window).height();
    $(".transpa-body").css({ "height": vph + "px" });
    $(window).resize(function () {
        var vph = $(document).height();
        $(".transpa-body").css({ "height": vph + "px" });
    });
});
