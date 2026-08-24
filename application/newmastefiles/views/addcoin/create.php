<!DOCTYPE html>
<html>
<head>
    <title>Create Coin</title>
</head>
<body>
    <h2>Create Coin</h2>
    <?php echo validation_errors(); ?>
    <?php echo form_open('addcoin/create'); ?>

    <label for="masterid">MasterID</label>
    <input type="input" name="masterid" /><br />

    <label for="clientid">ClientID</label>
    <input type="input" name="clientid" /><br />

    <label for="amount">Amount</label>
    <input type="input" name="amount" /><br />

    <label for="createdate">Created Date</label>
    <input type="date" name="createdate" /><br />

    <label for="createtime">Created Time</label>
    <input type="time" name="createtime" /><br />

    <label for="createdby">Created By</label>
    <input type="input" name="createdby" /><br />

    <label for="modifydate">Modify Date</label>
    <input type="date" name="modifydate" /><br />

    <label for="modifytime">Modify Time</label>
    <input type="time" name="modifytime" /><br />

    <label for="modifyby">Modify By</label>
    <input type="
