@extends('layouts.site')

@section('content')
@if (!empty($out['news']))
<div class="ambitios_p4">
    <div class="ambitios_wrapper ambitios_p2">
        <h3 class="ambitios_uppercase ambitios_p5">{{ $out['news']['title'] }}</h3>
        <div class="ambitios_date">
            {{ $out['news']['created_at'] }} 
            @if ($out['canEdit'])
                <div class="newsedit">
                    <a href="{{ route('edit',['id'=>$out['news']['id']]) }}">Редактировать</a>
                </div>
                <div class="cb"></div>
            @endif
        </div>
            <br />
            {{ $out['news']['content'] }}
    </div>
    <a href="javascript:void(0)" onClick="back();">Вернуться на предыдущую страницы</a>
</div>
<script type="text/javascript" language="javascript">
function back() { 
    history.go(-1);
}
</script>
@else
<div class="mess-top">
    <div class="fbok">
        <div class="info">Новость не существует или была удалена</div>
    </div>
</div>
@endif
@endsection 