<?= message_box('success') ?>
<?= message_box('error') ?>

<div class="row mb">
    <div class="col-sm-12 mb">
        <div class="pull-left">
            <?= lang('copy_unique_url') ?>
        </div>
        <div class="col-sm-10">
            <input style="width: 100%"
                   value="<?= base_url() ?>frontend/view_invoice/<?= $this->encryption->encrypt($invoice_info->invoices_id) ?>"
                   type="text" id="foo"/>
        </div>
    </div>
    <script type="text/javascript">
        var textBox = document.getElementById("foo");
        textBox.onfocus = function () {
            textBox.select();

            // Work around Chrome's little problem
            textBox.onmouseup = function () {
                // Prevent further mouseup intervention
                textBox.onmouseup = null;
                return false;
            };
        };
    </script>
    <div class="col-sm-10">

        <?php
        $payment_status = $this->invoice_model->get_payment_status($invoice_info->invoices_id);

        $where = array('user_id' => $this->session->userdata('user_id'), 'module_id' => $invoice_info->invoices_id, 'module_name' => 'invoice');
        $check_existing = $this->invoice_model->check_by($where, 'tbl_pinaction');
        if (!empty($check_existing)) {
            $url = 'remove_todo/' . $check_existing->pinaction_id;
            $btn = 'danger';
            $title = lang('remove_todo');
        } else {
            $url = 'add_todo_list/invoice/' . $invoice_info->invoices_id;
            $btn = 'warning';
            $title = lang('add_todo_list');
        }

        $client_info = $this->invoice_model->check_by(array('client_id' => $invoice_info->client_id), 'tbl_client');
        $currency = $this->invoice_model->client_currency_sambol($invoice_info->client_id);
        $client_lang = $client_info->language;
        unset($this->lang->is_loaded[5]);
        $language_info = $this->lang->load('sales_lang', $client_lang, TRUE, FALSE, '', TRUE);
        ?>

        <?php $can_edit = $this->invoice_model->can_action('tbl_invoices', 'edit', array('invoices_id' => $invoice_info->invoices_id));
        if (!empty($can_edit)) { ?>
            <span data-toggle="tooltip" data-placement="top" title="<?= lang('from_items') ?>">
            <a data-toggle="modal" data-target="#myModal"
               href="<?= base_url() ?>admin/invoice/insert_items/<?= $invoice_info->invoices_id ?>"
               title="<?= lang('item_quick_add') ?>" class="btn btn-sm btn-primary">
                <i class="fa fa-list-alt text-white"></i> <?= lang('from_items') ?></a>
                </span>
        <?php }
        ?>
        <?php $can_edit = $this->invoice_model->can_action('tbl_invoices', 'edit', array('invoices_id' => $invoice_info->invoices_id));
        if (!empty($can_edit)) { ?>
            <?php if ($invoice_info->show_client == 'Yes') { ?>
            <a class="btn btn-sm btn-success" data-toggle="tooltip" data-placement="top"
               href="<?= base_url() ?>admin/invoice/change_status/hide/<?= $invoice_info->invoices_id ?>"
               title="<?= lang('hide_to_client') ?>"><i class="fa fa-eye-slash"></i> <?= lang('hide_to_client') ?>
                </a><?php } else { ?>
            <a class="btn btn-sm btn-warning" data-toggle="tooltip" data-placement="top"
               href="<?= base_url() ?>admin/invoice/change_status/show/<?= $invoice_info->invoices_id ?>"
               title="<?= lang('show_to_client') ?>"><i class="fa fa-eye"></i> <?= lang('show_to_client') ?>
                </a><?php }
        } ?>

        <?php $can_edit = $this->invoice_model->can_action('tbl_invoices', 'edit', array('invoices_id' => $invoice_info->invoices_id));
        if (!empty($can_edit)) { ?>
            <?php if ($this->invoice_model->get_invoice_cost($invoice_info->invoices_id) > 0) { ?>
                <a class="btn btn-sm btn-danger" data-toggle="tooltip" data-placement="top"
                   href="<?= base_url() ?>admin/invoice/manage_invoice/payment/<?= $invoice_info->invoices_id ?>"
                   title="<?= lang('add_payment') ?>"><i class="fa fa-credit-card"></i> <?= lang('pay_invoice') ?>
                </a>
                <?php
            }
        }
        ?>
        <?php $can_edit = $this->invoice_model->can_action('tbl_invoices', 'edit', array('invoices_id' => $invoice_info->invoices_id));
        if (!empty($can_edit)) { ?>
            <span data-toggle="tooltip" data-placement="top" title="<?= lang('clone') . ' ' . lang('invoice') ?>">
            <a data-toggle="modal" data-target="#myModal"
               href="<?= base_url() ?>admin/invoice/clone_invoice/<?= $invoice_info->invoices_id ?>"
               class="btn btn-sm btn-purple">
                <i class="fa fa-copy"></i> <?= lang('clone') ?></a>
            </span>
            <?php
        }
        ?>


        <div class="btn-group">
            <button class="btn btn-sm btn-default dropdown-toggle" data-toggle="dropdown">
                <?= lang('more_actions') ?>
                <span class="caret"></span></button>
            <ul class="dropdown-menu animated zoomIn">
                <?php if ($this->invoice_model->get_invoice_cost($invoice_info->invoices_id) > 0) { ?>
                    <li>
                        <a href="<?= base_url() ?>admin/invoice/manage_invoice/email_invoice/<?= $invoice_info->invoices_id ?>"
                           title="<?= lang('email_invoice') ?>"><?= lang('email_invoice') ?></a>
                    </li>

                    <li>
                        <a href="<?= base_url() ?>admin/invoice/manage_invoice/send_reminder/<?= $invoice_info->invoices_id ?>"
                           title="<?= lang('send_reminder') ?>"><?= lang('send_reminder') ?></a>
                    </li>
                    <?php if (strtotime($invoice_info->due_date) < time() AND $payment_status != lang('fully_paid')) { ?>
                        <li>
                            <a href="<?= base_url() ?>admin/invoice/manage_invoice/send_overdue/<?= $invoice_info->invoices_id ?>"
                               title="<?= lang('send_invoice_overdue') ?>"><?= lang('send_invoice_overdue') ?></a>
                        </li>
                    <?php } ?>
                    <?php if ($invoice_info->emailed != 'Yes') { ?>
                        <li>
                            <a href="<?= base_url() ?>admin/invoice/change_invoice_status/mark_as_sent/<?= $invoice_info->invoices_id ?>"
                               title="<?= lang('mark_as_sent') ?>"><?= lang('mark_as_sent') ?></a>
                        </li>
                    <?php } ?>
                    <?php if ($invoice_info->status != 'Cancelled') { ?>
                        <li>
                            <a href="<?= base_url() ?>admin/invoice/change_invoice_status/mark_as_cancelled/<?= $invoice_info->invoices_id ?>"
                               title="<?= lang('mark_as_cancelled') ?>"><?= lang('mark_as_cancelled') ?></a>
                        </li>
                    <?php } ?>
                    <?php if ($invoice_info->status == 'Cancelled') { ?>
                        <li>
                            <a href="<?= base_url() ?>admin/invoice/change_invoice_status/unmark_as_cancelled/<?= $invoice_info->invoices_id ?>"
                               title="<?= lang('unmark_as_cancelled') ?>"><?= lang('unmark_as_cancelled') ?></a>
                        </li>
                    <?php } ?>
                    <li>
                        <a href="<?= base_url() ?>admin/invoice/manage_invoice/invoice_history/<?= $invoice_info->invoices_id ?>"><?= lang('invoice_history') ?></a>
                    </li>
                <?php } ?>

                <li class="divider"></li>
                <?php $can_edit = $this->invoice_model->can_action('tbl_invoices', 'edit', array('invoices_id' => $invoice_info->invoices_id));
                if (!empty($can_edit)) { ?>
                    <li>
                        <a href="<?= base_url() ?>admin/invoice/manage_invoice/create_invoice/<?= $invoice_info->invoices_id ?>"><?= lang('edit_invoice') ?></a>
                    </li>
                <?php } ?>
                <?php $can_delete = $this->invoice_model->can_action('tbl_invoices', 'delete', array('invoices_id' => $invoice_info->invoices_id));
                if (!empty($can_delete)) { ?>
                    <li>
                        <a href="<?= base_url() ?>admin/invoice/delete/delete_invoice/<?= $invoice_info->invoices_id ?>"><?= lang('delete_invoice') ?></a>
                    </li>
                <?php } ?>
            </ul>
        </div>

        <?php $can_edit = $this->invoice_model->can_action('tbl_invoices', 'edit', array('invoices_id' => $invoice_info->invoices_id));
        if (!empty($can_edit)) { ?>
            <?php if ($invoice_info->recurring == 'Yes') { ?>
                <a onclick="return confirm('<?= lang('stop_recurring_alert') ?>')" class="btn btn-sm btn-warning"
                   href="<?= base_url() ?>admin/invoice/stop_recurring/<?= $invoice_info->invoices_id ?>"
                   title="<?= lang('stop_recurring') ?>"><i class="fa fa-retweet"></i> <?= lang('stop_recurring') ?>
                </a>
            <?php }
        } ?>
        <?php
        if (!empty($invoice_info->project_id)) {
            $project_info = $this->db->where('project_id', $invoice_info->project_id)->get('tbl_project')->row();
            ?>
            <strong><?= lang('project') ?>:</strong>
            <a
                href="<?= base_url() ?>admin/projects/project_details/<?= $invoice_info->project_id ?>"
                class="">
                <?= $project_info->project_name ?>
            </a>
        <?php } ?>
    </div>
    <div class="col-sm-2 pull-right">

        <a
            href="<?= base_url() ?>admin/invoice/invoice_email/<?= $invoice_info->invoices_id ?>"
            data-toggle="tooltip" data-placement="top" title="<?= lang('send_email') ?>"
            class="btn btn-xs btn-primary pull-right">
            <i class="fa fa-envelope-o"></i>
        </a>
        <a onclick="print_invoice('print_invoice')" href="#" data-toggle="tooltip" data-placement="top" title=""
           data-original-title="Print" class="mr-sm btn btn-xs btn-danger pull-right">
            <i class="fa fa-print"></i>
        </a>
        <a style="margin-right: 5px"
           href="<?= base_url() ?>admin/invoice/manage_invoice/pdf_invoice/<?= $invoice_info->invoices_id ?>"
           data-toggle="tooltip" data-placement="top" title="" data-original-title="PDF"
           class="btn btn-xs btn-success pull-right">
            <i class="fa fa-file-pdf-o"></i>
        </a>
        <a data-toggle="tooltip" data-placement="top" title="<?= $title ?>"
           href="<?= base_url() ?>admin/projects/<?= $url ?>"
           class="mr-sm btn pull-right  btn-xs  btn-<?= $btn ?>"><i class="fa fa-thumb-tack"></i></a>
    </div>
</div>
<?php if (strtotime($invoice_info->due_date) < time() AND $payment_status != lang('fully_paid')) { ?>
    <div class="alert bg-danger-light hidden-print">
        <button type="button" class="close" data-dismiss="alert">×</button>
        <i class="fa fa-warning"></i>
        <?= lang('invoice_overdue') ?>
    </div>
    <?php
}
?>

<div class="panel" id="print_invoice">
    <div class="show_print ">
        <div class="col-xs-12">
            <h4 class="page-header">
                <img style="width: 60px;width: 60px;margin-top: -10px;margin-right: 10px;"
                     src="<?= base_url() . config_item('invoice_logo') ?>"><?= config_item('company_name') ?>
            </h4>
        </div><!-- /.col -->
    </div>
    <div class="panel-body">
        <?php $can_edit = $this->invoice_model->can_action('tbl_invoices', 'edit', array('invoices_id' => $invoice_info->invoices_id));
        if (!empty($can_edit)) { ?>
            <a href="<?= base_url() ?>admin/invoice/manage_invoice/create_invoice/<?= $invoice_info->invoices_id ?>"
               class="pull-right btn btn-primary btn-sm"><?= $language_info['edit_invoice'] ?></a>
        <?php } ?>
        <h3 class="mt0"><?= $invoice_info->reference_no ?></h3>
        <hr>
        <div class="row mb-lg">
            <div class="col-lg-4 col-xs-6 br pv">
                <div class="row">
                    <div class="col-md-2 text-center visible-md visible-lg">
                        <em class="fa fa-truck fa-4x text-muted"></em>
                    </div>
                    <div class="col-md-10">
                        <h4 class="ml-sm"><?= (config_item('company_legal_name_' . $client_lang) ? config_item('company_legal_name_' . $client_lang) : config_item('company_legal_name')) ?></h4>
                        <address></address><?= (config_item('company_address_' . $client_lang) ? config_item('company_address_' . $client_lang) : config_item('company_address')) ?>
                        <br><?= (config_item('company_city_' . $client_lang) ? config_item('company_city_' . $client_lang) : config_item('company_city')) ?>
                        , <?= config_item('company_zip_code') ?>
                        <br><?= (config_item('company_country_' . $client_lang) ? config_item('company_country_' . $client_lang) : config_item('company_country')) ?>
                        <br/><?= $language_info['phone'] ?> : <?= config_item('company_phone') ?>
                    </div>
                </div>
            </div>
            <div class="col-lg-4 col-xs-6 br pv">
                <div class="row">
                    <div class="col-md-2 text-center visible-md visible-lg">
                        <em class="fa fa-plane fa-4x text-muted"></em>
                    </div>

                    <?php
                    if ($client_info->client_status == 1) {
                        $status = lang('person');
                    } else {
                        $status = lang('company');
                    }
                    ?>

                    <div class="col-md-10">
                        <h4><?= $client_info->name . ' ' . $status . ' ' ?></h4>
                        <address></address><?= $client_info->address ?>
                        <br> <?= $client_info->city ?>, <?= $client_info->zipcode ?>
                        <br><?= $client_info->country ?>
                        <br><?= $language_info['phone'] ?>: <?= $client_info->phone ?></div>
                </div>
            </div>
            <div class="clearfix hidden-md hidden-lg">
                <hr>
            </div>
            <div class="col-lg-4 col-xs-12 pv">
                <div class="clearfix">
                    <p class="pull-left"><?= lang('invoice') . ' ' . lang('no') ?>.</p>
                    <p class="pull-right mr"><?= $invoice_info->reference_no ?></p>
                </div>
                <div class="clearfix">
                    <p class="pull-left"><?= $language_info['invoice_date'] ?></p>
                    <p class="pull-right mr"><?= strftime(config_item('date_format'), strtotime($invoice_info->date_saved)); ?></p>
                </div>
                <div class="clearfix">
                    <p class="pull-left"><?= $language_info['payment_due'] ?></p>
                    <p class="pull-right mr"><?= strftime(config_item('date_format'), strtotime($invoice_info->due_date)); ?></p>
                </div>
                <div class="clearfix">
                    <?php
                    if ($payment_status == lang('fully_paid')) {
                        $label = "success";
                    } elseif ($payment_status == lang('draft')) {
                        $label = "default";
                        $text = lang('status_as_draft');
                    } elseif ($payment_status == lang('cancelled')) {
                        $label = "danger";
                    } elseif ($payment_status == lang('partially_paid')) {
                        $label = "warning";
                    } elseif ($invoice_info->emailed == 'Yes') {
                        $label = "info";
                    } else {
                        $label = "danger";
                    }
                    ?>
                    <p class="pull-left"><?= $language_info['payment_status'] ?></p>
                    <p class="pull-right mr"><span class="label label-<?= $label ?>"><?= $payment_status ?></span></p>
                </div>
                <div class="clearfix">
                    <?php if (!empty($text)) { ?>
                        <p style="padding: 15px;margin-bottom: 20px;border: 1px solid transparent;border-radius: 4px;;background: color: #8a6d3b;background-color: #fcf8e3;border-color: #faebcc;"><?= $text ?></p>
                    <?php } ?>
                </div>
                <?php $show_custom_fields = custom_form_label(9, $invoice_info->invoices_id);

                if (!empty($show_custom_fields)) {
                    foreach ($show_custom_fields as $c_label => $v_fields) {
                        if (!empty($v_fields)) {
                            ?>
                            <div class="clearfix">
                                <p class="pull-left"><?= $c_label ?></p>
                                <p class="pull-right mr"><?= $v_fields ?></p>

                            </div>
                        <?php }
                    }
                }
                ?>
            </div>
        </div>
        <div class="table-responsive table-bordered mb-lg">
            <form method="post" data-parsley-validate="" novalidate=""
                  action="<?= base_url() ?>admin/invoice/add_item/<?php
                  if (!empty($item_info)) {
                      echo $item_info->items_id;
                  }
                  ?>">
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
                    $invoice_items = $this->invoice_model->ordered_items_by_id($invoice_info->invoices_id);
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
                                <td><?= display_money($v_item->total_cost) ?></td>
                                <td class="hidden-print">
                                    <?php $can_edit = $this->invoice_model->can_action('tbl_invoices', 'edit', array('invoices_id' => $invoice_info->invoices_id));
                                    if (!empty($can_edit)) { ?>
                                        <?= btn_edit('admin/invoice/manage_invoice/invoice_details/' . $v_item->invoices_id . '/' . $v_item->items_id) ?>
                                        <?= btn_delete('admin/invoice/delete/delete_item/' . $v_item->invoices_id . '/' . $v_item->items_id) ?>
                                    <?php }
                                    ?></td>
                            </tr>
                            <tr class="hidden">
                                <input type="hidden" name="invoices_id"
                                       value="<?= (!empty($invoice_info->invoices_id)) ? $invoice_info->invoices_id : null ?>">
                                <input type="hidden" name="item_order"
                                       value="<?= count($invoice_items) + 1 ?>">
                                <td>
                                        <textarea name="item_name[]" placeholder="Item Name"
                                                  class="form-control"></textarea>
                                </td>
                                <td><textarea rows="1" name="item_desc[]" placeholder="Item Description"
                                              class="form-control"></textarea></td>
                                <td><input type="number" step="any" min="0" name="quantity[]"
                                           value="<?php
                                           echo '1';
                                           ?>" placeholder="1"
                                           class="p_qty form-control"></td>
                                <td><input type="number" step="0.50" min="0" name="unit_cost[]"
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

                                <?php $single_total = $v_item->unit_cost * 1; ?>
                                <td><span class="linetotal"><?php echo $v_item->unit_cost * 1; ?></span></td>

                                <td class="hidden-print">
                                    <a href="javascript:void(0);" class="remCF btn btn-danger btn-xs"><i
                                            class="fa fa-trash-o"></i></a>
                                </td>
                            </tr>

                        <?php endforeach; ?>
                    <?php endif ?>
                    <?php $can_edit = $this->invoice_model->can_action('tbl_invoices', 'edit', array('invoices_id' => $invoice_info->invoices_id));
                    if (!empty($can_edit)) { ?>
                        <?php if ($invoice_info->status != 'Paid') { ?>

                            <tr class="hidden-print">
                                <input type="hidden" name="invoices_id"
                                       value="<?= (!empty($invoice_info->invoices_id)) ? $invoice_info->invoices_id : null ?>">
                                <input type="hidden" name="item_order" value="<?= count($invoice_items) + 1 ?>">

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
                                <td><input type="number" step="any" min="0" name="quantity[]" value="<?php
                                    if (!empty($item_info)) {
                                        echo $item_info->quantity;
                                    }
                                    ?>" placeholder="1" class="form-control"></td>

                                <td><input type="number" step="0.50" min="0" name="unit_cost[]"
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
                        <?php } ?>
                    <?php } ?>
                    <div class="hidden-print pull-right mt mb">
                        <td colspan="8" style="text-align: right;">
                            <button type="submit" class="btn btn-primary"><?= lang('save') ?></button>
                        </td>
                    </div>
                    </tbody>
                </table>
            </form>
        </div>
        <div class="row">
            <div class="col-xs-8">
                <p class="well well-sm mt">
                    <?= $invoice_info->notes ?>
                </p>
            </div>
            <div class="col-sm-4 pv">
                <div class="clearfix">
                    <p class="pull-left"><?= $language_info['sub_total'] ?></p>
                    <p class="pull-right mr">
                        <?= display_money($this->invoice_model->calculate_to('invoice_cost', $invoice_info->invoices_id), $currency->symbol); ?>
                    </p>
                </div>
                <?php if ($invoice_info->tax > 0.00): ?>
                    <div class="clearfix">
                        <p class="pull-left"><?= $language_info['tax'] ?> (<?php echo $invoice_info->tax; ?> %)</p>
                        <p class="pull-right mr">
                            <?= display_money($this->invoice_model->calculate_to('tax', $invoice_info->invoices_id), $currency->symbol); ?>
                        </p>
                    </div>
                <?php endif ?>

                <?php if ($invoice_info->discount > 0): ?>
                    <div class="clearfix">
                        <p class="pull-left"><?= $language_info['discount'] ?> (<?php echo $invoice_info->discount; ?>
                            %)</p>
                        <p class="pull-right mr">
                            <?= display_money($this->invoice_model->calculate_to('discount', $invoice_info->invoices_id), $currency->symbol); ?>
                        </p>
                    </div>
                <?php endif ?>

                <?php
                $paid_amount = $this->invoice_model->calculate_to('paid_amount', $invoice_info->invoices_id);
                if ($paid_amount > 0) {
                    $total = $language_info['total_due'];
                } else {
                    $total = $language_info['total'];
                }
                if ($paid_amount > 0) {
                    ?>
                    <div class="clearfix">
                        <p class="pull-left"><?= $language_info['paid_amount'] ?> </p>
                        <p class="pull-right mr">
                            <?= display_money($paid_amount, $currency->symbol); ?>
                        </p>
                    </div>
                <?php } ?>
                <div class="clearfix">
                    <p class="pull-left h3"><?= $total ?></p>
                    <p class="pull-right mr h3"><?= display_money($this->invoice_model->calculate_to('invoice_due', $invoice_info->invoices_id), $currency->symbol); ?></p>
                </div>
            </div>
        </div>
    </div>
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
        var default_tax = ((tax / 100) * sub_total).toFixed(2);
        var discount = $(".table").find('input[name^="discount"]').val();
        var total_discount = ((discount / 100) * sub_total).toFixed(2);
        var grand_total = parseFloat(sub_total) + parseFloat(default_tax) - parseFloat(total_discount);
        $("#default_tax").text(default_tax);
        $("#discount").text(total_discount);
        $("#sub_total").text(sub_total.toFixed(2));
        $("#grand_total").text(grand_total.toFixed(2));

    }
</script>
<script type="text/javascript">

    function print_invoice(print_invoice) {
        var printContents = document.getElementById(print_invoice).innerHTML;
        var originalContents = document.body.innerHTML;
        document.body.innerHTML = printContents;
        window.print();
        document.body.innerHTML = originalContents;
    }
</script>

<script type="text/javascript">
    $(document).ready(function () {
        var maxAppend = 0;
        $("#add_more").click(function () {

            var add_new = $('<tr style="">\n\
                    <td><textarea rows="1" name="item_name[]" required placeholder="Item name" class="form-control"></textarea></td>">\n\
                    <td><textarea rows="1" name="item_desc[]" placeholder="Item Description" class="form-control"></textarea></td>\n\
                        <td class="col-sm-1"><input type="number" step="any" min="0" name="quantity[]" placeholder="1" required class="form-control"></td>\n\
                        <td class="col-sm-1"><input type="number" step="0.50" min="0" name="unit_cost[]" required placeholder="100" class="form-control"></td>\n\
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