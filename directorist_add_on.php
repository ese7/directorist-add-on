<?php
/*
Plugin Name: WP All Import - Directorist Add-On
Plugin URI: http://www.wpallimport.com/
Description: Import into the Directorist plugin. Requires WP All Import & Direcorist.
Version: 1.0
Author: Soflyy
*/

include "rapid-addon.php";


final class Directorist_Add_On {

    protected static $instance;

    protected $add_on;

    static public function get_instance() {
        if ( self::$instance == NULL ) {
            self::$instance = new self();
        }
        return self::$instance;
    }

    protected function __construct() {

        // Define the add-on
        $this->add_on = new RapidAddon( 'Directorist Add-On', 'wpai_directorist_add_on' );
        $this->hooks();

        // Add UI elements to the import template
        $this->add_on->add_title( 'Important Information' );
		$this->add_on->add_text( 'In the "Taxonomies, Categories, Tags" section below, you must import a valid Listing Type in order for the imported listings to show on the front end of the site. This can be done by enabling \'Show "private" taxonomies\', then "Listing Type", then filling in the "Listing Type" field. This is enabled by default and set to the default Listing Type "General".' );

        // General Section
        $this->add_on->add_title( 'General Section' );
        $this->add_on->add_field( '_tagline', 'Tagline', 'text' );
        $this->add_on->add_field( '_atbd_listing_pricing', 'Pricing', 'radio',
            array(
                'price' => 'Price [USD]',
                'range' => 'Price Range'
                ),
                'If using "Set with XPath", enter "price" for "Price [USD]" and "range" for "Price Range"'
            );
        $this->add_on->add_field( '_price', 'Price', 'text' );
        $this->add_on->add_field( '_price_range', 'Price Range', 'radio',
            array(
                'skimming' => 'Ultra High ($$$$)',
                'moderate' => 'Expensive ($$$)',
                'economy' => 'Moderate ($$)',
                'bellow_economy' => 'Cheap ($)'
                ),
                'If using "Set with XPath", enter:<br> "skimming" for "Ultra High"<br>"moderate" for "Expensive"<br>"economy" for "Moderate"<br>"bellow_economy" for "Cheap"'
            );
        $this->add_on->add_field( '_atbdp_post_views_count', 'View Count', 'text' );

        // Contact Information
        $this->add_on->add_title( 'Contact Information' );
        $this->add_on->add_field( '_hide_contact_owner', 'Hide contact owner form for single listing page', 'radio',
                array(
                    'on' => 'Yes',
                    '' => 'No'
                ),
                'If using "Set with XPath", enter "on" for "Yes" and leave blank for "No"'
            );
        $this->add_on->add_field( '_zip', 'Zip/Post Code', 'text' );
        $this->add_on->add_field( '_phone', 'Phone', 'text' );
        $this->add_on->add_field( '_phone2', 'Phone 2', 'text' );
        $this->add_on->add_field( '_fax', 'Fax', 'text' );
        $this->add_on->add_field( '_email', 'Email', 'text' );
        $this->add_on->add_field( '_website', 'Website', 'text' );
        $this->add_on->add_title( 'Social Info' );
        $this->add_on->add_field( '_social', 'Social Values', null);
        $this->add_on->add_options( array(
                $this->add_on->add_field( '_social_platform_id', 'Platform', 'text', null, 'Multiple values must be separated by commas, e.g.: linkedin,youtube. Allowed platforms: <br> Behance, Dribbble, Facebook, Flickr, GitHub, Instagram, LinkedIn, Flickr, Pinterest, Reddit, Snapchat, SoundCloud, Stack Overflow, Tumblr, Twitter, Vimeo, Vine, YouTube' ),
                $this->add_on->add_field( '_social_url', 'URL', 'text', null, 'Multiple values must be separated by commas, e.g.: https://facebook.com/username, https://behance.com/username' )
        	)
		);


        // Map
        $this->add_on->add_title( 'Map' );
	
		/* Begin Geocoding */

		$this->add_on->add_field(
			'location_settings',
			'Listing Map Location',
			'radio',
				array(
					'search_by_address' => array(
					'Search by Address',
					$this->add_on->add_options(
					$this->add_on->add_field(
						'_address',
						'Address',
						'text'
			),
			'Google Geocode API Settings',
				array(
					$this->add_on->add_field(
						'address_geocode',
						'Request Method',
						'radio',
						array(
							'address_no_key'            => array(
								'No API Key',
								'Limited number of requests.'
							),
							'address_google_developers' => array(
								'Google Developers API Key - <a href="https://developers.google.com/maps/documentation/geocoding/#api_key">Get free API key</a>',
								$this->add_on->add_field(
									'address_google_developers_api_key',
									'API Key',
									'text'
								),
								'Up to 2500 requests per day and 5 requests per second.'
							),
							'address_google_for_work'   => array(
								'Google for Work Client ID & Digital Signature - <a href="https://developers.google.com/maps/documentation/business">Sign up for Google for Work</a>',
								$this->add_on->add_field(
									'address_google_for_work_client_id',
									'Google for Work Client ID',
									'text'
								),
								$this->add_on->add_field(
									'address_google_for_work_digital_signature',
									'Google for Work Digital Signature',
									'text'
								),
								'Up to 100,000 requests per day and 10 requests per second'
							)
						) // end Request Method options array
					) // end Request Method nested radio field
				) // end Google Geocode API Settings fields
			) // end Google Gecode API Settings options panel
		), // end Search by Address radio field
		'search_by_coordinates' => array(
			'Search by Coordinates',
			$this->add_on->add_field(
				'_manual_lat',
				'Latitude',
				'text',
				null,
				'Example: 34.0194543'
			),
			$this->add_on->add_options(
				$this->add_on->add_field(
					'_manual_lng',
					'Longitude',
					'text',
					null,
					'Example: -118.4911912'
				),
				'Google Geocode API Settings',
				array(
					$this->add_on->add_field(
						'coord_geocode',
						'Request Method',
						'radio',
						array(
							'coord_no_key' => array(
								'No API Key',
								'Limited number of requests.'
							),
							'coord_google_developers' => array(
								'Google Developers API Key - <a href="https://developers.google.com/maps/documentation/geocoding/#api_key">Get free API key</a>',
								$this->add_on->add_field(
									'coord_google_developers_api_key',
									'API Key',
									'text'
								),
								'Up to 2500 requests per day and 5 requests per second.'
							),
							'coord_google_for_work'   => array(
								'Google for Work Client ID & Digital Signature - <a href="https://developers.google.com/maps/documentation/business">Sign up for Google for Work</a>',
								$this->add_on->add_field(
									'coord_google_for_work_client_id',
									'Google for Work Client ID',
									'text'
								),
								$this->add_on->add_field(
									'coord_google_for_work_digital_signature',
									'Google for Work Digital Signature',
									'text'
								),
								'Up to 100,000 requests per day and 10 requests per second'
							)
						) // end Geocode API options array
					) // end Geocode nested radio field
				) // end Geocode settings
			) // end coordinates Option panel
		) // end Search by Coordinates radio field
	) // end Listing Location radio field
);


/* End Geocoding */


		$this->add_on->add_field( '_hide_map', 'Hide Map', 'radio',
                array(
                    '1' => 'Yes',
                    '' => 'No'
                ),
                'If using "Set with XPath", enter "1" for "Yes" and leave blank for "No"'
            );



        // Images and Video
        $this->add_on->add_title( 'Preview Image & Video' );
        // Disable default "Images" section
        $this->add_on->disable_default_images();

        // Preview Image and Video
		$this->add_on->add_field( '_listing_prv_img', 'Preview Image', 'image' );
		$this->add_on->add_field( '_videourl', 'Video URL', 'text' );

		// Slider Images
		$this->add_on->import_images( 'dir_slider_images', 'Directorist Slider Images', 'images', [ $this, 'dir_slider_images' ]);


		// Sidebar
		$this->add_on->add_options( null, 'Sidebar Settings', array(
			$this->add_on->add_field( '_never_expire', 'Never Expires', 'radio',
                	array(
                    	'1' => 'Yes',
                    	'' => 'No'
                	),
                	'If using "Set with XPath", enter "1" for "Yes" and leave blank for "No"'
            	),

        	$this->add_on->add_field( '_expiry_date', 'Expiry Date', 'text', null, 'Acceptable formats: Y-n-j or Y-m-d, e.g. <br> 2023-7-5 or 2023-07-05' ),
			$this->add_on->add_field( '_listing_status', 'Listing Status', 'text', null, 'Default value for new listings is post_status, but you can change it here if you know what status you need.', true, 'post_status' )
		));


        $this->add_on->set_import_function( [ $this, 'directorist_addon_import' ] );
        add_action( 'admin_init', [ $this, 'admin_init' ] );
    }

    // Fire hooks to enable our JavaScript file and to save the directory type.
    public function hooks() {
		add_action( 'admin_enqueue_scripts', array(  $this, 'admin_scripts' ) );
		add_action( 'pmxi_saved_post', array( $this, 'save_directory_type' ), 10, 3 );
	}

    // Save the directory type based on the Listing Type taxonomy term
    public function save_directory_type( $id, $xml, $is_update ) {
        $import_term = '0';
		$terms = wp_get_object_terms( $id, 'atbdp_listing_types', array( 'fields' => 'ids' ) );
		if ( ! empty( $terms ) && is_array( $terms ) ) {
			$import_term = $terms[0];
		} else {
			$terms = get_terms( array(
				'taxonomy'   => 'atbdp_listing_types',
				'hide_empty' => false,
				'number'     => '1',
				'fields'     => 'ids'
			) );
			if ( ! empty( $terms ) && is_array( $terms ) ) {
				$import_term = $terms[0];
			}
		}
        $import_term = apply_filters( 'wpai_directorist_add_on_listing_type', $import_term, $terms );
        update_post_meta( $id, '_directory_type', $import_term );
	}

    // Include JavaScript file
    public function admin_scripts() {
		$current_screen = get_current_screen();
		if ( ( $current_screen->id == "all-import_page_pmxi-admin-import" ) ) {
			wp_enqueue_script( 'mylisting-addon-js', plugin_dir_url( __FILE__ ) . 'js/directorist-addon-js.js', array( 'jquery' ), '1.0.0', true );
		}
	}

	// Check if the Directorist plugin is installed and activated
	public function admin_init() {


        $this->add_on->run( array(
        	'plugins'       => array( 'directorist/directorist-base.php' ),
            'post_types'    => array( 'at_biz_dir' )
        ) );

        $notice_message = 'The Directorist Add-On requires WP All Import <a href="https://www.wpallimport.com/order-now/?utm_source=free-plugin&utm_medium=dot-org&utm_campaign=wpjm" target="_blank">Pro</a> or <a href="https://wordpress.org/plugins/wp-all-import" target="_blank">Free</a>, and the <a href="https://wordpress.org/plugins/directorist/" target="_blank">Directorist</a> plugin.';

        $this->add_on->admin_notice( $notice_message, array( 'plugins' => array( 'directorist/directorist-base.php' ) ) );
    }

    public function get_add_on() {
        if ( function_exists('is_plugin_active') ) {
    		// Only run this add-on if the free or pro version of the Directorist plugin is active.
    		if ( is_plugin_active( 'directorist/directorist-base.php' ) /*|| is_plugin_active( 'confirm-premium-path' )*/ ) {
        		$this->add_on->run();
    		}
		}
    }


    // Check if the user has allowed these fields to be updated, and then import data to them
    public function directorist_addon_import( $post_id, $data, $import_options, $article ) {

		// all fields except for preview image, slider images, social, and expiry date
		$fields = array(
			'_tagline',
			'_atbd_listing_pricing',
			'_price',
			'_price_range',
			'_atbdp_post_views_count',
			'_hide_contact_owner',
			'_zip',
			'_phone',
			'_phone2',
			'_fax',
			'_email',
			'_website',
			//'_address',
			'_social_platform_id',
			'_social_url',
			//'_manual_lat',
			//'_manual_lng',
			'_hide_map',
			'_listing_prv_img',
			'_videourl',
			'_never_expire',
            '_listing_status'
		);

        foreach ( $fields as $field ) {
        	// Make sure the user has allowed this field to be updated.
        	if ( empty( $article['ID'] ) || $this->add_on->can_update_meta( $field, $import_options ) ) {

            	// Update the custom field with the imported data.
            	update_post_meta( $post_id, $field, $data[ $field ] );
        	}
    	}
    	
    	// expiry date
		if ( empty( $article['ID'] ) || $this->add_on->can_update_meta( '_expiry_date', $import_options ) ) {
    		$exp_date = $data['_expiry_date'];
    		$exp_date = date("Y-m-d",strtotime($exp_date));
			update_post_meta( $post_id, '_expiry_date', $exp_date );
		}
    	

    	// preview image
    	if ( empty( $article['ID'] ) || $this->add_on->can_update_meta( '_listing_prv_img', $import_options ) ) {
    		$attachment_id = $data['_listing_prv_img']['attachment_id'];
    		update_post_meta( $post_id, '_listing_prv_img', $attachment_id );
    	}

    	// social
		if ( empty( $article['ID'] ) || $this->add_on->can_update_meta( '_social', $import_options ) ) {
			$social_ids = $data['_social_platform_id'];
			$social_urls = $data['_social_url'];
			
			if(empty($social_ids) && empty($social_urls)) return;
						
    		$social_ids = sanitize_text_field(strtolower($data['_social_platform_id']));
    		$social_ids = str_replace(array(' ','stackoverflow'),array('','stack-overflow'),$social_ids);
    		$social_ids = explode(',',$social_ids);
    		$social_urls = sanitize_text_field(strtolower($data['_social_url']));
    		$social_urls = str_replace(' ','',$social_urls);
    		$social_urls = explode(',',$social_urls);

    		$final = array();

    		foreach ($social_urls as $key => $value){
    				$final[] = (array)array_merge(
    					(array)$social_ids[$key],
    					(array)$value);
    		}
    		
    		$final = array_map(function($new_key) {
    			return array(
        		'id' => $new_key['0'],
        		'url' => $new_key['1'],
    			); }, $final);
			
			update_post_meta( $post_id, '_social', $final );
    		delete_post_meta($post_id, '_social_platform_id');
    		delete_post_meta($post_id, '_social_url');
		}
		
		
		
		// Location
		$field = '_address';
		$address = $data[$field];
		$lat = $data['_manual_lat'];
    	$long = $data['_manual_lng'];  
    	$geocoding_failed = false;
    	$api_key = null;

		//  build search query
		if ( $data['location_settings'] == 'search_by_address' ) {
			$search = (!empty($address) ? 'address=' . rawurlencode( $address ) : null);
		} else {
			$search = (!empty($lat) && !empty($long) ? 'latlng=' . rawurlencode( $lat . ',' . $long ) : null);
		}
    
   	 	// build api key
		if ( $data['location_settings'] == 'search_by_address' ) {
			if ( $data['address_geocode'] == 'address_google_developers' && !empty($data['address_google_developers_api_key']) ) {
				$api_key = '&key=' . $data['address_google_developers_api_key'];
			} elseif ( $data['address_geocode'] == 'address_google_for_work' && !empty($data['address_google_for_work_client_id']) && !empty($data['address_google_for_work_signature']) ) {
				$api_key = '&client=' . $data['address_google_for_work_client_id'] . '&signature=' . $data['address_google_for_work_signature'];
			}

		} else {
			if ( $data['coord_geocode'] == 'coord_google_developers' && !empty($data['coord_google_developers_api_key']) ) {
				$api_key = '&key=' . $data['coord_google_developers_api_key'];
			} elseif ( $data['coord_geocode'] == 'coord_google_for_work' && !empty($data['coord_google_for_work_client_id']) && !empty($data['coord_google_for_work_signature']) ) {
				$api_key = '&client=' . $data['coord_google_for_work_client_id'] . '&signature=' . $data['coord_google_for_work_signature'];
			}

		}

		// if all fields are updateable and $search has a value
		if ( empty( $article['ID'] ) or ( $this->add_on->can_update_meta( $field, $import_options ) && $this->add_on->can_update_meta( 'REAL_HOMES_property_location', $import_options ) && !empty ($search) ) ) {

			// build $request_url for api call
			$request_url = 'https://maps.googleapis.com/maps/api/geocode/json?' . $search . $api_key;
			$curl = curl_init();

			curl_setopt( $curl, CURLOPT_URL, $request_url );
			curl_setopt( $curl, CURLOPT_RETURNTRANSFER, 1 );

			$this->add_on->log( '- Getting location data from Geocoding API: ' . $request_url );

			$json = curl_exec( $curl );
			curl_close( $curl );

			// parse api response
			if ( !empty($json) ) {

            	$details = json_decode( $json, true );
            
            	if ( array_key_exists( 'status', $details ) ) {
					if ( $details['status'] == 'INVALID_REQUEST' || $details['status'] == 'ZERO_RESULTS' || $details['status'] == 'REQUEST_DENIED' ) {
						$geocoding_failed = true;
						goto invalidrequest;
					}
				}

				if ( $data['location_settings'] == 'search_by_address' ) {
					$lat = $details['results'][0]['geometry']['location']['lat'];
					$long = $details['results'][0]['geometry']['location']['lng'];
				} else {
					$address = $details['results'][0]['formatted_address'];
				}
			}
		}

		// update location fields
		$fields = array(
			'_address'  => $address,
			'_manual_lat' => $lat,
			'_manual_lng' => $long
		);

		$this->add_on->log( '- Updating location data' );
		foreach ( $fields as $key => $value ) {
			if ( empty( $article['ID'] ) or $this->add_on->can_update_meta( $key, $import_options ) ) {
				update_post_meta( $post_id, $key, $value );
			}
    	}
    
    	invalidrequest:

		if ( $geocoding_failed ) {
			$this->add_on->log( "WARNING Geocoding failed with status: " . $details['status'] );
			if ( array_key_exists( 'error_message', $details ) ) {
				$this->add_on->log( "WARNING Geocoding error message: " . $details['error_message'] );
			}
		}
		// End location
		
	}

	// slider images
	public function dir_slider_images( $post_id, $attachment_id, $image_filepath, $import_options ) {
		$urls = get_post_meta($post_id, '_listing_img', true);
		if (empty($urls)) {
        	$urls = array();
    	}
    	if (!in_array($attachment_id, $urls)) {
    		$urls[] = $attachment_id;
			update_post_meta( $post_id, '_listing_img', $urls );
		}
    }
    
}

Directorist_Add_On::get_instance();
