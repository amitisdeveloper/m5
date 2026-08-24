<div class="pull-right">
	<a href="<?php echo site_url('tbl_shift/add'); ?>" class="btn btn-success">Add</a> 
</div>

<table class="table table-striped table-bordered">
    <tr>
		<th>ID</th>
		<th>Shift Name</th>
		<th>Open Date</th>
		<th>Next Day</th>
		<th>Shift Working For</th>
		<th>Owner</th>
		<th>Super Admin</th>
		<th>Fanter</th>
		<th>Cash Agent</th>
		<th>Admin</th>
		<th>Data Entry Operator</th>
		<th>Is Active</th>
		<th>Updated By</th>
		<th>Updated Date</th>
		<th>Actions</th>
    </tr>
	<?php foreach($tbl_shift as $t){ ?>
    <tr>
		<td><?php echo $t['id']; ?></td>
		<td><?php echo $t['shift_name']; ?></td>
		<td><?php echo $t['open_date']; ?></td>
		<td><?php echo $t['next_day']; ?></td>
		<td><?php echo $t['shift_working_for']; ?></td>
		<td><?php echo $t['owner']; ?></td>
		<td><?php echo $t['super_admin']; ?></td>
		<td><?php echo $t['fanter']; ?></td>
		<td><?php echo $t['cash_agent']; ?></td>
		<td><?php echo $t['admin']; ?></td>
		<td><?php echo $t['data_entry_operator']; ?></td>
		<td><?php echo $t['is_active']; ?></td>
		<td><?php echo $t['updated_by']; ?></td>
		<td><?php echo $t['updated_date']; ?></td>
		<td>
            <a href="<?php echo site_url('tbl_shift/edit/'.$t['id']); ?>" class="btn btn-info btn-xs">Edit</a> 
            <a href="<?php echo site_url('tbl_shift/remove/'.$t['id']); ?>" class="btn btn-danger btn-xs">Delete</a>
        </td>
    </tr>
	<?php } ?>
</table>
<div class="pull-right">
    <?php echo $this->pagination->create_links(); ?>    
</div>
