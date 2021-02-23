$(function () {
    // $("#message").hide();
    // $("form").submit(function (event) {
    //     confirmpw()
    //     return false
    // })
    //
    //
    // function confirmpw() {
    //     var pass1 = $("#password").val()
    //     var pass2 = $("#confirm").val()
    //     if (pass1 != pass2) {
    //         var pass1 = $("#password").val()
    //         var pass2 = $("#confirm").val()
    //         // $("#message").html("Passwords dont match")
    //         $("#message").slideDown(3000,function () {
    //             $("#message").html("Passwords dont match")
    //         })
    //     } else {
    //
    //         $("#message").fadeIn("slow",function () {
    //             alert("We faded in");
    //         })
    //
    //     }
    // }

    var $users = $("#users")
    $.ajax({
        type: 'GET',
        url: '/api/users',
        dataType: 'json',
        success: function (users) {
            $.each(users, function (i, user) {
                $users.append("<div>" + user.username + "</div>")
            })
        }
    });


    $("#save").on('click', function () {
        var user = {
            username: $("#username").val(),
            email: $("#email").val(),
            password: $("#password").val(),
        }

        $.ajax({
            type: 'POST',
            url: '/api/users/save',
            data: user,
            success: function (newusers) {
                $users.append("<div>" + user.username + "</div>")
            },
            error: function () {
                alert("save didnt complete")
            }
        })
        return false;
    })
})

