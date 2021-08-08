$(document).ready(function () {
    $("#help").hide();
    $(".nav-menu").children(".nav").hide();
    //this will display the first command
    $(".nav-menu").children(".nav").first().show();
    $("#help").hide();
    $("#help-toggle").text("Help ");

    $("#help-toggle").click(function (
    ) {
        //toggle the help id
        $("#help").slideToggle("slow",function () {

            if($(this).is(":hidden"))
            {
                $("#help-toggle").text("Show Help");
            }
            else
            {
                $("#help-toggle").text("Hide Help");
            }
        });

        return false;
    })

    $(".nav-toggle").click(
        function()
        {
            $(".nav-menu").children(".nav").hide()
            $(this).parent(".nav-menu").children(".nav").show()
        }
    )

    $("#checkall").click(function () {
        $('input:checkbox').not(this).prop('checked', this.checked);
    });

    $(".toggled_content").hide();
    $(".toggle_check").click(function ()
    {
       if($(this).prop("checked"))
       {
           $(this).parent("div").children(".toggled_content").show();
       }
       else
       {
           $(this).parent("div").children(".toggled_content").hide();
       }
    })





})