<div id="page-meta" class="container">

    <div class="title">
        <h1>{{ $article->title }}</h1>
    </div>
    <!-- BREDCRUMB -->
    <div class="breadcrumbs">
        <p id="yit-breadcrumb" itemprop="breadcrumb">
            <a class="home" href="{{ route('home') }}">
                Home Page
            </a> &gt;
            <a href="{{ route('articleCategory', ['category'=>$article->category_id]) }}" title="View all posts in Web Design">
                {{ $article->category->title }}
            </a> &gt;
            <a class="no-link current" href="#">
                {{ $article->title }}
            </a>
        </p>
    </div>
</div>