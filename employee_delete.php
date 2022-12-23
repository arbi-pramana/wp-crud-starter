<?php
//to activate wp_redirect
ob_start();

function employee_delete(){
    if(isset($_GET['id'])){
        global $wpdb;
        //init table
        $table_name = $wpdb->prefix.'employee_list';
        
        $wpdb->delete(
            $table_name,
            array('id'=>$_GET['id'])
        );
        wp_redirect( admin_url('admin.php?page=employee-list') );
        exit;
    }
}
?>