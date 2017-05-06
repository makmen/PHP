<ul class="ambitios_menu">
  <li><a href="/" @if (request()->url() == action('IndexController@index')) class="ambitios_active" @endif><span><span>Главная</span></span></a></li>
  <li><a href="{{ action('IndexController@technology') }}" @if (request()->url() == action('IndexController@technology')) class="ambitios_active" @endif><span><span>Технологии</span></span></a></li>
  <li><a href="{{ action('NewsController@index') }}" @if (request()->url() == action('NewsController@index')) class="ambitios_active" @endif><span><span>Новости</span></span></a>
@if (Auth::check())
    <ul>
        <li><a href="{{ action('NewsController@add') }}">Добавить новость</a></li>
    </ul>
@endif
  </li>
  <li><a href="{{ action('IndexController@contacts') }}" @if (request()->url() == action('IndexController@contacts')) class="ambitios_active" @endif><span><span>Контакты</span></span></a></li>
@if (Auth::check())
  <li><a href="/auth/logout"><span><span>Выход</span></span></a></li>
@endif
</ul>