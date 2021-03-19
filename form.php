<form method='post'>
        <label>Price : </label>
        <input type='text' name='txtPrice' value='<?php echo get_post_meta(get_the_ID(),'txtPrice',true); ?>'><br><br>
        <label>Quantity : </label>
          <input type='text' name='txtqty' value='<?php echo get_post_meta(get_the_ID(),'txtqty',true); ?>'><br><br>
</form>