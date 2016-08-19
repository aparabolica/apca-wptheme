<?php
/*
 * Template name: Library page
 */
?>
<?php get_header(); ?>

<article id="page">
  <?php
  $story_map = arp_get_story_map_url();
  $story_map_type = arp_get_story_map_type();
  if($story_map) : ?>
    <?php if($story_map_type == 'iframe') : ?>
      <header class="page-header">
        <div class="container">
          <div class="twelve columns">
            <section id="story-map">
              <?php echo arp_get_story_map(); ?>
            </section>
          </div>
        </div>
      </header>
    <?php elseif($story_map_type == 'youtube') : ?>
      <header class="page-header video">
        <section id="story-map" class="video">
          <?php echo arp_get_story_map(); ?>
        </section>
      </header>
    <?php endif; ?>
  <?php endif; ?>
  <?php
  $news_id = get_cat_ID('news');
  $news_link = get_category_link($news_id);
  query_posts('posts_per_page=3&category_name=news');
  if(have_posts()) :
    ?>
    <section id="latest" class="page-section">
      <div class="container">
        <div class="twelve columns">
          <h2 class="section-title"><?php _e('Latest news', 'apca'); ?> <a class="button" href="<?php echo $news_link ?>"><?php _e('View all news', 'apca'); ?></a></h2>
        </div>
      </div>
      <div class="post-list latest-list">
        <div class="container">
          <?php
          while(have_posts()) :
            the_post();
            ?>
            <div class="four columns">
              <article class="post-item">
                <a href="<?php the_permalink(); ?>"><?php the_post_thumbnail('wide-thumbnail'); ?></a>
                <h3><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h3>
              </article>
            </div>
            <?php
          endwhile;
          ?>
        </div>
      </div>
    </section>
    <?php
  endif;
  wp_reset_query();
  ?>
  <div class="container">
    <div class="six columns">
      <?php
      $publications_id = get_cat_ID('publications');
      $publications_link = get_category_link($publications_id);
      query_posts('posts_per_page=3&category_name=publications');
      if(have_posts()) :
        ?>
        <section id="publications" class="page-section">
          <h2 class="section-title"><?php _e('Publications', 'apca'); ?> <a class="button" href="<?php echo $publications_link ?>"><?php _e('View all publications', 'apca'); ?></a></h2>
          <?php
          while(have_posts()) :
            the_post();
            ?>
            <article class="post-item clearfix">
              <div class="three columns">
                <a href="<?php the_permalink(); ?>"><?php the_post_thumbnail(); ?></a>
              </div>
              <div class="nine columns">
                <h3><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h3>
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
    <div class="six columns">
      <?php
      $docs_id = get_cat_ID('policy documents');
      $docs_link = get_category_link($docs_id);
      query_posts('posts_per_page=1&category_name=policy-documents');
      if(have_posts()) :
        ?>
        <section id="policy-documents" class="page-section">
          <h2 class="section-title"><?php _e('Policy Documents', 'apca'); ?> <a class="button" href="<?php echo $docs_link ?>"><?php _e('View all policy documents', 'apca'); ?></a></h2>
          <?php
          while(have_posts()) :
            the_post();
            ?>
            <article class="post-item clearfix">
              <div class="three columns">
                <a href="<?php the_permalink(); ?>"><?php the_post_thumbnail(); ?></a>
              </div>
              <div class="nine columns">
                <h3><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h3>
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
  </div>
</article>

<?php get_footer(); ?>
