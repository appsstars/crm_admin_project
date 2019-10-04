<div class="row">
    <div class="col-sm-4">
        <div class="panel panel-custom">
            <div class="panel-heading"><i class="fa fa-list"></i>
                <?= lang('quotation_details') ?>
            </div>
            <div class="panel-body">
                <ul class="list-group no-radius">
                    <?php
                    $client_info = $this->quotations_model->check_by(array('client_id' => $quotations_info->client_id), 'tbl_client');
                    $user_info = $this->quotations_model->check_by(array('user_id' => $quotations_info->user_id), 'tbl_users');
                    $reviewer_info = $this->quotations_model->check_by(array('user_id' => $quotations_info->reviewer_id), 'tbl_users');

                    if ($user_info->role_id == 1) {
                        $user = lang('admin');
                        $label = 'danger';
                    } elseif ($user_info->role_id == 2) {
                        $user = lang('client');
                        $label = 'success';
                    } else {
                        $user = lang('staff');
                        $label = 'primary';
                    }
                    if (!empty($reviewer_info)) {

                        if ($reviewer_info->role_id == 1) {
                            $r_user = lang('admin');
                            $r_label = 'danger';
                        } elseif ($reviewer_info->role_id == 2) {
                            $r_user = lang('client');
                            $r_label = 'success';
                        } else {
                            $r_user = lang('staff');
                            $r_label = 'primary';
                        }
                    } else {
                        $user = null;
                        $r_label = null;
                    }
                    $currency = $this->quotations_model->client_currency_sambol($quotations_info->client_id);
                    if (!empty($client_info)) {
                        if ($client_info->client_status == 1) {
                            $client_status = '' . lang('person') . '';
                        } else {
                            $client_status = '' . lang('company') . '';
                        }
                    } else {
                        $client_status = '';
                    }
                    ?>
                    <li class="list-group-item"><span
                            class="pull-right"><?= $quotations_info->name . ' ' . $client_status; ?></span><?= lang('client') ?>
                    </li>
                    <li class="list-group-item"><span
                            class="pull-right"><?= $quotations_info->email ?></span><?= lang('email') ?></li>
                    <li class="list-group-item"><span
                            class="pull-right"><?= $quotations_info->mobile; ?></span><?= lang('mobile') ?></li>
                    <li class="list-group-item"><span
                            class="pull-right"><?= strftime(config_item('date_format'), strtotime($quotations_info->quotations_date)) ?></span><?= lang('date') ?>
                    </li>
                    <li class="list-group-item"><span class="pull-right"><?php
                            if ($quotations_info->quotations_status == 'completed') {
                                echo '<span class="label label-success">' . lang('completed') . '</span>';
                            } else {
                                echo '<span class="label label-danger">' . lang('pending') . '</span>';
                            };
                            ?></span><?= lang('status') ?></li>

                    <li class="list-group-item"><span
                            class="pull-right"><?= $user_info->username . ' <small class="label label-' . $label . '">' . $user . '</small>'; ?></span><?= lang('generated_by') ?>
                    </li>
                    <?php if (!empty($reviewer_info)): ?>
                        <li class="list-group-item"><span
                                class="pull-right"><?= $reviewer_info->username . ' <small class="label label-' . $r_label . '">' . $r_user . '</small>'; ?></span><?= lang('reviewer') ?>
                        </li>
                        <li class="list-group-item"><span
                                class="pull-right"><?= strftime(config_item('date_format'), strtotime($quotations_info->reviewed_date)) ?></span><?= lang('reviewed_date') ?>
                        </li>
                    <?php endif; ?>
                    <li class="list-group-item">
                        <span class="pull-right">
                        <?php
                        if ($quotations_info->quotations_amount) {
                            echo display_money($quotations_info->quotations_amount, $currency->symbol);
                        }
                        ?>
                            </span>
                        <?= lang('quotations_amount') ?>
                    </li>
                    <blockquote
                        style="font-size: 12px;word-wrap: break-word "
                        class="mt-lg"><?php if (!empty($quotations_info->notes)) echo $quotations_info->notes; ?></blockquote>
                    <br/>
                    <div class="text-center">
                        <a data-toggle='modal' data-target='#myModal'
                           href="<?= base_url() ?>admin/quotations/set_price/<?= $quotations_info->quotations_id ?>"
                           class="btn btn-primary"><?= lang('price_quotation') ?></a>
                    </div>

                </ul>
            </div>
        </div>
    </div>
    <div class="col-sm-8">
        <div class="panel panel-custom">
            <div class="panel-heading  "><i class="fa fa-user"></i> <?= lang('quotaion_form_response') ?></div>
            <div class="panel-body">
                <?php if (!empty($quotation_details)):foreach ($quotation_details as $v_q_details): ?>
                    <label class="control-label"> <strong><?= $v_q_details->quotation_form_data ?></strong></label>
                    <?php
                    if (@unserialize($v_q_details->quotation_data)) {
                        $multiple_data = unserialize($v_q_details->quotation_data);
                        foreach ($multiple_data as $key => $value) {
                            ?>
                            <p style="word-wrap: break-word"><span><?= $key + 1 . '.' . $value ?></span></p>
                            <?php
                        }
                    } else {
                        ?>
                        <p style="word-wrap: break-word"><span><?= $v_q_details->quotation_data ?></span></p>
                    <?php } ?>
                <?php endforeach; ?>
                <?php endif; ?>
            </div>
        </div>
    </div>
</div>