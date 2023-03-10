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
<div class="row">
    <div class="col-md-12">
        <h1>Edit Employee</h1>
    </div>
</div>
<div class="row">
    <div class="col-md-6 bg-white p-4 rounded">
        <form action="#" method="post" enctype="multipart/form-data">
            <div style="margin-top: 10px;">
                <label>Name </label><br>
                <input type="text" name="name" class="form-control" value="<?= $employee->name ?>"><br>
                <br>
                <label>File </label> <br>
                <input type="file" name="filename" class="form-control"><br>
                <?php if(!empty($employee->filename)) { ?>
                    <a href="<?= $employee->filename ?>" class="btn btn-sm btn-outline-secondary"><i class="fa fa-download"></i> Open File</a><br>
                <?php } ?>
                <br>
                <input type="submit" name="submit" id="submit" class="btn btn-sm btn-primary" value="Update">
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
        } else {
            $imageurl = $employee->filename;
        }

        //init data 
        $name = $_POST['name'];
        
        $wpdb->update(
            $table_name,
            array(
                'name' => $name,
                'filename' => $imageurl
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