<div class="wrap_result"></div>
<div id="primary" class="sidebar-right">
    <div class="container group">
        <div class="row">
            <!-- START CONTENT -->
            <div id="content-single" class="span9 content group">
                <div class="post type-post status-publish format-gallery hentry  tag-design tag-developing tag-web hentry-post group blog-elegant">
                    <!-- post featured & title -->
                    <div class="thumbnail">
                        <div class="row">
                            <!-- post meta -->
                            <div class="meta group span3">
                                <div>
                                    <h1 class="post-title">
                                        <a href="{{ route('articleCategory') }}">
                                            {{ $article->title }}
                                        </a>
                                    </h1>
                                    <p class="author">
                                        <img src="{{ asset( 'images/icons/author.png' ) }}" alt="icon-user" />
                                        <span>Author:</span>
                                        <a href="#" rel="author">
                                            {{ $article->user->name }}
                                        </a>
                                    </p>
                                    <p class="date">
                                        <img src="{{ asset( 'images/icons/date.png' ) }}" alt="icon-calendar" />
                                        <span>Date:</span> {{ $article->created_at->format('F d, Y') }}
                                    </p>
                                </div>

                                <div>
                                    <p class="comments">
                                        <img src="{{ asset( 'images/icons/comments.png' ) }}" alt="icon-comment" />
                                        <span>
                                            <a href="#" title="Comment on This is the title of the first article. Enjoy it.">
                                                <span>{{Lang::choice('ru.comments', count($article->comments))}}:</span> {{ count($article->comments) }}
                                            </a>
                                        </span>
                                    </p>
                                </div>

                                <div>
                                    <div class="socials">
                                        <h2>Share on</h2>
                                        <a href="#" class="socials-small facebook-small" title="Facebook" target="_blank" >facebook</a>
                                        <a href="#" class="socials-small twitter-small" title="Twitter" target="_blank" >twitter</a>
                                        <a href="#" class="socials-small google-small" title="Google" target="_blank" >google</a>
                                        <a href="#" class="socials-small pinterest-small" title="Pinterest" target="_blank" >pinterest</a>
                                    </div>
                                </div>
                            </div>

                            <!-- post title -->
                            <div class="the-content span6">
                                <div>
                                    <img style="max-width:100%" src="{{ asset( 'images/articles/' . $article->img->max ) }}" alt="1" />
                                </div>
                            </div>

                            <!-- post content -->
                            <div class="the-content single group span9">
                                {!! $article->text !!}
                            </div>
                        </div>
                    </div>
                </div>

                <!-- START COMMENTS -->
                <div id="comments">
                    <h3 id="comments-title">
                        <span> {{ count($article->comments) }} {{Lang::choice('ru.comments', count($article->comments))}}</span>     
                    </h3>

                    @if( count($article->comments) > 0 )

                        @set($com, $article->comments->groupBy('parent_id'))

                        <ol class="commentlist group">

                            @foreach($com as $k => $comments)
                                @if($k !== 0)
                                    @break
                                @endif

                                @include('article.comment',['items' => $comments])
                            @endforeach

                        </ol>

                    @endif
                    
                    <div class="clear"></div>
                    
                    <div id="respond">
                        <h3 id="reply-title">
                            Leave a <span>Reply</span>
                            <small>
                                <a rel="nofollow" id="cancel-comment-reply-link" href="#" style="display:none;">
                                    Cancel reply
                                </a>
                            </small>
                        </h3>
                        <form action="{{ route('comment.store') }}" method="post" id="commentform">
                            <div class="row">
                                @if ( !Auth::check() )
                                <p class="comment-form-author span3">
                                    <label for="name">Name</label>
                                    <i class="icon-user"></i>
                                    <input id="name" name="name" type="text" value="" size="30" aria-required='true' />
                                </p>

                                <p class="comment-form-email  span3">
                                    <label for="email">Email</label>
                                    <i class="icon-envelope"></i>
                                    <input id="email" name="email" type="text" value="" size="30" aria-required='true' />
                                </p>

                                <p class="comment-form-url  span3">
                                    <label for="website">Website</label>
                                    <i class="icon-globe"></i>
                                    <input id="website" name="website" type="text" value="" size="30" />
                                </p>
                                @endif

                                <p class="comment-form-comment span9">
                                    <label for="text">Your comment</label>
                                    <i class="icon-pencil"></i>
                                    <textarea id="text" name="text" cols="45" rows="8"></textarea>
                                </p>

                                <div class="clear"></div>
                                <div class="span9">
                                    <p class="form-submit">
                                        {{ csrf_field() }}
                                        <input id="comment_post_ID" type="hidden" name="comment_post_ID" value="{{ $article->id }}" />
                                        <input id="comment_parent" type="hidden" name="comment_parent" value="0" />
                                        <input name="submit" type="submit" id="submit" value="Post Comment" />
                                    </p>
                                </div>
                            </div>
                        </form>
                    </div>

                    <!-- #respond -->
                </div>
                <!-- END COMMENTS -->
            </div>
            <!-- END CONTENT -->

            <!-- START SIDEBAR -->
            <div id="sidebar-about" class="span3 sidebar group">
                <div class="widget-2 widget-last widget featured-projects">
                    <h3>Featured Projects</h3>
                    @if ($portfolios)
                    <div class="featured-projects-widget flexslider">
                        <ul class="slides">
                            @foreach($portfolios as $portfolio)
                            <li>
                                <div class="thumb-project">
                                    <a href='{{ route( 'portfolio.show', ['id' => $portfolio->id] ) }}'>
                                        <img width="320" height="154" src="{{ asset( 'images/portfolios/' . $portfolio->img->mini ) }}" class="attachment-featured_project_thumb" alt="001_mini" />
                                    </a>
                                </div>
                                <h4>{{ $portfolio->project }}</h4>
                            </li>
                            @endforeach
                        </ul>
                    </div>
                    @endif

                    <script type="text/javascript">
                        jQuery(document).ready(function ($) {
                            var animation = $.browser.msie || $.browser.opera ? 'fade' : 'slide';
                            $('.featured-projects-widget').flexslider({
                                animation: animation,
                                slideshowSpeed: 8000,
                                animationSpeed: 300,
                                selectors: 'ul > li',
                                directionNav: true,
                                slideshow: true,
                                pauseOnAction: false,
                                controlNav: false,
                                touch: true
                            });
                        });
                    </script>
                </div>
            </div>
            <!-- END SIDEBAR -->
        </div>
    </div>
</div>
