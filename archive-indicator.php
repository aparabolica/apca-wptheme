<?php get_header(); ?>

<section id="archive">
  <header class="archive-header">
    <div class="container">
      <div class="nine columns">
        <h1><?php _e('Indicators', 'apca'); ?></h1>
      </div>
    </div>
  </header>
  <section class="archive-content indicators-content">
    <?php if(have_posts()) : while(have_posts()) : the_post(); ?>
      <article id="indicator-<?php the_ID(); ?>">
        <div class="container">
          <div class="four columns">
            <?php
            $status_field = get_field_object('indicator_status');
            $status_value = get_field('indicator_status');
            $status_label = $status_field['choices'][$status_value];
            ?>
            <p class="status"><?php echo $status_label; ?></p>
          </div>
          <div class="eight columns">
            <h2><?php the_title(); ?></h2>
            <p><?php the_field('indicator_status_text'); ?></p>
          </div>
        </div>
      </article>
    <?php endwhile; endif; ?>
  </section>
</section>

<?php get_footer(); ?>
