<?php get_header(); ?>
<article>
	<?php if(have_posts()): while (have_posts()): the_post() ?>
		<h1><a href="<?php echo get_permalink()?>"><?php the_title(); ?></a></h1>
		<h6><i>Posted on <?php echo get_the_date(); ?></i></h6>
		<?php
		the_content();
		?>
	<?php endwhile; endif; ?>
</article>
<?php get_footer(); ?>
