<?php 
/**
 * Template part for displaying Featured About Section
 *
 * @package Museum Exhibition
 */

$museum_exhibition_about      = get_theme_mod( 'museum_exhibition_about_setting',false );
$museum_exhibition_number_of_featured_mission_items    = get_theme_mod( 'museum_exhibition_number_of_featured_mission_items' ); ?>

<?php if ( $museum_exhibition_about ){?>
<div id="about-section" class="section-content py-5 wow zoomInUp" data-wow-duration="2s">
        <?php
         $museum_exhibition_featured_mission_section_title = get_theme_mod( 'museum_exhibition_featured_mission_section_title' );
         $museum_exhibition_featured_mission_section_text = get_theme_mod( 'museum_exhibition_featured_mission_section_text' );
         ?>
        <div class="section-title mb-4 text-center container">
            <?php if( $museum_exhibition_featured_mission_section_title ) { ?>
                <h5><?php echo esc_html($museum_exhibition_featured_mission_section_title); ?></h3>
            <?php } ?>
            <?php if( $museum_exhibition_featured_mission_section_text ) { ?>
                <h3><?php echo esc_html($museum_exhibition_featured_mission_section_text); ?></h3>
            <?php } ?>
        </div>
       
        <div class="tabs">
            <ul class="tabs-nav">
                <?php for( $museum_exhibition_i=1; $museum_exhibition_i<=$museum_exhibition_number_of_featured_mission_items; $museum_exhibition_i++ ) : ?>
                    <li class="tabs-nav-box"><a href="<?php echo('#tab-').$museum_exhibition_i ?>"><?php echo esc_html( get_theme_mod( 'museum_exhibition_featured_mission_section_tab_'.$museum_exhibition_i ) ); ?></a></li>
                <?php endfor; ?>
            </ul>
            <div class="tabs-stage">
                <?php for( $museum_exhibition_i=1; $museum_exhibition_i<=$museum_exhibition_number_of_featured_mission_items; $museum_exhibition_i++ ) : ?>
                    <div id="<?php echo('tab-').$museum_exhibition_i ?>" class="featured-mission-box">
                        <?php 
                            $museum_exhibition_catergory_name = get_theme_mod('museum_exhibition_trending_post_slider_args_' . $museum_exhibition_i);
                            $museum_exhibition_args = array(
                                'post_type' => 'post', 
                                'category_name' => $museum_exhibition_catergory_name, 
                                'posts_per_page' => 3, 
                                'ignore_sticky_posts' => true,
                            );?>
                            <div class="row container m-auto g-3">
                            <?php
                            $museum_exhibition_loop = new WP_Query($museum_exhibition_args);
                            if ( $museum_exhibition_loop->have_posts() ) :
                                $museum_exhibition_count = 0;
                                while ($museum_exhibition_loop->have_posts()) : $museum_exhibition_loop->the_post();
                                    $museum_exhibition_count++;
                                    if ( $museum_exhibition_count == 1 ) {
                                        $museum_exhibition_col_class = 'col-lg-6 col-md-6 align-self-center';
                                    } else {
                                        $museum_exhibition_col_class = 'col-lg-3 col-md-3 align-self-center another-div-image'; 
                                    }
                            ?>
                                <div class="<?php echo $museum_exhibition_col_class; ?>">
                                    <div class="box">
                                        <div class="image-container">
                                            <?php
                                            if ( has_post_thumbnail() ) {
                                                the_post_thumbnail('full', array('class'=>'img-fluid'));
                                            } else {
                                                ?>
                                                <img src="<?php echo get_stylesheet_directory_uri() . '/images/breadcrumb.png'; ?>" class="img-fluid">
                                                <?php
                                            }
                                            ?>
                                        </div>
                                        <div class="box-content">
                                            <h4 class="banner-title"><?php the_title();?></h4>
                                            <a class="banner-btn" href="<?php the_permalink(); ?>"><?php echo esc_html('Read More','museum-exhibition'); ?></a>
                                        </div>
                                    </div>
                                </div>
                            <?php
                                endwhile;
                            endif;
                            ?>
                            </div>
                    </div>
                <?php endfor; ?>
            </div>
        </div>
</div>
<?php } ?>