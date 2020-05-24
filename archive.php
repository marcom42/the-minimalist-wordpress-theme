<?php get_header(); ?>

<article>
	<h3>Archive: <i><?php echo single_cat_title(); ?></i></h3>
	<ul>
		<?php if(have_posts()): while (have_posts()): the_post() ?>

			<li><a href="<?php echo get_permalink(); ?>"><?php the_title(); ?></a></li>

		<?php endwhile; endif; ?>
	</ul>
</article>

<?php get_footer(); ?>
