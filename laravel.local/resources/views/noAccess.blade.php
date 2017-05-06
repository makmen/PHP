@extends('layouts.site')

@section('content')
<div class="err">
    <div class="mess-top">
        <div class="error">
        <h2 class="noaccess">Доступ запрещен </h2>
            <div class="msg">
                @if ($out['noAccess']===1)
                    У вас нет прав на доступ к этому разделу
                @else
                    {{ $out['noAccess'] }}
                @endif
            </div>
        </div>
    </div>
</div>
@endsection 