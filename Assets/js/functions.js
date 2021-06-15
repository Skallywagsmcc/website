$(document).ready(function () {

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