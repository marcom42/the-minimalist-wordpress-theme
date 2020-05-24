<?php
/* Template Name: Archive Page */

get_header();
?>

<article>

	<h1>Archive</h1>
	<h6>Browse by category</h6>

	<!--<ul>
		<?php
		/*
		$cats = get_categories();
		// name
		// cat id

		foreach($cats as $cat) : ?>
			<li><a href="<?php echo get_category_link($cat->cat_ID); ?>"><?php echo $cat->name; ?> (<?php echo $cat->count ?>)</a></li>

		<?php endforeach; */?>
	</ul>-->
	<?php

    hierarchical_category_tree( ); // the function call; 0 for all categories; or cat ID

function hierarchical_category_tree( $cat = 0 ) {
    // wpse-41548 // alchymyth // a hierarchical list of all categories //

  $next = get_categories('hide_empty=false&orderby=name&order=ASC&parent=' . $cat);

  if( $next ) :
    foreach( $next as $cat ) :
	    echo '<ul><li>';
	    echo '<a href="' . get_category_link( $cat->term_id ) . '" title="' . sprintf( __( "View all posts in %s" ), $cat->name ) . '" ' . '>'.$cat->name.' ('. $cat->count . ')</a>  ';
	    hierarchical_category_tree( $cat->term_id );
    endforeach;
  endif;

  echo '</li></ul>'; echo "\n";
}
?>
	<hr>

	<h6>Browse by date</h6>
	<?php wp_get_archives('monthly'); ?>
</article>

<?php get_footer(); ?>
