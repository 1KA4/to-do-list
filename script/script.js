let signin = $("#signin");
let signup = $("#signup");
let submit = $("#submit");

signin.on("click", function () {
    if (!signin.hasClass("underline")) {
        signin.toggleClass("font-weight-light text-muted underline font-weight-bold");
        signup.toggleClass("font-weight-light text-muted underline font-weight-bold");


        submit.attr("name", "signin");
        submit.text("Sign in");
    }
});


signup.on("click", function () {
    if (!signup.hasClass("underline")) {
        signup.toggleClass("font-weight-light text-muted underline font-weight-bold");
        signin.toggleClass("font-weight-light text-muted underline font-weight-bold");

        submit.attr("name", "signup");
        submit.text("Sign up");
    }
});


$(document).ready(function () {
    var readURL = function (input) {
        if (input.files && input.files[0]) {
            var reader = new FileReader();

            reader.onload = function (e) {
                $('#avatar').attr('src', e.target.result);
                $('#brandImg').attr('src', e.target.result);
            }

            reader.readAsDataURL(input.files[0]);
        }
    }

    $("#customFile").on('change', function () {
        readURL(this);
    });
});