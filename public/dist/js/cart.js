$('.products').on('click', '.buy-btn', function (e) {
    e.preventDefault();
    item_id = parseInt($(this).attr('id')) + ':'; //получаем id товара
    // price = parseInt($(this).parent().parent().children('.shop-item-summary').children('.shop-item-price').children('.price-js').html()); //получаем цену товара и преобразуем значение в число parseInt
    price = parseFloat($(this).data('price')); //получаем цену товара и преобразуем значение в число parseInt
    // img = $(this).parent().parent().children('.thumbnail').children('.shop-item-image').children('img').attr('src'); //получаем ссылку на изображение, что бы отразить в корзине
    img = $(this).data('img'); //получаем ссылку на изображение, что бы отразить в корзине
    // title = $(this).parent().parent().children('.shop-item-summary').children('h2').html(); //название товара
    var title = $(this).data('title'); //название товара
    var currency = $(this).data('currency');
    var options = '';
    $('.option-id').each(function (index) {
        // alert($(this).val())
        if (index % 2 !== 0) {
            item_id = item_id + $(this).val().split('/')[0] + ',';
            price = price + parseInt($(this).val().split('/')[1]);
            options = options + $(this).val().split('/')[2] + '|';
        }
    });
    console.log(item_id);
    _toastr(title, "bottom-right", "success", false);
//теперь нужно узнать есть ли в куках уже такой товар
    order = $.cookie('basket'); //получаем куки с именем basket
    !order ? order = [] : order = JSON.parse(order);
    if (order.length == 0) {
        order.push({
            'item_id': item_id,
            'price': price,
            'amount': 1,
            'img': img,
            'title': title,
            'currency': currency,
            'options': options
        });//добавляем объект к пустому массиву
    }
    else {
        flag = false; //флаг, который указывает, что такого товара в корзине нет
        for (var i = 0; i < order.length; i++) //перебираем массив в поисках наличия товара в корзине
        {
            if (order[i].item_id == item_id) {
                order[i].amount = order[i].amount + 1; //если товар уже в корзине, то добавляем +1 к количеству (amount)
                flag = true; //поднимаем флаг, что такой товар есть и с ним делать ничего не нужно
            }

        }

        if (!flag) //если флаг опущен, значит товара в корзине нет и его надо добавить.
        {
            order.push({
                'item_id': item_id,
                'price': price,
                'amount': 1,
                'img': img,
                'title': title,
                'currency': currency,
                'options': options
            }); //добавляем к существующему массиву новый объект
        }
    }
    $.cookie('basket', JSON.stringify(order), {path: '/'}); // переделываем массив с объектами в строку и сохраняем в куки
    count_order(); //запускаем функция для отображения количества заказов.
    show_orders();

});

function count_order() {
    order = $.cookie('basket'); //получаем куки
    order ? order = JSON.parse(order) : order = []; //если заказ есть, то куки переделываем в массив с объектами
    count = 0; // количество товаров
    if (order.length > 0) {
        for (var i = 0; i < order.length; i++) {
            // count = count + parseInt(order[i].amount);
            count = count + 1;
        }
    }
    $('.count_order').html(count);// отображаем количество товаров корзине.
}
function show_orders() {
    var orders = $.cookie('basket'); //получаем куки
    orders ? orders = JSON.parse(orders) : orders = []; //если заказ есть, то куки переделываем в массив с объектами
    var orders_view = '';
    var total_price = 0;
    for (var i = 0; i < orders.length; i++) {
        total_price = total_price + orders[i].price * orders[i].amount;
        orders_view = orders_view + '' +
            '<button type="button" style="padding: 5px" class="close close-order" data-id="' + orders[i].item_id + '" data-dismiss="alert" aria-hidden="true">&times;</button>' +
            '<a class="" href="/product/' + orders[i].item_id + '">' +
            '<img src="' + orders[i].img + '" width="45"' +
            'height="45" alt=""/> ' +
            '<h6>   ' + orders[i].title + '</h6> ' +

            '<div style="margin-bottom: 5px" class="qty" data-id="' + orders[i].item_id + '" ><input style="max-width: 50px" type="number" value="' + orders[i].amount + '" name="qty" maxlength="3" max="999" min="1" /> &times; <span class="order-price">' + orders[i].price + ' ' + orders[i].currency + '</span></div>' +
            '<span style="margin-right: 3px" class="label label-success">'+orders[i].options+'</span>' +
        '</a>';
    }
    $('.quick-cart-wrapper').html(orders_view);
    if (orders[0] !== undefined) {
        $('#total-price').html(total_price + ' ' + orders[0].currency)
    }
    else {
        $('#total-price').html(0)
    }


}

function show_total_price() {
    var orders = $.cookie('basket'); //получаем куки
    orders ? orders = JSON.parse(orders) : orders = []; //если заказ есть, то куки переделываем в массив с объектами
    var total_price = 0;

    for (var i = 0; i < orders.length; i++) {
        total_price = total_price + (orders[i].price * orders[i].amount);
    }
    $('#total-price').html(total_price + ' ' + orders[0].currency)

}

$('.quick-cart-wrapper').on('click', '.close-order', function () {
    var item_id = this.dataset.id;
    order = JSON.parse($.cookie('basket'));//получаем массив с объектами из куки
    for (var i = 0; i < order.length; i++) {
        if (order[i].item_id == item_id) {
            order.splice(i, 1); //удаляем из массива объект
        }
    }
    $.cookie('basket', JSON.stringify(order), {path: '/'});//сохраняем объект в куки
    show_orders();
    count_order();
});

$('.quick-cart-wrapper').on('click', '.qty', function () {
    var order = $.cookie('basket'); //получаем куки
    order ? order = JSON.parse(order) : order = []; //если заказ есть, то куки переделываем в массив с объектами

    var item_id = this.dataset.id;
    var cur_amount = $(this).children('input').val();
    if (cur_amount < 1) {
        $(this).children('input').val(1)
    }
    for (var i = 0; i < order.length; i++) //перебераем весь массив с объектами
    {
        if (order[i].item_id == item_id) //ищем нжный id
        {
            order[i].amount = cur_amount; // устанавливаем количество товара
        }
    }
    $.cookie('basket', JSON.stringify(order),{ path: '/'});
    count_order();
    show_total_price();
    return false;
});

$('.quick-cart-wrapper').on('input', '.qty', function () {
    var order = $.cookie('basket'); //получаем куки
    order ? order = JSON.parse(order) : order = []; //если заказ есть, то куки переделываем в массив с объектами

    var item_id = this.dataset.id;
    var cur_amount = $(this).children('input').val();
    if (cur_amount < 0) {
        $(this).children('input').val(0)
    }

    for (var i = 0; i < order.length; i++) //перебераем весь массив с объектами
    {
        if (order[i].item_id == item_id) //ищем нжный id
        {
            order[i].amount = cur_amount; // устанавливаем количество товара
        }
    }
    $.cookie('basket', JSON.stringify(order),{ path: '/'});
    count_order();
    show_total_price();
    return false;
});


show_orders();
count_order();//запускаем функцию при загрузке страницы