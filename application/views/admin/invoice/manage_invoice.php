<link href="<?php echo base_url() ?>asset/css/bootstrap-toggle.min.css" rel="stylesheet">
<script src="<?php echo base_url() ?>asset/js/bootstrap-toggle.min.js"></script>
<?php include_once 'assets/admin-ajax.php'; ?>
<?php echo message_box('success'); ?>
<?php echo message_box('error'); ?>
<?php
$mdate = date('Y-m-d');
$last_7_days = date('Y-m-d', strtotime('today - 7 days'));
$all_goal_tracking = $this->invoice_model->get_permission('tbl_goal_tracking');

$all_goal = 0;
$bank_goal = 0;
$complete_achivement = 0;
if (!empty($all_goal_tracking)) {
    foreach ($all_goal_tracking as $v_goal_track) {
        $goal_achieve = $this->invoice_model->get_progress($v_goal_track, true);
        if ($v_goal_track->goal_type_id == 5) {
            if ($v_goal_track->end_date <= $mdate) { // check today is last date or not

                if ($v_goal_track->email_send == 'no') {// check mail are send or not
                    if ($v_goal_track->achievement <= $goal_achieve['achievement']) {
                        if ($v_goal_track->notify_goal_achive == 'on') {// check is notify is checked or not check
                            $this->invoice_model->send_goal_mail('goal_achieve', $v_goal_track);
                        }
                    } else {
                        if ($v_goal_track->notify_goal_not_achive == 'on') {// check is notify is checked or not check
                            $this->invoice_model->send_goal_mail('goal_not_achieve', $v_goal_track);
                        }
                    }
                }
            }
            $all_goal += $v_goal_track->achievement;
            $complete_achivement += $goal_achieve['achievement'];
        }
    }
}
// 30 days before

for ($iDay = 7; $iDay >= 0; $iDay--) {
    $date = date('Y-m-d', strtotime('today - ' . $iDay . 'days'));
    $where = array('date_saved >=' => $date . " 00:00:00", 'date_saved <=' => $date . " 23:59:59");
    $invoice_result[$date] = count($this->db->where($where)->get('tbl_invoices')->result());
}

$terget_achievement = $this->db->where(array('goal_type_id' => 5, 'start_date >=' => $last_7_days, 'end_date <=' => $mdate))->get('tbl_goal_tracking')->result();

$total_terget = 0;
if (!empty($terget_achievement)) {
    foreach ($terget_achievement as $v_terget) {
        $total_terget += $v_terget->achievement;
    }
}
$tolal_goal = $all_goal + $bank_goal;
$currency = $this->invoice_model->check_by(array('code' => config_item('default_currency')), 'tbl_currencies');

if ($this->session->userdata('user_type') == 1) {
    $margin = 'margin-bottom:30px';
    ?>
    <div class="col-sm-12 bg-white p0" style="<?= $margin ?>">
        <div class="col-md-4">
            <div class="row row-table pv-lg">
                <div class="col-xs-6">
                    <p class="m0 lead"><?= ($tolal_goal) ?></p>
                    <p class="m0">
                        <small><?= lang('achievement') ?></small>
                    </p>
                </div>
                <div class="col-xs-6 ">
                    <p class="m0 lead"><?= ($total_terget) ?></p>
                    <p class="m0">
                        <small><?= lang('last_weeks') . ' ' . lang('created') ?></small>
                    </p>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="row row-table ">
                <div class="col-xs-6">
                    <p class="m0 lead"><?= ($complete_achivement) ?></p>
                    <p class="m0">
                        <small><?= lang('completed') . ' ' . lang('achievements') ?></small>
                    </p>
                </div>
                <div class="col-xs-6 pt">
                    <div data-sparkline="" data-bar-color="#23b7e5" data-height="60" data-bar-width="8"
                         data-bar-spacing="6" data-chart-range-min="0" values="<?php
                    if (!empty($invoice_result)) {
                        foreach ($invoice_result as $v_invoice_result) {
                            echo $v_invoice_result . ',';
                        }
                    }
                    ?>">
                    </div>
                    <p class="m0">
                        <small>
                            <?php
                            if (!empty($invoice_result)) {
                                foreach ($invoice_result as $date => $v_invoice_result) {
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
                        <?= $pending_goal ?></p>
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
                                                            data-toggle="tab"><?= lang('all_invoices') ?></a></li>
        <li class="<?= $active == 2 ? 'active' : ''; ?>"><a href="#create"
                                                            data-toggle="tab"><?= lang('create_invoice') ?></a></li>
    </ul>
    <div class="tab-content bg-white">
        <!-- ************** general *************-->
        <div class="tab-pane <?= $active == 1 ? 'active' : ''; ?>" id="manage">

            <div class="table-responsive">
                <table class="table table-striped DataTables " id="DataTables" cellspacing="0" width="100%">
                    <thead>
                    <tr>
                        <th><?= lang('invoice') ?></th>
                        <th class="col-date"><?= lang('due_date') ?></th>
                        <th><?= lang('client_name') ?></th>
                        <th class="col-currency"><?= lang('amount') ?></th>
                        <th class="col-currency"><?= lang('due_amount') ?></th>
                        <th><?= lang('status') ?></th>
                        <th class="hidden-print"><?= lang('action') ?></th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php
                    if (!empty($all_invoices_info)) {
                        $all_invoices_info = array_reverse($all_invoices_info);

                        foreach ($all_invoices_info as $v_invoices) {
                            $can_edit = $this->invoice_model->can_action('tbl_invoices', 'edit', array('invoices_id' => $v_invoices->invoices_id));
                            $can_delete = $this->invoice_model->can_action('tbl_invoices', 'delete', array('invoices_id' => $v_invoices->invoices_id));

                            if ($this->invoice_model->get_payment_status($v_invoices->invoices_id) == lang('fully_paid')) {
                                $invoice_status = lang('fully_paid');
                                $label = "success";
                            } elseif ($this->invoice_model->get_payment_status($v_invoices->invoices_id) == lang('draft')) {
                                $invoice_status = lang('draft');
                                $label = "default";
                            } elseif ($this->invoice_model->get_payment_status($v_invoices->invoices_id) == lang('partially_paid')) {
                                $invoice_status = lang('partially_paid');
                                $label = "warning";
                            } elseif ($v_invoices->emailed == 'Yes') {
                                $invoice_status = lang('sent');
                                $label = "info";
                            } else {
                                $invoice_status = $this->invoice_model->get_payment_status($v_invoices->invoices_id);
                                $label = "danger";
                            }
                            ?>
                            <tr>
                                <td><a class="text-info"
                                       href="<?= base_url() ?>admin/invoice/manage_invoice/invoice_details/<?= $v_invoices->invoices_id ?>"><?= $v_invoices->reference_no ?></a>
                                </td>
                                <td><?= strftime(config_item('date_format'), strtotime($v_invoices->due_date)) ?>
                                    <?php
                                    $payment_status = $this->invoice_model->get_payment_status($v_invoices->invoices_id);
                                    if (strtotime($v_invoices->due_date) < time() AND $payment_status != lang('fully_paid')) { ?>
                                        <span
                                            class="label label-danger "><?= lang('overdue') ?></span>
                                        <?php
                                    }
                                    ?>
                                </td>
                                <?php
                                $client_info = $this->invoice_model->check_by(array('client_id' => $v_invoices->client_id), 'tbl_client');

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
                                <td><?= $client_name . '' . ' ' . $status . ''; ?></td>
                                <?php $currency = $this->invoice_model->client_currency_sambol($v_invoices->client_id);
                                if (empty($currency)) {
                                    $currency = $this->invoice_model->check_by(array('code' => config_item('default_currency')), 'tbl_currencies');
                                }
                                ?>
                                <td><?= display_money($this->invoice_model->calculate_to('invoice_cost', $v_invoices->invoices_id), $currency->symbol) ?></td>
                                <td><?= display_money($this->invoice_model->calculate_to('invoice_due', $v_invoices->invoices_id), $currency->symbol) ?></td>
                                <td><span class="label label-<?= $label ?>"><?= $invoice_status ?></span>
                                    <?php if ($v_invoices->recurring == 'Yes') { ?>
                                        <span data-toggle="tooltip" data-placement="top"
                                              title="<?= lang('recurring') ?>" class="label label-primary"><i
                                                class="fa fa-retweet"></i></span>
                                    <?php } ?>

                                </td>
                                <td class="hidden-print">
                                    <?php if (!empty($can_edit)) { ?>
                                        <?= btn_edit('admin/invoice/manage_invoice/create_invoice/' . $v_invoices->invoices_id) ?>
                                    <?php }
                                    if (!empty($can_delete)) {
                                        ?>
                                        <?= btn_delete('admin/invoice/delete/delete_invoice/' . $v_invoices->invoices_id) ?>
                                    <?php } ?>
                                    <?php if (!empty($can_edit)) { ?>
                                        <div class="btn-group">
                                            <button class="btn btn-xs btn-default dropdown-toggle"
                                                    data-toggle="dropdown">
                                                <?= lang('change_status') ?>
                                                <span class="caret"></span>
                                            </button>
                                            <ul class="dropdown-menu animated zoomIn">
                                                <li>
                                                    <a href="<?= base_url() ?>admin/invoice/manage_invoice/invoice_details/<?= $v_invoices->invoices_id ?>"><?= lang('preview_invoice') ?></a>
                                                </li>
                                                <li>
                                                    <a href="<?= base_url() ?>admin/invoice/manage_invoice/payment/<?= $v_invoices->invoices_id ?>"><?= lang('pay_invoice') ?></a>
                                                </li>
                                                <li>
                                                    <a href="<?= base_url() ?>admin/invoice/manage_invoice/email_invoice/<?= $v_invoices->invoices_id ?>"><?= lang('email_invoice') ?></a>
                                                </li>
                                                <li>
                                                    <a href="<?= base_url() ?>admin/invoice/manage_invoice/send_reminder/<?= $v_invoices->invoices_id ?>"><?= lang('send_reminder') ?></a>
                                                </li>
                                                <li>
                                                    <a href="<?= base_url() ?>admin/invoice/manage_invoice/send_overdue/<?= $v_invoices->invoices_id ?>"><?= lang('send_invoice_overdue') ?></a>
                                                </li>
                                                <li>
                                                    <a href="<?= base_url() ?>admin/invoice/manage_invoice/invoice_history/<?= $v_invoices->invoices_id ?>"><?= lang('invoice_history') ?></a>
                                                </li>
                                                <li>
                                                    <a href="<?= base_url() ?>admin/invoice/manage_invoice/pdf_invoice/<?= $v_invoices->invoices_id ?>"><?= lang('pdf') ?></a>
                                                </li>
                                            </ul>
                                        </div>
                                    <?php } ?>
                                </td>

                            </tr>
                            <?php
                        }
                    }
                    ?>
                    </tbody>
                </table>
            </div>
        </div>
        <div class="tab-pane <?= $active == 2 ? 'active' : ''; ?>" id="create">
            <?php
            if (!empty($invoice_info)) {
                $client_info = $this->invoice_model->check_by(array('client_id' => $invoice_info->client_id), 'tbl_client');
                if (!empty($client_info)) {
                    $client_lang = $client_info->language;
                    $currency = $this->invoice_model->client_currency_sambol($invoice_info->client_id);
                } else {
                    $client_lang = 'english';
                    $currency = $this->invoice_model->check_by(array('code' => config_item('default_currency')), 'tbl_currencies');
                }
            } else {
                $client_lang = 'english';
                $currency = $this->invoice_model->check_by(array('code' => config_item('default_currency')), 'tbl_currencies');
            }
            unset($this->lang->is_loaded[5]);
            $language_info = $this->lang->load('sales_lang', $client_lang, TRUE, FALSE, '', TRUE);
            ?>
            <form name="myform" role="form" data-parsley-validate="" novalidate="" enctype="multipart/form-data"
                  id="form"
                  action="<?php echo base_url(); ?>admin/invoice/save_invoice/<?php
                  if (!empty($invoice_info)) {
                      echo $invoice_info->invoices_id;
                  }
                  ?>" method="post" class="form-horizontal  ">
                <div class="row mb-lg">
                    <div class="col-xs-6 br pv">
                        <div class="row">

                            <div class="form-group">
                                <label class="col-lg-3 control-label"><?= lang('reference_no') ?> <span
                                        class="text-danger">*</span></label>
                                <div class="col-lg-7">
                                    <input type="text" class="form-control" value="<?php
                                    if (!empty($invoice_info)) {
                                        echo $invoice_info->reference_no;
                                    } else {
                                        echo config_item('invoice_prefix');
                                        if (config_item('increment_invoice_number') == 'FALSE') {
                                            $this->load->helper('string');
                                            echo random_string('nozero', 6);
                                        } else {
                                            echo $this->invoice_model->generate_invoice_number();
                                        }
                                    }
                                    ?>" name="reference_no">
                                </div>
                                <div class="btn btn-xs btn-info" id="start_recurring"><?= lang('recurring') ?></div>

                            </div>
                            <div id="recurring" class="hide">
                                <div class="form-group">
                                    <label class="col-lg-3 control-label"><?= lang('recur_frequency') ?> </label>
                                    <div class="col-lg-4">
                                        <select name="recuring_frequency" id="recuring_frequency"
                                                class="form-control">
                                            <option value="none"><?= lang('none') ?></option>
                                            <option
                                                value="7D"><?= lang('week') ?></option>
                                            <option
                                                value="1M"><?= lang('month') ?></option>
                                            <option
                                                value="3M"><?= lang('quarter') ?></option>
                                            <option
                                                value="6M"><?= lang('six_months') ?></option>
                                            <option
                                                value="1Y"><?= lang('1year') ?></option>
                                            <option
                                                value="2Y"><?= lang('2year') ?></option>
                                            <option
                                                value="3Y"><?= lang('3year') ?></option>
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-lg-3 control-label"><?= lang('start_date') ?></label>
                                    <div class="col-lg-7">
                                        <?php
                                        if (!empty($invoice_info) && $invoice_info->recurring == 'Yes') {
                                            $recur_start_date = date('Y-m-d', strtotime($invoice_info->recur_start_date));
                                            $recur_end_date = date('Y-m-d', strtotime($invoice_info->recur_end_date));
                                        } else {
                                            $recur_start_date = date('Y-m-d');
                                            $recur_end_date = date('Y-m-d');
                                        }
                                        ?>
                                        <div class="input-group">
                                            <input class="form-control datepicker" type="text"
                                                   value="<?= $recur_start_date; ?>"
                                                   name="recur_start_date"
                                                   data-date-format="<?= config_item('date_picker_format'); ?>">
                                            <div class="input-group-addon">
                                                <a href="#"><i class="fa fa-calendar"></i></a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-lg-3 control-label"><?= lang('end_date') ?></label>
                                    <div class="col-lg-7">
                                        <div class="input-group">
                                            <input class="form-control datepicker" type="text"
                                                   value="<?= $recur_end_date; ?>"
                                                   name="recur_end_date"
                                                   data-date-format="<?= config_item('date_picker_format'); ?>">
                                            <div class="input-group-addon">
                                                <a href="#"><i class="fa fa-calendar"></i></a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-lg-3 control-label"><?= lang('client') ?> <span
                                        class="text-danger">*</span>
                                </label>
                                <div class="col-lg-7">
                                    <select class="form-control select_box" required style="width: 100%"
                                            name="client_id"
                                            onchange="get_project_by_id(this.value)">
                                        <option value="-"><?= lang('select') . ' ' . lang('client') ?></option>
                                        <?php
                                        if (!empty($all_client)) {
                                            foreach ($all_client as $v_client) {
                                                if ($v_client->client_status == 1) {
                                                    $status = lang('person');
                                                } else {
                                                    $status = lang('company');
                                                }
                                                if (!empty($project_info->client_id)) {
                                                    $client_id = $project_info->client_id;
                                                } elseif ($invoice_info->client_id) {
                                                    $client_id = $invoice_info->client_id;
                                                }
                                                ?>
                                                <option value="<?= $v_client->client_id ?>"
                                                    <?php
                                                    if (!empty($client_id)) {
                                                        echo $client_id == $v_client->client_id ? 'selected' : null;
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
                                <label class="col-lg-3 control-label"><?= lang('project') ?></label>
                                <div class="col-lg-7">
                                    <select class="form-control " style="width: 100%" name="project_id"
                                            id="client_project">
                                        <option value=""><?= lang('none') ?></option>
                                        <?php

                                        if (!empty($client_id)) {

                                            if (!empty($project_info->project_id)) {
                                                $project_id = $project_info->project_id;
                                            } elseif ($invoice_info->project_id) {
                                                $project_id = $invoice_info->project_id;
                                            }
                                            $all_project = $this->db->where('client_id', $client_id)->get('tbl_project')->result();
                                            if (!empty($all_project)) {
                                                foreach ($all_project as $v_project) {
                                                    ?>
                                                    <option value="<?= $v_project->project_id ?>" <?php
                                                    if (!empty($project_id)) {
                                                        echo $v_project->project_id == $project_id ? 'selected' : '';
                                                    }
                                                    ?>><?= $v_project->project_name ?></option>
                                                    <?php
                                                }
                                            }
                                        }
                                        ?>
                                    </select>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-lg-3 control-label"><?= lang('due_date') ?></label>
                                <div class="col-lg-7">
                                    <div class="input-group">
                                        <input type="text" name="due_date" class="form-control datepicker" value="<?php
                                        if (!empty($invoice_info->due_date)) {
                                            echo $invoice_info->due_date;
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


                            <div class="form-group" id="border-none">
                                <label for="field-1" class="col-sm-3 control-label"><?= lang('permission') ?> <span
                                        class="required">*</span></label>
                                <div class="col-sm-9">
                                    <div class="checkbox c-radio needsclick">
                                        <label class="needsclick">
                                            <input id="" <?php
                                            if (!empty($invoice_info->permission) && $invoice_info->permission == 'all') {
                                                echo 'checked';
                                            } elseif (empty($invoice_info)) {
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
                                            if (!empty($invoice_info->permission) && $invoice_info->permission != 'all') {
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
                            if (!empty($invoice_info->permission) && $invoice_info->permission != 'all') {
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
                                                        if (!empty($invoice_info->permission) && $invoice_info->permission != 'all') {
                                                            $get_permission = json_decode($invoice_info->permission);
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

                                            if (!empty($invoice_info->permission) && $invoice_info->permission != 'all') {
                                                $get_permission = json_decode($invoice_info->permission);

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

                                                        if (!empty($invoice_info->permission) && $invoice_info->permission != 'all') {
                                                            $get_permission = json_decode($invoice_info->permission);

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

                                                        if (!empty($invoice_info->permission) && $invoice_info->permission != 'all') {
                                                            $get_permission = json_decode($invoice_info->permission);
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
                            <?php
                            if (!empty($invoice_info)) {
                                $invoices_id = $invoice_info->invoices_id;
                            } else {
                                $invoices_id = null;
                            }
                            ?>
                            <?= custom_form_Fields(9, $invoices_id); ?>

                        </div>
                    </div>
                    <div class="col-xs-6 br pv">
                        <div class="row">
                            <?php if (config_item('paypal_status') == 'active'): ?>
                                <div class="form-group">
                                    <label for="field-1"
                                           class="col-sm-4 control-label"><?= lang('allow_paypal') ?></label>
                                    <div class="col-sm-7">
                                        <div class="checkbox c-checkbox">
                                            <label class="needsclick">
                                                <input type="checkbox" value="Yes"
                                                    <?php if (!empty($invoice_info) && $invoice_info->allow_paypal == 'Yes') {
                                                        echo 'checked';
                                                    } ?> name="allow_paypal">
                                                <span class="fa fa-check"></span>
                                            </label>
                                        </div>
                                    </div>
                                </div>
                            <?php endif ?>
                            <?php if (config_item('stripe_status') == 'active'): ?>
                                <div class="form-group">
                                    <label for="field-1"
                                           class="col-sm-4 control-label"><?= lang('allow_stripe') ?></label>
                                    <div class="col-sm-7">
                                        <div class="checkbox c-checkbox">
                                            <label class="needsclick">
                                                <input type="checkbox" value="Yes"
                                                    <?php if (!empty($invoice_info) && $invoice_info->allow_stripe == 'Yes') {
                                                        echo 'checked';
                                                    } ?>
                                                       name="allow_stripe"><span class="fa fa-check"></span>
                                            </label>
                                        </div>
                                    </div>
                                </div>
                            <?php endif; ?>
                            <?php if (config_item('2checkout_status') == 'active'): ?>
                                <div class="form-group">
                                    <label for="field-1"
                                           class="col-sm-4 control-label"><?= lang('allow_2checkout') ?></label>

                                    <div class="col-sm-7">

                                        <div class="checkbox c-checkbox">
                                            <label class="needsclick">
                                                <input type="checkbox" value="Yes"
                                                    <?php if (!empty($invoice_info) && $invoice_info->allow_2checkout == 'Yes') {
                                                        echo 'checked';
                                                    } ?>
                                                       name="allow_2checkout"><span class="fa fa-check"></span>
                                            </label>
                                        </div>
                                    </div>
                                </div>
                            <?php endif; ?>
                            <?php if (config_item('authorize_status') == 'active'): ?>
                                <div class="form-group">
                                    <label for="field-1"
                                           class="col-sm-4 control-label"><?= lang('allow_authorize.net') ?></label>

                                    <div class="col-sm-7">
                                        <div class="checkbox c-checkbox">
                                            <label class="needsclick">
                                                <input type="checkbox" value="Yes"
                                                    <?php if (!empty($invoice_info) && $invoice_info->allow_authorize == 'Yes') {
                                                        echo 'checked';
                                                    } ?>
                                                       name="allow_authorize"><span class="fa fa-check"></span>
                                            </label>
                                        </div>

                                    </div>
                                </div>
                            <?php endif; ?>
                            <?php if (config_item('ccavenue_status') == 'active'): ?>
                                <div class="form-group">
                                    <label for="field-1"
                                           class="col-sm-4 control-label"><?= lang('allow_ccavenue') ?></label>

                                    <div class="col-sm-7">
                                        <div class="checkbox c-checkbox">
                                            <label class="needsclick">
                                                <input type="checkbox" value="Yes"
                                                    <?php if (!empty($invoice_info) && $invoice_info->allow_ccavenue == 'Yes') {
                                                        echo 'checked';
                                                    } ?>
                                                       name="allow_ccavenue"><span class="fa fa-check"></span>
                                            </label>
                                        </div>

                                    </div>
                                </div>
                            <?php endif; ?>
                            <?php if (config_item('braintree_status') == 'active'): ?>
                                <div class="form-group">
                                    <label for="field-1"
                                           class="col-sm-4 control-label"><?= lang('allow_braintree') ?></label>

                                    <div class="col-sm-7">
                                        <div class="checkbox c-checkbox">
                                            <label class="needsclick">
                                                <input type="checkbox" value="Yes"
                                                    <?php if (!empty($invoice_info) && $invoice_info->allow_braintree == 'Yes') {
                                                        echo 'checked';
                                                    } ?>
                                                       name="allow_braintree"><span class="fa fa-check"></span>
                                            </label>
                                        </div>
                                    </div>
                                </div>
                            <?php endif; ?>
                            <?php if (!empty($project_id)): ?>
                                <div class="form-group">
                                    <label for="field-1"
                                           class="col-sm-4 control-label"><?= lang('visible_to_client') ?>
                                        <span class="required">*</span></label>
                                    <div class="col-sm-8">
                                        <input data-toggle="toggle" name="client_visible" value="Yes" <?php
                                        if (!empty($invoice_info->client_visible) && $invoice_info->client_visible == 'Yes') {
                                            echo 'checked';
                                        }
                                        ?> data-on="<?= lang('yes') ?>" data-off="<?= lang('no') ?>"
                                               data-onstyle="success" data-offstyle="danger" type="checkbox">
                                    </div>
                                </div>
                            <?php endif ?>
                        </div>
                    </div>
                    <div class="col-sm-12 ">

                        <div class="">
                            <label class="col-lg-1 control-label"><?= lang('notes') ?> </label>
                            <div class="col-lg-11 row">
                        <textarea name="notes" class="textarea_"><?php
                            if (!empty($invoice_info)) {
                                echo $invoice_info->notes;
                            } else {
                                echo $this->config->item('default_terms');
                            }
                            ?></textarea>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="table-responsive table-bordered   mb-lg">
                    <table class="table " id="add_new">
                        <thead style="background: #e8e8e8">
                        <tr>
                            <th><?= $language_info['item_name'] ?></th>
                            <th><?= $language_info['description'] ?></th>
                            <th class="col-sm-1"><?= $language_info['qty'] ?></th>
                            <th class="col-sm-1"><?= $language_info['unit_price'] ?></th>
                            <th class="col-sm-1"><?= $language_info['tax_rate'] ?> </th>
                            <th class="col-sm-1"><?= $language_info['tax'] ?></th>
                            <th class="col-sm-1"><?= $language_info['total'] ?></th>
                            <th class="col-sm-1 hidden-print"><?= $language_info['action'] ?></th>
                        </tr>
                        </thead>
                        <tbody>
                        <?php
                        if (!empty($invoice_info)) {
                            $invoice_items = $this->invoice_model->ordered_items_by_id($invoice_info->invoices_id);
                        }
                        if (!empty($invoice_items)) :
                            foreach ($invoice_items as $v_item) :
                                $item_name = $v_item->item_name ? $v_item->item_name : $v_item->item_desc;
                                ?>
                                <tr>
                                    <td><?= $item_name ?></td>
                                    <td><?= nl2br($v_item->item_desc) ?></td>
                                    <td><?= $v_item->quantity ?></td>
                                    <td><?= display_money($v_item->unit_cost) ?></td>
                                    <td><?= $v_item->item_tax_rate ?>%</td>
                                    <td><?= display_money($v_item->item_tax_total) ?></td>
                                    <td><span class="linetotal"><?= display_money($v_item->total_cost) ?></span></td>
                                    <td class="hidden-print">
                                        <?php $can_edit = $this->invoice_model->can_action('tbl_invoices', 'edit', array('invoices_id' => $invoice_info->invoices_id));
                                        if (!empty($can_edit)) { ?>
                                            <?= btn_edit('admin/invoice/manage_invoice/invoice_details/' . $v_item->invoices_id . '/' . $v_item->items_id) ?>
                                            <?= btn_delete('admin/invoice/delete/delete_item/' . $v_item->invoices_id . '/' . $v_item->items_id) ?>
                                        <?php }
                                        ?></td>
                                </tr>
                                <tr class="hidden">
                                    <td>
                                        <textarea name="item_name[]" placeholder="Item Name"
                                                  class="form-control"></textarea>
                                    </td>
                                    <td><textarea rows="1" name="item_desc[]" placeholder="Item Description"
                                                  class="form-control"></textarea></td>
                                    <td><input type="text" name="quantity[]" value="<?php
                                        echo $v_item->quantity;
                                        ?>" class="p_qty form-control"></td>
                                    <td><input type="text" name="unit_cost[]"
                                               value="<?php
                                               echo $v_item->unit_cost;
                                               ?>" class="form-control"></td>
                                    <td>
                                        <select name="item_tax_rate[]" class="form-control  ">
                                            <option value="0.00"><?= lang('none') ?></option>
                                            <?php
                                            $tax_rates = $this->db->get('tbl_tax_rates')->result();
                                            if (!empty($tax_rates)) {
                                                foreach ($tax_rates as $v_tax) {
                                                    ?>
                                                    <option value="<?= $v_tax->tax_rate_percent ?>" <?php
                                                    if (!empty($v_item) && $v_item->item_tax_rate == $v_tax->tax_rate_percent) {
                                                        echo 'selected';
                                                    }
                                                    ?>><?= $v_tax->tax_rate_name . ' (' . $v_tax->tax_rate_percent . '%)' ?></option>
                                                    <?php
                                                }
                                            }
                                            ?>
                                        </select>
                                    </td>
                                    <td><input type="text" value="<?php
                                        if (!empty($v_item)) {
                                            echo $v_item->item_tax_total;
                                        }
                                        ?>" name="product_tax" placeholder="0.00" readonly="" class="form-control"></td>


                                    <td class="hidden-print">
                                        <a href="javascript:void(0);" class="remCF btn btn-danger btn-xs"><i
                                                class="fa fa-trash-o"></i></a>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        <?php endif ?>

                        <tr class="hidden-print">
                            <input type="hidden" name="invoices_id"
                                   value="<?= (!empty($invoice_info->invoices_id)) ? $invoice_info->invoices_id : null ?>">

                            <td><textarea rows="1" name="item_name[]" placeholder="Item name" class="form-control"><?php
                                    if (!empty($item_info)) {
                                        echo $item_info->item_name;
                                    }
                                    ?></textarea>
                            </td>
                            <td><textarea rows="1" name="item_desc[]" placeholder="Item Description"
                                          class="form-control"><?php
                                    if (!empty($item_info)) {
                                        echo $item_info->item_desc;
                                    }
                                    ?></textarea></td>
                            <td><input type="number" data-parsley-type="number" name="quantity[]" value="<?php
                                if (!empty($item_info)) {
                                    echo $item_info->quantity;
                                }
                                ?>" placeholder="1" class="form-control"></td>

                            <td><input type="number" data-parsley-type="number" name="unit_cost[]"
                                       value="<?php
                                       if (!empty($item_info)) {
                                           echo $item_info->unit_cost;
                                       }
                                       ?>" placeholder="100" class="form-control"></td>
                            <td>
                                <select name="item_tax_rate[]" class="form-control  ">
                                    <option value="0.00"><?= lang('none') ?></option>
                                    <?php
                                    $tax_rates = $this->db->get('tbl_tax_rates')->result();
                                    if (!empty($tax_rates)) {
                                        foreach ($tax_rates as $v_tax) {
                                            ?>
                                            <option value="<?= $v_tax->tax_rate_percent ?>" <?php
                                            if (!empty($item_info) && $item_info->item_tax_rate == $v_tax->tax_rate_percent) {
                                                echo 'selected';
                                            }
                                            ?>><?= $v_tax->tax_rate_name . ' (' . $v_tax->tax_rate_percent . '%)' ?></option>
                                            <?php
                                        }
                                    }
                                    ?>
                                </select>
                            </td>
                            <td><input type="text" value="<?php
                                if (!empty($item_info)) {
                                    echo $item_info->item_tax_total;
                                }
                                ?>" name="product_tax" placeholder="0.00" readonly="" class="form-control"></td>

                            <td><span class="linetotal"></span></td>

                            <td>
                                <strong><a href="javascript:void(0);" id="add_more" class="addCF "><i
                                            class="fa fa-plus"></i>&nbsp;&nbsp;More</a></strong>
                            </td>
                        </tr>
                        <table class="table" id="add_new">

                        </table>


                        </tbody>

                    </table>
                </div>

                <div class="row">
                    <div class="col-xs-8">
                        <p class="well well-sm mt" style="visibility: hidden">

                        </p>
                    </div>

                    <div class="col-sm-4 pv">
                        <div class="clearfix">
                            <p class="pull-left"><?= $language_info['sub_total'] ?></p>
                            <p class="pull-right mr">
                                <?php echo $currency->symbol; ?>
                                <span id="sub_total"></span>
                            </p>
                        </div>

                        <div class="table clearfix">
                            <p class="pull-left"><?= $language_info['default_tax'] ?> (
                                %)
                                <input style="width: 50%;" type="text" data-parsley-type="number" name="tax"
                                       value="<?php echo $this->config->item('default_tax') ?>"
                                       class="pull-right form-control">
                            </p>
                            <p class="pull-right mr">
                                <?php echo $currency->symbol; ?>
                                <span id="default_tax"></span>
                            </p>
                        </div>
                        <div class="table clearfix">
                            <p class="pull-left"><?= $language_info['discount'] ?> (
                                %)
                                <input style="width: 50%;" value="<?php
                                if (!empty($invoice_info->discount)) {
                                    echo $invoice_info->discount;
                                }
                                ?>" type="text" data-parsley-type="number" name="discount"
                                       class="pull-right form-control">
                            </p>
                            <p class="pull-right mr">
                                <?php
                                echo $currency->symbol; ?> -
                                <span id="discount"></span>
                            </p>
                        </div>
                        <?php
                        if (!empty($invoice_info)) {
                            $paid_amount = $this->invoice_model->calculate_to('paid_amount', $invoice_info->invoices_id);
                        } else {
                            $paid_amount = 0;
                        }
                        if ($paid_amount > 0) {
                            $total = $language_info['total_due'];
                        } else {
                            $total = $language_info['total'];
                        }
                        if ($paid_amount > 0) {
                            ?>
                            <div class="table clearfix">
                                <p class="pull-left"><?= $language_info['paid_amount'] ?> </p>
                                <p class="pull-right mr">
                                    <input value="<?php
                                    if (!empty($paid_amount)) {
                                        echo $paid_amount;
                                    }
                                    ?>" type="hidden" name="paid_amount">
                                    <?php
                                    echo $currency->symbol; ?>
                                    <span id="paid_amount"><?= $paid_amount; ?></span>
                                </p>
                            </div>
                        <?php } ?>

                        <div class="table clearfix">
                            <p class="pull-left h3"><?= $total ?></p>
                            <p class="pull-right mr h3"><?php echo $currency->symbol; ?>
                                <span id="grand_total"></span></p>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <input type="submit" value="<?= lang('save_as_draft') ?>" name="save_as_draft"
                           class="btn btn-primary">
                    <input type="submit" value="<?= lang('update') ?>" name="update" class="btn btn-success">
                </div>
            </form>
        </div>
        <script type="text/javascript">
            $(document).ready(function () {
                $(".table").on("change", 'input[name^="unit_cost[]"], input[name^="quantity[]"], input[name^="tax"], input[name^="discount"], select[name^="item_tax_rate[]"]', function (event) {
                    calculateRow($(this).closest("tr"));
                    calculateGrandTotal();
                });
                calculateGrandTotal();
            });

            function calculateRow(row) {
                var price = +row.find('input[name^="unit_cost[]"]').val();
                var qty = +row.find('input[name^="quantity[]"]').val();
                var tax = +row.find('select[name^="item_tax_rate[]"]').val();
                var linetotal = price * qty;
                total_tax = ((tax / 100) * linetotal).toFixed(2);
                row.find('input[name^="product_tax"]').val(total_tax);
                line_total = parseFloat(linetotal) + parseFloat(total_tax);
                row.find('span[class^="linetotal"]').text(line_total.toFixed(2));
            }

            function calculateGrandTotal() {
                var sub_total = 0;
                $(".table").find('span[class^="linetotal"]').each(function () {
                    if ($(this).text()) {
                        sub_total += +$(this).text();
                    }
                });

                var tax = $(".table").find('input[name^="tax"]').val();
                var paid_amount = $(".table").find('input[name^="paid_amount"]').val();
                var default_tax = ((tax / 100) * sub_total).toFixed(2);
                var discount = $(".table").find('input[name^="discount"]').val();
                var total_discount = ((discount / 100) * sub_total).toFixed(2);
                var grand_total = parseFloat(sub_total) + parseFloat(default_tax) - parseFloat(total_discount);
                if (paid_amount) {
                    if (paid_amount < grand_total) {
                        grand_total = grand_total;
                    } else {
                        grand_total = 0;
                    }
                }
                $("#default_tax").text(default_tax);
                $("#discount").text(total_discount);
                $("#sub_total").text(sub_total.toFixed(2));
                $("#grand_total").text(grand_total.toFixed(2));

            }
        </script>
        <script type="text/javascript">

            $(document).ready(function () {
                $('#start_recurring').click(function () {
                    $('#recurring').slideToggle("fast");
                    $('#recurring').removeClass("hide");
                    $('#recuring_frequency').prop('disabled', false);
                });
            });

            function slideToggle($id) {
                $($id).slideToggle("slow");
            }
            $(document).ready(function () {
                $("#select_all_tasks").click(function () {
                    $(".tasks_list").prop('checked', $(this).prop('checked'));
                });
                $("#select_all_expense").click(function () {
                    $(".expense_list").prop('checked', $(this).prop('checked'));
                });
                $('[data-toggle="popover"]').popover();

            });

            $(document).ready(function () {
                var maxAppend = 0;
                $("#add_more").click(function () {

                    var add_new = $('<tr style="">\n\
                    <td><textarea rows="1" name="item_name[]" required placeholder="Item name" class="form-control"></textarea></td>">\n\
                    <td><textarea rows="1" name="item_desc[]" placeholder="Item Description" class="form-control"></textarea></td>\n\
                        <td class="col-sm-1"><input type="number" data-parsley-type="number" name="quantity[]" placeholder="1" required class="form-control"></td>\n\
                        <td class="col-sm-1"><input type="number" data-parsley-type="number" name="unit_cost[]" required placeholder="100" class="form-control"></td>\n\
                        <td ><select name="item_tax_rate[]" class="form-control"><option value="0.00"><?= lang('none') ?></option>\n\\n\
<?php
                        $tax_rates = $this->db->get('tbl_tax_rates')->result();
                        if (!empty($tax_rates)) {
                        foreach ($tax_rates as $v_tax) {
                        ?><option value="<?= $v_tax->tax_rate_percent ?>"><?= $v_tax->tax_rate_name ?></option><?php
                        }
                        }
                        ?></select></td>\n\
<td class="col-sm-1"><input type="text" name="product_tax" placeholder="0.00" readonly="" class="form-control"></td>\n\
<td><span class="linetotal"></span></td>\n\
<td><a href="javascript:void(0);" class="remCF btn btn-danger btn-xs"><i class="fa fa-trash-o"></i></a></strong></td></tr>\n<br/>');
                    maxAppend++;
                    $("#add_new").append(add_new);
                });

                $("#add_new").on('click', '.remCF', function () {
                    $(this).parent().parent().remove();
                    calculateGrandTotal();
                });
            });
        </script>
    </div>
</div>

<script type="text/javascript">
    $(document).ready(function () {
        $('#start_recurring').click(function () {
            $('#recurring').slideToggle("fast");
            $('#recurring').removeClass("hide");
            $('#recuring_frequency').prop('disabled', false);
        });
    });

</script>