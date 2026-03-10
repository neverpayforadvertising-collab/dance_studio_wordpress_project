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
$museum_exhibition_image_setting  = get_theme_mod( 'museum_exhibition_post_image_setting' , true );
$museum_exhibition_content_setting  = get_theme_mod( 'museum_exhibition_post_content_setting' , true );
$museum_exhibition_read_more_setting = get_theme_mod( 'museum_exhibition_read_more_setting' , true );
$museum_exhibition_read_more_text = get_theme_mod( 'museum_exhibition_read_more_text', __( 'Read More', 'museum-exhibition' ) );
?>

<div class="col-lg-4 col-md-6">
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
	<?php if ( $museum_exhibition_image_setting ) { ?>
			<?php echo (!is_single()) 
				? '<a href="' . esc_url( get_the_permalink() ) . '" class="post-thumbnail wow fadeInUp" data-wow-delay="0.2s">'
				: '<div class="post-thumbnail wow fadeInUp" data-wow-delay="0.2s">';
			?>
			<?php if ( has_post_thumbnail() ) {
				// Load thumbnail depending on sidebar
				if ( is_active_sidebar( 'right-sidebar' ) ) {
					the_post_thumbnail( 'museum-exhibition-with-sidebar', array( 'itemprop' => 'image' ) );
				} else {
					the_post_thumbnail( 'museum-exhibition-without-sidebar', array( 'itemprop' => 'image' ) );
				}
			} else {
				// Load default image
				$museum_exhibition_default_img_url = get_template_directory_uri() . '/images/breadcrumb.png'; 
				$museum_exhibition_image_class = is_active_sidebar( 'right-sidebar' ) ? 'museum-exhibition-with-sidebar' : 'museum-exhibition-without-sidebar';
				echo '<img src="' . esc_url( $museum_exhibition_default_img_url ) . '" class="' . esc_attr( $museum_exhibition_image_class ) . '" alt="' . esc_attr__( 'Default Image', 'museum-exhibition' ) . '" itemprop="image" />';
			} ?>

		<?php echo ( ! is_single() ) ? '</a>' : '</div>'; ?>
	<?php } ?>
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
    <?php if ( !is_single() && $museum_exhibition_read_more_setting ) { ?>
        <div class="read-more-button">
            <a href="<?php echo esc_url( get_permalink() ); ?>" class="read-more-button"><?php echo esc_html( $museum_exhibition_read_more_text ); ?></a>
        </div>
    <?php } ?>
</article><!-- #post-## -->
</div>