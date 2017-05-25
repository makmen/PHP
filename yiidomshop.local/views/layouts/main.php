<?php

use yii\helpers\Html;
use yii\bootstrap\Nav;
use yii\bootstrap\NavBar;
use yii\widgets\Breadcrumbs;
use yii\helpers\Url;
use app\assets\AppAsset;
use app\assets\IeAsset;

AppAsset::register($this);
IeAsset::register($this);

?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">
<head>
    <meta charset="<?= Yii::$app->charset ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <?= Html::csrfMetaTags() ?>
    <title><?= Html::encode($this->title) ?></title>
    <?php $this->head() ?>
</head><!--/head-->

<body>
    <?php $this->beginBody() ?>
    
    <header>
        <div class="menu-top">
            <nav class="navbar navbar-default">
                <div class="container">
                    <!-- Brand and toggle get grouped for better mobile display -->
                    <div class="navbar-header">
                        <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#menu-top" aria-expanded="false">
                            <span class="sr-only">Toggle navigation</span>
                            <span class="icon-bar"></span>
                            <span class="icon-bar"></span>
                            <span class="icon-bar"></span>
                        </button>
                    </div>

                    <!-- Collect the nav links, forms, and other content for toggling -->
                    <div class="collapse navbar-collapse" id="menu-top">
                        <ul class="nav navbar-nav">
                            <li><a href="<?= Url::to(['/site/about']) ?>">О нас</a></li>
                            <li><a href="<?= Url::to(['/site/payment']) ?>">Доставка и оплата</a></li>
                            <li><a href="<?= Url::to(['/site/opt']) ?>">Безнал</a></li>
                            <li><a href="<?= Url::to(['/site/contact']) ?>">Контакты</a></li>
                        </ul>
                        <ul class="nav navbar-nav navbar-right">
                            <?php if (Yii::$app->user->isGuest): ?>
                                <li><a href="<?= Url::to("/admin/") ?>">Войти</a></li>
                            <?php else: ?> 
                                <li><a href="<?= \yii\helpers\Url::to(['/site/logout']) ?>">Выйти</a></li>
                            <?php endif; ?>
                            <li><a href="#" onclick="return getCard()" class="btn-red"><span class="glyphicon glyphicon-shopping-cart"></span>Корзина</a></li>
                        </ul>
                    </div><!-- /.navbar-collapse -->
                </div><!-- /.container-fluid -->
            </nav>
        </div><!-- /.menu-top -->

        <div class="logo">
            <div class="container">
                <div class="row">
                    <div class="col-md-4">
                        <a href="<?= Url::home() ?>">
                            <img src="/images/logo.jpg" alt="logo" >
                        </a>
                    </div>
                    <div class="col-md-3">
                        <div class="wrap-contacts">
                            <ul class="contacts">
                                <li class="velcom"> (+375 29) 264-70-37</li>
                                <li class="mts"> (+375 29) 123-32-34</li>
                                <li class="skype">andrey.by</li>
                                <li class="mail">info@andrey.by</li>
                            </ul> 
                        </div>

                    </div>
                    <div class="col-md-5">
                        <div class="search">
                            <div class="nav navbar-nav navbar-right">
                                <form class="navbar-form navbar-right"  method="get" action="<?= \yii\helpers\Url::to(['/category/search'])?>">
                                    <div class="input-group">
                                        <input type="text" class="form-control" placeholder="Поиск" name="search">
                                        <span class="input-group-btn">
                                            <button type="submit" class="btn btn-default" name="go"><i class="glyphicon glyphicon-search"></i></button>
                                        </span>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </header>

<?php if (Yii::$app->controller->id=='site' || Yii::$app->requestedRoute == '' ):?> 
    <section class="slider">
        <div class="container">
            <div class="row">
                <div class="col-sm-12">
                    <div id="carousel" class="carousel slide" data-ride="carousel">
                        <!-- Indicators -->
                        <ol class="carousel-indicators">
                            <li data-target="#carousel" data-slide-to="0" class="active"></li>
                            <li data-target="#carousel" data-slide-to="1"></li>
                            <li data-target="#carousel" data-slide-to="2"></li>
                        </ol>

                        <!-- Wrapper for slides -->
                        <div class="carousel-inner" role="listbox">
                            <div class="item active">
                                <img src="/images/girl1.jpg" class="img-responsive" alt="" />
                                <div class="carousel-caption">
                                    <h1><span>K</span>domy</h1>
                                    <h2>Free E-Commerce Template</h2>
                                    <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. </p>
                                    <button type="button" class="btn btn-default get">Get it now</button>
                                </div>
                            </div>
                            <div class="item">
                                <img src="/images/girl2.jpg" class="girl img-responsive" alt="" />
                                <div class="carousel-caption">
                                    <h1><span>K</span>domy</h1>
                                    <h2>Free E-Commerce Template</h2>
                                    <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. </p>
                                    <button type="button" class="btn btn-default get">Get it now</button>
                                </div>
                            </div>
                            <div class="item">
                                <img src="/images/girl3.jpg" class="girl img-responsive" alt="" />
                                <div class="carousel-caption">
                                    <h1><span>K</span>domy</h1>
                                    <h2>Free E-Commerce Template</h2>
                                    <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. </p>
                                    <button type="button" class="btn btn-default get">Get it now</button>
                                </div>
                            </div>
                        </div>

                        <!-- Controls -->
                        <a class="left carousel-control" href="#carousel" role="button" data-slide="prev">
                            <span class="glyphicon glyphicon-chevron-left" aria-hidden="true"></span>
                            <span class="sr-only">Previous</span>
                        </a>
                        <a class="right carousel-control" href="#carousel" role="button" data-slide="next">
                            <span class="glyphicon glyphicon-chevron-right" aria-hidden="true"></span>
                            <span class="sr-only">Next</span>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </section><!--/slider-->
<?php endif;?>

    <section class="main-slogan">
        <div class="container">
            <h1>Продаем все</h1>
        </div>
    </section>

    <section class="main-content">
        <div class="container">
            <?php if (!Yii::$app->user->isGuest): ?>
                <div class="row admin-menu">
                    <div class="col-sm-12">
                        <div class="navbar-header">
                            <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
                                <span class="sr-only">Toggle navigation</span>
                                <span class="icon-bar"></span>
                                <span class="icon-bar"></span>
                                <span class="icon-bar"></span>
                            </button>
                        </div>
                        <div class="mainmenu">
                            <ul class="nav navbar-nav collapse navbar-collapse">
                                <li><a href="<?= Url::to("/admin/") ?>" class="active">Заказы</a></li>
                                <li class="dropdown"><a href="#">Категории</a>
                                    <ul role="menu" class="sub-menu">
                                        <li><a href="<?= Url::to(['/admin/category/index']) ?>">Список категорий</a></li>
                                        <li><a href="<?= Url::to(['/admin/category/create']) ?>">Добавить категорию</a></li>
                                    </ul>
                                </li>
                                <li class="dropdown"><a href="#">Товары</a>
                                    <ul role="menu" class="sub-menu">
                                        <li><a href="<?= Url::to(['/admin/product/index']) ?>">Список товаров</a></li>
                                        <li><a href="<?= Url::to(['/admin/product/create']) ?>">Добавить товар</a></li>
                                    </ul>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>  
            <?php endif; ?>
            <?php if (Yii::$app->controller->module->id == 'admin'):?> 
                <div class="row">
                    <div class="col-md-12">
                          <div class="content">
                            <?= $content ?>
                        </div>
                    </div> 
                </div>  
            <?php else: ?>
                <?php if ((Yii::$app->controller->id=='card' && Yii::$app->controller->action->id == 'view') || 
                    (Yii::$app->controller->id=='site'  && Yii::$app->controller->action->id == 'login'))  :?> 
                <div class="row">
                    <div class="col-md-12">
                        <div class="content">
                            <?= $content ?>
                        </div>
                        <div class="recommended_items">
                            <?= \app\components\RecommendItems::widget() ?>
                        </div>
                    </div>
                </div>
                <?php else: ?>
                <div class="row">
                    <div class="col-md-9 col-md-push-3">
                        <div class="content">
                            <?= $content ?>
                        </div>
                        <div class="recommended_items">
                            <?= \app\components\RecommendItems::widget() ?>
                        </div>
                    </div>
                    <div class="col-md-3 col-md-pull-9">
                        <ul id="mainmenu" class="mainmenu">
                            <?= \app\components\Menu::widget() ?>
                        </ul>
                    </div>
                </div>
                <?php endif; ?>
            <?php endif; ?>
 
            </div>
        </div>
    </section>

    <footer>
        <div class="footer-menu">
            <div class="container">
                <div class="row">
                    <div class="col-md-10">
                        <div class="row">
                            <div class="col-md-3 col-xs-6">
                                <h5>Help &amp; Info</h5>
                                <ul>
                                    <li><a href="#">Delivery</a></li>
                                    <li><a href="#">Returns &amp; Refunds</a></li>
                                    <li><a href="#">Contact Us</a></li>
                                    <li><a href="#">Track your Order</a></li>
                                    <li><a href="#">Reglaze Service</a></li>
                                    <li><a href="#">Lens Price Comparison</a></li>
                                    <li><a href="#">A - Z Brands</a></li>
                                    <li><a href="#">FAQ's</a></li>
                                </ul>
                            </div>
                            <div class="col-md-3 col-xs-6">
                                <h5>Brands we sell</h5>
                                <ul>
                                    <li><a href="#">Noosa Amsterdam</a></li>
                                    <li><a href="#">Cream Clothing</a></li>
                                    <li><a href="#">Taschendieb</a></li>
                                    <li><a href="#">Hermes paris</a></li>
                                    <li><a href="#">D&amp;G Fashion</a></li>
                                </ul>
                            </div>
                            <div class="clearfix visible-xs-block visible-sm-block"></div>
                            <div class="col-md-3 col-xs-6">
                                <h5>Care &amp; advice</h5>
                                <ul>
                                    <li><a href="#">Prescription Information</a></li>
                                    <li><a href="#">Lenses &amp; Coatings</a></li>
                                    <li><a href="#">PD Measurement</a></li>
                                    <li><a href="#">Style Advice</a></li>
                                    <li><a href="#">Size Guide</a></li>
                                    <li><a href="#">Shopping Guide</a></li>
                                </ul>
                            </div>
                            <div class="col-md-3 col-xs-6">
                                <h5>Company</h5>
                                <ul>
                                    <li><a href="#">About Us</a></li>
                                    <li><a href="#">Our Store</a></li>
                                    <li><a href="#">Terms &amp; Conditions</a></li>
                                    <li><a href="#">Privacy Policy</a></li>
                                    <li><a href="#">Cookies</a></li>
                                    <li><a href="#">Find us</a></li>
                                </ul>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-2">
                        <h5>Follow us</h5>
                        <div class="social-icons">
                            <a href="#"><img src="/images/fb.jpg" alt=""></a>
                            <a href="#"><img src="/images/tw.jpg" alt=""></a>
                            <a href="#"><img src="/images/fl.jpg" alt=""></a>
                        </div>
                    </div>
                </div>
            </div>
        </div><!-- .footer-menu -->

        <div class="footer-copyright">
            <div class="container">
                <div class="row">
                    <div class="col-md-4">
                        <p>&copy; 2014 Fashion Store. All Rights Reserved.</p>
                    </div>
                    <div class="col-md-8 text-right pay">
                        <a href="#"><img src="/images/pay1.jpg" alt=""></a>
                        <a href="#"><img src="/images/pay2.jpg" alt=""></a>
                        <a href="#"><img src="/images/pay3.jpg" alt=""></a>
                        <a href="#"><img src="/images/pay4.jpg" alt=""></a>
                        <a href="#"><img src="/images/pay5.jpg" alt=""></a>
                        <a href="#"><img src="/images/pay6.jpg" alt=""></a>
                        <a href="#"><img src="/images/pay7.jpg" alt=""></a>
                        <a href="#"><img src="/images/pay8.jpg" alt=""></a>
                    </div>
                </div>
            </div>
        </div><!-- /.footer-copyright -->
    </footer>
    
<?php
\yii\bootstrap\Modal::begin([
    'header' => '<h2>Корзина</h2>',
    'id' => 'card',
    'size' => 'modal-lg',
    'footer' => '<button type="button" class="btn btn-default" data-dismiss="modal">Продолжить покупки</button>
        <a href="' . \yii\helpers\Url::to(['card/view']) . '" class="btn btn-success">Оформить заказ</a>
        <button type="button" class="btn btn-danger" onclick="clearCart()">Очистить корзину</button>'
]);

\yii\bootstrap\Modal::end();
?>
    
<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>