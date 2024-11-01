<?php 
/*
Plugin Name: BMI Calculator Plugin
Description: Add BMI Calculator to your widgets, posts and pages
Version: 1.0
Author: bmicalculatorplugin.com
Author URI: http://bmicalculatorplugin.com
License: GPLv2
*/


class BMICalculator_Widget extends WP_Widget {

    function __construct() {
        parent::__construct(
         
            // base ID of the widget
            'bmicalculator_widget',
             
            // name of the widget
            __('BMI Calculator Widget', 'BMICalculator' ),
             
            // widget options
            array (
                'description' => __( 'Widget to display BMI Calculator', 'BMICalculator' )
            )
             
        );

    }
     
    function form( $instance ) {

    }
     
    function widget( $args, $instance ) {
        
        wp_enqueue_script( 'bmi-calculator-script', plugins_url('js/script.js',__FILE__), array('jquery'));
        
        wp_enqueue_style( 'bmi-calculator-style', plugins_url('css/style.css',__FILE__));
        
        echo '<div class="bmic">
		<h3>BMI Calculator</h3>
		<form>
		<div class="bmic-row">
			<label>Weight:</label>
			<input name="bmi-weight" type="text" id="bmi-weight" placeholder="65" />
			<span>KG</span>
		</div>
		<div class="bmic-row">
			<label>Height:</label>
			<input name="bmi-height" type="text" id="bmi-height" placeholder="1.81" />
			<span>M</span>
		</div>
		<input name="submit" id="bmic-submit" type="button" value="Calculate" />
		</form>
		<div class="bmic-result">
			<div class="bmic-comment"></div>			
			<div class="bmic-score">BMI Score: <span></span></div>
				
		</div>
		</div>';
    }
     
}

function bmi_calculator_widget() {
 
    register_widget( 'BMICalculator_Widget' );
 
}

add_action( 'widgets_init', 'bmi_calculator_widget' );



function bmi_calculator_widget_shortcode($atts) {
    
    global $wp_widget_factory;
    
    // extract(shortcode_atts(array(
    //     'widget_name' => FALSE
    // ), $atts));
    
    $widget_name = 'BMICalculator_Widget';
    // $widget_name = wp_specialchars($widget_name);
    if (!is_a($wp_widget_factory->widgets[$widget_name], 'WP_Widget')):
        $wp_class = 'WP_Widget_'.ucwords(strtolower($class));
        
        if (!is_a($wp_widget_factory->widgets[$wp_class], 'WP_Widget')):
            return '<p>'.sprintf(__("%s: Widget class not found. Make sure this widget exists and the class name is correct"),'<strong>'.$class.'</strong>').'</p>';
        else:
            $class = $wp_class;
        endif;
    endif;
    
    ob_start();
    the_widget($widget_name, array(), array('widget_id'=>'arbitrary-instance-bmicalculator_widget',
        'before_widget' => '',
        'after_widget' => '',
        'before_title' => '',
        'after_title' => ''
    ));
    $output = ob_get_contents();
    ob_end_clean();
    return $output;
    
}
add_shortcode('bmi_calculator','bmi_calculator_widget_shortcode'); 
?>