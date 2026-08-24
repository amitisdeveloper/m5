<div class="pull-right">
	<a href="<?php echo site_url('tbl_agent/add'); ?>" class="btn btn-success">Add</a> 
</div>

<table class="table table-striped table-bordered">
    <tr>
		<th>ID</th>
		<th>Agent Name</th>
		<th>Main Agent Name</th>
		<th>Is Active</th>
		<th>Updated By</th>
		<th>Updated Date</th>
		<th>Actions</th>
    </tr>
	<?php foreach($tbl_agent as $t){ ?>
    <tr>
		<td><?php echo $t['id']; ?></td>
		<td><?php echo $t['agent_name']; ?></td>
		<td><?php echo $t['main_agent_name']; ?></td>
		<td><?php echo $t['is_active']; ?></td>
		<td><?php echo $t['updated_by']; ?></td>
		<td><?php echo $t['updated_date']; ?></td>
		<td>
            <a href="<?php echo site_url('tbl_agent/edit/'.$t['id']); ?>" class="btn btn-info btn-xs">Edit</a> 
            <a href="<?php echo site_url('tbl_agent/remove/'.$t['id']); ?>" class="btn btn-danger btn-xs">Delete</a>
        </td>
    </tr>
	<?php } ?>
</table>
