<div class="main-container col1-layout">
    <div class="main">
        <div class="col-main">
            <div id="messages_product_view"></div>
            <div class="product-view">
                <div class="product-essential"> 
                    <!--Start Product Information Right-->
                    <div class="product-shop"> 
                        <!--Prev/Next Code Start-->
                        <div class="f-fix mb-10"><a href="{{ route('product.show', ['product'=>$near['prev']->id]) }}" class="prod-prev">PREV</a> <a class="prod-next" href="{{ route('product.show', ['product'=>$near['next']->id]) }}">NEXT</a> </div>
                        <!--Prev/Next Code End--> 
                        <!--Product Title-->
                        <div class="product-name">
                            <h1> {{ $product->title }}</h1>
                        </div>
                        <p class="availability in-stock"><span>In stock</span></p>
                        <div class="price-box"> <span class="regular-price" id="product-price-167"> <span class="price">${{ $product->price }}</span> </span> </div>
                        <div class="pro-left">
                            <div class="short-description">
                                <div class="std">{!! $product->content !!} </div>
                            </div>
                            <div class="review">
                                <p class="no-rating"><a href="#">Be the first to review this product</a></p>
                                <div class="size_guide"><a class="ajax" href="{{ asset('images/size_chart.gif') }}"><span>Click here to watch Size Guide</span> </a></div>
                            </div>
                        </div>
                        <div class="pro-right">
                            <ul class="add-to-links">
                                <li><a href="#" class="link-wishlist">Add to Wishlist</a></li>
                                <li><span class="separator">|</span> <a href="#" class="link-compare">Add to Compare</a></li>
                            </ul>
                            <p class="email-friend"><a href="#">Email to a Friend</a></p>
                            <div class="add-to-box">
                                <div class="add-to-cart">
                                    <label for="qty">Qty:</label>
                                    <input name="qty" id="qty" maxlength="12" value="1" title="Qty" class="input-text qty" type="text" />
                                    <a href="javascript:void(0)" id="reset_btn">Reset</a>
                                    <button  data-id="{{ $product->id }}" type="button" title="Add to Cart" class="button btn-cart"><span><span>Add to Cart</span></span></button>
                                    <div class="add">›</div>
                                    <div class="dec add">‹</div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!--End Product Information Right--> 

                    <!--Start Product Image Zoom Left-->
                    <div class="product-img-box">
                        <p class="product-image product-image-zoom"> 
                            <a href="{{ asset('adm/images/products/' . $product->id . '/' . $product->img[0]['max']) }}"
                               class = "cloud-zoom" id="zoom1" rel="adjustX: 10, adjustY:-4"> 
                                <img style="max-height:400px; width:400px;" src="{{ asset('adm/images/products/' . $product->id . '/' . $product->img[0]['max']) }}" alt='' title="Optional title display" /> 
                            </a> 
                        </p>
                        <div class="more-views">
                            <div class=" jcarousel-skin-tango">
                                <ul id="more_view">
                                    @if($product)
                                        @foreach($product->img as $k => $image)
                                            <li>
                                                <a href='{{ asset('adm/images/products/' . $product->id . '/' . $image['max']) }}' class='cloud-zoom-gallery' title='Photo {{ ($k+1) }}'
                                                   rel="useZoom: 'zoom1', smallImage: '{{ asset('adm/images/products/' . $product->id . '/' . $image['max']) }}' "> 
                                                <img style="max-height:92px; width:92px;" src="{{ asset('adm/images/products/' . $product->id . '/' . $image['mini']) }}" alt = "Photo {{ ($k+1) }}"/>
                                                </a>
                                            </li>
                                        @endforeach
                                    @endif
                                </ul>
                            </div>
                        </div>
                        <script type="text/javascript">
                            jQuery(document).ready(function () {
                                jQuery('#product_tabs_description').click(function () {
                                    jQuery('#product_tabs_description_contents').css('display', 'block');
                                    jQuery('#product_tabs_product').css('display', 'none');
                                    jQuery('#product_tabs_form_contents').css('display', 'none');
                                });
                                jQuery('#product_tabs_product_tag').click(function () {
                                    jQuery('#product_tabs_description_contents').css('display', 'none');
                                    jQuery('#product_tabs_product').css('display', 'block');
                                    jQuery('#product_tabs_form_contents').css('display', 'none');
                                });
                                jQuery('#product_tabs_form').click(function () {
                                    jQuery('#product_tabs_description_contents').css('display', 'none');
                                    jQuery('#product_tabs_product').css('display', 'none');
                                    jQuery('#product_tabs_form_contents').css('display', 'block');
                                });

                            });
                        </script> 
                    </div>
                    <!--End Product Image Zoom Left-->
                    <div class="clearer"></div>
                </div>

                <!--Start Product Tabs-->
                <div class="product-collateral">
                    <ul class="product-tabs">
                        <li id="product_tabs_description" class=" active first"><a href="javascript:void(0)">Product Description</a></li>
                        <li id="product_tabs_product_tag" class=""><a href="javascript:void(0)">Product Tags</a></li>
                        <li id="product_tabs_form" class="last"><a href="javascript:void(0)">Review form</a></li>
                    </ul>
                    <div class="product-tabs-content" id="product_tabs_description_contents">
                        <h2>Details</h2>
                        <div class="std"> 
                            {!! $product->content !!}
                        </div>
                    </div>
                    <div style="display: none;" class="product-tabs-content" id="product_tabs_product">
                        <div class="box-collateral box-tags">
                            <h2>Product Tags</h2>
                            <form id="addTagForm" method="get" action="">
                                <div class="form-add">
                                    <label for="productTagName">Add Your Tags:</label>
                                    <div class="input-box">
                                        <input class="input-text required-entry" name="productTagName" id="productTagName" type="text" />
                                    </div>
                                    <button type="button" title="Add Tags" class="button" onclick="submitTagForm()"> <span> <span>Add Tags</span> </span> </button>
                                </div>
                            </form>
                            <p class="note">Use spaces to separate tags. Use single quotes (') for phrases.</p>
                        </div>
                    </div>
                    <div style="display: none;" class="product-tabs-content" id="product_tabs_form_contents">
                        <div class="form-add">
                            <h2>Write Your Own Review</h2>
                            <form  method="post" id="review-form" action="">
                                <fieldset>
                                    <h3>You're reviewing: <span>Lorem ipsum dolor sit amet,</span></h3>
                                    <h4>How do you rate this product? <em class="required">*</em></h4>
                                    <span id="input-message-box"></span>
                                    <table class="data-table" id="product-review-table">
                                        <thead>
                                            <tr class="first last">
                                                <th>&nbsp;</th>
                                                <th><span class="nobr">1 star</span></th>
                                                <th><span class="nobr">2 stars</span></th>
                                                <th><span class="nobr">3 stars</span></th>
                                                <th><span class="nobr">4 stars</span></th>
                                                <th><span class="nobr">5 stars</span></th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr class="first odd">
                                                <th>Quality</th>
                                                <td class="value"><input name="ratings[1]" id="Quality_1" value="1" class="radio" type="radio" /></td>
                                                <td class="value"><input name="ratings[1]" id="Quality_2" value="2" class="radio" type="radio" /></td>
                                                <td class="value"><input name="ratings[1]" id="Quality_3" value="3" class="radio" type="radio" /></td>
                                                <td class="value"><input name="ratings[1]" id="Quality_4" value="4" class="radio" type="radio" /></td>
                                                <td class="value last"><input name="ratings[1]" id="Quality_5" value="5" class="radio" type="radio" /></td>
                                            </tr>
                                            <tr class="even">
                                                <th>Price</th>
                                                <td class="value"><input name="ratings[3]" id="Price_1" value="11" class="radio" type="radio" /></td>
                                                <td class="value"><input name="ratings[3]" id="Price_2" value="12" class="radio" type="radio" /></td>
                                                <td class="value"><input name="ratings[3]" id="Price_3" value="13" class="radio" type="radio" /></td>
                                                <td class="value"><input name="ratings[3]" id="Price_4" value="14" class="radio" type="radio" /></td>
                                                <td class="value last"><input name="ratings[3]" id="Price_5" value="15" class="radio" type="radio" /></td>
                                            </tr>
                                            <tr class="last odd">
                                                <th>Value</th>
                                                <td class="value"><input name="ratings[2]" id="Value_1" value="6" class="radio" type="radio" /></td>
                                                <td class="value"><input name="ratings[2]" id="Value_2" value="7" class="radio" type="radio" /></td>
                                                <td class="value"><input name="ratings[2]" id="Value_3" value="8" class="radio" type="radio" /></td>
                                                <td class="value"><input name="ratings[2]" id="Value_4" value="9" class="radio" type="radio" /></td>
                                                <td class="value last"><input name="ratings[2]" id="Value_5" value="10" class="radio" type="radio" /></td>
                                            </tr>
                                        </tbody>
                                    </table>
                                    <input name="validate_rating" class="validate-rating" value="" type="hidden" />
                                    <ul class="form-list">
                                        <li>
                                            <label for="nickname_field" class="required"><em>*</em>Nickname</label>
                                            <div class="input-box">
                                                <input name="nickname" id="nickname_field" class="input-text required-entry" type="text" />
                                            </div>
                                        </li>
                                        <li>
                                            <label for="summary_field" class="required"><em>*</em>Summary of Your Review</label>
                                            <div class="input-box">
                                                <input name="title" id="summary_field" class="input-text required-entry" type="text" />
                                            </div>
                                        </li>
                                        <li>
                                            <label for="review_field" class="required"><em>*</em>Review</label>
                                            <div class="input-box">
                                                <textarea name="detail" id="review_field" cols="5" rows="3" class="required-entry"></textarea>
                                            </div>
                                        </li>
                                    </ul>
                                </fieldset>
                                <div class="buttons-set">
                                    <button type="submit" title="Submit Review" class="button"><span><span>Submit Review</span></span></button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
                <!--End Product Tabs--> 
            </div>
        </div>
    </div>
    <div style="display: none;" id="back-top"> <a href="#"><img alt="" src="images/backtop.gif" /></a> </div>
</div>