<?php
/**
 * The template for displaying the footer.
 *
 * Contains the closing of the #content div and all content after.
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package churching-up
 */

?>

	</div><!-- #content -->

	<footer id="colophon" class="site-footer" role="contentinfo">
		<!--<div class="site-info">
			<a href="<?php echo esc_url( __( 'https://wordpress.org/', 'churching-up' ) ); ?>"><?php printf( esc_html__( 'Proudly powered by %s', 'churching-up' ), 'WordPress' ); ?></a>
			<span class="sep"> | </span>
			<?php printf( esc_html__( 'Theme: %1$s by %2$s.', 'churching-up' ), 'churching-up', '<a href="http://underscores.me/" rel="designer">David Glauner</a>' ); ?>
		</div> .site-info -->
                <div class="site-info">
                    &copy; 2016 Deering Community Church<br />Site Developed and Maintained by 
                    <a href="mailto:dgtechserv@gmail.com" >David Glauner</a> 
                </div>
	</footer><!-- #colophon -->
</div><!-- #page -->

<?php wp_footer(); ?>

</body>
</html>
