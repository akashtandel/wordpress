<?php

/*
Plugin Name: MY CUSTOM POST
Plugin URI: Nothing
Description:My first plugin
Version: 1.0
Author: Automattic
Author URI: 
License:Nope
Text Domain: 
 */
//Custom Taxononmy
function add_taxonomy(){
    $args=array(
        'hierarchical' => true,
        'labels'=>array('name'=>'Level of Contest',
        'menu_name'=>'Level of Contest',
        'singular_name' => 'Level of Contest',
        'search_items' => 'Search Level of Contest',
        'all_items' => 'All Level of Contest',
        'parent_item' => 'Parent Level of Contest',
        'parent_item_colon' => 'Parent Level of Contest:',
        'edit_item' => 'Edit Level of Contest',
        'update_item' => 'Update Level of Contest',
        'add_new_item' => 'Add New Level of Contest',
        'new_item_name' => 'New Type Level of Contest'
            ));
    register_taxonomy('Level_of_contest','Recipie_Contest',$args);
}

//Custom Post For REcipies
function create_posttype() {
register_post_type( 'Recipie_Contest',
array(
              'labels' => array(            
              'name' => 'Recipie Contest',      
              'add_new' => 'Add Recipie Contest',
               'add_new_item' => 'Add REciopie',
              'edit_item' => 'Edit Recipie Contest',
              'new_item' => 'New Recipie Contest',
              'all_items' => 'All Recipie Contest',
              'view_item' => 'View Recipie Contest',
              'search_items' => 'Search Recipie Contest',
              'not_found' => 'No Recipie Contest found'
          ),
          'public' => true,
                        'supports'=>array('title','editor','comment','thumbnail',"comments"),    
                        'taxonomies'=>array('Level_of_contest','post_tag'),
'has_archive' => true,
                        'public'=>true,
'rewrite' => array('slug' => 'Recipies'),
                        'query_var' => true,
                        'show_ui' => true,
                        'capability_type' => 'post',
                        'query_var' => true,
//'show_in_rest' => true

)
);
}
add_action('init','add_taxonomy');
add_action( 'init', 'create_posttype');


//Metabox
function cf_register_meta(){
    add_meta_box('mymetabox', 'Recipie Meta', 'cf_add_form','Recipie_Contest');
   
}
//Form
function cf_add_form(){
    include plugin_dir_path(__FILE__).'/form.php';
}
add_action('add_meta_boxes','cf_register_meta');

//Save Data
function cf_save_meta_box($post_id){
    $fields=array('Sponsor','txtdate');
    foreach($fields as $field)
    {
        if(array_key_exists($field, $_POST))
        {
            update_post_meta($post_id, $field, $_POST[$field]);
        }
    }
}
add_action('save_post','cf_save_meta_box');

//Frontend Side

function display_content($content){
  
//    echo "Contest Date: ".get_post_meta(get_the_ID(),'txtdate',true);
//    echo '<br>';
//    echo $content.'<br>';
//    echo "The Contest Sponsored By: ".get_post_meta(get_the_ID(),'Sponsor',true);
     echo $content.'<br>';
     echo "<H2>Participants</h2>";
     ?>
    <table border="1">
        <th>
            Name
        </th>
         <?php 
        if(get_option('image_display_or_not')=='yes')
            {?>
        <th>
            Profile Photo
        </th>
           <?php }?>
        <th>
            Mobile Number
        </th>
        <th>
            Email
        </th>
      <?php   if(get_option('age_display_or_not')=='yes')
            {?>
        <th>
            Age   
        </th>
        <?php }?>
   
     <?php
     global $wpdb;
     $Contest_id=get_the_ID();
   //  echo $Contest_id;
    $result=$wpdb->get_results("select * from wp_participant p inner join wp_posts wp on p.ID=wp.ID where wp.ID=$Contest_id",ARRAY_A);
    if($result !=null)
    {
     //  print_r( $result);
        
    }
   
    foreach ($result as $row)
    {
        ?>
        <tr>
            <td>
                <?php echo $row['name']; ?>
            </td>
              <?php if(get_option('image_display_or_not')=='yes')
            {?>
            <td>
                <?php 
                              
                   // echo "<img width='50' height='60'  src='".plugin_dir_path(__FILE__)."/uploads/$Img_name'>";
             //   $path="wp-content/plugins/Test/uploads/";

                ?>
                <img width="50" height="60" src="<?php echo "http://192.168.40.8/mcal19/mcal19005/uploads/".$row['profile_photo'];?>" alt="Error" >
            </td>
               <?php }?>
            <td>
                <?php echo $row['mobile_no']; ?>
            </td>
            <td>
                <?php echo $row['email']; ?>
            </td>
            <?php   if(get_option('age_display_or_not')=='yes')
            {?>
            <td>
                <?php 
                //echo $row['DOB'];
                $dob=$row['DOB'];
                $age = (date('Y') - date('Y',strtotime($dob)));
                echo $age;
                ?>
            </td>
          
        </tr>
    <?php } }?>
         </table>
         </form>
        <?php 
   // }
    
    //participent option wise
}
add_filter('the_content','display_content');
/*
function display_content($content){
   ?>
<table style='border: 2px solid black;'>
    <td>
        <?php get_post_meta(get_the_ID(),'txtdate',true);?>
    </td>
    </table>
<?php

}
 */

function create_admin_menu(){
    add_menu_page('Recipies_menu', 'Add participants', 'manage_options', 'Top_menu','admin_menu_action');
   add_submenu_page('Top_menu', 'View participants','View Participants', 'manage_options', 'View_participants','view_participant_action');
}
function admin_menu_action(){
    include plugin_dir_path(__FILE__).'/Add_participant_form.php';
}
function view_participant_action(){
    include plugin_dir_path(__FILE__).'/View_participants.php';
}
add_action('admin_menu','create_admin_menu');




//----------Practical 7--------------------
 add_action( 'admin_menu', 'Manage_participants_front_side' );
 function Manage_participants_front_side() 
 {
 	add_menu_page( 'Contest Options', 'Contest Options','manage_options', 'contest_main_menu', 'contest_main_plugin_page');
  	add_submenu_page( 'contest_main_menu', 'Contest setting','Contest setting', 'manage_options', 'contest_setting','contest_setting' );
 	 add_submenu_page( 'contest_main_menu', 'Design setting','Design setting', 'manage_options', 'desing_setting', 'desing_setting' );
 }
 function contest_setting()
 {
      include plugin_dir_path(__FILE__).'/Content_settings_form.php';
 }
 function desing_setting()
 {
     include plugin_dir_path(__FILE__).'/Design_settings_form.php';
 }
 
 //OPtions 
  function register_plugin_setting()
 {
 	add_option('age_display_or_not','no');
 	add_option('image_display_or_not','no');
 	register_setting('optiongroup','age_display_or_not');
 	register_setting('optiongroup','image_display_or_not');
 }
 add_action('admin_init','register_plugin_setting');
 
 
 

?> 