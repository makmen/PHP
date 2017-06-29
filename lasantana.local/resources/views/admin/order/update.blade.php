<div class="wrapper container-fluid">

    @if (session('error_message'))
        <div class="alertbox error-box">
            <p>{{ session('error_message') }}</p>
        </div>
    @endif

    {!! Form::open(['url' => route('orders.update',['orders'=>$order->id]),'class'=>'form-horizontal','method'=>'POST']) !!}

        <div class="form-group">
            {!! Form::label('name','Название',['class' => 'col-xs-2 control-label'])   !!}
            <div class="col-xs-8">
                {!! Form::text('name', $order->name, ['class' => 'form-control' . ($errors->has('name') ? ' error' : '') ])!!}
            </div>
        </div>

        <div class="form-group">
            {!! Form::label('email','Email',['class' => 'col-xs-2 control-label'])   !!}
            <div class="col-xs-8">
                {!! Form::text('email', $order->email, ['class' => 'form-control' . ($errors->has('email') ? ' error' : '') ])!!}
            </div>
        </div>
    
        <div class="form-group">
            {!! Form::label('phone','Телефон',['class' => 'col-xs-2 control-label'])   !!}
            <div class="col-xs-8">
                {!! Form::text('phone', $order->phone, ['class' => 'form-control' . ($errors->has('phone') ? ' error' : '') ])!!}
            </div>
        </div>

        <div class="form-group">
            {!! Form::label('address','Адрес',['class' => 'col-xs-2 control-label'])   !!}
            <div class="col-xs-8">
                {!! Form::text('address', $order->address, ['class' => 'form-control' . ($errors->has('address') ? ' error' : '') ])!!}
            </div>
        </div>
    
        <div class="form-group">
            {!! Form::label('message','Сообщение',['class' => 'col-xs-2 control-label'])   !!}
            <div class="col-xs-8">
                {!! Form::textarea('message', $order->message, ['class' => 'form-control' . ($errors->has('message') ? ' error' : '') ])!!}
            </div>
        </div>
    
        <div class="form-group">
            {!! Form::label('quantity','Количество',['class' => 'col-xs-2 control-label'])   !!}
            <div class="col-xs-8">
                {!! Form::text('quantity', $order->quantity, ['id' => 'quantity_order','disabled' => 'disabled', 'class' => 'form-control' . ($errors->has('quantity') ? ' error' : '') ])!!}
            </div>
        </div>
    
        <div class="form-group">
            {!! Form::label('summa','Сумма',['class' => 'col-xs-2 control-label'])   !!}
            <div class="col-xs-8">
                {!! Form::text('summa', $order->summa, ['id' => 'summa_order', 'disabled' => 'disabled', 'class' => 'form-control' . ($errors->has('summa') ? ' error' : '') ])!!}
            </div>
        </div>
    
        <input type="hidden" name="_method" value="PUT">
        
        <div class="form-group">
            <div class="col-xs-12">
                <table id='order-items-admin' style="width:100%;">
                    <thead>
                    <th>Позиция</th>
                    <th>Товар</th>
                    <th>Изображение</th>
                    <th>Цена</th>
                    <th>Количество</th>
                    <th>Общая цена</th>
                    <th>Действие</th> 
                    </thead>
                    <tbody>
                        @set($i, 0)
                        @foreach($order->products as $k=>$product)
                        <tr id="tr_{{ $k }}" class="product-item">
                            <td class="position">{{ ++$i }}</td>
                            <td>{!! Html::link(route('product.show',['product'=>$product->id]), $product['title']) !!}</td>
                            @set( $images, json_decode($product['img']) )
                            <td><img src="{{ asset('adm/images/products/' . $product->id . '/mini' . $images[0]) }}" alt="image"></td>
                            <td class='summa-one'>{{ $product['price'] }}</td>
                            <td><input name='change-quantity[{{ $product->id }}]' data-id="{{ $k }}" text='text' class='change-quantity'  value="{{ $product->pivot->quantity_product }}"></td>
                            <td class='change-summa'>{{ $product->pivot->summa_product }}</td>
                            <td>
                                <a href="javascript:void(0)" class="del-product" data-id="{{ $k }}">
                                    <img src="{{ asset('adm/images/del.gif') }}">
                                </a>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>

        <div class="form-group">
            <div class="col-xs-offset-2 col-xs-10">
                {!! Form::button('Сохранить', ['class' => 'btn btn-primary','type'=>'submit']) !!}
            </div>
        </div>
        
    <script>
    $(function () {
        var files;
        
        $('input.change-quantity').change(function(){
            var id = $(this).data('id');
            var quantity = $(this).val();
            if ( !IsNumertic(quantity) || quantity <= 0 ) {
                quantity = 1;
            }
            var priceOne = $('#tr_' + id + ' td.summa-one').text();
            var priceOld = $('#tr_' + id + ' td.change-summa').text();

            $('#tr_' + id + ' td.change-summa').text( quantity * priceOne );
            reCalcSumma();
            reCalcQuantity();
        });
    
        $('#order-items-admin').on('click', '.del-product', function () {
            var id = $(this).data('id');

            $('#tr_' + id).fadeOut(500);
            setTimeout(function() { 
                $('#tr_' + id).remove();
                reCalcPos();
                reCalcSumma();
                reCalcQuantity();
            }, 1500);

        });
        
        function reCalcQuantity() {
            var quantity_order = 0;
            $('tr.product-item input.change-quantity').each(function(i, elem) {
                quantity_order += parseInt( $(elem).val() )
            });
            $('#quantity_order').val(quantity_order);
        }
        
        function reCalcSumma() {
            var summa_order = 0;
            $('tr.product-item td.change-summa').each(function(i, elem) {
                summa_order += parseInt( $(elem).text() )
            });
            $('#summa_order').val(summa_order);
        }
        
        function reCalcPos() {
            $('tr.product-item td.position').each(function(i,elem) {
                $(elem).text(i + 1);

            });
        }
        
        function IsNumertic(n) {
            return !isNaN(parseFloat(n)) && isFinite(n)
        }
        
        
    });
    </script>
        
    
    {!! Form::close() !!}

</div>