<div class="pull-right">
	<a href="<?php echo site_url('tbl_staff/add'); ?>" class="btn btn-success">Add</a> 
</div>

<table class="table table-striped table-bordered">
    <tr>
		<th>ID</th>
		<th>Password</th>
		<th>Staff Name</th>
		<th>Role</th>
		<th>W Mode</th>
		<th>Username</th>
		<th>Cash Agent</th>
		<th>Mobile</th>
		<th>Is Active</th>
		<th>Updated By</th>
		<th>Updated Date</th>
		<th>Address</th>
		<th>Actions</th>
    </tr>
	<?php foreach($tbl_openno as $t){ ?>
    <tr>
		<td><?php echo $t['id']; ?></td>
		<td><?php echo $t['password']; ?></td>
		<td><?php echo $t['staff_name']; ?></td>
		<td><?php echo $t['role']; ?></td>
		<td><?php echo $t['w_mode']; ?></td>
		<td><?php echo $t['username']; ?></td>
		<td><?php echo $t['cash_agent']; ?></td>
		<td><?php echo $t['mobile']; ?></td>
		<td><?php echo $t['is_active']; ?></td>
		<td><?php echo $t['updated_by']; ?></td>
		<td><?php echo $t['updated_date']; ?></td>
		<td><?php echo $t['address']; ?></td>
		<td>
            <a href="<?php echo site_url('tbl_staff/edit/'.$t['id']); ?>" class="btn btn-info btn-xs">Edit</a> 
            <a href="<?php echo site_url('tbl_staff/remove/'.$t['id']); ?>" class="btn btn-danger btn-xs">Delete</a>
        </td>
    </tr>
	<?php } ?>
</table>
