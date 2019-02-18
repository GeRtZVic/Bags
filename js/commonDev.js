$(function () {
    $('.rating li').on('click', function() {
        $('#reviews-stars').val($(this).data('num'));
    });
    $('.addProductId').click(function () {
        $('#id_product').val($(this).data('id'));
    });
    $('.show_reviews').click(function () {
        $('.reviews_block').removeClass('reviews_hide');
        $(this).hide();
    });

    /**
     *
     * @param formdata
     * @param numeric_prefix
     * @param arg_separator
     * @returns {string}
     */
    function http_build_query( formdata, numeric_prefix, arg_separator ) {	// Generate URL-encoded query string
        //
        // +   original by: Kevin van Zonneveld (http://kevin.vanzonneveld.net)
        // +   improved by: Legaev Andrey
        // +   improved by: Michael White (http://crestidg.com)

        var key, use_val, use_key, i = 0, tmp_arr = [];

        if(!arg_separator){
            arg_separator = '&';
        }

        for(key in formdata){
            use_key = escape(key);
            use_val = escape((formdata[key].toString()));
            use_val = use_val.replace(/%20/g, '+');

            if(numeric_prefix){
                use_key = numeric_prefix + use_key.charAt(0).toUpperCase() + use_key.substr(1);
            }
            tmp_arr[i] = use_key + '=' + use_val;
            i++;
        }

        return tmp_arr.join(arg_separator);
    }

    $("#example_id").ionRangeSlider({
        type: "double",
        grid: true,
        min: 1,
        max: 10100,
        from: $('#price-for-filter').data('min'),
        to: $('#price-for-filter').data('max'),

        onFinish: function (data) {
            goFilterQuery();
        },
    });

    $('.filter-item').click(function(){
        goFilterQuery();
    });

    function goFilterQuery() {

        var slider = $("#example_id").data("ionRangeSlider"),
            allId = [],
            price,
            query;

        urlxp = location.href.split("?");

        $( "input:checked" ).each(function(index,value){
            key = this.name;
            if (allId[key])
                allId[key] = `${allId[key]},${$(this).val()}`;
            else
                allId[key] = $(this).val();
        });

        price = `&price=${slider.result.from};${slider.result.to}`;
        query = http_build_query(allId, 'id', '&');
        window.location.replace(`${urlxp[0]}?${allId ? query : ''}${price}`);
    }


    $('.add_basket').click(function(){
//        console.log(1);
        $('#product-title').text('');
        $('#product-img').text('');
        title   = $(this).attr('data-title');
        weight  = $(this).attr('data-w');
        price   = $(this).attr('data-price');
        img     = $(this).attr('data-img');
        id      = $(this).attr('data-id');
        count   = $('#count-item').val();
        count   = (count > 0) ? count : 1;

        $('#product-title').text(title);
        $('#product-img').attr('src',img);

        $.ajax({
            url: '/wp-admin/admin-ajax.php',
            data: 'action=add_basket&id=' + id + '&title=' + title + '&count=' + count + '&price=' + price + '&img=' + img ,
            dataType : 'json',
            success: function(data) {
                console.log(data);
                $('.all-count').text(data.basket_count);
                $('.all-price').text(data.basket_price);

            }
        });
    });

    $( "body" ).delegate( ".remove", "click", function() {
        console.log($(this).attr('data-key'));
        key = $(this).attr('data-key');
        if ($(this).attr('data-mode')!=''){
            $('#'+$(this).attr('data-mode')).hide(300);
        }
        $.ajax({
            url: '/wp-admin/admin-ajax.php',
            data: 'action=del_item&key=' + key  ,
            dataType : 'json',
            success: function(data) {
                console.log(data);
                $('.all-count').html(data.basket_count);
                $('.all-price').text(data.basket_price);
            }
        });
    });

    $(".button").on("click", function() {

        input = $(this).parent().find('input');
        count_new = input.val();
        key = input.attr('data-key');

        var $button = $(this);
        var oldValue = $button.parent().find("input").val();

        if ($button.text() == "+") {
            var newVal = parseFloat(oldValue) + 1;
        } else {
            // Don't allow decrementing below zero
            if (oldValue > 0) {
                var newVal = parseFloat(oldValue) - 1;
            } else {
                newVal = 0;
            }
        }
        $button.parent().find("input").val(newVal);

        changeItemBasket(newVal,key);
    });

    $('.count_item_basket').change(function(e){
        console.log($(this).val());
        count_new = $(this).val();
        key = $(this).attr('data-key');
        changeItemBasket(count_new,key);
    });

    function changeItemBasket(count,key) {
        $.ajax({
            url: '/wp-admin/admin-ajax.php',
            data: 'action=change_count&count_new=' + count  + '&key=' + key,
            dataType : 'json',
            success: function(data) {
                console.log(data);
                $('.all-count').text(data.basket_count);
                $('.all-price').text(data.basket_price);
                $('.itemBasket-' + key).text(data.item_price);
            }
        });
    }

    $('.send_button').click(function(){

        validate=1;
        validate_msg='';
        form=$('#'+$(this).attr('rel'));
        $.each(form.find('.validateInput'), function(key, value) {
            console.log(1);
            if($(this).val()==''){
                validate_msg+='Вкажіть - '+$(this).attr('title')+'\n';
                validate=0;
                /*$(this).focus();
                 $(this).addClass('red_input');
                 $(this).tooltipster('update', $(this).attr('title'));
                 $(this).tooltipster('show');*/
            }else{
                /*$(this).tooltipster('hide');
                 $(this).removeClass('red_input');*/
            }
        });
        console.log(2123);
        // $( ".show-confirm" ).each(function(  ) {
        //     // $.each(form.find('.show-confirm'), function(key, value) {
        //     console.log(123123123);
        //     $('#text-order').text();
        //     $('#text-order').append( "<strong>"+$(this).attr('title')+" :</strong>"+$(this).val()+	"<BR>" );
        //
        // });
        if(validate==1){
            $.ajax({
                url: '/wp-admin/admin-ajax.php',
                data: 'action=create_order&'+form.serialize(),
                // dataType: "json",
                success: function(data){
                    // alert(data);
                    // location.reload()
                    // $('#text-order').text();
                    // $( ".show-confirm" ).each(function(  ) {
                    //     $.each(form.find('.show-confirm'), function(key, value) {
                        console.log(1);
                        // $('#text-order').append( "<strong>"+$(this).attr('title')+" :</strong>"+$(this).val()+	"<BR>" );

                    // });
                    // $("#get_thx").trigger('click');
                    $('#popap-5').modal('show');

                }
            });

        }else{
            alert(validate_msg);
        }
    });

});