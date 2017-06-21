@extends( 'layouts.main' )

@section('navigation')
    {!! $navigation !!}
@endsection

@section('content')
<div class="container group">
    <div class="row">
        <!-- START CONTENT -->
        <div id="content-page" class="span12 content group">
            <div class="box error-box">
                У вас нет прав к этому разделу.
            </div>
        </div>
    </div>
</div>
@endsection

@section('footer')
    {!! $footer !!}
@endsection
