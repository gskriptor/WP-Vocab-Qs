<?php

/*
Plugin Name: Quiz Sorter
Plugin URI: https://gusspencer.com
Description: Manage practice quiz scores
Version: 0.0.19
Author Gus Spencer
Author URI: https://gusspencer.com
Text Domain: education
*/

		//main function test
		function sorter($atts) {

                 //collect current user information to use for custom search of existing published exams
		$user = um_profile_id();
	        $sSchool = get_user_meta($user, 'select_school', true);

			//for custom query of quiz posts for current user
			$return = '';
			if( $content ) {
	        		$return = $content;
	    		}

	    		// Shortcode attribute: title="Lorem Ipsum"
	    		if( isset( $atts['title'] ) )
	    		{
        		$return .= '<br><h2>' . $atts['title'] . '</h2>';
    			}

    			// Get our custom post
    			// 'category' is the category ID or a comma separated list of ID numbers
    			$sliders = get_posts( [
        			'post_status' => 'publish',
        			'post_type' => 'post',
        			'numberposts' => 1,
        			'order'=> 'ASC',
        			'orderby' => 'title',
        			'category' => $atts['id'],
        			'meta_query' => [
        				'relation' => 'AND',
        				[
        					'key' => 'school',
        					'value' => $sSchool,
        					'compare' => 'LIKE'
        				]
        			]

    			]);


    			// Auxiliary variable, don't print <br> in the first element
    			$first = '';

    			// Iterate through the resulting array
    			// and build the final output
    			// Use $slide->post_author, ->post_excerpt, as usual
    			//   $slide->ID can be used to call auxiliary functions
    			//   such as get_children or get_permalink
    			foreach( $sliders as $slide )
    			{
        			$link = get_permalink( $slide->ID );
        			$return .=
            			$first
            			. '<a href="' . $link . '">Click here</a>
        			';
        			$first = '<br>';
    			}
			//$school_check = the_field('quiz_school');
			//$quiz_grade = the_field('quiz_grade');
			//$quiz_teacher = the_field('quiz_teacher');

			return $return;
		}
		add_shortcode('quiziz_sorter', 'sorter');
/**
*
*
**/

//this function creates a title link within a shortcode
               function sorter_title($datts) {

                 //collect current user information to use for custom search of existing published exams
		$user = um_profile_id();
	        $sSchool = get_user_meta($user, 'select_school', true);

			//for custom query of quiz posts for current user
			$return = '';
			if( $content ) {
	        		$return = $content;
	    		}

	    		// Shortcode attribute: title="Lorem Ipsum"
	    		if( isset( $datts['title'] ) )
	    		{
        		$return .= '<br><h2>' . $datts['title'] . '</h2>';
    			}

    			// Get our custom post
    			// 'category' is the category ID or a comma separated list of ID numbers
    			$sliders = get_posts( [
        			'post_status' => 'publish',
        			'post_type' => 'post',
        			'numberposts' => 1,
        			'order'=> 'ASC',
        			'orderby' => 'title',
        			'category' => $datts['id'],
        			'meta_query' => [
        				'relation' => 'AND',
        				[
        					'key' => 'school',
        					'value' => $sSchool,
        					'compare' => 'LIKE'
        				]
        			]

    			]);


    			// Auxiliary variable, don't print <br> in the first element
    			$first = '';

    			// Iterate through the resulting array
    			// and build the final output
    			// Use $slide->post_author, ->post_excerpt, as usual
    			//   $slide->ID can be used to call auxiliary functions
    			//   such as get_children or get_permalink
    			foreach( $sliders as $slide )
    			{
        			$link = get_permalink( $slide->ID );
        			$return .=
            			$first
            			. '<a href="' . $link . '">'
            			. $slide->post_title
            			. '</a>
        			';
        			$first = '<br>';
    			}
			//$school_check = the_field('quiz_school');
			//$quiz_grade = the_field('quiz_grade');
			//$quiz_teacher = the_field('quiz_teacher');

			return $return;
               }
               add_shortcode('quiziz_title', 'sorter_title');


?>
