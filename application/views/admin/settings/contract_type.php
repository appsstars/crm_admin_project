<?= message_box('success'); ?>
<?= message_box('error'); ?>
<div class="panel panel-custom">
    <header class="panel-heading "><?= lang('contract_type') ?></header>
    <div class="panel-body">
        <div class="table-responsive">
            <table class="table table-striped ">
                <thead>
                <tr>

                    <th><?= lang('contract_type') ?></th>
                    <th><?= lang('description') ?></th>
                    <th><?= lang('action') ?></th>
                </tr>
                </thead>
                <tbody>
                <?php
                if (!empty($all_contract_type)) {
                    foreach ($all_contract_type as $contract_type) {
                        ?>
                        <tr>
                            <td><?php
                                $id = $this->uri->segment(5);
                                if (!empty($id) && $id == $contract_type->contract_type_id) { ?>
                                <form method="post"
                                      action="<?= base_url() ?>admin/settings/contract_type/update_contract_type/<?php
                                      if (!empty($contract_type_info)) {
                                          echo $contract_type_info->contract_type_id;
                                      }
                                      ?>" class="form-horizontal">
                                    <input type="text" name="contract_type" value="<?php
                                    if (!empty($contract_type_info)) {
                                        echo $contract_type_info->contract_type;
                                    }
                                    ?>" class="form-control" placeholder="<?= lang('contract_type') ?>" required>
                                <?php } else {
                                    echo $contract_type->contract_type;
                                }
                                ?></td>
                            <td><?php
                                $id = $this->uri->segment(5);
                                if (!empty($id) && $id == $contract_type->contract_type_id) { ?>
                                    <textarea name="description" rows="1" class="form-control"><?php
                                        if (!empty($contract_type_info)) {
                                            echo $contract_type_info->description;
                                        }
                                        ?></textarea>
                                <?php } else {
                                    echo $contract_type->description;
                                }
                                ?></td>
                            <td>
                                <?php
                                $id = $this->uri->segment(5);
                                if (!empty($id) && $id == $contract_type->contract_type_id) { ?>
                                    <?= btn_update() ?>
                                    </form>
                                    <?= btn_cancel('admin/settings/contract_type/') ?>
                                <?php } else { ?>
                                    <?= btn_edit('admin/settings/contract_type/edit_contract_type/' . $contract_type->contract_type_id) ?>
                                    <?= btn_delete('admin/settings/delete_contract_type/' . $contract_type->contract_type_id) ?>
                                <?php }
                                ?>
                            </td>
                        </tr>
                        <?php
                    }
                }
                ?>
                <form method="post" action="<?= base_url() ?>admin/settings/contract_type/update_contract_type" class="form-horizontal">
                    <tr>
                        <td><input type="text" name="contract_type" class="form-control" placeholder="<?= lang('contract_type') ?>" required></td>
                        <td>
                            <textarea name="description" rows="1" class="form-control"></textarea>
                        </td>
                        <td><?= btn_add() ?></td>
                    </tr>
                </form>
                </tbody>
            </table>
        </div>
    </div>
</div>