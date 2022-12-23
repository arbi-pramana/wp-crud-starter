<?php
function employee_list() {
    global $wpdb;
    $table_name = $wpdb->prefix . 'employee_list';
    $employees = $wpdb->get_results("SELECT * from $table_name");
?>
<div id="wpbody" role="main">
    <div id="wpbody" role="main">
        <div class="wrap">
            <h1 class="wp-heading-inline">Employee</h1>
            <a href="http://localhost/coba-plugin/wp-admin/admin.php?page=employee-create" class="page-title-action">Add New</a>
            <hr class="wp-header-end">
            <br>
            <table class="wp-list-table widefat fixed striped table-view-list" id="table">
                <thead>
                    <th>ID</th>
                    <th>Name</th>
                    <th>File</th>
                    <th>Action</th>
                </thead>
                <tbody>
                    <?php foreach($employees as $i => $employee) { ?>
                        <tr>
                            <td><?= $i+1 ?></td>
                            <td><?= $employee->name ?></td>
                            <td>
                                <?php if(!empty($employee->filename)) { ?>
                                    <a href="<?= $employee->filename ?>" class="page-title-action">Open File</a>
                                <?php } ?>
                            </td>
                            <td>
                                <a href="<?= admin_url('admin.php?page=employee-edit&id='.$employee->id) ?>" class="page-title-action">Edit</a>
                                <a href="#" class="page-title-action" onclick="deleteData(<?= $employee->id ?>)">Delete</a>
                            </td>
                        </tr>
                    <?php } ?>
                </tbody>
            </table>
        </div>
    </div>
</div>
<script>
    function deleteData(id) {
        let q = "Are you sure delete this data?";
        if (confirm(q) == true) {
            window.location.href = "<?= admin_url('admin.php?page=employee-delete&id=')?>"+id;
        }
    }
</script>
<script>
    $(document).ready( function () {
        $('#table').DataTable();
    } );
</script>
<?php
}
add_shortcode('short_employee_list', 'employee_list');
require_once(ROOTDIR.'partials/head.php');
require_once(ROOTDIR.'partials/scripts.php');
?>