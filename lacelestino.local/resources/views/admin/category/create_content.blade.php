<div id="content-page" class="content group">
    <div class="container group">
        
        @if (count($errors) > 0)
            <div class="box error-box">
                @foreach ($errors->all() as $error)
                    <p>{{ $error }}</p>
                @endforeach
            </div>
        @endif

        {!! Form::open(['url' => (isset($category->id)) ? route('categories.update',['categories'=>$category->id]) : route('categories.store'),'class'=>'contact-form', 'method'=>'POST' ]) !!}
        
        <ul>
            <li class="text-field">
                <div class="input-prepend">
                    {!! Form::text('title',isset($category->title) ? $category->title  : old('title'), ['placeholder'=>'Введите название страницы', 'class'=> ($errors->has('title') ? ' error' : '') ]) !!}
                </div>
            </li>

            @if(isset($category->id))
                <input type="hidden" name="_method" value="PUT">		
            @endif

            <li class="submit-button"> 
                {!! Form::button('Сохранить', ['class' => 'btn btn-times-changing-5','type'=>'submit']) !!}			
            </li>

        </ul>

        {!! Form::close() !!}

    </div>
</div>