<div class="main-container col2-left-layout">
    <div class="main">
        <div class="col-main"> 
            <!--Category Title-->
            <div class="page-title category-title">
                <h1>Womens</h1>
            </div>
            <!--Category Image-->
            <p class="category-image"><img src="{{ asset('images/women.jpg') }}" alt="Womens" title="Womens"/></p>
                <div class="category-products"> 
                     
                <!--Start toolbar-->
                @if ($products)
                <div class="toolbar">
                    <div class="pager">
                        <div class="limiter">
                            <label>Show</label>
                            {!! Form::select('pager', $pager_select, $pager, [ 'class' => 'form-control pager-select-top'] ) !!}
                        </div>
                    </div>
                    <div class="sorter">
                        <p class="view-mode">
                            <label>View as:</label>
                            <strong title="Grid" class="grid">Grid</strong>&nbsp; <a href="#" title="List" class="list">List</a>&nbsp; </p>
                    </div>
                    <div class="pagination">
                        @if($products->lastPage() > 1) 
                        <div class="pages"> <strong>Page:</strong>
                            <ol>
                                @for($i = 1; $i <= $products->lastPage(); $i++)
                                @if($products->currentPage() == $i)
                                <li class="current">{{ $i }}</li>
                                @else
                                <li><a href="{{ $products->url($i) }}{{ $search or '' }}">{{ $i }}</a></li>
                                @endif		
                                @endfor
                            </ol>
                        </div>
                        @endif
                    </div>

                </div>
                @endif
                <!--End toolbar--> 
                
                @if ($products)
                    @for ($i = 0, $count = count($products); $i < $count; $i++)
                        @if ($i == 0 || (($i % 3) == 0)  )
                        <ul class="products-grid first odd">
                        @endif
                            <li class="item {{ (($i + 1) % 3 != 0) ? 'first' : 'last' }}"> 
                                <a href="{{ route('product.show', ['product'=>$products[$i]->id]) }}" title="{{ $products[$i]->title }}" class="product-image">
                                    <img src="{{ asset('adm/images/products/' . $products[$i]->id . '/' . $products[$i]->img[0]['normal']) }}" alt="{{ $products[$i]->title }}"/>
                                </a>
                                <h2 class="product-name"> <a href="{{ route('product.show', ['product'=>$products[$i]->id]) }}" title="{{ $products[$i]->title }}">{{ $products[$i]->title }}</a> </h2>
                                <div class="price-box"> <span class="regular-price"> <span class="price">${{ $products[$i]->price }}</span> </span> </div>
                                <div class="actions">
                                    <button data-id="{{ $products[$i]->id }}" type="button" title="Add to Cart" class="button btn-cart"><span><span>Add to Cart</span></span></button>
                                    <a href="#" class="fancybox quick_view">quick view</a>
                                    <ul class="add-to-links">
                                        <li><a href="#" class="link-wishlist">Add to Wishlist</a></li>
                                        <li class="last"><a href="#" class="link-compare">Add to Compare</a></li>
                                    </ul>
                                </div>
                            </li>
                        @if (($i + 1) % 3 == 0)
                        </ul>
                        @endif
                    @endfor
                @else
                    <div class="alertbox alert-box">
                        @if ( isset ($category->title) )
                            В категории {{ $category->title }} еще пока нет товаров
                        @else
                            Поиск не дал результатов
                        @endif
                    </div>
                @endif
                
                <!--Start toolbar bottom-->
                @if ($products)
                <div class="toolbar-bottom">
                    <div class="toolbar">
                        <div class="pager">
                            <div class="limiter">
                                <label>Show</label>
                                {!! Form::select('pager', $pager_select, $pager, [ 'class' => 'form-control pager-select-bottom'] ) !!}
                            </div>
                        </div>
                        <div class="sorter">
                            <p class="view-mode">
                                <label>View as:</label>
                                <strong title="Grid" class="grid">Grid</strong>&nbsp; <a href="#" title="List" class="list">List</a>&nbsp; </p>
                        </div>
                        <div class="pagination">
                            @if($products->lastPage() > 1) 
                            <div class="pages"> <strong>Page:</strong>
                                <ol>
                                    @for($i = 1; $i <= $products->lastPage(); $i++)
                                    @if($products->currentPage() == $i)
                                    <li class="current">{{ $i }}</li>
                                    @else
                                    <li><a href="{{ $products->url($i) }}">{{ $i }}</a></li>
                                    @endif		
                                    @endfor
                                </ol>
                            </div>
                            @endif
                        </div>
                    </div>
                </div>
                @endif
                <!--End toolbar bottom--> 
            </div>
        </div>

        <div class="col-left sidebar"> 

            <!--Start Magic Category Block-->
            @if( isset($children) )
            <div class="magicat-container">
                <div class="block">
                    <div class="block-title cat_heading"> 
                        <strong><span> {{ isset($parent) ? $parent->title : ''  }}</span></strong> 
                    </div>
                    <ul id="magicat">
                        @if( $children )
                            @foreach($children as $item)
                            <li class="first level0-inactive level0 {{ (($item->id == $category->parent_id) || ($item->id == $category->id) ) ? 'active' : 'inactive' }}">
                                <span class="magicat-cat"><a href="{{ route('category', ['category'=>$item->id]) }}  "><span>{{ $item->title }}</span></a></span>
                            </li>
                            @endforeach
                        @endif
                    </ul>
                </div>
            </div>
            @endif
            <!--End Magic Category Block--> 

            <!--Start Layered nav-->
            <div class="block block-layered-nav">
                <div class="block-title"> <strong><span>Shop By</span></strong> </div>
                <div class="block-content">
                    <div id="narrow-by-list">
                        <div>
                            <div class="last collapse" id="filter_heading">Price</div>
                            <div class="last odd" id="filter_content">
                                <ul>
                                    <li> <a href="#"><span class="price">$0.00</span> - <span class="price">$1,000.00</span></a> (2) </li>
                                    <li> <a href="#"><span class="price">$2,000.00</span> - <span class="price">$3,000.00</span></a> (9) </li>
                                </ul>
                            </div>
                            <script type="text/javascript">
                                jQuery('#filter_heading').click(function () {
                                    jQuery('#filter_content').slideToggle('slow');
                                    jQuery(this).toggleClass("highlight");
                                });
                            </script> 
                        </div>
                    </div>
                </div>
            </div>
            <!--End Layered nav--> 

            <!--Start Compare Products-->
            <div class="block block-list block-compare">
                <div class="block-title"><strong><span>Compare Products</span></strong> </div>
                <div class="block-content">
                    <p class="empty">You have no items to compare.</p>
                </div>
            </div>
            <!--End Compare Products--> 

            <!--Start Poll-->
            <div class="block block-poll">
                <div class="block-title"> <strong><span>Community Poll</span></strong> </div>
                <form action="">
                    <div class="block-content">
                        <p class="block-subtitle">What is your favorite Magento feature?</p>
                        <ul id="poll-answers">
                            <li class="odd">
                                <input name="vote" class="radio poll_vote" id="vote_5" value="5" type="radio"/>
                                <span class="label">
                                    <label for="vote_5">Layered Navigation</label>
                                </span> </li>
                            <li class="even">
                                <input name="vote" class="radio poll_vote" id="vote_6" value="6" type="radio"/>
                                <span class="label">
                                    <label for="vote_6">Price Rules</label>
                                </span> </li>
                            <li class="odd">
                                <input name="vote" class="radio poll_vote" id="vote_7" value="7" type="radio"/>
                                <span class="label">
                                    <label for="vote_7">Category Management</label>
                                </span> </li>
                            <li class="last even">
                                <input name="vote" class="radio poll_vote" id="vote_8" value="8" type="radio"/>
                                <span class="label">
                                    <label for="vote_8">Compare Products</label>
                                </span> </li>
                        </ul>
                        <div class="actions">
                            <button type="button" title="Vote" class="button"><span><span>Vote</span></span></button>
                        </div>
                    </div>
                </form>
            </div>
            <!--End Poll--> 
        </div>
    </div>
    <div style="display: none;" id="back-top"> <a href="#"><img alt="" src="images/backtop.gif"/></a> </div>
</div>