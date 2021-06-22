/*
 * @author Shukurullo Odilov
 * @date 18.05.2021, 9:45
 */

$(function () {

    /**
     * Product card dagi tugma orqali savatchaga qo'shish
     **/
    $(document).on('click', '.add-to-cart-btn', function (event) {

        event.preventDefault()
        let url = $(this).attr('href')
        let link = $(this)
        link.addClass('load-more-overlay loading')
        $.ajax({
            'url': url,
            'success': function (result) {
                if (result.success) {
                    let data = result.data
                    $('#header-cart-container').html(data.header_cart_content)
                    Riode.Minipopup.open({
                        message: data.message,
                        productClass: 'product-cart',
                        name: data.product_name,
                        nameLink: data.product_url,
                        imageSrc: data.image_src,
                        imageLink: data.product_url,
                        price: data.price,
                        count: data.count,
                        actionTemplate: data.template,
                    });
                }
            }
        }).done(function () {
            link.removeClass('load-more-overlay loading')
        });
    });

    /**
     * Product detail sahifasidagi tugma orqali savatchaga qo'shish
     **/
    $(document).on('click', '#add-to-cart-from-detail-page', function (event) {

        event.preventDefault()
        let url = $(this).attr('href')
        let qty = $('#quantity-input').val()
        let link = $(this)
        link.addClass('load-more-overlay loading')
        $.ajax({
            'url': url,
            'data': {'qty': qty},
            'success': function (result) {
                if (result.success) {
                    let data = result.data
                    $('#header-cart-container').html(data.header_cart_content)
                    Riode.Minipopup.open({
                        message: data.message,
                        productClass: 'product-cart',
                        name: data.product_name,
                        nameLink: data.product_url,
                        imageSrc: data.image_src,
                        imageLink: data.product_url,
                        price: data.price,
                        count: data.count,
                        actionTemplate: data.template,
                    });
                }
            }
        }).done(function () {
            link.removeClass('load-more-overlay loading')
        });

    });

    /**
     * Productni savatchadan olib tashlash
     * Headerdagi savatchadagi va 'view-cart' sahifasidagi 'remove' button uchun
     **/
    $(document).on('click', '.remove-from-cart', function (event) {

        event.preventDefault()
        let link = $(this)
        let url = $(this).attr('href')
        link.addClass('load-more-overlay loading')
        $.ajax({
            'url': url,
            'success': function (result) {
                if (result.success) {
                    $('#header-cart-container').html(result.data.header_cart_content);
                    $('#cart-content-view').html(result.data.view_cart_content);
                }
            }
        }).done(function () {
            link.removeClass('load-more-overlay loading')
        });

    });

    /**
     * Productni savatchadan bittaga kamaytirish
     * 'view-cart' sahifasidagi 'minus' button uchun
     **/
    $(document).on('click', '.minus-from-cart', function (event) {

        event.preventDefault()
        let minusButton = $(this)
        let url = $(this).data('url')
        minusButton.parent().addClass('load-more-overlay loading')
        $.ajax({
            'url': url,
            'success': function (result) {
                if (result.success) {
                    $('#header-cart-container').html(result.data.header_cart_content);
                    $('#cart-content-view').html(result.data.view_cart_content);
                }
            }
        }).done(function () {
            minusButton.parent().removeClass('load-more-overlay loading')
        });

    });

    /**
     * Productni savatchadan bittaga oshirish
     * 'view-cart' sahifasidagi '.plus-to-cart' button uchun
     **/
    $(document).on('click', '.plus-to-cart', function (event) {

        event.preventDefault()
        let plusButton = $(this)
        let url = $(this).data('url')
        plusButton.parent().addClass('load-more-overlay loading')
        $.ajax({
            'url': url,
            'success': function (result) {
                if (result.success) {
                    $('#header-cart-container').html(result.data.header_cart_content);
                    $('#cart-content-view').html(result.data.view_cart_content);
                }
            }
        }).done(function () {
            plusButton.parent().removeClass('load-more-overlay loading')
        });

    });


})





