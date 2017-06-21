<!-- START MAP -->
<div id="map">
    <iframe
        style="width:100%;height:335px;"
        frameborder="0"
        scrolling="no"
        marginheight="0"
        marginwidth="0"
        src="https://maps.google.it/maps?ll=41.506705,15.326647&spn=0.00687,0.016512&sll=41.506700,15.326680&amp;output=embed">
    </iframe>

    <div id="map-handler" class="container">
        <a href="#">[x] Close</a>
    </div>
</div>
<!-- END MAP -->
<!-- START PAGE META -->
<div id="page-meta" class="container">

    <!-- TITLE -->
    <div class="title">
        <h1>Contact</h1>
    </div>

    <!-- BREDCRUMB -->
    <div class="breadcrumbs">
        <p id="yit-breadcrumb" itemprop="breadcrumb">
            <a class="home" href="{{ route('home') }}">Home Page</a> &gt;
            <a class="no-link current" href="#">Contact</a>
        </p>
    </div>
    
</div>
<!-- END PAGE META -->

@if (session('status'))
    <div class="box success-box">
        {{ session('status') }}
    </div>
@endif

@if (session('error'))
    <div class="box error-box">
        {{ session('error') }}
    </div>
@endif