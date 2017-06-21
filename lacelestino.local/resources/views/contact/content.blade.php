<div id="primary" class="sidebar-right">
    <div class="container group">
        <div class="row">
            <!-- START CONTENT -->
            <div id="content-page" class="span9 content group">
                <div class="page type-page status-publish hentry group">
                    <h3>Contact me</h3>
                    <p>&nbsp;</p>
                    <form id="contact-form-contact-form" class="contact-form row" method="post" action="{{ route('contacts') }}" enctype="multipart/form-data">

                        <div class="usermessagea"></div>
                        <fieldset>
                            <ul>
                                <li class="text-field span3">
                                    <label for="name-contact-form">
                                        <span class="mainlabel">Name</span>
                                    </label>
                                    <div class="input-prepend">
                                        <span class="add-on">
                                            <i class="icon-user"></i>
                                        </span>
                                        <input type="text" name="name" id="name-contact-form" class="required {{ ($errors->has('name') ? ' error' : '') }}" value="{{ old('name') }}" />

                                    </div>
                                    <div class="msg-error"></div>
                                    <div class="clear"></div>
                                </li>

                                <li class="text-field span3">
                                    <label for="email-contact-form">
                                        <span class="mainlabel">Email</span>
                                    </label>
                                    <div class="input-prepend">
                                        <span class="add-on">
                                            <i class="icon-envelope"></i>
                                        </span>
                                        <input type="text" name="email" id="email-contact-form" class="required email-validate {{ ($errors->has('email') ? ' error' : '') }}" value="{{ old('email') }}" />
                                    </div>

                                    <div class="msg-error"></div>
                                    <div class="clear"></div>
                                </li>

                                <li class="text-field span3">
                                    <label for="phone-contact-form">
                                        <span class="mainlabel">Phone</span>
                                    </label>
                                    <div class="input-prepend">
                                        <span class="add-on">
                                            <i class="icon-phone"></i>
                                        </span>
                                        <input type="text" name="phone" id="phone-contact-form" class="" value="{{ old('phone') }}" />
                                    </div>

                                    <div class="msg-error"></div>
                                    <div class="clear"></div>
                                </li>

                                <li class="textarea-field span9">
                                    <label for="message-contact-form">
                                        <span class="mainlabel">Message</span>
                                    </label>
                                    <div class="input-prepend">
                                        <span class="add-on">
                                            <i class="icon-pencil"></i>
                                        </span>
                                        <textarea name="message" id="message-contact-form" rows="8" cols="30" class="required {{ ($errors->has('message') ? ' error' : '') }}">{{ old('message') }}</textarea>
                                    </div>
                                    <div class="msg-error"></div>
                                    <div class="clear"></div>
                                </li>

                                <li class="submit-button span9">
                                    {{ csrf_field() }}
                                    <input type="submit" name="yit_sendemail" value="Send Message" class="sendmail alignright" />
                                    <div class="clear"></div>
                                </li>
                            </ul>
                        </fieldset>
                    </form>

                </div>

                <!-- START COMMENTS -->
                <div id="comments"></div>
                <!-- END COMMENTS -->
            </div>
            <!-- END CONTENT -->

            <!-- START SIDEBAR -->
            <div id="sidebar-contact" class="span3 sidebar group">
                <div id="contact-info-2" class="widget-first widget contact-info">
                    <h3>Contact info</h3>
                    <div class="sidebar-nav">
                        <ul>
                            <li>
                                <i class="icon-map-marker" style="color:#000;font-size:12px;width:12px;height:12px"></i>
                                <span>Address:</span> Celestino, 115 Avenue - Italy
                            </li>

                            <li>
                                <i class="icon-phone" style="color:#000;font-size:12px;width:12px;height:12px"></i>
                                <span>Phone:</span> +00 39 71717174
                            </li>

                            <li>
                                <i class="icon-print" style="color:#000;font-size:12px;width:12px;height:12px"></i>
                                <span>Fax:</span> +39 0035 356 765
                            </li>

                            <li>
                                <i class="icon-envelope" style="color:#000;font-size:12px;width:12px;height:12px"></i>
                                <span>Email:</span> pinkrio@yit.com
                            </li>
                        </ul>
                    </div>
                </div>
                <div id="text-2" class="widget-2 widget-last widget widget_text">
                    <h3>I&#8217;m social</h3>
                    <div class="textwidget">Praesent ultricies iaculis erat iaculis feugiat. Sed suscipit tempor felis, sit amet aliquam nunc sollicitudin sed.
                        <br /><br />

                        <a href="# " class="socials-small facebook-small" title="Facebook"  >facebook</a>

                        <a href="#" class="socials-small rss-small" title="Rss"  >rss</a>

                        <a href="#" class="socials-small twitter-small" title="Twitter"  >twitter</a>

                        <a href="#" class="socials-small google-small" title="Google"  >google</a>

                        <a href="#" class="socials-small linkedin-small" title="Linkedin"  >linkedin</a>

                        <a href="#" class="socials-small pinterest-small" title="Pinterest"  >pinterest</a></div>
                </div>
            </div>
            <!-- END SIDEBAR -->

            <!-- START EXTRA CONTENT -->
            <!-- END EXTRA CONTENT -->

        </div>
    </div>
</div>
<!-- END PRIMARY -->