<?= message_box('success'); ?>
<?= message_box('error'); ?>
<?php include_once 'assets/admin-ajax.php'; ?>
<?php
$mdate = date('Y-m-d');
$last_7_days = date('Y-m-d', strtotime('today - 7 days'));
$all_goal_tracking = $this->estimates_model->get_permission('tbl_goal_tracking');

$all_goal = 0;
$bank_goal = 0;
$complete_achivement = 0;
if (!empty($all_goal_tracking)) {
    foreach ($all_goal_tracking as $v_goal_track) {
        $goal_achieve = $this->estimates_model->get_progress($v_goal_track, true);
        if ($v_goal_track->goal_type_id == 6) {
            if ($v_goal_track->end_date <= $mdate) { // check today is last date or not

                if ($v_goal_track->email_send == 'no') {// check mail are send or not
                    if ($v_goal_track->achievement <= $goal_achieve['achievement']) {
                        if ($v_goal_track->notify_goal_achive == 'on') {// check is notify is checked or not check
                            $this->estimates_model->send_goal_mail('goal_achieve', $v_goal_track);
                        }
                    } else {
                        if ($v_goal_track->notify_goal_not_achive == 'on') {// check is notify is checked or not check
                            $this->estimates_model->send_goal_mail('goal_not_achieve', $v_goal_track);
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
    $invoice_result[$date] = count($this->db->where($where)->get('tbl_estimates')->result());
}

$terget_achievement = $this->db->where(array('goal_type_id' => 6, 'start_date >=' => $last_7_days, 'end_date <=' => $mdate))->get('tbl_goal_tracking')->result();

$total_terget = 0;
if (!empty($terget_achievement)) {
    foreach ($terget_achievement as $v_terget) {
        $total_terget += $v_terget->achievement;
    }
}
$tolal_goal = $all_goal + $bank_goal;
$curency = $this->estimates_model->check_by(array('code' => config_item('default_currency')), 'tbl_currencies');

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
                        <?= ($pending_goal) ?></p>
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
                                                            data-toggle="tab"><?= lang('all_estimates') ?></a></li>
        <li class="<?= $active == 2 ? 'active' : ''; ?>"><a href="#new"
                                                            data-toggle="tab"><?= lang('create_estimate') ?></a></li>
    </ul>
    <div class="tab-content bg-white">
        <!-- ************** general *************-->
        <div class="tab-pane <?= $active == 1 ? 'active' : ''; ?>" id="manage">
            <div class="table-responsive">
                <table class="table table-striped DataTables " id="DataTables" cellspacing="0" width="100%">
                    <thead>
                    <tr>
                        <th><?= lang('estimate') ?></th>
                        <th><?= lang('created') ?></th>
                        <th><?= lang('due_date') ?></th>
                        <th><?= lang('client_name') ?></th>
                        <th><?= lang('amount') ?></th>
                        <th><?= lang('status') ?></th>
                        <th><?= lang('action') ?></th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php

                    if (!empty($all_estimates_info)) {
                        foreach ($all_estimates_info as $v_estimates) {
                            $can_edit = $this->estimates_model->can_action('tbl_estimates', 'edit', array('estimates_id' => $v_estimates->estimates_id));
                            $can_delete = $this->estimates_model->can_action('tbl_estimates', 'delete', array('estimates_id' => $v_estimates->estimates_id));

                            if ($v_estimates->status == 'Pending') {
                                $label = "info";
                            } elseif ($v_estimates->status == 'Accepted') {
                                $label = "success";
                            } else {
                                $label = "danger";
                            }
                            ?>
                            <tr>
                                <td>
                                    <a class="text-info"
                                       href="<?= base_url() ?>admin/estimates/index/estimates_details/<?= $v_estimates->estimates_id ?>"><?= $v_estimates->reference_no ?></a>
                                </td>
                                <td><?= strftime(config_item('date_format'), strtotime($v_estimates->date_saved)) ?></td>
                                <td><?= strftime(config_item('date_format'), strtotime($v_estimates->due_date)) ?>
                                    <?php
                                    if (strtotime($v_estimates->due_date) < time() AND $v_estimates->status == 'Pending') { ?>
                                        <span class="label label-danger "><?= lang('expired') ?></span>
                                    <?php }
                                    ?>
                                </td>
                                <?php
                                $client_info = $this->estimates_model->check_by(array('client_id' => $v_estimates->client_id), 'tbl_client');
                                if ($client_info->client_status == 1) {
                                    $status = lang('person');
                                } else {
                                    $status = lang('company');;
                                }
                                ?>
                                <td><?= $client_info->name . ' ' . $status . ''; ?></td>
                                <?php $currency = $this->estimates_model->client_currency_sambol($v_estimates->client_id); ?>
                                <td>
                                    <?= display_money($this->estimates_model->estimate_calculation('estimate_amount', $v_estimates->estimates_id), $currency->symbol); ?>
                                </td>
                                <td><span
                                        class="label label-<?= $label ?>"><?= lang(strtolower($v_estimates->status)) ?></span>
                                </td>
                                <td>
                                    <?php if (!empty($can_edit)) { ?>
                                        <?= btn_edit('admin/estimates/index/edit_estimates/' . $v_estimates->estimates_id) ?>
                                    <?php }
                                    if (!empty($can_delete)) {
                                        ?>
                                        <?= btn_delete('admin/estimates/delete/delete_estimates/' . $v_estimates->estimates_id) ?>
                                    <?php } ?>
                                    <?php if (!empty($can_edit)) { ?>
                                        <div class="btn-group">
                                            <button class="btn btn-xs btn-default dropdown-toggle"
                                                    data-toggle="dropdown">
                                                <?= lang('change_status') ?>
                                                <span class="caret"></span></button>
                                            <ul class="dropdown-menu animated zoomIn">
                                                <li>
                                                    <a href="<?= base_url() ?>admin/estimates/index/email_estimates/<?= $v_estimates->estimates_id ?>"><?= lang('send_email') ?></a>
                                                </li>
                                                <li>
                                                    <a href="<?= base_url() ?>admin/estimates/index/estimates_details/<?= $v_estimates->estimates_id ?>"><?= lang('view_details') ?></a>
                                                </li>
                                                <li>
                                                    <a href="<?= base_url() ?>admin/estimates/index/estimates_history/<?= $v_estimates->estimates_id ?>"><?= lang('history') ?></a>
                                                </li>
                                                <li>
                                                    <a href="<?= base_url() ?>admin/estimates/change_status/declined/<?= $v_estimates->estimates_id ?>"><?= lang('declined') ?></a>
                                                </li>
                                                <li>
                                                    <a href="<?= base_url() ?>admin/estimates/change_status/accepted/<?= $v_estimates->estimates_id ?>"><?= lang('accepted') ?></a>
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
        <div class="tab-pane <?= $active == 2 ? 'active' : ''; ?>" id="new">
            <form data-parsley-validate="" novalidate="" role="form" enctype="multipart/form-data" id="form"
                  action="<?php echo base_url(); ?>admin/estimates/save_estimates/<?php
                  if (!empty($estimates_info)) {
                      echo $estimates_info->estimates_id;
                  }
                  ?>" method="post" class="form-horizontal  ">
                <div class="form-group">
                    <label class="col-lg-3 control-label"><?= lang('reference_no') ?> <span class="text-danger">*</span></label>
                    <div class="col-lg-5">
                        <?php $this->load->helper('string'); ?>
                        <input type="text" class="form-control" value="<?php
                        if (!empty($estimates_info)) {
                            echo $estimates_info->reference_no;
                        } else {
                            echo config_item('estimate_prefix');
                            if (config_item('increment_estimate_number') == 'FALSE') {
                                $this->load->helper('string');
                                echo random_string('nozero', 6);
                            } else {
                                echo $this->estimates_model->generate_estimate_number();
                            }
                        }
                        ?>" name="reference_no">
                    </div>

                </div>

                <div class="form-group">
                    <label class="col-lg-3 control-label"><?= lang('client') ?> <span class="text-danger">*</span>
                    </label>
                    <div class="col-lg-5">
                        <select class="form-control select_box" required style="width: 100%" name="client_id"
                                onchange="get_project_by_id(this.value)">

                            <?php
                            if (!empty($all_client)) {
                                foreach ($all_client as $v_client) {
                                    if ($v_client->client_status == 1) {
                                        $status = lang('person');
                                    } else {
                                        $status = lang('company');;
                                    }
                                    if (!empty($project_info->client_id)) {
                                        $client_id = $project_info->client_id;
                                    } elseif ($estimates_info->client_id) {
                                        $client_id = $estimates_info->client_id;
                                    }

                                    ?>
                                    <option value="<?= $v_client->client_id ?>"
                                        <?php
                                        if (!empty($client_id)) {
                                            echo $client_id == $v_client->client_id ? 'selected' : '';
                                        }
                                        ?>
                                    ><?= ucfirst($v_client->name) . ' ' . $status . '' ?></option>
                                    <?php
                                }
                            }
                            ?>
                        </select>
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-lg-3 control-label"><?= lang('project') ?></label>
                    <div class="col-lg-5">
                        <select class="form-control " style="width: 100%" name="project_id"
                                id="client_project">
                            <option value=""><?= lang('none') ?></option>
                            <?php
                            if (!empty($client_id)) {
                                if (!empty($project_info->project_id)) {
                                    $project_id = $project_info->project_id;
                                } elseif ($estimates_info->project_id) {
                                    $project_id = $estimates_info->project_id;
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
                    <div class="col-lg-5">
                        <div class="input-group">
                            <input type="text" name="due_date" class="form-control datepicker" value="<?php
                            if (!empty($estimates_info->due_date)) {
                                echo $estimates_info->due_date;
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

                <div class="form-group">
                    <label class="col-lg-3 control-label"><?= lang('default_tax') ?> </label>
                    <div class="col-lg-4">
                        <div class="input-group  ">
                            <input class="form-control " data-parsley-type="number" value="<?php
                            if (!empty($estimates_info)) {
                                echo $estimates_info->tax;
                            } else {
                                echo $this->config->item('default_tax');
                            }
                            ?>" type="text" value="<?= $this->config->item('default_tax') ?>" name="tax">
                            <span class="input-group-addon">%</span>
                        </div>

                    </div>
                </div>

                <!-- Start discount fields -->

                <div>

                    <div class="form-group">
                        <label class="col-lg-3 control-label"><?= lang('discount') ?> </label>
                        <div class="col-lg-4">
                            <div class="input-group  ">
                                <input class="form-control " data-parsley-type="number" value="<?php
                                if (!empty($estimates_info)) {
                                    echo $estimates_info->discount;
                                } else {
                                    echo '0';
                                }
                                ?>" type="text" value="0" name="discount">
                                <span class="input-group-addon">%</span>
                            </div>
                        </div>
                    </div>

                </div>
                <!-- End discount Fields -->


                <div class="form-group terms">
                    <label class="col-lg-3 control-label"><?= lang('notes') ?> </label>
                    <div class="col-lg-7">
                        <textarea name="notes" class="form-control textarea"><?php
                            if (!empty($estimates_info)) {
                                echo $estimates_info->notes;
                            } else {
                                echo $this->config->item('estimate_terms');
                            }
                            ?></textarea>
                    </div>
                </div>
                <?php
                if (!empty($estimates_info)) {
                    $estimates_id = $estimates_info->estimates_id;
                } else {
                    $estimates_id = null;
                }
                ?>
                <?= custom_form_Fields(10, $estimates_id); ?>
                <?php if (!empty($project_id)): ?>
                    <div class="form-group">
                        <label for="field-1"
                               class="col-sm-3 control-label"><?= lang('visible_to_client') ?>
                            <span class="required">*</span></label>
                        <div class="col-sm-8">
                            <input data-toggle="toggle" name="client_visible" value="Yes" <?php
                            if (!empty($estimates_info->client_visible) && $estimates_info->client_visible == 'Yes') {
                                echo 'checked';
                            }
                            ?> data-on="<?= lang('yes') ?>" data-off="<?= lang('no') ?>"
                                   data-onstyle="success" data-offstyle="danger" type="checkbox">
                        </div>
                    </div>
                <?php endif ?>
                <div class="form-group" id="border-none">
                    <label for="field-1" class="col-sm-3 control-label"><?= lang('permission') ?> <span
                            class="required">*</span></label>
                    <div class="col-sm-9">
                        <div class="checkbox c-radio needsclick">
                            <label class="needsclick">
                                <input id="" <?php
                                if (!empty($estimates_info->permission) && $estimates_info->permission == 'all') {
                                    echo 'checked';
                                } elseif (empty($estimates_info)) {
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
                                if (!empty($estimates_info->permission) && $estimates_info->permission != 'all') {
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
                if (!empty($estimates_info->permission) && $estimates_info->permission != 'all') {
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
                                            if (!empty($estimates_info->permission) && $estimates_info->permission != 'all') {
                                                $get_permission = json_decode($estimates_info->permission);
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

                                if (!empty($estimates_info->permission) && $estimates_info->permission != 'all') {
                                    $get_permission = json_decode($estimates_info->permission);

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

                                            if (!empty($estimates_info->permission) && $estimates_info->permission != 'all') {
                                                $get_permission = json_decode($estimates_info->permission);

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

                                            if (!empty($estimates_info->permission) && $estimates_info->permission != 'all') {
                                                $get_permission = json_decode($estimates_info->permission);
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
                                class="fa fa-plus"></i> <?= lang('create_estimate') ?></button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>