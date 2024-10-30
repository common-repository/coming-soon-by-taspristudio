<?php

defined( 'ABSPATH' ) || exit;
/**
 * The core plugin class.
 *
 * This is used to define internationalization, admin-specific hooks, and
 * public-facing site hooks.
 *
 * Also maintains the unique identifier of this plugin as well as the current
 * version of the plugin.
 *
 * @since      1.0.0
 * @package    Csts
 * @subpackage Csts/includes
 * @author     TaspriStudio <contact@tasrpistiudio.com>
 */

 class Csts_Settings {
     /**
      * The real name of this plugin.
      *
      * @access   protected
      * @var      string    $plugin_full_name    The full punctual name of this plugin.
      */
     protected $plugin_full_name;

     /**
      * The ID of this plugin.
      *
      * @var      string    $plugin_name    The ID of this plugin.
      */
     public static $plugin_name = CSTS_NAME;

     /**
      * Csts_Settings constructor.
      *
      * @param string $plugin_full_name The punctual name of the plugin.
      */
     public function __construct( $plugin_full_name ) {
        $this->plugin_full_name = $plugin_full_name;
     }


     public function csts_customization_settings() {
        // Control core classes for avoid errors
        if( class_exists( 'CSF' ) ) {
            // Set a unique slug-like ID
            $prefix = Csts_Settings::$plugin_name;

            // Create customize options
            CSF::createCustomizeOptions( $prefix,array(
                'database'        => 'option',
                'transport'       => 'refresh',
                'capability'      => 'manage_options',
                'save_defaults'   => true,
                'enqueue_webfont' => true,
                'async_webfont'   => false,
                'output_css'      => true,
            ));

            CSF::createSection( $prefix, array(
                'id'    => $prefix . '_settings',
                'title' => $this->plugin_full_name,
            ));

            /**
             * Plugin mode section settings
             */
            CSF::createSection( $prefix, array(
                'parent'        => $prefix . '_settings',
                'title'     => __('Mode', 'csts'),
                'fields'    => array(
                    array(
                        'id'            => 'enable_disable_plugin',
                        'type'          => 'switcher',
                        'title'         => __('Turn on coming soon mode', 'csts'),
                        'default'       => true,
                    ),
                    array(
                        'id'            => 'enable_plugin_edit',
                        'type'          => 'switcher',
                        'title'         => __('Turn on edit mode', 'csts'),
                        'default'       => false,
                    ),
                )
            ));

            /**
             * Seo section
             * 
             * @csts seo
             */
            CSF::createSection( $prefix, array(
                'title'         => __('SEO Meta', 'csts'),
                'parent'        => $prefix . '_settings',
                'fields'        => array(
                    array(
                        'id'            => 'seo_title',
                        'type'          => 'text',
                        'title'         => __('Title','csts'),
                    ),
                    array(
                        'id'            => 'seo_description',
                        'type'          => 'textarea',
                        'title'         => __('Description', 'csts'),
                    ),
                    array(
                        'id'            => 'seo_keywords',
                        'type'          => 'textarea',
                        'title'         => __('Keywords', 'csts'),
                        'desc'          => __('Separate different keywords with trailing `,`', 'csts'),
                    ),
                ),
            ));

            /**
             * Background settings
             */
            CSF::createSection( $prefix, array(
                'title'         => __('Background', 'csts'),
                'parent'        => $prefix . '_settings',
                'fields'        => array(
                    array(
                        'type'                  => 'heading',
                        'content'               => __('Background Settings', 'csts'),
                    ),
                    array(
                        'id'                    => 'page_bg_color',
                        'type'                  => 'background',
                        'background_gradient'   => true,
                        'background_color'      => true,
                        'background_position'   => false,
                        'background_image'      => false,
                        'background_attachment' => false,
                        'background_size'       => false,
                        'background_repeat'     => false,
                        'title'                 => __('Background color', 'csts'),
                        'output'                => '.csts-page-wrapper.page-wrapper',
                    ),
                    array(
                        'id'                    => 'bg_image',
                        'type'                  => 'media',
                        'title'                 =>  __('Background image', 'csts'),
                    ),
                    array(
                        'id'                    => 'bg_image_style',
                        'type'                  => 'background',
                        'background_color'      => false,
                        'background_image'      => false,
                        'title'                 => __('Background image style', 'csts'),
                        'output'                => '.csts-page-wrapper.page-wrapper',
                    ),
                ),
            ));

            CSF::createSection( $prefix, array(
                'title'         => __('Typography', 'csts'),
                'parent'        => $prefix . '_settings',
                'fields'        => array(
                    array(
                        'type'                  => 'heading',
                        'content'               => __('Body typography', 'csts'),
                    ),
                    array(
                        'id'                    => 'body_typography',
                        'type'                  => 'typography',
                        'title'                 => __('Body typography', 'csts'),
                        'output'                => array( '.csts-page-wrapper'),
                    ),
                    array(
                        'type'                  => 'heading',
                        'content'               => __('Heading tags typography', 'csts'),
                    ),
                    array(
                        'id'                    => 'heading_h1',
                        'type'                  => 'typography',
                        'title'                 => __('H1 typography', 'csts'),
                        'output'                => array( '.csts-page-wrapper h1'),
                    ),
                    array(
                        'id'                    => 'heading_h2',
                        'type'                  => 'typography',
                        'title'                 => __('H2 typography', 'csts'),
                        'output'                => array( '.csts-page-wrapper h2'),
                    ),
                    array(
                        'id'                    => 'heading_h3',
                        'type'                  => 'typography',
                        'title'                 => __('H3 typography', 'csts'),
                        'output'                => array( '.csts-page-wrapper h3'),
                    ),
                    array(
                        'id'                    => 'heading_h4',
                        'type'                  => 'typography',
                        'title'                 => __('H4 typography', 'csts'),
                        'output'                => array( '.csts-page-wrapper h4'),
                    ),
                    array(
                        'id'                    => 'heading_h5',
                        'type'                  => 'typography',
                        'title'                 => __('H5 typography', 'csts'),
                        'output'                => array( '.csts-page-wrapper h5'),
                    ),
                    array(
                        'id'                    => 'heading_h6',
                        'type'                  => 'typography',
                        'title'                 => __('H6 typography', 'csts'),
                        'output'                => array( '.csts-page-wrapper h6'),
                    ),
                    array(
                        'type'                  => 'heading',
                        'content'               => 'Page title typography',
                    ),
                    array(
                        'id'                    => 'title_typography',
                        'type'                  => 'typography',
                        'title'                 => __('Page title typography', 'csts'),
                        'output'                => array( '.csts-page-wrapper .s-title h2', '.csts-page-wrapper .coming-soon-content h2' ),
                    ),
                    array(
                        'type'                  => 'heading',
                        'content'               => 'Page content typography',
                    ),
                    array(
                        'id'                    => 'content_typography',
                        'type'                  => 'typography',
                        'title'                 => __('Content typography', 'csts'),
                        'output'                => array('.csts-page-wrapper .s-title p', '.csts-page-wrapper .coming-soon-content p', ),
                    ),
                    array(
                        'type'                  => 'heading',
                        'content'               => __('Button typography', 'csts'),
                    ),
                    array(
                        'id'                    => 'button_typography',
                        'type'                  => 'typography',
                        'title'                 => __('Button typography', 'csts'),
                        'output'                => array('.csts-page-wrapper .newsletter .btn', '.csts-page-wrapper .f-s-btn, .csts-page-wrapper form input[type="submit"], 
                                                            .csts-page-wrapper form input[type="submit"]:hover'),
                    ),
                    array(
                        'id'                    => 'button_bg_color',
                        'type'                  => 'color',
                        'title'                 => __('Button background color', 'csts'),
                        'output'                => array('.csts-page-wrapper .newsletter .btn, .csts-page-wrapper form input[type="submit"]'),
                        'output_mode'           => 'background-color',
                    ),
                )
            ));

            /**
             * Header section settings
             */
            CSF::createSection( $prefix, array(
                'title'         => __('Header', 'csts'),
                'parent'        => $prefix . '_settings',
                'fields'        => array(
                    array(
                        'id'            => 'logo',
                        'type'          => 'media',
                        'title'         => __('Logo', 'csts'),
                    ),
                    array(
                        'id'        => 'logo_width',
                        'type'      => 'number',
                        'unit'      => 'px',
                        'title'         => __('Logo width', 'csts'),
                        'output'        => '.navbar-brand img',
                    ),
                    array(
                        'id'                    => 'menu_typography',
                        'type'                  => 'typography',
                        'title'                 => __('Menu typography', 'csts'),
                        'output'                => array('.csts-page-wrapper .navbar-nav li a'),
                    ),
                    array(
                        'type'                  => 'heading',
                        'content'               => __('Mobile menu', 'csts'),
                    ),
                    array(
                        'id'                    => 'header_background_color',
                        'type'                  => 'background',
                        'background_gradient'   => true,
                        'background_color'      => true,
                        'background_position'   => false,
                        'background_image'      => false,
                        'background_attachment' => false,
                        'background_size'       => false,
                        'background_repeat'     => false,
                        'title'                 => __('Header background color', 'csts'),
                        'default'                         => array(
                            'background-color'              => '#4082f9',
                            'background-gradient-color'     => '#1e67f0',
                            'background-gradient-direction' => 'to bottom',
                        )
                    ),
                    array(
                        'id'            => 'hamburger_button',
                        'type'          => 'color',
                        'title'         => __('Hamburger icon color', 'csts'),
                        'output_mode'   => 'background-color',
                        'default'       => '#fff',
                        'output'        => array('.csts-page-wrapper .menu-toggle span'),
                    ),
                )
            ));

            /**
             * Home page settings
             */
            CSF::createSection( $prefix, array(
                'title'     => 'Home',
                'parent'    => $prefix . '_settings',
                'fields'    => array(
                    array(
                        'id'            => 'home_menu_title',
                        'type'          => 'text',
                        'title'         => __('Menu title','csts'),
                        'default'       => 'Home',
                    ),
                    array(
                        'id'            => 'home_title',
                        'type'          => 'text',
                        'title'         => __('Page title','csts'),
                        'default'       => 'Home',
                    ),
                    array(
                        'id'            => 'home_description',
                        'type'          => 'wp_editor',
                        'title'         => __('Page description', 'csts'),
                        'default'       => "Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book."
                    ),
                    array(
                        'type'          => 'heading',
                        'content'       => __( 'Countdown settings', 'csts' ),
                    ),
                    array(
                        'id'            => 'count_down_date',
                        'type'          => 'date',
                        'title'         => __('Date', 'csts'),
                        'default'       => $this->get_date_current_time('y'),
                    ),
                    array(
                        'id'            => 'count_down_time',
                        'type'          => 'text',
                        'title'         => __( 'Time', 'csts' ),
                        'desc'          => __( 'Format: (h:m:s)(00:00:00)', 'csts' ),
                        'default'       => $this->get_date_current_time('t')
                    ),
                    array(
                        'type'                  => 'heading',
                        'content'               => __('Countdown Typography', 'csts'),
                    ),
                    array(
                        'id'                    => 'countdown_count_typography',
                        'type'                  => 'typography',
                        'title'                 => __('Countdown count typography', 'csts'),
                        'output'                => array('.csts-page-wrapper .countdown-box .number'),
                    ),
                    array(
                        'id'                    => 'countdown_title_typography',
                        'type'                  => 'typography',
                        'title'                 => __('Countdown title typography', 'csts'),
                        'output'                => array('.csts-page-wrapper .countdown-box span'),
                    ),
                ),
            ));

            /**
             * Service page settings
             */
            CSF::createSection( $prefix, array(
                'title'         => __('Service', 'csts'),
                'parent'        => $prefix . '_settings',
                'fields'        => array(
                    array(
                        'id'            => 'service_enable_disable',
                        'type'          => 'switcher',
                        'title'         => __('Active', 'csts'),
                        'default'       => false,
                    ),
                    array(
                        'id'            => 'service_menu_title',
                        'type'          => 'text',
                        'title'         => __('Menu title','csts'),
                        'default'       => 'Service',
                    ),
                    array(
                        'id'            => 'service_title',
                        'type'          => 'text',
                        'title'         => __('Page title','csts'),
                        'default'       => 'Service',
                    ),
                    array(
                        'id'            => 'service_description',
                        'type'          => 'wp_editor',
                        'title'         => __('Page description', 'csts'),
                        'default'       => 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry standard dummy text ever since the 1500s.',
                    ),
                    array(
                        'id'        => 'service_box',
                        'type'      => 'repeater',
                        'title'     => __('Service items'),
                        'fields'    => array(
                            array(
                                'id'            => 'icon',
                                'type'          => 'icon',
                                'title'         => __('Icon', 'csts'),
                            ),
                            array(
                                'id'            => 'title',
                                'type'          => 'text',
                                'title'         => __( 'Title', 'csts' ),
                            ),
                            array(
                                'id'            => 'description',
                                'type'          => 'textarea',
                                'title'         => __( 'Short Description', 'csts' ),
                            ),
                    
                        ),
                    ),
                    array(
                        'type'                  => 'heading',
                        'content'               => __('Typography', 'csts'),
                    ),
                    array(
                        'id'                    => 'service_item_background_color',
                        'type'                  => 'background',
                        'background_gradient'   => true,
                        'background_color'      => true,
                        'background_position'   => false,
                        'background_image'      => false,
                        'background_attachment' => false,
                        'background_size'       => false,
                        'background_repeat'     => false,
                        'title'                 => __('Card background color', 'csts'),
                        'output_mode'           => 'background-color',
                        'default'               => '#fff',
                        'output'                => array('.csts-page-wrapper .service-item::before')
                    ),
                    array(
                        'id'                    => 'service_item_background_hover_color',
                        'type'                  => 'background',
                        'background_gradient'   => true,
                        'title'                 => __('Card background hover color', 'csts'),
                        'output_mode'           => 'background',
                        'background_color'      => true,
                        'background_position'   => false,
                        'background_image'      => false,
                        'background_attachment' => false,
                        'background_size'       => false,
                        'background_repeat'     => false,
                        'default'               => '#588ff3',
                        'output'                => array('.csts-page-wrapper .service-item::after'),
                    ),
                    array(
                        'id'                    => 'service_item_icon_typography',
                        'type'                  => 'typography',
                        'font_size'             => true,
                        'font_family'           => false,
                        'font_weight'           => false,
                        'font_style'            => false,
                        'line_height'           => false,
                        'letter_spacing'        => false,
                        'text_align'            => false,
                        'text_transform'        => false,
                        'title'                 => __('Card icon typography', 'csts'),
                        'output'                => array('.csts-page-wrapper .service-item .item-icon i'),
                    ),
                    array(
                        'id'                    => 'service_item_icon_hover_color',
                        'type'                  => 'color',
                        'title'                 => __('Card icon hover color', 'csts'),
                        'output_mode'           => 'color',
                        'default'               => '#fff',
                        'output'                => '.csts-page-wrapper .service-item:hover i',
                    ),
                    array(
                        'id'                    => 'service_item_title_typography',
                        'type'                  => 'typography',
                        'title'                 => __('Card title typography', 'csts'),
                        'output'                => '.csts-page-wrapper .service-item .item-title',
                    ),
                    array(
                        'id'                    => 'service_item_title_hover_color',
                        'type'                  => 'color',
                        'title'                 => __('Card title hover color', 'csts'),
                        'output_mode'           => 'color',
                        'default'               => '#fff',
                        'output'                => array('.csts-page-wrapper .service-item:hover .item-title'),
                    ),
                    array(
                        'id'                    => 'service_item_content_typography',
                        'type'                  => 'typography',
                        'title'                 => __('Card content typography', 'csts'),
                        'output'                => array('.csts-page-wrapper .service-item p'),
                    ),
                    array(
                        'id'                    => 'service_item_content_hover_color',
                        'type'                  => 'color',
                        'title'                 => __('Card content hover color', 'csts'),
                        'output_mode'           => 'color',
                        'default'               => '#fff',
                        'output'                => array('.csts-page-wrapper .service-item:hover p'),
                    ),
                )
            ));

            /**
             * Blog page settings
             * 
             * @csts pages
             */
            CSF::createSection( $prefix, array(
                'title'         => __('Blog', 'csts'),
                'parent'        => $prefix . '_settings',
                'fields'        => array(
                    array(
                        'id'            => 'blog_enable_disable',
                        'type'          => 'switcher',
                        'title'         => __('Active', 'csts'),
                        'default'       => true,
                    ),
                    array(
                        'id'            => 'blog_menu_title',
                        'type'          => 'text',
                        'title'         => __('Menu title','csts'),
                        'default'       => __('Blog', 'csts'),
                    ),
                    array(
                        'id'            => 'blog_title',
                        'type'          => 'text',
                        'title'         => __('Page title','csts'),
                        'default'       => __('Blog', 'csts'),
                    ),
                    array(
                        'id'            => 'blog_description',
                        'type'          => 'wp_editor',
                        'title'         => __('Page description', 'csts'),
                        'default'       => 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industrys standard dummy text ever since the 1500s',
                    ),
                    array(
                        'id'            => 'blog_category',
                        'type'          => 'select',
                        'title'         => __('Post category', 'csts'),
                        'placeholder'   => __('Select post category', 'csts'),
                        'options'       => 'categories',
                        'query_args'    => array(
                            'taxonomy'  => 'category',
                        ),
                        'default'       => '1',
                    ),
                    array(
                        'type'                  => 'heading',
                        'content'               => __('Blog typography', 'csts'),
                    ),
                    array(
                        'id'                    => 'blog_meta_typography',
                        'type'                  => 'typography',
                        'title'                 => __('Post meta typography', 'csts'),
                        'output'                => array('.csts-page-wrapper .blog-post .post-des .post-meta .meta-category'),
                    ),
                    array(
                        'id'                    => 'blog_title_typography',
                        'type'                  => 'typography',
                        'title'                 => __('Title typography', 'csts'),
                        'output'                => array('.csts-page-wrapper .blog-post .post-title, .csts-page-wrapper .blog-post .post-title a'),
                    ),
                    array(
                        'id'                    => 'blog_overly_btn_typography',
                        'type'                  => 'typography',
                        'title'                 => __('Button typography', 'csts'),
                        'output'                => array('.csts-page-wrapper .blog-post .post-thumb .overlay-btn a,'),
                    ),
                    array(
                        'id'                    => 'blog_overly_btn_bg_color',
                        'type'                  => 'color',
                        'title'                 => __('Button background color', 'csts'),
                        'output_mode'           => 'background-color',
                        'output'                => array('.csts-page-wrapper .blog-post .post-thumb .overlay-btn a'),
                    ),
                    array(
                        'id'                    => 'blog_bg_color',
                        'type'                  => 'background',
                        'background_gradient'   => true,
                        'background_color'      => true,
                        'background_position'   => false,
                        'background_image'      => false,
                        'background_attachment' => false,
                        'background_size'       => false,
                        'background_repeat'     => false,
                        'title'                 => __('Card background color', 'csts'),
                        'output'                => array('.csts-page-wrapper .blog-post'),
                    ),
                    array(
                        'id'                    => 'blog_hover_bg_color',
                        'type'                  => 'background',
                        'background_gradient'   => true,
                        'background_color'      => true,
                        'background_position'   => false,
                        'background_image'      => false,
                        'background_attachment' => false,
                        'background_size'       => false,
                        'background_repeat'     => false,
                        'title'                 => __('Card hover background color', 'csts'),
                        'output'                => array('.csts-page-wrapper .blog-post .post-thumb:after'),
                    ),
                    array(
                        'type'                  => 'heading',
                        'content'               => __('Single blog Typography', 'csts'),
                    ),
                    array(
                        'id'                    => 'single_blog_date_typography',
                        'type'                  => 'typography',
                        'title'                 => __('Date typography', 'csts'),
                        'output'                => array('.single-blog-popup-wrapper .single-blog-content .title span'),
                    ),
                    array(
                        'id'                    => 'single_blog_title_typography',
                        'type'                  => 'typography',
                        'title'                 => __('Title typography', 'csts'),
                        'output'                => array('.single-blog-popup-wrapper .single-blog-content .title h1'),
                    ),
                )
            ));

            /**
             * Contact page settings
             */
            CSF::createSection( $prefix, array(
                'title'         => __('Contact', 'csts'),
                'parent'        => $prefix . '_settings',
                'fields'        => array(
                    array(
                        'id'            => 'contact_enable_disable',
                        'type'          => 'switcher',
                        'title'         => __('Active', 'csts'),
                        'default'       => false,
                    ),
                    array(
                        'id'            => 'contact_menu_title',
                        'type'          => 'text',
                        'title'         => __('Menu title','csts'),
                        'default'       => 'Contact',
                    ),
                    array(
                        'id'            => 'contact_title',
                        'type'          => 'text',
                        'title'         => __('Page title','csts'),
                        'default'       => 'Contact',
                    ),
                    array(
                        'id'            => 'contact_description',
                        'type'          => 'wp_editor',
                        'title'         => __('Page description', 'csts'),
                        'default'       => 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry standard dummy text ever since the 1500s.',
                    ),
                )
            ));

            /**
             * Footer section settings
             */

            $footer_setting_fields = array(
                array(
                    'id'            => 'copyright_text',
                    'type'          => 'text',
                    'title'         => __('Copyright text', 'csts'),
                    'default'       => '©2020 Copyright.  All rights reserved'
                ),
                array(
                    'id'        => 'footer_social_icons',
                    'type'      => 'repeater',
                    'title'     => __('Social icons'),
                    'fields'    => array(
                        array(
                            'id'        => 'social_icon',
                            'type'      => 'icon',
                            'title'     => 'Icon',
                        ),
                        array(
                            'id'        => 'social_icon_link',
                            'type'      => 'text',
                            'title'     => 'Link',
                        ),
                    ),
                    'default'   => array(
                        array(
                            'social_icon' => 'fab fa-facebook-f',
                            'social_icon_link' => '#',
                        ),
                        array(
                            'social_icon' => 'fab fa-twitter',
                            'social_icon_link' => '#',
                        ),
                        array(
                            'social_icon' => 'fab fa-youtube',
                            'social_icon_link' => '#',
                        )
                    ),
                ),
                array(
                    'type'                  => 'heading',
                    'content'               => 'Footer typography',
                ),
                array(
                    'id'                    => 'footer_typography',
                    'type'                  => 'typography',
                    'title'                 => __('Footer typography', 'csts'),
                    'output'                => array('.csts-page-wrapper .social-profile li a i', '.csts-page-wrapper .copyright'),
                ),
            );
            CSF::createSection( $prefix, array(
                'title'             => __('Footer', 'csts'),
                'parent'            => $prefix . '_settings',
                'fields'            => apply_filters( 'generate_footer_settings_fields', $footer_setting_fields ),
            ));

            /**
             * Import export settings
             */
            CSF::createSection($prefix, array(
                'title'             => __('Import / Export', 'csts'),
                'parent'            => $prefix . '_settings',
                'fields'            => array(
                    array(
                        'type' => 'backup',
                    )
                ),
            ));
        }
    }

    // Get plugin installed time
    public function get_date_current_time( $date_time ) {
        if($date_time == 'y') {
            return current_datetime()->format('m/d/Y');
        } elseif($date_time == 't') {
            return current_datetime()->format('h:m:s');
        } else {
            return false;
        }
    }

     /**
     * Return plugin settings.
     *
     * @param string $key Key of the required settings.
     * @param string $default_value Default value of the required settings.
     *
     * @return string|array Settings value.
     */
    public static function get( $key = '', $default_value = null ) {
        $options = get_option( Csts_Settings::$plugin_name );

        return ( isset( $options[$key] ) ) ? $options[$key] : $default_value;
    }

    /**
     * Return plugin all settings.
     *
     * @return string|array Settings values.
     */
    public static function get_settings() {
        return get_option( Csts_Settings::$plugin_name );
    }

 }