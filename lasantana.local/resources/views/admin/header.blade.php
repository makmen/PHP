<div class="container portfolio_title"> 

    <!-- Title -->
    <div class="section-title">
        <h2>{{$title}}</h2>
    </div>
    <!--/Title --> 

</div>
  <!-- Container -->

<div class="portfolio">

    <div id="filters" class="sixteen columns">
        <ul style="padding:0px 0px 0px 0px">
            <li><a href="{{ route('orders.index') }}">
                    <h5>Заказы</h5>
                </a>
            </li>
            
            <li><a  href="{{ route('categories.index') }}">
                    <h5>Категории</h5>
                </a>
            </li>

            <li><a  href="{{ route('products.index') }}">
                    <h5>Товары</h5>
                </a>
            </li>

            <li><a href="{{ route('editUser') }}">
                    <h5>Данные пользователя</h5>
                </a>
            </li>
        </ul>
    </div>

</div>	
