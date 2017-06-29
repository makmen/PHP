<div class="header-container">
    <div class="quick-access"> 
        <!--Start Block Cart-->
        <div class="block block-cart header_cart">
            <div class="block-content_pan">
                <div class="summary trigger-minicart">
                    <h2 class="classy"> 
                        <span class="cart_icon"><img alt="" src="{{ asset('images/shoppingbag.png') }}" /></span>
                        <a href="{{ route('order.index') }}" id="totalquantity">Всего: {{ session('card.quantity', '0') }}</a> 
                    </h2>
                </div>
                <div class="remain_cart" id="minicart">
                    <p class="empty">{{ Session::has('card.quantity') ? 'Удачных покупок' : 'Нет товаров' }}</p>
                    <div class="actions">
                        <p class="subtotal"> <span class="label">Cart Subtotal:</span> <span class="price">${{ session('card.sum', '0') }}</span> </p>
                        <button id="checkout_btn" type="button" title="Checkout" class="button">
                            <span><span>Checkout</span></span>
                        </button>
                    </div>
                </div>
            </div>
        </div>
        <script type="text/javascript">
                
            jQuery("#checkout_btn").click(function () {
                window.location.replace("{{ route('order.index') }}");
            });
            
        </script>
            
        <!--End Block Cart--> 

        <!--Start Toplinks-->
        <ul class="links">
            <li class="first">
                @if( !Auth::check() )
                    <a href="{{ route('login') }}" title="My Account">My Account</a>
                @else
                    <a href="#" title="My Account">{{ Auth::user()->login }}</a>
                @endif
            </li>
            <li><a href="{{ route('order.index') }}" title="Checkout" class="top-link-checkout">Checkout</a></li>
            @if( Auth::check() )
                <li class=" last"><a href="{{ route('logout') }}" title="Log In">Log Out</a></li>
            @endif
        </ul>
        <!--End Toplinks--> 

        <!--Start Language-->
        <div class="form-language"> 
            <div class="language" id="select-language"> 
                <a title="English" class="flag" href="#" style="background: url({{ asset('images/flag_default.gif') }}) no-repeat scroll 0% 0% transparent;">English</a>
                <a title="French" class="flag" href="#" style="background: url({{ asset('images/flag_french.gif') }}) no-repeat scroll 0% 0% transparent;">French</a> 
                <a title="German" class="flag" href="#" style="background: url({{ asset('images/flag_german.gif') }}) no-repeat scroll 0% 0% transparent;">German</a> 
            </div>
        </div>
        <!--End Language--> 


    </div>
    <!--Start Header Content-->
    <div class="header">
        <ul id="logo">
            <!--Left-->
            <li class="head-container"> <span>{</span>
                <h2 class="classy">Free shipping over $9.99</h2>
                <span>}</span>
                <p class="top-welcome-msg">Default welcome msg!</p>
            </li>
            <!--Left--> 
            <!--Center Logo-->
            <li class="logo-box">
                <h1 class="logo">
                    <strong>Santana Commerce</strong>
                    <a href="{{ route('home') }}" title="Santana Commerce" class="logo">
                        <img src="{{ asset('images/logo.png') }}" alt="Santana Commerce" />
                    </a>
                </h1>
            </li>
            <!--Center Logo--> 

            <!--Right-->
            <li class="head-container"> <span>{</span>
                <h2 class="classy">Call us - +1 999 999 9999</h2>
                <span>}</span>
                <div id="search-bar">
                    <div class="top-bar">
                        <form id="search_mini_form" action="{{ route('search') }}"  method="get" >
                            <div class="form-search">
                                <input id="search" name="q" value="Search" class="input-text" type="text" 
                                       onfocus="if (this.value == 'Search') {
                                                   this.value = ''
                                               }
                                               ;" 
                                       onblur="if (this.value == '') {
                                                   this.value = 'Search'
                                               }
                                               ;" />
                                <button type="submit" title="Go" class="button">Go</button>
                            </div>
                        </form>
                    </div>
                </div>
            </li>
            <!--Right-->
        </ul>

        <!--Start of Navigation-->
        @yield('navigation')
        <!--End of Navigation--> 
    </div>
    <!--End Header Content--> 
</div>