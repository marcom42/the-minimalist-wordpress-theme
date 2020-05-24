<?php
/* Template Name: Archive Page */
get_header();
?>

<article>
	<h1>Archive</h1>
	<h6>Browse by category</h6>

	<?php hierarchical_category_tree(); ?>
	<hr>
	<h6>Browse by date</h6>
	<?php wp_get_archives('monthly'); ?>
</article>

<?php get_footer(); ?>
