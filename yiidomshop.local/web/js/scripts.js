$(function () {
    
    $('.carousel').carousel({
        interval: false
    });

    $('#mainmenu').dcAccordion({speed: 300});

    $('.add-cart').on('click', function (e) {
        e.preventDefault();
        var id = $(this).data('id');
        var quantity = $('#quantity').val();
        $.ajax({
            url: '/card/add',
            data: {id: id, quantity: quantity},
            type: 'GET',
            success: function (res) {
                if (!res)
                    alert('Ошибка!');
                // console.log(res);
                // showCard(res);
            },
            error: function () {
                alert('Error!');
            }
        });
    });

    $('#card .modal-body').on('click', '.del-item', function () {
        var id = $(this).data('id');
        $.ajax({
            url: '/card/del-item',
            data: {id: id},
            type: 'GET',
            success: function (res) {
                if (!res)
                    alert('Ошибка!');
                showCard(res);
            },
            error: function () {
                alert('Error!');
            }
        });
    });

});

    function showCard(cart) {
        $('#card .modal-body').html(cart);
        $('#card').modal();
    }

    function getCard() {
        $.ajax({
            url: '/card/view-card',
            type: 'GET',
            success: function (res) {
                if (!res)
                    alert('Ошибка!');
                showCard(res);
            },
            error: function () {
                alert('Error!');
            }
        });
    }

    function clearCart() {
        $.ajax({
            url: '/card/clear',
            type: 'GET',
            success: function (res) {
                if (!res)
                    alert('Ошибка!');
                showCard(res);
            },
            error: function () {
                alert('Error!');
            }
        });
    }