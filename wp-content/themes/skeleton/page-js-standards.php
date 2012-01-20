<?php
/*
Template Name: FED JS Standards
*/

// if you are not using this in a child of Twenty Eleven, you need to replicate the html structure of your own theme.

get_header(); ?>
<div id="primary">
<div id="content" class="sixteen columns" role="main">
<h1 class="entry-title"><?php the_title(); ?></h1>
<?php
$paged = (get_query_var('paged')) ? get_query_var('paged') : 1;
$args= array(
	'category_name' => 'javascript-standards', // Change these category SLUGS to suit your use.
	'paged' => $paged, 
	//'p' => '4'
	'page__in' => array('131', '137', '166', '188', '208'), 
	'orderby' => 'menu_order', 
	'order' => 'ASC'
);
query_posts($args);
if( have_posts() ) :?>

<?php while ( have_posts() ) : the_post(); ?>

<?php get_template_part( 'content', get_post_format() ); ?>

<?php endwhile; ?>

<?php else : ?>
<article id="post-0" class="post no-results not-found">
<header class="entry-header">
<h1 class="entry-title"><?php _e( 'Nothing Found', 'twentyeleven' ); ?></h1>
</header><!-- .entry-header -->

<div class="entry-content">
<p><?php _e( 'Apologies, but no results were found for the requested archive. Perhaps searching will help find a related post.', 'twentyeleven' ); ?></p>
<?php get_search_form(); ?>
</div>
</article>

<?php endif; ?>

</div>
</div>

<?php get_footer(); ?>