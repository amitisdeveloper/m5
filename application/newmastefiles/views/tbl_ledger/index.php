<div class="pull-right">
	<a href="<?php echo site_url('tbl_ledger/add'); ?>" class="btn btn-success">Add</a> 
</div>

<table class="table table-striped table-bordered">
    <tr>
		<th>ID</th>
		<th>Ledger Name</th>
		<th>Real Name</th>
		<th>Group</th>
		<th>Dara Rate</th>
		<th>Akhar Rate</th>
		<th>Grp Name</th>
		<th>Mobile</th>
		<th>Updated By</th>
		<th>Updated Date</th>
		<th>Commision</th>
		<th>Commission</th>
		<th>Tp Commission</th>
		<th>Rebate</th>
		<th>Tp R</th>
		<th>Hissa</th>
		<th>Address</th>
		<th>Actions</th>
    </tr>
	<?php foreach($tbl_ledger as $t){ pr($tbl_ledger,1);if($t['updated_by']!=1){ ?>
    <tr>
		<td><?php echo $t['id']; ?></td>
		<td><?php echo $t['ledger_name']; ?></td>
		<td><?php echo $t['real_name']; ?></td>
		<td><?php echo $t['group']; ?></td>
		<td><?php echo $t['dara_rate']; ?></td>
		<td><?php echo $t['akhar_rate']; ?></td>
		<td><?php echo $t['grp_name']; ?></td>
		<td><?php echo $t['mobile']; ?></td>
		<td><?php echo $t['updated_by']; ?></td>
		<td><?php echo $t['updated_date']; ?></td>
		<td><?php echo $t['commision']; ?></td>
		<td><?php echo $t['commission']; ?></td>
		<td><?php echo $t['tp_commission']; ?></td>
		<td><?php echo $t['rebate']; ?></td>
		<td><?php echo $t['tp_r']; ?></td>
		<td><?php echo $t['hissa']; ?></td>
		<td><?php echo $t['address']; ?></td>
		<td>
            <a href="<?php echo site_url('tbl_ledger/edit/'.$t['id']); ?>" class="btn btn-info btn-xs">Edit</a> 
            <a href="<?php echo site_url('tbl_ledger/remove/'.$t['id']); ?>" class="btn btn-danger btn-xs">Delete</a>
        </td>
    </tr>
	<?php } 
	}
	?>
</table>
