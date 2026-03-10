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

<article class="wow zoomInUp delay-1000" data-wow-duration="2s" id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
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
			// Get the post ID
			$museum_exhibition_post_id = get_the_ID();

			// Check if there are videos embedded in the post content
			$museum_exhibition_post = get_post($museum_exhibition_post_id);
			$museum_exhibition_content = do_shortcode(apply_filters('the_content', $museum_exhibition_post->post_content));
			$museum_exhibition_embeds = get_media_embedded_in_content($museum_exhibition_content);

			if (!empty($museum_exhibition_embeds)) {
			    // Loop through embedded media and display videos
			    foreach ($museum_exhibition_embeds as $embed) {
			        // Check if the embed code contains a video tag or specific video providers like YouTube or Vimeo
			        if (strpos($embed, 'video') !== false || strpos($embed, 'youtube') !== false || strpos($embed, 'vimeo') !== false || strpos($embed, 'dailymotion') !== false || strpos($embed, 'vine') !== false || strpos($embed, 'wordPress.tv') !== false || strpos($embed, 'hulu') !== false) {
			            ?>
			            <div class="custom-embedded-video">
			                <div class="video-container">
			                    <?php echo $embed; ?>
			                </div>
			                <div class="video-comments">
			                    <?php
			                    // Add your comments section here
			                    comments_template(); // This will include the default WordPress comments template
			                    ?>
			                </div>
			            </div>
			            <?php
			        }
			    }
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