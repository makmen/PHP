<div class="special">
    <div style="visibility: visible;" id="mix_container" class="mix_container">
        <h1 class="category_page_title"> New Products</h1>
        <div class="mix_nav"> <span id="mix_prev" class="mix_prev">Previous</span> <span id="mix_next" class="mix_next">Next</span> </div>
        <div id="container" class="mix_wrapper">
            <ul style="position: relative;" class="mix_gallery">
                
                @for ($i = 0, $count = count($newProducts); $i < $count; $i++)
                <li class="item mix_row {{ (($i + 1) % 3 != 0) ? '' : 'last' }}">
                    <div class="outer box"> 
                        
                        <a href="#" class="product-image">
                            <img src="{{ asset('adm/images/products/' . $newProducts[$i]->id . '/' . $newProducts[$i]->img[0]['normal']) }}" alt="{{ $newProducts[$i]->title }}" />
                        </a>
                        <div class="ic_caption">
                            <h2 class="product-name"><a href="{{ route('product.show', ['product'=>$newProducts[$i]->id]) }}" title="Imperdiet id tincidunt ">{{ $newProducts[$i]->title }}</a></h2>
                            <div class="actions">
                                <button style="display:none;" type="button" title="Add to Cart" class="button btn-cart"> <span> <span>Add to Cart</span> </span> </button>
                                <a rel="example_group" data-id="{{ $newProducts[$i]->id }}" href="javascript:void(0)" class="fancybox quickllook btn-cart" id="fancybox170">Add to Cart</a>
                                <div class="price-box"> <span class="regular-price"> <span class="price">${{ $newProducts[$i]->price }}</span> </span> </div>
                            </div>
                        </div>
                    </div>
                </li>
                @endfor

            </ul>
        </div>
    </div>
</div>
