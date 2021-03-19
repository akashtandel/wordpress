<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
?>
<h1>Content Settings</h1>

<form method='post' action='options.php'>
		<?php settings_fields('optiongroup');
                ?>
    
    <table>
        <tr>
            <td>
                <label>Display participant age at frontend? </label>
            </td>
            <td>               
                
              <input type="radio" name="age_display_or_not"
                <?php if (get_option('age_display_or_not')=='yes') echo "checked"; ?>
                       value="yes">Yes
           
                <input type="radio" name="age_display_or_not"
                <?php if (get_option('age_display_or_not')=='no') echo "checked"; ?> 
                       value="no">No
            </td>
        </tr>
 	 <tr>
            <td>
                <label>Display participant profile photo at frontend? </label>
            </td>
            <td>

                    <input type="radio" name="image_display_or_not"
                <?php if (get_option('image_display_or_not')=='yes') echo "checked"; ?>
                       value="yes">Yes
     
                <input type="radio" name="image_display_or_not"
                <?php if (get_option('image_display_or_not')=='no') echo "checked"; ?>
                       value="no">No
            </td>
        </tr>	
 	<tr>
            <td>
                <?php submit_button('change option'); ?>
            </td>	
 	</tr>	
 		
                
    </table>            
 	</form>	  
