
    <?php 
    $nameErr=$mobileErr=$EmailErr=$DOBErr=$ContestErr='';
    
    
    global $wpdb;
//Insert code
If(isset($_POST['submit'])){
    
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
			 $res=$wpdb->insert('wp_participant',$data);
                         if($res)
                         {
                             $Success='Added successfully';
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
   
   <body>
<form method="post"  enctype="multipart/form-data">
    <?php settings_fields('optionsgroup'); ?>
    <h2>Add participant</h2>
    <table>
   <tr>
        <td>
         <label>Name: </label>
        </td>
        <td>
            <input type="text" name="txtname" placeholder="Enter Name">
            <span class = "error"> <?php echo $nameErr;?></span>
        </td>
    <tr>
    <tr>
        <td>
         <label>Profile photo: </label>
        </td>
        <td>
            <input type="file" name="file" id="fileToUpload">
        </td>
    <tr>
    <tr>
        <td>
            <label>Mobile number: </label>
        </td>
        <td>
            <input type="text" name="txtmob" placeholder="Enter Mobile Number">
            <span class = "error"> <?php echo $mobileErr;?></span>
        </td>
    </tr>
    <tr>
        <td>
         <label>Email id: </label>
         </td>
         <td>
            <input type="email" name="txtemail" placeholder="Enter Email">
            <span class = "error"> <?php echo $EmailErr;?></span>
        </td>
    </tr>
    <tr>
        <td>
         <label>Date of birth: </label>
         </td>
         <td>
             <input type="text" name="txtdob" placeholder="YYYY/MM/DD">
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
                        <option value="<?php echo $auc->ID; ?>"><?php echo $auc->post_title; ?></option>
                        <?php
                    }
                    ?>                       
            </select>
             <span class = "error"> <?php echo $ContestErr;?></span>
        </td>
    </tr>
    <tr>
        <td>
            <input type="submit" name="submit" value="Add Participant">
            <span class = "success"> <?php echo $Success;?></span>
        </td>
        
        <br>
        
             
    </tr>
    </table>
</form>
</body>
    <?php

add_action('admin_menu','create_admin_menu');

//MYSQL CREATE PARTICIPANT TABLE
/*
CREATE TABLE `wordpress`.`wp_participant` (
  `p_id` INT NOT NULL PRIMARY KEY AUTO_INCREMENT,
  `name` VARCHAR(30) NOT NULL,
  `profile_photo` VARCHAR(30) NOT NULL ,
  `mobile_no` VARCHAR(10) NOT NULL ,
  `email`  VARCHAR(50) NOT NULL ,
  `DOB` DATE NOT NULL ,
  `ID` INT NOT NULL REFERENCES wp_posts(ID) 
);
 */


?> 