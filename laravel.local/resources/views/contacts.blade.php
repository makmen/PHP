@extends('layouts.site')

@section('content')
<h3 class="ambitios_uppercase">Контактная информация </h3>
<div id="contact_form">
    <div id="Note"></div>
    @if (isset($out['errmessage']))
        <div class="mess-top">
            <div class="error">
                <div class="msg">{{ $errs['errmessage'] }}</div>
            </div>
        </div>
    @elseif (isset($out['success']))
        <div class="mess-top">
            <div class="fbok">
                <div class="success">Письмо отправлено</div>
            </div>
        </div>
    @endif
    <form class="cmxform" id="contactform" method="post" action="{{ route('addcontacts') }}">
        <div class="field ambitios_input_standat_height ambitios_p2">
                <label for="name">Имя</label>
                <input id="name" name="name" class="required{{ $errors->has('name') ? ' err' : '' }}" type="text" value="{{ old('name')  }}" />
        </div>
        <div class="field ambitios_input_standat_height ambitios_p2">
                <label for="email">Email</label>
                <input id="email" name="email" class="required email{{ $errors->has('email') ? ' err' : '' }}" type="text" value="{{ old('email') }}" />
        </div>
        <div class="ambitios_textarea ambitios_p2 field">
                <label for="message">Сообщение</label>
                <textarea id="message" name="message" class="required{{ $errors->has('message') ? ' err' : '' }}" rows="5" cols="10">{{ old('message') }}</textarea>
        </div>
        <div>
            <div class="buttons-wrapper">
                <div class="ambitios_wrapper ambitios_p2">
                    <div class="ambitios_button_contact">
                        <input type="submit" value="Send" name="contactus" id="contactus" />
                    </div>
                </div>
            </div>
        </div>
        {{ csrf_field() }}
    </form>

</div>
<div class="ambitios_wrapper">
    <div class="ambitios_fleft">
        <h3 class="ambitios_uppercase">Директор: Высоцкий Василий Семенович </h3>
        Phone: +375 29 615 14 12<br />
        Fax: 8017 125 32 64<br />
        Email: <a href="mailto:mail@vactt@mail.ru">vactt@mail.ru</a><br /> 
        Email: <a href="mailto:mail@vvs200362@list.ru">vvs200362@list.ru</a> 
    </div>
</div>
<br />

@endsection 