<?php if (!defined('__TYPECHO_ROOT_DIR__')) exit; ?>
<!DOCTYPE HTML>
<html class="no-js">
<head>


<?php $hitokoto = file_get_contents('https://inwao.com/hitokoto/'); ?>
    <meta name="applicable-device" content="pc,mobile">
    <meta http-equiv="Cache-Control" content="no-transform" />
    <meta http-equiv="Cache-Control" content="no-siteapp" />
    <meta charset="<?php $this->options->charset(); ?>">
    <meta http-equiv="X-UA-Compatible" content="IE=edge, chrome=1">
    <meta name="renderer" content="webkit">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
    <title><?php $this->archiveTitle(array(
            'category'  =>  _t('分类 %s 下的文章'),
            'search'    =>  _t('包含关键字 %s 的文章'),
            'tag'       =>  _t('标签 %s 下的文章'),
            'author'    =>  _t('%s 发布的文章')
        ), '', ' - '); ?><?php $this->options->title(); ?></title>

    <!-- 使用url函数转换相关路径 -->
    <link rel="stylesheet" href="<?php $this->options->themeUrl('grid.css'); ?>">
    <link rel="stylesheet" href="<?php $this->options->themeUrl('style.css'); ?>">
    
    <!--[if lt IE 9]>
    <script src="/usr/themes/Writing/js/html5.min.js"></script>
    <script src="/usr/themes/Writing/js/respond.min.js"></script>
    <![endif]-->

    <!-- 通过自有函数输出HTML头部信息 -->
    <?php $this->header('description=&generator=&template=&pingback=&xmlrpc=&wlw=&rss1=&rss2=&atom='); ?>
<link rel="shortcut icon" href="/favicon.ico" type="image/x-icon" />

<script src="/usr/themes/Writing/js/2.1.4/jquery.min.js"></script>
<script src="/usr/themes/Writing/js/2.0.1/jquery.pjax.min.js"></script>
<script src="<?php $this->options->themeUrl('ajax.js'); ?>"></script>
<script src="<?php $this->options->themeUrl('ajax_fy.js'); ?>"></script>





</head>
<body>


<!--[if lt IE 9]>
    <div class="browsehappy" role="dialog"><?php _e('<strong> 为了更好的体验，请使用现代浏览器访问. </strong>'); ?></div>
<![endif]-->



<header id="header" class="clearfix">
    <div class="container">
        <div class="row">
            <div class="site-name col-mb-12 col-9">
                <a id="logo" href="<?php $this->options->siteUrl(); ?>">
                    <?php if ($this->options->logoUrl): ?>
                    <img src="/usr/themes/default/logo.png" alt="" />
                    <?php endif; ?>
                    
                </a>
        	    <p class="description"><?php $this->options->description() ?></p>
            </div>
            <div class="site-search col-3 kit-hidden-tb">
                <form id="search" method="post" action="./" role="search">
                    <label for="s" class="sr-only"><?php _e('搜索关键字'); ?></label>
                    <input type="text" name="s" class="text" placeholder="<?php _e('输入关键字搜索'); ?>" />
                    <button type="submit" class="submit"><?php _e('搜索'); ?></button>
                </form>
            </div>
            <div class="col-mb-12">
                <nav id="nav-menu" class="clearfix" role="navigation">
<div style="text-indent: 1.5em"><?php echo $hitokoto; ?></div>
                    <a<?php if($this->is('index')): ?> class="current"<?php endif; ?> href="<?php $this->options->siteUrl(); ?>"><?php _e('首页'); ?></a>
                    <?php $this->widget('Widget_Contents_Page_List')->to($pages); ?>
                    <?php while($pages->next()): ?>
                    <a<?php if($this->is('page', $pages->slug)): ?> class="current"<?php endif; ?> href="<?php $pages->permalink(); ?>" title="<?php $pages->title(); ?>"><?php $pages->title(); ?></a>
                    <?php endwhile; ?>
              
                </nav>
  
            </div>
        </div><!-- end .row -->
    </div>

<meta name="keywords" content="typecho,vps,blog,Shadowsocks,it,life,inwao,free,web,movie" />
<meta name="description" content="专注互联网精神的个人博客站点，记录生活，分享影视，分享IT、Web、Vps、Shadowsocks、Typecho等相关网络技术。" />


</header><!-- end #header -->
<div id="body">
    <div class="container">
        <div class="row">

<link href="/usr/themes/Writing/js/plyr.css" rel="stylesheet">
<script src="/usr/themes/Writing/js/plyr.min.js"></script>


<?php
      date_default_timezone_set('PRC'); 
      $hour = date('H');   
      if($hour > 6 && $hour <= 21){   
        echo ' ';   //白天不输出
      }else{
        echo '<link href="/usr/themes/default/night.css" rel="stylesheet"/>';   //晚上加载night.css ，用晚上的样式覆盖掉正常的样式。
    }
    ?>
