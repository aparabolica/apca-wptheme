<?php get_header(); ?>

<?php
if(have_posts()) : while(have_posts()) : the_post();

  $status_field = get_field_object('indicator_status');
  $status_value = get_field('indicator_status');
  $status_label = $status_field['choices'][$status_value];

  ?>

  <article id="single">
    <header class="article-header">
      <div class="container">
        <div class="twelve columns">
          <h1><?php the_title(); ?></h1>
        </div>
      </div>
    </header>
    <section id="indicator-status" class="status-<?php echo $status_value; ?>">
      <div class="container">
        <div class="six columns offset-by-three">
          <div class="status-icon-container">
            <div class="status-icon">
              <img src="<?php echo apca_get_indicator_status_image_url(); ?>" />
            </div>
            <p class="status"><?php echo $status_label; ?></p>
          </div>
          <p class="status-text"><?php the_field('indicator_status_text'); ?></p>
        </div>
      </div>
    </section>
    <section class="article-content">
      <div class="container">
        <div class="eight columns offset-by-two">
          <?php the_content(); ?>
          <p class="arp-src"><a href="<?php echo get_post_type_archive_link('indicator'); ?>"><?php _e('View all indicators', 'apca'); ?></a></p>
        </div>
      </div>
    </section>
  </article>

<?php endwhile; endif; ?>

<?php get_footer(); ?>
