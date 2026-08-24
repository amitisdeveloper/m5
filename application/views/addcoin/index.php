<!DOCTYPE html>
<html>
<head>
    <title>Add Coin List</title>
</head>
<body>
    <h2>Add Coin List</h2>
    <a href="<?php echo site_url('addcoin/create'); ?>">Add Coin</a>
    <table>
        <tr>
            <th>ID</th>
            <th>MasterID</th>
            <th>ClientID</th>
            <th>Amount</th>
            <th>Created Date</th>
            <th>Created Time</th>
            <th>Created By</th>
            <th>Modify Date</th>
            <th>Modify Time</th>
            <th>Modify By</th>
            <th>Actions</th>
        </tr>
        <?php foreach ($coins as $coin): ?>
        <tr>
            <td><?php echo $coin['ID']; ?></td>
            <td><?php echo $coin['MasterID']; ?></td>
            <td><?php echo $coin['ClientID']; ?></td>
            <td><?php echo $coin['Amount']; ?></td>
            <td><?php echo $coin['CreaterDate']; ?></td>
            <td><?php echo $coin['CreatedTime']; ?></td>
            <td><?php echo $coin['CreatedBy']; ?></td>
            <td><?php echo $coin['ModifyDate']; ?></td>
            <td><?php echo $coin['ModifyTime']; ?></td>
            <td><?php echo $coin['ModifyBy']; ?></td>
            <td>
                <a href="<?php echo site_url('addcoin/view/'.$coin['ID']); ?>">View</a>
                <a href="<?php echo site_url('addcoin/edit/'.$coin['ID']); ?>">Edit</a>
                <a href="<?php echo site_url('addcoin/delete/'.$coin['ID']); ?>">Delete</a>
            </td>
        </tr>
        <?php endforeach; ?>
    </table>
</body>
</html>
