<table border="1" width="100%">
    <tr>
		<th>ID</th>
		<th>PartyId</th>
		<th>Collect By</th>
		<th>Date</th>
		<th>Amount</th>
		<th>Remarks</th>
		<th>Actions</th>
    </tr>
	<?php foreach($tbl_voucher as $t){ ?>
    <tr>
		<td><?php echo $t['id']; ?></td>
		<td><?php echo $t['PartyId']; ?></td>
		<td><?php echo $t['Collect_By']; ?></td>
		<td><?php echo $t['Date']; ?></td>
		<td><?php echo $t['Amount']; ?></td>
		<td><?php echo $t['Remarks']; ?></td>
		<td>
            <a href="<?php echo site_url('tbl_voucher/edit/'.$t['id']); ?>">Edit</a> | 
            <a href="<?php echo site_url('tbl_voucher/remove/'.$t['id']); ?>">Delete</a>
        </td>
    </tr>
	<?php } ?>
</table>
<div class="pull-right">
    <?php echo $this->pagination->create_links(); ?>    
</div>
