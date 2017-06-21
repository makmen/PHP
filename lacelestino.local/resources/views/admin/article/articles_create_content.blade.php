<div id="content-page" class="content group">
    <div class="container group">
        
        @if (count($errors) > 0)
            <div class="box error-box">
                @foreach ($errors->all() as $error)
                    <p>{{ $error }}</p>
                @endforeach
            </div>
        @endif

        {!! Form::open(['url' => (isset($article->id)) ? route('articles.update',['articles'=>$article->id]) : route('articles.store'),'class'=>'contact-form','method'=>'POST','enctype'=>'multipart/form-data']) !!}

        <ul>
            <li class="text-field">
                <div class="input-prepend">
                    {!! Form::text('title',isset($article->title) ? $article->title  : old('title'), ['placeholder'=>'Введите название страницы', 'class'=> ($errors->has('title') ? ' error' : '') ]) !!}
                </div>
            </li>

            <li class="text-field">
                <div class="input-prepend">
                    {!! Form::text('keywords', isset($article->keywords) ? $article->keywords  : old('keywords'), ['placeholder'=>'Введите ключевые слова для страницы']) !!}
                </div>
            </li>

            <li class="text-field">
                <div class="input-prepend">
                    {!! Form::text('description', isset($article->description) ? $article->description  : old('description'), ['placeholder'=>'Введите мета описание для страницы']) !!}
                </div>
            </li>

            <li class="textarea-field">
                 <div class="input-prepend">
                     {!! Form::textarea('text', isset($article->text) ? $article->text  : old('text'), ['id'=>'editor','class' => 'form-control', 'placeholder'=>'Введите текст страницы' ]) !!}
                </div>
                <div class="msg-error"></div>
            </li>

            @if(isset($article->img->path))
            <li class="textarea-field">
                <label>
                    <span class="label">Изображения материала:</span>
                </label>
                {{ Html::image( asset('images/articles/').$article->img->path,'', ['style'=>'width:400px'] ) }}
                {!! Form::hidden('old_image',$article->img->path) !!}
            </li>
            @endif

            <li class="text-field">
                <div class="input-prepend">
                    {!! Form::file('image', ['class' => 'filestyle','data-buttonText'=>'Выберите изображение','data-buttonName'=>"btn-primary",'data-placeholder'=>"Файла нет"]) !!}
                </div>
            </li>

            <li class="text-field">
                <div>
                    <span class="mainlabel">Категория</span>
                </div>
                <div class="input-prepend">
                    {!! Form::select('category_id', $categories, isset($article->category_id) ? $article->category_id  : '') !!}
                </div>
            </li>	 

            @if(isset($article->id))
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