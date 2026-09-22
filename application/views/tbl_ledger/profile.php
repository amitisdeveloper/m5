<div class="row">
    <div class="col-md-8 col-sm-12">
        <div class="x_panel">
            <div class="x_title">
                <h2>WhatsApp Helpline</h2>
                <div class="clearfix"></div>
            </div>
            <div class="x_content">
                <?php if ($this->session->flashdata('message')) { ?>
                    <div class="alert alert-success" role="alert">
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">x</span></button>
                        <strong><?php echo $this->session->flashdata('message'); ?></strong>
                    </div>
                <?php } ?>

                <?php echo form_open('profile', array('class' => 'form-horizontal form-label-left')); ?>
                    <div class="form-group row">
                        <label class="control-label col-md-3 col-sm-3" for="helpline_number">WhatsApp Number</label>
                        <div class="col-md-9 col-sm-9">
                            <input type="text" name="helpline_number" id="helpline_number" value="<?php echo set_value('helpline_number', isset($tbl_ledger['helpline_number']) ? $tbl_ledger['helpline_number'] : ''); ?>" class="form-control" autocomplete="off" placeholder="Enter 10 digit Indian mobile number" maxlength="13">
                            <span class="text-danger"><?php echo form_error('helpline_number'); ?></span>
                            <small class="form-text text-muted">Use a valid Indian mobile number. +91 or leading 0 is accepted and will be saved as 10 digits.</small>
                        </div>
                    </div>

                    <div class="ln_solid"></div>
                    <div class="form-group">
                        <div class="col-md-9 col-sm-9 offset-md-3">
                            <button type="submit" class="btn btn-success">Save WhatsApp Helpline</button>
                        </div>
                    </div>
                <?php echo form_close(); ?>
            </div>
        </div>
    </div>
</div>
