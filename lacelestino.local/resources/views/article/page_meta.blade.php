<!-- START PAGE META -->
<div id="page-meta" class="container">

    <!-- TITLE -->
    <div class="title">
        <h1>Категория: {{ ($category) ?  $category->title : 'Любая'  }}</h1>
    </div>
    
    <!-- BREDCRUMB -->
    <div class="breadcrumbs">
        <p id="yit-breadcrumb" itemprop="breadcrumb">
            <a class="home" href="{{ route('home') }}">
                Home Page
            </a> &gt;
            <a class="no-link current" href="#">
                {{ $category->title or 'Любая' }}
            </a>
        </p>
    </div>
    
</div>
<!-- END PAGE META -->