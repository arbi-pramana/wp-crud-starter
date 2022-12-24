<?php
function employee_list() {
    global $wpdb;
    $table_name = $wpdb->prefix . 'employee_list';
    $employees = $wpdb->get_results("SELECT * from $table_name");
?>
<div class="row">
    <div class="col-md-12">
        <h1>
            Employee
            <a href="<?= admin_url('admin.php?page=employee-create') ?>" class="btn btn-sm btn-outline-success"><i class="fa fa-plus"></i> Add New</a>
        </h1>
    </div>
</div>
<div class="row">
    <div class="col-md-12 p-4 bg-white rounded">
        <table class="table table-striped table-hover" id="table">
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
                                <a href="<?= $employee->filename ?>" class="btn btn-sm btn-outline-secondary"><i class="fa fa-download"></i> Open File</a>
                            <?php } ?>
                        </td>
                        <td>
                            <a href="<?= admin_url('admin.php?page=employee-edit&id='.$employee->id) ?>" class="btn btn-sm btn-outline-info"><i class="fa fa-pencil"></i> Edit</a>
                            <a href="#" onclick="deleteData(<?= $employee->id ?>)" class="btn btn-sm btn-outline-danger"><i class="fa fa-trash"></i> Delete</a>
                        </td>
                    </tr>
                <?php } ?>
            </tbody>
        </table>
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
try {
    add_shortcode('short_employee_list', 'employee_list');
    require_once(ROOTDIR.'partials/head.php');
    require_once(ROOTDIR.'partials/scripts.php');
} catch (\Throwable $th) {
}
?>