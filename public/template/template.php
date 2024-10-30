<?php
    require_once CSTS_DIR . 'includes/class-csts-settings.php';
    $settings = Csts_Settings::get_settings();
?>

<!DOCTYPE html>
<html class="no-js no-svg" <?php language_attributes(); ?>>
<head>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="<?php echo esc_html($settings['seo_description']); ?>">
    <meta name="keywords" content="<?php echo esc_html($settings['seo_keywords']); ?>">
    <title><?php echo esc_html($settings['seo_title']); ?></title>
    <?php wp_head(); ?>
    <?php
        if( !empty($settings["bg_image"]["url"]) ) {
            $background_image = 'background-image:url('.$settings["bg_image"]["url"].')';
        } else {
            $background_image = '';
        }
        if( !empty( $settings["menu_typography"]['color'] ) ) {
            $menu_bar_border_color = 'background-color:'.$settings["menu_typography"]['color'].';';
        } else {
            $menu_bar_border_color = '';
        }
        if( !empty( $settings["blog_meta_typography"]['text-align'] ) ) {
            $blog_meta_text_alignment = 'text-align:'.$settings["blog_meta_typography"]['text-align'].';';
        } else {
            $blog_meta_text_alignment = 'text-align:left;';
        }
        echo sprintf('<style>
            .csts-page-wrapper .navbar-nav li a:after{%1$s}
            .csts-page-wrapper.page-wrapper {%2$s}
            .csts-page-wrapper .blog-post .post-meta {%3$s}
        </style>', $menu_bar_border_color,$background_image,$blog_meta_text_alignment
        );
    echo '<style>
        @media screen and (max-width: 991.98px) {
            .csts-page-wrapper nav.navbar {
                background: linear-gradient('.$settings["header_background_color"]["background-gradient-direction"].', '.$settings["header_background_color"]["background-color"].' 0, '.$settings["header_background_color"]["background-gradient-color"].' 100%);
                padding-top: 10px;
            }
        }
    </style>';
    ?>
</head>

<body data-spy="click" data-target=".navbar-nav">
    <!-- Single Blog popup wrapper -->
    <div class="single-blog-popup-wrapper">
        <div class="close-button">
            <img src="<?php echo esc_url(CSTS_DIR_URI . 'public/images/cancel.png'); ?>" alt="">
        </div>
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <div class="single-blog-content">
                        <div class="title">
                            <span></span>
                            <h1></h1>
                        </div>
                        <p></p>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Loading -->
    <div class="loading">
        <img src="<?php echo esc_url(CSTS_DIR_URI . 'public/images/preview.gif'); ?>" alt="loading-img">
    </div>
    <!-- End Single Blog Popup wrapper -->
    <div class="csts-page-wrapper  page-wrapper">
        <header class="header">
            <nav class="navbar navbar-expand-lg">
                <div class="container">
                    <?php if( !empty( $settings['logo']['url'] ) ) { ?>
                        <a class="navbar-brand" href="#<?php echo esc_html(str_replace(' ', '-', strtolower($settings["home_menu_title"]))); ?>">
                            <img src="<?php echo $settings['logo']['url']; ?>" alt="">
                        </a>
                    <?php }else { ?>
                        <a class="navbar-brand" href="#<?php echo str_replace(' ', '-', strtolower($settings["home_menu_title"])); ?>">
                            <img src="<?php echo esc_url(CSTS_DIR_URI . 'public/images/logo.png'); ?>" alt="logo">
                        </a>
                    <?php } ?>
                    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#main-nav" aria-controls="main-nav" aria-expanded="false" aria-label="Toggle navigation">
                        <div class="menu-toggle">
                            <div class="hamburger">
                                <span></span>
                                <span></span>
                                <span></span>
                            </div>
                            <div class="hamburger-cross">
                                <span></span>
                                <span></span>
                            </div>
                        </div>
                    </button>
                    <div class="collapse navbar-collapse" id="main-nav">
                        <ul class="navbar-nav ml-auto">
                            <!-- Home -->
                            <?php
                                echo '<li class="nav-item active">';
                                echo sprintf(
                                        '<a class="nav-link" href="#%1$s"> %2$s</a>',
                                        str_replace(' ', '-', strtolower($settings["home_menu_title"])),
                                        $settings["home_menu_title"]
                                );
                                echo '</li>';
                            ?>

                            <!-- Service -->
                            <?php
                                if( $settings['service_enable_disable'] == "1" && !empty( $settings["service_menu_title"] ) ) {
                                    echo '<li class="nav-item">';
                                    echo sprintf(
                                        '<a class="nav-link" href="#%1$s"> %2$s</a>',
                                        str_replace(' ', '-', strtolower($settings["service_menu_title"])),
                                        $settings["service_menu_title"]
                                    );
                                    echo '</li>';
                                }
                            ?>

                            <!-- Blog -->
                            <?php
                                if( $settings['blog_enable_disable'] == "1" && !empty( $settings["blog_menu_title"] ) ) {
                                    echo '<li class="nav-item">';
                                    echo sprintf(
                                        '<a class="nav-link" href="#%1$s"> %2$s</a>',
                                        str_replace(' ', '-', strtolower($settings["blog_menu_title"])),
                                        $settings["blog_menu_title"]
                                    );
                                    echo '</li>';
                                }
                            ?>

                            <!-- Contact -->
                            <?php
                                if( $settings['contact_enable_disable'] == "1" && !empty( $settings["contact_menu_title"] ) ) {
                                    echo '<li class="nav-item">';
                                    echo sprintf(
                                        '<a class="nav-link" href="#%1$s"> %2$s</a>',
                                        str_replace(' ', '-', strtolower($settings["contact_menu_title"])),
                                        $settings["contact_menu_title"]
                                    );
                                    echo '</li>';
                                }
                            ?>
                        </ul>
                    </div>
                </div>
            </nav>
        </header>
        <!-- header -->
        <div class="main-content">
            <!-- Home section -->
            <div class="countdown-area toggle-section show" id="<?php echo esc_html(str_replace(' ', '-', strtolower($settings["home_menu_title"]))); ?>">
                <div class="section-inner-wrapper">
                    <div class="container">
                        <div class="row align-items-center">
                            <?php

                                $string = str_replace(' ', '-', $settings['count_down_date']); // Replaces all spaces with hyphens.
                                $date = preg_replace('/[^A-Za-z0-9\-]/', '', $string); // Removes special chars
                                $date_arr = str_split ( $date, 2 );

                                if( !empty( $settings['count_down_date'] ) ) {
                                    echo '<div class="col">
                                            <div class="countdown-timer">
                                                <div class="countdown" data-countdown="'.esc_html($date_arr[2]).''.esc_html($date_arr[3]).'-'.esc_html($date_arr[0]).'-'.esc_html($date_arr[1]).' '.esc_html($settings['count_down_time']).'"></div>
                                            </div>
                                        </div>';
                                }
                            ?>
                            <div class="col">
                                <div class="coming-soon-content">
                                    <h2><?php echo wp_kses_post($settings['home_title']); ?></h2>
                                    <p><?php echo do_shortcode($settings['home_description']); ?></p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Service section -->
            <div class="services toggle-section" id="<?php echo esc_html(str_replace(' ', '-', strtolower($settings["service_menu_title"]))); ?>">
                <div class="section-inner-wrapper">
                    <div class="container">
                        <div class="row">
                            <div class="col-12">
                                <div class="s-title">
                                    <h2><?php echo wp_kses_post($settings['service_title']); ?></h2>
                                    <p><?php echo wp_kses_post($settings['service_description']); ?></p>
                                </div>
                            </div>
                            <?php 
                            if( !empty( $settings['service_box'] ) ):
                                foreach( $settings['service_box'] as $item ): ?>
                                <div class="col-lg-3 col-sm-6 mb-5">
                                    <div class="service-item">
                                        <div class="item-icon">
                                        <?php
                                            if( $item['icon'] == 0 ): ?>
                                                <i class="<?php echo esc_html($item['icon']); ?>" ></i>
                                            <?php endif; ?>
                                        </div>
                                        <h4 class="item-title"><?php echo esc_html($item['title']); ?></h4>
                                        <p><?php echo esc_html($item['description']); ?></p>
                                    </div>
                                </div>
                            <?php endforeach; ?>
                            <?php endif; ?>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Blog section -->
            <div class="blog toggle-section" id="<?php echo esc_html(str_replace(' ', '-', strtolower($settings["blog_menu_title"]))); ?>">
                <div class="section-inner-wrapper">
                    <div class="container">
                        <div class="row">
                            <div class="col-12">
                                <div class="s-title">
                                    <h2><?php echo wp_kses_post($settings["blog_title"]); ?></h2>
                                    <p><?php echo wp_kses_post($settings["blog_description"]); ?></p>
                                </div>
                            </div>
                            <?php
                            $query = new WP_Query(
                                    array( 
                                        'post_type'         => 'post',
                                        'post_status'       => 'publish',
                                        'cat'               => $settings['blog_category']
                                    ) 
                                ); ?>
                            <?php
                            
                            while ( $query->have_posts() ) {
                                $query->the_post();
                                $featured_img_url = get_the_post_thumbnail_url($query->post->ID, 'full');

                                echo '
                                    <div class="col-lg-3">
                                        <div class="blog-post" data-id="'.esc_html(get_the_id()).'">
                                            <div class="post-thumb">
                                                <img src="'.esc_url($featured_img_url).'">
                                                <div class="overlay-btn">
                                                    <a data-id="'.esc_html(get_the_id()).'" href="#">'.__('Read More', 'csts').'</a>
                                                </div>
                                            </div>
                                            <div class="post-des">
                                                <div class="post-meta">
                                                    <span class="meta-category">';
                                                    $i = 1;
                                                    $total_category = count(get_the_terms( get_the_id(), 'category' ));
                                                    foreach ( get_the_terms( get_the_id(), 'category' ) as $key => $category ) {
                                                        $separator = ', ';
                                                        if( $total_category == $i ) {
                                                        $separator = '';
                                                        }
                                                        echo esc_html($category->name.$separator);
                                                        $i++;
                                                    }
                                                echo ' </span>
                                                </div>
                                                <h2 class="post-title">' .esc_html(get_the_title()). '</h2>
                                            </div>
                                        </div>
                                    </div>
                                ';
                            } ?>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Contact section -->
            <div class="contact toggle-section" id="<?php echo esc_html(str_replace(' ', '-', strtolower($settings["contact_menu_title"]))); ?>">
                <div class="section-inner-wrapper">
                    <div class="container">
                        <div class="row">
                            <div class="col-lg-8">
                                <div class="s-title">
                                    <h2><?php echo wp_kses_post($settings["contact_title"]); ?></h2>
                                    <p><?php echo do_shortcode(wp_kses_post($settings["contact_description"])); ?></p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Footer section -->
        <footer class="footer">
            <div class="container">
                <div class="row">
                    <?php if( !empty( $settings['copyright_text'] ) ): ?>
                        <div class="col-md-4 col-lg-4">
                            <p class="copyright"><?php echo esc_html($settings['copyright_text']); ?></p>
                        </div>
                    <?php endif; ?>

                    <div class="col-md-4 col-lg-4">
                        <?php echo wp_kses_post(apply_filters( 'white_label_filter', '<p class="copyright" id="csts_credit">Made with love by BoomDevs</p>'  )); ?>
                    </div>
                    <?php if( !empty( $settings['footer_social_icons'] ) ): ?>
                        <div class="col-md-4 col-lg-4 ms-auto">
                            <ul class="social-profile">
                                <?php foreach( $settings['footer_social_icons'] as $item ): ?>
                                    <li>
                                        <a href="<?php echo esc_url($item['social_icon_link']); ?>">
                                            <i class="<?php echo esc_html($item['social_icon']); ?>"></i>
                                        </a>
                                    </li>
                                <?php endforeach; ?>
                            </ul>
                        </div>
                    <?php endif; ?>
                </div>
            </div>
        </footer>
    </div>
    <!-- Include footer -->
    <?php wp_footer(); ?>
</body>
