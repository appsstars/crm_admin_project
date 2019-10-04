<?= message_box('success'); ?>
<?= message_box('error'); ?>

<?php
$mdate = date('Y-m-d');
$last_7_days = date('Y-m-d', strtotime('today - 7 days'));
$all_goal_tracking = $this->transactions_model->get_permission('tbl_goal_tracking');

$all_goal = 0;
$bank_goal = 0;
$complete_achivement = 0;
if (!empty($all_goal_tracking)) {
    foreach ($all_goal_tracking as $v_goal_track) {
        $goal_achieve = $this->transactions_model->get_progress($v_goal_track, true);
        if ($v_goal_track->goal_type_id == 1) {
            if ($v_goal_track->end_date <= $mdate) { // check today is last date or not

                if ($v_goal_track->email_send == 'no') {// check mail are send or not
                    if ($v_goal_track->achievement <= $goal_achieve['achievement']) {
                        if ($v_goal_track->notify_goal_achive == 'on') {// check is notify is checked or not check
                            $this->transactions_model->send_goal_mail('goal_achieve', $v_goal_track);
                        }
                    } else {
                        if ($v_goal_track->notify_goal_not_achive == 'on') {// check is notify is checked or not check
                            $this->transactions_model->send_goal_mail('goal_not_achieve', $v_goal_track);
                        }
                    }
                }
            }
            $all_goal += $v_goal_track->achievement;
            $complete_achivement += $goal_achieve['achievement'];
        }
        if ($v_goal_track->goal_type_id == 2) {
            if ($v_goal_track->end_date <= $mdate) { // check today is last date or not

                if ($v_goal_track->email_send == 'no') {// check mail are send or not
                    if ($v_goal_track->achievement <= $goal_achieve['achievement']) {
                        if ($v_goal_track->notify_goal_achive == 'on') {// check is notify is checked or not check
                            $this->transactions_model->send_goal_mail('goal_achieve', $v_goal_track);
                        }
                    } else {
                        if ($v_goal_track->notify_goal_not_achive == 'on') {// check is notify is checked or not check
                            $this->transactions_model->send_goal_mail('goal_not_achieve', $v_goal_track);
                        }
                    }
                }
            }

            $bank_goal += $v_goal_track->achievement;
            $complete_achivement += $goal_achieve['achievement'];
        }

    }
}
// 30 days before

for ($iDay = 7; $iDay >= 0; $iDay--) {
    $date = date('Y-m-d', strtotime('today - ' . $iDay . 'days'));
    $this_7_days_deposit[$date] = $this->db->select_sum('amount')->where(array('type' => 'Income', 'date >=' => $date, 'date <=' => $date))->get('tbl_transactions')->result();
}

$this_7_days_all = $this->db->where(array('goal_type_id' => 1, 'start_date >=' => $last_7_days, 'end_date <=' => $mdate))->get('tbl_goal_tracking')->result();

$this_7_days_bank = $this->db->where(array('goal_type_id' => 2, 'start_date >=' => $last_7_days, 'end_date <=' => $mdate))->get('tbl_goal_tracking')->result();

if (!empty($this_7_days_all)) {
    $this_7_days_all = $this_7_days_all;
} else {
    $this_7_days_all = array();
}
if (!empty($this_7_days_bank)) {
    $this_7_days_bank = $this_7_days_bank;
} else {
    $this_7_days_bank = array();
}


$terget_achievement = array_merge($this_7_days_all, $this_7_days_bank);
$total_terget = 0;
if (!empty($terget_achievement)) {
    foreach ($terget_achievement as $v_terget) {
        $total_terget += $v_terget->achievement;
    }
}
$tolal_goal = $all_goal + $bank_goal;
$curency = $this->transactions_model->check_by(array('code' => config_item('default_currency')), 'tbl_currencies');

if ($this->session->userdata('user_type') == 1) {
    $margin = 'margin-bottom:30px';
    ?>
    <div class="col-sm-12 bg-white p0" style="<?= $margin ?>">
        <div class="col-md-4">
            <div class="row row-table pv-lg">
                <div class="col-xs-6">
                    <p class="m0 lead"><?= display_money($tolal_goal, $curency->symbol) ?></p>
                    <p class="m0">
                        <small><?= lang('achievement') ?></small>
                    </p>
                </div>
                <div class="col-xs-6 ">
                    <p class="m0 lead"><?= display_money($total_terget, $curency->symbol) ?></p>
                    <p class="m0">
                        <small><?= lang('last_weeks') . ' ' . lang('created') ?></small>
                    </p>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="row row-table ">
                <div class="col-xs-6">
                    <p class="m0 lead"><?= display_money($complete_achivement, $curency->symbol) ?></p>
                    <p class="m0">
                        <small><?= lang('completed') . ' ' . lang('achievements') ?></small>
                    </p>
                </div>
                <div class="col-xs-6 pt">
                    <div data-sparkline="" data-bar-color="#23b7e5" data-height="60" data-bar-width="8"
                         data-bar-spacing="6" data-chart-range-min="0" values="<?php
                    if (!empty($this_7_days_deposit)) {
                        foreach ($this_7_days_deposit as $v_last_deposit) {
                            echo $v_last_deposit[0]->amount . ',';
                        }
                    }
                    ?>">
                    </div>
                    <p class="m0">
                        <small>
                            <?php
                            if (!empty($this_7_days_deposit)) {
                                foreach ($this_7_days_deposit as $date => $v_last_deposit) {
                                    echo date('d', strtotime($date)) . ' ';
                                }
                            }
                            ?>
                        </small>
                    </p>

                </div>
            </div>

        </div>
        <div class="col-md-4">
            <div class="row row-table ">
                <div class="col-xs-6">
                    <p class="m0 lead">
                        <?php
                        if ($tolal_goal < $complete_achivement) {
                            $pending_goal = 0;
                        } else {
                            $pending_goal = $tolal_goal - $complete_achivement;
                        } ?>
                        <?= display_money($pending_goal, $curency->symbol) ?>
                    </p>
                    <p class="m0">
                        <small><?= lang('pending') . ' ' . lang('achievements') ?></small>
                    </p>
                </div>
                <?php
                if ($tolal_goal <= $complete_achivement) {
                    $total_progress = 100;
                } else {
                    $progress = ($complete_achivement / $tolal_goal) * 100;
                    $total_progress = round($progress);
                }
                ?>
                <div class="col-xs-6 text-center pt">
                    <div class="inline ">
                        <div class="easypiechart text-success"
                             data-percent="<?= $total_progress ?>"
                             data-line-width="5" data-track-Color="#f0f0f0"
                             data-bar-color="#<?php
                             if ($total_progress == 100) {
                                 echo '8ec165';
                             } elseif ($total_progress >= 40 && $total_progress <= 50) {
                                 echo '5d9cec';
                             } elseif ($total_progress >= 51 && $total_progress <= 99) {
                                 echo '7266ba';
                             } else {
                                 echo 'fb6b5b';
                             }
                             ?>" data-rotate="270" data-scale-Color="false"
                             data-size="50"
                             data-animate="2000">
                                                        <span class="small "><?= $total_progress ?>
                                                            %</span>
                            <span class="easypie-text"><strong><?= lang('done') ?></strong></span>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>
<?php } ?>

<div class="nav-tabs-custom">
    <!-- Tabs within a box -->
    <ul class="nav nav-tabs">
        <li class="<?= $active == 1 ? 'active' : ''; ?>"><a href="#manage"
                                                            data-toggle="tab"><?= lang('all_deposit') ?></a></li>
        <li class="<?= $active == 2 ? 'active' : ''; ?>"><a href="#create"
                                                            data-toggle="tab"><?= lang('new_deposit') ?></a></li>
        <li><a style="background-color: #1797be;color: #ffffff"
               href="<?= base_url() ?>admin/transactions/import/Income"><?= lang('import') . ' ' . lang('deposit') ?></a>
        </li>
    </ul>
    <div class="tab-content no-padding  bg-white">
        <!-- ************** general *************-->
        <div class="tab-pane <?= $active == 1 ? 'active' : ''; ?>" id="manage">

            <div class="table-responsive">
                <table class="table table-striped DataTables " id="DataTables" cellspacing="0" width="100%">
                    <thead>
                    <tr>
                        <th><?= lang('date') ?></th>
                        <th><?= lang('account') ?></th>
                        <th><?= lang('paid_by') ?></th>
                        <th><?= lang('description') ?></th>
                        <th><?= lang('amount') ?></th>
                        <th><?= lang('balance') ?></th>
                        <th><?= lang('attachment') ?></th>
                        <th><?= lang('action') ?></th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php
                    $curency = $this->transactions_model->check_by(array('code' => config_item('default_currency')), 'tbl_currencies');
                    $total_amount = 0;
                    $total_credit = 0;
                    $total_balance = 0;
                    if (!empty($all_deposit_info)):
                        foreach ($all_deposit_info as $v_deposit) :
                            if ($v_deposit->type == 'Income'):
                                $can_edit = $this->transactions_model->can_action('tbl_transactions', 'edit', array('transactions_id' => $v_deposit->transactions_id));
                                $can_delete = $this->transactions_model->can_action('tbl_transactions', 'delete', array('transactions_id' => $v_deposit->transactions_id));

                                $account_info = $this->transactions_model->check_by(array('account_id' => $v_deposit->account_id), 'tbl_accounts');
                                $client_info = $this->transactions_model->check_by(array('client_id' => $v_deposit->paid_by), 'tbl_client');
                                $category_info = $this->transactions_model->check_by(array('income_category_id' => $v_deposit->category_id), 'tbl_income_category');
                                if (!empty($client_info)) {
                                    if ($client_info->client_status == 1) {
                                        $status = lang('person');
                                    } else {
                                        $status = lang('company');
                                    }
                                    $client_name = $client_info->name;
                                } else {
                                    $client_name = '-';
                                    $status = '';
                                }
                                ?>
                                <tr>
                                    <td><?= strftime(config_item('date_format'), strtotime($v_deposit->date)); ?></td>
                                    <td class="vertical-td"><?php
                                        if (!empty($account_info->account_name)) {
                                            echo $account_info->account_name;
                                        } else {
                                            echo '-';
                                        }
                                        ?></td>

                                    <td><?= $client_name . ' ' . $status ?></td>
                                    <td><?= $v_deposit->notes ?></td>
                                    <td><?= display_money($v_deposit->amount, $curency->symbol) ?></td>
                                    <td><?= display_money($v_deposit->total_balance, $curency->symbol) ?></td>

                                    <td>
                                        <?php
                                        $attachement_info = json_decode($v_deposit->attachement);
                                        if (!empty($attachement_info)) { ?>
                                            <a href="<?= base_url() ?>admin/transactions/download/<?= $v_deposit->transactions_id ?>"><?= lang('download') ?></a>
                                        <?php } ?>
                                    </td>
                                    <td>
                                        <?php if (!empty($can_edit)) { ?>
                                            <?= btn_edit('admin/transactions/deposit/' . $v_deposit->transactions_id) ?>
                                        <?php }
                                        if (!empty($can_delete)) {
                                            ?>
                                            <?= btn_delete('admin/transactions/delete_deposit/' . $v_deposit->transactions_id) ?>
                                        <?php } ?>
                                    </td>
                                </tr>
                                <?php
                                $total_amount += $v_deposit->amount;
                                $total_credit += $v_deposit->credit;
                                $total_balance = $total_credit;
                                ?>
                                <?php
                            endif;
                        endforeach;
                    endif;
                    ?>

                    </tbody>
                </table>
            </div>
        </div>

        <div class="tab-pane <?= $active == 2 ? 'active' : ''; ?>" id="create">
            <form role="form"  data-parsley-validate="" novalidate="" enctype="multipart/form-data" id="form"
                  action="<?php echo base_url(); ?>admin/transactions/save_deposit/<?php
                  if (!empty($deposit_info)) {
                      echo $deposit_info->transactions_id;
                  }
                  ?>" method="post" class="form-horizontal ">

                <div class="form-group ">
                    <label class="col-lg-3 control-label mt-lg"><?= lang('account') ?> <span


                            class="text-danger">*</span> </label>
                    <div class="col-lg-5 mt-lg">
                        <select class="form-control select_box" style="width: 100%" name="account_id" required <?php
                        if (!empty($deposit_info)) {
                            echo 'disabled';
                        }
                        ?>>

                            <?php
                            $account_info = $this->db->get('tbl_accounts')->result();
                            if (!empty($account_info)) {
                                foreach ($account_info as $v_account) {
                                    ?>
                                    <option value="<?= $v_account->account_id ?>"
                                        <?php
                                        if (!empty($deposit_info->account_id)) {
                                            echo $deposit_info->account_id == $v_account->account_id ? 'selected' : '';
                                        }
                                        ?>
                                    ><?= $v_account->account_name ?></option>
                                    <?php
                                }
                            }
                            ?>
                        </select>
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-lg-3 control-label"><?= lang('date') ?></label>
                    <div class="col-lg-5">
                        <div class="input-group">
                            <input type="text" name="date" class="form-control datepicker" value="<?php
                            if (!empty($deposit_info->date)) {
                                echo $deposit_info->date;
                            } else {
                                echo date('Y-m-d');
                            }
                            ?>" data-date-format="<?= config_item('date_picker_format'); ?>">
                            <div class="input-group-addon">
                                <a href="#"><i class="fa fa-calendar"></i></a>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="form-group terms">
                    <label class="col-lg-3 control-label"><?= lang('notes') ?> </label>
                    <div class="col-lg-5">
                        <textarea name="notes" class="form-control"><?php
                            if (!empty($deposit_info)) {
                                echo $deposit_info->notes;
                            }
                            ?></textarea>
                    </div>
                </div>

                <div class="form-group">
                    <label class="col-lg-3 control-label"><?= lang('amount') ?> <span class="text-danger">*</span>
                    </label>
                    <div class="col-lg-5">
                        <div class="input-group  ">
                            <input class="form-control " data-parsley-type="number" type="text" value="<?php
                            if (!empty($deposit_info)) {
                                echo $deposit_info->amount;
                            }
                            ?>" name="amount" required="" <?php
                            if (!empty($deposit_info)) {
                                echo 'disabled';
                            }
                            ?>>
                        </div>
                    </div>
                </div>
                <div class="more_option">
                    <div class="form-group">
                        <label class="col-lg-3 control-label"><?= lang('deposit_category') ?> </label>
                        <div class="col-lg-5">
                            <select class="form-control select_box" style="width: 100%" name="category_id">
                                <option value="0"><?= lang('none') ?></option>
                                <?php
                                $category_info = $this->db->get('tbl_income_category')->result();
                                if (!empty($category_info)) {
                                    foreach ($category_info as $v_category) {
                                        ?>
                                        <option value="<?= $v_category->income_category_id ?>"
                                            <?php
                                            if (!empty($deposit_info->category_id)) {
                                                echo $deposit_info->category_id == $v_category->income_category_id ? 'selected' : '';
                                            }
                                            ?>
                                        ><?= $v_category->income_category ?></option>
                                        <?php
                                    }
                                }
                                ?>
                            </select>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-lg-3 control-label"><?= lang('paid_by') ?> </label>
                        <div class="col-lg-5">
                            <select class="form-control select_box" style="width: 100%" name="paid_by">
                                <option value="0"><?= lang('select_payer') ?></option>
                                <?php
                                $all_client = $this->db->get('tbl_client')->result();
                                if (!empty($all_client)) {
                                    foreach ($all_client as $v_client) {
                                        if ($v_client->client_status == 1) {
                                            $status = lang('person');
                                        } else {
                                            $status = lang('company');
                                        }
                                        ?>
                                        <option value="<?= $v_client->client_id ?>"
                                            <?php
                                            if (!empty($deposit_info)) {
                                                echo $deposit_info->paid_by == $v_client->client_id ? 'selected' : '';
                                            }
                                            ?>
                                        ><?= ucfirst($v_client->name) . ' <small>' . $status . '</small>' ?></option>
                                        <?php
                                    }
                                }
                                ?>
                            </select>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-lg-3 control-label"><?= lang('payment_method') ?> </label>
                        <div class="col-lg-5">
                            <select class="form-control select_box" style="width: 100%" name="payment_methods_id">
                                <option value="0"><?= lang('select_payment_method') ?></option>
                                <?php
                                $payment_methods = $this->db->get('tbl_payment_methods')->result();
                                if (!empty($payment_methods)) {
                                    foreach ($payment_methods as $p_method) {
                                        ?>
                                        <option value="<?= $p_method->payment_methods_id ?>" <?php
                                        if (!empty($deposit_info)) {
                                            echo $deposit_info->payment_methods_id == $p_method->payment_methods_id ? 'selected' : '';
                                        }
                                        ?>><?= $p_method->method_name ?></option>
                                        <?php
                                    }
                                }
                                ?>
                            </select>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-lg-3 control-label"><?= lang('reference') ?> </label>
                        <div class="col-lg-5">

                            <input class="form-control " type="text" value="<?php
                            if (!empty($deposit_info)) {
                                echo $deposit_info->reference;
                            }
                            ?>" name="reference">

                            <input class="form-control " type="hidden" value="<?php
                            if (!empty($deposit_info)) {
                                echo $deposit_info->account_id;
                            }
                            ?>" name="old_account_id">

                            <span class="help-block"><?= lang('reference_example') ?></span>
                        </div>
                    </div>
                </div>
                <div id="add_new">
                    <div class="form-group" style="margin-bottom: 0px">
                        <label for="field-1"
                               class="col-sm-3 control-label"><?= lang('attachment') ?></label>
                        <div class="col-sm-4">
                            <div class="fileinput fileinput-new" data-provides="fileinput">
                                <?php
                                if (!empty($deposit_info->attachement)) {
                                    $attachement = json_decode($deposit_info->attachement);
                                }
                                if (!empty($attachement)):foreach ($attachement as $v_files): ?>
                                    <div class="">
                                        <input type="hidden" name="path[]"
                                               value="<?php echo $v_files->path ?>">
                                        <input type="hidden" name="fileName[]"
                                               value="<?php echo $v_files->fileName ?>">
                                        <input type="hidden" name="fullPath[]"
                                               value="<?php echo $v_files->fullPath ?>">
                                        <input type="hidden" name="size[]"
                                               value="<?php echo $v_files->size ?>">
                                    <span class=" btn btn-default btn-file">
                                    <span class="fileinput-filename"> <?php echo $v_files->fileName ?></span>
                                    <a href="javascript:void(0);" class="remCFile" style="float: none;">×</a>
                                    </span>
                                        <strong>
                                            <a href="javascript:void(0);" class="RCF"><i
                                                    class="fa fa-times"></i>&nbsp;Remove</a></strong>
                                        <p></p>
                                    </div>

                                <?php endforeach; ?>
                                <?php else: ?>
                                    <span class="btn btn-default btn-file"><span
                                            class="fileinput-new"><?= lang('select_file') ?></span>
                                                            <span class="fileinput-exists"><?= lang('change') ?></span>
                                                            <input type="file" name="attachement[]">
                                                        </span>
                                    <span class="fileinput-filename"></span>
                                    <a href="#" class="close fileinput-exists" data-dismiss="fileinput"
                                       style="float: none;">&times;</a>
                                <?php endif; ?>
                            </div>
                            <div id="msg_pdf" style="color: #e11221"></div>
                        </div>
                        <div class="col-sm-2">
                            <strong><a href="javascript:void(0);" id="add_more" class="addCF "><i
                                        class="fa fa-plus"></i>&nbsp;<?= lang('add_more') ?>
                                </a></strong>
                        </div>
                    </div>
                </div>
                <?php
                if (!empty($deposit_info)) {
                    $transactions_id = $deposit_info->transactions_id;
                } else {
                    $transactions_id = null;
                }
                ?>
                <?= custom_form_Fields(1, $transactions_id); ?>

                <div class="form-group" id="border-none">
                    <label for="field-1" class="col-sm-3 control-label"><?= lang('permission') ?> <span
                            class="required">*</span></label>
                    <div class="col-sm-9">
                        <div class="checkbox c-radio needsclick">
                            <label class="needsclick">
                                <input id="" <?php
                                if (!empty($deposit_info->permission) && $deposit_info->permission == 'all') {
                                    echo 'checked';
                                } elseif (empty($deposit_info)) {
                                    echo 'checked';
                                }
                                ?> type="radio" name="permission" value="everyone">
                                <span class="fa fa-circle"></span><?= lang('everyone') ?>
                                <i title="<?= lang('permission_for_all') ?>"
                                   class="fa fa-question-circle" data-toggle="tooltip"
                                   data-placement="top"></i>
                            </label>
                        </div>
                        <div class="checkbox c-radio needsclick">
                            <label class="needsclick">
                                <input id="" <?php
                                if (!empty($deposit_info->permission) && $deposit_info->permission != 'all') {
                                    echo 'checked';
                                }
                                ?> type="radio" name="permission" value="custom_permission"
                                >
                                <span class="fa fa-circle"></span><?= lang('custom_permission') ?> <i
                                    title="<?= lang('permission_for_customization') ?>"
                                    class="fa fa-question-circle" data-toggle="tooltip"
                                    data-placement="top"></i>
                            </label>
                        </div>
                    </div>
                </div>

                <div class="form-group <?php
                if (!empty($deposit_info->permission) && $deposit_info->permission != 'all') {
                    echo 'show';
                }
                ?>" id="permission_user_1">
                    <label for="field-1"
                           class="col-sm-3 control-label"><?= lang('select') . ' ' . lang('users') ?>
                        <span
                            class="required">*</span></label>
                    <div class="col-sm-9">
                        <?php
                        if (!empty($permission_user)) {
                            foreach ($permission_user as $key => $v_user) {

                                if ($v_user->role_id == 1) {
                                    $role = '<strong class="badge btn-danger">' . lang('admin') . '</strong>';
                                } else {
                                    $role = '<strong class="badge btn-primary">' . lang('staff') . '</strong>';
                                }

                                ?>
                                <div class="checkbox c-checkbox needsclick">
                                    <label class="needsclick">
                                        <input type="checkbox"
                                            <?php
                                            if (!empty($deposit_info->permission) && $deposit_info->permission != 'all') {
                                                $get_permission = json_decode($deposit_info->permission);
                                                foreach ($get_permission as $user_id => $v_permission) {
                                                    if ($user_id == $v_user->user_id) {
                                                        echo 'checked';
                                                    }
                                                }

                                            }
                                            ?>
                                               value="<?= $v_user->user_id ?>"
                                               name="assigned_to[]"
                                               class="needsclick">
                                                        <span
                                                            class="fa fa-check"></span><?= $v_user->username . ' ' . $role ?>
                                    </label>

                                </div>
                                <div class="action_1 p
                                                <?php

                                if (!empty($deposit_info->permission) && $deposit_info->permission != 'all') {
                                    $get_permission = json_decode($deposit_info->permission);

                                    foreach ($get_permission as $user_id => $v_permission) {
                                        if ($user_id == $v_user->user_id) {
                                            echo 'show';
                                        }
                                    }

                                }
                                ?>
                                                " id="action_1<?= $v_user->user_id ?>">
                                    <label class="checkbox-inline c-checkbox">
                                        <input id="<?= $v_user->user_id ?>" checked type="checkbox"
                                               name="action_1<?= $v_user->user_id ?>[]"
                                               disabled
                                               value="view">
                                                        <span
                                                            class="fa fa-check"></span><?= lang('can') . ' ' . lang('view') ?>
                                    </label>
                                    <label class="checkbox-inline c-checkbox">
                                        <input id="<?= $v_user->user_id ?>"
                                            <?php

                                            if (!empty($deposit_info->permission) && $deposit_info->permission != 'all') {
                                                $get_permission = json_decode($deposit_info->permission);

                                                foreach ($get_permission as $user_id => $v_permission) {
                                                    if ($user_id == $v_user->user_id) {
                                                        if (in_array('edit', $v_permission)) {
                                                            echo 'checked';
                                                        };

                                                    }
                                                }

                                            }
                                            ?>
                                               type="checkbox"
                                               value="edit" name="action_<?= $v_user->user_id ?>[]">
                                                        <span
                                                            class="fa fa-check"></span><?= lang('can') . ' ' . lang('edit') ?>
                                    </label>
                                    <label class="checkbox-inline c-checkbox">
                                        <input id="<?= $v_user->user_id ?>"
                                            <?php

                                            if (!empty($deposit_info->permission) && $deposit_info->permission != 'all') {
                                                $get_permission = json_decode($deposit_info->permission);
                                                foreach ($get_permission as $user_id => $v_permission) {
                                                    if ($user_id == $v_user->user_id) {
                                                        if (in_array('delete', $v_permission)) {
                                                            echo 'checked';
                                                        };
                                                    }
                                                }

                                            }
                                            ?>
                                               name="action_<?= $v_user->user_id ?>[]"
                                               type="checkbox"
                                               value="delete">
                                                        <span
                                                            class="fa fa-check"></span><?= lang('can') . ' ' . lang('delete') ?>
                                    </label>
                                    <input id="<?= $v_user->user_id ?>" type="hidden"
                                           name="action_<?= $v_user->user_id ?>[]" value="view">

                                </div>


                                <?php
                            }
                        }
                        ?>


                    </div>
                </div>
                <div class="form-group">
                    <label class="col-lg-3 control-label"></label>
                    <div class="col-lg-5">
                        <button type="submit" class="btn btn-sm btn-primary"><i
                                class="fa fa-check"></i> <?= lang('submit') ?></button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>

<script type="text/javascript">
    $(document).ready(function () {
        var maxAppend = 0;
        $("#add_more").click(function () {
            if (maxAppend >= 4) {
                alert("Maximum 5 File is allowed");
            } else {
                var add_new = $('<div class="form-group" style="margin-bottom: 0px">\n\
                    <label for="field-1" class="col-sm-3 control-label"><?= lang('attachment') ?></label>\n\
        <div class="col-sm-4">\n\
        <div class="fileinput fileinput-new" data-provides="fileinput">\n\
<span class="btn btn-default btn-file"><span class="fileinput-new" >Select file</span><span class="fileinput-exists" >Change</span><input type="file" name="attachement[]" ></span> <span class="fileinput-filename"></span><a href="#" class="close fileinput-exists" data-dismiss="fileinput" style="float: none;">&times;</a></div></div>\n\<div class="col-sm-2">\n\<strong>\n\
<a href="javascript:void(0);" class="remCF"><i class="fa fa-times"></i>&nbsp;Remove</a></strong></div>');
                maxAppend++;
                $("#add_new").append(add_new);
            }
        });

        $("#add_new").on('click', '.remCF', function () {
            $(this).parent().parent().parent().remove();
        });
        $('a.RCF').click(function () {
            $(this).parent().parent().remove();
        });
    });
</script>
