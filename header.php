<?php if (!defined('__TYPECHO_ROOT_DIR__')) exit; ?>
<!DOCTYPE html>
<html>
<head>
<?php outputStart(); ?>
    <meta charset="<?php $this->options->charset(); ?>">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="renderer" content="webkit">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
    <!-- 页面标题 -->
    <title><?php $this->archiveTitle(array(
            'category'  =>  _t('分类 %s 下的文章'),
            'search'    =>  _t('包含关键字 %s 的文章'),
            'tag'       =>  _t('标签 %s 下的文章'),
            'author'    =>  _t('%s 发布的文章')
        ), '', ' - '); ?><?php $this->options->title(); ?></title>
    <!-- MDUI CSS -->
    <!-- <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/mdui@1.0.0/dist/css/mdui.min.css" integrity="sha384-2PJ2u4NYg6jCNNpv3i1hK9AoAqODy6CdiC+gYiL2DVx+ku5wzJMFNdE3RoWfBIRP" crossorigin="anonymous" /> -->
    <link rel="stylesheet" href="<?php $this->options->themeUrl('assets/css/mdui.min.css'); ?>">
    <!-- 页面 CSS 样式 -->
    <link rel="stylesheet" href="<?php $this->options->themeUrl('assets/css/style.css'); ?>">
    <link rel="stylesheet" href="<?php $this->options->themeUrl('assets/css/alert-js.css'); ?>">
    <link rel="stylesheet" href="<?php $this->options->themeUrl('assets/css/prism.css'); ?>">
    
    <!-- ICON -->

    <link rel="icon" href="<?php $this->options->themeUrl('assets/img/icon.png'); ?>">

    <!-- 其他 HTML 头部信息 -->
    <?php if ($this->is('post') || $this->is('page')) : ?>
      <?php echo '<meta name="description" content="'.$this->fields->excerpt.'" />'; ?>
      <?php $this->header('description='); ?>
    <?php else: ?>
      <?php $this->header(); ?>

    <?php endif; ?>
    
    

    <?php if ($this->options->customCSS): ?>
      <style>
      <?php $this->options->customCSS() ?>
      </style>
    <?php endif; ?>

    <?php if ($this->options->customHeadHTML): ?>
      <?php $this->options->customHeadHTML() ?>
    <?php endif; ?>
</head>

<!-- 判断站点主题色，强调色 -->
<?php 

$mduiPrimary = $this->options->primaryColor;
$mduiAccent = $this->options->accentColor;



echo "<body class='mdui-theme-primary-". $mduiPrimary." mdui-theme-accent-". $mduiAccent."  line-numbers' >";

?>
<div id="menu-body">


<!-- AppBar -->
<?php
echo '<div class="mdui-appbar appbar"  id="appbar"> ';
?>
<!-- mdui-appbar-fixed -->
    <div class="mdui-toolbar mdui-color-theme">
        <!-- 菜单 -->
        <!-- icon:menu -->
        <a href="javascript:;" id="toggle" class="mdui-btn mdui-btn-icon"><i class="mdui-icon material-icons">&#xe5d2;</i></a>
        <!-- 站点标题 -->
        <a href="<?php $this->options->siteUrl(); ?>" class="mdui-typo-headline"><?php $this->options->title() ?></a>
        <div class="mdui-toolbar-spacer"></div>

        <!-- SenWeater -->

          

            <div id="SenAnchor"></div>



        <!-- icon:brightness_high -->
        <span class="mdui-btn mdui-btn-icon" id="dark_toggle_btn" onclick='toggleDark();'><i class="mdui-icon material-icons" id="dark_toggle_icon">&#xe1ac;</i></span>
        <?php if($this->options->appBarRSS == true): ?>
        
        <!-- icon:rss_feed -->
        
        <button id="open-rss-menu" class="mdui-btn mdui-btn-icon"><i class="mdui-icon material-icons">&#xe0e5;</i></button>
        <ul class="mdui-menu" id="rss-menu">
          <li class="mdui-menu-item">
            <a href="<?php $this->options->feedUrl(); ?>" class="mdui-ripple">文章 RSS</a>
          </li>
          <li class="mdui-menu-item">
            <a href="<?php $this->options->commentsFeedUrl(); ?>" class="mdui-ripple">评论 RSS</a>
          </li>
        </ul>
        <?php endif; ?>
        
    </div>
</div>
</div>
<!-- SideBar -->
<div class="mdui-drawer mdui-drawer-close mdui-drawer-full-height"  id="drawer"> 

<div class="mdui-list" mdui-collapse="{accordion: true}">
          <form class="mdui-p-t-0 mdui-m-x-2 mdui-textfield mdui-textfield-floating-label" method="post">
            <label class="mdui-textfield-label">搜索</label>
            <input class="mdui-textfield-input" type="text" name="s" />
          </form>
          <div class="mdui-divider"></div>

          <a href="<?php $this->options->siteUrl(); ?>" class="mdui-list-item mdui-ripple" id="home-url">
            <i class="mdui-list-item-icon mdui-icon material-icons">&#xe88a;</i>
            <div class="mdui-list-item-content mdui-m-r-4">首页</div>
          </a>

        <?php $this->widget('Widget_Contents_Page_List')->to($pages); ?>
        <?php if ($pages->have()): ?>
          <?php while ($pages->next()): ?>
            <a href="<?php $pages->permalink(); ?>" class="mdui-list-item mdui-ripple">
              <i class="mdui-list-item-icon mdui-icon material-icons">&#xe86e;</i>
              <div class="mdui-list-item-content mdui-m-r-4"><?php $pages->title(); ?></div>
            </a>
          <?php endwhile; ?>
          <div class="mdui-divider"></div>
        <?php endif; ?>
</div>
</div>

<?php 

if ($this->is('post') || $this->is('page')) {
  // 如果这是文章或单独的页面
  if(!$this->fields->postImage){
    // 如果没有设置单独的图片
    $postBannerimg = $this->options->bannerImage;
  }else{
    // 有设置单独的图片
    $postBannerimg = $this->fields->postImage;
  }
  // 输出 CSS
  echo "<style>.bannerImage{background-image: url(".$postBannerimg."); opacity: 1 !important; transition: opacity 0s ease 0s !important;}</style>";
}else{
  // 不是文章或图片
  // 输出 CSS
echo "<style>.bannerImage{background-image: url(".$this->options->bannerImage."); opacity: 1 !important; transition: opacity 0s ease 0s !important;}</style>";
}
?>

<div class="theFirstPage bannerImage"></div>

<div id="banner" class="theFirstPageSay mdui-valign mdui-typo mdui-text-color-white-text">
 <h1 class="mdui-center"><?php 
 // 如果标题有内容
 if($this->archiveTitle(array(
  'category'  =>  _t('分类「%s」下的文章'),
  'search'    =>  _t('包含关键字「%s」的文章'),
  'tag'       =>  _t('标签「%s」下的文章'),
  'author'    =>  _t('作者「%s」发布的文章')
), '') ){
  // 直接输出当前标题
  $this->archiveTitle(array(
  'category'  =>  _t('分类「%s」下的文章'),
  'search'    =>  _t('包含关键字「%s」的文章'),
  'tag'       =>  _t('标签「%s」下的文章'),
  'author'    =>  _t('作者「%s」发布的文章')
), ''); }else{

  // 标题无内容

  if($this->is('index')){
    // 且是在首页
    // 输出 Slogan
    echo $this->options->pageSlogan;
  }
} ?></h1>
 <br/>


<div>





</div>

</div>

</div>
<div class="main">

<!-- Check For JavaScript -->
<noscript>
	<div class="alert-js">
		<p>啊哦，<code class="code-js"> JavaScript </code>似乎无法正常使用。请尝试打开<code class="code-js"> JavaScript </code>以获得最佳体验！</p>
	</div>
</noscript>










<div id="body">
    <div class="container">


    
    
