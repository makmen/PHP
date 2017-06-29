<div class="main-container col2-left-layout">
    <div class="main">
        <div class="col-main">
            <div id="messages_product_view"></div>
            <!--Page Title-->
            <div class="page-title">
                <h1>Корзина</h1>
            </div>
            
            <div class="fieldset">
                <h2 class="legend">Выбранные товары</h2>
                
                @if (session('error_message'))
                    <div class="alertbox error-box">
                        <p>{{ session('error_message') }}</p>
                    </div>
                @endif
                
                @if (session('status'))
                    <div class="alertbox success-box">
                        {{ session('status') }}
                    </div>
                @else
                    <table class="order_table">
                        @if (session('card'))
                        @set($i, 0)
                        <tr class="quantity">
                            <th>Позиция</th>
                            <th>Товар</th>
                            <th>Изображение</th>
                            <th>Цена</th>
                            <th>Количество</th>
                            <th>Общая цена</th>
                            <th>Действие</th>
                        </tr>
                        @foreach(session('card.items') as $k=>$product)
                        <tr id="tr_{{ $k }}">
                            <td>{{ ++$i }}</td>
                            <td>{!! Html::link(route('product.show',['product'=>$k]), $product['title']) !!}</td>
                            <td><img src="{{ asset('adm/images/products/' . $k . '/mini' . $product['img']) }}" alt="image"></td>
                            <td>{{ $product['price'] }}</td>
                            <td>{{ $product['quantity'] }}</td>
                            <td>{{ $product['price'] * $product['quantity'] }}</td>
                            <td>
                                <a href="javascript:void(0)" class="del-product" data-id="{{ $k }}">
                                    <img src="{{ asset('adm/images/del.gif') }}">
                                </a>
                            </td>
                        </tr>
                        @endforeach
                        <tr class="quantity">
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td colspan="2">Всего товаров: {{ session('card.quantity') }}</td>
                        </tr>
                        <tr class="sum">
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td colspan="2">Сумма: {{ session('card.sum') }}</td>
                        </tr>
                        @else
                            <div class="alertbox alert-box">
                                Ваша корзина пуста
                            </div>
                        @endif
                    </table>
                @endif

            </div>

            <!--Start of Contact Form-->
            <form id="order" method="post" action="{{ route('order.store') }}">
                <div class="fieldset">
                    <h2 class="legend">Информация об заказчике</h2>


                    <ul class="form-list">
                        <li class="fields">
                            <div class="field">
                                <label for="name" class="required"><em>*</em>Name</label>
                                <div class="input-box">
                                    <input name="name" id="name" title="Name" class="input-text required-entry {{ ($errors->has('name') ? ' error' : '') }}" type="text" value="{{ old('name') }}" />
                                </div>
                            </div>
                            <div class="field">
                                <label for="email" class="required"><em>*</em>Email</label>
                                <div class="input-box">
                                    <input name="email" id="email" title="Email" class="input-text required-entry validate-email {{ ($errors->has('email') ? ' error' : '') }}" type="text" value="{{ old('email') }}" />
                                </div>
                            </div>
                        </li>
                        <li>
                            <div class="field">
                                <label for="phone" class="required"><em>*</em>Phone</label>
                                <div class="input-box">
                                    <input name="phone" id="phone" title="Phone" class="input-text required-entry {{ ($errors->has('phone') ? ' error' : '') }}" type="text" value="{{ old('phone') }}" />
                                </div>
                            </div>
                            <div class="field">
                                <label for="address" class="required"><em>*</em>Address</label>
                                <div class="input-box">
                                    <input name="address" id="address" title="Address" class="input-text required-entry validate-email {{ ($errors->has('address') ? ' error' : '') }}" type="text" value="{{ old('address') }}" />
                                </div>
                            </div>
                        </li>
                        <li class="wide">
                            <label for="message" class="required"><em>*</em>Message</label>
                            <div class="input-box">
                                <textarea name="message" id="message" title="message" class="required-entry input-text {{ ($errors->has('message') ? ' error' : '') }}" cols="5" rows="3">{{ old('message') }}</textarea>
                            </div>
                        </li>
                    </ul>
                </div>
                <div class="buttons-set">
                    {{ csrf_field() }}
                    <button type="submit" title="Submit" class="button"><span><span>Заказать</span></span></button>
                </div>
            </form>
            <!--End of Contact Form-->  
        </div>
        <div class="col-left sidebar"> 
            <!--Start of Compare Products-->
            <div class="block block-list block-compare">
                <div class="block-title"> <strong><span>Compare Products </span></strong> </div>
                <div class="block-content">
                    <p class="empty">You have no items to compare.</p>
                </div>
            </div>
            <!--Start of Compare Products--> 

            <!--Start of Poll-->
            <div class="block block-poll">
                <div class="block-title"> <strong><span>Community Poll</span></strong> </div>
                <form id="pollForm" method="post" onsubmit="return validatePollAnswerIsSelected();" action="">
                    <div class="block-content">
                        <p class="block-subtitle">What is your favorite Santana feature?</p>
                        <ul id="poll-answers">
                            <li class="odd">
                                <input name="vote" class="radio poll_vote" id="vote_5" value="5" type="radio" />
                                <span class="label">
                                    <label for="vote_5">Layered Navigation</label>
                                </span> </li>
                            <li class="even">
                                <input name="vote" class="radio poll_vote" id="vote_6" value="6" type="radio" />
                                <span class="label">
                                    <label for="vote_6">Price Rules</label>
                                </span> </li>
                            <li class="odd">
                                <input name="vote" class="radio poll_vote" id="vote_7" value="7" type="radio" />
                                <span class="label">
                                    <label for="vote_7">Category Management</label>
                                </span> </li>
                            <li class="last even">
                                <input name="vote" class="radio poll_vote" id="vote_8" value="8" type="radio" />
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
            <!--End of Poll--> 
        </div>
    </div>
    <div style="display: none;" id="back-top"> <a href="#"><img alt="" src="images/backtop.gif" /></a> </div>
</div>