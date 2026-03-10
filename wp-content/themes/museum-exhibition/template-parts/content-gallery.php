<?php
/**
 * Template part for displaying posts.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package museum_exhibition
 */
$museum_exhibition_heading_setting  = get_theme_mod( 'museum_exhibition_post_heading_setting' , true );
$museum_exhibition_meta_setting  = get_theme_mod( 'museum_exhibition_post_meta_setting' , true );
$museum_exhibition_content_setting  = get_theme_mod( 'museum_exhibition_post_content_setting' , true );
?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	<header class="entry-header">
		<?php
		  if ( $museum_exhibition_heading_setting ){ 
			if ( is_single() ) {
				the_title( '<h1 class="entry-title" itemprop="headline">', '</h1>' );
			} else {
				the_title( '<h2 class="entry-title" itemprop="headline"><a href="' . esc_url( get_permalink() ) . '" rel="bookmark">', '</a></h2>' );
			}
		  }

		if ( 'post' === get_post_type() ) : ?>
		<?php
		if ( $museum_exhibition_meta_setting ){ ?>
			<div class="entry-meta">
				<?php museum_exhibition_posted_on(); ?>
			</div><!-- .entry-meta -->
		<?php } ?>
		<?php
		endif; ?>
	</header><!-- .entry-header -->
	 <?php
		    // Check if there is a gallery embedded in the post content
		    $museum_exhibition_post_id = get_the_ID(); // Add this line to get the post ID
		    $museum_exhibition_single_content_setting = get_post_gallery();

		    if (!empty($museum_exhibition_single_content_setting)) {
		        // Display the gallery
		        echo '<div class="embedded-gallery">' . do_shortcode($museum_exhibition_single_content_setting) . '</div>';
		    }
		?>
    <?php
	if ( $museum_exhibition_content_setting ){ ?>
		<div class="entry-content" itemprop="text">
			<?php
			if( is_single()){
				the_content( sprintf(
					/* translators: %s: Name of current post. */
					wp_kses( __( 'Continue reading %s <span class="meta-nav">&rarr;</span>', 'museum-exhibition' ), array( 'span' => array( 'class' => array() ) ) ),
					the_title( '<span class="screen-reader-text">"', '"</span>', false )
				) );
				}else{
				the_excerpt();
				}
				wp_link_pages( array(
					'before' => '<div class="page-links">' . esc_html__( 'Pages:', 'museum-exhibition' ),
					'after'  => '</div>',
				) );
			?>
		</div><!-- .entry-content -->
    <?php } ?>
</article><!-- #post-## -->