<?php
/**
 * Created by PhpStorm.
 * User: lcom53-two
 * Date: 2/12/2018
 * Time: 2:25 PM
 */

//to activate wp_redirect
ob_start();

function employee_create()
{
?>
<div class="row">
    <div class="col-md-12">
        <h1>Add Employee</h1>
    </div>
</div>
<div class="row">
    <div class="col-md-6 bg-white p-4 rounded">
        <form action="#" method="post" enctype="multipart/form-data">
            <div style="margin-top: 10px;">
                <label>Name </label><br>
                <input type="text" name="name" class="form-control"><br>
                <label>File </label><br>
                <input type="file" name="filename" class="form-control"><br>
                <br>
                <input type="submit" name="submit" class="btn btn-sm btn-success" value="Add New">
            </div>
        </form>
    </div>
</div>

<?php
    if(isset($_POST['submit'])){
        global $wpdb;
        if($_FILES['filename']["name"] != ''){
            $uploadedfile = $_FILES['filename'];
            $upload_overrides = array( 'test_form' => false );
        
            $movefile = wp_handle_upload( $uploadedfile, $upload_overrides );
            $imageurl = "";
            if ( $movefile && ! isset( $movefile['error'] ) ) {
               $imageurl = $movefile['url'];
            } else {
               echo $movefile['error'];
            }
        } else{
            $imageurl = '';
        }

        //init data 
        $name = $_POST['name'];
        
        //init table
        $table_name = $wpdb->prefix . 'employee_list';

        $wpdb->insert(
            $table_name,
            array(
                'name' => $name,
                'filename' => $imageurl
            )
        );
        wp_redirect( admin_url('admin.php?page=employee-list') );
        exit;
    }
}
?>