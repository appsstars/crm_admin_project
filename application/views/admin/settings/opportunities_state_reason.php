<?= message_box('success'); ?>
<?= message_box('error'); ?>
<div class="panel panel-custom">
    <header class="panel-heading "><?= lang('opportunities_state_reason') ?></header>
    <div class="panel-body">
        <div class="table-responsive">
            <table class="table table-striped DataTables ">
                <thead>
                <tr>
                    <th class="col-sm-3"><?= lang('opportunities_state') ?></th>
                    <th><?= lang('reason') ?></th>
                    <th class="col-sm-1"><?= lang('action') ?></th>
                </tr>
                </thead>
                <tbody>
                <?php
                $all_opportunities_state_reason = $this->db->get('tbl_opportunities_state_reason')->result();
                if (!empty($all_opportunities_state_reason)) {
                    foreach ($all_opportunities_state_reason as $opportunities_state) {
                        ?>
                        <tr>
                            <td>
                                <?php
                                $id = $this->uri->segment(4);
                                if (!empty($id) && $id == $opportunities_state->opportunities_state_reason_id) { ?>
                                <form method="post"
                                      action="<?= base_url() ?>admin/settings/update_state_reason/<?= $opportunities_state->opportunities_state_reason_id ?>">
                                    <select name="opportunities_state" class="form-control">
                                    <option value="open" <?= $state_info->opportunities_state == 'open' ? 'selected' : '' ?>><?= lang('open') ?></option>
                                    <option value="won" <?= $state_info->opportunities_state == 'won' ? 'selected' : '' ?>><?= lang('won') ?></option>
                                    <option value="abandoned" <?= $state_info->opportunities_state == 'abandoned' ? 'selected' : '' ?>><?= lang('abandoned') ?></option>
                                    <option value="suspended" <?= $state_info->opportunities_state == 'suspended' ? 'selected' : '' ?>><?= lang('suspended') ?></option>
                                    <option value="lost" <?= $state_info->opportunities_state == 'lost' ? 'selected' : '' ?>><?= lang('lost') ?></option>
                                    </select>
                                <?php } else {
                                    echo lang($opportunities_state->opportunities_state);
                                }
                                ?></td>
                            <td>
                                <?php
                                $id = $this->uri->segment(4);
                                if (!empty($id) && $id == $opportunities_state->opportunities_state_reason_id) { ?>
                                    <input
                                        name="opportunities_state_reason"
                                        value="<?= $state_info->opportunities_state_reason ?>"
                                        class="form-control"/>
                                <?php } else {
                                    echo $opportunities_state->opportunities_state_reason;
                                }
                                ?>

                            </td>
                            <td>
                                <?php
                                $id = $this->uri->segment(4);
                                if (!empty($id) && $id == $opportunities_state->opportunities_state_reason_id) { ?>
                                    <?= btn_update() ?>
                                    </form>
                                    <?= btn_cancel('admin/settings/opportunities_state_reason/') ?>
                                <?php } else { ?>
                                    <?= btn_edit('admin/settings/opportunities_state_reason/' . $opportunities_state->opportunities_state_reason_id) ?>
                                    <?= btn_delete('admin/settings/delete_state_reason/' . $opportunities_state->opportunities_state_reason_id) ?>
                                <?php }
                                ?>
                            </td>
                        </tr>
                        <?php
                    }
                }
                ?>
                <form method="post"
                      action="<?= base_url() ?>admin/settings/update_state_reason">
                    <tr>
                        <td><select name="opportunities_state" class="form-control">
                                <option value="open"><?= lang('open') ?></option>
                                <option value="won"><?= lang('won') ?></option>
                                <option value="abandoned"><?= lang('abandoned') ?></option>
                                <option value="suspended"><?= lang('suspended') ?></option>
                                <option value="lost"><?= lang('lost') ?></option>
                            </select></td>
                        <td>
                            <input name="opportunities_state_reason" class="form-control"/>
                        </td>
                        <td>
                            <?= btn_add() ?>
                        </td>
                    </tr>
                </form>
                </tbody>
            </table>
        </div>
    </div>
</div>
