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
    
    @if ($success)
        <div class="alertbox success-box">
            {{ $success }}
        </div>
    @endif

    {!! Form::open(['url' => route('editUser') ,'class'=>'form-horizontal','method'=>'POST']) !!}

        <div class="form-group">
            {!! Form::label('name','Имя',['class' => 'col-xs-2 control-label'])   !!}
            <div class="col-xs-8">
                {!! Form::text('name', isset($user->name) ? $user->name  : old('name'), ['class' => 'form-control' . ($errors->has('name') ? ' error' : '') ,'placeholder'=>'Введите имя пользователя'])!!}
            </div>
        </div>
    
        <div class="form-group">
            {!! Form::label('email','Почта',['class' => 'col-xs-2 control-label'])   !!}
            <div class="col-xs-8">
                {!! Form::text('email', isset($user->email) ? $user->email  : old('email'), ['class' => 'form-control' . ($errors->has('email') ? ' error' : '') ,'placeholder'=>'Введите email пользователя'])!!}
            </div>
        </div>
    
        <div class="form-group">
            {!! Form::label('login','Логин',['class' => 'col-xs-2 control-label'])   !!}
            <div class="col-xs-8">
                {!! Form::text('login', isset($user->login) ? $user->login  : old('login'), ['class' => 'form-control' . ($errors->has('login') ? ' error' : '') ,'placeholder'=>'Введите логин пользователя'])!!}
            </div>
        </div>
    
        <div class="form-group">
            {!! Form::label('password','Пароль',['class' => 'col-xs-2 control-label'])   !!}
            <div class="col-xs-8">
                {!! Form::password('password', ['class' => 'form-control' . ($errors->has('password') ? ' error' : '') ,'placeholder'=>'Введите новый пароль'])!!}
            </div>
        </div>
    
        <div class="form-group">
            {!! Form::label('password_confirmation','Новый пароль',['class' => 'col-xs-2 control-label'])   !!}
            <div class="col-xs-8">
                {!! Form::password('password_confirmation', ['class' => 'form-control' . ($errors->has('password_confirmation') ? ' error' : '') ,'placeholder'=>'Повторить пароль'])!!}
            </div>
        </div>

        <div class="form-group">
            <div class="col-xs-offset-2 col-xs-10">
                {!! Form::button('Сохранить', ['class' => 'btn btn-primary','type'=>'submit']) !!}
            </div>
        </div>
        
    
    {!! Form::close() !!}

</div>