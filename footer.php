<?php if ( is_active_sidebar( 'footer' ) ) : ?>
	<section id="footer-widgets" class="primary-sidebar widget-area" role="complementary">
		<div class="container">
			<div class="twelve columns">
				<div class="widgets-container">
					<?php dynamic_sidebar( 'footer' ); ?>
				</div>
			</div>
		</div>
	</section><!-- #footer-widgets -->
<?php endif; ?>
<footer id="colophon">
  <div class="container">
    <div class="eight columns">
      <nav id="footer_nav">
        <?php wp_nav_menu(array('theme_location' => 'footer_nav')); ?>
      </nav>
    </div>
		<div class="four columns">
			<aside class="social">
				<div class="social-content">
					<h3><?php _e('Connect with us', 'arp'); ?></h3>
					<?php
					$fb = get_field('site_options_facebook', 'option');
					$tw = get_field('site_options_twitter', 'option');
					$yt = get_field('site_options_youtube', 'option');
					?>
					<?php if($fb) : ?>
						<a class="fa fa-facebook" href="<?php echo $fb; ?>" target="_blank" rel="extenal" title="Facebook"></a>
					<?php endif; ?>
					<?php if($yt) : ?>
						<a class="fa fa-youtube" href="<?php echo $yt; ?>" target="_blank" rel="external" title="YouTube"></a>
					<?php endif; ?>
					<?php if($tw) : ?>
						<a class="fa fa-twitter" href="<?php echo $tw; ?>" target="_blank" rel="external" title="Twitter"></a>
					<?php endif; ?>
				</div>
			</aside>
		</div>
  </div>
</footer>
<?php wp_footer(); ?>
</body>
</html>
