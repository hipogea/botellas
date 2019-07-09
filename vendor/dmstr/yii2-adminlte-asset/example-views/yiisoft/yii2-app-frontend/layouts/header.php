<?php
use yii\helpers\Html;
use yii\helpers\Url;
use common\helpers\h;
/* @var $this \yii\web\View */
/* @var $content string */
?>

<header class="main-header">
  
<!-- Script -->
<?php 
 //var_dump(yii::$app->user);die();
 $image=Html::img('@web/img/logo_svg.svg', ['alt' => 'Logo','width'=>40,'height'=>30]); ?>  
    <?= Html::a('<span class="logo-mini">APP</span><span class="logo-lg"> '.$image . Yii::$app->name . '</span>', Yii::$app->homeUrl, ['class' => 'logo']) ?>

    <nav class="navbar navbar-static-top" role="navigation">
        <a href="#" class="sidebar-toggle" data-toggle="push-menu" role="button">
            <span class="sr-only">Toggle navigation</span>
        </a>

        <div class="navbar-custom-menu">

            <ul class="nav navbar-nav">

              
             <?php require('notificaciones.php');   ?>
             <?php require('tasks.php');   ?>
              <?php require('historial.php');   ?>
                <!-- User Account: style can be found in dropdown.less -->

                <li class="dropdown user user-menu">
                    <a href="#" class="linkajustado" data-toggle="dropdown">
                        <i class="fa fa-user" aria-hidden="true"></i><?php  echo h::userName() /* \frontend\widgets\userwidget\userWidget::widget(['size'=>30,'longName'=>true])*/  ?>
                    </a>
                    <ul class="dropdown-menu">
                        <!-- User image -->
                        <li class="user-header">
                            <?= \frontend\widgets\userwidget\userWidget::widget(['size'=>100,
                                'orientacion'=>'vertical','longName'=>true])  ?>
                        </li>
                        <!-- Menu Body -->
                       
                        <!-- Menu Footer-->
                        <li class="user-footer">
                            <div class="pull-left">
                                <?= Html::a(
                                    yii::t('base.forms','Profile'),
                                    ['/site/profile'],
                                    ['class' => 'btn btn-default btn-flat']
                                ) ?>
                                
                            </div>
                            <div class="pull-left">


                                <?= Html::button('Add Favorite', ['href' => Url::to(['site/addfavorite']), 'title' => 'Add this page to Favorites...', 'class' => 'botonAbre btn btn-success']); ?>
                            </div>
                            <div class="pull-right">
                                <?= Html::a(
                                    'Sign out',
                                    ['/site/logout'],
                                    ['data-method' => 'post', 'class' => 'btn btn-default btn-flat']
                                ) ?>
                            </div>
                        </li>
                    </ul>
                </li>
                   
                 
                
                
                
    
            </ul>
            
            
        </div>
    </nav>
</header>
