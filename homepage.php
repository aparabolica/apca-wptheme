<?php
/*
 * Template name: Home
 */
?>
<?php get_header(); ?>

<?php if(have_posts()): while(have_posts()) : the_post(); ?>

  <section id="welcome">
    <div class="container">
      <div class="ten columns offset-by-one">
        <div class="welcome-content">
          <div class="container">
            <div class="six columns">
              <div class="headline-content">
                <h2><?php echo arp_get_headline(); ?></h2>
                <p><?php echo arp_get_headline_description(); ?></p>
                <p><a class="button" href="<?php echo arp_get_headline_url(); ?>"><?php _e('Learn more', 'apca'); ?></a></p>
              </div>
            </div>
            <div class="four columns offset-by-two">
              <div class="amazon-vision">
                <img src="<?php echo get_stylesheet_directory_uri(); ?>/img/amazon_vision.png" />
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
    <?php
    $header = get_custom_header();
    $image = get_post($header->attachment_id);
    ?>
    <div class="bg-caption"><?php echo apply_filters('the_content', $image->post_excerpt); ?></div>
  </section>
  <div class="container full">
    <div class="nine columns">
      <?php
      query_posts('post_type=carousel&posts_per_page=-1');
      if(have_posts()) :
        ?>
        <section id="carousel">
          <nav class="carousel-nav">
            <?php
            while(have_posts()) : the_post();
              ?>
              <a href="#" data-postid="<?php the_ID(); ?>"></a>
              <?php
            endwhile;
            ?>
          </nav>
          <?php
          while(have_posts()) : the_post();
            ?>
            <article class="carousel-item" data-postid="<?php the_ID(); ?>">
              <a href="<?php the_field('url'); ?>" <?php if(get_field('target_blank')) echo 'target="_blank"'; ?>><?php the_post_thumbnail('highlight'); ?></a>
              <div class="carousel-item-meta">
                <h2><a href="<?php the_field('url'); ?>" <?php if(get_field('target_blank')) echo 'target="_blank"'; ?>><?php the_title(); ?></a></h2>
                <?php the_excerpt(); ?>
              </div>
            </article>
            <?php
          endwhile;
          ?>
        </section>
        <?php
      endif;
      wp_reset_query();
      ?>
    </div>
    <div class="three columns">
      <section id="social">
        <div class="social-bg"></div>
        <div class="social-content">
          <h2><?php _e('Connect with us', 'apca'); ?></h2>
          <a class="fa fa-facebook" href="https://www.facebook.com/WWFLivingAmazonInitiative/" target="_blank" rel="extenal" title="Facebook"></a>
          <a class="fa fa-youtube" href="https://www.youtube.com/user/LivingAmazon" target="_blank" rel="external" title="YouTube"></a>
        </div>
      </section>
      <section id="latest" class="page-section clean">
        <h2 class="section-title"><?php _e('Latest news', 'apca'); ?></h2>
        <?php
        query_posts('posts_per_page=3');
        if(have_posts()) :
          while(have_posts()) :
            the_post();
            ?>
            <article class="post-item small clearfix">
              <a href="<?php the_permalink(); ?>"><?php the_post_thumbnail('thumbnail'); ?></a>
              <h3><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h3>
            </article>
            <?php
          endwhile;
        endif;
        wp_reset_query();
        ?>
        <p><a class="button" href="<?php echo home_url('/library/'); ?>"><?php _e('Meet the library', 'apca'); ?></a></p>
      </section>
    </div>
  </div>
  <div id="home-map-info">
    <div class="container">
      <div class="twelve columns">
        <h2><?php _e('Amazon Protected Areas', 'apca'); ?></h2>
      </div>
    </div>
  </div>
  <section id="map">
    <div class="arp-map">
      <?php echo arp_get_home_map(); ?>
    </div>
  </section>

  <?php query_posts('post_type=indicator&posts_per_page=-1'); ?>
  <?php if(have_posts()) : ?>
    <section id="indicators" class="page-section">
      <div class="container">
        <div class="twelve columns">
          <h2 class="section-title"><?php _e('Indicators', 'apca'); ?> <a class="button" href="<?php echo get_post_type_archive_link('indicator'); ?>"><?php _e('View all indicators', 'apca'); ?></a></h2>
        </div>
      </div>
      <div class="container">
        <div class="twelve columns">
          <ul>
            <?php while(have_posts()) : the_post(); ?>
              <li>
                <article id="post-<?php the_ID(); ?>" class="indicator status-<?php the_field('indicator_status'); ?>">
                  <h3><a href="<?php the_permalink(); ?>">"<?php the_title(); ?></a></h3>
                  <div class="status">
                    <div class="status-icon">
                      <img src="<?php echo apca_get_indicator_status_image_url(); ?>" />
                    </div>
                  </div>
                  <?php the_excerpt(); ?>
                </article>
              </li>
            <?php endwhile; ?>
          </ul>
        </div>
      </div>
    </section>
  <?php endif; ?>
  <?php wp_reset_query(); ?>

<?php endwhile; endif; ?>

<?php get_footer(); ?>
