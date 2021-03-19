
<h1>Content Settings</h1>

<form method='post' action='options.php'>
		<?php settings_fields('option_group');
                ?>
    <table>
        <tr>
            <td>
                <label>Text color </label>
            </td>
            <td>               
                <select name="text_color">
                    <option value="">Default</option>
                    <option value="red" <?php if (get_option('text_color')=='red'){ echo "selected";} ?>>Red</option>
                    <option value="green" <?php if (get_option('text_color')=='green'){ echo "selected";} ?>>Green</option>
                    <option value="blue" <?php if (get_option('text_color')=='blue'){ echo "selected";} ?>>Blue</option>
                </select>
           
            </td>
        </tr>
 	 <tr>
            <td>
                <label>Background color </label>
            </td>
            <td>
                <select name="background_color">
                    <option value="">Default</option>
                    <option value="red"  <?php if (get_option('background_color')=='red'){ echo "selected";} ?>>Red</option>
                    <option value="green" <?php if (get_option('background_color')=='green'){ echo "selected";} ?> >Green</option>
                    <option value="blue" <?php if (get_option('background_color')=='blue'){ echo "selected";} ?>>Blue</option>
                </select>
                    
            </td>
        </tr>	
 	<tr>
            <td>
                <?php submit_button('change option'); ?>
            </td>	
 	</tr>	
 		
                
    </table>            
 	</form>	