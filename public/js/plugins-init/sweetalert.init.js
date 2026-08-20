(function () {
    "use strict";

    function on(selector, handler) {
        var el = document.querySelector(selector);
        if (el) {
            el.onclick = handler;
        }
    }

    on(".sweet-wrong", function () {
        sweetAlert("Oops...", "Something went wrong !!", "error");
    });

    on(".sweet-message", function () {
        swal("Hey, Here's a message !!");
    });

    on(".sweet-text", function () {
        swal("Hey, Here's a message !!", "It's pretty, isn't it?");
    });

    on(".sweet-success", function () {
        swal("Hey, Good job !!", "You clicked the button !!", "success");
    });

    on(".sweet-confirm", function () {
        swal({
            title: "Are you sure to delete ?",
            text: "You will not be able to recover this imaginary file !!",
            type: "warning",
            showCancelButton: true,
            confirmButtonColor: "#DD6B55",
            confirmButtonText: "Yes, delete it !!",
            closeOnConfirm: false
        }, function () {
            swal("Deleted !!", "Hey, your imaginary file has been deleted !!", "success");
        });
    });

    on(".sweet-success-cancel", function () {
        swal({
            title: "Are you sure to delete ?",
            text: "You will not be able to recover this imaginary file !!",
            type: "warning",
            showCancelButton: true,
            confirmButtonColor: "#DD6B55",
            confirmButtonText: "Yes, delete it !!",
            cancelButtonText: "No, cancel it !!",
            closeOnConfirm: false,
            closeOnCancel: false
        }, function (isConfirm) {
            if (isConfirm) {
                swal("Deleted !!", "Hey, your imaginary file has been deleted !!", "success");
            } else {
                swal("Cancelled !!", "Hey, your imaginary file is safe !!", "error");
            }
        });
    });

    on(".sweet-image-message", function () {
        swal({
            title: "Sweet !!",
            text: "Hey, Here's a custom image !!",
            imageUrl: "../assets/images/hand.jpg"
        });
    });

    on(".sweet-html", function () {
        swal({
            title: "Sweet !!",
            text: "<span style='color:#ff0000'>Hey, you are using HTML !!<span>",
            html: true
        });
    });

    on(".sweet-auto", function () {
        swal({
            title: "Sweet auto close alert !!",
            text: "Hey, i will close in 2 seconds !!",
            timer: 2000,
            showConfirmButton: false
        });
    });

    on(".sweet-prompt", function () {
        swal({
            title: "Enter an input !!",
            text: "Write something interesting !!",
            type: "input",
            showCancelButton: true,
            closeOnConfirm: false,
            animation: "slide-from-top",
            inputPlaceholder: "Write something"
        }, function (inputValue) {
            if (inputValue === false) return false;
            if (inputValue === "") {
                swal.showInputError("You need to write something!");
                return false;
            }
            swal("Hey !!", "You wrote: " + inputValue, "success");
        });
    });

    on(".sweet-ajax", function () {
        swal({
            title: "Sweet ajax request !!",
            text: "Submit to run ajax request !!",
            type: "info",
            showCancelButton: true,
            closeOnConfirm: false,
            showLoaderOnConfirm: true
        }, function () {
            setTimeout(function () {
                swal("Hey, your ajax request finished !!");
            }, 2000);
        });
    });

})();