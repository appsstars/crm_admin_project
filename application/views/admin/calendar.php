<link href="<?php echo base_url() ?>asset/css/fullcalendar.css" rel="stylesheet" type="text/css">

<style type="text/css">
    .datepicker {
        z-index: 1151 !important;
    }

    .mt-sm {
        font-size: 14px;
    }
</style>
<?php
echo message_box('success');
echo message_box('error');
$curency = $this->admin_model->check_by(array('code' => config_item('default_currency')), 'tbl_currencies');

?>
<div class="dashboard row">

    <div class="">
        <div class="clearfix visible-sm-block "></div>

        <div class="col-sm-12 mt-lg">
            <div class="panel panel-custom">
                <div class="panel-heading mb0">
                    <div class="panel-title ">
                        <h4><?= lang('calendar') ?>
                            <div class="pull-right ">
                                <?php if ($this->session->userdata('user_type') == 1) { ?>
                                    <div class="pull-right ml">
                                        <a data-toggle="modal" data-target="#myModal"
                                           href="<?= base_url() ?>admin/calendar/calendar_settings"
                                           class="text-default ml"><i class="fa fa-cogs"></i></a>
                                    </div>
                                <?php } ?>
                                <div class="pull-left">
                                    <div class="btn-group ">
                                        <button class="btn btn-xs btn-success dropdown-toggle" data-toggle="dropdown">
                                            <?php
                                            if (!empty($searchType)) {
                                                echo lang($searchType);
                                            } else {
                                                echo lang('all');
                                            }
                                            ?>
                                            <span class="caret"></span></button>
                                        <ul class="dropdown-menu pull-right animated zoomIn">
                                            <li>
                                                <a href="<?= base_url() ?>admin/calendar/index/search/all"><?= lang('all') ?></a>
                                            </li>
                                            <?php if (config_item('project_on_calendar') == 'on') { ?>
                                                <li>
                                                    <a href="<?= base_url() ?>admin/calendar/index/search/projects"><?= lang('project') ?></a>
                                                </li>
                                            <?php } ?>
                                            <?php if (config_item('milestone_on_calendar') == 'on') { ?>
                                                <li>
                                                    <a href="<?= base_url() ?>admin/calendar/index/search/milestones"><?= lang('milestone') ?></a>
                                                </li>
                                            <?php } ?>
                                            <?php if (config_item('tasks_on_calendar') == 'on') { ?>
                                                <li>
                                                    <a href="<?= base_url() ?>admin/calendar/index/search/tasks"><?= lang('tasks') ?></a>
                                                </li>
                                            <?php } ?>
                                            <?php if (config_item('bugs_on_calendar') == 'on') { ?>
                                                <li>
                                                    <a href="<?= base_url() ?>admin/calendar/index/search/bugs"><?= lang('bugs') ?></a>
                                                </li>
                                            <?php } ?>
                                            <?php if (config_item('invoice_on_calendar') == 'on') { ?>
                                                <li>
                                                    <a href="<?= base_url() ?>admin/calendar/index/search/invoices"><?= lang('invoice') ?></a>
                                                </li>
                                            <?php } ?>
                                            <?php if (config_item('payments_on_calendar') == 'on') { ?>
                                                <li>
                                                    <a href="<?= base_url() ?>admin/calendar/index/search/payments"><?= lang('payments') ?></a>
                                                </li>
                                            <?php } ?>
                                            <?php if (config_item('estimate_on_calendar') == 'on') { ?>
                                                <li>
                                                    <a href="<?= base_url() ?>admin/calendar/index/search/estimates"><?= lang('estimate') ?></a>
                                                </li>
                                            <?php } ?>
                                            <?php if (config_item('opportunities_on_calendar') == 'on') { ?>
                                                <li>
                                                    <a href="<?= base_url() ?>admin/calendar/index/search/opportunities"><?= lang('opportunities') ?></a>
                                                </li>
                                            <?php } ?>
                                            <?php if (config_item('goal_tracking_on_calendar') == 'on') { ?>
                                                <li>
                                                    <a href="<?= base_url() ?>admin/calendar/index/search/goal"><?= lang('goal_tracking') ?></a>
                                                </li>
                                            <?php } ?>
                                            <?php if (config_item('holiday_on_calendar') == 'on') { ?>
                                                <li>
                                                    <a href="<?= base_url() ?>admin/calendar/index/search/holiday"><?= lang('holiday') ?></a>
                                                </li>
                                            <?php } ?>
                                            <?php if (config_item('absent_on_calendar') == 'on') { ?>
                                                <li>
                                                    <a href="<?= base_url() ?>admin/calendar/index/search/absent"><?= lang('absent') ?></a>
                                                </li>
                                            <?php } ?>
                                            <?php if (config_item('on_leave_on_calendar') == 'on') { ?>
                                                <li>
                                                    <a href="<?= base_url() ?>admin/calendar/index/search/on_leave"><?= lang('on_leave') ?></a>
                                                </li>
                                            <?php } ?>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </h4>

                    </div>
                </div>
                <div class="">
                    <div class="panel-heading mb0" style="border-bottom: 1px solid #D8D8D8"></div>
                    <div id="calendar"></div>
                </div>
            </div>
        </div>

    </div>
    <!-- Morris.js charts -->
    <script src="<?php echo base_url() ?>assets/plugins/raphael/raphael.js"></script>
    <script src="<?php echo base_url() ?>assets/plugins/morris/morris.js"></script>
    <?php
    $gcal_api_key = config_item('gcal_api_key');
    $gcal_id = config_item('gcal_id');
    ?>
    <!--Calendar-->
    <script type="text/javascript">
        $(document).ready(function () {
            if ($('#calendar').length) {
                var date = new Date();
                var d = date.getDate();
                var m = date.getMonth();
                var y = date.getFullYear();
                var calendar = $('#calendar').fullCalendar({
                    googleCalendarApiKey: '<?=$gcal_api_key?>',
                    eventAfterRender: function (event, element, view) {
                        if (event.type == 'fo') {
                            $(element).attr('data-toggle', 'ajaxModal').addClass('ajaxModal');
                        }
                    },
                    header: {
                        center: 'prev title next',
                        left: 'month agendaWeek agendaDay today',
                        right: ''
                    },
                    buttonText: {
                        prev: '<i class="fa fa-angle-left" />',
                        next: '<i class="fa fa-angle-right" />'
                    },
                    selectable: true,
                    selectHelper: true,
                    select: function (start, end, allDay) {
                        var endtime = $.fullCalendar.formatDate(end, 'h:mm tt');
                        var starttime = $.fullCalendar.formatDate(start, 'yyyy/MM/dd');
                        var mywhen = starttime + ' - ' + endtime;
                        $('#event_modal #apptStartTime').val(starttime);
                        $('#event_modal #apptEndTime').val(starttime);
                        $('#event_modal #apptAllDay').val(allDay);
                        $('#event_modal #when').text(mywhen);
                        $('#event_modal').modal('show');
                    },
                    events: [
                        <?php
                        if($role == 1){
                        if (config_item('payments_on_calendar') == 'on') {
                        if (!empty($searchType) && $searchType == 'payments' || !empty($searchType) && $searchType == 'all') {
                            $payments_info = $this->db->get('tbl_payments')->result();
                        }
                        if (!empty($payments_info)) {
                        foreach ($payments_info as $v_payments) :
                        $start_day = date('d', strtotime($v_payments->payment_date));
                        $smonth = date('n', strtotime($v_payments->payment_date));
                        $start_month = $smonth - 1;
                        $start_year = date('Y', strtotime($v_payments->payment_date));
                        $end_year = date('Y', strtotime($v_payments->payment_date));
                        $end_day = date('d', strtotime($v_payments->payment_date));
                        $emonth = date('n', strtotime($v_payments->payment_date));
                        $end_month = $emonth - 1;
                        $invoice = $this->db->where(array('invoices_id' => $v_payments->invoices_id))->get('tbl_invoices')->row();
                        $client_info = $this->db->where(array('client_id' => $invoice->client_id))->get('tbl_client')->row();
                        $currency = $this->admin_model->client_currency_sambol($invoice->client_id);
                        ?>
                        {
                            title: "<?= $client_info->name . " (" . $currency->symbol . $v_payments->amount . ")" ?>",
                            start: new Date(<?php echo $start_year . ',' . $start_month . ',' . $start_day; ?>),
                            end: new Date(<?php echo $end_year . ',' . $end_month . ',' . $end_day; ?>),
                            color: '<?= config_item('payments_color') ?>',
                            url: '<?= base_url() ?>admin/invoice/manage_invoice/payments_details/<?= $v_payments->payments_id ?>'
                        },
                        <?php
                        endforeach;
                        }
                        }
                        }
                        if (config_item('invoice_on_calendar') == 'on') {
                        if (!empty($searchType) && $searchType == 'invoices' || !empty($searchType) && $searchType == 'all') {
                            $invoice_info = $this->admin_model->get_permission('tbl_invoices');
                        }
                        if (!empty($invoice_info)) {
                        foreach ($invoice_info as $v_invoice) :
                        $start_day = date('d', strtotime($v_invoice->due_date));
                        $smonth = date('n', strtotime($v_invoice->due_date));
                        $start_month = $smonth - 1;
                        $start_year = date('Y', strtotime($v_invoice->due_date));
                        $end_year = date('Y', strtotime($v_invoice->due_date));
                        $end_day = date('d', strtotime($v_invoice->due_date));
                        $emonth = date('n', strtotime($v_invoice->due_date));
                        $end_month = $emonth - 1;
                        ?>
                        {
                            title: "<?php echo $v_invoice->reference_no ?>",
                            start: new Date(<?php echo $start_year . ',' . $start_month . ',' . $start_day; ?>),
                            end: new Date(<?php echo $end_year . ',' . $end_month . ',' . $end_day; ?>),
                            color: '<?= config_item('invoice_color') ?>',
                            url: '<?= base_url() ?>admin/invoice/manage_invoice/invoice_details/<?= $v_invoice->invoices_id ?>'
                        },
                        <?php
                        endforeach;
                        }
                        }
                        if (config_item('estimate_on_calendar') == 'on') {
                        if (!empty($searchType) && $searchType == 'estimates' || !empty($searchType) && $searchType == 'all') {
                            $estimates_info = $this->admin_model->get_permission('tbl_estimates');
                        }
                        if (!empty($estimates_info)) {
                        foreach ($estimates_info as $v_estimates) :
                        $start_day = date('d', strtotime($v_estimates->due_date));
                        $smonth = date('n', strtotime($v_estimates->due_date));
                        $start_month = $smonth - 1;
                        $start_year = date('Y', strtotime($v_estimates->due_date));
                        $end_year = date('Y', strtotime($v_estimates->due_date));
                        $end_day = date('d', strtotime($v_estimates->due_date));
                        $emonth = date('n', strtotime($v_estimates->due_date));
                        $end_month = $emonth - 1;
                        ?>
                        {
                            title: "<?php echo $v_estimates->reference_no ?>",
                            start: new Date(<?php echo $start_year . ',' . $start_month . ',' . $start_day; ?>),
                            end: new Date(<?php echo $end_year . ',' . $end_month . ',' . $end_day; ?>),
                            color: '<?= config_item('estimate_color') ?>',
                            url: '<?= base_url() ?>admin/estimates/index/estimates_details/<?= $v_estimates->estimates_id ?>'
                        },
                        <?php
                        endforeach;
                        }
                        }
                        if (config_item('project_on_calendar') == 'on') {
                        if (!empty($searchType) && $searchType == 'projects' || !empty($searchType) && $searchType == 'milestones' || !empty($searchType) && $searchType == 'all') {
                            $project_info = $this->admin_model->get_permission('tbl_project');
                        }
                        if (!empty($project_info)) {
                        foreach ($project_info as $v_project) :
                        $start_day = date('d', strtotime($v_project->end_date));
                        $smonth = date('n', strtotime($v_project->end_date));
                        $start_month = $smonth - 1;
                        $start_year = date('Y', strtotime($v_project->end_date));
                        $end_year = date('Y', strtotime($v_project->end_date));
                        $end_day = date('d', strtotime($v_project->end_date));
                        $emonth = date('n', strtotime($v_project->end_date));
                        $end_month = $emonth - 1;
                        if (!empty($searchType) && $searchType == 'projects' || !empty($searchType) && $searchType == 'all') {
                        if(!empty($v_project)){
                        ?>
                        {
                            title: "<?php echo $v_project->project_name ?>",
                            start: new Date(<?php echo $start_year . ',' . $start_month . ',' . $start_day; ?>),
                            end: new Date(<?php echo $end_year . ',' . $end_month . ',' . $end_day; ?>),
                            color: '<?= config_item('project_color') ?>',
                            url: '<?= base_url() ?>admin/projects/project_details/<?= $v_project->project_id ?>'
                        },
                        <?php
                        }
                        }
                        if (config_item('milestone_on_calendar') == 'on') {
                        if (!empty($searchType) && $searchType == 'milestones' || !empty($searchType) && $searchType == 'all') {
                            $milestone_info = $this->db->where(array('project_id' => $v_project->project_id))->get('tbl_milestones')->result();
                        }
                        if (!empty($milestone_info)) {
                        foreach ($milestone_info as $v_milestone) :
                        $start_day = date('d', strtotime($v_milestone->end_date));
                        $smonth = date('n', strtotime($v_milestone->end_date));
                        $start_month = $smonth - 1;
                        $start_year = date('Y', strtotime($v_milestone->end_date));
                        $end_year = date('Y', strtotime($v_milestone->end_date));
                        $end_day = date('d', strtotime($v_milestone->end_date));
                        $emonth = date('n', strtotime($v_milestone->end_date));
                        $end_month = $emonth - 1;
                        ?>
                        {
                            title: '<?php echo $v_milestone->milestone_name ?>',
                            start: new Date(<?php echo $start_year . ',' . $start_month . ',' . $start_day; ?>),
                            end: new Date(<?php echo $end_year . ',' . $end_month . ',' . $end_day; ?>),
                            color: '<?= config_item('milestone_color') ?>',
                            url: '<?= base_url() ?>admin/projects/project_details/<?= $v_project->project_id ?>/5'
                        },
                        <?php
                        endforeach;
                        }
                        }
                        endforeach;
                        }
                        }
                        if (config_item('tasks_on_calendar') == 'on') {
                        if (!empty($searchType) && $searchType == 'tasks' || !empty($searchType) && $searchType == 'all') {
                            $task_info = $this->admin_model->get_permission('tbl_task');
                        }
                        if (!empty($task_info)) {
                        foreach ($task_info as $v_task) :
                        $start_day = date('d', strtotime($v_task->due_date));
                        $smonth = date('n', strtotime($v_task->due_date));
                        $start_month = $smonth - 1;
                        $start_year = date('Y', strtotime($v_task->due_date));
                        $end_year = date('Y', strtotime($v_task->due_date));
                        $end_day = date('d', strtotime($v_task->due_date));
                        $emonth = date('n', strtotime($v_task->due_date));
                        $end_month = $emonth - 1;
                        ?>
                        {
                            title: "<?php echo $v_task->task_name ?>",
                            start: new Date(<?php echo $start_year . ',' . $start_month . ',' . $start_day; ?>),
                            end: new Date(<?php echo $end_year . ',' . $end_month . ',' . $end_day; ?>),
                            color: '<?= config_item('tasks_color') ?>',
                            url: '<?= base_url() ?>admin/tasks/view_task_details/<?= $v_task->task_id ?>'
                        },
                        <?php
                        endforeach;
                        }
                        }
                        if (config_item('bugs_on_calendar') == 'on') {
                        if (!empty($searchType) && $searchType == 'bugs' || !empty($searchType) && $searchType == 'all') {
                            $bug_info = $this->admin_model->get_permission('tbl_bug');
                        }
                        if (!empty($bug_info)) {
                        foreach ($bug_info as $v_bug) :
                        $start_day = date('d', strtotime($v_bug->created_time));
                        $smonth = date('n', strtotime($v_bug->created_time));
                        $start_month = $smonth - 1;
                        $start_year = date('Y', strtotime($v_bug->created_time));
                        $end_year = date('Y', strtotime($v_bug->created_time));
                        $end_day = date('d', strtotime($v_bug->created_time));
                        $emonth = date('n', strtotime($v_bug->created_time));
                        $end_month = $emonth - 1;
                        ?>
                        {
                            title: "<?php echo $v_bug->bug_title ?>",
                            start: new Date(<?php echo $start_year . ',' . $start_month . ',' . $start_day; ?>),
                            end: new Date(<?php echo $end_year . ',' . $end_month . ',' . $end_day; ?>),
                            color: '<?= config_item('bugs_color') ?>',
                            url: '<?= base_url() ?>admin/bugs/view_bug_details/<?= $v_bug->bug_id ?>'
                        },
                        <?php
                        endforeach;
                        }
                        }
                        if (config_item('opportunities_on_calendar') == 'on') {
                        if (!empty($searchType) && $searchType == 'opportunities' || !empty($searchType) && $searchType == 'all') {
                            $opportunity_info = $this->admin_model->get_permission('tbl_opportunities');
                        }
                        if (!empty($opportunity_info)) {
                        foreach ($opportunity_info as $v_opportunity) :
                        $start_day = date('d', strtotime($v_opportunity->close_date));
                        $smonth = date('n', strtotime($v_opportunity->close_date));
                        $start_month = $smonth - 1;
                        $start_year = date('Y', strtotime($v_opportunity->close_date));
                        $end_year = date('Y', strtotime($v_opportunity->close_date));
                        $end_day = date('d', strtotime($v_opportunity->close_date));
                        $emonth = date('n', strtotime($v_opportunity->close_date));
                        $end_month = $emonth - 1;
                        // next action
                        $next_start_day = date('d', strtotime($v_opportunity->next_action_date));
                        $next_smonth = date('n', strtotime($v_opportunity->next_action_date));
                        $next_start_month = $next_smonth - 1;
                        $next_start_year = date('Y', strtotime($v_opportunity->next_action_date));
                        $next_end_year = date('Y', strtotime($v_opportunity->next_action_date));
                        $next_end_day = date('d', strtotime($v_opportunity->next_action_date));
                        $next_emonth = date('n', strtotime($v_opportunity->next_action_date));
                        $next_end_month = $next_emonth - 1;
                        ?>
                        {
                            title: "<?php echo $v_opportunity->opportunity_name ?>",
                            start: new Date(<?php echo $start_year . ',' . $start_month . ',' . $start_day; ?>),
                            end: new Date(<?php echo $end_year . ',' . $end_month . ',' . $end_day; ?>),
                            color: '<?= config_item('opportunities_color') ?>',
                            url: '<?= base_url() ?>admin/opportunities/opportunity_details/<?= $v_opportunity->opportunities_id ?>'
                        },
                        {
                            title: "<?php echo $v_opportunity->next_action ?>",
                            start: new Date(<?php echo $next_start_year . ',' . $next_start_month . ',' . $next_start_day; ?>),
                            end: new Date(<?php echo $next_end_year . ',' . $next_end_month . ',' . $next_end_day; ?>),
                            color: '<?= config_item('opportunities_color') ?>',
                            url: '<?= base_url() ?>admin/opportunities/opportunity_details/<?= $v_opportunity->opportunities_id ?>'
                        },
                        <?php
                        endforeach;
                        }
                        }
                        if (config_item('holiday_on_calendar') == 'on') {
                        if (!empty($searchType) && $searchType == 'holiday' || !empty($searchType) && $searchType == 'all') {
                            $holiday_info = $this->db->get('tbl_holiday')->result();
                        }
                        if (!empty($holiday_info)) {
                        foreach ($holiday_info as $v_holiday) :
                        $start_day = date('d', strtotime($v_holiday->start_date));
                        $smonth = date('n', strtotime($v_holiday->start_date));
                        $start_month = $smonth - 1;
                        $start_year = date('Y', strtotime($v_holiday->start_date));
                        $end_year = date('Y', strtotime($v_holiday->end_date));
                        $end_day = date('d', strtotime($v_holiday->end_date));
                        $emonth = date('n', strtotime($v_holiday->end_date));
                        $end_month = $emonth - 1;
                        ?>
                        {
                            title: "<?php echo $v_holiday->event_name ?>",
                            start: new Date(<?php echo $start_year . ',' . $start_month . ',' . $start_day; ?>),
                            end: new Date(<?php echo $end_year . ',' . $end_month . ',' . $end_day; ?>),
                            color: '<?= $v_holiday->color?>',
                            url: '<?= base_url() ?>admin/holiday/index/<?= $v_holiday->holiday_id ?>'
                        },
                        <?php
                        endforeach;
                        }
                        }
                        if (config_item('goal_tracking_on_calendar') == 'on') {
                        if (!empty($searchType) && $searchType == 'goal' || !empty($searchType) && $searchType == 'all') {
                            $all_goal_tracking = $this->admin_model->get_permission('tbl_goal_tracking');
                        }
                        if (!empty($all_goal_tracking)){foreach ($all_goal_tracking as $v_goal_tracking):
                        $start_day = date('d', strtotime($v_goal_tracking->end_date));
                        $smonth = date('n', strtotime($v_goal_tracking->end_date));
                        $start_month = $smonth - 1;
                        $start_year = date('Y', strtotime($v_goal_tracking->end_date));
                        $end_year = date('Y', strtotime($v_goal_tracking->end_date));
                        $end_day = date('d', strtotime($v_goal_tracking->end_date));
                        $emonth = date('n', strtotime($v_goal_tracking->end_date));
                        $end_month = $emonth - 1;

                        ?>
                        {
                            title: "<?php echo $v_goal_tracking->subject ?>",
                            start: new Date(<?php echo $start_year . ',' . $start_month . ',' . $start_day; ?>),
                            end: new Date(<?php echo $end_year . ',' . $end_month . ',' . $end_day; ?>),
                            color: '<?= config_item('goal_tracking_color') ?>',
                            url: '<?= base_url() ?>admin/goal_tracking/goal_details/<?= $v_goal_tracking->goal_tracking_id ?>'
                        },
                        <?php
                        endforeach;
                        }
                        }
                        if (config_item('absent_on_calendar') == 'on') {
                        if (!empty($searchType) && $searchType == 'absent' || !empty($searchType) && $searchType == 'all') {
                            $absent_info = $this->db->where('attendance_status', '0')->get('tbl_attendance')->result();
                        }
                        if (!empty($absent_info)) {
                        foreach ($absent_info as $v_absent) :
                        $absent_user = $this->db->where('user_id',$v_absent->user_id)->get('tbl_account_details')->row();
                        $start_day = date('d', strtotime($v_absent->date_in));
                        $smonth = date('n', strtotime($v_absent->date_in));
                        $start_month = $smonth - 1;
                        $start_year = date('Y', strtotime($v_absent->date_in));
                        $end_year = date('Y', strtotime($v_absent->date_in));
                        $end_day = date('d', strtotime($v_absent->date_in));
                        $emonth = date('n', strtotime($v_absent->date_in));
                        $end_month = $emonth - 1;
                        ?>
                        {
                            title: "<?php echo $absent_user->fullname ?>",
                            start: new Date(<?php echo $start_year . ',' . $start_month . ',' . $start_day; ?>),
                            end: new Date(<?php echo $end_year . ',' . $end_month . ',' . $end_day; ?>),
                            color: '<?= config_item('absent_color') ?>',
                            url: '<?= base_url() ?>admin/user/user_details/<?= $absent_user->user_id ?>'
                        },
                        <?php
                        endforeach;
                        }
                        }
                        if (config_item('on_leave_on_calendar') == 'on') {
                        if (!empty($searchType) && $searchType == 'on_leave' || !empty($searchType) && $searchType == 'all') {
                            $leave_info = $this->db->where('attendance_status', '3')->get('tbl_attendance')->result();
                        }
                        if (!empty($leave_info)) {
                        foreach ($leave_info as $v_leave) :
                        $leave_user = $this->db->where('user_id',$v_leave->user_id)->get('tbl_account_details')->row();
                        $start_day = date('d', strtotime($v_leave->date_in));
                        $smonth = date('n', strtotime($v_leave->date_in));
                        $start_month = $smonth - 1;
                        $start_year = date('Y', strtotime($v_leave->date_in));
                        $end_year = date('Y', strtotime($v_leave->date_in));
                        $end_day = date('d', strtotime($v_leave->date_in));
                        $emonth = date('n', strtotime($v_leave->date_in));
                        $end_month = $emonth - 1;
                        ?>
                        {
                            title: "<?php echo $leave_user->fullname ?>",
                            start: new Date(<?php echo $start_year . ',' . $start_month . ',' . $start_day; ?>),
                            end: new Date(<?php echo $end_year . ',' . $end_month . ',' . $end_day; ?>),
                            color: '<?= config_item('on_leave_color') ?>',
                            url: '<?= base_url() ?>admin/user/user_details/<?= $leave_user->user_id ?>'
                        },
                        <?php
                        endforeach;
                        }
                        }
                        ?>
                        {
                            googleCalendarId: '<?=$gcal_id?>'

                        }

                    ],
                    eventColor: '#3A87AD',
                });
            }

        });</script>

    <?php include_once 'asset/js/fullcalendar.php'; ?>
    <script src="<?php echo base_url(); ?>asset/js/jquery-ui.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/2.3.1/gcal.js"></script>