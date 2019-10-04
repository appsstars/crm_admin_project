<?= message_box('success'); ?>
<?= message_box('error'); ?>
<div class="panel panel-custom">
    <header class="panel-heading "><?= lang('lead_status') ?></header>
    <div class="panel-body">
        <div class="table-responsive">
            <table class="table table-striped ">
                <thead>
                <tr>

                    <th><?= lang('lead_status') ?></th>
                    <th><?= lang('lead_type') ?></th>
                    <th><?= lang('action') ?></th>
                </tr>
                </thead>
                <tbody>
                <?php
                if (!empty($all_lead_status)) {
                    foreach ($all_lead_status as $lead_status) {
                        ?>
                        <tr>
                            <td>
                                <?php
                                $id = $this->uri->segment(5);
                                if (!empty($id) && $id == $lead_status->lead_status_id) { ?>
                                <form method="post"
                                      action="<?= base_url() ?>admin/settings/lead_status/update_lead_status/<?php
                                      if (!empty($lead_status_info)) {
                                          echo $lead_status_info->lead_status_id;
                                      }
                                      ?>" class="form-horizontal">
                                    <input type="text" name="lead_status" value="<?php
                                    if (!empty($lead_status_info)) {
                                        echo $lead_status_info->lead_status;
                                    }
                                    ?>" class="form-control" placeholder="<?= lang('lead_status') ?>" required>
                                    <?php } else {
                                        echo $lead_status->lead_status;
                                    } ?>
                            </td>
                            <td>
                                <?php
                                $id = $this->uri->segment(5);
                                if (!empty($id) && $id == $lead_status->lead_status_id) { ?>
                                    <select name="lead_type" class="form-control">
                                        <option
                                            value="close" <?= !empty($lead_status_info) && $lead_status_info->lead_type == 'close' ? 'selected' : '' ?>><?= lang('close') ?></option>
                                        <option
                                            value="open" <?= !empty($lead_status_info) && $lead_status_info->lead_type == 'open' ? 'selected' : '' ?>><?= lang('open') ?></option>
                                    </select>
                                <?php } else {
                                    echo lang($lead_status->lead_type);
                                } ?>
                            </td>
                            <td>
                                <?php
                                $id = $this->uri->segment(5);
                                if (!empty($id) && $id == $lead_status->lead_status_id) { ?>
                                    <?= btn_update() ?>
                                    </form>
                                    <?= btn_cancel('admin/settings/lead_status/') ?>
                                <?php } else { ?>
                                    <?= btn_edit('admin/settings/lead_status/edit_lead_status/' . $lead_status->lead_status_id) ?>
                                    <?= btn_delete('admin/settings/delete_lead_status/' . $lead_status->lead_status_id) ?>
                                <?php }
                                ?>
                            </td>
                        </tr>
                        <?php
                    }
                }
                ?>
                <form method="post" action="<?= base_url() ?>admin/settings/lead_status/update_lead_status"
                      class="form-horizontal">
                    <tr>
                        <td><input type="text" name="lead_status" class="form-control"
                                   placeholder="<?= lang('lead_status') ?>" required></td>
                        <td>
                            <select name="lead_type" class="form-control">
                                <option
                                    value="close"><?= lang('close') ?></option>
                                <option
                                    value="open"><?= lang('open') ?></option>
                            </select>
                        </td>
                        <td>
                            <button type="submit" class="btn btn-sm btn-info"><?= lang('add') ?></button>
                        </td>
                    </tr>
                </form>
                </tbody>
            </table>
        </div>
    </div>
</div>