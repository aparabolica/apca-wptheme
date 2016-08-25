<!doctype html>
<html lang="en-US">
<head>
  <meta charset="utf-8" />
  <title><?php bloginfo('name'); ?></title>
  <meta name="viewport" content="width=device-width,initial-scale=1, user-scalable=no">
  <?php wp_head(); ?>
</head>
<body <?php body_class( $class ); ?>>
  <header id="masthead" class="<?php echo arp_get_header_class(); ?>">
    <div class="container">
      <div class="twelve columns">
        <div class="brand <?php echo arp_get_brand_class(); ?>">
          <img src="<?php echo get_stylesheet_directory_uri(); ?>/img/redparques.png" />
          <h1 class="title">
            <?php
            $lang = '';
            if(function_exists('qtranxf_getLanguage'))
              $lang = qtranxf_getLanguage();
            if($lang == 'pb' || $lang == 'pt_BR') :
              ?>
              <a href="<?php echo home_url('/'); ?>">
                <span class="subject">Áreas protegidas e clima</span>
                <span class="product">na Amazônia</span>
              </a>
            <?php elseif($lang == 'es') : ?>
              <a href="<?php echo home_url('/'); ?>">
                <span class="subject">Áreas protegidas y el clima</span>
                <span class="product">en la Amazonia</span>
              </a>
            <?php else : ?>
              <a href="<?php echo home_url('/'); ?>">
                <span class="subject">Protected Areas and Climate</span>
                <span class="product">in the Amazon</span>
              </a>
            <?php endif; ?>
          </h1>
        </div>
        <nav>
          <?php wp_nav_menu(array('theme_location' => 'header_nav')); ?>
          <form class="search" action="<?php echo home_url('/'); ?>">
            <a href="#"><span class="fa fa-search"></span></a>
            <input type="text" name="s" placeholder="<?php _e('Search anything...', 'apca'); ?>" value="<?php if(isset($_GET['s'])) echo $_GET['s']; ?>" />
          </form>
          <?php if(function_exists('qtranxf_generateLanguageSelectCode')) : ?>
            <div class="language-selector">
              <?php echo qtranxf_generateLanguageSelectCode('image'); ?>
            </div>
          <?php endif; ?>
        </nav>
      </div>
    </div>
  </header>
