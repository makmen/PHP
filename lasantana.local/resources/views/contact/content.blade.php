<div class="main-container col2-left-layout">
    <div class="main">
        <div class="col-main">
            <div id="messages_product_view"></div>
            <!--Page Title-->
            <div class="page-title">
                <h1>Contact Us</h1>
            </div>
            <!--Start of Contact Form-->
            <form id="contactForm" method="post" action="{{ route('contacts') }}">
                <div class="fieldset">
                    <h2 class="legend">Contact Information</h2>

                    @if (session('status'))
                        <div class="alertbox success-box">
                            {{ session('status') }}
                        </div>
                    @endif
                    
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
                            <label for="telephone">Telephone</label>
                            <div class="input-box">
                                <input name="telephone" id="telephone" title="Telephone" class="input-text {{ ($errors->has('telephone') ? ' error' : '') }}" type="text" value="{{ old('telephone') }}" />
                            </div>
                        </li>
                        <li class="wide">
                            <label for="comment" class="required"><em>*</em>Comment</label>
                            <div class="input-box">
                                <textarea name="comment" id="comment" title="Comment" class="required-entry input-text {{ ($errors->has('comment') ? ' error' : '') }}" cols="5" rows="3">{{ old('comment') }}</textarea>
                            </div>
                        </li>
                    </ul>
                </div>
                <div class="buttons-set">
                    <p class="required">* Required Fields</p>
                    <input name="hideit" id="hideit" style="display: none ! important;" type="text" />
                    {{ csrf_field() }}
                    <button type="submit" title="Submit" class="button"><span><span>Submit</span></span></button>
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