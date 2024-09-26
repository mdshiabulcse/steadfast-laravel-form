(function ($) {
    "use strict";

    $(document).on("submit", "form.ajaxForm", function (event) {
        event.preventDefault();
        var enctype = $(this).prop("enctype");
        if (!enctype) {
            enctype = "application/x-www-form-urlencoded";
        }
        $.ajax({
            type: $(this).prop('method'),
            encType: enctype,
            contentType: false,
            processData: false,
            url: $(this).prop('action'),
            data: new FormData($(this)[0]),
            dataType: 'json',
            success: function (response) {
                toastr.success(response.message)
                if (response.route){
                    window.location.href = response.route
                }
            },
            error: function (error) {
                if (error.status) {
                    toastr.error(error.responseJSON.message)
                }
            }
        });
    });


    $(document).on("click", ".edit", function (e) {
        e.preventDefault();
        const modal = $('.edit_modal');
        modal.find('input[name=name]').val($(this).data('item').name)
        modal.find('select[name=status]').val($(this).data('item').status)
        let route = $(this).data('updateurl');
        $('#updateEditModal').attr("action", route)
        modal.modal('show')
    })



    $(document).on("click", ".deleteItem", function () {
        let form_id = this.dataset.formid;
        Swal.fire({
            title: 'Sure! You want to delete?',
            text: "You won't be able to revert this!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yes, Delete It!'
        }).then((result) => {
            if (result.value) {
                $("#" + form_id).submit();
            } else if (result.dismiss === "cancel") {
                Swal.fire(
                    "Cancelled",
                    "Your imaginary file is safe :)",
                    "error"
                )
            }
        })
    });

    $(document).ready(function () {
        $(".multiple-basic-single").select2({
            placeholder: "Select Option",
            allowClear: true
        });

        $(".multiple-select-input").select2({
            tags: false,
            tokenSeparators: [',',' '],
        })
    });

    toastr.options = {
        "closeButton": false,
        "debug": false,
        "newestOnTop": false,
        "progressBar": false,
        "positionClass": "toast-bottom-right",
        "preventDuplicates": false,
        "onclick": null,
        "showDuration": "300",
        "hideDuration": "1000",
        "timeOut": "5000",
        "extendedTimeOut": "1000",
        "showEasing": "swing",
        "hideEasing": "linear",
        "showMethod": "fadeIn",
        "hideMethod": "fadeOut"
    };

})(jQuery)
