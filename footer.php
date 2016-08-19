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
    <div class="twelve columns">
      <nav id="footer_nav">
        <?php wp_nav_menu(array('theme_location' => 'footer_nav')); ?>
      </nav>
    </div>
  </div>
</footer>
<?php wp_footer(); ?>
</body>
</html>
