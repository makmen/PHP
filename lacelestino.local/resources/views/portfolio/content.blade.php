<!-- START PRIMARY -->
<div id="primary" class="sidebar-no">
    <div class="container group">
        <div class="row">
            <!-- START CONTENT -->
            <div id="content-page" class="span12 content group">
                <div class="page type-page status-publish hentry group">

                    <script>
                        jQuery(document).ready(function ($) {
                            $('.sidebar').remove();

                            if (!$('#primary').hasClass('sidebar-no')) {
                                $('#primary').removeClass().addClass('sidebar-no');
                                $('.content').removeClass('span9').addClass('span12');
                            }

                        });
                    </script>

                    <div class="row">
                        <ul id="portfolio" class="columns thumbnails">
                            @if($portfolios)
                            
                            @foreach($portfolios as $k => $portfolio)
                                <li  class="slide-{{ ($k + 1) }} work span6 {{ (!$k || ($k % 2 == 0)) ? 'first' : '' }}">

                                    <div class="picture_overlay">
                                        <img width="560" height="324" src="{{ asset( 'images/portfolios/' . $portfolio->img->max ) }}" class="attachment-thumb_portfolio_2cols" alt="001" />

                                        <div class="overlay">
                                            <div>
                                                <p>
                                                    <a href="{{ asset( 'images/portfolios') . '/' . $portfolio->img->path  }}" rel="lightbox" class="ch-info-lightbox">
                                                        <img src="{{ asset( 'images/icons/zoom.png' ) }}" alt="Open Lightbox" />
                                                    </a>
                                                    <a href="{{ route( 'portfolio.show', ['id' => $portfolio->id] ) }}"> 
                                                        <img src="{{ asset( 'images/icons/project.png' ) }}" alt="" />
                                                    </a>
                                                </p>
                                                <p class="title"> {{ $portfolio->project }} </p>
                                                <p class="subtitle"> {{ $portfolio->customer }} </p>
                                            </div>
                                        </div>
                                        
                                    </div>

                                    <p>{{ str_limit( strip_tags($portfolio->text) , 200) }} [...] </p>
                                    <a class='read-more' href='{{ route( 'portfolio.show', ['id' => $portfolio->id] ) }}'>View Project</a>                        
                                
                                </li>
                            @endforeach
                            
                            @endif
                        </ul>
                        <div class='general-pagination group'>
                            @if($portfolios->lastPage() > 1) 
                                @if($portfolios->currentPage() !== 1)
                                <a href="{{ $portfolios->url(($portfolios->currentPage() - 1)) }}">{{ Lang::get('pagination.previous') }}</a>
                                @endif

                                @for($i = 1; $i <= $portfolios->lastPage(); $i++)
                                    @if($portfolios->currentPage() == $i)
                                    <a class="selected disabled">{{ $i }}</a>
                                    @else
                                    <a href="{{ $portfolios->url($i) }}">{{ $i }}</a>
                                    @endif		
                                @endfor

                                @if($portfolios->currentPage() !== $portfolios->lastPage())
                                <a href="{{ $portfolios->url(($portfolios->currentPage() + 1)) }}">{{ Lang::get('pagination.next') }}</a>
                                @endif
                            @endif
                        </div>
                    </div>

                </div>
                <!-- START COMMENTS -->
                <div id="comments">
                </div>
                <!-- END COMMENTS -->
            </div>
            <!-- END CONTENT -->



            <!-- START EXTRA CONTENT -->
            <!-- END EXTRA CONTENT -->
        </div>
    </div>
</div>
<!-- END PRIMARY -->

