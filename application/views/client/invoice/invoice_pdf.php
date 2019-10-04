<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <title><?= lang('estimate') ?></title>
    <style type="text/css">
        @font-face {
            font-family: "Source Sans Pro", sans-serif;
        }

        .clearfix:after {
            content: "";
            display: table;
            clear: both;
        }

        a {
            color: #0087C3;
            text-decoration: none;
        }

        body {
            color: #555555;
            background: #FFFFFF;
            font-size: 14px;
            font-family: "Source Sans Pro", sans-serif;
        }

        header {

            padding: 10px 0;
            margin-bottom: 20px;
            border-bottom: 1px solid #AAAAAA;
        }

        #logo {
            float: left;
        }

        #company {
            float: right;
            text-align: right;
        }

        #details {
            margin-bottom: 50px;
        }

        #client {
            padding-left: 6px;
            border-left: 6px solid #0087C3;
            float: left;
        }

        #client .to {
            color: #777777;
        }

        h2.name {
            font-size: 1em;
            font-weight: normal;
            margin: 0;
        }

        #invoice {
            float: right;
            text-align: right;
        }

        #invoice h1 {
            color: #0087C3;
            font-size: 1.5em;
            line-height: 1em;
            font-weight: normal;
        }

        #invoice .date {
            font-size: 1.1em;
            color: #777777;
        }

        table {
            width: 100%;
            border-spacing: 0;
        }

        table.items {
            width: 100%;
            border-collapse: collapse;
            border-spacing: 0;
            margin-bottom: 10px;
        }

        table.items th,
        table.items td {
            padding: 8px;
            background: #EEEEEE;
            text-align: center;
            border-bottom: 1px solid #FFFFFF;
        }

        table.items th {
            white-space: nowrap;
            font-weight: normal;
        }

        table.items td {
            text-align: right;
        }

        table.items td h3 {
            color: #57B223;
            font-size: 1em;
            font-weight: normal;
            margin-top: 5px;
            margin-bottom: 5px;
        }

        table.items .no {
            background: #DDDDDD;
        }

        table.items .desc {
            text-align: left;
        }

        table.items .unit {
            background: #DDDDDD;
        }

        table.items .qty {
        }

        table.items .total {
            background: #DDDDDD;
        }

        table.items td.unit,
        table.items td.qty,
        table.items td.total {
            font-size: 1.2em;
        }

        table.items tbody tr:last-child td {
            border: none;
        }

        table.items tfoot td {
            padding: 10px 20px;
            background: #FFFFFF;
            border-bottom: none;
            font-size: 1.2em;
            white-space: nowrap;
            border-top: 1px solid #AAAAAA;
        }

        table.items tfoot tr:first-child td {
            border-top: none;
        }

        table.items tfoot tr:last-child td {
            color: #57B223;
            font-size: 1.4em;
            border-top: 1px solid #57B223;

        }

        table.items tfoot tr td:first-child {
            border: none;
        }

        #thanks {
            font-size: 1.5em;
            margin-bottom: 20px;
        }

        #notices {
            padding-left: 6px;
            border-left: 6px solid #0087C3;
        }

        #notices .notice {
            font-size: 1em;
            color: #777;
        }

        footer {
            color: #777777;
            width: 100%;
            height: 30px;
            position: absolute;
            bottom: 0;
            border-top: 1px solid #AAAAAA;
            padding: 8px 0;
            text-align: center;
        }

    </style>
</head>
<body>

<?php
$client_info = $this->invoice_model->check_by(array('client_id' => $invoice_info->client_id), 'tbl_client');
$client_lang = $client_info->language;

unset($this->lang->is_loaded[5]);
$language_info = $this->lang->load('sales_lang', $client_lang, TRUE, FALSE, '', TRUE);
$currency = $this->invoice_model->client_currency_sambol($invoice_info->client_id);
if ($client_info->client_status == 1) {
    $status = lang('person');
} else {
    $status = lang('company');
}
$payment_status = $this->invoice_model->get_payment_status($invoice_info->invoices_id);
?>
<header class="clearfix">
    <table>
        <tr>
            <td><
                <div id="logo" style="margin-top: 8px;">
                    <img style=" height: 70px;" src="<?= base_url() . config_item('invoice_logo') ?>">
                </div>
            </td>
            <td>
                <div id="company">
                    <h2 class="name"><?= (config_item('company_legal_name_' . $client_lang) ? config_item('company_legal_name_' . $client_lang) : config_item('company_legal_name')) ?></h2>
                    <div><?= (config_item('company_address_' . $client_lang) ? config_item('company_address_' . $client_lang) : config_item('company_address')) ?></div>
                    <div><?= (config_item('company_city_' . $client_lang) ? config_item('company_city_' . $client_lang) : config_item('company_city')) ?>
                        , <?= config_item('company_zip_code') ?></div>
                    <div><?= (config_item('company_country_' . $client_lang) ? config_item('company_country_' . $client_lang) : config_item('company_country')) ?></div>
                    <div> <?= config_item('company_phone') ?></div>
                    <div><a href="mailto:<?= config_item('company_email') ?>"><?= config_item('company_email') ?></a>
                    </div>
                </div>
            </td>
        </tr>
    </table>
</header>
<div id="details" class="clearfix">
    <table>
        <tr>
            <td><
                <div id="client">
                    <h2 class="name"><?= $client_info->name . ' ' . $status . ' ' ?></h2>
                    <div class="address"><?= $client_info->address ?></div>
                    <div class="address"><?= $client_info->city ?>, <?= $client_info->zipcode ?>
                        ,<?= $client_info->country ?></div>
                    <div class="address"><?= $client_info->phone ?></div>
                    <div class="email"><a href="mailto:<?= $client_info->email ?>"><?= $client_info->email ?></a></div>
                </div>
            </td>
            <td>
                <div id="invoice">
                    <h1><?= $invoice_info->reference_no ?></h1>
                    <div class="date"><?= $language_info['invoice_date'] ?>
                        :<?= strftime(config_item('date_format'), strtotime($invoice_info->date_saved)); ?></div>
                    <div class="date"><?= $language_info['payment_due'] ?>
                        :<?= strftime(config_item('date_format'), strtotime($invoice_info->due_date)); ?></div>
                    <div class="date"><?= $language_info['payment_status'] ?>: <?= $payment_status ?></div>
                </div>
            </td>
        </tr>
    </table>
</div>
<table class="items" border="0" cellspacing="0" cellpadding="0">
    <thead>
    <tr>
        <th class="unit"><?= $language_info['qty'] ?></th>
        <th class="desc"><?= $language_info['item_name'] ?></th>
        <th class="unit"><?= $language_info['unit_price'] ?></th>
        <th class="qty"><?= $language_info['tax_rate'] ?></th>
        <th class="unit"><?= $language_info['tax'] ?></th>
        <th class="qty"><?= $language_info['total'] ?></th>
    </tr>
    </thead>
    <tbody>
    <?php
    $invoice_items = $this->invoice_model->ordered_items_by_id($invoice_info->invoices_id);

    if (!empty($invoice_items)) :
        foreach ($invoice_items as $v_item) :
            $item_name = $v_item->item_name;
            ?>
            <tr>
                <td class="unit"><?= $v_item->quantity ?></td>
                <td class="desc"><h3><?= $item_name ?></h3><?= nl2br($v_item->item_desc) ?></td>
                <td class="unit"><?= display_money($v_item->unit_cost, $currency->symbol) ?></td>
                <td class="qty"><?= $v_item->item_tax_rate ?>%</td>
                <td class="unit"><?= display_money($v_item->item_tax_total, $currency->symbol) ?></td>
                <td class="qty"><?= display_money($v_item->total_cost, $currency->symbol) ?></td>
            </tr>
        <?php endforeach; ?>
    <?php endif ?>

    </tbody>
    <tfoot>
    <tr>
        <td colspan="3"></td>
        <td colspan="2"><?= $language_info['sub_total'] ?></td>
        <td><?= display_money($this->invoice_model->calculate_to('invoice_cost', $invoice_info->invoices_id), $currency->symbol) ?></td>
    </tr>
    <?php if ($invoice_info->tax > 0.00): ?>
        <tr>
            <td colspan="3"></td>
            <td colspan="2"><?= $language_info['tax'] ?> (<?php echo $invoice_info->tax; ?>%)</td>
            <td><?= display_money($this->invoice_model->calculate_to('tax', $invoice_info->invoices_id), $currency->symbol) ?></td>
        </tr>
    <?php endif ?>

    <?php if ($invoice_info->discount > 0): ?>
        <tr>
            <td colspan="3"></td>
            <td colspan="2"><?= $language_info['discount'] ?>(<?php echo $invoice_info->discount; ?>%)</td>
            <td> <?= display_money($this->invoice_model->calculate_to('discount', $invoice_info->invoices_id), $currency->symbol) ?></td>
        </tr>
    <?php endif;
    $paid_amount = display_money($this->invoice_model->calculate_to('paid_amount', $invoice_info->invoices_id), $currency->symbol);
    if ($paid_amount > 0.00) {

        ?>
        <tr>
            <td colspan="3"></td>
            <td colspan="2"><?= $language_info['payment_made'] ?></td>
            <td><?= $paid_amount ?></td>
        </tr>
    <?php } ?>
    <tr>
        <td colspan="3"></td>
        <td colspan="2"><?= $language_info['total'] ?></td>
        <td><?= display_money($this->invoice_model->calculate_to('invoice_due', $invoice_info->invoices_id), $currency->symbol); ?></td>
    </tr>
    </tfoot>
</table>
<div id="thanks"><?= lang('thanks') ?>!</div>
<div id="notices">
    <div class="notice"><?= $invoice_info->notes ?></div>
</div>
<footer>
    <?= config_item('invoice_footer') ?>
</footer>
</body>
</html>
