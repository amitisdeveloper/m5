<div class="container mt-4">
    <h4 class="mb-3">Statement of <strong><?= htmlentities($party) ?></strong></h4>

    <!-- Filter Form -->
    <form method="get" class="row g-3 mb-4">
        <div class="col-md-4">
            <label for="start_date" class="form-label">From Date</label>
            <input type="date" id="start_date" name="start_date" class="form-control" value="<?= htmlentities($start_date) ?>">
        </div>
        <div class="col-md-4">
            <label for="end_date" class="form-label">To Date</label>
            <input type="date" id="end_date" name="end_date" class="form-control" value="<?= htmlentities($end_date) ?>">
        </div>
        <div class="col-md-4 align-self-end">
            <button type="submit" class="btn btn-primary">Filter</button>
            <a href="<?= base_url(uri_string()) ?>" class="btn btn-secondary">Reset</a>
        </div>
    </form>

    <!-- Transaction Table -->
    <table class="table table-bordered table-striped">
        <thead>
            <tr>
                <th>Date/Time</th>
                <th>Deposit</th>
                <th>Withdraw</th>
                <th>P/L</th>
                <th>Balance</th>
                <th>From ➜ To</th>
            </tr>
        </thead>
       <tbody>
<?php if (empty($transactions)): ?>
    <tr>
        <td colspan="6" class="text-center text-muted">No transactions found.</td>
    </tr>
<?php else: ?>
    <?php
    $shown_pl_dates = [];
    //pr($transactions);
    foreach ($transactions as $tx):
        $date = date('Y-m-d', strtotime($tx['datetime']));
        $datetime = date('d-m-Y h:i A', strtotime($tx['datetime']));

        // Clean values
        $deposit_val = floatval(str_replace(',', '', $tx['deposit']));
        $withdraw_val = floatval(str_replace(',', '', $tx['withdraw']));
        $pl_val = floatval(str_replace(',', '', $tx['pl'] ?? 0));
        $balance = number_format(floatval(str_replace(',', '', $tx['balance'])), 2);

        $is_pl_row = $tx['from_to'] === 'P/L Adjustment';

        // ✅ Skip blank rows: all 3 must be 0
        if ($deposit_val == 0 && $withdraw_val == 0 && $pl_val == 0) {
            continue;
        }

        // ✅ Prevent duplicate P/L per date
        if ($is_pl_row && in_array($date, $shown_pl_dates)) {
            continue;
        }
        if ($is_pl_row) {
            $shown_pl_dates[] = $date;
        }

        // ✅ Use dashes instead of blank fields
        $deposit_display = $deposit_val > 0 ? number_format($deposit_val, 2) : '-';
        $withdraw_display = $withdraw_val > 0 ? '(' . number_format($withdraw_val, 2) . ')' : '-';
        $pl_display = $is_pl_row && $pl_val != 0 ? '<strong>' . number_format(abs($pl_val), 2) . '</strong>' : '-';
// $pl_display = number_format(abs($pl_val), 2); // removes +/-
        $pl_class = $pl_val < 0 ? 'text-success' : ($pl_val > 0 ? 'text-danger' : '');
    ?>
        <tr>
            <td><?= $is_pl_row ? $datetime . ' (P/L)' : $datetime ?></td>
            <td><?= $deposit_display ?></td>
            <td><?= $withdraw_display ?></td>
            <td class="<?= $pl_class ?>"><?= $pl_display ?></td>
            <td class="<?= $pl_class ?>"><strong><?= $balance ?></strong></td>
            <td><?= htmlentities($tx['from_to']) ?></td>
        </tr>
    <?php endforeach; ?>
<?php endif; ?>
</tbody>

    <?php if (!empty($transactions)): ?>
    <?php
    // ✅ Totals calculation
    $total_deposit = 0;
    $total_withdraw = 0;
    $total_pl = 0;

    foreach ($transactions as $tx) {
        $deposit_val = floatval(str_replace(',', '', $tx['deposit']));
        $withdraw_val = floatval(str_replace(',', '', $tx['withdraw']));
        $pl_val = floatval(str_replace(',', '', $tx['pl'] ?? 0));
        $is_pl_row = $tx['from_to'] === 'P/L Adjustment';

        $total_deposit += $deposit_val;
        $total_withdraw += $withdraw_val;
        if ($is_pl_row) {
            $total_pl += $pl_val;
        }
    }
    ?>
    <!-- ✅ New Totals Row -->
    <tr class="table-secondary">
    <td><strong>Total</strong></td>
    <td><strong><?= number_format($total_deposit, 2) ?></strong></td>
    <td><strong>(<?= number_format($total_withdraw, 2) ?>)</strong></td>
    <td><strong><?= number_format($total_pl, 2) ?></strong></td>
    <td><strong><?= $balance ?></strong></td>
    <td></td>
</tr>
<?php endif; ?>

</table>
</div>