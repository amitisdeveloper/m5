<!DOCTYPE html>
<html>
<head>
    <title>View Coin</title>
</head>
<body>
    <h2>View Coin</h2>
    <p>ID: <?php echo $coin['ID']; ?></p>
    <p>MasterID: <?php echo $coin['MasterID']; ?></p>
    <p>ClientID: <?php echo $coin['ClientID']; ?></p>
    <p>Amount: <?php echo $coin['Amount']; ?></p>
    <p>Created Date: <?php echo $coin['CreaterDate']; ?></p>
    <p>Created Time: <?php echo $coin['CreatedTime']; ?></p>
    <p>Created By: <?php echo $coin['CreatedBy']; ?></p>
    <p>Modify Date: <?php echo $coin['ModifyDate']; ?></p>
    <p>Modify Time: <?php echo $coin['ModifyTime']; ?></p>
    <p>Modify By: <?php echo $coin['ModifyBy']; ?></p>
    <a href="<?php echo site_url('addcoin'); ?>">Back</a>
</body>
</html>
