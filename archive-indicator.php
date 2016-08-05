<?php get_header(); ?>

<section id="archive">
  <header class="archive-header">
    <div class="container">
      <div class="twelve columns">
        <h1><?php _e('Indicators', 'apca'); ?></h1>
      </div>
    </div>
  </header>
  <section class="archive-content indicators-content">
    <?php if(have_posts()) : while(have_posts()) : the_post(); ?>
      <?php
      $status_field = get_field_object('indicator_status');
      $status_value = get_field('indicator_status');
      $status_label = $status_field['choices'][$status_value];
      ?>
      <article id="indicator-<?php the_ID(); ?>" class="status-<?php echo $status_value; ?>">
        <div class="container">
          <div class="seven columns">
            <h2><a href="<?php the_permalink(); ?>" title="<?php the_title(); ?>"><?php the_title(); ?></a></h2>
            <div class="excerpt">
              <?php the_excerpt(); ?>
            </div>
            <?php if(have_rows('indicator_links')) : ?>
              <div class="links">
                <?php while(have_rows('indicator_links')) : the_row(); ?>
                  <a class="button" target="_blank" rel="external" href="<?php the_sub_field('link_url'); ?>"><?php the_sub_field('link_title'); ?></a>
                <?php endwhile; ?>
              </div>
            <?php endif; ?>
          </div>
          <div class="five columns">
            <div class="status-icon">
              <img src="<?php echo apca_get_indicator_status_image_url(); ?>" />
            </div>
            <p class="status"><?php echo $status_label; ?></p>
            <p class="status-text"><?php the_field('indicator_status_text'); ?></p>
          </div>
        </div>
      </article>
    <?php endwhile; endif; ?>
  </section>
</section>

<?php get_footer(); ?>
