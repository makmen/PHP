<?php

/* @var $this \yii\web\View */
/* @var $content string */

use yii\helpers\Html;
use yii\helpers\Url;
use yii\bootstrap\ActiveForm;
use app\assets\AppAsset;

AppAsset::register($this);

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
</head>
<body>
    
<?php $this->beginBody() ?>

<div class="line">
    <div class="block_top_text">
        <p>Number one in business</p>
    </div>
    
    <div class="block_top_lnks">
       
        <?php if (Yii::$app->user->isGuest) : ?>
            <?php $formLogin = ActiveForm::begin([
                'action'=>'/login',
                'enableClientValidation' => false
            ]); ?>
            <?php $model = new app\models\LoginForm(); ?>
            <ul>
                <li>
                    <?= $formLogin->field($model, 'login')->textInput(['autofocus' => true, 'class' => 'w_focus']) ?>
                </li>
                <li>
                    <?= $formLogin->field($model, 'password')->passwordInput( ['class' => 'w_focus'] ) ?>
                </li>
                <li>
                    <p>&nbsp;</p>
                    <?= Html::submitButton('Войти', ['class' => 'btn btn-default', 'name' => 'login', 'id' => 'singin']) ?>
                </li>
            </ul>
            <?php ActiveForm::end(); ?>
            <div class="clr"></div>
            <p class="loginerror">&nbsp;
                <?php if (isset( $_SESSION['loginerror'] )) : ?>
                    <span>Не верный логин или пароль</span>
                    <?php unset( $_SESSION['loginerror'] ); ?>
                <?php endif; ?> 
            </p>
        <?php else: ?>
            <div class='greetings'>
                <p>Добрый день, <?= Yii::$app->user->identity['login']?>
                    <span class="signout"><a href="/logout">Выход</a></span>
                </p>
            </div>
        <?php endif; ?>
    </div>
    <div class="clr"></div>
</div>
<div class="main">
    <?php if (Yii::$app->user->isGuest) : ?>
        <div class="register_links">
            <a href="/user/">Регистрация</a>
            &nbsp;&nbsp;&nbsp;
            <a href="/user/forget">Забыли пароль</a>
        </div>
    <?php endif; ?>
  <div class="header">
    <div class="logo">
      <h1><a href="/"><span>biz</span> solution<small>Simple web template</small></a></h1>
    </div>
    <div class="menu_nav">
      <ul>
        <li <?php if ( Yii::$app->controller->id=='site' && Yii::$app->controller->action->id == 'index' ):?>class="active"<?php endif; ?> ><a href="<?= Url::home() ?>">Главная</a></li>
        <li <?php if ( Yii::$app->controller->id=='site' && Yii::$app->controller->action->id == 'support' ):?> class="active"<?php endif; ?> ><a  href="<?= Url::to(['/support']) ?>">Поддержка</a></li>
        <li <?php if ( Yii::$app->controller->id=='site' && Yii::$app->controller->action->id == 'about' ):?> class="active"<?php endif; ?> ><a href="<?= Url::to(['/about']) ?>">О нас</a></li>
        <li <?php if ( Yii::$app->controller->id=='site' && Yii::$app->controller->action->id == 'contact' ):?> class="active"<?php endif; ?> ><a href="<?= Url::to(['/contact']) ?>">Контакты</a></li>
      </ul>
      <div class="clr"></div>
    </div>
    <div class="clr"></div>
    <div class="hbg">
      <img src="/images/header_images.jpg" width="653" height="271" alt="header images" />
      <div class="text">
        <h3>Creating Futures</h3>
      </div>
    </div>
  </div>
  <div class="content">
    <div class="content_bg">
      <div class="mainbar">
          <?= $content ?>
      </div>
      <div class="sidebar">
        <div class="gadget">
          <div class="search">
            <form method="get" id="search" action="">
              <span>
              <input type="text" value="Search..." name="s" id="s" />
              <input name="searchsubmit" type="image" src="/images/search.gif" value="Go" id="searchsubmit" class="btn"  />
              </span>
            </form>
            <!--/searchform -->
            <div class="clr"></div>
          </div>
          <div class="clr"></div>
        </div>
        <?php if (!Yii::$app->user->isGuest) : ?>
            <div class="gadget">
              <h2><span>Меню</span> пользователя</h2>
              <div class="clr"></div>
              <ul class="sb_menu">
                <li><a href="/file/">Мои файлы</a></li>
                <li><a href="/file/load">Загрузить файлы</a></li>
                <li><a href="/user/edit">Мой профиль</a></li>
                <li><a href="/user/change">Изменить пароль</a></li>
                <li><a href="/logout">Выход</a></li>
              </ul>
            </div>
        <?php endif; ?>

        <div class="gadget">
          <h2><span>Sponsors</span></h2>
          <div class="clr"></div>
          <ul class="ex_menu">
            <li class="active"><a href="http://www.dreamtemplate.com" title="Website Templates">DreamTemplate</a> <span>Over 6,000+ Premium Web Templates</span></li>
            <li><a href="http://www.templatesold.com" title="WordPress Themes">TemplateSOLD</a> <span>Premium WordPress &amp; Joomla Themes</span></li>
            <li><a href="http://www.imhosted.com" title="Affordable Hosting">ImHosted.com</a> <span>Affordable Web Hosting Provider</span></li>
            <li><a href="http://www.dreamstock.com/">DreamStock</a> <span>Unlimited Amazing Stock Photos</span></li>
            <li><a href="http://www.evrsoft.com" title="Website Builder">Evrsoft</a> <span>Website Builder Software &amp; Tools</span></li>
            <li><a href="http://www.csshub.com/" title="CSS Templates">CSS Hub</a> <span>Premium CSS Templates</span></li>
          </ul>
        </div>
        <div class="gadget">
          <h2 class="grey"><span>Wise Words</span></h2>
          <div class="clr"></div>
          <div class="testi">
            <p><span class="q">ret</span> We can let circumstances rule us, or we can take charge and rule our lives from within. <span class="q">кен</span></p>
            <p class="title"><strong>Earl Nightingale</strong></p>
          </div>
        </div>
      </div>
      <div class="clr"></div>
    </div>
  </div>
  <div class="fbg">
    <div class="col c1">
      <h2><span>Image Gallery</span></h2>
      <a href="#"><img src="/images/pic_1.jpg" width="58" height="58" alt="pix" /></a> <a href="#"><img src="/images/pic_2.jpg" width="58" height="58" alt="pix" /></a> <a href="#"><img src="/images/pic_3.jpg" width="58" height="58" alt="pix" /></a> <a href="#"><img src="/images/pic_4.jpg" width="58" height="58" alt="pix" /></a> <a href="#"><img src="/images/pic_5.jpg" width="58" height="58" alt="pix" /></a> <a href="#"><img src="/images/pic_6.jpg" width="58" height="58" alt="pix" /></a> </div>
    <div class="col c2">
      <h2><span>Lorem Ipsum</span></h2>
      <p>Lorem ipsum dolor<br />
        Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Donec libero. Suspendisse bibendum. Cras id urna. <a href="#">Morbi tincidunt, orci ac convallis aliquam</a>, lectus turpis varius lorem, eu posuere nunc justo tempus leo. Donec mattis, purus nec placerat bibendum, dui pede condimentum odio, ac blandit ante orci ut diam.</p>
    </div>
    <div class="col c3">
      <h2><span>About</span></h2>
      <p>Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Donec libero. Suspendisse bibendum. Cras id urna. Morbi tincidunt, orci ac convallis aliquam, lectus turpis varius lorem, eu posuere nunc justo tempus leo. llorem, eu posuere nunc justo tempus leo. Donec mattis, purus nec placerat bibendum. <a href="#">Learn more...</a></p>
    </div>
    <div class="clr"></div>
  </div>
  <div class="footer">
    <div class="footer_resize">
      <p class="lf">© Copyright <a href="#">MyWebSite</a>.</p>
      <p class="rf">Layout by Cool <a href="http://www.coolwebtemplates.net/">Website Templates</a></p>
     
      <div class="clr"></div>
    </div>
  </div>
</div>

<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>
