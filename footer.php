			<footer class="footer" role="contentinfo" itemscope itemtype="http://schema.org/WPFooter">

				<div id="inner-footer" class="grid-container">

					<nav role="navigation">
						<?php wp_nav_menu(array(
    					'container' => 'div',                           	// enter '' to remove nav container (just make sure .footer-links in _base.css isn't wrapping)
    					'container_class' => 'footer-links cf',         	// class of container (should you choose to use it)
    					'menu' => __( 'Footer Links', 'helloworld' ),  		// nav name
    					'menu_class' => 'nav footer-nav cf',            	// adding custom nav class
    					'theme_location' => 'footer-links',             	// where it's located in the theme
    					'before' => '',                                 	// before the menu
    					'after' => '',                                  	// after the menu
    					'link_before' => '',                            	// before each link
    					'link_after' => '',                             	// after each link
    					'depth' => 0,                                   	// limit the depth of the nav
    					'fallback_cb' => 'helloworld_footer_links_fallback' // fallback function
						)); ?>
					</nav>

					<p class="source-org copyright">
						&copy; <?php echo date('Y'); ?> <?php bloginfo( 'name' ); ?>.
						<?php
							$campaign_source = sanitize_title(get_bloginfo( 'name' ));
						?>
						Website by <a href="http://www.austinmarketing.co.uk/?utm_source=<?php echo $campaign_source ?>&utm_medium=referal" title="Marketing Agency in Surrey" rel="noopener">Austin Marketing</a>.
					</p>

				</div>

			</footer>

		</div>

		<?php // all js scripts are loaded in library/helloworld.php ?>
		<?php wp_footer(); ?>

	</body>

</html> <!-- end html -->
