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
        
        // Add UI elements to the import template
        // General Section
        $this->add_on->add_title( 'General Section' );
        $this->add_on->add_field( '_tagline', 'Tagline', 'text' );
        $this->add_on->add_field( '_atbd_listing_pricing', 'Pricing', 'radio',
            array(
                'price' => 'Price [USD]',
                'range' => 'Price Range'
                ),
            );
        $this->add_on->add_field( '_price', 'Price', 'text' );
        $this->add_on->add_field( '_price_range', 'Price Range', 'radio',
            array(
                'skimming' => 'Ultra High ($$$$)',
                'moderate' => 'Expensive ($$$)',
                'economy' => 'Moderate ($$)',
                'bellow_economy' => 'Economy ($)'
                ),
            );
        $this->add_on->add_field( '_atbdp_post_views_count', 'View Count', 'text' );

        // Contact Information
        $this->add_on->add_title( 'Contact Information' );
        $this->add_on->add_field( '_hide_contact_owner', 'Hide contact owner form for single listing page', 'radio',
                array(
                    'on' => 'Yes',
                    '' => 'No'
                ),
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
		$this->add_on->add_field( '_address', 'Address', 'text' );
		$this->add_on->add_field( '_manual_coordinate', 'Or Enter Coordinates (latitude and longitude) Manually', 'radio',
                array(
                    '1' => 'Yes',
                    '' => 'No'
                ),
            );
		$this->add_on->add_field( '_manual_lat', 'Latitude', 'text' );
		$this->add_on->add_field( '_manual_lng', 'Longitude', 'text' );
		$this->add_on->add_field( '_hide_map', 'Hide Map', 'radio',
                array(
                    '1' => 'Yes',
                    '' => 'No'
                ),
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
            	),
            
        	$this->add_on->add_field( '_expiry_date', 'Expiry Date', 'text' )
		));

		
        $this->add_on->set_import_function( [ $this, 'directorist_addon_import' ] );
        add_action( 'admin_init', [ $this, 'admin_init' ] );
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
	
		// all fields except for slider images and social
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
			'_address',
			'_social_platform_id',
			'_social_url',
			'_manual_coordinate',
			'_manual_lat',
			'_manual_lng',
			'_hide_map',
			'_listing_prv_img',
			'_videourl',
			'_never_expire',
			'_expiry_date'
		);

        foreach ( $fields as $field ) { 
        	// Make sure the user has allowed this field to be updated.
        	if ( empty( $article['ID'] ) || $this->add_on->can_update_meta( $field, $import_options ) ) { 

            	// Update the custom field with the imported data.
            	update_post_meta( $post_id, $field, $data[ $field ] ); 
        	} 
    	} 
    	
    	// preview image
    	if ( $this->add_on->can_update_meta( '_listing_prv_img', $import_options ) ) {
    		$attachment_id = $data['_listing_prv_img']['attachment_id'];
    		update_post_meta( $post_id, '_listing_prv_img', $attachment_id );
    	}
    	
    	// social
		if ( $this->add_on->can_update_meta( '_social', $import_options ) ) {
    		$social_ids = explode(',',$data['_social_platform_id']);
    		$social_urls = explode(',',$data['_social_url']);
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