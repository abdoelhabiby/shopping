$(function(){


        $("body").on("click", "#button_delete", function () {
            var action = $(this).data("action"),
                name = $(this).data("name");
            $("#modal_delete form").attr("action", action);
            $("#modal_delete .modal-body span").text(name);
            $("#modal_delete").modal("show");

        });




});
