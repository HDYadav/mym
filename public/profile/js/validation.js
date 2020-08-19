$(document).ready(function() {
    // alert("Loaded");
    $("#submit").click(function() {
        var name = $('[name="fullname"]').val();
        var token = $('[name="_token"]').val();

        $.ajax({
            type: "post",
            url: "{{ url('/step2') }}",
            data: { name: name, _token: token },
            dataType: "json", // let's set the expected response format
            success: function(data) {
                //console.log(data);
                $("#success_message")
                    .fadeIn()
                    .html(data.message);
            },
            error: function(err) {
                if (err.status == 422) {
                    // when status code is 422, it's a validation issue
                    console.log(err.responseJSON);
                    $("#success_message")
                        .fadeIn()
                        .html(err.responseJSON.message);

                    // you can loop through the errors object and show it to the user
                    console.warn(err.responseJSON.errors);
                    // display errors on each form field
                    $.each(err.responseJSON.errors, function(i, error) {
                        var el = $(document).find('[name="' + i + '"]');
                        el.after(
                            $(
                                '<span style="color: red;">' +
                                    error[0] +
                                    "</span>"
                            )
                        );
                    });
                }
            }
        });
    });

    $("#pincode").keyup(function() {
        $("#city").val("");
        $("#state").val("");
        $("#place").val("");
        var el = $(this);
        var token = $('[name="_token"]').val();
        var pincode = $("#pincode").val();
        // alert("Work " + el.val());
        if (el.val().length === 6) {
            $("#place")
                .children("option:not(:first)")
                .remove();

            $.ajax({
                type: "post",
                url: "/getpincode",
                data: { pincode: pincode, _token: token },
                dataType: "json", // let's set the expected response format
                success: function(data) {
                    //var obj = jQuery.parseJSON(data);
                    // console.log(data.Result.Name);
                    $("#city").val(data.city);
                    $("#state").val(data.state);
                    $.each(data.Result, function(key, value) {
                        //console.log(value.Name);
                        $("#place").append(
                            '<option value="' +
                                value.Name +
                                '">' +
                                value.Name +
                                "</option>"
                        );
                    });
                }
            });
        } else {
            $("#city").val("");
            $("#state").val("");
        }
    });
    /* step 1 Validations */
    $("#step1Frm").submit(function(e) {
        jQuery(".alert-danger").html("");
        e.preventDefault();
        jQuery.ajaxSetup({
            headers: {
                "X-CSRF-TOKEN": $('meta[name="_token"]').attr("content")
            }
        });
        var formData = new FormData(jQuery("#step1Frm")[0]);

        $.ajax({
            type: "POST",
            url: "/step2",
            data: formData,
            contentType: false,
            processData: false,
            success: function(data) {
                console.log(data.name);
                if (data.message == "success") {
                    alert("Sucess");
                }
                jQuery.each(data.errors, function(key, value) {
                    /* $("#" + key)
                        .parents(".form-holder")
                        .find("#error")
                        .html(value); */

                    jQuery(".alert-danger").show();
                    jQuery(".alert-danger").append("<p>" + value + "</p>");
                });
            }
        });
    });
    /* step 1 Validations end*/
});
