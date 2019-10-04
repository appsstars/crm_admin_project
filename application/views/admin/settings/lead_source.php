<?= message_box('success'); ?>
<?= message_box('error'); ?>
<div class="panel panel-custom">
    <header class="panel-heading "><?= lang('lead_source') ?></header>
    <div class="panel-body">
        <div class="table-responsive">
            <table class="table table-striped ">
                <thead>
                <tr>

                    <th><?= lang('lead_source') ?></th>
                    <th><?= lang('action') ?></th>
                </tr>
                </thead>
                <tbody>
                <?php
                if (!empty($all_lead_source)) {
                    foreach ($all_lead_source as $lead_source) {
                        ?>
                        <tr>
                            <td>
                                <?php
                                $id = $this->uri->segment(5);
                                if (!empty($id) && $id == $lead_source->lead_source_id) { ?>
                                    <form method="post"
                                          action="<?= base_url() ?>admin/settings/lead_source/update_lead_source/<?php
                                          if (!empty($lead_source_info)) {
                                              echo $lead_source_info->lead_source_id;
                                          }
                                          ?>" class="form-horizontal">
                                        <input type="text" name="lead_source" value="<?php
                                        if (!empty($lead_source_info)) {
                                            echo $lead_source_info->lead_source;
                                        }
                                        ?>" class="form-control" placeholder="<?= lang('lead_source') ?>" required>

                                <?php } else {
                                    echo $lead_source->lead_source;
                                }
                                ?></td>
                            <td>
                                <?php
                                $id = $this->uri->segment(5);
                                if (!empty($id) && $id == $lead_source->lead_source_id) { ?>
                                    <?= btn_update() ?>
                                    </form>
                                    <?= btn_cancel('admin/settings/lead_source/') ?>
                                <?php } else { ?>
                                    <?= btn_edit('admin/settings/lead_source/edit_lead_source/' . $lead_source->lead_source_id) ?>
                                    <?= btn_delete('admin/settings/delete_lead_source/' . $lead_source->lead_source_id) ?>
                                <?php }
                                ?>

                            </td>
                        </tr>
                        <?php
                    }
                }
                ?>
                <form method="post" action="<?= base_url() ?>admin/settings/lead_source/update_lead_source"
                      class="form-horizontal">
                    <tr>
                        <td><input type="text" name="lead_source" value="" class="form-control"
                                   placeholder="<?= lang('lead_source') ?>" required></td>
                        <td>
                            <button type="submit" class="btn btn-sm btn-primary"></i> <?= lang('add') ?></button>
                        </td>
                    </tr>
                </form>
                </tbody>
            </table>
        </div>
    </div>
</div>
