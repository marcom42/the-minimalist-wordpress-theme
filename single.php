<?php
// The MIT License (MIT)
//
// Copyright (c) 2020 Marco Matta
//
// Permission is hereby granted, free of charge, to any person obtaining a copy
// of this software and associated documentation files (the "Software"), to deal
// in the Software without restriction, including without limitation the rights
// to use, copy, modify, merge, publish, distribute, sublicense, and/or sell
// copies of the Software, and to permit persons to whom the Software is
// furnished to do so, subject to the following conditions:
//
// The above copyright notice and this permission notice shall be included
// in all copies or substantial portions of the Software.
//
// THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND, EXPRESS OR
// IMPLIED, INCLUDING BUT NOT LIMITED TO THE WARRANTIES OF MERCHANTABILITY,
// FITNESS FOR A PARTICULAR PURPOSE AND NON-INFRINGEMENT. IN NO EVENT SHALL THE
// AUTHORS OR COPYRIGHT HOLDERS BE LIABLE FOR ANY CLAIM, DAMAGES OR OTHER
// LIABILITY, WHETHER IN AN ACTION OF CONTRACT, TORT OR OTHERWISE, ARISING FROM,
// OUT OF OR IN CONNECTION WITH THE SOFTWARE OR THE USE OR OTHER DEALINGS IN THE
// SOFTWARE.

get_header(); ?>
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
