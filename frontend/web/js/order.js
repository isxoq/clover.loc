$(document).ready(function () {


    $('#checkoutform-town_id').on('change', function (e) {
        updateCheckout();
    })

    $('input[name = "CheckoutForm[shipping]"]').on('click', function () {
        updateCheckout();
    })

    function updateCheckout() {
        let form = $('#orderForm')
        $.ajax({
            url: form.attr('summaryUrl'),
            type: "POST",
            data: form.serialize(),
            success: function (data) {
                console.log(data)

                $('#totalSummary').text(data.totalSum)

            },
            error: function (data) {
                console.log(data)
            }
        })
    }


    $('#verify_button').on('click', function (e) {
        let verifyPhone = $('#checkoutform-phone').val()
        let verifyCode = $('#verify_code').val()
        let url = $(this).attr('data-verify')

        console.log(verifyCode)
        console.log(verifyPhone)

        $.ajax({
            url: url,
            type: "POST",
            data: {
                phone: verifyPhone,
                code: verifyCode,
            },
            success: function (data) {
                if (data == 1) {
                    $('#checkoutform-phone').attr('readonly', true)
                    $('.blok_verify').addClass('d-none')
                }
            }
        })

    })

    $('#get_verify_code').on('click', function (e) {
        e.preventDefault()
        $('#resend_verify_code').removeClass('d-none')
        $(this).addClass('d-none')
        $('#verify_button').removeClass('btn-disabled')

        let verifyPhone = $('#checkoutform-phone').val()
        let url = $('#verify_button').attr('data-href')

        $.ajax({
            url: url,
            type: "POST",
            data: {
                phone: verifyPhone,
            },
            success: function (data) {
                console.log(data)
            }
        })
    })


    $('#resend_verify_code').on('click', function (e) {
        e.preventDefault()
        let verifyPhone = $('#checkoutform-phone').val()
        let url = $(this).attr('data-href')

        $.ajax({
            url: url,
            type: "POST",
            data: {
                phone: verifyPhone,
            },
            success: function (data) {
                console.log(data)
            }
        })

    })


})