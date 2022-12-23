<?php
/**
 * Created by PhpStorm.
 * User: lcom53-two
 * Date: 2/12/2018
 * Time: 2:25 PM
 */

//to activate wp_redirect
ob_start();

function employee_edit()
{
    global $wpdb;
    //init
    $id = $_GET['id'];
    //table
    $table_name = $wpdb->prefix . 'employee_list';
    $employee = $wpdb->get_row("SELECT * from $table_name where id = $id");
?>
<div id="wpbody" role="main">
    <div id="wpbody" role="main">
        <div class="wrap">
            <h1 class="wp-heading-inline">Edit Employee</h1>
            <form action="#" method="post">
                <div style="margin-top: 10px;">
                    <label>Name </label><br>
                    <input type="text" name="name" value="<?= $employee->name ?>"><br>
                    <br>
                    <input type="submit" name="submit" id="submit" class="button button-primary" value="Update">
                </div>
            </form>
        </div>
    </div>
</div>

<?php
    if(isset($_POST['submit'])){
        global $wpdb;

        //init data 
        $name = $_POST['name'];
        
        $wpdb->update(
            $table_name,
            array(
                'name' => $name,
            ),
            array(
                'id'=>$id
            )
        );
        wp_redirect( admin_url('admin.php?page=employee-list') );
        exit;
    }
}
?>