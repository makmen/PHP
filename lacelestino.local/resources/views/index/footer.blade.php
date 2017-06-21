<div id="footer">
    <div class="container">
        <div class="row">
            <div>
                <div class="widget-first widget span3 recent-posts">
                    <h3>Last articles</h3>
                    <div class="recent-post">
                        @if($footerArticles)
                            @foreach($footerArticles as $article)
                            <div class="post type-post status-publish format-gallery hentry category-web-design group">
                                <div class="date">
                                    <span class="month">{{ $article->created_at->format('M') }}</span>
                                    <span class="day">{{ $article->created_at->format('d') }}</span>
                                </div>
                                <div class="text">
                                    <h3>
                                        <a href="{{ route('article.show',['id' => $article->id]) }}" title="{{ str_limit( $article->title, 50) }}">
                                            {{ str_limit( $article->title, 50) }} ... 
                                        </a>
                                    </h3>
                                    <p>by
                                        <a href="{{ route('article.show',['id' => $article->id]) }}" title="Posts by celestino" rel="author">
                                            {{ $article->user->name }}
                                        </a> -

                                        <a href="blog-detail.html#respond" title="Comment on This is the title of the first article. Enjoy it.">
                                            {{ count($article->comments) }} {{Lang::choice('ru.comments', count($article->comments))}}
                                        </a>
                                    </p>
                                </div>
                            </div>
                            @endforeach
                        @endif
                    </div>
                </div>
                <div class="widget span3 widget_flickrRSS">
                    <h3>Portfolio</h3>
                    @if( $footerPortfolios )
                        @foreach($footerPortfolios as $portfolio)
                            <a title="{{ $portfolio->customer }}" href="{{ route( 'portfolio.show', ['id' => $portfolio->id] ) }}">
                                <img alt="{{ $portfolio->project }}" src="{{ asset( 'images/portfolios/' . $portfolio->img->mini ) }}">
                            </a>
                        @endforeach
                    @endif
                    @if( count($footerPortfolios)  < Config::get( 'settings.footer_portfolios' )   )
                        @for ($i = (count($footerPortfolios)); $i < Config::get( 'settings.footer_portfolios' ); $i++)
                        <a href="#">
                            <img alt="1P4B6832" src="{{ asset( 'images/8756237483_9a8805a3d4_s.jpg') }}">
                        </a>
                        @endfor
                    @endif
                </div>
                <div  class="widget span3 contact-info">
                    <h3>Contacts</h3>
                    <div class="sidebar-nav">
                        <ul>
                            <li>
                                <i class="icon-map-marker" style="color:#000;font-size:12px;width:12px;height:12px"></i>
                                <span>Address:</span> Celestino, 115 Avenue - Italy
                            </li>
                            <li>
                                <i class="icon-phone" style="color:#000;font-size:12px;width:12px;height:12px"></i>
                                <span>Mobile:</span> +39 3471717174
                            </li>
                            <li>
                                <i class="icon-print" style="color:#000;font-size:12px;width:12px;height:12px"></i>
                                <span>Fax:</span> +39 0035 356 765
                            </li>
                            <li>
                                <i class="icon-envelope" style="color:#000;font-size:12px;width:12px;height:12px"></i>
                                <span>Email:</span> celestino@yit.com
                            </li>
                        </ul>
                    </div>
                </div>
                <div id="last-tweets-2" class=" widget span3 last-tweets">
                    <h3>Company</h3>
                    <div class="list-text">
                        Maecenas dignissim mauris id est semper suscipit. 
                        Suspendisse venenatis vestibulum quam, quis porttitor arcu vestibulum et. 
                        Sed porttitor erosut purus elementum a consectetur
                    </div>

                </div>
            </div>
        </div>
    </div>
</div>