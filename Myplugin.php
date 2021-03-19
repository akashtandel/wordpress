<?php

/*Plugin Name: Myplugin
Plugin URI: http://example.com/wordpress-plugins/halloween-plugin
Description: This is a brief description of my plugin
Version: 1.0
Author: Akash
Author URI: http://example.com
License: GPLv2
*/

function custom_post_receipe()
{
	
	$labels = array(
 'name' => 'Receipe Contest',
 'singular_name' => 'Receipe Contest',
 'add_new' => 'Add Receipe Contest',
 'add_new_item' => 'Add Receipe Contest',
 'edit_item' => 'Edit Receipe Contest',
 'new_item' => 'New Receipe Contest',
 'all_items' => 'All Receipe Contest',
 'view_item' => 'View Receipe Contest',
 'search_items' => 'Search Receipe Contest',
 'not_found' => 'No Receipe Contest found',
 'not_found_in_trash' => 'No Receipe Contest found in Trash',
 'parent_item_colon' => '',
 'menu_name' => 'Receipe Contest',
 );
 
 $supports=array(
 'title','editor','author','post-formats','thumbnail','comments',
 );
 
 $args = array(
 'labels' => $labels,
 'description'=>'Everything you want to know about a receipe',
 'public' => true,
 'taxonomies'=>array('post_tag'),
 'supports'=> $supports,
 'has_archive'=> true,
 );
 
 register_post_type( 'receipe', $args );
}
add_action('init','custom_post_receipe');

//###########################################################

 //create a custom taxonomy name it topics for your posts
 
function taxonomy_receipe() {
 $labels = array(
 'name' => 'Level of contest',
 'singular_name' => 'Receipe Contest',
 'search_items' => 'Search Receipe Contest',
 'all_items' => 'All Receipe Contest',
 'parent_item' => 'Parent Receipe Contest',
 'parent_item_colon' => 'Parent Receipe Contest:',
 'edit_item' => 'Edit Receipe Contest',
 'update_item' => 'Update Receipe Contest',
 'add_new_item' => 'Add New Receipe Contest',
 'new_item_name' => 'New Receipe Contest',
 'menu_name' => 'Level Of Contest'
 );
 $args = array(
 'labels' => $labels,
 'hierarchical' => true,
 );
 register_taxonomy( 'receipe_category','receipe',$args );
}
add_action( 'init', 'taxonomy_receipe',0 );

function cf_register_metaboxes()
{
	add_meta_box('my_meta_box','Recipe meta','cf_add_form','receipe');
}
function cf_add_form()
{
	include  'C:/xampp/htdocs/wp/wp-content/plugins/Myplugin/form.php';
}
add_action('add_meta_boxes','cf_register_metaboxes');
function cf_save_meta_box($post_id)
{
	$fields=array('txtPrice','txtqty');
	foreach($fields as $field)
	{
		if(array_key_exists($field,$_POST))
		{
			update_post_meta($post_id,$field,$_POST[$field]);
		}
	}
}
add_action('save_post','cf_save_meta_box');
add_filter('the_content','display_content');

function display_content($content)
{
	echo $content."<br>";
	echo "price : ".get_post_meta(get_the_ID(),'txtPrice',true);
	echo "<br>";
	echo "quantity : ".get_post_meta(get_the_ID(),'txtqty',true);
	
}