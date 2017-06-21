<!-- START PRIMARY -->
<div id="primary" class="sidebar-right">
    <div class="container group">
        <div class="row">
            <!-- START CONTENT -->
            <div id="content-blog" class="span9 content group">
                @if($articles)
                @foreach($articles as $article)
                <div class="post type-post status-publish format-video sticky hentry category-web-design hentry-post group blog-big">
                    <!-- post featured & title -->

                    <div class="thumbnail">
                        <!-- post title -->
                        <img width="890" height="340" src="{{ asset( 'images/articles/' . $article->img->max ) }}" class="attachment-blog_big wp-post-image" alt="3" />
                        <!-- post meta -->
                        <div class="meta group span4">
                            <h2 class="post-title">
                                <a href="{{ route('article.show',['id' => $article->id]) }}">{{ $article->title }}</a>
                            </h2>
                            <div>
                                <p class="author">
                                    <img src="{{ asset( 'images/icons/author.png' ) }}" alt="icon-user" />
                                    <span>Author:</span>
                                    <a href="#" rel="author">{{ $article->user->name }}</a>
                                </p>
                                <p class="date">
                                    <img src="{{ asset( 'images/icons/date.png' ) }}" alt="icon-calendar" /><span>Date:</span> {{ $article->created_at->format('F d, Y') }}
                                </p>
                                <p class="comments">
                                    <img src="{{ asset( 'images/icons/comments.png' ) }}" alt="icon-comment" />
                                     <span>
                                        <a href="section-shortcodes-sticky-posts.html" title="Comment on Section shortcodes &amp; sticky posts!">
                                            <span>{{Lang::choice('ru.comments', count($article->comments))}}:</span> {{ count($article->comments) }}</a>
                                    </span>
                                </p>
                            </div>
                        </div>
                    </div>

                    <div class="clear"></div>
                </div>
                @endforeach
                
                <div class='general-pagination group'>

                    @if($articles->lastPage() > 1) 

                        @if($articles->currentPage() !== 1)
                            <a href="{{ $articles->url(($articles->currentPage() - 1)) }}">{{ Lang::get('pagination.previous') }}</a>
                        @endif

                        @for($i = 1; $i <= $articles->lastPage(); $i++)
                            @if($articles->currentPage() == $i)
                                <a class="selected disabled">{{ $i }}</a>
                            @else
                                <a href="{{ $articles->url($i) }}">{{ $i }}</a>
                            @endif		
                        @endfor

                        @if($articles->currentPage() !== $articles->lastPage())
                            <a href="{{ $articles->url(($articles->currentPage() + 1)) }}">{{ Lang::get('pagination.next') }}</a>
                        @endif

                    @endif
                    
                </div>
                
            @else
                <div class="box alert-box">
                    {!! Lang::get('ru.articles_no') !!}
                </div>
            @endif	       

            </div>
            <!-- END CONTENT -->

            <!-- START SIDEBAR -->
            <div id="sidebar-blog-sidebar" class="span3 sidebar group">
                <div id="text-9" class="widget-first widget widget_text">
                    <h3>I&#8217;m social</h3>
                    <div class="textwidget">
                        Praesent ultricies iaculis erat iaculis feugiat. Sed suscipit tempor felis, sit amet aliquam nunc sollicitudin sed.
                        <br /><br />

                        <a href="# " class="socials-small facebook-small" title="Facebook"  >facebook</a>

                        <a href="#" class="socials-small rss-small" title="Rss"  >rss</a>

                        <a href="#" class="socials-small twitter-small" title="Twitter"  >twitter</a>

                        <a href="#" class="socials-small google-small" title="Google"  >google</a>

                        <a href="#" class="socials-small linkedin-small" title="Linkedin"  >linkedin</a>

                        <a href="#" class="socials-small pinterest-small" title="Pinterest"  >pinterest</a></div>
                </div>
            </div>
            <!-- END SIDEBAR -->
        </div>
    </div>
</div>
<!-- END PRIMARY -->