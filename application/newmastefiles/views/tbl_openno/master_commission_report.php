<div class="container mt-4">
    <h4 class="mb-3">
        Master Commission Statement of 
        <strong><?= htmlentities($party) ?></strong>
    </h4>

    <!-- Filter Form -->
    <form method="get" class="row g-3 mb-4">
        <div class="col-md-4">
            <label for="start_date" class="form-label">From Date</label>
            <input type="date" id="start_date" name="start_date" class="form-control"
                   value="<?= htmlentities($start_date ?? '') ?>">
        </div>
        <div class="col-md-4">
            <label for="end_date" class="form-label">To Date</label>
            <input type="date" id="end_date" name="end_date" class="form-control"
                   value="<?= htmlentities($end_date ?? '') ?>">
        </div>
        <div class="col-md-4 align-self-end">
            <button type="submit" class="btn btn-primary">Filter</button>
            <a href="<?= base_url(uri_string()) ?>" class="btn btn-secondary">Reset</a>
        </div>
    </form>

    <!-- Commission Table -->
    <table class="table table-bordered table-striped">
        <thead>
            <tr>
                <th style="width: 50%;">Date</th>
                <th style="width: 50%;">Total Commission</th>
            </tr>
        </thead>
        <tbody>
        <?php if (empty($commission_data)): ?>
            <tr>
                <td colspan="2" class="text-center text-muted">No commission data found.</td>
            </tr>
        <?php else: ?>
            <?php 
            $grand_total = 0;
            foreach ($commission_data as $row): 
                $grand_total += (float) $row['master_commission'];
            ?>
                <tr>
                    <td><?= date('d-m-Y', strtotime($row['report_date'])) ?></td>
                    <td>
                        <strong><?= number_format((float) $row['master_commission'], 2) ?></strong>
                    </td>
                </tr>
            <?php endforeach; ?>
            <!-- Total Row -->
            <tr class="table-info">
                <td><strong>Total</strong></td>
                <td><strong><?= number_format($grand_total, 2) ?></strong></td>
            </tr>
        <?php endif; ?>
        </tbody>
    </table>
</div>
