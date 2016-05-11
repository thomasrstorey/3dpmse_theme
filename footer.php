<?php
/**
 * The template for displaying the footer.
 *
 * @package Additive
 * @since 0.1.0
 */
?>
</section> <!-- content-section -->

<section id="footer-section" class="footer-section">
	<div id="footer-container" class="container">
		<?php
		if(is_active_sidebar('footer-sidebar')){
			dynamic_sidebar('footer-sidebar');
		}
		?>
	</div>
</section>
	<?php
		wp_footer(); 
	 ?>
	</body>
</html>
