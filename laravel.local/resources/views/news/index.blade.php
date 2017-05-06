@extends('layouts.site')

@section('content')
@if (!empty($out['news']))
    @foreach($out['news'] as $k=>$v)
    <div class="ambitios_p4">
        <div class="ambitios_wrapper ambitios_p2">
            <h3 class="ambitios_uppercase ambitios_p5">{{$v['title']}}</h3>
            <div class="ambitios_date">{{$v['created_at']}}</div>
        </div>
        <p>{{$v['content']}}&nbsp;...</p>
        <div class="ambitios_wrapper">
            <a href="{{ route('view',['id'=>$v['id']]) }}" class="ambitios_button_small_rev ambitios_fleft">Читать</a>
        </div>
    </div>
    @endforeach
        @if ($out['total_stat'] >= $out['onpage'])
            @include('pagging')
        @endif
@else
    <div class="mess-top">
        <div class="fbok">
            <div class="info">Новостей нет</div>
        </div>
    </div>
@endif
@endsection 