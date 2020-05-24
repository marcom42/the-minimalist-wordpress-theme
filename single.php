<?php get_header(); ?>
<article>
	<?php if(have_posts()): while (have_posts()): the_post() ?>
		<h1><?php echo the_title(); ?></h1>
		<h6><i>Posted on <?php echo get_the_date(); ?></i></h6>
		<?php the_content(); ?>
	<?php endwhile; endif; ?>
	<p>
		<?php
		// Display post categories
		$cats = get_the_category();
		echo '<i>Posted in: </i>';
		foreach($cats as $cat) {
			echo ' <code><a href="'.get_category_link($cat->cat_ID).'">' . $cat->name . '</a></code> ';
		}
	 	?>
	</p>
	<hr>
	<?php
	// Display related posts
	$args = array(
		'posts_per_page' => 4,
		'post__not_in'   => array( get_the_ID() ),
		'no_found_rows'  => true,
	);

	$cats = wp_get_post_terms( get_the_ID(), 'category' );
	$cats_ids = array();
	foreach( $cats as $wpex_related_cat ) {
		$cats_ids[] = $wpex_related_cat->term_id;
	}
	if ( ! empty( $cats_ids ) ) {
		$args['category__in'] = $cats_ids;
	}

	// Query posts
	$wpex_query = new wp_query( $args ); ?>
	Related posts
	<ul>
	<?php
	$i = 0;
	foreach( $wpex_query->posts as $post ) : setup_postdata( $post ); ?>

		<li><a href="<?php the_permalink(); ?>" title="<?php echo esc_attr( the_title_attribute( 'echo=0' ) ); ?>"><?php the_title(); ?></a></li>

	<?php
	// In case no posts are related
	$i++;
	endforeach;
	wp_reset_postdata();

	if ($i == 0) echo '<i>No related posts to display</i>';
	?>
	</ul>

	<?php
	// Display post comments
	if (comments_open()){
    	comments_template();
	}
	?>


</article>
<?php get_footer(); ?>
