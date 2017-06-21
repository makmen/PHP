<div id="content-page" class="content group">
    <div class="container group">
        
        @if (count($errors) > 0)
            <div class="box error-box">
                @foreach ($errors->all() as $error)
                    <p>{{ $error }}</p>
                @endforeach
            </div>
        @endif

        {!! Form::open(['url' => (isset($user->id)) ? route('users.update',['users'=>$user->id]) :route('users.store'),'class'=>'contact-form','method'=>'POST']) !!}

        <ul>
            <li class="text-field">
                <div class="input-prepend"><span class="add-on"><i class="icon-user"></i></span>
                    {!! Form::text('name',isset($user->name) ? $user->name  : old('name'), ['placeholder'=>'Введите имя пользователя', 'class'=> ($errors->has('name') ? ' error' : '') ] ) !!}
                </div>
            </li>
            
            <li class="text-field">
                <div class="input-prepend"><span class="add-on"><i class="icon-user"></i></span>
                    {!! Form::text('lastname',isset($user->lastname) ? $user->lastname  : old('lastname'), ['placeholder'=>'Введите фамилию пользователя', 'class'=> ($errors->has('lastname') ? ' error' : '') ] ) !!}
                </div>
            </li>

            <li class="text-field">
                <div class="input-prepend"><span class="add-on"><i class="icon-user"></i></span>
                    {!! Form::text('login',isset($user->login) ? $user->login  : old('login'), ['placeholder'=>'Введите логин пользователя', 'class'=> ($errors->has('login') ? ' error' : '')]) !!}
                </div>
            </li>

            <li class="text-field">
                <div class="input-prepend"><span class="add-on"><i class="icon-user"></i></span>
                    {!! Form::text('email',isset($user->email) ? $user->email  : old('email'), ['placeholder'=>'Введите email пользователя', 'class'=> ($errors->has('email') ? ' error' : '')]) !!}
                </div>
            </li>
            
                <li class="text-field">
                <div class="input-prepend"><span class="add-on"><i class="icon-user"></i></span>
                    {!! Form::text('phone',isset($user->phone) ? $user->phone  : old('phone'), ['placeholder'=>'Введите телефон пользователя', 'class'=> ($errors->has('phone') ? ' error' : '')]) !!}
                </div>
            </li>

            <li class="text-field">
                <div>
                    <span class="mainlabel">Пароль:</span>
                </div>
                <div class="input-prepend"><span class="add-on"><i class="icon-user"></i></span>
                    {!! Form::password('password', [ 'class' => ($errors->has('password') ? ' error' : '') ] ) !!}
                </div>
            </li>

            <li class="text-field">
                <div>
                    <span class="mainlabel">Повторить пароль:</span>
                </div>
                <div class="input-prepend"><span class="add-on"><i class="icon-user"></i></span>
                    {!! Form::password('password_confirmation', [ 'class' => ($errors->has('password_confirmation') ? ' error' : '') ] ) !!}
                </div>
            </li>

            <li class="text-field">
                <div>
                    <span class="mainlabel">Роль пользователя:</span>
                </div>
  
                <div class="input-prepend">
                    {!! Form::select('role_id', $roles, ( isset($user) ? $user->role->id : null ) ) !!}
                </div>

            </li>	

            @if(isset($user->id))
                <input type="hidden" name="_method" value="PUT">		
            @endif

            <li class="submit-button"> 
                {!! Form::button('Сохранить', ['class' => 'btn btn-the-salmon-dance-3','type'=>'submit']) !!}			
            </li>

        </ul>

        {!! Form::close() !!}

    </div>
</div>