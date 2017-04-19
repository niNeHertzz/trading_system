//$(document).ready(function () {
//    $(".login-btn").click(function () {
//        $(".un")
//    });
//});
//$(document).ready(function () {
//    $(".login-btn").click(function () {
        
//        $(".un").tooltip();
//    });
//});
//function myLoginValidation() {
//    alert("hey");
//    $(".un").tooltip();
//}
$(document).ready(function () {
    $(".login-btn").css("outline", "none");

    // submit trigger in pw keypress enter
    $(".pw").keypress(function (event) {
        if (event.which == 13)
        {
            if ($(".un").val() == "" || $(".pw").val() == "") {

                if ($(".un").val() == "") {

                    $(".un").tooltip({ placement: "right" });
                    $(".un").attr("data-original-title", "Please enter your username.").tooltip("show");
                    $(".un").css({
                        "border-color": "#8b0300",
                        "box-shadow": "inset 0 1px 1px rgba(0,0,0,.075), 0 0 8px rgba(139, 3, 0, .6)"
                    });

                    // put keyup event before .focus() to call it even when the focus() event trigger
                    // cause when the .focus() calls first before any event the keyup, .focus event handler will not executed
                    $(".un").keypress(function () {

                        $(".un").removeAttr("data-original-title").tooltip("destroy");
                        $(".un").css({
                            "border-color": "#aaa",
                            "box-shadow": "inset 0 1px 1px rgba(0,0,0,.075), 0 0 8px rgba(170, 170, 170, .6)"
                        });
                    });

                    $(".un").focus();
                    $(".un").blur(function () {
                        $(".un").removeAttr("data-original-title");
                        $(".un").css({
                            "border": "1px solid #ccc",
                            "box-shadow": "inset 0 1px 1px rgba(0, 0, 0, .075)"
                        });
                    });

                    $(".un").focus(function () {
                        if ($(".un").val() == "") {
                            $(".un").tooltip({ placement: "right" });
                            $(".un").attr("data-original-title", "Please enter your username.").tooltip("show");
                            $(".un").css({
                                "border-color": "#8b0300",
                                "box-shadow": "inset 0 1px 1px rgba(0,0,0,.075), 0 0 8px rgba(139, 3, 0, .6)"
                            });
                        }
                        else {
                            $(".un").css({
                                "border-color": "#aaa",
                                "box-shadow": "inset 0 1px 1px rgba(0,0,0,.075), 0 0 8px rgba(170, 170, 170, .6)"
                            });
                        }
                    });
                }
                else if ($(".pw").val() == "") {
                    $("div form span").empty();
                    $(".pw").tooltip({ placement: "right" });
                    $(".pw").attr("data-original-title", "Please enter your password.").tooltip("show");
                    $(".pw").css({
                        "border-color": "#8b0300",
                        "box-shadow": "inset 0 1px 1px rgba(0,0,0,.075), 0 0 8px rgba(139, 3, 0, .6)"
                    });

                    $(".pw").keypress(function (event) {
                        if (event.which != 13) {
                            $(".pw").removeAttr("data-original-title").tooltip("destroy");
                            $(".pw").css({
                                "border-color": "#aaa",
                                "box-shadow": "inset 0 1px 1px rgba(0,0,0,.075), 0 0 8px rgba(170, 170, 170, .6)"
                            });
                        }
                    });

                    $(".pw").focus();
                    $(".pw").blur(function () {
                        $(".pw").removeAttr("data-original-title");
                        $(".pw").css({
                            "border": "1px solid #ccc",
                            "box-shadow": "inset 0 1px 1px rgba(0, 0, 0, .075)"
                        });
                    });

                    $(".pw").focus(function () {
                        if ($(".pw").val() == "") {

                            $(".pw").tooltip({ placement: "right" });
                            $(".pw").attr("data-original-title", "Please enter your password.").tooltip("show");
                            $(".pw").css({
                                "border-color": "#8b0300",
                                "box-shadow": "inset 0 1px 1px rgba(0,0,0,.075), 0 0 8px rgba(139, 3, 0, .6)"
                            });
                        }
                        else {
                            $(".pw").css({
                                "border-color": "#aaa",
                                "box-shadow": "inset 0 1px 1px rgba(0,0,0,.075), 0 0 8px rgba(170, 170, 170, .6)"
                            });
                        }
                    });
                }
            }
            else {
                for (var count = 0; count < user_list.length; count++) {
                    if ($(".un").val() != user_list[count]) { // a != kraizer
                        if (count == (user_list.length - 1)) // 0 == 2 // false
                        {
                            $("div form span").empty();
                            $("div form span").append("Username or password is invalid.");
                        }
                    }
                    else {
                        $("div form span").empty();
                        $("#form").submit();
                        break;
                    }
                }
            }
        }
    });
    // submit trigger in login btn click
    $(".login-btn").click(function () {
        
        if ($(".un").val() == "" || $(".pw").val() == "") {

            if ($(".un").val() == "") {

                $(".un").tooltip({ placement: "right" });
                $(".un").attr("data-original-title", "Please enter your username.").tooltip("show");
                $(".un").css({
                        "border-color": "#8b0300",
                        "box-shadow": "inset 0 1px 1px rgba(0,0,0,.075), 0 0 8px rgba(139, 3, 0, .6)"
                });

                // put keyup event before .focus() to call it even when the focus() event trigger
                // cause when the .focus() calls first before any event the keyup, .focus event handler will not executed
                $(".un").keyup(function () {
                    $(".un").removeAttr("data-original-title").tooltip("destroy");
                    $(".un").css({
                            "border-color": "#aaa",
                            "box-shadow": "inset 0 1px 1px rgba(0,0,0,.075), 0 0 8px rgba(170, 170, 170, .6)"
                    });
                });

                $(".un").focus();
                $(".un").blur(function () {
                    $(".un").removeAttr("data-original-title");
                    $(".un").css({
                        "border" : "1px solid #ccc",
                        "box-shadow": "inset 0 1px 1px rgba(0, 0, 0, .075)"
                    });
                });

                $(".un").focus(function () {
                    if ($(".un").val() == "") {
                        $(".un").tooltip({ placement: "right" });
                        $(".un").attr("data-original-title", "Please enter your username.").tooltip("show");
                        $(".un").css({
                            "border-color": "#8b0300",
                            "box-shadow": "inset 0 1px 1px rgba(0,0,0,.075), 0 0 8px rgba(139, 3, 0, .6)"
                        });
                    }
                    else
                    {
                        $(".un").css({
                            "border-color": "#aaa",
                            "box-shadow": "inset 0 1px 1px rgba(0,0,0,.075), 0 0 8px rgba(170, 170, 170, .6)"
                        });
                    }
                });
            }

            else if ($(".pw").val() == "") {
                $("div form span").empty();
                $(".pw").tooltip({ placement: "right" });
                $(".pw").attr("data-original-title", "Please enter your password.").tooltip("show");
                $(".pw").css({
                    "border-color": "#8b0300",
                    "box-shadow": "inset 0 1px 1px rgba(0,0,0,.075), 0 0 8px rgba(139, 3, 0, .6)"
                });

                $(".pw").keyup(function () {
                    $(".pw").removeAttr("data-original-title").tooltip("destroy");
                    $(".pw").css({
                        "border-color": "#aaa",
                        "box-shadow": "inset 0 1px 1px rgba(0,0,0,.075), 0 0 8px rgba(170, 170, 170, .6)"
                    });
                });

                $(".pw").focus();
                $(".pw").blur(function () {
                    $(".pw").removeAttr("data-original-title");
                    $(".pw").css({
                        "border": "1px solid #ccc",
                        "box-shadow": "inset 0 1px 1px rgba(0, 0, 0, .075)"
                    });
                });

                $(".pw").focus(function () {
                    if ($(".pw").val() == "") {

                        $(".pw").tooltip({ placement: "right" });
                        $(".pw").attr("data-original-title", "Please enter your password.").tooltip("show");
                        $(".pw").css({
                            "border-color": "#8b0300",
                            "box-shadow": "inset 0 1px 1px rgba(0,0,0,.075), 0 0 8px rgba(139, 3, 0, .6)"
                        });
                    }
                    else
                    {
                        $(".pw").css({
                            "border-color": "#aaa",
                            "box-shadow": "inset 0 1px 1px rgba(0,0,0,.075), 0 0 8px rgba(170, 170, 170, .6)"
                        });
                    }
                });
            }
        }
        else {
            for (var count = 0;count < user_list.length;count++) {
                if ($(".un").val() != user_list[count]) { // a != kraizer
                    if (count == (user_list.length - 1)) // 0 == 2 // false
                    {
                        $("div form span").empty();
                        $("div form span").append("Username or password is invalid.");
                    }
                }
                else {
                    $("div form span").empty();
                    $("#form").submit();
                    break;
                }
            }
        }
    });
    
    //$(".un").mouseover(function () {
    //    $(".un").tooltip("destroy");
    //});

});