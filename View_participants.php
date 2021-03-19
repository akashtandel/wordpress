<?php
global $wpdb;

?>
<html>
        <head>
   <script >
           
     
            </script>
 </head>
 <body>
     <form method="post"  enctype="multipart/form-data">
     <h1>View participants</h1>
             <table>
             <tr>
                 <td>
                     <label>Select Level of Contest</label>
                 <td>
                     <select name="Contest">
                      <option value="">--Select--</option>
                      <?php $res=new WP_Query(array('post_type'=>'recipie_contest','post_status'=>'publish'));
                      while($res->have_posts())
                      {
                          $res->the_post();
                      
                      ?>
                      <option value="<?php echo the_ID() ?>"><?php echo get_the_title() ?></option>
                      <?php
                      }
                      ?>
                 </td>
                 </td>
             </tr>
             <tr>
                 <td>
                     <input type="submit" name="submit" value="Show participants">
                 </td>
             </tr>
             </table>
     <br><br>
    
 </body>
</html>
<?php 
if(isset($_GET['eid']))
{
    //include_once ('edit_participant.php');
    ?>
    <?php 
    $nameErr=$mobileErr=$EmailErr=$DOBErr=$ContestErr='';
    
    
    global $wpdb;
//Insert code
if(isset($_POST['submit'])){
    
    ////////validation/////////
    //name
    if(!empty($_POST['txtname']))
    {
        $name=$_POST['txtname'];
    }
    else
    {
        $nameErr='Please enter name';
    }
    //email
    if (empty($_POST["txtemail"])) {
               $EmailErr = "Email is required";
            }else {
               $email = $_POST["txtemail"];
               
               // check if e-mail address is well-formed
               if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
                  $EmailErr = "Invalid email format"; 
               }
            }
      //Mobile
      if (!empty($_POST['txtmob'])) {
        if (!preg_match('/^[0-9]{10}+$/', $_POST['txtmob'])) {
            $mobileErr = 'Mobile number must be 10 digits only';
        }
        $mobile = $_POST['txtmob'];
    } else {
        $mobileErr = 'Please enter mobile number';
    }
    
    //DOB
    if(!empty($_POST['txtdob']))
    {
        $DOB=$_POST['txtdob'];
    }
    else
    {
        $DOBErr='Please enter date of birth';
    }
    //cotest
     if(!empty($_POST['contest']))
    {
        $contest=$_POST['contest'];
    }
    else
    {
        $ContestErr='Please select contest';
    }
    
    ////end validation//////

    $data=array(
        'name'=>$name,
        'profile_photo'=>$_FILES['file']['name'],
         'mobile_no'=>$mobile,
        'email'=>$email,   
        'DOB'=>$DOB,
        'ID'=>$contest
    );
    move_uploaded_file($_FILES['file']['tmp_name'],"/var/www/html/mcal19/mcal19005/uploads/".$_FILES['file']['name']);
        
             $res=$wpdb->update('wp_participant',$data,array('p_id'=>$_GET['eid']));
                         if($res)
                         {
                             $Success='Updated successfully';
                         }
                         else
                         {
                             echo 'Failed';
                         }
        
     
    }

   
    

    ?>
<html>
   
   <head>
      <style>
         .error {color: #FF0000;}
         .success{color: green;}
      </style>
   </head>
   <?php
   $post_id = $wpdb->get_results("SELECT * FROM wp_participant WHERE p_id={$_GET['eid']}", ARRAY_A);
    print_r($post_id);
   ?>
    
   <body>
<form method="post"  enctype="multipart/form-data">
    <?php settings_fields('optionsgroup'); ?>
    <h2>Update participant <?php $post_id[0]['name']; ?></h2>
    <table>
   <tr>
        <td>
         <label>Name: </label>
        </td>
        <td>
            <input type="text" name="txtname" placeholder="Enter Name" value="<?php echo $post_id[0]['name']; ?>">
            <span class = "error"> <?php echo $nameErr;?></span>
        </td>
    <tr>
    <tr>
        <td>
         <label>Profile photo: </label>
        </td>
        <td>
            <input type="file" name="file" id="fileToUpload" value="<?php echo $post_id[0]['profile_photo']; ?>">
        </td>
    <tr>
    <tr>
        <td>
            <label>Mobile number: </label>
        </td>
        <td>
            <input type="text" name="txtmob" placeholder="Enter Mobile Number" value="<?php echo $post_id[0]['mobile_no']; ?>">
            <span class = "error"> <?php echo $mobileErr;?></span>
        </td>
    </tr>
    <tr>
        <td>
         <label>Email id: </label>
         </td>
         <td>
            <input type="email" name="txtemail" placeholder="Enter Email"  value="<?php echo $post_id[0]['email']; ?>" >
            <span class = "error"> <?php echo $EmailErr;?></span>
        </td>
    </tr>
    <tr>
        <td>
         <label>Date of birth: </label>
         </td>
         <td>
             <input type="date" name="txtdob" placeholder="YYYY/MM/DD" value="<?php echo $post_id[0]['DOB']; ?>" >
             <span class = "error"> <?php echo $DOBErr;?></span>
        </td>
    </tr>
    <tr>
        <td>
         <label>Select Contest: </label>

         </td>
         <td>
            <select name="contest">
                <option value="">--Select--</option>
                    <?php
                    $auctions = get_posts(array('post_type' => 'Recipie_Contest', 'post_status' => 'publish'));
                    foreach ($auctions as $auc) {
                        ?>
                        <option value="<?php echo $auc->ID; if($auc->ID==$post_id[0]['ID']){
                            echo selected;
                        }?>"><?php echo $auc->post_title; ?></option>
                        <?php
                    }
                    ?>                       
            </select>
             <span class = "error"> <?php echo $ContestErr;?></span>
        </td>
    </tr>
    <tr>
        <td>
            <input type="submit" name="submit" value="update Participant">
            <span class = "success"> <?php echo $Success;?></span>
        </td>
        
        <br>
        
             
    </tr>
    </table>
</form>
</body> 
    <?php
}
 else {
if(isset($_POST['submit']))
{
    $Contest_id=$_POST['Contest'];
    $result=$wpdb->get_results("select * from wp_participant p inner join wp_posts wp on p.ID=wp.ID where wp.ID=$Contest_id",ARRAY_A); 
    
    if($result !=null)
    {
       //print_r( $result);
    ?>
    <h3>Participants of <?php $result['post_title'];
    ?></h3>
<?php 
     ?>

    <?php

?>
    <table border='1'>
        <th>
            Name
        </th>
       
         <th>
            Profile Photo
        </th>
     
         <th>
            Mobile Number
        </th>
        <th>
            Email
        </th>
        <th>
            Date of Birth   
        </th>
        <th>
            Edit
        </th>
         <th>
            delete  
        </th>
    <?php
    foreach ($result as $row)
    {
        ?>
        <tr>
            <td>
                <?php echo $row['name']; ?>
            </td>
            <td>
                <?php 
                              
                   // echo "<img width='50' height='60'  src='".plugin_dir_path(__FILE__)."/uploads/$Img_name'>";
                $path="wp-content/plugins/receipe/uploads/";

                ?>
                <img width="50" height="60" src="<?php echo "http://192.168.40.8/mcal19/mcal19005/uploads/".$row['profile_photo'];?>" alt="Error" >
            </td>
            <td>
                <?php echo $row['mobile_no']; ?>
            </td>
            <td>
                <?php echo $row['email']; ?>
            </td>
            <td>
                <?php echo $row['DOB']; ?>
            </td>
            <td>
                 <a href="<?php  echo admin_url('admin.php?page=View_participants&eid='.$row['p_id']); ?>">Edit</a>
                
            </td>
            <td>
                 
               <a href='<?php echo admin_url('admin.php?page=View_participants&delete='.$row['p_id']); ?>'>delete</a></td>

            </td>
        </tr>
         </form>
        <?php 
    }
}
}
if(isset($_GET['delete']))
{
	//echo $_GET['delete'];
	global $wpdb;
    //$data=$wpdb->query("Delete from wp_participant where p_id={$_GET['id']}");
	$data=$wpdb->delete("wp_participant",array("p_id"=>$_GET['delete']));
    //echo $data;
    //echo admin_url('admin.php?page=View_participants');
	//header("location:?page=view_participant");
}
}
    ?>
     </table>