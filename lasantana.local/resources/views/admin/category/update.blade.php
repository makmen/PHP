<div class="wrapper container-fluid">

    @if (session('error_message'))
        <div class="alertbox error-box">
            <p>{{ session('error_message') }}</p>
        </div>
    @endif

    {!! Form::open(['url' => (isset($category->id)) ? route('categories.update',['categories'=>$category->id]) : route('categories.store'),'class'=>'form-horizontal','method'=>'POST']) !!}

        <div class="form-group">
            {!! Form::label('title','Название',['class' => 'col-xs-2 control-label'])   !!}
            <div class="col-xs-8">
                {!! Form::text('title', isset($category->title) ? $category->title  : old('title'), ['class' => 'form-control' . ($errors->has('title') ? ' error' : '') ,'placeholder'=>'Введите название категории'])!!}
            </div>
        </div>
    
        <div class="form-group">
            {!! Form::label('title','Категория',['class' => 'col-xs-2 control-label'])   !!}
            <div class="col-xs-8">
                {!! Form::select('parent_id', $categories, isset($category->parent_id) ? $category->parent_id : '', ['class' => 'form-control'] ) !!}
            </div>
        </div>
    
        <div class="form-group">
            {!! Form::label('keywords','Ключевые слова',['class' => 'col-xs-2 control-label'])   !!}
            <div class="col-xs-8">
                {!! Form::text('keywords', isset($category->keywords) ? $category->keywords  : old('keywords'), ['class' => 'form-control' ,'placeholder'=>'Введите ключевые слова'])!!}
            </div>
        </div>
    
        <div class="form-group">
            {!! Form::label('description','Описание',['class' => 'col-xs-2 control-label'])   !!}
            <div class="col-xs-8">
                {!! Form::text('description', isset($category->description) ? $category->description  : old('description'), ['class' => 'form-control' ,'placeholder'=>'Введите описание'])!!}
            </div>
        </div>
    
        @if(isset($category->id))
            <input type="hidden" name="_method" value="PUT">		
        @endif

        <div class="form-group">
            <div class="col-xs-offset-2 col-xs-10">
                {!! Form::button('Сохранить', ['class' => 'btn btn-primary','type'=>'submit']) !!}
            </div>
        </div>
        
    
    {!! Form::close() !!}

</div>