<!DOCTYPE html>
<html lang="en" dir="ltr">
	<head>
		<?php wp_head(); ?>
		<title><?php echo get_bloginfo(); ?></title>
	</head>
	<body>
		<section>
			<header>
		        <nav>
		          <ul>
		            <li><code><?php echo get_bloginfo(); ?></code></li>
		          </ul>
		        </nav>
				<?php
				// (Already wrapped in <nav>)
				wp_nav_menu( array(
					'theme_location' => 'header-menu',
					'container' => 'nav',
					'fallback_cb' => false
				 ) ); ?>
			</header>
