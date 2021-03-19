<form method="post">
    <label>Price<label>
    <input type="text" name="txtprice" value="<?php echo get_post_meta(get_the_ID(),'txtprice',true) ?>"><br><br>
    <label>Quantity<label>
    <input type="number" name="txtqty" value="<?php echo get_post_meta(get_the_ID(),'txtqty',true) ?>"><br><br>
    <label>Recipie select<label>
            <select name="sel">
                <option value="1" <?php if( get_post_meta(get_the_ID(),'sel',true)==1){echo 'selected';} ?>>1</option>
                <option value="2"<?php if( get_post_meta(get_the_ID(),'sel',true)==2){echo 'selected';} ?>>2</option>
                <option value="3"<?php if( get_post_meta(get_the_ID(),'sel',true)==3){echo 'selected';} ?>>3</option>            
            </select>
    <br><br>
    <label>Gender<label>
            <input type='radio' name='gen' value='male' <?php if( get_post_meta(get_the_ID(),'gen',true)=='male'){echo 'checked';} ?>>Male
            <input type='radio' name='gen' value='female' <?php if( get_post_meta(get_the_ID(),'gen',true)=='female'){echo 'checked';} ?>>Female
            <br><br>
    <label>Color<label><br>
            
            <input type='checkbox' name='myoption[one]' value='red' <?php if( get_post_meta(get_the_ID(),'chk[]',true)=='red'){echo 'checked';} ?>>Red<br> 
            <input type='checkbox' name='myoption[two]' value='blue'<?php if( get_post_meta(get_the_ID(),'chk[]',true)=='blue'){echo 'checked';} ?>>blue<br> 
            <input type='checkbox' name='myoption[three]' value='green'<?php if( get_post_meta(get_the_ID(),'chk[]',true)=='green'){echo 'checked';} ?>>green<br> 
</form> 

