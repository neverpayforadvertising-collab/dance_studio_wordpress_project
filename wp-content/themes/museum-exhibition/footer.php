<?php
/**
 * The template for displaying the footer.
 *
 * Contains the closing of the #content div and all content after.
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package museum_exhibition
 */
$museum_exhibition_scroll_top  = get_theme_mod( 'museum_exhibition_scroll_to_top', true );
$museum_exhibition_footer_background = get_theme_mod('museum_exhibition_footer_background_image');
$museum_exhibition_footer_background_url = '';
if(!empty($museum_exhibition_footer_background)){
    $museum_exhibition_footer_background = absint($museum_exhibition_footer_background);
    $museum_exhibition_footer_background_url = wp_get_attachment_url($museum_exhibition_footer_background);
}

$museum_exhibition_footer_background_color = get_theme_mod('museum_exhibition_footer_background_color', 'var(--primary-color)'); // New line

$museum_exhibition_footer_background_style = '';
if (!empty($museum_exhibition_footer_background_url)) {
    $museum_exhibition_footer_background_style = ' style="background-image: url(\'' . esc_url($museum_exhibition_footer_background_url) . '\'); background-repeat: no-repeat; background-size: cover;"';
} else {
    $museum_exhibition_footer_background_style = ' style="background-color: ' . esc_attr($museum_exhibition_footer_background_color) . ';"'; // Updated line
}
?>

</div>
</div>
</div>
</div>

<footer class="site-footer" <?php echo $museum_exhibition_footer_background_style; ?>>
    <?php 
    $museum_exhibition_active_areas = get_theme_mod('museum_exhibition_footer_widget_areas', 4);
    if (
        is_active_sidebar('footer-1') ||
        is_active_sidebar('footer-2') ||
        is_active_sidebar('footer-3') ||
        is_active_sidebar('footer-4')
    ) : ?>
        <div class="footer-t">
            <div class="container">
                <!-- <div class="row wow bounceInUp center delay-1000" data-wow-duration="2s">
                    <?php 
                    for ($museum_exhibition_i = 1; $museum_exhibition_i <= $museum_exhibition_active_areas; $museum_exhibition_i++) {

                        if (is_active_sidebar('footer-' . $museum_exhibition_i)) {

                            $museum_exhibition_col = 12 / $museum_exhibition_active_areas;

                            echo '<div class="col-xl-' . $museum_exhibition_col . ' col-lg-' . $museum_exhibition_col . ' col-md-6 col-sm-6">';
                            dynamic_sidebar('footer-' . $museum_exhibition_i);
                            echo '</div>';
                        }
                    }
                    ?>
                </div> -->
            </div>
        </div>

    <?php else : ?>

        <!-- Default Widget Content -->
        <div class="footer-t">



<div class="contact-info">
    <!-- Email -->
  <div class="contact-item">
    <svg class="contact-icon" width="48" height="48" viewBox="0 0 24 24" fill="#F4A261">
      <path d="M2 4h20v16H2V4zm2 2v.01L12 13l8-6.99V6H4zm16 12V8l-8 7-8-7v10h16z"/>
    </svg>
    <a href="mailto:info@vaciledancestudio.ul">info@vaciledancestudio.ul</a>
  </div>
    <!-- Instagram -->
  <div class="contact-item">
    <svg class="contact-icon" width="48" height="48" viewBox="0 0 24 24" fill="#F4A261">
      <path d="M7.75 2h8.5A5.75 5.75 0 0 1 22 7.75v8.5A5.75 5.75 0 0 1 16.25 22h-8.5A5.75 5.75 0 0 1 2 16.25v-8.5A5.75 5.75 0 0 1 7.75 2zm0 2A3.75 3.75 0 0 0 4 7.75v8.5A3.75 3.75 0 0 0 7.75 20h8.5A3.75 3.75 0 0 0 20 16.25v-8.5A3.75 3.75 0 0 0 16.25 4h-8.5zm9.5 1.5a1 1 0 1 1 0 2 1 1 0 0 1 0-2zM12 7a5 5 0 1 1 0 10 5 5 0 0 1 0-10zm0 2a3 3 0 1 0 0 6 3 3 0 0 0 0-6z"/>
    </svg>
    <a href="https://instagram.com/vaciledancestudio" target="_blank">vaciledancestudio</a>
  </div>


    <!-- Address -->
  <div class="contact-item">
    <svg class="contact-icon" width="48" height="48" viewBox="0 0 24 24" fill="#F4A261">
      <path d="M12 2C8.13 2 5 5.13 5 9c0 5.25 7 13 7 13s7-7.75 7-13c0-3.87-3.13-7-7-7zm0 9.5a2.5 2.5 0 1 1 0-5 2.5 2.5 0 0 1 0 5z"/>
    </svg>
    <span>123 Latin Dance St, City, Country</span>
  </div>

    <!-- Phone -->
  <div class="contact-item">
    <svg class="contact-icon" width="48" height="48" viewBox="0 0 24 24" fill="#F4A261">
      <path d="M6.62 10.79a15.054 15.054 0 0 0 6.59 6.59l2.2-2.2a1 1 0 0 1 1.11-.21c1.2.48 2.5.74 3.85.74a1 1 0 0 1 1 1V20a1 1 0 0 1-1 1C10.07 21 3 13.93 3 5a1 1 0 0 1 1-1h3.5a1 1 0 0 1 1 1c0 1.35.26 2.65.74 3.85a1 1 0 0 1-.21 1.11l-2.41 2.83z"/>
    </svg>
    <a href="tel:+81312345678">+12 345 678 910</a>
  </div>
</div>
</div>



            <div class="container">
                <div class="row wow bounceInUp center delay-1000" data-wow-duration="2s">

                    <?php 
                    // Dynamic column width
                    $museum_exhibition_col = 12 / $museum_exhibition_active_areas;
                    ?>

                    <!-- Archive -->
                    <!-- <aside class="widget widget_archive col-xl-<?php echo $museum_exhibition_col; ?> col-lg-<?php echo $museum_exhibition_col; ?> col-md-6 col-sm-6">
                        <h2 class="widget-title"><?php esc_html_e('Archive List', 'museum-exhibition'); ?></h2>
                        <ul><?php wp_get_archives('type=monthly'); ?></ul>
                    </aside> -->

                    <!-- Recent Posts -->
                    <!-- <aside class="widget widget_recent_posts col-xl-<?php echo $museum_exhibition_col; ?> col-lg-<?php echo $museum_exhibition_col; ?> col-md-6 col-sm-6">
                        <h2 class="widget-title"><?php esc_html_e('Recent Posts', 'museum-exhibition'); ?></h2>
                        <ul>
                            <?php
                            $args = array('post_type' => 'post', 'posts_per_page' => 5);
                            $recent_posts = new WP_Query($args);
                            while ($recent_posts->have_posts()) : $recent_posts->the_post(); ?>
                                <li><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></li>
                            <?php endwhile; wp_reset_postdata(); ?>
                        </ul>
                    </aside> -->

                    <!-- Categories -->
                    <!-- <aside class="widget widget_categories col-xl-<?php echo $museum_exhibition_col; ?> col-lg-<?php echo $museum_exhibition_col; ?> col-md-6 col-sm-6">
                        <h2 class="widget-title"><?php esc_html_e('Categories', 'museum-exhibition'); ?></h2>
                        <ul><?php wp_list_categories(array('title_li' => '')); ?></ul>
                    </aside> -->

                    <!-- Tags -->
                    <!-- <aside class="widget widget_tags col-xl-<?php echo $museum_exhibition_col; ?> col-lg-<?php echo $museum_exhibition_col; ?> col-md-6 col-sm-6">
                        <h2 class="widget-title"><?php esc_html_e('Tags', 'museum-exhibition'); ?></h2>
                        <div class="tag-cloud"><?php wp_tag_cloud(); ?></div>
                    </aside> -->

                </div>
            </div>
        </div>

    <?php endif; ?>

    <?php do_action('museum_exhibition_footer'); ?>

    <?php if ($museum_exhibition_scroll_top) : ?>
        <a id="button">
            <i class="<?php echo esc_attr(get_theme_mod('museum_exhibition_scroll_icon', 'fas fa-arrow-up')); ?>"></i>
        </a>
    <?php endif; ?>

</footer>
</div>
</div>

<?php wp_footer(); ?>

</body>
</html>