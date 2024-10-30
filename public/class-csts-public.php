<?php

/**
 * The public-facing functionality of the plugin.
 *
 * @link       https://taspristudio.com/product/ts-wordpress-coming-soon
 * @since      1.0.0
 *
 * @package    Csts
 * @subpackage Csts/public
 */

/**
 * The public-facing functionality of the plugin.
 *
 * Defines the plugin name, version, and two examples hooks for how to
 * enqueue the public-facing stylesheet and JavaScript.
 *
 * @package    Csts
 * @subpackage Csts/public
 * @author     TaspriStudio <contact@tasrpistiudio.com>
 */
class Csts_Public {

	/**
	 * The ID of this plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 * @var      string    $plugin_name    The ID of this plugin.
	 */
	private $plugin_name;

	/**
	 * The version of this plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 * @var      string    $version    The current version of this plugin.
	 */
	private $version;

	/**
	 * Initialize the class and set its properties.
	 *
	 * @since    1.0.0
	 * @param      string    $plugin_name       The name of the plugin.
	 * @param      string    $version    The version of this plugin.
	 */
	public function __construct( $plugin_name, $version ) {

		$this->plugin_name = $plugin_name;
		$this->version = $version;

	}

	/**
	 * Register the stylesheets for the public-facing side of the site.
	 *
	 * @since    1.0.0
	 */
	public function enqueue_styles() {

		/**
		 * This function is provided for demonstration purposes only.
		 *
		 * An instance of this class should be passed to the run() function
		 * defined in Csts_Loader as all of the hooks are defined
		 * in that particular class.
		 *
		 * The Csts_Loader will then create the relationship
		 * between the defined hooks and the functions defined in this
		 * class.
		 */

		// Default font
        wp_enqueue_style(
            $this->plugin_name . '-poppins',
            'https://fonts.googleapis.com/css?family=Poppins:100,200,300,300i,400,400i,500,600,700,800,900',
            array(), $this->version, 'all'
        );

        // Enqueue Bootstrap
		wp_enqueue_style( $this->plugin_name . '-bootstrap', plugin_dir_url( __FILE__ ) . 'css/bootstrap.min.css', array(), $this->version, 'all' );

		// Enqueue fontawesome
		wp_enqueue_style( $this->plugin_name . '-fa5', 'https://use.fontawesome.com/releases/v5.13.0/css/all.css', array(), '5.13.0', 'all' );

        // Enqueue default css
        wp_enqueue_style( $this->plugin_name . '-style', plugin_dir_url( __FILE__ ) . 'css/style.min.css', array(), $this->version, 'all' );

        // Enqueue Responsive
		wp_enqueue_style( $this->plugin_name . '-responsive', plugin_dir_url( __FILE__ ) . 'css/responsive.min.css', array(), $this->version, 'all' );
	}
	
	/**
	 * Register the JavaScript for the public-facing side of the site.
	 *
	 * @since    1.0.0
	 */
	public function enqueue_scripts() {

		/**
		 * This function is provided for demonstration purposes only.
		 *
		 * An instance of this class should be passed to the run() function
		 * defined in Csts_Loader as all of the hooks are defined
		 * in that particular class.
		 *
		 * The Csts_Loader will then create the relationship
		 * between the defined hooks and the functions defined in this
		 * class.
		 */

        wp_enqueue_script( 'jquery' );

        //	Enqueue bootstrap js
        wp_enqueue_script( $this->plugin_name . '-bootstrap', plugin_dir_url( __FILE__ ) . 'js/bootstrap.min.js', array( 'jquery' ), $this->version, true );

        // Enqueue proper js
        wp_enqueue_script( $this->plugin_name . '-popper', plugin_dir_url( __FILE__ ) . 'js/popper.min.js', array( 'jquery' ), $this->version, true );

        // Enqueue countdown js
        wp_enqueue_script( $this->plugin_name . '-countdown', plugin_dir_url( __FILE__ ) . 'js/jquery.countdown.min.js', array( 'jquery' ), $this->version, true );

        // Enqueue custom js
		wp_enqueue_script( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'js/csts-public.min.js', array( 'jquery' ), $this->version, true );

        // Localize script
        wp_localize_script( $this->plugin_name, 'csts_content', array(
                'ajaxurl' => admin_url( 'admin-ajax.php' ),
                'action' => 'get_post',
                'nonce' => wp_create_nonce( "csts_single_content" ),
            )
        );

    }

    /**
     * Load template.
     *
     * @since 1.0.0
     */
    public function load_template() {
        $settings = Csts_Settings::get_settings();

        // Don't load template if user is in login page or plugin is disabled
        if( preg_match( "/login|admin|dashboard|account/i", $_SERVER['REQUEST_URI'] ) > 0 || !$settings['enable_disable_plugin'] ) {
            return false;
        } else{
            $is_admin = current_user_can('manage_options');

            // Load if user is logged in or admin is editing
            if( !is_user_logged_in() || ( $is_admin && $settings['enable_plugin_edit'] ) ) {
                require_once CSTS_DIR . 'public/template/template.php';
                exit();
            }

            return true;
        }
    }

    /**
     * Insert credit checker script in footer.
     *
     * @since 1.0.0
     */
	public function insert_footer_credit_checker_script() {
	    $settings = Csts_Settings::get_settings();
        $is_admin = current_user_can('manage_options');

	    if ($settings['enable_disable_plugin'] && !$is_admin) {
            echo '<script type="text/javascript">
                jQuery(window).load(function(){
                    var creditEl = jQuery("p#csts_credit");
                    var shouldRedirect = false;
                    
                    if( creditEl.length ) {
                        if( creditEl.text() !== "Made with love by BoomDevs" || creditEl.css("display") !== "block" ) {
                            shouldRedirect = true;
                        }
                    } else {
                        shouldRedirect = true;
                    }

                    if ( shouldRedirect ) {
                        window.location.href = "https://boomdevs.com/product/boomdevs-wordpress-coming-soon#white-label";
                    }
                });
            </script>';
        }
    }
}
