@extends('layouts.site')

@section('content')
<h3 class="ambitios_uppercase">Добавить новость </h3>
<div id="contact_form">
    <div id="Note"></div>
    @if (isset($out['errmessage']))
        <div class="mess-top">
            <div class="error">
                <div class="msg">{{ $errs['errmessage'] }}</div>
            </div>
        </div>
    @elseif (isset($out['editsuccess']))
        <div class="mess-top">
            <div class="fbok">
                <div class="success">Данные изменены</div>
            </div>
        </div>
    @endif
    <form id="register" method="post" action="{{ $out['urlmode'] }}">
        <div class="fb">
                <div class="description">Заголовок</div>
                <div class="date">
                <input id="name" name="title" class="w100{{ $errors->has('title') ? ' err' : '' }}" type="text" value="{{ old('title')  }}" />
                    @if ($errors->has('title'))
                        <div class="error">
                            <div class="msg">{{ $errors->first('title') }}</div>
                        </div>
                    @endif
                </div>
                <div class="cb"></div>
        </div>
        <div class="fb">
                <div class="description">Содержание</div>
                <div class="date">
                <textarea id="message" name="content" class="w100{{ $errors->has('content') ? ' err' : '' }}" rows="5" cols="10">{{ old('content') }}</textarea>
                    @if ($errors->has('content'))
                        <div class="error">
                            <div class="msg">{{ $errors->first('content') }}</div>
                        </div>
                    @endif
                </div>
                <div class="cb"></div>
        </div>
        <div class="fb">
                <div class="description">Страна</div>
                <div class="date">
                <select name="country" class="{{ $errors->has('country') ? ' err' : '' }}">
                @foreach($out['countries'] as $v)
                <option value="{{ $v->id }}"  @if (old('country') == $v->id)selected = "selected"@endif>{{ $v->title }}</option>
                @endforeach
                </select>
                    @if ($errors->has('country'))
                        <div class="error">
                            <div class="msg">{{ $errors->first('country') }}</div>
                        </div>
                    @endif
                </div>
                <div class="cb"></div>
        </div>
        <div class="submit news">
            <input class="btn" type="submit" value="Сохранить">
        </div> 
        {{ csrf_field() }}
    </form>
</div>
@endsection 