$(document).ready(function() {
    $("#pincode").keyup(function() {
        $("#city").val("");
        $("#state").val("");
        $("#place").val("");
        var el = $(this);
        var token = $('[name="_token"]').val();
        var pincode = $("#pincode").val();
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
                    $("#city").val(data.city);
                    $("#state").val(data.state);
                    $.each(data.Result, function(key, value) {
                        $("#post_office").append(
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

    // Official

    $("#off_pincode").keyup(function() {
        $("#off_city").val("");
        $("#off_state").val("");
        $("#off_place").val("");
        var el = $(this);
        var token = $('[name="_token"]').val();
        var pincode = $("#off_pincode").val();
        if (el.val().length === 6) {
            $("#off_place")
                .children("option:not(:first)")
                .remove();
            $.ajax({
                type: "post",
                url: "/getpincode",
                data: { pincode: pincode, _token: token },
                dataType: "json", // let's set the expected response format
                success: function(data) {
                    $("#off_city").val(data.city);
                    $("#off_state").val(data.state);
                    $.each(data.Result, function(key, value) {
                        $("#off_post_office").append(
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
            $("#off_city").val("");
            $("#off_state").val("");
        }
    });

    /* parse Validation */

    $("#step1Frm").parsley();

    $("#step1Frm").on("submit", function (event) {
        
        event.preventDefault();
        if (
            $("#step1Frm")
                .parsley()
        ) {
            $.ajax({
                url: "/profile_create",
                method: "POST",
                data: $('#step1Frm').serialize(),
                dataType: "json",
                beforeSend: function() {
                    $("#submit").attr("disabled", "disabled");
                    $("#submit").val("Next...");
                    $("#submit").attr("disabled", false);
                },
                success: function (data) {
                    //alert(data.errors.status);
                    
                   // $("#step1Frm")[0].reset();
                    $("#step1Frm")
                        .parsley()
                        .reset();
                    $("#submit").attr("disabled", false);
                    $("#submit").val("Submit");
                   if (data.mstatus == "Yes") {
                       $(location).attr("href", "/family_information");
                   }
                    if (data.mstatus == "No") {                    
                        $(location).attr("href", "/step3");
                    } 
                }
            });
        }
    });
    /* End parse validation */

     /* FAMILY INFORMATION */

    $("#step2Frm").parsley();

    $("#step2Frm").on("submit", function(event) {
         
        event.preventDefault();
        if (
            $("#step2Frm")
                .parsley()
                .isValid()
        ) {
            $.ajax({
                url: "/family_information_create",
                method: "POST",
                data: $(this).serialize(),
                dataType: "json",
                beforeSend: function() {
                    $("#submit").attr("disabled", "disabled");
                    $("#submit").val("Next...");
                    $("#submit").attr("disabled", false);
                },
                success: function (data) { 
                    alert(data.message);
                    return false;
                    $("#step2Frm")
                        .parsley()
                        .reset();
                    $("#submit").attr("disabled", false);
                    $("#submit").val("Submit");
                    $(location).attr("href", "/step3"); 
                }
            });
        }
    });
    /* End parse validation */
});
