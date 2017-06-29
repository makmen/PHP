<div class="wrapper container-fluid">

    @if (session('error_message'))
        <div class="alertbox error-box">
            <p>{{ session('error_message') }}</p>
        </div>
    @endif
    
    @if (count($errors) > 0)
        <div class="alertbox error-box">
            @foreach ($errors->all() as $error)
                <p>{{ $error }}</p>
            @endforeach
        </div>
    @endif

    {!! Form::open(['url' => (isset($product->id)) ? route('products.update',['products'=>$product->id]) : route('products.store'),'class'=>'form-horizontal','method'=>'POST']) !!}

        <div class="form-group">
            {!! Form::label('title','Название',['class' => 'col-xs-2 control-label'])   !!}
            <div class="col-xs-8">
                {!! Form::text('title', isset($product->title) ? $product->title  : old('title'), ['class' => 'form-control' . ($errors->has('title') ? ' error' : '') ,'placeholder'=>'Введите название продукта'])!!}
            </div>
        </div>
    
        <div class="form-group">
            {!! Form::label('price','Цена продукта',['class' => 'col-xs-2 control-label'])   !!}
            <div class="col-xs-8">
                {!! Form::text('price', isset($product->price) ? $product->price  : old('price'), ['class' => 'form-control' . ($errors->has('price') ? ' error' : '') ,'placeholder'=>'Введите цену продукта'])!!}
            </div>
        </div>
    
        <div class="form-group">
            {!! Form::label('new','Новый товар',['class' => 'col-xs-2 control-label'])   !!}
            <div class="col-xs-8">
                {!! Form::select('new', $newProducts, isset($product->new) ? $product->new : '', ['class' => 'form-control'] ) !!}
            </div>
        </div>
    
        <div class="form-group">
            {!! Form::label('content','Описание товара',['class' => 'col-xs-2 control-label'])   !!}
            <div class="col-xs-8">
                {!! Form::textarea('content', isset($product->content) ? $product->content  : old('content'), ['id'=>'editor','class' => 'form-control', 'placeholder'=>'Введите описание товара' ]) !!}
            </div>
        </div>
    
        <div class="form-group">
            {!! Form::label('title','Категория продукта',['class' => 'col-xs-2 control-label'])   !!}
            <div class="col-xs-8">
                {!! Form::select('category_id', $categories, isset($product->category_id) ? $product->category_id : '', ['class' => 'form-control'] ) !!}
            </div>
        </div>
    
        <div class="form-group">
            {!! Form::label('keywords','Ключевые слова',['class' => 'col-xs-2 control-label'])   !!}
            <div class="col-xs-8">
                {!! Form::text('keywords', isset($product->keywords) ? $product->keywords  : old('keywords'), ['class' => 'form-control' ,'placeholder'=>'Введите ключевые слова'])!!}
            </div>
        </div>
    
        <div class="form-group">
            {!! Form::label('images','Изображения',['class' => 'col-xs-2 control-label'])   !!}
            <div class="col-xs-8">
                <span class="btn btn-primary fileinput-button">
                    <input id="fileupload" class="filestyle" name="image[]" type="file" multiple="multiple">
                </span>
                <img src="{{ asset('adm/images/loading.gif') }}" id="imgload" />

                <ul class="ajax-respond">
                    @if ( old('img') )
                        @foreach(old('img') as $img)
                            <li>{{ $img }}<img class="del-item" src="{{ asset('adm/images/del.gif') }}"></li>
                        @endforeach
                    @elseif ( (isset($product->id)) && is_array($product->img) )
                        @foreach($product->img as $img)
                            <li>{{ $img }}<img class="del-item" src="{{ asset('adm/images/del.gif') }}"></li>
                        @endforeach
                    @else

                    @endif
                </ul>

                <div class="hidden-respond">
                    @if ( old('img') )
                        @foreach(old('img') as $img)
                            <input type="hidden" name="img[]" value="{{ $img }}">
                        @endforeach
                    @elseif ( (isset($product->id)) && is_array($product->img) )
                        @foreach($product->img as $img)
                            <input type="hidden" name="img[]" value="{{ $img }}">
                        @endforeach
                    @else

                    @endif
                </div>
            </div>
        </div>

        <div class="form-group">
            {!! Form::label('description','Описание',['class' => 'col-xs-2 control-label'])   !!}
            <div class="col-xs-8">
                {!! Form::text('description', isset($product->description) ? $product->description  : old('description'), ['class' => 'form-control' ,'placeholder'=>'Введите описание страницы'])!!}
            </div>
        </div>
    
        @if(isset($product->id))
            <input type="hidden" name="_method" value="PUT">		
        @endif

        <div class="form-group">
            <div class="col-xs-offset-2 col-xs-10">
                {!! Form::button('Сохранить', ['class' => 'btn btn-primary','type'=>'submit']) !!}
            </div>
        </div>

    {!! Form::close() !!}
<script>
    CKEDITOR.replace('editor');
</script>
        
<script>
$(function () {
    var files;
    
    $('#fileupload').change(function(){
        files = this.files;
        upload();
    });
    
    $('.ajax-respond').on('click', '.del-item', function () {
        var file = $(this).parent();
        $.ajax({
            url: '{{ route('delfile') }}',
            data: {file: file.text()},
            type: 'POST',
            headers: {
                'X-CSRF-TOKEN': $('input[name="_token"]').val()
            },
            success: function (res) {
                $('input[value="' + file.text() + '"]').remove();
                file.empty().remove();
            },
            error: function () {
                alert('Error!');
            }
        });
    });
    
    function upload() {
        $("#imgload").show();
        $('button[type="submit"]').attr("disabled","disabled");
        var data = new FormData();
        $.each( files, function( key, value ){
            data.append( key, value );
        });

        // Отправляем запрос
        $.ajax({
            url: '{{ route('loader') }}',
            type: 'POST',
            data: data,
            headers: {
                'X-CSRF-TOKEN': $('input[name="_token"]').val()
            },
            cache: false,
            dataType: 'json',
            processData: false, // Не обрабатываем файлы (Don't process the files)
            contentType: false, // Так jQuery скажет серверу что это строковой запрос
            success: function( respond, textStatus, jqXHR ){
                // Если все ОК
                $("#imgload").hide();
                $('button[type="submit"]').removeAttr("disabled");
                if( typeof respond.error === 'undefined' ){
                    var files_path = respond.files;
                    $.each( files_path, function( key, val ){ 
                        $('<li></li>').appendTo('ul.ajax-respond').text(val);
                        $('ul.ajax-respond li:last').append('<img class="del-item" src="{{ asset('adm/images/del.gif') }}">'); 
                        $('div.hidden-respond').append('<input type="hidden" name="img[]" value="' + val  + '">');
                    } )
                }
                else{
                    alert( respond.error );
                }
            },
            error: function( jqXHR, textStatus, errorThrown ){
                alert('ОШИБКИ AJAX111 запроса: ' + textStatus );
            }
        });
    }

});
</script>

</div>