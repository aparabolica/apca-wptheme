<article id="post-<?php the_ID(); ?>">
  <div class="container">
    <div class="eight columns">
      <?php if(!is_post_type_archive() && !is_category()) : ?>
        <p class="type">
          <?php
          $type = get_post_type();
          if($type !== 'post')
            echo get_post_type();
          else
            the_category(' ');
          ?>
        </p>
      <?php endif; ?>
      <h2><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h2>
      <aside class="post-meta">
        <?php the_terms(get_the_ID(), 'country', '<p class="country"><span class="fa fa-globe"></span>', ', ', '</p>'); ?>
        <p class="date"><span class="fa fa-calendar"></span> <?php echo get_the_date(); ?></p>
      </aside>
      <?php the_excerpt(); ?>
    </div>
    <?php if(has_post_thumbnail()) : ?>
      <div class="four columns">
        <?php the_post_thumbnail(); ?>
      </div>
    <?php endif; ?>
  </div>
</article>
