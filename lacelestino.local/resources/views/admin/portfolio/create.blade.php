<div id="content-page" class="content group">
    <div class="container group">
        
        @if (count($errors) > 0)
            <div class="box error-box">
                @foreach ($errors->all() as $error)
                    <p>{{ $error }}</p>
                @endforeach
            </div>
        @endif

        {!! Form::open(['url' => (isset($portfolio->id)) ? route('portfolios.update',['portfolios'=>$portfolio->id]) : route('portfolios.store'),'class'=>'contact-form','method'=>'POST','enctype'=>'multipart/form-data']) !!}

        <ul>
            <li class="text-field">
                <div class="input-prepend">
                    {!! Form::text('project',isset($portfolio->project) ? $portfolio->project  : old('project'), ['placeholder'=>'Введите название страницы', 'class'=> ($errors->has('project') ? ' error' : '') ]) !!}
                </div>
            </li>
            
            <li class="textarea-field">
                 <div class="input-prepend">
                     {!! Form::textarea('text', isset($portfolio->text) ? $portfolio->text  : old('text'), ['id'=>'editor','class' => 'form-control', 'placeholder'=>'Введите текст страницы' ]) !!}
                </div>
                <div class="msg-error"></div>
            </li>

            <li class="text-field">
                <div class="input-prepend">
                    {!! Form::text('customer', isset($portfolio->customer) ? $portfolio->customer  : old('customer'), ['placeholder'=>'Введите заказчика', 'class' => ($errors->has('customer') ? ' error' : '') ]) !!}
                </div>
            </li>

            @if(isset($portfolio->img->path))
            <li class="textarea-field">
                <label>
                    <span class="label">Изображения материала:</span>
                </label>
                {{ Html::image( asset('images/portfolios/').$portfolio->img->path,'', ['style'=>'width:400px'] ) }}
                {!! Form::hidden('old_image',$portfolio->img->path) !!}
            </li>
            @endif

            <li class="text-field">
                <div class="input-prepend">
                    {!! Form::file('image', ['class' => 'filestyle','data-buttonText'=>'Выберите изображение','data-buttonName'=>"btn-primary",'data-placeholder'=>"Файла нет"]) !!}
                </div>
            </li>

            @if(isset($portfolio->id))
                <input type="hidden" name="_method" value="PUT">		
            @endif

            <li class="submit-button"> 
                {!! Form::button('Сохранить', ['class' => 'btn btn-times-changing-5','type'=>'submit']) !!}			
            </li>

        </ul>

        {!! Form::close() !!}

        <script>
            CKEDITOR.replace('editor');
        </script>
    </div>
</div>