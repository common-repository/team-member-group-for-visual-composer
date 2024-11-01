<?php
/*
  Plugin Name: Team Member Group For Visual Composer
  Plugin URI: https://wordpress.org/plugins/team-member-group-for-visual-composer/
  Description: Team Member Group for Visual Composer is the best well made and up to date Plugin built to create unlimited Teams with special design and multiple options, Fully Responsive, Drag and Frop by Visual Composer.
  Author: codecans
  Author URI: https://codecans.com
  Version: 2.4.7
 */
include_once( ABSPATH . 'wp-admin/includes/plugin.php' );

if ( is_plugin_active( 'js_composer/js_composer.php' ) ){	
	
if ( ! class_exists( 'team_grp' ) ) {
	/* Constants */
	define( 'TM_GROUP_URL', rtrim( plugin_dir_url( __FILE__ ), '/' ) );
	define( 'TM_GROUP_DIR', rtrim( plugin_dir_path( __FILE__ ), '/' ) );
	require_once 'admin/params/switch/switch.php';
	require_once 'admin/params/slider/slider-params.php';
		
//Loading CSS 
function team_member_group_style() {
		wp_enqueue_style( 'teamgroup_font_awesome_style', esc_url_raw( 'http://maxcdn.bootstrapcdn.com/font-awesome/4.5.0/css/font-awesome.min.css' ), array(), null );
		wp_enqueue_style( 'teamgroup-main-style', plugins_url( 'css/style.css', __FILE__ ) );
		wp_enqueue_style( 'teamgroup-main-style1', plugins_url( 'css/style1.css', __FILE__ ) );
		wp_enqueue_style( 'teamgroup-team-default', plugins_url( 'css/default.css', __FILE__ ) );
		wp_enqueue_style( 'teamgroup-team-scrollbar_effects', plugins_url( 'css/scrollbar_effects.css', __FILE__ ) );	

// Loading JS		
		wp_enqueue_script( 'prime_team_group_modals', plugins_url( 'js/modals.js', __FILE__ ), array( 'jquery' ), '', false );
		wp_enqueue_script( 'prime_team_scrollbar_effects', plugins_url( 'js/scrollbar-effects.min.js', __FILE__ ), array( 'jquery' ), '', false );
		wp_enqueue_script( 'prime_team_jquery-scrollspy', plugins_url( 'js/jquery-scrollspy.js', __FILE__ ), array( 'jquery' ), '', false );
		wp_enqueue_script( 'prime_team_jquery_vcteam-blockder', plugins_url( 'js/vcteam-blockder.min.js', __FILE__ ), array( 'jquery' ), '', false );
		wp_enqueue_script( 'prime_team_jquery_modernizr', plugins_url( 'js/modernizr.custom.js', __FILE__ ), array( 'jquery' ), '', false );
}
add_action( 'wp_enqueue_scripts', 'team_member_group_style' );
	
	
	
	function tmgroup_admin_enqeue() {
		wp_enqueue_style( 'tmgroup_admin_css', TM_GROUP_URL . '/admin/css/admin.css' );
	}
	add_action( 'admin_enqueue_scripts', 'tmgroup_admin_enqeue' );

	class team_grp {
		function __construct() {
			add_shortcode( "team_grp", array( $this, "pr_animation_shortcode_function" ) );
			add_action( 'init', array( $this, 'team_group_params_function' ) );
		}

		function team_group_params_function() {
			vc_map( array(
				"name"        => __( "Team Member Items", "rd_team_vc" ),
				"base"        => "team_grp",
				//"content_element" => true,
				"icon"        => "team_membericon",
				"category"    => 'Team Member',
				'description' => 'Team Member group',
				// 'admin_enqueue_css' => array(plugins_url('css/vc_extensions_cq_admin.css', __FILE__)),
				"params"      => array(
					// Select Square Field
					array(
						"type"        => "dropdown",
						"heading"     => __( "Select Team Member Style" ),
						"param_name"  => "select_style",
						"admin_label" => true,
						"value"       => array(
							'Style 1' => 'style-1',
							'Style 2' => 'style-2',
							'Style 3' => 'style-3',
							'Style 4' => 'style-4',
							'Style 5 (Pro Only)' => 'style-5',
							'Style 6 (Pro Only)' => 'style-6',
							'Style 7 (Pro Only)' => 'style-7',
							'Style 8 (Pro Only)' => 'style-8'
						),
					),
			// Attached Image Field
					array(
						"type"        => "attach_image",
						"heading"     => __( "Upload Mamber Image", "rd_team_vc" ),
						"param_name"  => "tm_member_imag",
						"value"       => "",
						"description" => __( "Select img from media library.", "rd_team_vc" )
					),
					array(
						"type"        => "textfield",
						"heading"     => __( "Member Name", 'prime_vc' ),
						"param_name"  => "tm_name",
						"admin_label" => true,
						"value"       => "Mickle Bond",
						"description" => __( "Team Member Name Here", 'rd_team_vc' ),
						//  "group"=> "Add Items"
					),
					array(
						"type"        => "textfield",
						"heading"     => __( "Member Label", 'prime_vc' ),
						"param_name"  => "tm_label",
						"admin_label" => true,
						"value"       => "Director",
						"description" => __( "Team Member Label Here", 'rd_team_vc' ),
						//  "group"=> "Add Items"
					),
					// Style 4 Description
					array(
						"type"        => "textarea",
						"heading"     => __( "Member Description", 'prime_vc' ),
						"param_name"  => "tm4_description",
						"admin_label" => true,
						"value"       => "It is a long established fact that a reader will be distracted by the readable content.",
						"description" => __( "Team Member Description Hoes Here", 'rd_team_vc' ),
						"dependency"  => array( 
						'element' => 'select_style', 
						'value'   => array( 'style-2', 'style-4', 'style-5', 'style-7', 'style-8'),
						),
					),
					// Param Group Here
					array(
						'type'       => 'param_group',
						'heading'    => __( 'Add Social Icon', 'rd_team_vc' ),
						'param_name' => 'acoptions',
						"group"      => "Social Icons",
						'params'     => array(
						array(
									"type"        => "dropdown",
									"heading"     => __( "Select Social Icon" ),
									"param_name"  => "tm_social_icon",
									"admin_label" => true,
									"value"       => array(
										'Facebook' => 'fa fa-facebook',
										'Twitter' => 'fa fa-twitter',
										'Linkedin' => 'fa fa-linkedin',
										'Google' => 'fa fa-google',
										'YouTube' => 'fa fa-youtube',
										'Pinterest' => 'fa fa-pinterest',
										'Instagram' => 'fa fa-instagram',
										'Tumblr' => 'fa fa-tumblr',
										'Flickr' => 'fa fa-flickr',
										'Reddit' => 'fa fa-reddit',
									),
								),
								// Link Field
								array(
									"type"        => "vc_link",
									"class"       => "",
									"heading"     => __( "Social URL (Link)", 'rd_team_vc' ),
									"param_name"  => "social_link",
									"description" => __( "Provide Social link here.", 'rd_team_vc' ),
								),
						),
						'callbacks'  => array('after_add' => 'vcChartParamAfterAddCallback')
					),
					// STYLE 1 Params Start //
					array(
						"type"       => "colorpicker",
						"heading"    => __( "Member Name Color <p> pro Feature - <a target='_blank' href='http://codecans.com/items/team-member-group-vc/'><span style='color:blue;'>Get Pro Version Here</span></a></p>", "my-text-domain" ),
						"param_name" => "stl1_name_color",
						"value"      => '#000',
						"group"      => "Options",
						"dependency" => array( 
						'element' => 'select_style', 
						'value'   => array( 'style-1', 'style-2', 'style-3', 'style-4', 'style-5', 'style-6', 'style-7', 'style-8'),
						),

					),
					array(
						"type"       => "colorpicker",
						"heading"    => __( "Member Label Color <p> pro Feature - <a target='_blank' href='http://codecans.com/items/team-member-group-vc/'><span style='color:blue;'>Get Pro Version Here</span></a></p>", "my-text-domain" ),
						"param_name" => "stl1_label_color",
						"value"      => '#000',
						"group"      => "Options",
						"dependency" => array( 
						'element' => 'select_style',
						'value'   => array( 'style-1', 'style-2', 'style-3', 'style-4', 'style-5', 'style-6', 'style-7', 'style-8'),
						),
					),
					array(
						"type"       => "colorpicker",
						"heading"    => __( "Description Color <p> pro Feature - <a target='_blank' href='http://codecans.com/items/team-member-group-vc/'><span style='color:blue;'>Get Pro Version Here</span></a></p>", "my-text-domain" ),
						"param_name" => "tmdescr_color",
						"value"      => '#000',
						"group"      => "Options",
						"dependency" => array( 
						'element' => 'select_style',
						'value'   => array( 'style-2', 'style-4', 'style-5', 'style-7', 'style-8'),
						),
					),
					array(
						"type"       => "colorpicker",
						"heading"    => __( "Background Color <p> pro Feature - <a target='_blank' href='http://codecans.com/items/team-member-group-vc/'><span style='color:blue;'>Get Pro Version Here</span></a></p>", "my-text-domain" ),
						"param_name" => "tmitem_bg_color",
						"value"      => '#27c41f',
						"group"      => "Options",
						"dependency" => array( 'element' => 'select_style',
						'value'   => array( 'style-1', 'style-3', 'style-4', 'style-5', 'style-6', 'style-7', 'style-8'),
						),
					),
					// STYLE 1 Params END //
					array(
						"type"        => "exploded_textarea",
						"heading"     => __( "Custom CSS", 'prime_vc' ),
						"param_name"  => "custom_css",
						"value"       => "",
						"description" => __( "Write your custom CSS Code Here", 'rd_team_vc' ),
						"group"      => "Custom CSS",
					),
					// STYLE 3 Params END //
					
					// Start Premium Option
					// ===================================//
					//=========== Premium Option =========//
					//=====================================//
				array(
											'type'        => 'prime_slider',
											'heading'     => __( 'Member Name Font Size <p> pro Feature - <a target="_blank" href="http://codecans.com/items/team-member-group-vc/"><span style="color:blue;">Get Pro Version Here</span></a></p>', 'team_vc' ),
											'param_name'  => 'member_fsize',
											'tooltip'     => __( 'Choose Member Name FontSize Here. For large numbers it\'s better use 18px Font Size.', 'team_vc' ),
											'min'         => 1,
											'max'         => 100,
											'step'        => 1,
											'value'       => 18,
											'unit'        => 'px',
											"description" => __( "Use Custom Member Name Fontsize, default is 18px", "my-text-domain" ),
											"group"       => "Options",
				),
				array(
											'type'        => 'prime_slider',
											'heading'     => __( 'Member Label Font Size <p> pro Feature - <a target="_blank" href="http://codecans.com/items/team-member-group-vc/"><span style="color:blue;">Get Pro Version Here</span></a></p>', 'team_vc' ),
											'param_name'  => 'member_lsize',
											'tooltip'     => __( 'Choose Member Name FontSize Here. For large numbers it\'s better use 18px Font Size.', 'team_vc' ),
											'min'         => 1,
											'max'         => 100,
											'step'        => 1,
											'value'       => 16,
											'unit'        => 'px',
											"description" => __( "Use Custom Member Label Fontsize, default is 16px", "my-text-domain" ),
											"group"       => "Options",
				),
				array(
											'type'        => 'prime_slider',
											'heading'     => __( 'Description Font Size <p> pro Feature - <a target="_blank" href="http://codecans.com/items/team-member-group-vc/"><span style="color:blue;">Get Pro Version Here</span></a></p>', 'team_vc' ),
											'param_name'  => 'memdescr_fsize',
											'tooltip'     => __( 'Choose Member Name FontSize Here. For large numbers it\'s better use 18px Font Size.', 'team_vc' ),
											'min'         => 1,
											'max'         => 100,
											'step'        => 1,
											'value'       => 12,
											'unit'        => 'px',
											"description" => __( "Use Custom Description Fontsize, default is 12px", "my-text-domain" ),
											"dependency" => array( 
											'element' => 'select_style',
											'value'   => array( 'style-2', 'style-4', 'style-5', 'style-7', 'style-8'),
											),
											"group"       => "Options",
				),
				
				

				),
			) );
		}

		function pr_animation_shortcode_function( $atts, $content = null, $tag ) {
			extract( shortcode_atts( array(
				'stl1_name_color'  => '#000',
				'stl1_label_color' => '#000',
				'tmdescr_color'    => '#000000',
				'tmitem_bg_color'  => '#27c41f',
				'tm_member_imag'   => '',
				'tm_name'          => 'Mickle Bond',
				'tm_label'         => 'Director',
				'social_link'      => '',
				'acoptions'        => '',
				'tm_social_icon'   => '',
				'select_style'     => 'style-1',
				'tm4_description'  => 'It is a long established fact that a reader will be distracted by the readable content.',
				'member_fsize'     => '',
				'member_lsize'     => '',
				'memdescr_fsize'   => '',
				'custom_css'   => '',
			), $atts ) );
			
			$custom_css = str_replace( "<br />", '', $custom_css ); 
			$member_fsize   = $atts['member_fsize'] != '' ? (int) esc_attr( $atts['member_fsize'] ) : 18;
			$member_lsize   = $atts['member_lsize'] != '' ? (int) esc_attr( $atts['member_lsize'] ) : 16;
			$memdescr_fsize   = $atts['memdescr_fsize'] != '' ? (int) esc_attr( $atts['memdescr_fsize'] ) : 12;
			
			require ('custom-inline-css.php');
			
			$options = json_decode( urldecode( $acoptions ) );
			$tm_member_imag = wp_get_attachment_image_src( $tm_member_imag, 'full' );
			if ( $select_style == 'style-1' ) {
				$output .= '
				<style type="text/css">
				.vc-team-style-1 .my-vc-team-member:hover .my-member-name {
				    background-color: #27c41f;
				}
				.vc-team-style-1 .my-vc-team-member:hover .my-member-post {
				    background-color: #27c41f;
				}				
				.vc-team-style-1 .my-member-social ul li a  {
				    background-color:  #27c41f;

				}
				</style>
				';
				
				$output .= '<div class="my-vc-team vc-team-' . $select_style . '"><div class="my-vc-team-member">
				<div class="my-member-img">
					<img src="' . $tm_member_imag[0] . '" class="img-responsive" alt="team01">
				</div>
				<div class="my-vc-team-detail">
					<h6 style="font-size:18px; color:#FFF;" class="my-member-name">' . $tm_name . '</h6>
					<p style="font-size:16px; color:#FFF;" class="my-member-post">' . $tm_label . '</p>					
				</div>
				<div class="my-member-social">
					<ul>';
				foreach ( $options as $option ) {
					$option->social_link = vc_build_link( $option->social_link );
					$output .= '<li><a href="' . $option->social_link['url'] . '" title="' . $option->social_link['title'] . '" target="' . $option->social_link['target'] . '"><i class="' . esc_attr( $option->tm_social_icon ) . '"></i></a></li>';
				}
				$output .= '</ul></div></div></div>';
			}
			
			elseif ( $select_style == 'style-2' ) {
				$output .= '<ul class="vcteam-block card-style style-1">
                            <li>
                                <figure>
                                    <div class="vc-vcteam-block-holder">
                                        <img src="' . $tm_member_imag[0] . '" alt="img08">
                                        <figcaption>
                                            <div class="vc-personal-info">
                                                <h3 style="font-size:20px; color:#000;">' . $tm_name . '</h3>
                                                <span style="font-size:14px; color:#fff;">' . $tm_label . '</span>
                                            </div>
                                            <!-- .vc-personal-info -->
                                            <div class="vc-contact-info">
                                                <p style="font-size:13px; color:#000;">' . $tm4_description . '</p>
                                                <ul class="vc-social-icons">';
				foreach ( $options as $option ) {
					$option->social_link = vc_build_link( $option->social_link );
					$output .= '<li><a href="' . $option->social_link['url'] . '" title="' . $option->social_link['title'] . '" target="' . $option->social_link['target'] . '"><i class="' . esc_attr( $option->tm_social_icon ) . '"></i></a></li>';
				}
				$output .= ' </ul>
                                   </div>
                                            <!-- .vc-contact-info -->
                                        </figcaption>
                                    </div>
                                    <!-- .vc-vcteam-block-holder -->
                                </figure>
                            </li>
                        </ul>';
			} 
			
			elseif ( $select_style == 'style-3' ) {
				$output .= '<div class="my-vc-team vc-team-' . $select_style . '"><div class="my-vc-team-block">
				<div class="my-vc-team-member">
					<img src="' . $tm_member_imag[0] . '" class="img-responsive" alt="team01">
					<div class="my-vc-team-detail">
					<h6 style="font-size:20px; color:#000;" class="my-member-name">' . $tm_name . '</h6>
					<p style="font-size:16px; color:#000;" class="my-member-post">' . $tm_label . '</p>	
					<ul class="my-member-social">';
				foreach ( $options as $option ) {
					$option->social_link = vc_build_link( $option->social_link );
					$output .= '<li><a href="' . $option->social_link['url'] . '" title="' . $option->social_link['title'] . '" target="' . $option->social_link['target'] . '"><i class="' . esc_attr( $option->tm_social_icon ) . '"></i></a></li>';
				}
				$output .= '</ul></div></div></div></div>';

			}
			
			elseif ( $select_style == 'style-4' ) {
				$output .= '<div class="my-vc-team vc-team-style-2">
				<div class="my-vc-team-member">
					<img src="' . $tm_member_imag[0] . '" class="img-responsive" alt="team01">
					<div class="my-vc-team-detail">
					<h6 style="font-size:20px; color:#000;" class="my-member-name">' . $tm_name . '</h6>
					<p style="font-size:16px; color:#000;" class="my-member-post">' . $tm_label . '</p>	
					<p style="font-size:13px; color:#000;" class="my-member-details">' . $tm4_description . '</p>
					<ul class="my-member-social">';
				foreach ( $options as $option ) {
					$option->social_link = vc_build_link( $option->social_link );
					$output .= '<li><a href="' . $option->social_link['url'] . '" title="' . $option->social_link['title'] . '" target="' . $option->social_link['target'] . '"><i class="' . esc_attr( $option->tm_social_icon ) . '"></i></a></li>';
				}
				$output .= '</ul></div></div></div>';
			}
			
			elseif ( $select_style == 'style-5' ) {
				$output .= '<h3 align="center">Team Style 5 Only for pro version user. Please Buy Pro Version <a target="_blank" href="http://codecans.com/items/team-member-group-vc/"><span style="color:blue;">Get Pro Version</span></a> for only $12</h3>';
			}
			
			elseif ( $select_style == 'style-6' ) {
				$output .= '<h3 align="center">Team Style 4 Only for pro version user. Please Buy Pro Version <a target="_blank" href="http://codecans.com/items/team-member-group-vc/"><span style="color:blue;">Get Pro Version</span></a> for only $12</h3>';
			}
			
			elseif ( $select_style == 'style-7' ) {
				$output .= '<h3 align="center">Team Style 4 Only for pro version user. Please Buy Pro Version <a target="_blank" href="http://codecans.com/items/team-member-group-vc/"><span style="color:blue;">Get Pro Version</span></a> for only $12</h3>';
			}
			elseif ( $select_style == 'style-8' ) {
				$output .= '<h3 align="center">Team Style 4 Only for pro version user. Please Buy Pro Version <a target="_blank" href="http://codecans.com/items/team-member-group-vc/"><span style="color:blue;">Get Pro Version</span></a> for only $12</h3>';
			}

			return $output;
		}

	}

	// Finally initialize code
	new team_grp;
}
}
else {
	function tm_group_vc_required_plugin() {
		if ( is_admin() && current_user_can( 'activate_plugins' ) &&  !is_plugin_active( 'js_composer/js_composer.php' ) ) {
			add_action( 'admin_notices', 'tm_group_vc_required_plugin_notice' );

			deactivate_plugins( plugin_basename( __FILE__ ) ); 

			if ( isset( $_GET['activate'] ) ) {
				unset( $_GET['activate'] );
			}
		}

	}
	add_action( 'admin_init', 'tm_group_vc_required_plugin' );

	function tm_group_vc_required_plugin_notice(){
		?><div class="error"><p>Error! you need to install or activate the <a href="https://codecanyon.net/item/visual-composer-page-builder-for-wordpress/242431?ref=Rakibur_Rahman_Sagar">Visual Composer</a> plugin to run "<span style="font-weight: bold;">Team Member Group Visual Composer</span>" plugin.</p></div><?php
	}
}
?>