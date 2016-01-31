<?php 
    if($_POST['moxmov_hidden'] == 'Y') {
        //Form data sent
        $dbhost = $_POST['moxmov_dbhost'];
        update_option('moxmov_dbhost', $dbhost);
         
        $dbname = $_POST['moxmov_dbname'];
        update_option('moxmov_dbname', $dbname);
         
        $dbuser = $_POST['moxmov_dbuser'];
        update_option('moxmov_dbuser', $dbuser);
         
        $dbpwd = $_POST['moxmov_dbpwd'];
        update_option('moxmov_dbpwd', $dbpwd);
 
        $store_url = $_POST['moxmov_url'];
        update_option('moxmov_url', $store_url);
        ?>
        <div class="updated"><p><strong><?php _e('Options saved.' ); ?></strong></p></div>
        <?php
    } else {
        //Normal page display
        $dbhost = get_option('moxmov_dbhost');
        $dbname = get_option('moxmov_dbname');
        $dbuser = get_option('moxmov_dbuser');
        $dbpwd = get_option('moxmov_dbpwd');
        $store_url = get_option('moxmov_url');
    }
?>
<div class="wrap">
    <?php    echo "<h2>" . __( 'Moxie Movies', 'moxmov_trdom' ) . "</h2>"; ?>
     
    <form name="moxmov_form" method="post" action="<?php echo str_replace( '%7E', '~', $_SERVER['REQUEST_URI']); ?>">
        <input type="hidden" name="moxmov_hidden" value="Y">
        <?php    echo "<h4>" . __( 'Moxie Movies Settings', 'moxmov_trdom' ) . "</h4>"; ?>
        <p><?php _e("Database host: " ); ?><input type="text" name="moxmov_dbhost" value="<?php echo $dbhost; ?>" size="20"><?php _e(" ex: localhost" ); ?></p>
        <p><?php _e("Database name: " ); ?><input type="text" name="moxmov_dbname" value="<?php echo $dbname; ?>" size="20"><?php _e(" ex: oscommerce_shop" ); ?></p>
        <p><?php _e("Database user: " ); ?><input type="text" name="moxmov_dbuser" value="<?php echo $dbuser; ?>" size="20"><?php _e(" ex: root" ); ?></p>
        <p><?php _e("Database password: " ); ?><input type="text" name="moxmov_dbpwd" value="<?php echo $dbpwd; ?>" size="20"><?php _e(" ex: secretpassword" ); ?></p>
        <hr />
        <?php    echo "<h4>" . __( 'Endpoint Settings', 'moxmov_trdom' ) . "</h4>"; ?>
        <p><?php _e("Movies URL: " ); ?><input type="text" name="moxmov_url" value="<?php echo $movies_url; ?>" size="20"><?php _e(" ex: http://example.dev/movies.json" ); ?></p>
        
         
     
        <p class="submit">
        <input type="submit" name="Submit" value="<?php _e('Update Options', 'moxmov_trdom' ) ?>" />
        </p>
    </form>
</div>
