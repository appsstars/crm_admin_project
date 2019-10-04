<?php echo message_box('success'); ?>
<?php echo message_box('error'); ?>
<style>
    .note-editor .note-editable {
        height: 150px;
    }
</style>
<?php
$can_edit = $this->bugs_model->can_action('tbl_bug', 'edit', array('bug_id' => $bug_details->bug_id));
$comment_details = $this->db->where('bug_id', $bug_details->bug_id)->get('tbl_task_comment')->result();
$activities_info = $this->db->where(array('module' => 'bugs', 'module_field_id' => $bug_details->bug_id))->order_by('activity_date', 'desc')->get('tbl_activities')->result();
$all_task_info = $this->db->where('bug_id', $bug_details->bug_id)->order_by('task_id', 'DESC')->get('tbl_task')->result();

$where = array('user_id' => $this->session->userdata('user_id'), 'module_id' => $bug_details->bug_id, 'module_name' => 'bugs');
$check_existing = $this->bugs_model->check_by($where, 'tbl_pinaction');
if (!empty($check_existing)) {
    $url = 'remove_todo/' . $check_existing->pinaction_id;
    $btn = 'danger';
    $title = lang('remove_todo');
} else {
    $url = 'add_todo_list/bugs/' . $bug_details->bug_id;
    $btn = 'warning';
    $title = lang('add_todo_list');
}
?>
<div class="row mt-lg">
    <div class="col-sm-3">
        <ul class="nav nav-pills nav-stacked navbar-custom-nav">
            <li class="<?= $active == 1 ? 'active' : '' ?>"><a href="#task_details"
                                                               data-toggle="tab"><?= lang('details') ?></a></li>
            <li class="<?= $active == 2 ? 'active' : '' ?>"><a href="#task_comments"
                                                               data-toggle="tab"><?= lang('comments') ?><strong
                        class="pull-right"><?= (!empty($comment_details) ? count($comment_details) : null) ?></strong></a>
            </li>
            <li class="<?= $active == 3 ? 'active' : '' ?>"><a href="#task_attachments"
                                                               data-toggle="tab"><?= lang('attachment') ?><strong
                        class="pull-right"><?= (!empty($project_files_info) ? count($project_files_info) : null) ?></strong></a>
            </li>
            <li class="<?= $active == 6 ? 'active' : '' ?>"><a href="#tasks"
                                                               data-toggle="tab"><?= lang('tasks') ?><strong
                        class="pull-right"><?= (!empty($all_task_info) ? count($all_task_info) : null) ?></strong></a>
            </li>
            <li class="<?= $active == 4 ? 'active' : '' ?>"><a href="#task_notes"
                                                               data-toggle="tab"><?= lang('notes') ?></a></li>
            <li class="<?= $active == 5 ? 'active' : '' ?>"><a href="#activities"
                                                               data-toggle="tab"><?= lang('activities') ?><strong
                        class="pull-right"><?= (!empty($activities_info) ? count($activities_info) : null) ?></strong></a>
        </ul>
    </div>
    <div class="col-sm-9">
        <div class="tab-content" style="border: 0;padding:0;">
            <!-- Task Details tab Starts -->
            <div class="tab-pane <?= $active == 1 ? 'active' : '' ?>" id="task_details" style="position: relative;">
                <div class="panel panel-custom">
                    <div class="panel-heading">
                        <h3 class="panel-title"><?php
                            if (!empty($bug_details->bug_title)) {
                                echo $bug_details->bug_title;
                            }
                            ?>
                            <div class="pull-right ml-sm " style="margin-top: -6px">
                                <a data-toggle="tooltip" data-placement="top" title="<?= $title ?>"
                                   href="<?= base_url() ?>admin/projects/<?= $url ?>"
                                   class="btn btn-<?= $btn ?>"><i class="fa fa-thumb-tack"></i></a>
                            </div>
                            <span class="btn-xs pull-right">
                <?php if (!empty($can_edit)) { ?>
                    <a href="<?= base_url() ?>admin/bugs/index/<?= $bug_details->bug_id ?>"><?= lang('edit') . ' ' . lang('bugs') ?></a>
                <?php } ?>
                    </span>
                        </h3>
                    </div>
                    <div class="panel-body row form-horizontal task_details">
                        <div class="form-group col-sm-12">
                            <div class="col-sm-6">
                                <label class="control-label col-sm-4"><strong><?= lang('bug_title') ?> :</strong>
                                </label>
                                <p class="form-control-static"><?php if (!empty($bug_details->bug_title)) echo $bug_details->bug_title; ?></p>
                            </div>
                            <div class="col-sm-6">
                                <label class="control-label col-sm-5"><strong><?= lang('bug_status') ?>
                                        :</strong></label>
                                <div class="pull-left">
                                    <?php

                                    if ($bug_details->bug_status == 'unconfirmed') {
                                        $label = 'warning';
                                    } elseif ($bug_details->bug_status == 'confirmed') {
                                        $label = 'info';
                                    } elseif ($bug_details->bug_status == 'in_progress') {
                                        $label = 'primary';
                                    } elseif ($bug_details->bug_status == 'resolved') {
                                        $label = 'purple';
                                    } else {
                                        $label = 'success';
                                    }
                                    $user_info = $this->db->where('user_id', $bug_details->reporter)->get('tbl_users')->row();
                                    ?>
                                    <p class="form-control-static"><span
                                            class="label label-<?= $label ?>"><?php if (!empty($bug_details->bug_status)) echo lang($bug_details->bug_status); ?></span>
                                    </p>
                                </div>
                                <?php if (!empty($can_edit)) { ?>
                                    <div class="col-sm-1 mt">
                                        <div class="btn-group">
                                            <button class="btn btn-xs btn-success dropdown-toggle"
                                                    data-toggle="dropdown">
                                                <?= lang('change') ?>
                                                <span class="caret"></span></button>
                                            <ul class="dropdown-menu animated zoomIn">

                                                <li>
                                                    <a href="<?= base_url() ?>admin/bugs/change_status/<?= $bug_details->bug_id ?>/unconfirmed"><?= lang('unconfirmed') ?></a>
                                                </li>
                                                <li>
                                                    <a href="<?= base_url() ?>admin/bugs/change_status/<?= $bug_details->bug_id ?>/confirmed"><?= lang('confirmed') ?></a>
                                                </li>
                                                <li>
                                                    <a href="<?= base_url() ?>admin/bugs/change_status/<?= $bug_details->bug_id ?>/in_progress"><?= lang('in_progress') ?></a>
                                                </li>
                                                <li>
                                                    <a href="<?= base_url() ?>admin/bugs/change_status/<?= $bug_details->bug_id ?>/resolved"><?= lang('resolved') ?></a>
                                                </li>
                                                <li>
                                                    <a href="<?= base_url() ?>admin/bugs/change_status/<?= $bug_details->bug_id ?>/verified"><?= lang('verified') ?></a>
                                                </li>

                                            </ul>
                                        </div>
                                    </div>
                                <?php } ?>
                            </div>

                        </div>
                        <?php
                        if (!empty($bug_details->project_id)):
                            $project_info = $this->db->where('project_id', $bug_details->project_id)->get('tbl_project')->row();
                            ?>
                            <div class="form-group  col-sm-10">
                                <label class="control-label col-sm-3 "><strong
                                        class="mr-sm"><?= lang('project_name') ?></strong></label>
                                <div class="col-sm-8 " style="margin-left: -5px;">
                                    <p class="form-control-static"><?php if (!empty($project_info->project_name)) echo $project_info->project_name; ?></p>
                                </div>
                            </div>
                        <?php endif ?>

                        <?php
                        if (!empty($bug_details->opportunities_id)):
                            $opportunity_info = $this->db->where('opportunities_id', $bug_details->opportunities_id)->get('tbl_opportunities')->row();
                            ?>
                            <div class="form-group  col-sm-10">
                                <label class="control-label col-sm-3 "><strong
                                        class="mr-sm"><?= lang('opportunity_name') ?></strong></label>
                                <div class="col-sm-8 " style="margin-left: -5px;">
                                    <p class="form-control-static"><?php if (!empty($opportunity_info->opportunity_name)) echo $opportunity_info->opportunity_name; ?></p>
                                </div>
                            </div>
                        <?php endif ?>

                        <div class="form-group col-sm-12">
                            <?php if (!empty($can_edit)) {
                                $col = 5;
                                ?>
                                <div class="col-sm-6">
                                    <label class="control-label col-sm-4"><strong><?= lang('reporter') ?>
                                            : </strong></label>
                                    <p class="form-control-static">
                                        <?php if (!empty($bug_details->reporter)) {
                                            if ($user_info->role_id == '1') {
                                                $badge = 'danger';
                                            } elseif ($user_info->role_id == '2') {
                                                $badge = 'info';
                                            } else {
                                                $badge = 'primary';
                                            } ?>
                                            <span class="badge btn-<?= $badge ?>"><?= $user_info->username; ?></span>
                                        <?php } ?>
                                    </p>
                                </div>
                            <?php } else {
                                $col = 4;
                            } ?>
                            <div class="col-sm-6">
                                <label class="control-label col-sm-<?= $col ?>"><strong><?= lang('priority') ?>
                                        :</strong>
                                </label>
                                <?php
                                if ($bug_details->priority == 'High') {
                                    $label = 'danger';
                                } elseif ($bug_details->priority == 'Medium') {
                                    $label = 'info';
                                } else {
                                    $label = 'primary';
                                }
                                ?>
                                <p class="form-control-static">
                                    <span
                                        class="badge btn-<?= $label ?>"><?php if (!empty($bug_details->priority)) echo $bug_details->priority; ?></span>
                                </p>
                            </div>
                        </div>
                        <div class="form-group col-sm-12">
                            <div class="col-sm-6">
                                <label class="control-label col-sm-4"><strong><?= lang('update_on') ?>
                                        : </strong></label>
                                <p class="form-control-static">
                                    <?= strftime(config_item('date_format'), strtotime($bug_details->update_time)) . ' ' . date('H:i A', strtotime($bug_details->update_time)) ?>
                                </p>
                            </div>
                            <div class="col-sm-6">
                                <label class="control-label col-sm-5"><strong><?= lang('created_date') ?> :</strong>
                                </label>

                                <p class="form-control-static">
                                    <?= strftime(config_item('date_format'), strtotime($bug_details->created_time)) . ' ' . date('H:i A', strtotime($bug_details->created_time)) ?>
                                </p>
                            </div>
                        </div>
                        <div class="form-group  col-sm-12">
                            <label class="control-label col-sm-2"><strong><?= lang('participants') ?>
                                    :</strong></label>
                            <div class="col-sm-8 ">

                                <?php
                                if ($bug_details->permission != 'all') {
                                    $get_permission = json_decode($bug_details->permission);
                                    if (!empty($get_permission)) :
                                        foreach ($get_permission as $permission => $v_permission) :
                                            $user_info = $this->db->where(array('user_id' => $permission))->get('tbl_users')->row();
                                            if ($user_info->role_id == 1) {
                                                $label = 'circle-danger';
                                            } else {
                                                $label = 'circle-success';
                                            }
                                            $profile_info = $this->db->where(array('user_id' => $permission))->get('tbl_account_details')->row();
                                            ?>


                                            <a href="#" data-toggle="tooltip" data-placement="top"
                                               title="<?= $profile_info->fullname ?>"><img
                                                    src="<?= base_url() . $profile_info->avatar ?>"
                                                    class="img-circle img-xs" alt="">
                                                <span style="margin: 0px 0 8px -10px;"
                                                      class="circle <?= $label ?>  circle-lg"></span>
                                            </a>
                                            <?php
                                        endforeach;
                                    endif;
                                } else { ?>
                                <p class="form-control-static"><strong><?= lang('everyone') ?></strong>
                                    <i
                                        title="<?= lang('permission_for_all') ?>"
                                        class="fa fa-question-circle" data-toggle="tooltip"
                                        data-placement="top"></i>

                                    <?php
                                    }
                                    ?>
                                    <?php if (!empty($can_edit)){ ?>
                                    <span data-placement="top" data-toggle="tooltip"
                                          title="<?= lang('add_more') ?>">
                                            <a data-toggle="modal" data-target="#myModal"
                                               href="<?= base_url() ?>admin/bugs/update_users/<?= $bug_details->bug_id ?>"
                                               class="text-default ml"><i class="fa fa-plus"></i></a>
                                                </span>
                                </p>
                            <?php
                            }
                            ?>
                            </div>
                        </div>
                        <?php $show_custom_fields = custom_form_label(6, $bug_details->bug_id);

                        if (!empty($show_custom_fields)) {
                            foreach ($show_custom_fields as $c_label => $v_fields) {
                                if (!empty($v_fields)) {
                                    if (count($v_fields) == 1) {
                                        $col = 'col-sm-12';
                                        $sub_col = 'col-sm-2';
                                        $style = null;
                                    } else {
                                        $col = 'col-sm-6';
                                        $sub_col = 'col-sm-5';
                                        $style = null;
                                    }

                                    ?>
                                    <div class="form-group  <?= $col ?>" style="<?= $style ?>">
                                        <label class="control-label <?= $sub_col ?>"><strong><?= $c_label ?>
                                                :</strong></label>
                                        <div class="col-sm-7 ">
                                            <p class="form-control-static">
                                                <strong><?= $v_fields ?></strong>
                                            </p>
                                        </div>
                                    </div>
                                <?php }
                            }
                        }
                        ?>
                    </div>
                </div>
            </div>
            <!-- Task Details tab Ends -->


            <!-- Task Comments Panel Starts --->
            <div class="tab-pane <?= $active == 2 ? 'active' : '' ?>" id="task_comments"
                 style="position: relative;">
                <div class="panel panel-custom">
                    <div class="panel-heading">
                        <h3 class="panel-title"><?= lang('comments') ?></h3>
                    </div>
                    <div class="panel-body chat" id="chat-box">

                        <form id="form_validation" action="<?php echo base_url() ?>admin/bugs/save_comments"
                              method="post" class="form-horizontal">
                            <input type="hidden" name="bug_id" value="<?php
                            if (!empty($bug_details->bug_id)) {
                                echo $bug_details->bug_id;
                            }
                            ?>" class="form-control">
                            <div class="form-group">
                                <div class="col-sm-12">
                                        <textarea class="form-control textarea"
                                                  placeholder="<?= $bug_details->bug_title . ' ' . lang('comments') ?>"
                                                  name="comment" style="height: 70px;"></textarea>
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="col-sm-12">
                                    <div class="pull-right">
                                        <button type="submit" id="sbtn"
                                                class="btn btn-primary"><?= lang('post_comment') ?></button>
                                    </div>
                                </div>
                            </div>
                        </form>
                        <hr/>

                        <?php
                        if (!empty($comment_details)):foreach ($comment_details as $key => $v_comment):
                            $user_info = $this->db->where(array('user_id' => $v_comment->user_id))->get('tbl_users')->row();
                            $profile_info = $this->db->where(array('user_id' => $v_comment->user_id))->get('tbl_account_details')->row();
                            if ($user_info->role_id == 1) {
                                $label = '<small style="font-size:10px;padding:2px;" class="label label-danger ">' . lang('admin') . '</small>';
                            } elseif ($user_info->role_id == 2) {
                                $label = '<small style="font-size:10px;padding:2px;" class="label label-danger ">' . lang('client') . '</small>';
                            } else {
                                $label = '<small style="font-size:10px;padding:2px;" class="label label-primary">' . lang('staff') . '</small>';
                            }
                            ?>

                            <div class="col-sm-12 item ">

                                <img src="<?php echo base_url() . $profile_info->avatar ?>" alt="user image"
                                     class="img-circle"/>


                                <p class="message">
                                    <?php
                                    $today = time();
                                    $comment_time = strtotime($v_comment->comment_datetime);
                                    ?>
                                    <small class="text-muted pull-right"><i
                                            class="fa fa-clock-o"></i> <?= $this->bugs_model->get_time_different($today, $comment_time) ?> <?= lang('ago') ?>
                                        <?php if ($v_comment->user_id == $this->session->userdata('user_id')) { ?>
                                            <?= btn_delete('admin/bugs/delete_bug_comments/' . $v_comment->bug_id . '/' . $v_comment->task_comment_id) ?>
                                        <?php } ?></small>
                                    <a href="#" class="name">
                                        <?= ($profile_info->fullname) . ' ' . $label ?>
                                    </a>

                                    <?php if (!empty($v_comment->comment)) echo $v_comment->comment; ?>
                                </p>

                            </div><!-- /.item -->
                        <?php endforeach; ?>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
            <!-- Task Comments Panel Ends--->

            <!-- Task Attachment Panel Starts --->
            <div class="tab-pane <?= $active == 3 ? 'active' : '' ?>" id="task_attachments"
                 style="position: relative;">
                <div class="panel panel-custom">
                    <div class="panel-heading">
                        <h3 class="panel-title"><?= lang('attachment') ?></h3>
                    </div>
                    <div class="panel-body">

                        <form action="<?= base_url() ?>admin/bugs/save_bug_attachment/<?php
                        if (!empty($add_files_info)) {
                            echo $add_files_info->task_attachment_id;
                        }
                        ?>" enctype="multipart/form-data" method="post" id="form" class="form-horizontal">
                            <div class="form-group">
                                <label class="col-lg-3 control-label"><?= lang('file_title') ?> <span
                                        class="text-danger">*</span></label>
                                <div class="col-lg-6">
                                    <input name="title" class="form-control" value="<?php
                                    if (!empty($add_files_info)) {
                                        echo $add_files_info->title;
                                    }
                                    ?>" required placeholder="<?= lang('file_title') ?>"/>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-lg-3 control-label"><?= lang('description') ?></label>
                                <div class="col-lg-6">
                                        <textarea name="description" class="form-control"
                                                  placeholder="<?= lang('description') ?>"><?php
                                            if (!empty($add_files_info)) {
                                                echo $add_files_info->description;
                                            }
                                            ?></textarea>
                                </div>
                            </div>
                            <?php if (empty($add_files_info)) { ?>
                                <div id="add_new">
                                    <div class="form-group" style="margin-bottom: 0px">
                                        <label for="field-1"
                                               class="col-sm-3 control-label"><?= lang('upload_file') ?></label>
                                        <div class="col-sm-6">
                                            <div class="fileinput fileinput-new" data-provides="fileinput">
                                                <?php if (!empty($project_files)):foreach ($project_files as $v_files_image): ?>
                                                    <span class=" btn btn-default btn-file"><span
                                                            class="fileinput-new"
                                                            style="display: none">Select file</span>
                                                                <span class="fileinput-exists"
                                                                      style="display: block"><?= lang('change') ?></span>
                                                                <input type="hidden" name="bug_files[]"
                                                                       value="<?php echo $v_files_image->files ?>">
                                                                <input type="file" name="bug_files[]">
                                                            </span>
                                                    <span
                                                        class="fileinput-filename"> <?php echo $v_files_image->file_name ?></span>
                                                <?php endforeach; ?>
                                                <?php else: ?>
                                                    <span class="btn btn-default btn-file"><span
                                                            class="fileinput-new"><?= lang('select_file') ?></span>
                                                            <span class="fileinput-exists"><?= lang('change') ?></span>
                                                            <input type="file" name="bug_files[]">
                                                        </span>
                                                    <span class="fileinput-filename"></span>
                                                    <a href="#" class="close fileinput-exists"
                                                       data-dismiss="fileinput" style="float: none;">&times;</a>
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
                            <?php } ?>
                            <br/>
                            <input type="hidden" name="bug_id" value="<?php
                            if (!empty($bug_details->bug_id)) {
                                echo $bug_details->bug_id;
                            }
                            ?>" class="form-control">
                            <div class="form-group">
                                <div class="col-sm-3">
                                </div>
                                <div class="col-sm-3">
                                    <button type="submit"
                                            class="btn btn-primary"><?= lang('upload_file') ?></button>
                                </div>
                            </div>
                        </form>

                    </div>
                </div>
                <?php
                if (!empty($project_files_info)) {
                    ?>
                    <div class="panel">
                        <div class="panel-heading" style="border-bottom: 2px solid #00BCD4">
                            <strong><?= lang('attach_file_list') ?></strong></div>
                        <div class="panel-body">
                            <?php
                            $this->load->helper('file');
                            foreach ($project_files_info as $key => $v_files_info) {
                                ?>
                                <div class="panel-group" id="accordion" style="margin:8px 5px" role="tablist"
                                     aria-multiselectable="true">
                                    <div class="box box-info" style="border-radius: 0px ">
                                        <div class="panel-heading" role="tab" id="headingOne">
                                            <h4 class="panel-title">
                                                <a data-toggle="collapse" data-parent="#accordion"
                                                   href="#<?php echo $key ?>" aria-expanded="true"
                                                   aria-controls="collapseOne">
                                                    <strong><?php echo $files_info[$key]->title; ?> </strong>
                                                    <small class="pull-right">
                                                        <?php if ($files_info[$key]->user_id == $this->session->userdata('user_id')) { ?>
                                                            <?= btn_delete('admin/bugs/delete_bug_files/' . $files_info[$key]->bug_id . '/' . $files_info[$key]->task_attachment_id) ?>
                                                        <?php } ?></small>
                                                </a>
                                            </h4>
                                        </div>
                                        <div id="<?php echo $key ?>" class="panel-collapse collapse <?php
                                        if (!empty($in) && $files_info[$key]->files_id == $in) {
                                            echo 'in';
                                        }
                                        ?>" role="tabpanel" aria-labelledby="headingOne">
                                            <div class="content">
                                                <div class="table-responsive">
                                                    <table id="table-files" class="table table-striped ">
                                                        <thead>
                                                        <tr>
                                                            <th width="45%"><?= lang('files') ?></th>
                                                            <th class=""><?= lang('size') ?></th>
                                                            <th><?= lang('date') ?></th>
                                                            <th><?= lang('uploaded_by') ?></th>
                                                            <th><?= lang('action') ?></th>
                                                        </tr>
                                                        </thead>
                                                        <tbody>
                                                        <?php
                                                        $this->load->helper('file');

                                                        if (!empty($v_files_info)) {
                                                            foreach ($v_files_info as $v_files) {
                                                                $user_info = $this->db->where(array('user_id' => $files_info[$key]->user_id))->get('tbl_users')->row();
                                                                ?>
                                                                <tr class="file-item">
                                                                    <td>
                                                                        <?php if ($v_files->is_image == 1) : ?>
                                                                            <div class="file-icon"><a
                                                                                    href="<?= base_url() . $v_files->files ?>">
                                                                                    <img
                                                                                        style="width: 50px;border-radius: 5px;"
                                                                                        src="<?= base_url() . $v_files->files ?>"/></a>
                                                                            </div>
                                                                        <?php else : ?>
                                                                            <div class="file-icon"><i
                                                                                    class="fa fa-file-o"></i>
                                                                                <a href="<?= base_url() . $v_files->files ?>"><?= $v_files->file_name ?></a>
                                                                            </div>
                                                                        <?php endif; ?>

                                                                        <a data-toggle="tooltip"
                                                                           data-placement="top"
                                                                           data-original-title="<?= $files_info[$key]->description ?>"
                                                                           class="text-info"
                                                                           href="<?= base_url() ?>admin/tasks/download_files/<?= $files_info[$key]->bug_id ?>/<?= $v_files->uploaded_files_id ?>">
                                                                            <?= $files_info[$key]->title ?>
                                                                            <?php if ($v_files->is_image == 1) : ?>
                                                                                <em><?= $v_files->image_width . "x" . $v_files->image_height ?></em>
                                                                            <?php endif; ?>
                                                                        </a>
                                                                        <p class="file-text"><?= $files_info[$key]->description ?></p>
                                                                    </td>
                                                                    <td class=""><?= $v_files->size ?> Kb</td>
                                                                    <td class="col-date"><?= date('Y-m-d' . "<br/> h:m A", strtotime($files_info[$key]->upload_time)); ?></td>
                                                                    <td>
                                                                        <?= $user_info->username ?>
                                                                    </td>
                                                                    <td>
                                                                        <a class="btn btn-xs btn-dark"
                                                                           data-toggle="tooltip"
                                                                           data-placement="top" title="Download"
                                                                           href="<?= base_url() ?>admin/tasks/download_files/<?= $files_info[$key]->bug_id ?>/<?= $v_files->uploaded_files_id ?>"><i
                                                                                class="fa fa-download"></i></a>
                                                                    </td>

                                                                </tr>
                                                                <?php
                                                            }
                                                        } else {
                                                            ?>
                                                            <tr>
                                                                <td colspan="5">
                                                                    <?= lang('nothing_to_display') ?>
                                                                </td>
                                                            </tr>
                                                        <?php } ?>
                                                        </tbody>
                                                    </table>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <?php
                            }
                            ?>
                        </div>
                    </div>
                <?php } ?>
            </div>
            <div class="tab-pane <?= $active == 6 ? 'active' : '' ?>" id="tasks" style="position: relative;">
                <div class="nav-tabs-custom ">
                    <!-- Tabs within a box -->
                    <ul class="nav nav-tabs">
                        <li class="active"><a href="#manageTasks"
                                              data-toggle="tab"><?= lang('all_task') ?></a>
                        </li>
                        <li class=""><a
                                href="<?= base_url() ?>admin/tasks/all_task/bugs/<?= $bug_details->bug_id ?>"><?= lang('new_task') ?></a>
                        </li>
                    </ul>
                    <div class="tab-content bg-white">
                        <!-- ************** general *************-->
                        <div class="tab-pane active" id="manageTasks"
                             style="position: relative;">

                            <div class="box" style="border: none; padding-top: 15px;" data-collapsed="0">
                                <div class="box-body">
                                    <table class="table table-hover" id="">
                                        <thead>
                                        <tr>
                                            <th data-check-all>

                                            </th>
                                            <th class="col-sm-4"><?= lang('task_name') ?></th>
                                            <th class="col-sm-2"><?= lang('due_date') ?></th>
                                            <th class="col-sm-1"><?= lang('status') ?></th>
                                            <th class="col-sm-1"><?= lang('progress') ?></th>
                                            <th class="col-sm-3"><?= lang('changes/view') ?></th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        <?php
                                        if (!empty($all_task_info)):foreach ($all_task_info as $key => $v_task):
                                            ?>
                                            <tr>
                                                <td class="col-sm-1">
                                                    <div class="complete checkbox c-checkbox">
                                                        <label>
                                                            <input type="checkbox" data-id="<?= $v_task->task_id ?>"
                                                                   style="position: absolute;" <?php
                                                            if ($v_task->task_progress >= 100) {
                                                                echo 'checked';
                                                            }
                                                            ?>>
                                                            <span class="fa fa-check"></span>
                                                        </label>
                                                    </div>
                                                </td>
                                                <td>
                                                    <a style="<?php
                                                    if ($v_task->task_progress >= 100) {
                                                        echo 'text-decoration: line-through;';
                                                    }
                                                    ?>"
                                                       href="<?= base_url() ?>admin/tasks/view_task_details/<?= $v_task->task_id ?>"><?php echo $v_task->task_name; ?></a>
                                                </td>
                                                <td><?php
                                                    $due_date = $v_task->due_date;
                                                    $due_time = strtotime($due_date);
                                                    $current_time = time();
                                                    ?>
                                                    <?= strftime(config_item('date_format'), strtotime($due_date)) ?>
                                                    <?php if ($current_time > $due_time && $v_task->task_progress < 100) { ?>
                                                        <span class="label label-danger"><?= lang('overdue') ?></span>
                                                    <?php } ?></td>
                                                <td><?php
                                                    if ($v_task->task_status == 'completed') {
                                                        $label = 'success';
                                                    } elseif ($v_task->task_status == 'not_started') {
                                                        $label = 'info';
                                                    } elseif ($v_task->task_status == 'deferred') {
                                                        $label = 'danger';
                                                    } else {
                                                        $label = 'warning';
                                                    }
                                                    ?>
                                                    <span
                                                        class="label label-<?= $label ?>"><?= lang($v_task->task_status) ?> </span>
                                                </td>
                                                <td>
                                                    <div class="inline ">
                                                        <div class="easypiechart text-success"
                                                             style="margin: 0px;"
                                                             data-percent="<?= $v_task->task_progress ?>"
                                                             data-line-width="5" data-track-Color="#f0f0f0"
                                                             data-bar-color="#<?php
                                                             if ($v_task->task_progress == 100) {
                                                                 echo '8ec165';
                                                             } else {
                                                                 echo 'fb6b5b';
                                                             }
                                                             ?>" data-rotate="270" data-scale-Color="false"
                                                             data-size="50" data-animate="2000">
                                                            <span class="small text-muted"><?= $v_task->task_progress ?>
                                                                %</span>
                                                        </div>
                                                    </div>
                                                </td>
                                                <td>
                                                    <?php echo btn_delete('admin/tasks/delete_task/' . $v_task->task_id) ?>
                                                    <?php echo btn_edit('admin/tasks/all_task/' . $v_task->task_id) ?>
                                                    <?php

                                                    if ($v_task->timer_status == 'on') { ?>
                                                        <a class="btn btn-xs btn-danger"
                                                           href="<?= base_url() ?>admin/tasks/tasks_timer/off/<?= $v_task->task_id ?>"><?= lang('stop_timer') ?> </a>

                                                    <?php } else { ?>
                                                        <a class="btn btn-xs btn-success"
                                                           href="<?= base_url() ?>admin/tasks/tasks_timer/on/<?= $v_task->task_id ?>"><?= lang('start_timer') ?> </a>
                                                    <?php } ?>
                                                </td>
                                            </tr>
                                        <?php endforeach; ?>
                                        <?php endif; ?>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
            <!-- Task Attachment Panel Ends --->
            <div class="tab-pane <?= $active == 4 ? 'active' : '' ?>" id="task_notes" style="position: relative;">
                <div class="panel panel-custom">
                    <div class="panel-heading">
                        <h3 class="panel-title"><?= lang('notes') ?></h3>
                    </div>
                    <div class="panel-body">

                        <form action="<?= base_url() ?>admin/bugs/save_bugs_notes/<?php
                        if (!empty($bug_details)) {
                            echo $bug_details->bug_id;
                        }
                        ?>" enctype="multipart/form-data" method="post" id="form" class="form-horizontal">
                            <div class="form-group">
                                <div class="col-lg-12">
                                        <textarea class="form-control textarea"
                                                  name="notes"><?= $bug_details->notes ?></textarea>
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="col-sm-2">
                                    <button type="submit" id="sbtn"
                                            class="btn btn-primary"><?= lang('updates') ?></button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            <div class="tab-pane <?= $active == 7 ? 'active' : '' ?>" id="activities" style="position: relative;">
                <div class="tab-pane " id="activities">
                    <div class="panel panel-custom">
                        <div class="panel-heading">
                            <h3 class="panel-title"><?= lang('activities') ?>
                                <?php
                                $role = $this->session->userdata('user_type');
                                if ($role == 1) {
                                    ?>
                                    <span class="btn-xs pull-right">
                            <a href="<?= base_url() ?>admin/tasks/claer_activities/bugs/<?= $bug_details->bug_id ?>"><?= lang('clear') . ' ' . lang('activities') ?></a>
                            </span>
                                <?php } ?>
                            </h3>
                        </div>
                        <div class="panel-body " id="chat-box">
                            <div id="activity">
                                <ul class="list-group no-radius   mt-xs list-group-lg no-border">
                                    <?php
                                    if (!empty($activities_info)) {
                                        foreach ($activities_info as $v_activities) {
                                            $profile_info = $this->db->where(array('user_id' => $v_activities->user))->get('tbl_account_details')->row();

                                            $user_info = $this->db->where(array('user_id' => $v_activities->user))->get('tbl_users')->row();
                                            ?>
                                            <li class="list-group-item">
                                                <a class="recect_task pull-left mr-sm">

                                                    <?php if (!empty($profile_info)) {
                                                        ?>
                                                        <img style="width: 30px;margin-left: 18px;
                                                             height: 29px;
                                                             border: 1px solid #aaa;"
                                                             src="<?= base_url() . $profile_info->avatar ?>"
                                                             class="img-circle">
                                                    <?php } ?>
                                                </a>


                                                <a class="clear">
                                                    <small
                                                        class="pull-right"><?= strftime(config_item('date_format') . " %H:%M:%S", strtotime($v_activities->activity_date)) ?></small>
                                                    <strong class="block"><?= ucfirst($user_info->username) ?></strong>
                                                    <small>
                                                        <?php
                                                        echo sprintf(lang($v_activities->activity) . ' <strong style="color:#000"><em>' . $v_activities->value1 . '</em>' . '<em>' . $v_activities->value2 . '</em></strong>');
                                                        ?>
                                                    </small>
                                                </a>
                                            </li>
                                            <?php
                                        }
                                    }
                                    ?>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
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
                    <label for="field-1" class="col-sm-3 control-label"><?= lang('upload_file') ?></label>\n\
        <div class="col-sm-5">\n\
        <div class="fileinput fileinput-new" data-provides="fileinput">\n\
<span class="btn btn-default btn-file"><span class="fileinput-new" >Select file</span><span class="fileinput-exists" >Change</span><input type="file" name="bug_files[]" ></span> <span class="fileinput-filename"></span><a href="#" class="close fileinput-exists" data-dismiss="fileinput" style="float: none;">&times;</a></div></div>\n\<div class="col-sm-2">\n\<strong>\n\
<a href="javascript:void(0);" class="remCF"><i class="fa fa-times"></i>&nbsp;Remove</a></strong></div>');
                maxAppend++;
                $("#add_new").append(add_new);
            }
        });

        $("#add_new").on('click', '.remCF', function () {
            $(this).parent().parent().parent().remove();
        });
    });
</script>    