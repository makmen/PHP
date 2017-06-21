<!-- START CONTENT -->
<div id="content-page" class="span12 content group">

    <div class="clear"></div>
    <div class="posts">

        <div class="hentry-post group portfolio-post internal-post">

            <div id="portfolio" class="portfolio-full-description">
                <div class="portfolios type-portfolios status-publish hentry work group row">
                    <div class="work-thumbnail span6">
                        <div class="thumb-wrapper">
                            <div class="work-thumbnail">
                                <div class="picture_overlay_empty picture_overlay">
                                    <img width="574" height="340" src="{{ asset( '/images/portfolios' ) . '/' .  $portfolio->img->max }}" class="attachment-thumb_portfolio_fulldesc" alt="004" />
                                </div>
                            </div>

                            <script>
                                jQuery(document).ready(function ($) {
                                    jQuery(".work-thumbnail .overlay a.lightbox_fulldesc").colorbox({
                                        transition: 'elastic',
                                        rel: 'lightbox_fulldesc',
                                        fixed: true,
                                        maxWidth: '80%',
                                        maxHeight: '80%',
                                        opacity: 0.7
                                    });
                                });
                            </script>
                        </div>
                    </div>

                    <div class="work-description span6">
                        <h3> {{ $portfolio->project }}</h3>
                        {!! $portfolio->text !!}
                        <div></div>

                        <div class="work-skillsdate span6">

                            <p class="categories paragraph-links">
                                <span class="meta-label">Project:</span> {{ $portfolio->project }}
                            </p>

                            <p class="customer">
                                <span class="meta-label">Customer:</span> {{ $portfolio->customer }}
                            </p>

                            <p class="workdate">
                                <span class="meta-label">Year:</span> {{ $portfolio->created_at->format('Y') }}
                            </p>
                        </div>
                    </div>
                    <div class="clear"></div>
                </div>

                <div class="clear"></div>

                <h3>Other Projects</h3>

                <div class="portfolio-full-description-related-projects row">
                    @if($otherProjects)
                        @foreach($otherProjects as $item)
                        <div class="related_project span3">
                            <div class="related_img">
                                <div class="picture_overlay">
                                    <img width="258" height="170" src="{{ asset( 'images/portfolios/' . $item->img->max ) }}" class="attachment-thumb_portfolio_fulldesc_related" alt="001" />
                                    <div class="overlay">
                                        <div>
                                            <p>
                                                <a href="{{ asset( 'images/portfolios') . '/' . $item->img->path  }}" rel="lightbox" class="ch-info-lightbox">
                                                    <img src="{{ asset( 'images/icons/zoom.png' ) }}" alt="Open Lightbox" />
                                                </a>
                                                <a href="{{ route( 'portfolio.show', ['id' => $item->id] ) }}"> 
                                                    <img src="{{ asset( 'images/icons/project.png' ) }}" alt="" />
                                                </a>
                                            </p>
                                            <p class="title">{{ $item->project }}</p>
                                            <p class="subtitle">{{ $item->customer }}</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        @endforeach
                    @endif

                </div>
            </div>
            <div class="clear"></div>
        </div>

    </div>
</div>
<div class="clear"></div>
<!-- END CONTENT -->