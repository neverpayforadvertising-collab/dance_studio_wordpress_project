<?php
/**
 * Banner Section
 * 
 * @package museum_exhibition
 */

$museum_exhibition_slider = get_theme_mod( 'museum_exhibition_slider_setting', false );
$museum_exhibition_args   = array(
  'post_type'      => 'post',
  'post_status'    => 'publish',
  'category_name'  => get_theme_mod( 'museum_exhibition_blog_slide_category' ),
  'posts_per_page' => 6,
); ?>

<?php if ( $museum_exhibition_slider ) { ?>
  <div class="banner-main">
    <div class="test">
        <div class="container">
            <div class="owl-carousel banner-slider">

                <?php
                $musem_art_arr_posts = new WP_Query( $museum_exhibition_args );

                if ( $musem_art_arr_posts->have_posts() ) :
                    while ( $musem_art_arr_posts->have_posts() ) :
                        $musem_art_arr_posts->the_post();
                ?>
                <div class="item">
                    <div class="row align-items-center">
                        <div class="col-lg-6 col-md-12">
                            <div class="banner_box wow bounceInDown" data-wow-duration="2s">
                                <div class="img-content">
                                    <h3 class="my-1">
                                        <a href="<?php the_permalink(); ?>">
                                            <?php the_title(); ?>
                                        </a>
                                    </h3>
                                    <p class="mb-0">
                                        <?php echo wp_trim_words( get_the_content(), 50 ); ?>
                                    </p>
                                </div>
                                <?php if ( get_theme_mod( 'museum_exhibition_slider_btn_text' ) ) : ?>
                                    <div class="slide-btn-green mt-4">
                                        <a href="<?php echo esc_url( get_theme_mod( 'museum_exhibition_slider_btn_url' ) ); ?>">
                                            <?php echo esc_html( get_theme_mod( 'museum_exhibition_slider_btn_text' ) ); ?>
                                        </a>
                                    </div>
                                <?php endif; ?>
                            </div>
                        </div>
                        <div class="col-lg-6 col-md-12 banner_inner_box_img position-relative p-0">
                            <div class="single-slide position-relative wow zoomIn" data-wow-duration="2s">
                                <?php if (has_post_thumbnail()): ?>
                                    <?php the_post_thumbnail(); ?>
                                <?php else: ?>
                                    <div class="banner_inner_box">
                                        <img src="<?php echo get_stylesheet_directory_uri() . '/images/default.png'; ?>" alt="<?php esc_attr_e('Image', 'museum-exhibition'); ?>">
                                    </div>
                                <?php endif; ?>
                            </div>
                            <?php if ( get_theme_mod( 'museum_exhibition_slider_short_title' ) ) : ?>
                                <h1 class="extra-title"><?php echo esc_html( get_theme_mod( 'museum_exhibition_slider_short_title' ) ); ?></h5>
                            <?php endif; ?>

                            <?php if ( get_theme_mod( 'museum_exhibition_slider_text_extra' ) ) : ?>
                                <p class="extra-content"><?php echo esc_html( get_theme_mod( 'museum_exhibition_slider_text_extra' ) ); ?></h5>
                            <?php endif; ?>
                        </div>
                    </div>
                </div>
                <?php
                    endwhile;
                    wp_reset_postdata();
                endif;
                ?>

            </div>
        </div>
    </div>
  </div>
<?php } ?>