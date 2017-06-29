@extends( 'layouts.main' )

@section('navigation')
    {!! $navigation or '' !!}
@endsection

@section('content')
<div class="main-container col1-layout"> 
    <!--Start of Home Content-->
    <div class="main">
        <div class="col-main">
            <div class="std"> 
                <div class="alertbox alert-box">
                    Запрашивоемой страницы не существует
                </div>
            </div>
        </div>
    </div>
    <!--End of Home Content--> 
    <div style="display: none;" id="back-top"> <a href="#"><img alt="" src="{{ asset('images/backtop.gif') }}" /></a> </div>
</div>
@endsection