$(document).ready(function () {
    $("#help").hide();
    $(".nav-menu").children(".nav").hide();
    //this will display the first command
    $(".nav-menu").children(".nav").first().show();
    $("#help").hide();
    $("#help-toggle").text("Help ");
    $(".block").hide();
    $(".block").first().show();
    // $(".etlink").html("View Address");

    $("body").on("click",".remove-btn",function(e){
        $(this).parents('.user-data').remove();
    });


    $("#tabs").tabs();
    $(".etlocations").hide();
    $(".etlink").children("a").click(function () {
        $(this).parents(".ettab").children(".etlocations").slideToggle("fast",function () {
            if($(this).is(":visible")) {
                $(this).parents(".ettab").children(".etlink").children("a").html("Close (X)")
            }
            else
            {
                $(this).parents(".ettab").children(".etlink").children("a").html("View Address")
            }
        });
        return false
    })
    



    $("#help-toggle").click(function () {
        //toggle the help id
        $("#help").slideToggle("slow", function () {

            if ($(this).is(":hidden")) {
                $("#help-toggle").text("Show Help");
            } else {
                $("#help-toggle").text("Hide Help");
            }
        });
        return false;
    })

    $(".nextbtn").children("a").click(function () {
        {
            $(this).parent(".nextbtn").parent(".row").parent(".block").slideUp("fast")
            $(this).parent(".nextbtn").parent(".row").parent(".block").next().slideDown("fast");
            return false;
        }
    })

    $(".prevbtn").children("a").click(function () {
        {
            $(this).parent(".prevbtn").parent(".row").parent(".block").slideUp("fast")
                $(this).parent(".prevbtn").parent(".row").parent(".block").prev().slideDown("fast");
                return false;
        }
    })

    $(".nav-toggle").click(
        function () {
            $(".nav-menu").children(".nav").hide()
            $(this).parent(".nav-menu").children(".nav").show()
        }
    )

    $("#checkall").click(function () {
        $('input:checkbox').not(this).prop('checked', this.checked);
    });

    $(".toggled_content").hide();
    $(".toggle_check").click(function () {
        if ($(this).prop("checked")) {
            $(this).parent("div").children(".toggled_content").show();
        } else {
            $(this).parent("div").children(".toggled_content").hide();
        }
    })


})