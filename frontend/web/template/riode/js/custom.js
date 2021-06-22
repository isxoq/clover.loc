function number_format(s) {
    var a = s.toString();
    var j = 1;
    var r = '';
    var n = '';
    for (var i = a.length - 1; i >= 0; i--) {
        r = r + (a[i])
        if (j % 3 == 0 && j != a.length) {
            r = r + ' ';
        }
        j++;
    }
    for (var i = r.length - 1; i >= 0; i--) {
        n = n + (r[i])

    }
    return n;
}


$(function () {

    /***  Start wishlist   */

    $(document).on('click', '.add-to-wishlist-btn', function (event) {
        event.preventDefault()
        let url = $(this).attr('href')
        let link = $(this)
        $(this).addClass('load-more-overlay loading')
        $.ajax({
            'url': url,
            'success': function (result) {
                let i = link.find('i')
                i.attr('class', result.class)
            },
        }).done(function () {
            link.removeClass('load-more-overlay loading')
        });
    });

    /***  End wishlist   */


    $(document).on('click', '.product-quickview', function (e) {

        e.preventDefault();
        Riode.popup({
            items: {
                src: $(this).attr('href')
            },
            callbacks: {
                ajaxContentAdded: function () {
                    this.wrap.imagesLoaded(function () {
                        Riode.initProductSingle($('.mfp-product .product-single'));
                    });
                }
            }
        }, 'quickview');

    })

})