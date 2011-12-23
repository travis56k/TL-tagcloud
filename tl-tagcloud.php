<?php
/*
Plugin Name: Tag Cloud plugin using shortcode
Plugin URI: http://www.travisluong.com
Description: This plugin will allows you to insert a tag cloud directly into your post via a shortcode. The default parameters are as follows: [tl-tagcloud taxonomy="tags" number="100" smallest="25" largest="50" unit="px" separator=" "]
Author: Travis Luong
Version: 1.0
Author URI: http://www.travisluong.com
 */

function tl_tagcloud($atts,$content=null)
{	
	extract(shortcode_atts( array( 
					'taxonomy' => 'tags', 
					'number' => 100,
					'smallest' => 25, // size of least used tag
					'largest' => 50, // size of most used tag
					'unit' => 'px',
					 'separator'  => ' '), $atts));
					
	//return $taxonomy.$number.$smallest.$largest.$unit;
	$arr = wp_tag_cloud(array('taxonomy' => $taxonomy, 'number' => $number, 
				  'smallest' => $smallest, // size of least used tag
					'largest' => $largest, // size of most used tag
					'unit' => $unit,// unit for sizing
					'format' => 'array')); 			
					
					
	//var_dump($atts);
	$str = "";
	$count = 0;
	$totalTags = count($arr);
	foreach($arr as $tag)
	{
		$count++;
		if($count<$totalTags){
			$str.= $tag.$separator;
		} else{
			$str.=$tag;
		}
	}
	return $str;
		
}
	
add_shortcode('tl-tagcloud','tl_tagcloud');
