<?php
/**
 * The template for displaying the footer
 *
 * Contains the closing of the #content div and all content after.
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package media-service
 */

?>
  <footer>
    <div class="footer__inner">
    <img src="<?php echo get_template_directory_uri(); ?>/img/logo_footer.svg" alt="原本電設" width="200" height="56" />
      <p>&copy; <?php echo date('Y'); ?> Haramoto Electric Ltd. All Rights Reserved.</p>
    </div>
  </footer>
	<!-- <footer id="colophon" class="site-footer">
		<div class="site-info">
			<a href="<?php //echo esc_url( __( 'https://wordpress.org/', 'media-service' ) ); ?>">
				<?php
				//printf( esc_html__( 'Proudly powered by %s', 'media-service' ), 'WordPress' );
				?>
			</a>
			<span class="sep"> | </span>
				<?php
				//printf( esc_html__( 'Theme: %1$s by %2$s.', 'media-service' ), 'media-service', '<a href="https://github.com/oimos">Shinya Takahashi</a>' );
				?>
		</div>
	</footer> -->
</div><!-- #page -->

<?php wp_footer(); ?>

</body>
</html>
