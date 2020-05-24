			<footer id="footer">
				<nav>
					<ul>
			            <li>
			              <small>Made by Marco Matta, Copyright © <?php echo date('Y'); ?></small>
			            </li>
		          	</ul>
				</nav>
				<nav>
					<ul>
			            <li>
			              <small><i>Proudly powered by Wordpress.</i></small>
			            </li>
		          	</ul>
				</nav>
				<?php
				// (Already wrapped in <nav>)
				wp_nav_menu( array(
					'theme_location' => 'footer-menu',
					'container' => 'nav',
					'fallback_cb' => false,
					'before' => '<small>',
					'after' => '</small>'
				) ); ?>

			</footer>
			<?php wp_footer(); ?>
		</section>
	</body>
</html>
