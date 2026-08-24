<div class="container mt-4">
    <h4 class="mb-3">Master Commission Ledger Report</h4>

    <!-- Filter Form -->
    <form method="get" class="row g-3 mb-4">
        <div class="col-md-4">
            <label for="ledger_id" class="form-label">Select Ledger</label>
            <select id="ledger_id" name="ledger_id" class="form-select autoselected" required>
                <option value="">-- Select Party --</option>
                <?php foreach ($ledgers as $l): ?>
                    <option value="<?= $l['id'] ?>"
                        <?= ($ledger_id == $l['id']) ? 'selected' : '' ?>>
                        <?= htmlentities($l['ledger_name']) ?>
                    </option>
                <?php endforeach; ?>
            </select>
        </div>
        <div class="col-md-3">
            <label for="start_date" class="form-label">From Date</label>
            <input type="date" id="start_date" name="start_date" class="form-control"
                   value="<?= htmlentities($start_date ?? '') ?>" required>
        </div>
        <div class="col-md-3">
            <label for="end_date" class="form-label">To Date</label>
            <input type="date" id="end_date" name="end_date" class="form-control"
                   value="<?= htmlentities($end_date ?? '') ?>" required>
        </div>
        <div class="col-md-2 align-self-end">
            <button type="submit" class="btn btn-primary w-100">Filter</button>
        </div>
    </form>

    <?php if (!empty($party)): ?>
        <h5 class="mb-3">Ledger: <strong><?= htmlentities($party) ?></strong></h5>
    <?php endif; ?>

    <!-- Commission Table -->
    <table class="table table-bordered table-striped">
        <thead>
            <tr>
                <th>Date</th>
                <th>Total Commission</th>
            </tr>
        </thead>
        <tbody>
        <?php if (empty($commission_data)): ?>
            <tr>
                <td colspan="2" class="text-center text-muted">No commission data found.</td>
            </tr>
        <?php else: ?>
            <?php $grand_total = 0; ?>
            <?php foreach ($commission_data as $row): ?>
                <?php $grand_total += (float) $row['master_commission']; ?>
                <tr>
                    <td><?= date('d-m-Y', strtotime($row['report_date'])) ?></td>
                    <td><strong><?= number_format((float) $row['master_commission'], 2) ?></strong></td>
                </tr>
            <?php endforeach; ?>
            <tr class="table-info">
                <td><strong>Total</strong></td>
                <td><strong><?= number_format($grand_total, 2) ?></strong></td>
            </tr>
        <?php endif; ?>
        </tbody>
    </table>
</div>
<style>
    .select2-container {
    width: 100% !important;
}
</style>