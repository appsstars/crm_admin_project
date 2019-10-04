--
-- Table structure for table `installer`
--

CREATE TABLE IF NOT EXISTS `installer` (
  `id` int(1) NOT NULL,
  `installer_flag` int(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `installer`
--

INSERT INTO `installer` (`id`, `installer_flag`) VALUES
(1, 1);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_accounts`
--

CREATE TABLE IF NOT EXISTS `tbl_accounts` (
  `account_id` int(11) NOT NULL,
  `account_name` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `description` varchar(200) COLLATE utf8_unicode_ci NOT NULL,
  `balance` decimal(18,2) NOT NULL DEFAULT '0.00',
  `permission` text COLLATE utf8_unicode_ci
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `tbl_accounts`
--

INSERT INTO `tbl_accounts` (`account_id`, `account_name`, `description`, `balance`, `permission`) VALUES
(1, '', '', '-5200.00', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_account_details`
--

CREATE TABLE IF NOT EXISTS `tbl_account_details` (
  `account_details_id` bigint(20) unsigned NOT NULL,
  `user_id` int(11) NOT NULL,
  `fullname` varchar(160) COLLATE utf8_unicode_ci DEFAULT NULL,
  `employment_id` varchar(200) COLLATE utf8_unicode_ci DEFAULT NULL,
  `company` varchar(150) COLLATE utf8_unicode_ci DEFAULT NULL,
  `city` varchar(40) COLLATE utf8_unicode_ci DEFAULT NULL,
  `country` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `locale` varchar(100) COLLATE utf8_unicode_ci DEFAULT 'en_US',
  `address` varchar(64) COLLATE utf8_unicode_ci DEFAULT '-',
  `phone` varchar(32) COLLATE utf8_unicode_ci DEFAULT '-',
  `mobile` varchar(32) COLLATE utf8_unicode_ci DEFAULT '',
  `skype` varchar(100) COLLATE utf8_unicode_ci DEFAULT '',
  `language` varchar(40) COLLATE utf8_unicode_ci DEFAULT 'english',
  `designations_id` int(11) DEFAULT '0',
  `avatar` varchar(200) COLLATE utf8_unicode_ci DEFAULT 'uploads/default_avatar.jpg',
  `joining_date` date DEFAULT NULL,
  `present_address` text COLLATE utf8_unicode_ci,
  `date_of_birth` date DEFAULT NULL,
  `gender` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  `maratial_status` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  `father_name` varchar(200) COLLATE utf8_unicode_ci DEFAULT NULL,
  `mother_name` varchar(200) COLLATE utf8_unicode_ci DEFAULT NULL,
  `passport` varchar(40) COLLATE utf8_unicode_ci DEFAULT NULL
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci ROW_FORMAT=COMPACT;

--
-- Dumping data for table `tbl_account_details`
--

INSERT INTO `tbl_account_details` (`account_details_id`, `user_id`, `fullname`, `employment_id`, `company`, `city`, `country`, `locale`, `address`, `phone`, `mobile`, `skype`, `language`, `designations_id`, `avatar`, `joining_date`, `present_address`, `date_of_birth`, `gender`, `maratial_status`, `father_name`, `mother_name`, `passport`) VALUES
(1, 1, 'Charlic Martin 1', '12365', '-', NULL, NULL, 'en_US', '-', '017236111251', '0172361125', 'skype', 'english', 1, 'uploads/admin.png', '2016-06-07', 'Okk', '1991-06-03', 'male', 'unmarried', 'Abdul jabbar', 'Amena', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_activities`
--

CREATE TABLE IF NOT EXISTS `tbl_activities` (
  `activities_id` int(11) NOT NULL,
  `user` int(11) NOT NULL,
  `module` varchar(32) COLLATE utf8_unicode_ci DEFAULT NULL,
  `module_field_id` int(11) DEFAULT NULL,
  `activity` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `activity_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `icon` varchar(32) COLLATE utf8_unicode_ci DEFAULT 'fa-coffee',
  `value1` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `value2` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `deleted` int(11) NOT NULL DEFAULT '0'
) ENGINE=MyISAM AUTO_INCREMENT=22 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `tbl_activities`
--

INSERT INTO `tbl_activities` (`activities_id`, `user`, `module`, `module_field_id`, `activity`, `activity_date`, `icon`, `value1`, `value2`, `deleted`) VALUES
(1, 1, 'client', 1, 'activity_update_company', '2017-02-16 01:22:39', 'fa-user', 'Khorshed Allam ', NULL, 0),
(2, 1, 'client', NULL, 'activity_added_new_contact', '2017-02-16 01:23:10', 'fa-user', 'Mr Client', NULL, 0),
(3, 1, 'client', 1, 'activity_primary_contact', '2017-02-16 01:23:22', 'fa-user', 'Mr Client', NULL, 0),
(4, 1, 'user', 2, 'activity_added_new_user', '2017-02-16 01:24:16', 'fa-user', 'client', NULL, 0),
(5, 1, 'projects', 1, 'activity_save_project', '2017-02-16 01:25:47', 'fa-circle-o', 'Test project 1', NULL, 0),
(6, 1, 'payroll', NULL, 'activity_salary_details_update', '2017-02-16 01:57:39', 'fa-ticket', 'PHP', NULL, 0),
(7, 1, 'payroll', 1, 'activity_salary_details_update', '2017-02-16 01:57:56', 'fa-ticket', 'PHP', NULL, 0),
(8, 1, 'payroll', NULL, 'activity_salary_template_added', '2017-02-16 01:58:59', 'fa-ticket', 'Manager', NULL, 0),
(9, 1, 'payroll', 1, 'activity_salary_details_update', '2017-02-16 01:59:19', 'fa-ticket', 'PHP', NULL, 0),
(10, 1, 'transactions', 1, 'activity_new_expense', '2017-02-16 02:00:02', 'fa-coffee', NULL, '2600', 0),
(11, 1, 'payroll', NULL, 'activity_make_payment', '2017-02-16 02:00:02', 'fa-ticket', 'Charlic Martin 1', 'March 2017', 0),
(12, 1, 'transactions', 0, 'activity_new_expense', '2017-02-16 02:00:43', 'fa-coffee', '', '2600', 0),
(13, 1, 'payroll', NULL, 'activity_make_payment', '2017-02-16 02:00:43', 'fa-ticket', 'Charlic Martin 1', 'February 2017', 0),
(14, 1, 'payroll', 2, 'activity_payslip_send', '2017-02-16 02:00:55', 'fa-ticket', 'Charlic Martin 1', 'February 2017', 0),
(15, 1, 'award', NULL, 'activity_added_a_award', '2017-02-16 02:04:34', 'fa-ticket', 'Mr.FEBRUARY', '2017 Feb', 0),
(16, 1, 'payroll', 1, 'activity_apply_advance_salary', '2017-02-16 02:07:15', 'fa-ticket', 'Charlic Martin 1', '500', 0),
(17, 1, 'settings', 1, 'activity_added_a_lead_source', '2017-02-16 02:21:34', 'fa-coffee', 'Phone', NULL, 0),
(18, 1, 'settings', 2, 'activity_added_a_lead_source', '2017-02-16 02:21:40', 'fa-coffee', 'Ads', NULL, 0),
(19, 1, 'settings', 3, 'activity_added_a_lead_source', '2017-02-16 02:21:46', 'fa-coffee', 'Friends', NULL, 0),
(20, 1, 'award', 1, 'activity_time_change_request', '2017-02-16 02:23:57', 'fa-ticket', 'Charlic Martin 1', '', 0),
(21, 1, 'award', 1, 'activity_time_change_request', '2017-02-16 02:24:08', 'fa-ticket', 'Charlic Martin 1', '', 0);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_advance_salary`
--

CREATE TABLE IF NOT EXISTS `tbl_advance_salary` (
  `advance_salary_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `advance_amount` varchar(200) NOT NULL,
  `deduct_month` varchar(30) DEFAULT NULL,
  `reason` text,
  `request_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `status` tinyint(2) NOT NULL DEFAULT '0' COMMENT '0 =pending,1=accpect , 2 = reject and 3 = paid',
  `approve_by` int(11) DEFAULT NULL
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `tbl_advance_salary`
--

INSERT INTO `tbl_advance_salary` (`advance_salary_id`, `user_id`, `advance_amount`, `deduct_month`, `reason`, `request_date`, `status`, `approve_by`) VALUES
(1, 1, '500', '2017-08', 'oinjam bosss, mo makang2', '2017-02-16 02:07:15', 1, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_announcements`
--

CREATE TABLE IF NOT EXISTS `tbl_announcements` (
  `announcements_id` int(11) NOT NULL,
  `title` text NOT NULL,
  `description` text NOT NULL,
  `user_id` int(11) NOT NULL,
  `created_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `status` enum('published','unpublished') NOT NULL DEFAULT 'unpublished' COMMENT '0 = unpublished, 1 = published',
  `view_status` tinyint(1) NOT NULL DEFAULT '2' COMMENT '1=Read 2=Unread',
  `start_date` date NOT NULL,
  `end_date` date NOT NULL,
  `all_client` varchar(20) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_assign_item`
--

CREATE TABLE IF NOT EXISTS `tbl_assign_item` (
  `assign_item_id` int(11) NOT NULL,
  `stock_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `assign_inventory` int(5) NOT NULL,
  `assign_date` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_attendance`
--

CREATE TABLE IF NOT EXISTS `tbl_attendance` (
  `attendance_id` int(11) NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `leave_category_id` int(11) DEFAULT '0',
  `date_in` date DEFAULT NULL,
  `date_out` date DEFAULT NULL,
  `attendance_status` tinyint(1) NOT NULL DEFAULT '0' COMMENT 'status 0=absent 1=present 3 = onleave'
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `tbl_attendance`
--

INSERT INTO `tbl_attendance` (`attendance_id`, `user_id`, `leave_category_id`, `date_in`, `date_out`, `attendance_status`) VALUES
(1, 1, 0, '2017-02-16', '2017-02-16', 1);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_bug`
--

CREATE TABLE IF NOT EXISTS `tbl_bug` (
  `bug_id` int(11) NOT NULL,
  `project_id` int(11) DEFAULT NULL,
  `opportunities_id` int(11) DEFAULT NULL,
  `bug_title` varchar(200) NOT NULL,
  `bug_description` text NOT NULL,
  `bug_status` varchar(30) DEFAULT NULL,
  `notes` text NOT NULL,
  `priority` varchar(10) NOT NULL,
  `reporter` int(11) DEFAULT NULL,
  `created_time` timestamp NULL DEFAULT NULL,
  `update_time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `permission` text,
  `client_visible` varchar(8) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_calls`
--

CREATE TABLE IF NOT EXISTS `tbl_calls` (
  `calls_id` int(11) NOT NULL,
  `leads_id` int(11) DEFAULT NULL,
  `opportunities_id` int(11) DEFAULT NULL,
  `client_id` int(11) DEFAULT NULL,
  `user_id` int(11) DEFAULT NULL,
  `date` varchar(20) CHARACTER SET latin1 NOT NULL,
  `call_summary` varchar(200) CHARACTER SET latin1 NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_client`
--

CREATE TABLE IF NOT EXISTS `tbl_client` (
  `client_id` int(11) NOT NULL,
  `primary_contact` int(11) DEFAULT NULL,
  `name` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `email` varchar(64) COLLATE utf8_unicode_ci DEFAULT NULL,
  `short_note` text COLLATE utf8_unicode_ci,
  `website` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `phone` varchar(64) COLLATE utf8_unicode_ci DEFAULT NULL,
  `mobile` varchar(64) COLLATE utf8_unicode_ci DEFAULT NULL,
  `fax` varchar(64) COLLATE utf8_unicode_ci DEFAULT NULL,
  `address` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `city` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `zipcode` varchar(20) CHARACTER SET utf8 DEFAULT NULL,
  `currency` varchar(32) COLLATE utf8_unicode_ci DEFAULT 'USD',
  `skype_id` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `linkedin` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `facebook` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `twitter` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `language` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `country` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `vat` varchar(64) COLLATE utf8_unicode_ci DEFAULT NULL,
  `hosting_company` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `hostname` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `port` varchar(32) COLLATE utf8_unicode_ci DEFAULT NULL,
  `password` varchar(64) COLLATE utf8_unicode_ci DEFAULT NULL,
  `username` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `client_status` tinyint(1) NOT NULL COMMENT '1 = person and 2 = company',
  `profile_photo` text COLLATE utf8_unicode_ci,
  `date_added` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `leads_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_clock`
--

CREATE TABLE IF NOT EXISTS `tbl_clock` (
  `clock_id` int(11) NOT NULL,
  `attendance_id` int(11) NOT NULL,
  `clockin_time` time DEFAULT NULL,
  `clockout_time` time DEFAULT NULL,
  `comments` text,
  `clocking_status` tinyint(1) NOT NULL DEFAULT '0' COMMENT '1= clockin_time'
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `tbl_clock`
--

INSERT INTO `tbl_clock` (`clock_id`, `attendance_id`, `clockin_time`, `clockout_time`, `comments`, `clocking_status`) VALUES
(1, 1, '09:56:00', '16:40:00', '0', 0);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_clock_history`
--

CREATE TABLE IF NOT EXISTS `tbl_clock_history` (
  `clock_history_id` int(11) NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `clock_id` int(11) NOT NULL,
  `clockin_edit` time NOT NULL,
  `clockout_edit` time DEFAULT NULL,
  `reason` varchar(300) NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT '1' COMMENT '1=pending and 2 = accept  3= reject',
  `notify_me` tinyint(4) NOT NULL DEFAULT '1',
  `view_status` tinyint(4) NOT NULL DEFAULT '2',
  `request_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `tbl_clock_history`
--

INSERT INTO `tbl_clock_history` (`clock_history_id`, `user_id`, `clock_id`, `clockin_edit`, `clockout_edit`, `reason`, `status`, `notify_me`, `view_status`, `request_date`) VALUES
(1, 1, 1, '09:56:00', '16:40:00', '', 2, 1, 2, '2017-02-16 02:23:57'),
(2, 1, 1, '09:56:00', '16:40:00', '', 2, 1, 2, '2017-02-16 02:24:08');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_config`
--

CREATE TABLE IF NOT EXISTS `tbl_config` (
  `config_key` varchar(255) NOT NULL,
  `value` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `tbl_config`
--

INSERT INTO `tbl_config` (`config_key`, `value`) VALUES
('2checkout_private_key', 'privatekey'),
('2checkout_publishable_key', 'checkoutkey'),
('2checkout_seller_id', 'seled id'),
('2checkout_status', 'active'),
('absent_color', 'rgba(247,23,36,0.92)'),
('absent_on_calendar', 'on'),
('accounting_snapshot', '0'),
('active_cronjob', 'on'),
('advance_salary', 'true'),
('advance_salary_email', '1'),
('allowed_files', 'gif|png|jpeg|jpg|pdf|doc|txt|docx|xls|zip|rar|xls|mp4'),
('allow_client_project', 'TRUE'),
('allow_client_registration', 'TRUE'),
('announcements_email', '1'),
('aside-collapsed', '0'),
('aside-float', '0'),
('attendance_report', '1'),
('authorize', 'login id'),
('authorize_status', 'active'),
('authorize_transaction_key', 'transfer key'),
('automatic_database_backup', 'on'),
('automatic_email_on_recur', 'TRUE'),
('auto_close_ticket', '72'),
('award_email', '1'),
('bank_cash', '0'),
('bitcoin_address', '0'),
('bitcoin_status', 'active'),
('braintree_default_account', 'Braintree Defual allcount'),
('braintree_live_or_sandbox', 'Braintree Live or Sandbox'),
('braintree_merchant_id', 'Braintree Merchant ID'),
('braintree_private_key', 'Braintree Private Key'),
('braintree_public_key', 'Braintree Defual allcount'),
('braintree_status', 'active'),
('bugs_color', '#1f3d1c'),
('bugs_on_calendar', 'on'),
('build', '0'),
('ccavenue_key', 'CCAvenue Working Key'),
('ccavenue_merchant_id', 'CCAvenue Merchant ID'),
('ccavenue_status', 'active'),
('company_address', '123, XYZ street'),
('company_city', 'London'),
('company_country', 'Pakistan'),
('company_domain', 'maidsontime.com'),
('company_email', 'test@gmail.com'),
('company_legal_name', 'Ultimate Project Manager PRO'),
('company_logo', 'uploads/230524_1-2011-01-06-05-01-11_(1).jpg'),
('company_name', 'Ultimate Project Manager CRM Pro '),
('company_phone', '2342432'),
('company_phone_2', ''),
('company_vat', ''),
('company_zip_code', 'SE1 7PB'),
('config_additional_flag', '0'),
('config_host', '0'),
('config_imap', '0'),
('config_imap_or_pop', '0'),
('config_mailbox', '0'),
('config_password', '0'),
('config_pop3', '0'),
('config_port', '0'),
('config_ssl', '0'),
('config_username', '0'),
('contact_person', 'John Smith'),
('contract_expiration_reminder', '0'),
('country', '0'),
('cron_key', '34WI2L12L87I1A65M90M9A42N41D08A26I'),
('currency_position', '1'),
('date_format', '%d-%m-%Y'),
('date_php_format', 'd-m-Y'),
('date_picker_format', 'dd-mm-yyyy'),
('decimal_separator', '0'),
('default_account', '1'),
('default_currency', 'AUD'),
('default_currency_symbol', '$'),
('default_department', '0'),
('default_language', 'english'),
('default_leads_source', '0'),
('default_lead_permission', 'all'),
('default_lead_status', '0'),
('default_priority', 'low'),
('default_status', 'closed'),
('default_tax', '10'),
('default_terms', 'Thank you for <span style="font-weight: bold;">your</span> busasiness. Please process this invoice within the due date.'),
('delete_mail_after_import', '0'),
('demo_mode', 'FALSE'),
('developer', 'ig63Yd/+yuA8127gEyTz9TY4pnoeKq8dtocVP44+BJvtlRp8Vqcetwjk51dhSB6Rx8aVIKOPfUmNyKGWK7C/gg=='),
('display_estimate_badge', '0'),
('display_invoice_badge', 'FALSE'),
('email_account_details', 'TRUE'),
('email_estimate_message', 'Hi {CLIENT}<br>Thanks for your business inquiry. <br>The estimate EST {REF} is attached with this email. <br>Estimate Overview:<br>Estimate # : EST {REF}<br>Amount: {CURRENCY} {AMOUNT}<br> You can view the estimate online at:<br>{LINK}<br>Best Regards,<br>{COMPANY}'),
('email_invoice_message', 'Hello {CLIENT}<br>Here is the invoice of {CURRENCY} {AMOUNT}<br>You can view the invoice online at:<br>{LINK}<br>Best Regards,<br>{COMPANY}'),
('email_staff_tickets', 'TRUE'),
('enable_languages', 'TRUE'),
('estimate_color', 'rgba(160,29,171,1)'),
('estimate_footer', '<span style="font-weight: bold; line-height: 21.4px; text-align: right;">Estimate&nbsp;</span>was created on a computer and is valid without the signature and seal'),
('estimate_language', 'en'),
('estimate_on_calendar', 'on'),
('estimate_prefix', 'EST'),
('estimate_start_no', '1'),
('estimate_terms', 'Hey Looking forward to doing business with you.'),
('expense_email', '1'),
('file_max_size', '80000'),
('for_invoice', '0'),
('for_leads', '0'),
('for_tickets', '0'),
('gcal_api_key', 'AIzaSyBXcmmcboEyAgtoUtXjKXe4TfpsnEtoUDQ'),
('gcal_id', 'kla83orf1u7hrj6p0u5gdmpji4@group.calendar.google.com'),
('goal_tracking_color', '#537015'),
('goal_tracking_on_calendar', 'on'),
('holiday_on_calendar', 'on'),
('imap_search', '0'),
('imap_search_for_leads', '0'),
('imap_search_for_tickets', '0'),
('increment_estimate_number', 'TRUE'),
('increment_invoice_number', 'TRUE'),
('installed', 'TRUE'),
('invoices_due_after', '5'),
('invoice_color', '#53b567'),
('invoice_footer', 'Invoice was created on a computer and is valid without the signature and seal'),
('invoice_language', 'en'),
('invoice_logo', 'uploads/logo.png'),
('invoice_on_calendar', 'on'),
('invoice_prefix', 'INV'),
('invoice_start_no', '1'),
('job_circular_email', '1'),
('language', 'english'),
('languages', 'spanish'),
('last_autobackup', '1469404563'),
('last_check', '1436363002'),
('last_cronjob_run', '1469404562'),
('last_postmaster_run', '1461786636'),
('last_seen_activities', '0'),
('layout-boxed', '0'),
('layout-fixed', '0'),
('leads_keyword', '0'),
('leave_email', '1'),
('locale', 'aa_DJ'),
('login_bg', 'bg-login.jpg'),
('logofile', '0'),
('logo_or_icon', 'logo_title'),
('milestone_color', '#a86495'),
('milestone_on_calendar', 'on'),
('money_format', '1'),
('notified_user', 'false'),
('notify_bug_assignment', 'TRUE'),
('notify_bug_comments', 'TRUE'),
('notify_bug_status', 'TRUE'),
('notify_message_received', 'TRUE'),
('notify_project_assignments', 'TRUE'),
('notify_project_comments', 'TRUE'),
('notify_project_files', 'TRUE'),
('notify_task_assignments', 'TRUE'),
('office_time', 'different_time'),
('on_leave_color', '#e6dd11'),
('on_leave_on_calendar', 'on'),
('opportunities_color', '#349685'),
('opportunities_on_calendar', 'on'),
('overtime_email', '1'),
('payments_color', '#7f21c9'),
('payments_on_calendar', 'on'),
('paypal_cancel_url', 'paypal/cancel'),
('paypal_email', 'billing@coderitems.com'),
('paypal_ipn_url', 'paypal/t_ipn/ipn'),
('paypal_live', 'TRUE'),
('paypal_status', 'active'),
('paypal_success_url', 'paypal/success'),
('payslip_email', '1'),
('pdf_engine', 'invoicr'),
('performance_email', '1'),
('postmark_api_key', ''),
('postmark_from_address', ''),
('project_color', '#e61755'),
('project_on_calendar', 'on'),
('project_prefix', 'PRO'),
('protocol', 'mail'),
('purchase_code', ''),
('recurring_invoice', '0'),
('reminder_message', 'Hello {CLIENT}<br>This is a friendly reminder to pay your invoice of {CURRENCY} {AMOUNT}<br>You can view the invoice online at:<br>{LINK}<br>Best Regards,<br>{COMPANY}'),
('reset_key', '34WI2L12L87I1A65M90M9A42N41D08A26I'),
('rows_per_table', '25'),
('security_token', '5027133599'),
('send_email_when_recur', 'TRUE'),
('settings', 'theme'),
('show_estimate_tax', 'FALSE'),
('show_invoice_tax', 'TRUE'),
('show_item_tax', '0'),
('show_login_image', 'TRUE'),
('show_only_logo', 'FALSE'),
('sidebar_theme', 'bg-green-dark'),
('site_appleicon', 'logo.png'),
('site_author', 'William M.'),
('site_desc', 'Freelancer Office is a Web based PHP application for Freelancers - buy it on Codecanyon'),
('site_favicon', 'logo.png'),
('site_icon', 'fa-flask'),
('smtp_encryption', ''),
('smtp_host', 'smtp.hashmi.com'),
('smtp_pass', 'test'),
('smtp_port', '25'),
('smtp_user', 'info@hashmi.com'),
('stripe_private_key', 'sk_test_g7PUZTcwwFnxdlHrWSOicHfu'),
('stripe_public_key', 'pk_test_x9as1c9jBDpODI7IbC7D0MEB'),
('stripe_status', 'active'),
('system_font', 'roboto_condensed'),
('tasks_color', '#0239c7'),
('tasks_on_calendar', 'on'),
('thousand_separator', ','),
('tickets_keyword', '0'),
('timezone', 'Asia/Dhaka'),
('training_email', '1'),
('use_gravatar', 'TRUE'),
('use_postmark', 'FALSE'),
('valid_license', 'TRUE'),
('webmaster_email', 'support@example.com'),
('website_name', 'Ultimate Project Manager CRM Pro ');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_countries`
--

CREATE TABLE IF NOT EXISTS `tbl_countries` (
  `id` int(6) NOT NULL,
  `value` varchar(250) CHARACTER SET latin1 NOT NULL DEFAULT ''
) ENGINE=MyISAM AUTO_INCREMENT=242 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `tbl_countries`
--

INSERT INTO `tbl_countries` (`id`, `value`) VALUES
(1, 'Afghanistan'),
(2, 'Aringland Islands'),
(3, 'Albania'),
(4, 'Algeria'),
(5, 'American Samoa'),
(6, 'Andorra'),
(7, 'Angola'),
(8, 'Anguilla'),
(9, 'Antarctica'),
(10, 'Antigua and Barbuda'),
(11, 'Argentina'),
(12, 'Armenia'),
(13, 'Aruba'),
(14, 'Australia'),
(15, 'Austria'),
(16, 'Azerbaijan'),
(17, 'Bahamas'),
(18, 'Bahrain'),
(19, 'Bangladesh'),
(20, 'Barbados'),
(21, 'Belarus'),
(22, 'Belgium'),
(23, 'Belize'),
(24, 'Benin'),
(25, 'Bermuda'),
(26, 'Bhutan'),
(27, 'Bolivia'),
(28, 'Bosnia and Herzegovina'),
(29, 'Botswana'),
(30, 'Bouvet Island'),
(31, 'Brazil'),
(32, 'British Indian Ocean territory'),
(33, 'Brunei Darussalam'),
(34, 'Bulgaria'),
(35, 'Burkina Faso'),
(36, 'Burundi'),
(37, 'Cambodia'),
(38, 'Cameroon'),
(39, 'Canada'),
(40, 'Cape Verde'),
(41, 'Cayman Islands'),
(42, 'Central African Republic'),
(43, 'Chad'),
(44, 'Chile'),
(45, 'China'),
(46, 'Christmas Island'),
(47, 'Cocos (Keeling) Islands'),
(48, 'Colombia'),
(49, 'Comoros'),
(50, 'Congo'),
(51, 'Congo'),
(52, ' Democratic Republic'),
(53, 'Cook Islands'),
(54, 'Costa Rica'),
(55, 'Ivory Coast (Ivory Coast)'),
(56, 'Croatia (Hrvatska)'),
(57, 'Cuba'),
(58, 'Cyprus'),
(59, 'Czech Republic'),
(60, 'Denmark'),
(61, 'Djibouti'),
(62, 'Dominica'),
(63, 'Dominican Republic'),
(64, 'East Timor'),
(65, 'Ecuador'),
(66, 'Egypt'),
(67, 'El Salvador'),
(68, 'Equatorial Guinea'),
(69, 'Eritrea'),
(70, 'Estonia'),
(71, 'Ethiopia'),
(72, 'Falkland Islands'),
(73, 'Faroe Islands'),
(74, 'Fiji'),
(75, 'Finland'),
(76, 'France'),
(77, 'French Guiana'),
(78, 'French Polynesia'),
(79, 'French Southern Territories'),
(80, 'Gabon'),
(81, 'Gambia'),
(82, 'Georgia'),
(83, 'Germany'),
(84, 'Ghana'),
(85, 'Gibraltar'),
(86, 'Greece'),
(87, 'Greenland'),
(88, 'Grenada'),
(89, 'Guadeloupe'),
(90, 'Guam'),
(91, 'Guatemala'),
(92, 'Guinea'),
(93, 'Guinea-Bissau'),
(94, 'Guyana'),
(95, 'Haiti'),
(96, 'Heard and McDonald Islands'),
(97, 'Honduras'),
(98, 'Hong Kong'),
(99, 'Hungary'),
(100, 'Iceland'),
(101, 'India'),
(102, 'Indonesia'),
(103, 'Iran'),
(104, 'Iraq'),
(105, 'Ireland'),
(106, 'Israel'),
(107, 'Italy'),
(108, 'Jamaica'),
(109, 'Japan'),
(110, 'Jordan'),
(111, 'Kazakhstan'),
(112, 'Kenya'),
(113, 'Kiribati'),
(114, 'Korea (north)'),
(115, 'Korea (south)'),
(116, 'Kuwait'),
(117, 'Kyrgyzstan'),
(118, 'Lao People''s Democratic Republic'),
(119, 'Latvia'),
(120, 'Lebanon'),
(121, 'Lesotho'),
(122, 'Liberia'),
(123, 'Libyan Arab Jamahiriya'),
(124, 'Liechtenstein'),
(125, 'Lithuania'),
(126, 'Luxembourg'),
(127, 'Macao'),
(128, 'Macedonia'),
(129, 'Madagascar'),
(130, 'Malawi'),
(131, 'Malaysia'),
(132, 'Maldives'),
(133, 'Mali'),
(134, 'Malta'),
(135, 'Marshall Islands'),
(136, 'Martinique'),
(137, 'Mauritania'),
(138, 'Mauritius'),
(139, 'Mayotte'),
(140, 'Mexico'),
(141, 'Micronesia'),
(142, 'Moldova'),
(143, 'Monaco'),
(144, 'Mongolia'),
(145, 'Montserrat'),
(146, 'Morocco'),
(147, 'Mozambique'),
(148, 'Myanmar'),
(149, 'Namibia'),
(150, 'Nauru'),
(151, 'Nepal'),
(152, 'Netherlands'),
(153, 'Netherlands Antilles'),
(154, 'New Caledonia'),
(155, 'New Zealand'),
(156, 'Nicaragua'),
(157, 'Niger'),
(158, 'Nigeria'),
(159, 'Niue'),
(160, 'Norfolk Island'),
(161, 'Northern Mariana Islands'),
(162, 'Norway'),
(163, 'Oman'),
(164, 'Pakistan'),
(165, 'Palau'),
(166, 'Palestinian Territories'),
(167, 'Panama'),
(168, 'Papua New Guinea'),
(169, 'Paraguay'),
(170, 'Peru'),
(171, 'Philippines'),
(172, 'Pitcairn'),
(173, 'Poland'),
(174, 'Portugal'),
(175, 'Puerto Rico'),
(176, 'Qatar'),
(177, 'Runion'),
(178, 'Romania'),
(179, 'Russian Federation'),
(180, 'Rwanda'),
(181, 'Saint Helena'),
(182, 'Saint Kitts and Nevis'),
(183, 'Saint Lucia'),
(184, 'Saint Pierre and Miquelon'),
(185, 'Saint Vincent and the Grenadines'),
(186, 'Samoa'),
(187, 'San Marino'),
(188, 'Sao Tome and Principe'),
(189, 'Saudi Arabia'),
(190, 'Senegal'),
(191, 'Serbia and Montenegro'),
(192, 'Seychelles'),
(193, 'Sierra Leone'),
(194, 'Singapore'),
(195, 'Slovakia'),
(196, 'Slovenia'),
(197, 'Solomon Islands'),
(198, 'Somalia'),
(199, 'South Africa'),
(200, 'South Georgia and the South Sandwich Islands'),
(201, 'Spain'),
(202, 'Sri Lanka'),
(203, 'Sudan'),
(204, 'Suriname'),
(205, 'Svalbard and Jan Mayen Islands'),
(206, 'Swaziland'),
(207, 'Sweden'),
(208, 'Switzerland'),
(209, 'Syria'),
(210, 'Taiwan'),
(211, 'Tajikistan'),
(212, 'Tanzania'),
(213, 'Thailand'),
(214, 'Togo'),
(215, 'Tokelau'),
(216, 'Tonga'),
(217, 'Trinidad and Tobago'),
(218, 'Tunisia'),
(219, 'Turkey'),
(220, 'Turkmenistan'),
(221, 'Turks and Caicos Islands'),
(222, 'Tuvalu'),
(223, 'Uganda'),
(224, 'Ukraine'),
(225, 'United Arab Emirates'),
(226, 'United Kingdom'),
(227, 'United States of America'),
(228, 'Uruguay'),
(229, 'Uzbekistan'),
(230, 'Vanuatu'),
(231, 'Vatican City'),
(232, 'Venezuela'),
(233, 'Vietnam'),
(234, 'Virgin Islands (British)'),
(235, 'Virgin Islands (US)'),
(236, 'Wallis and Futuna Islands'),
(237, 'Western Sahara'),
(238, 'Yemen'),
(239, 'Zaire'),
(240, 'Zambia'),
(241, 'Zimbabwe');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_currencies`
--

CREATE TABLE IF NOT EXISTS `tbl_currencies` (
  `code` varchar(5) COLLATE utf8_unicode_ci NOT NULL,
  `name` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `symbol` varchar(5) COLLATE utf8_unicode_ci DEFAULT NULL,
  `xrate` decimal(12,5) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `tbl_currencies`
--

INSERT INTO `tbl_currencies` (`code`, `name`, `symbol`, `xrate`) VALUES
('AUD', 'Australian Dollar', '$', NULL),
('BAN', 'Bangladesh', 'BDT', NULL),
('BRL', 'Brazilian Real', 'R$', NULL),
('CAD', 'Canadian Dollar', '$', NULL),
('CHF', 'Swiss Franc', 'Fr', NULL),
('CLP', 'Chilean Peso', '$', NULL),
('CNY', 'Chinese Yuan', '?', NULL),
('CZK', 'Czech Koruna', 'K??', NULL),
('DKK', 'Danish Krone', 'kr', NULL),
('EUR', 'Euro', '?', NULL),
('GBP', 'British Pound', '?', NULL),
('HKD', 'Hong Kong Dollar', '$', NULL),
('HUF', 'Hungarian Forint', 'Ft', NULL),
('IDR', 'Indonesian Rupiah', 'Rp', NULL),
('ILS', 'Israeli New Shekel', '?', NULL),
('INR', 'Indian Rupee', 'INR', NULL),
('JPY', 'Japanese Yen', '?', NULL),
('KRW', 'Korean Won', '?', NULL),
('MXN', 'Mexican Peso', '$', NULL),
('MYR', 'Malaysian Ringgit', 'RM', NULL),
('NOK', 'Norwegian Krone', 'kr', NULL),
('NZD', 'New Zealand Dollar', '$', NULL),
('PHP', 'Philippine Peso', '?', NULL),
('PKR', 'Pakistan Rupee', '?', NULL),
('PLN', 'Polish Zloty', 'zl', NULL),
('RUB', 'Russian Ruble', '?', NULL),
('SEK', 'Swedish Krona', 'kr', NULL),
('SGD', 'Singapore Dollar', '$', NULL),
('THB', 'Thai Baht', '?', NULL),
('TRY', 'Turkish Lira', '?', NULL),
('TWD', 'Taiwan Dollar', '$', NULL),
('USD', 'US Dollar', '$', '1.00000'),
('VEF', 'Bol?var Fuerte', 'Bs.', NULL),
('ZAR', 'South African Rand', 'R', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_custom_field`
--

CREATE TABLE IF NOT EXISTS `tbl_custom_field` (
  `custom_field_id` int(11) NOT NULL,
  `form_id` int(11) DEFAULT NULL,
  `field_label` varchar(100) NOT NULL,
  `default_value` text,
  `help_text` varchar(200) NOT NULL,
  `field_type` enum('text','textarea','dropdown','date','checkbox','numeric','url') NOT NULL,
  `required` varchar(5) NOT NULL DEFAULT 'false',
  `status` enum('active','deactive') NOT NULL DEFAULT 'deactive',
  `show_on_details` varchar(5) NOT NULL DEFAULT ''
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_days`
--

CREATE TABLE IF NOT EXISTS `tbl_days` (
  `day_id` int(5) NOT NULL,
  `day` varchar(100) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `tbl_days`
--

INSERT INTO `tbl_days` (`day_id`, `day`) VALUES
(1, 'Saturday'),
(2, 'Sunday'),
(3, 'Monday'),
(4, 'Tuesday'),
(5, 'Wednesday'),
(6, 'Thursday'),
(7, 'Friday');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_departments`
--

CREATE TABLE IF NOT EXISTS `tbl_departments` (
  `departments_id` int(10) NOT NULL,
  `deptname` varchar(200) COLLATE utf8_unicode_ci DEFAULT NULL,
  `department_head_id` int(11) DEFAULT NULL COMMENT 'department_head_id == user_id'
) ENGINE=MyISAM AUTO_INCREMENT=9 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `tbl_departments`
--

INSERT INTO `tbl_departments` (`departments_id`, `deptname`, `department_head_id`) VALUES
(1, 'PHP', 1);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_designations`
--

CREATE TABLE IF NOT EXISTS `tbl_designations` (
  `designations_id` int(5) NOT NULL,
  `departments_id` int(11) NOT NULL,
  `designations` varchar(100) NOT NULL,
  `permission` text
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `tbl_designations`
--

INSERT INTO `tbl_designations` (`designations_id`, `departments_id`, `designations`, `permission`) VALUES
(1, 1, 'Admin', NULL),
(2, 1, 'Staff', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_discipline`
--

CREATE TABLE IF NOT EXISTS `tbl_discipline` (
  `discipline_id` int(5) NOT NULL,
  `user_id` int(11) NOT NULL,
  `offence_id` int(5) NOT NULL,
  `penalty_id` int(5) NOT NULL,
  `discipline_break_date` varchar(100) NOT NULL,
  `discipline_action_date` varchar(100) NOT NULL,
  `discipline_remarks` varchar(200) NOT NULL,
  `discipline_comments` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_draft`
--

CREATE TABLE IF NOT EXISTS `tbl_draft` (
  `draft_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `to` text NOT NULL,
  `subject` varchar(300) NOT NULL,
  `message_body` text NOT NULL,
  `attach_file` varchar(200) DEFAULT NULL,
  `attach_file_path` text,
  `attach_filename` text,
  `message_time` datetime NOT NULL,
  `deleted` enum('Yes','No') NOT NULL DEFAULT 'No'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_email_templates`
--

CREATE TABLE IF NOT EXISTS `tbl_email_templates` (
  `email_templates_id` int(11) NOT NULL,
  `email_group` varchar(150) COLLATE utf8_unicode_ci NOT NULL,
  `subject` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `template_body` text COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=60 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `tbl_email_templates`
--

INSERT INTO `tbl_email_templates` (`email_templates_id`, `email_group`, `subject`, `template_body`) VALUES
(1, 'registration', 'Registration successful', '<div style="height: 7px; background-color: #535353;"></div><div style="background-color:#E8E8E8; margin:0px; padding:55px 20px 40px 20px; font-family:Open Sans, Helvetica, sans-serif; font-size:12px; color:#535353;"><div style="text-align:center; font-size:24px; font-weight:bold; color:#535353;">Welcome to {SITE_NAME}</div><div style="border-radius: 5px 5px 5px 5px; padding:20px; margin-top:45px; background-color:#FFFFFF; font-family:Open Sans, Helvetica, sans-serif; font-size:13px;">Thanks for joining {SITE_NAME}. We listed your sign in details below, make sure you keep them safe.<br>To open your {SITE_NAME} homepage, please follow this link:<br><big><b><a href="{SITE_URL}">{SITE_NAME} Account!</a></b></big><br>Link doesn''t work? Copy the following link to your browser address bar:<br><a href="{SITE_URL}">{SITE_URL}</a><br>Your username: {USERNAME}<br>Your email address: {EMAIL}<br>Your password: {PASSWORD}<br>Have fun!<br>The {SITE_NAME} Team.<br><br></div></div>'),
(2, 'forgot_password', 'Forgot Password', '        <div style="height: 7px; background-color: #535353;"></div><div style="background-color:#E8E8E8; margin:0px; padding:55px 20px 40px 20px; font-family:Open Sans, Helvetica, sans-serif; font-size:12px; color:#535353;"><div style="text-align:center; font-size:24px; font-weight:bold; color:#535353;">New Password</div><div style="border-radius: 5px 5px 5px 5px; padding:20px; margin-top:45px; background-color:#FFFFFF; font-family:Open Sans, Helvetica, sans-serif; font-size:13px;">Forgot your password, huh? No big deal.<br>To create a new password, just follow this link:<br><br><big><b><a href="{PASS_KEY_URL}">Create a new password</a></b></big><br>Link doesn''t work? Copy the following link to your browser address bar:<br><a href="{PASS_KEY_URL}">{PASS_KEY_URL}</a><br><br><br>You received this email, because it was requested by a <a href="{SITE_URL}">{SITE_NAME}</a> user. <p></p><p>This is part of the procedure to create a new password on the system. If you DID NOT request a new password then please ignore this email and your password will remain the same.</p><br>Thank you,<br>The {SITE_NAME} Team</div></div>'),
(3, 'change_email', 'Change Email', '<div style="height: 7px; background-color: #535353;"></div>\r\n<div style="background-color:#E8E8E8; margin:0px; padding:55px 20px 40px 20px; font-family:Open Sans, Helvetica, sans-serif; font-size:12px; color:#535353;"><div style="text-align:center; font-size:24px; font-weight:bold; color:#535353;">New email address on {SITE_NAME}</div>\r\n\r\n<div style="border-radius: 5px 5px 5px 5px; padding:20px; margin-top:45px; background-color:#FFFFFF; font-family:Open Sans, Helvetica, sans-serif; font-size:13px;">You have changed your email address for {SITE_NAME}.<br>Follow this link to confirm your new email address:<br><big><b><a href="{NEW_EMAIL_KEY_URL}">Confirm your new email</a></b></big><br>Link doesn''t work? Copy the following link to your browser address bar:<br><a href="{NEW_EMAIL_KEY_URL}">{NEW_EMAIL_KEY_URL}</a><br><br>Your email address: {NEW_EMAIL}<br><br>You received this email, because it was requested by a <a href="{SITE_URL}">{SITE_NAME}</a> user. If you have received this by mistake, please DO NOT click the confirmation link, and simply delete this email. After a short time, the request will be removed from the system.<br>Thank you,<br>The {SITE_NAME} Team</div>\r\n\r\n</div>'),
(4, 'activate_account', 'Activate Account', '<p>Welcome to {SITE_NAME}!</p>\r\n\r\n<p>Thanks for joining {SITE_NAME}. We listed your sign in details below, make sure you keep them safe.</p>\r\n\r\n<p>To verify your email address, please follow this link:<br />\r\n<big><strong><a href="{ACTIVATE_URL}">Finish your registration...</a></strong></big><br />\r\nLink doesn&#39;t work? Copy the following link to your browser address bar:<br />\r\n<a href="{ACTIVATE_URL}">{ACTIVATE_URL}</a></p>\r\n\r\n<p><br />\r\n<br />\r\nPlease verify your email within {ACTIVATION_PERIOD} hours, otherwise your registration will become invalid and you will have to register again.<br />\r\n<br />\r\n<br />\r\nYour username: {USERNAME}<br />\r\nYour email address: {EMAIL}<br />\r\nYour password: {PASSWORD}<br />\r\n<br />\r\nHave fun!<br />\r\nThe {SITE_NAME} Team</p>\r\n'),
(5, 'reset_password', 'Reset Password', '<div style="height: 7px; background-color: #535353;"></div>\r\n<div style="background-color:#E8E8E8; margin:0px; padding:55px 20px 40px 20px; font-family:Open Sans, Helvetica, sans-serif; font-size:12px; color:#535353;"><div style="text-align:center; font-size:24px; font-weight:bold; color:#535353;">New password on {SITE_NAME}</div>\r\n<div style="border-radius: 5px 5px 5px 5px; padding:20px; margin-top:45px; background-color:#FFFFFF; font-family:Open Sans, Helvetica, sans-serif; font-size:13px;"><p>You have changed your password.<br>Please, keep it in your records so you don''t forget it.<br></p>\r\nYour username: {USERNAME}<br>Your email address: {EMAIL}<br>Your new password: {NEW_PASSWORD}<br><br>Thank you,<br>The {SITE_NAME} Team</div>\r\n</div>'),
(6, 'bug_assigned', 'New Bug Assigned', '<p>Hi there,</p>\r\n\r\n<p>A new bug &nbsp;{BUG_TITLE} &nbsp;has been assigned to you by {ASSIGNED_BY}.</p>\r\n\r\n<p>You can view this bug by logging in to the portal using the link below.</p>\r\n\r\n<p><br />\r\n<big><strong><a href="{BUG_URL}">View Bug</a></strong></big><br />\r\n<br />\r\nRegards<br />\r\nThe {SITE_NAME} Team</p>\r\n'),
(7, 'bug_updated', 'Bug status changed', '<p>Hi there,</p>\r\n\r\n<p>Bug {BUG_TITLE} has been marked as {STATUS} by {MARKED_BY}.</p>\r\n\r\n<p>You can view this bug by logging in to the portal using the link below.</p>\r\n\r\n<p><big><strong><a href="{BUG_URL}">View Bug</a></strong></big><br />\r\nRegards<br />\r\nThe {SITE_NAME} Team</p>\r\n\r\n<p>&nbsp;</p>\r\n'),
(8, 'bug_comments', 'New Bug Comment Received', '<p>Hi there,</p>\r\n\r\n<p>A new comment has been posted by {POSTED_BY} to bug {BUG_TITLE}.</p>\r\n\r\n<p>You can view the comment using the link below.</p>\r\n\r\n<p><em>{COMMENT_MESSAGE}</em></p>\r\n\r\n<p><br />\r\n<big><strong><a href="{COMMENT_URL}">View Comment</a></strong></big><br />\r\nRegards<br />\r\nThe {SITE_NAME} Team</p>\r\n\r\n<p>&nbsp;</p>\r\n'),
(9, 'bug_attachment', 'New bug attachment', '<p>Hi there,</p>\r\n\r\n<p>A new attachment&nbsp;has been uploaded by {UPLOADED_BY} to issue {BUG_TITLE}.</p>\r\n\r\n<p>You can view the bug using the link below.</p>\r\n\r\n<p><br />\r\n<big><strong><a href="{BUG_URL}">View Bug</a></strong></big></p>\r\n\r\n<p><br />\r\nRegards<br />\r\nThe {SITE_NAME} Team</p>\r\n'),
(10, 'bug_reported', 'New bug Reported', '<p>Hi there,</p>\r\n\r\n<p>A new bug ({BUG_TITLE}) has been reported by {ADDED_BY}.</p>\r\n\r\n<p>You can view the Bug using the Dashboard Page.</p>\r\n\r\n<p><br />\r\n<big><strong><a href="{BUG_URL}">View Bug</a></strong></big></p>\r\n\r\n<p><br />\r\nRegards<br />\r\nThe {SITE_NAME} Team</p>\r\n'),
(13, 'refund_confirmation', 'Refund Confirmation', '<p>Refund Confirmation</p>\r\n\r\n<p>Hello {CLIENT}</p>\r\n\r\n<p>This is confirmation that a refund has been processed for Invoice&nbsp; of {CURRENCY} {AMOUNT}&nbsp;sent on {INVOICE_DATE}.<br />\r\nYou can view the invoice online at:<br />\r\n<big><strong><a href="{INVOICE_LINK}">View Invoice</a></strong></big><br />\r\n<br />\r\nBest Regards,<br />\r\nThe {SITE_NAME} Team</p>\r\n'),
(14, 'payment_confirmation', 'Payment Confirmation', '<p>Payment Confirmation</p>\r\n\r\n<p>Hello {CLIENT}</p>\r\n\r\n<p>This is a payment receipt for your invoice of {CURRENCY} {AMOUNT}&nbsp;sent on {INVOICE_DATE}.<br />\r\nYou can view the invoice online at:<br />\r\n<big><strong><a href="{INVOICE_LINK}">View Invoice</a></strong></big><br />\r\n<br />\r\nBest Regards,<br />\r\nThe {SITE_NAME} Team</p>\r\n'),
(15, 'payment_email', 'Payment Received', '<div style="height: 7px; background-color: #535353;"></div>\n<div style="background-color:#E8E8E8; margin:0px; padding:55px 20px 40px 20px; font-family:Open Sans, Helvetica, sans-serif; font-size:12px; color:#535353;"><div style="text-align:center; font-size:24px; font-weight:bold; color:#535353;">Payment Received</div>\n<div style="border-radius: 5px 5px 5px 5px; padding:20px; margin-top:45px; background-color:#FFFFFF; font-family:Open Sans, Helvetica, sans-serif; font-size:13px;"><p>Dear Customer</p>\n<p>We have received your payment of {INVOICE_CURRENCY} {PAID_AMOUNT}. </p>\n<p>Thank you for your Payment and business. We look forward to working with you again.</p>\n--------------------------<br>Regards<br>The {SITE_NAME} Team</div>\n</div>'),
(16, 'invoice_overdue_email', 'Invoice Overdue Notice', '<p>Invoice Overdue</p>\r\n\r\n<p>INVOICE {REF}</p>\r\n\r\n<p><strong>Hello {CLIENT}</strong></p>\r\n\r\n<p>This is the notice that your invoice overdue.&nbsp;The invoice {CURRENCY} {AMOUNT}. and Due Date: {DUE_DATE}</p>\r\n\r\n<p>You can view the invoice online at:<br />\r\n<big><strong><a href="{INVOICE_LINK}">View Invoice</a></strong></big><br />\r\n<br />\r\nBest Regards,<br />\r\nThe {SITE_NAME} Team</p>\r\n\r\n<p>&nbsp;</p>\r\n'),
(17, 'invoice_message', 'New Invoice', '<div style="height: 7px; background-color: #535353;"></div><div style="background-color:#E8E8E8; margin:0px; padding:55px 20px 40px 20px; font-family:Open Sans, Helvetica, sans-serif; font-size:12px; color:#535353;"><div style="text-align:center; font-size:24px; font-weight:bold; color:#535353;">INVOICE {REF}</div><div style="border-radius: 5px 5px 5px 5px; padding:20px; margin-top:45px; background-color:#FFFFFF; font-family:Open Sans, Helvetica, sans-serif; font-size:13px;"><span class="style1"><span style="font-weight:bold;">Hello {CLIENT}</span></span><br><br>Here is the invoice of {CURRENCY} {AMOUNT}.<br><br>You can view the invoice online at:<br><big><b><a href="{INVOICE_LINK}">View Invoice</a></b></big><br><br>Best Regards<br><br>The {SITE_NAME} Team</div></div>'),
(18, 'invoice_reminder', 'Invoice Reminder', '<div style="height: 7px; background-color: #535353;"></div>\r\n<div style="background-color:#E8E8E8; margin:0px; padding:55px 20px 40px 20px; font-family:Open Sans, Helvetica, sans-serif; font-size:12px; color:#535353;"><div style="text-align:center; font-size:24px; font-weight:bold; color:#535353;">Invoice Reminder</div>\r\n<div style="border-radius: 5px 5px 5px 5px; padding:20px; margin-top:45px; background-color:#FFFFFF; font-family:Open Sans, Helvetica, sans-serif; font-size:13px;"><p>Hello {CLIENT}</p>\r\n<br><p>This is a friendly reminder to pay your invoice of {CURRENCY} {AMOUNT}<br>You can view the invoice online at:<br><big><b><a href="{INVOICE_LINK}">View Invoice</a></b></big><br><br>Best Regards,<br>The {SITE_NAME} Team</p>\r\n</div>\r\n</div>'),
(19, 'message_received', 'Message Received', '<div style="height: 7px; background-color: #535353;"></div>\r\n<div style="background-color:#E8E8E8; margin:0px; padding:55px 20px 40px 20px; font-family:Open Sans, Helvetica, sans-serif; font-size:12px; color:#535353;"><div style="text-align:center; font-size:24px; font-weight:bold; color:#535353;">Message Received</div>\r\n<div style="border-radius: 5px 5px 5px 5px; padding:20px; margin-top:45px; background-color:#FFFFFF; font-family:Open Sans, Helvetica, sans-serif; font-size:13px;"><p>Hi {RECIPIENT},</p>\r\n<p>You have received a message from {SENDER}. </p>\r\n------------------------------------------------------------------<br><blockquote>\r\n{MESSAGE}</blockquote>\r\n<big><b><a href="{SITE_URL}">Go to Account</a></b></big><br><br>Regards<br>The {SITE_NAME} Team</div>\r\n</div>'),
(20, 'estimate_email', 'New Estimate', '<p>Estimate {ESTIMATE_REF}</p>\r\n\r\n<p>Hi {CLIENT}</p>\r\n\r\n<p>Thanks for your business inquiry.</p>\r\n\r\n<p>The estimate {ESTIMATE_REF} is attached with this email.<br />\r\nEstimate Overview:<br />\r\nEstimate # : {ESTIMATE_REF}<br />\r\nAmount: {CURRENCY} {AMOUNT}<br />\r\n<br />\r\nYou can view the estimate online at:<br />\r\n<big><strong><a href="{ESTIMATE_LINK}">View Estimate</a></strong></big><br />\r\n<br />\r\nBest Regards,<br />\r\nThe {SITE_NAME} Team</p>\r\n'),
(21, 'ticket_staff_email', 'New Ticket [TICKET_CODE]', '<div style="height: 7px; background-color: #535353;"></div>\r\n<div style="background-color:#E8E8E8; margin:0px; padding:55px 20px 40px 20px; font-family:Open Sans, Helvetica, sans-serif; font-size:12px; color:#535353;"><div style="text-align:center; font-size:24px; font-weight:bold; color:#535353;">New Ticket</div>\r\n<div style="border-radius: 5px 5px 5px 5px; padding:20px; margin-top:45px; background-color:#FFFFFF; font-family:Open Sans, Helvetica, sans-serif; font-size:13px;"><p>Ticket #{TICKET_CODE} has been created by the client.</p>\r\n<p>You may view the ticket by clicking on the following link <br><br>  Client Email : {REPORTER_EMAIL}<br><br> <big><b><a href="{TICKET_LINK}">View Ticket</a></b></big> <br><br>Regards<br><br>{SITE_NAME}</p>\r\n</div>\r\n</div>'),
(22, 'ticket_client_email', 'Ticket [TICKET_CODE] Opened', '<p>Ticket Opened</p>\r\n\r\n<p>Hello {CLIENT_EMAIL},</p>\r\n\r\n<p>Your ticket has been opened with us.<br />\r\n<br />\r\nTicket # {TICKET_CODE}<br />\r\nStatus : Open<br />\r\n<br />\r\nClick on the below link to see the ticket details and post additional comments.<br />\r\n<br />\r\n<big><strong><a href="{TICKET_LINK}">View Ticket</a></strong></big><br />\r\n<br />\r\nRegards<br />\r\n<br />\r\nThe {SITE_NAME} Team</p>\r\n'),
(23, 'ticket_reply_email', 'Ticket [TICKET_CODE] Response', '<div style="height: 7px; background-color: #535353;"></div>\r\n<div style="background-color:#E8E8E8; margin:0px; padding:55px 20px 40px 20px; font-family:Open Sans, Helvetica, sans-serif; font-size:12px; color:#535353;"><div style="text-align:center; font-size:24px; font-weight:bold; color:#535353;">Ticket Response</div>\r\n<div style="border-radius: 5px 5px 5px 5px; padding:20px; margin-top:45px; background-color:#FFFFFF; font-family:Open Sans, Helvetica, sans-serif; font-size:13px;"><p>A new response has been added to Ticket #{TICKET_CODE}<br><br> Ticket : #{TICKET_CODE} <br>Status : {TICKET_STATUS} <br><br></p>\r\nTo see the response and post additional comments, click on the link below.<br><br>         <big><b><a href="{TICKET_LINK}">View Reply</a> </b></big><br><br>          Note: Do not reply to this email as this email is not monitored.<br><br>     Regards<br>The {SITE_NAME} Team<br></div>\r\n</div>'),
(24, 'ticket_closed_email', 'Ticket [TICKET_CODE] Closed', '<div style="height: 7px; background-color: #535353;"></div>\r\n<div style="background-color:#E8E8E8; margin:0px; padding:55px 20px 40px 20px; font-family:Open Sans, Helvetica, sans-serif; font-size:12px; color:#535353;"><div style="text-align:center; font-size:24px; font-weight:bold; color:#535353;">Ticket Closed</div>\r\n<div style="border-radius: 5px 5px 5px 5px; padding:20px; margin-top:45px; background-color:#FFFFFF; font-family:Open Sans, Helvetica, sans-serif; font-size:13px;">Hi {REPORTER_EMAIL}<br><br>Ticket #{TICKET_CODE} has been closed by {STAFF_USERNAME} <br><br>          Ticket : #{TICKET_CODE} <br>     Status : {TICKET_STATUS}<br><br>Replies : {NO_OF_REPLIES}<br><br>          To see the responses or open the ticket, click on the link below.<br><br>          <big><b><a href="{TICKET_LINK}">View Ticket</a></b></big> <br><br>          Note: Do not reply to this email as this email is not monitored.<br><br>    Regards<br>The {SITE_NAME} Team</div>\r\n</div>'),
(26, 'task_updated', 'Task updated', '<div style="height: 7px; background-color: #535353;"></div>\r\n<div style="background-color:#E8E8E8; margin:0px; padding:55px 20px 40px 20px; font-family:Open Sans, Helvetica, sans-serif; font-size:12px; color:#535353;"><div style="text-align:center; font-size:24px; font-weight:bold; color:#535353;">Task updated</div>\r\n<div style="border-radius: 5px 5px 5px 5px; padding:20px; margin-top:45px; background-color:#FFFFFF; font-family:Open Sans, Helvetica, sans-serif; font-size:13px;"><p>Hi there,</p>\r\n<p>{TASK_NAME} in {PROJECT_TITLE} has been updated by {ASSIGNED_BY}.</p>\r\n<p>You can view this project by logging in to the portal using the link below.</p>\r\n-----------------------------------<br><big><b><a href="{PROJECT_URL}">View Project</a></b></big><br><br>Regards<br>The {SITE_NAME} Team</div>\r\n</div>'),
(27, 'quotations_form', 'Your Quotation Request', '<p>QUOTATION</p>\r\n\r\n<p><strong>Hello {CLIENT}</strong><br />\r\n&nbsp;</p>\r\n\r\n<p>Thank you for you for filling in our Quotation Request Form.<br />\r\n<br />\r\nPlease find below are our quotation:</p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<table cellpadding="8" style="width:100%">\r\n	<tbody>\r\n		<tr>\r\n			<td>Quotation Date</td>\r\n			<td><strong>{DATE}</strong></td>\r\n		</tr>\r\n		<tr>\r\n			<td>Our Quotation</td>\r\n			<td><strong>{CURRENCY} {AMOUNT}</strong></td>\r\n		</tr>\r\n		<tr>\r\n			<td>Addtitional Comments</td>\r\n			<td><strong>{NOTES}</strong></td>\r\n		</tr>\r\n	</tbody>\r\n</table>\r\n\r\n<p><br />\r\nYou can view the estimate online at:<br />\r\n<big><strong><a href="{QUOTATION LINK}">View Quotation</a></strong></big></p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p><br />\r\nThank you and we look forward to working with you.<br />\r\n<br />\r\nBest Regards,<br />\r\nThe {SITE_NAME} Team</p>\r\n\r\n<p>&nbsp;</p>\r\n'),
(28, 'client_notification', 'New project created', '<p>Hello, <strong>{CLIENT_NAME}</strong>,<br />\r\nwe have created a new project with your account.<br />\r\n<br />\r\nProject name : <strong>{PROJECT_NAME}</strong><br />\r\nYou can login to see the status of your project by using this link:<br />\r\n<big><a href="{PROJECT_LINK}"><strong>View Project</strong></a></big></p>\r\n\r\n<p><br />\r\nBest Regards<br />\r\n<br />\r\nThe {SITE_NAME} Team</p>\r\n\r\n<p>&nbsp;</p>\r\n'),
(29, 'assigned_project', 'Assigned Project', '<p>Hi There,</p>\r\n\r\n<p>A<strong> {PROJECT_NAME}</strong> has been assigned by <strong>{ASSIGNED_BY} </strong>to you.You can view this project by logging in to the portal using the link below:<br />\r\n<big><a href="{PROJECT_URL}"><strong>View Project</strong></a></big><br />\r\n<br />\r\nBest Regards<br />\r\nThe {SITE_NAME} Team</p>\r\n\r\n<p>&nbsp;</p>\r\n'),
(30, 'complete_projects', 'Project Completed', '<p>Hi <strong>{CLIENT_NAME}</strong>,</p>\r\n\r\n<p>Project : <strong>{PROJECT_NAME}</strong> &nbsp;has been completed.<br />\r\nYou can view the project by logging into your portal Account:<br />\r\n<big><a href="{PROJECT_LINK}"><strong>View Project</strong></a></big><br />\r\n<br />\r\nBest Regards,<br />\r\nThe {SITE_NAME} Team</p>\r\n'),
(31, 'project_comments', 'New Project Comment Received', '<p>Hi There,</p>\r\n\r\n<p>A new comment has been posted by <strong>{POSTED_BY}</strong> to project <strong>{PROJECT_NAME}</strong>.</p>\r\n\r\n<p>You can view the comment using the link below:<br />\r\n<big><a href="{COMMENT_URL}"><strong>View Project</strong></a></big><br />\r\n<br />\r\n<em>{COMMENT_MESSAGE}</em><br />\r\n<br />\r\nBest Regards,<br />\r\nThe {SITE_NAME} Team</p>\r\n'),
(32, 'project_attachment', 'New Project  Attachment', '<p>Hi There,</p>\r\n\r\n<p>A new file has been uploaded by <strong>{UPLOADED_BY}</strong> to project <strong>{PROJECT_NAME}</strong>.<br />\r\nYou can view the Project using the link below:<br />\r\n<big><a href="{PROJECT_URL}"><strong>View Project</strong></a></big><br />\r\n<br />\r\n<br />\r\nBest Regards,<br />\r\nThe {SITE_NAME} Team</p>\r\n'),
(33, 'responsible_milestone', 'Responsible for a Milestone', '<p>Hi There,</p>\r\n\r\n<p>You are a responsible&nbsp;for a project milestone&nbsp;<strong>{MILESTONE_NAME}</strong>&nbsp; assigned to you by <strong>{ASSIGNED_BY}</strong> in project <strong>{PROJECT_NAME}</strong>.</p>\r\n\r\n<p>You can view this Milestone&nbsp;by logging in to the portal using the link below:<br />\r\n<big><strong><a href="{PROJECT_URL}">View Project</a></strong></big><br />\r\n<br />\r\n<br />\r\nBest Regards,<br />\r\nThe {SITE_NAME} Team</p>\r\n'),
(34, 'task_assigned', 'Task assigned', '<p>Hi there,</p>\r\n\r\n<p>A new task <strong>{TASK_NAME}</strong> &nbsp;has been assigned to you by <strong>{ASSIGNED_BY}</strong>.</p>\r\n\r\n<p>You can view this task by logging in to the portal using the link below.</p>\r\n\r\n<p><br />\r\n<big><strong><a href="{TASK_URL}">View Task</a></strong></big><br />\r\n<br />\r\nRegards<br />\r\nThe {SITE_NAME} Team</p>\r\n'),
(35, 'tasks_comments', 'New Task Comment Received', '<p>Hi There,</p>\r\n\r\n<p>A new comment has been posted by <strong>{POSTED_BY}</strong> to <strong>{TASK_NAME}</strong>.</p>\r\n\r\n<p>You can view the comment using the link below:<br />\r\n<big><strong><a href="{COMMENT_URL}">View Comment</a></strong></big><br />\r\n<br />\r\n<em>{COMMENT_MESSAGE}</em><br />\r\n<br />\r\nBest Regards,<br />\r\nThe {SITE_NAME} Team</p>\r\n'),
(36, 'tasks_attachment', 'New Tasks Attachment', '<p>Hi There,</p>\r\n\r\n<p>A new file has been uploaded by <strong>{UPLOADED_BY} </strong>to Task <strong>{TASK_NAME}</strong>.<br />\r\nYou can view the Task&nbsp;using the link below:</p>\r\n\r\n<p><br />\r\n<big><a href="{TASK_URL}"><strong>View Task</strong></a></big><br />\r\n<br />\r\nBest Regards,<br />\r\nThe {SITE_NAME} Team</p>\r\n'),
(37, 'tasks_updated', 'Task updated', '<p>Hi there,</p>\r\n\r\n<p><strong>{TASK_NAME}</strong> has been updated by <strong>{ASSIGNED_BY}</strong>.</p>\r\n\r\n<p>You can view this Task by logging in to the portal using the link below.</p>\r\n\r\n<p><br />\r\n<big><strong><a href="{TASK_URL}">View Task</a></strong></big><br />\r\n<br />\r\nRegards<br />\r\nThe {SITE_NAME} Team</p>\r\n'),
(38, 'goal_not_achieve', 'Not Achieve Goal', '<p><strong>Unfortunately!</strong> We failed to achieve goal!</p>\r\n\r\n<p><strong>Here is a Goal Details</strong></p>\r\n\r\n<p>Goal Type :&nbsp;<strong>{Goal_Type}</strong><br />\r\nTarget Achievement:&nbsp;<strong>{achievement}</strong><br />\r\nTotal Achievement:&nbsp;<strong>{total_achievement}</strong><br />\r\nStart Date:&nbsp;<strong>{start_date}</strong><br />\r\nEnd Date:&nbsp;<strong>{End_date}</strong><br />\r\n&nbsp;</p>\r\n\r\n<p>&nbsp;</p>\r\n'),
(39, 'goal_achieve', 'Achieve Goal', '<p><strong>Congratulation!</strong> We achieved new goal.</p>\r\n\r\n<p><strong>Here is a Goal Details</strong></p>\r\n\r\n<p>Goal Type :<strong>{Goal_Type}</strong><br />\r\nTarget Achievement:<strong>{achievement}</strong><br />\r\nTotal Achievement:<strong>{total_achievement}</strong><br />\r\nStart Date:<strong>{start_date}</strong><br />\r\nEnd Date:<strong>{End_date}</strong><br />\r\n&nbsp;</p>\r\n\r\n<p>&nbsp;</p>\r\n'),
(40, 'leave_request_email', 'A Leave Request from you', '<p>Hi there,</p>\r\n\r\n<p><strong>{NAME}</strong> &nbsp;Want to leave from you.</p>\r\n\r\n<p>You can view this leave request by logging in to the portal using the link below.ÃƒÆ’Ã†â€™Ãƒâ€ Ã¢â‚¬â„¢ÃƒÆ’Ã¢â‚¬Å¡Ãƒâ€šÃ‚Â¢ÃƒÆ’Ã†â€™Ãƒâ€šÃ‚Â¢ÃƒÆ’Ã‚Â¢ÃƒÂ¢Ã¢â‚¬Å¡Ã‚Â¬Ãƒâ€¦Ã‚Â¡ÃƒÆ’Ã¢â‚¬Å¡Ãƒâ€šÃ‚Â¬ÃƒÆ’Ã†â€™Ãƒâ€šÃ‚Â¢ÃƒÆ’Ã‚Â¢ÃƒÂ¢Ã¢â€šÂ¬Ã…Â¡Ãƒâ€šÃ‚Â¬ÃƒÆ’Ã¢â‚¬Å¡Ãƒâ€šÃ‚Â¹<br />\r\n<br />\r\n<big><strong><a href="{APPLICATION_LINK}">View Application</a></strong></big><br />\r\n<br />\r\n<br />\r\nRegards<br />\r\n<br />\r\nThe {SITE_NAME} Team</p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p>&nbsp;</p>\r\n'),
(41, 'leave_approve_email', 'Your leave request has been approved', '<h1>Your leave request has been approved</h1>\r\n\r\n<p><strong>Congratulations!</strong> Your leave request from <strong>{START_DATE}</strong> to <strong>{END_DATE}</strong> has been approved by your company management.</p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p><br />\r\nRegards<br />\r\n<br />\r\nThe {SITE_NAME} Team</p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p>&nbsp;</p>\r\n'),
(42, 'leave_reject_email', 'Your leave request has been Rejected', '<h1>Your leave request has been Rejected</h1>\r\n\r\n<p><strong>Unfortunately !</strong>&nbsp;Your leave request from&nbsp;<strong>{START_DATE}</strong>&nbsp;to&nbsp;<strong>{END_DATE}</strong>&nbsp;has been Rejected by your company management.</p>\r\n\r\n<p><br />\r\nRegards<br />\r\n<br />\r\nThe {SITE_NAME} Team</p>\r\n'),
(43, 'overtime_request_email', 'Overtime Request', '<p>Hi there,</p>\r\n\r\n<p><strong>{NAME}</strong>&nbsp;&nbsp;to do an overtime.<br />\r\n<br />\r\n<br />\r\nRegards<br />\r\n<br />\r\nThe {SITE_NAME} Team</p>\r\n'),
(44, 'overtime_approved_email', 'Your overtime request has been approved', '<h1>Your leave request has been approved</h1>\r\n\r\n<p><strong>Congratulations!</strong>&nbsp;Your overtime&nbsp;request at&nbsp;<strong>{DATE}</strong>&nbsp;and&nbsp;<strong>{HOUR}</strong>&nbsp;has been approved by your company management.</p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p><br />\r\nRegards<br />\r\n<br />\r\nThe {SITE_NAME} Team</p>\r\n'),
(45, 'overtime_reject_email', 'Your Overtime request has been Rejected', '<h1>Your leave request has been Rejected</h1>\r\n\r\n<p><strong>Unfortunately&nbsp;!</strong>&nbsp;Your overtime&nbsp;request at&nbsp;<strong>{DATE}</strong>&nbsp;and&nbsp;<strong>{HOUR}</strong>&nbsp;has been Rejected by your company management.</p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p><br />\r\nRegards<br />\r\n<br />\r\nThe {SITE_NAME} Team</p>\r\n'),
(46, 'wellcome_email', 'Welcome Email ', '<p>Hello <strong>{NAME}</strong>,</p>\r\n\r\n<p>Welcome to <strong>{COMPANY_NAME}</strong> .Thanks for joining <strong>{COMPANY_NAME}</strong>. We listed your sign in details below, make sure you keep them safe.</p>\r\n\r\n<p><br />\r\nHave fun!<br />\r\nThe <strong>{COMPANY_NAME}</strong> Team.</p>\r\n'),
(47, 'payslip_generated_email', 'Payslip generated', '<p>Hello&nbsp;<strong>{NAME}</strong>,</p>\r\n\r\n<p>Your payslip generated for the month <strong>{MONTH_YEAR} .</strong></p>\r\n\r\n<p><br />\r\nRegards<br />\r\n<br />\r\nThe {SITE_NAME} Team</p>\r\n'),
(48, 'advance_salary_email', 'Advance Salary Reqeust', '<p>Hi there,</p>\r\n\r\n<p><strong>{NAME}</strong>&nbsp;&nbsp;Want to Advance Salary from you.</p>\r\n\r\n<p>You can view this Advance Salary by logging in to the portal using the link below.<br />\r\n<br />\r\n<big><strong><a href="{LINK}">View Advance Salary</a></strong></big><br />\r\n<br />\r\n<br />\r\nRegards<br />\r\n<br />\r\nThe {SITE_NAME} Team</p>\r\n'),
(49, 'advance_salary_approve_email', 'Your advance salary request has been approved', '<h1>Your advance salary request has been approved</h1>\r\n\r\n<p><strong>Congratulations!</strong>&nbsp;Your advance salary&nbsp;requested &nbsp;<strong>{AMOUNT}</strong>&nbsp;has been approved by your company management.</p>\r\n\r\n<p>This advance amount will deduct the next <strong>{DEDUCT_MOTNH}</strong> .</p>\r\n\r\n<p><br />\r\nRegards<br />\r\n<br />\r\nThe {SITE_NAME} Team</p>\r\n'),
(50, 'advance_salary_reject_email', 'Your advance salary request has been Rejected', '<h1>Your advance salary request has been Rejected</h1>\r\n\r\n<p><strong>Unfortunately !</strong>&nbsp;Your advance salary requested&nbsp;<strong>{AMOUNT}</strong>&nbsp;has been Rejected by your company management.</p>\r\n\r\n<p><br />\r\nRegards<br />\r\n<br />\r\nThe {SITE_NAME} Team</p>\r\n'),
(51, 'award_email', 'Award Received', '<p>Hello&nbsp;<strong>{NAME}</strong>,</p>\r\n\r\n<p>You have been&nbsp;awarded <strong>{AWARD_NAME} </strong>for this<strong> {MONTH} .</strong></p>\r\n\r\n<p><br />\r\nRegards<br />\r\n<br />\r\nThe {SITE_NAME} Team</p>\r\n'),
(52, 'new_job_application_email', 'New job application submitted', '<p>Hi there,</p>\r\n\r\n<p>&nbsp;<strong>{NAME}&nbsp;</strong>has submitted the job application</p>\r\n\r\n<p>Please find below are job application Details:</p>\r\n\r\n<table cellpadding="8" style="width:100%">\r\n	<tbody>\r\n		<tr>\r\n			<td>Job Title</td>\r\n			<td><strong>{JOB_TITLE}</strong></td>\r\n		</tr>\r\n		<tr>\r\n			<td>Email</td>\r\n			<td><strong>{EMAIL}</strong></td>\r\n		</tr>\r\n		<tr>\r\n			<td>Mobile</td>\r\n			<td><strong>{MOBILE}</strong></td>\r\n		</tr>\r\n		<tr>\r\n			<td>Cover Latter</td>\r\n			<td><strong>{COVER_LETTER}</strong></td>\r\n		</tr>\r\n	</tbody>\r\n</table>\r\n\r\n<p><br />\r\nYou can view the Job Application online at:<br />\r\n<br />\r\n<big><strong><a href="{LINK}">View Job Application</a></strong></big><br />\r\n<br />\r\nBest Regards,<br />\r\n<br />\r\nThe {SITE_NAME} Team</p>\r\n'),
(53, 'new_notice_published', 'New Notice published', '<p>Hello&nbsp;<strong>{NAME}</strong>,</p>\r\n\r\n<p>New Notice Published&nbsp;<strong>{TITLE}</strong></p>\r\n\r\n<p><br />\r\nYou can view the Notice online at:<br />\r\n<br />\r\n<big><strong><a href="{LINK}">View Notice</a></strong></big><br />\r\n<br />\r\nBest Regards,<br />\r\n<br />\r\nThe {SITE_NAME} Team</p>\r\n'),
(54, 'new_training_email', 'Training  Assigned ', '<p>Hi there,</p>\r\n\r\n<p>A new Training  &nbsp;<strong>{TRAINING_NAME}</strong>&nbsp;&nbsp;has been assigned to you by&nbsp;<strong>{ASSIGNED_BY}</strong>.</p>\r\n\r\n<p>You can view this Training  by logging in to the portal using the link below.</p>\r\n\r\n<p><br />\r\n<big><strong><a href="{LINK}">View Training</a></strong></big><br />\r\n<br />\r\nRegards<br />\r\nThe {SITE_NAME} Team</p>\r\n'),
(55, 'performance_appraisal_email', 'New Performance Appraisal', ''),
(56, 'expense_request_email', 'A New Expense Request have been Recieved', '<p>Hi there,</p>\r\n\r\n<p><strong>{NAME}</strong> &nbsp;Create a New Expense The Amount is <strong>{AMOUNT}</strong></p>\r\n\r\n<p>You can view this expense by logging in to the portal using the link below.<br />\r\n<br />\r\n<big><strong><a href="{URL}">View Expense</a></strong></big><br />\r\n<br />\r\n<br />\r\nRegards,<br />\r\n<br />\r\nThe <strong>{SITE_NAME}</strong> Team</p>\r\n'),
(57, 'expense_approved_email', 'Expense Approved', '<p>Dear&nbsp;<strong>{NAME} ,</strong></p>\r\n\r\n<h1>Your Expense request has been approved</h1>\r\n\r\n<p><strong>Congratulations!</strong>&nbsp;Your Expense request from&nbsp;<strong>{AMOUNT}</strong>&nbsp;has been approved by your company management.</p>\r\n\r\n<p>Please Contact&nbsp;with our Accountant for collect the amount.</p>\r\n\r\n<p><br />\r\nRegards,<br />\r\n<br />\r\nThe {SITE_NAME} Team</p>\r\n'),
(58, 'expense_paid_email', 'Expense have been Paid', '<p>Hi there,</p>\r\n\r\n<p>The&nbsp;<strong>{NAME}</strong>&nbsp;expense&nbsp;<strong>{AMOUNT}&nbsp;</strong>has been paid by <strong>{PAID_BY}.</strong></p>\r\n\r\n<p>You can view this expense by logging in to the portal using the link below.<br />\r\n<br />\r\n<big><strong><a href="{URL}">View Expense</a></strong></big><br />\r\n<br />\r\n<br />\r\nRegards,<br />\r\n<br />\r\nThe&nbsp;<strong>{SITE_NAME}</strong>&nbsp;Team</p>\r\n'),
(59, 'auto_close_ticket', 'Ticket Auto Closed', '<p>Ticket Closed</p>\r\n\r\n<p>Hello <strong>{REPORTER_EMAIL}</strong>,</p>\r\n\r\n<p>Ticket&nbsp;<strong>{SUBJECT}</strong>&nbsp;has been auto closed due to inactivity.&nbsp;<br />\r\n<br />\r\nTicket # <strong>{TICKET_CODE}</strong><br />\r\nStatus : &nbsp;<strong>{TICKET_STATUS}</strong><br />\r\n<br />\r\nTo see the responses or open the ticket, click on the link below:â€‹<br />\r\n<br />\r\n<big><strong><a href="{TICKET_LINK}">View Ticket</a></strong></big><br />\r\n<br />\r\nRegards<br />\r\n<br />\r\nThe <strong>{SITE_NAME}</strong> Team</p>\r\n');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_employee_award`
--

CREATE TABLE IF NOT EXISTS `tbl_employee_award` (
  `employee_award_id` int(11) NOT NULL,
  `award_name` varchar(100) NOT NULL,
  `user_id` int(11) NOT NULL,
  `gift_item` varchar(300) NOT NULL,
  `award_amount` int(5) NOT NULL,
  `award_date` varchar(10) NOT NULL,
  `view_status` tinyint(1) NOT NULL DEFAULT '2' COMMENT '1=Read 2=Unread',
  `given_date` date DEFAULT NULL
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `tbl_employee_award`
--

INSERT INTO `tbl_employee_award` (`employee_award_id`, `award_name`, `user_id`, `gift_item`, `award_amount`, `award_date`, `view_status`, `given_date`) VALUES
(1, 'Mr.FEBRUARY', 1, 'CASH', 200, '2017-02', 2, '2017-02-28');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_employee_bank`
--

CREATE TABLE IF NOT EXISTS `tbl_employee_bank` (
  `employee_bank_id` int(5) NOT NULL,
  `user_id` int(11) NOT NULL,
  `bank_name` varchar(300) NOT NULL,
  `branch_name` varchar(300) NOT NULL,
  `account_name` varchar(300) NOT NULL,
  `account_number` varchar(300) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_employee_document`
--

CREATE TABLE IF NOT EXISTS `tbl_employee_document` (
  `document_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `resume` text,
  `resume_path` text,
  `resume_filename` text,
  `offer_letter` text,
  `offer_letter_filename` text,
  `offer_letter_path` text,
  `joining_letter` text,
  `joining_letter_filename` text,
  `joining_letter_path` text,
  `contract_paper` text,
  `contract_paper_filename` text,
  `contract_paper_path` text,
  `id_proff` text,
  `id_proff_filename` text,
  `id_proff_path` text,
  `other_document` text
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_employee_payroll`
--

CREATE TABLE IF NOT EXISTS `tbl_employee_payroll` (
  `payroll_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `salary_template_id` int(11) DEFAULT NULL,
  `hourly_rate_id` int(11) DEFAULT NULL
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `tbl_employee_payroll`
--

INSERT INTO `tbl_employee_payroll` (`payroll_id`, `user_id`, `salary_template_id`, `hourly_rate_id`) VALUES
(1, 1, 1, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_estimates`
--

CREATE TABLE IF NOT EXISTS `tbl_estimates` (
  `estimates_id` int(11) NOT NULL,
  `reference_no` varchar(32) COLLATE utf8_unicode_ci DEFAULT NULL,
  `client_id` int(11) DEFAULT NULL,
  `project_id` int(11) DEFAULT '0',
  `due_date` varchar(40) COLLATE utf8_unicode_ci DEFAULT NULL,
  `currency` varchar(32) COLLATE utf8_unicode_ci DEFAULT 'USD',
  `discount` float NOT NULL,
  `notes` text COLLATE utf8_unicode_ci,
  `tax` int(11) NOT NULL DEFAULT '0',
  `status` varchar(20) COLLATE utf8_unicode_ci NOT NULL DEFAULT 'Pending',
  `date_sent` varchar(64) COLLATE utf8_unicode_ci DEFAULT NULL,
  `est_deleted` enum('Yes','No') COLLATE utf8_unicode_ci NOT NULL DEFAULT 'No',
  `date_saved` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `emailed` enum('Yes','No') COLLATE utf8_unicode_ci DEFAULT 'No',
  `show_client` enum('Yes','No') COLLATE utf8_unicode_ci DEFAULT 'No',
  `invoiced` enum('Yes','No') COLLATE utf8_unicode_ci DEFAULT 'No',
  `permission` text COLLATE utf8_unicode_ci,
  `client_visible` varchar(20) COLLATE utf8_unicode_ci NOT NULL DEFAULT 'No'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_estimate_items`
--

CREATE TABLE IF NOT EXISTS `tbl_estimate_items` (
  `estimate_items_id` int(11) NOT NULL,
  `estimates_id` int(11) NOT NULL,
  `item_tax_rate` decimal(10,2) NOT NULL DEFAULT '0.00',
  `item_name` varchar(150) COLLATE utf8_unicode_ci DEFAULT 'Item Name',
  `item_desc` longtext COLLATE utf8_unicode_ci,
  `unit_cost` decimal(10,2) DEFAULT '0.00',
  `quantity` decimal(10,2) DEFAULT '0.00',
  `item_tax_total` decimal(10,2) DEFAULT '0.00',
  `total_cost` decimal(10,2) DEFAULT '0.00',
  `date_saved` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `item_order` int(11) DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_expense_category`
--

CREATE TABLE IF NOT EXISTS `tbl_expense_category` (
  `expense_category_id` int(11) NOT NULL,
  `expense_category` varchar(200) NOT NULL,
  `description` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_files`
--

CREATE TABLE IF NOT EXISTS `tbl_files` (
  `files_id` int(11) NOT NULL,
  `project_id` int(11) NOT NULL,
  `title` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `description` text COLLATE utf8_unicode_ci,
  `uploaded_by` int(11) NOT NULL,
  `date_posted` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_form`
--

CREATE TABLE IF NOT EXISTS `tbl_form` (
  `form_id` int(11) NOT NULL,
  `form_name` varchar(100) NOT NULL,
  `tbl_name` varchar(25) DEFAULT NULL
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_form`
--

INSERT INTO `tbl_form` (`form_id`, `form_name`, `tbl_name`) VALUES
(1, 'deposit', 'tbl_transactions'),
(2, 'expense', 'tbl_transactions'),
(3, 'tasks', 'tbl_task'),
(4, 'project', 'tbl_project'),
(5, 'leads', 'tbl_leads'),
(6, 'bugs', 'tbl_bug'),
(7, 'tickets', 'tbl_tickets'),
(8, 'opportunities', 'tbl_opportunities'),
(9, 'invoice', 'tbl_invoices'),
(10, 'estimates', 'tbl_estimates');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_goal_tracking`
--

CREATE TABLE IF NOT EXISTS `tbl_goal_tracking` (
  `goal_tracking_id` int(11) NOT NULL,
  `subject` varchar(200) NOT NULL,
  `goal_type_id` int(11) NOT NULL,
  `achievement` int(10) NOT NULL,
  `start_date` varchar(20) NOT NULL,
  `end_date` varchar(20) NOT NULL,
  `account_id` int(11) DEFAULT '0',
  `description` text NOT NULL,
  `notify_goal_achive` varchar(5) DEFAULT NULL,
  `notify_goal_not_achive` varchar(5) DEFAULT NULL,
  `permission` text,
  `email_send` varchar(5) NOT NULL DEFAULT 'no'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_goal_type`
--

CREATE TABLE IF NOT EXISTS `tbl_goal_type` (
  `goal_type_id` int(11) NOT NULL,
  `type_name` varchar(200) NOT NULL,
  `description` text NOT NULL,
  `tbl_name` varchar(200) NOT NULL,
  `query` varchar(200) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

INSERT INTO `tbl_goal_type` (`goal_type_id`, `type_name`, `description`, `tbl_name`, `query`) VALUES
(1, 'achive_total_income', 'to get total income report from this start and end date and notify user. ', 'tbl_transactions', 'Income'),
(2, 'achive_total_income_by_bank', 'to get total income report from this start and end date and notify user. ', 'tbl_transactions', 'Income'),
(3, 'achieve_total_expense', 'to get total expense report from this start and end date and notify user. ', 'tbl_transactions', 'Expense'),
(4, 'achive_total_expense_by_bank', 'to get total expense report from this start and end date and notify user. ', 'tbl_transactions', 'Expense'),
(5, 'make_invoice', 'to get targeted invoice from this start and end date and notify user. ', 'tbl_invoices', NULL),
(6, 'make_estimate', 'to get targeted estimate from this start and end date and notify user.', 'tbl_estimates', NULL),
(7, 'goal_payment', 'to get total payment report from this start and end date and notify user. ', 'tbl_payments', NULL),
(8, 'task_done', 'to get total done tasks report from this start and end date and notify user. ', 'tbl_task', NULL),
(9, 'resolved_bugs', 'to get total resolve bugs report from this start and end date and notify user. ', 'tbl_bug', NULL),
(10, 'convert_leads_to_client', 'to get total Convert leads to client report from this start and end date and notify user. ', 'tbl_client', NULL),
(11, 'direct_client', 'to get total client report from this start and end date and notify user. ', 'tbl_client', NULL),
(12, 'complete_project_goal', 'to get total complete project report from this start and end date and notify user. ', 'tbl_project', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_holiday`
--

CREATE TABLE IF NOT EXISTS `tbl_holiday` (
  `holiday_id` int(11) NOT NULL,
  `event_name` varchar(200) NOT NULL,
  `description` text NOT NULL,
  `start_date` date NOT NULL,
  `end_date` date NOT NULL,
  `location` varchar(200) DEFAULT NULL,
  `color` varchar(200) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_hourly_rate`
--

CREATE TABLE IF NOT EXISTS `tbl_hourly_rate` (
  `hourly_rate_id` int(11) NOT NULL,
  `hourly_grade` varchar(200) NOT NULL,
  `hourly_rate` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_inbox`
--

CREATE TABLE IF NOT EXISTS `tbl_inbox` (
  `inbox_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `to` varchar(100) NOT NULL,
  `from` varchar(100) NOT NULL,
  `subject` varchar(300) NOT NULL,
  `message_body` text NOT NULL,
  `attach_file` varchar(200) DEFAULT NULL,
  `attach_file_path` text,
  `attach_filename` text,
  `message_time` datetime NOT NULL,
  `view_status` tinyint(1) NOT NULL DEFAULT '2' COMMENT '1=Read 2=Unread',
  `favourites` tinyint(1) NOT NULL DEFAULT '0' COMMENT '0= no 1=yes',
  `notify_me` tinyint(1) NOT NULL DEFAULT '1' COMMENT '1=on 0=off',
  `deleted` enum('Yes','No') NOT NULL DEFAULT 'No'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_income_category`
--

CREATE TABLE IF NOT EXISTS `tbl_income_category` (
  `income_category_id` int(11) NOT NULL,
  `income_category` varchar(200) NOT NULL,
  `description` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_invoices`
--

CREATE TABLE IF NOT EXISTS `tbl_invoices` (
  `invoices_id` int(11) NOT NULL,
  `recur_start_date` varchar(20) COLLATE utf8_unicode_ci NOT NULL,
  `recur_end_date` varchar(20) COLLATE utf8_unicode_ci NOT NULL,
  `reference_no` varchar(32) COLLATE utf8_unicode_ci DEFAULT NULL,
  `client_id` int(11) NOT NULL,
  `project_id` int(11) DEFAULT NULL,
  `due_date` varchar(40) COLLATE utf8_unicode_ci DEFAULT NULL,
  `notes` text COLLATE utf8_unicode_ci NOT NULL,
  `tax` decimal(10,2) NOT NULL DEFAULT '0.00',
  `discount` decimal(10,2) NOT NULL DEFAULT '0.00',
  `recurring` enum('Yes','No') COLLATE utf8_unicode_ci NOT NULL DEFAULT 'No',
  `recuring_frequency` int(11) NOT NULL DEFAULT '31',
  `recur_frequency` varchar(12) COLLATE utf8_unicode_ci DEFAULT NULL,
  `recur_next_date` varchar(32) COLLATE utf8_unicode_ci DEFAULT NULL,
  `currency` varchar(32) COLLATE utf8_unicode_ci NOT NULL DEFAULT 'USD',
  `status` enum('Cancelled','Unpaid','Paid','draft') COLLATE utf8_unicode_ci NOT NULL DEFAULT 'Unpaid',
  `archived` int(11) DEFAULT '0',
  `date_sent` varchar(64) COLLATE utf8_unicode_ci DEFAULT NULL,
  `inv_deleted` enum('Yes','No') COLLATE utf8_unicode_ci NOT NULL DEFAULT 'No',
  `date_saved` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `emailed` enum('Yes','No') COLLATE utf8_unicode_ci NOT NULL DEFAULT 'No',
  `show_client` enum('Yes','No') COLLATE utf8_unicode_ci NOT NULL DEFAULT 'Yes',
  `viewed` enum('Yes','No') COLLATE utf8_unicode_ci NOT NULL DEFAULT 'No',
  `allow_paypal` enum('Yes','No') COLLATE utf8_unicode_ci NOT NULL DEFAULT 'Yes',
  `allow_stripe` enum('Yes','No') COLLATE utf8_unicode_ci NOT NULL DEFAULT 'Yes',
  `allow_2checkout` enum('Yes','No') COLLATE utf8_unicode_ci NOT NULL DEFAULT 'Yes',
  `allow_authorize` enum('Yes','No') COLLATE utf8_unicode_ci NOT NULL DEFAULT 'No',
  `allow_ccavenue` enum('Yes','No') COLLATE utf8_unicode_ci NOT NULL DEFAULT 'No',
  `allow_braintree` enum('Yes','No') COLLATE utf8_unicode_ci NOT NULL DEFAULT 'No',
  `permission` text COLLATE utf8_unicode_ci,
  `client_visible` enum('Yes','No') COLLATE utf8_unicode_ci DEFAULT 'No'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_items`
--

CREATE TABLE IF NOT EXISTS `tbl_items` (
  `items_id` int(11) NOT NULL,
  `invoices_id` int(11) NOT NULL,
  `item_tax_rate` decimal(10,2) NOT NULL DEFAULT '0.00',
  `item_tax_total` decimal(10,2) NOT NULL DEFAULT '0.00',
  `quantity` decimal(10,2) DEFAULT '0.00',
  `total_cost` decimal(10,2) DEFAULT '0.00',
  `item_name` varchar(255) COLLATE utf8_unicode_ci DEFAULT 'Item Name',
  `item_desc` longtext COLLATE utf8_unicode_ci,
  `unit_cost` decimal(10,2) DEFAULT '0.00',
  `item_order` int(11) DEFAULT '0',
  `date_saved` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_item_history`
--

CREATE TABLE IF NOT EXISTS `tbl_item_history` (
  `item_history_id` int(11) NOT NULL,
  `stock_id` int(11) NOT NULL,
  `inventory` int(5) NOT NULL,
  `purchase_date` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_job_appliactions`
--

CREATE TABLE IF NOT EXISTS `tbl_job_appliactions` (
  `job_appliactions_id` int(11) NOT NULL,
  `job_circular_id` int(11) NOT NULL,
  `name` varchar(200) NOT NULL,
  `email` varchar(100) NOT NULL,
  `mobile` varchar(15) NOT NULL,
  `cover_letter` text NOT NULL,
  `resume` text NOT NULL,
  `application_status` tinyint(1) NOT NULL DEFAULT '0' COMMENT '0=pending 1=accept 2 = reject',
  `apply_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_job_circular`
--

CREATE TABLE IF NOT EXISTS `tbl_job_circular` (
  `job_circular_id` int(11) NOT NULL,
  `job_title` varchar(200) NOT NULL,
  `designations_id` int(11) NOT NULL,
  `vacancy_no` varchar(50) NOT NULL,
  `posted_date` date NOT NULL,
  `employment_type` enum('full_time','part_time') NOT NULL DEFAULT 'full_time',
  `last_date` date NOT NULL,
  `description` text NOT NULL,
  `status` enum('published','unpublished') NOT NULL DEFAULT 'unpublished' COMMENT '1=publish 2=unpublish',
  `created_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `permission` text
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_languages`
--

CREATE TABLE IF NOT EXISTS `tbl_languages` (
  `code` varchar(10) COLLATE utf8_unicode_ci NOT NULL,
  `name` varchar(45) COLLATE utf8_unicode_ci DEFAULT NULL,
  `icon` varchar(45) COLLATE utf8_unicode_ci DEFAULT NULL,
  `active` int(2) DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `tbl_languages`
--

INSERT INTO `tbl_languages` (`code`, `name`, `icon`, `active`) VALUES
('ar', 'arabic', 'ae', 1),
('cs', 'czech', 'cz', 1),
('da', 'danish', 'dk', 1),
('de', 'german', 'at', 1),
('el', 'greek', 'cy', 1),
('en', 'english', 'us', 1),
('es', 'spanish', 'ar', 1),
('fr', 'french', 'be', 1),
('gu', 'gujarati', 'in', 1),
('hi', 'hindi', 'in', 1),
('id', 'indonesian', 'id', 1),
('it', 'italian', 'ch', 1),
('ja', 'japanese', 'jp', 1),
('nl', 'dutch', 'aw', 1),
('no', 'norwegian', 'no', 1),
('pl', 'polish', 'pl', 1),
('pt', 'portuguese', 'br', 1),
('ro', 'romanian', 'md', 1),
('ru', 'russian', 'ru', 1),
('tr', 'turkish', 'cy', 1),
('zh', 'chinese', 'cn', 1);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_leads`
--

CREATE TABLE IF NOT EXISTS `tbl_leads` (
  `leads_id` int(11) NOT NULL,
  `lead_name` varchar(50) NOT NULL,
  `client_id` int(11) DEFAULT NULL,
  `organization` varchar(50) NOT NULL,
  `lead_status_id` int(11) DEFAULT NULL,
  `lead_source_id` int(11) DEFAULT NULL,
  `company_name` varchar(255) NOT NULL,
  `address` text NOT NULL,
  `country` varchar(20) NOT NULL,
  `state` varchar(20) NOT NULL,
  `city` varchar(50) NOT NULL,
  `contact_name` varchar(255) NOT NULL,
  `title` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `phone` varchar(32) NOT NULL,
  `mobile` varchar(32) NOT NULL,
  `facebook` varchar(32) NOT NULL,
  `notes` text NOT NULL,
  `created_time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `skype` varchar(200) NOT NULL,
  `twitter` varchar(100) NOT NULL,
  `permission` text,
  `converted_client_id` int(11) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_lead_source`
--

CREATE TABLE IF NOT EXISTS `tbl_lead_source` (
  `lead_source_id` int(11) NOT NULL,
  `lead_source` varchar(100) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `tbl_lead_source`
--

INSERT INTO `tbl_lead_source` (`lead_source_id`, `lead_source`) VALUES
(1, 'Phone'),
(2, 'Ads'),
(3, 'Friends');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_lead_status`
--

CREATE TABLE IF NOT EXISTS `tbl_lead_status` (
  `lead_status_id` int(11) NOT NULL,
  `lead_status` varchar(50) NOT NULL,
  `lead_type` enum('open','close') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_leave_application`
--

CREATE TABLE IF NOT EXISTS `tbl_leave_application` (
  `leave_application_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `leave_category_id` int(2) NOT NULL,
  `reason` text NOT NULL,
  `leave_start_date` date NOT NULL,
  `leave_end_date` date NOT NULL,
  `application_status` int(2) NOT NULL DEFAULT '1' COMMENT '1=pending,2=accepted 3=rejected',
  `view_status` tinyint(1) NOT NULL DEFAULT '2',
  `application_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `attachment` text,
  `comments` text,
  `approve_by` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_leave_category`
--

CREATE TABLE IF NOT EXISTS `tbl_leave_category` (
  `leave_category_id` int(2) NOT NULL,
  `leave_category` varchar(100) NOT NULL,
  `leave_quota` int(2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_locales`
--

CREATE TABLE IF NOT EXISTS `tbl_locales` (
  `locale` varchar(10) NOT NULL,
  `code` varchar(10) DEFAULT NULL,
  `language` varchar(100) DEFAULT NULL,
  `name` varchar(250) NOT NULL DEFAULT ''
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `tbl_locales`
--

INSERT INTO `tbl_locales` (`locale`, `code`, `language`, `name`) VALUES
('aa_DJ', 'aa', 'afar', 'Afar (Djibouti)'),
('aa_ER', 'aa', 'afar', 'Afar (Eritrea)'),
('aa_ET', 'aa', 'afar', 'Afar (Ethiopia)'),
('af_ZA', 'af', 'afrikaans', 'Afrikaans (South Africa)'),
('am_ET', 'am', 'amharic', 'Amharic (Ethiopia)'),
('an_ES', 'an', 'aragonese', 'Aragonese (Spain)'),
('ar_AE', 'ar', 'arabic', 'Arabic (United Arab Emirates)'),
('ar_BH', 'ar', 'arabic', 'Arabic (Bahrain)'),
('ar_DZ', 'ar', 'arabic', 'Arabic (Algeria)'),
('ar_EG', 'ar', 'arabic', 'Arabic (Egypt)'),
('ar_IN', 'ar', 'arabic', 'Arabic (India)'),
('ar_IQ', 'ar', 'arabic', 'Arabic (Iraq)'),
('ar_JO', 'ar', 'arabic', 'Arabic (Jordan)'),
('ar_KW', 'ar', 'arabic', 'Arabic (Kuwait)'),
('ar_LB', 'ar', 'arabic', 'Arabic (Lebanon)'),
('ar_LY', 'ar', 'arabic', 'Arabic (Libya)'),
('ar_MA', 'ar', 'arabic', 'Arabic (Morocco)'),
('ar_OM', 'ar', 'arabic', 'Arabic (Oman)'),
('ar_QA', 'ar', 'arabic', 'Arabic (Qatar)'),
('ar_SA', 'ar', 'arabic', 'Arabic (Saudi Arabia)'),
('ar_SD', 'ar', 'arabic', 'Arabic (Sudan)'),
('ar_SY', 'ar', 'arabic', 'Arabic (Syria)'),
('ar_TN', 'ar', 'arabic', 'Arabic (Tunisia)'),
('ar_YE', 'ar', 'arabic', 'Arabic (Yemen)'),
('ast_ES', 'ast', 'asturian', 'Asturian (Spain)'),
('as_IN', 'as', 'assamese', 'Assamese (India)'),
('az_AZ', 'az', 'azerbaijani', 'Azerbaijani (Azerbaijan)'),
('az_TR', 'az', 'azerbaijani', 'Azerbaijani (Turkey)'),
('bem_ZM', 'bem', 'bemba', 'Bemba (Zambia)'),
('ber_DZ', 'ber', 'berber', 'Berber (Algeria)'),
('ber_MA', 'ber', 'berber', 'Berber (Morocco)'),
('be_BY', 'be', 'belarusian', 'Belarusian (Belarus)'),
('bg_BG', 'bg', 'bulgarian', 'Bulgarian (Bulgaria)'),
('bn_BD', 'bn', 'bengali', 'Bengali (Bangladesh)'),
('bn_IN', 'bn', 'bengali', 'Bengali (India)'),
('bo_CN', 'bo', 'tibetan', 'Tibetan (China)'),
('bo_IN', 'bo', 'tibetan', 'Tibetan (India)'),
('br_FR', 'br', 'breton', 'Breton (France)'),
('bs_BA', 'bs', 'bosnian', 'Bosnian (Bosnia and Herzegovina)'),
('byn_ER', 'byn', 'blin', 'Blin (Eritrea)'),
('ca_AD', 'ca', 'catalan', 'Catalan (Andorra)'),
('ca_ES', 'ca', 'catalan', 'Catalan (Spain)'),
('ca_FR', 'ca', 'catalan', 'Catalan (France)'),
('ca_IT', 'ca', 'catalan', 'Catalan (Italy)'),
('crh_UA', 'crh', 'crimean turkish', 'Crimean Turkish (Ukraine)'),
('csb_PL', 'csb', 'kashubian', 'Kashubian (Poland)'),
('cs_CZ', 'cs', 'czech', 'Czech (Czech Republic)'),
('cv_RU', 'cv', 'chuvash', 'Chuvash (Russia)'),
('cy_GB', 'cy', 'welsh', 'Welsh (United Kingdom)'),
('da_DK', 'da', 'danish', 'Danish (Denmark)'),
('de_AT', 'de', 'german', 'German (Austria)'),
('de_BE', 'de', 'german', 'German (Belgium)'),
('de_CH', 'de', 'german', 'German (Switzerland)'),
('de_DE', 'de', 'german', 'German (Germany)'),
('de_LI', 'de', 'german', 'German (Liechtenstein)'),
('de_LU', 'de', 'german', 'German (Luxembourg)'),
('dv_MV', 'dv', 'divehi', 'Divehi (Maldives)'),
('dz_BT', 'dz', 'dzongkha', 'Dzongkha (Bhutan)'),
('ee_GH', 'ee', 'ewe', 'Ewe (Ghana)'),
('el_CY', 'el', 'greek', 'Greek (Cyprus)'),
('el_GR', 'el', 'greek', 'Greek (Greece)'),
('en_AG', 'en', 'english', 'English (Antigua and Barbuda)'),
('en_AS', 'en', 'english', 'English (American Samoa)'),
('en_AU', 'en', 'english', 'English (Australia)'),
('en_BW', 'en', 'english', 'English (Botswana)'),
('en_CA', 'en', 'english', 'English (Canada)'),
('en_DK', 'en', 'english', 'English (Denmark)'),
('en_GB', 'en', 'english', 'English (United Kingdom)'),
('en_GU', 'en', 'english', 'English (Guam)'),
('en_HK', 'en', 'english', 'English (Hong Kong SAR China)'),
('en_IE', 'en', 'english', 'English (Ireland)'),
('en_IN', 'en', 'english', 'English (India)'),
('en_JM', 'en', 'english', 'English (Jamaica)'),
('en_MH', 'en', 'english', 'English (Marshall Islands)'),
('en_MP', 'en', 'english', 'English (Northern Mariana Islands)'),
('en_MU', 'en', 'english', 'English (Mauritius)'),
('en_NG', 'en', 'english', 'English (Nigeria)'),
('en_NZ', 'en', 'english', 'English (New Zealand)'),
('en_PH', 'en', 'english', 'English (Philippines)'),
('en_SG', 'en', 'english', 'English (Singapore)'),
('en_TT', 'en', 'english', 'English (Trinidad and Tobago)'),
('en_US', 'en', 'english', 'English (United States)'),
('en_VI', 'en', 'english', 'English (Virgin Islands)'),
('en_ZA', 'en', 'english', 'English (South Africa)'),
('en_ZM', 'en', 'english', 'English (Zambia)'),
('en_ZW', 'en', 'english', 'English (Zimbabwe)'),
('eo', 'eo', 'esperanto', 'Esperanto'),
('es_AR', 'es', 'spanish', 'Spanish (Argentina)'),
('es_BO', 'es', 'spanish', 'Spanish (Bolivia)'),
('es_CL', 'es', 'spanish', 'Spanish (Chile)'),
('es_CO', 'es', 'spanish', 'Spanish (Colombia)'),
('es_CR', 'es', 'spanish', 'Spanish (Costa Rica)'),
('es_DO', 'es', 'spanish', 'Spanish (Dominican Republic)'),
('es_EC', 'es', 'spanish', 'Spanish (Ecuador)'),
('es_ES', 'es', 'spanish', 'Spanish (Spain)'),
('es_GT', 'es', 'spanish', 'Spanish (Guatemala)'),
('es_HN', 'es', 'spanish', 'Spanish (Honduras)'),
('es_MX', 'es', 'spanish', 'Spanish (Mexico)'),
('es_NI', 'es', 'spanish', 'Spanish (Nicaragua)'),
('es_PA', 'es', 'spanish', 'Spanish (Panama)'),
('es_PE', 'es', 'spanish', 'Spanish (Peru)'),
('es_PR', 'es', 'spanish', 'Spanish (Puerto Rico)'),
('es_PY', 'es', 'spanish', 'Spanish (Paraguay)'),
('es_SV', 'es', 'spanish', 'Spanish (El Salvador)'),
('es_US', 'es', 'spanish', 'Spanish (United States)'),
('es_UY', 'es', 'spanish', 'Spanish (Uruguay)'),
('es_VE', 'es', 'spanish', 'Spanish (Venezuela)'),
('et_EE', 'et', 'estonian', 'Estonian (Estonia)'),
('eu_ES', 'eu', 'basque', 'Basque (Spain)'),
('eu_FR', 'eu', 'basque', 'Basque (France)'),
('fa_AF', 'fa', 'persian', 'Persian (Afghanistan)'),
('fa_IR', 'fa', 'persian', 'Persian (Iran)'),
('ff_SN', 'ff', 'fulah', 'Fulah (Senegal)'),
('fil_PH', 'fil', 'filipino', 'Filipino (Philippines)'),
('fi_FI', 'fi', 'finnish', 'Finnish (Finland)'),
('fo_FO', 'fo', 'faroese', 'Faroese (Faroe Islands)'),
('fr_BE', 'fr', 'french', 'French (Belgium)'),
('fr_BF', 'fr', 'french', 'French (Burkina Faso)'),
('fr_BI', 'fr', 'french', 'French (Burundi)'),
('fr_BJ', 'fr', 'french', 'French (Benin)'),
('fr_CA', 'fr', 'french', 'French (Canada)'),
('fr_CF', 'fr', 'french', 'French (Central African Republic)'),
('fr_CG', 'fr', 'french', 'French (Congo)'),
('fr_CH', 'fr', 'french', 'French (Switzerland)'),
('fr_CM', 'fr', 'french', 'French (Cameroon)'),
('fr_FR', 'fr', 'french', 'French (France)'),
('fr_GA', 'fr', 'french', 'French (Gabon)'),
('fr_GN', 'fr', 'french', 'French (Guinea)'),
('fr_GP', 'fr', 'french', 'French (Guadeloupe)'),
('fr_GQ', 'fr', 'french', 'French (Equatorial Guinea)'),
('fr_KM', 'fr', 'french', 'French (Comoros)'),
('fr_LU', 'fr', 'french', 'French (Luxembourg)'),
('fr_MC', 'fr', 'french', 'French (Monaco)'),
('fr_MG', 'fr', 'french', 'French (Madagascar)'),
('fr_ML', 'fr', 'french', 'French (Mali)'),
('fr_MQ', 'fr', 'french', 'French (Martinique)'),
('fr_NE', 'fr', 'french', 'French (Niger)'),
('fr_SN', 'fr', 'french', 'French (Senegal)'),
('fr_TD', 'fr', 'french', 'French (Chad)'),
('fr_TG', 'fr', 'french', 'French (Togo)'),
('fur_IT', 'fur', 'friulian', 'Friulian (Italy)'),
('fy_DE', 'fy', 'western frisian', 'Western Frisian (Germany)'),
('fy_NL', 'fy', 'western frisian', 'Western Frisian (Netherlands)'),
('ga_IE', 'ga', 'irish', 'Irish (Ireland)'),
('gd_GB', 'gd', 'scottish gaelic', 'Scottish Gaelic (United Kingdom)'),
('gez_ER', 'gez', 'geez', 'Geez (Eritrea)'),
('gez_ET', 'gez', 'geez', 'Geez (Ethiopia)'),
('gl_ES', 'gl', 'galician', 'Galician (Spain)'),
('gu_IN', 'gu', 'gujarati', 'Gujarati (India)'),
('gv_GB', 'gv', 'manx', 'Manx (United Kingdom)'),
('ha_NG', 'ha', 'hausa', 'Hausa (Nigeria)'),
('he_IL', 'he', 'hebrew', 'Hebrew (Israel)'),
('hi_IN', 'hi', 'hindi', 'Hindi (India)'),
('hr_HR', 'hr', 'croatian', 'Croatian (Croatia)'),
('hsb_DE', 'hsb', 'upper sorbian', 'Upper Sorbian (Germany)'),
('ht_HT', 'ht', 'haitian', 'Haitian (Haiti)'),
('hu_HU', 'hu', 'hungarian', 'Hungarian (Hungary)'),
('hy_AM', 'hy', 'armenian', 'Armenian (Armenia)'),
('ia', 'ia', 'interlingua', 'Interlingua'),
('id_ID', 'id', 'indonesian', 'Indonesian (Indonesia)'),
('ig_NG', 'ig', 'igbo', 'Igbo (Nigeria)'),
('ik_CA', 'ik', 'inupiaq', 'Inupiaq (Canada)'),
('is_IS', 'is', 'icelandic', 'Icelandic (Iceland)'),
('it_CH', 'it', 'italian', 'Italian (Switzerland)'),
('it_IT', 'it', 'italian', 'Italian (Italy)'),
('iu_CA', 'iu', 'inuktitut', 'Inuktitut (Canada)'),
('ja_JP', 'ja', 'japanese', 'Japanese (Japan)'),
('ka_GE', 'ka', 'georgian', 'Georgian (Georgia)'),
('kk_KZ', 'kk', 'kazakh', 'Kazakh (Kazakhstan)'),
('kl_GL', 'kl', 'kalaallisut', 'Kalaallisut (Greenland)'),
('km_KH', 'km', 'khmer', 'Khmer (Cambodia)'),
('kn_IN', 'kn', 'kannada', 'Kannada (India)'),
('kok_IN', 'kok', 'konkani', 'Konkani (India)'),
('ko_KR', 'ko', 'korean', 'Korean (South Korea)'),
('ks_IN', 'ks', 'kashmiri', 'Kashmiri (India)'),
('ku_TR', 'ku', 'kurdish', 'Kurdish (Turkey)'),
('kw_GB', 'kw', 'cornish', 'Cornish (United Kingdom)'),
('ky_KG', 'ky', 'kirghiz', 'Kirghiz (Kyrgyzstan)'),
('lg_UG', 'lg', 'ganda', 'Ganda (Uganda)'),
('li_BE', 'li', 'limburgish', 'Limburgish (Belgium)'),
('li_NL', 'li', 'limburgish', 'Limburgish (Netherlands)'),
('lo_LA', 'lo', 'lao', 'Lao (Laos)'),
('lt_LT', 'lt', 'lithuanian', 'Lithuanian (Lithuania)'),
('lv_LV', 'lv', 'latvian', 'Latvian (Latvia)'),
('mai_IN', 'mai', 'maithili', 'Maithili (India)'),
('mg_MG', 'mg', 'malagasy', 'Malagasy (Madagascar)'),
('mi_NZ', 'mi', 'maori', 'Maori (New Zealand)'),
('mk_MK', 'mk', 'macedonian', 'Macedonian (Macedonia)'),
('ml_IN', 'ml', 'malayalam', 'Malayalam (India)'),
('mn_MN', 'mn', 'mongolian', 'Mongolian (Mongolia)'),
('mr_IN', 'mr', 'marathi', 'Marathi (India)'),
('ms_BN', 'ms', 'malay', 'Malay (Brunei)'),
('ms_MY', 'ms', 'malay', 'Malay (Malaysia)'),
('mt_MT', 'mt', 'maltese', 'Maltese (Malta)'),
('my_MM', 'my', 'burmese', 'Burmese (Myanmar)'),
('naq_NA', 'naq', 'namibia', 'Namibia'),
('nb_NO', 'nb', 'norwegian bokm?l', 'Norwegian Bokm?l (Norway)'),
('nds_DE', 'nds', 'low german', 'Low German (Germany)'),
('nds_NL', 'nds', 'low german', 'Low German (Netherlands)'),
('ne_NP', 'ne', 'nepali', 'Nepali (Nepal)'),
('nl_AW', 'nl', 'dutch', 'Dutch (Aruba)'),
('nl_BE', 'nl', 'dutch', 'Dutch (Belgium)'),
('nl_NL', 'nl', 'dutch', 'Dutch (Netherlands)'),
('nn_NO', 'nn', 'norwegian nynorsk', 'Norwegian Nynorsk (Norway)'),
('no_NO', 'no', 'norwegian', 'Norwegian (Norway)'),
('nr_ZA', 'nr', 'south ndebele', 'South Ndebele (South Africa)'),
('nso_ZA', 'nso', 'northern sotho', 'Northern Sotho (South Africa)'),
('oc_FR', 'oc', 'occitan', 'Occitan (France)'),
('om_ET', 'om', 'oromo', 'Oromo (Ethiopia)'),
('om_KE', 'om', 'oromo', 'Oromo (Kenya)'),
('or_IN', 'or', 'oriya', 'Oriya (India)'),
('os_RU', 'os', 'ossetic', 'Ossetic (Russia)'),
('pap_AN', 'pap', 'papiamento', 'Papiamento (Netherlands Antilles)'),
('pa_IN', 'pa', 'punjabi', 'Punjabi (India)'),
('pa_PK', 'pa', 'punjabi', 'Punjabi (Pakistan)'),
('pl_PL', 'pl', 'polish', 'Polish (Poland)'),
('ps_AF', 'ps', 'pashto', 'Pashto (Afghanistan)'),
('pt_BR', 'pt', 'portuguese', 'Portuguese (Brazil)'),
('pt_GW', 'pt', 'portuguese', 'Portuguese (Guinea-Bissau)'),
('pt_PT', 'pt', 'portuguese', 'Portuguese (Portugal)'),
('ro_MD', 'ro', 'romanian', 'Romanian (Moldova)'),
('ro_RO', 'ro', 'romanian', 'Romanian (Romania)'),
('ru_RU', 'ru', 'russian', 'Russian (Russia)'),
('ru_UA', 'ru', 'russian', 'Russian (Ukraine)'),
('rw_RW', 'rw', 'kinyarwanda', 'Kinyarwanda (Rwanda)'),
('sa_IN', 'sa', 'sanskrit', 'Sanskrit (India)'),
('sc_IT', 'sc', 'sardinian', 'Sardinian (Italy)'),
('sd_IN', 'sd', 'sindhi', 'Sindhi (India)'),
('seh_MZ', 'seh', 'sena', 'Sena (Mozambique)'),
('se_NO', 'se', 'northern sami', 'Northern Sami (Norway)'),
('sid_ET', 'sid', 'sidamo', 'Sidamo (Ethiopia)'),
('si_LK', 'si', 'sinhala', 'Sinhala (Sri Lanka)'),
('sk_SK', 'sk', 'slovak', 'Slovak (Slovakia)'),
('sl_SI', 'sl', 'slovenian', 'Slovenian (Slovenia)'),
('sn_ZW', 'sn', 'shona', 'Shona (Zimbabwe)'),
('so_DJ', 'so', 'somali', 'Somali (Djibouti)'),
('so_ET', 'so', 'somali', 'Somali (Ethiopia)'),
('so_KE', 'so', 'somali', 'Somali (Kenya)'),
('so_SO', 'so', 'somali', 'Somali (Somalia)'),
('sq_AL', 'sq', 'albanian', 'Albanian (Albania)'),
('sq_MK', 'sq', 'albanian', 'Albanian (Macedonia)'),
('sr_BA', 'sr', 'serbian', 'Serbian (Bosnia and Herzegovina)'),
('sr_ME', 'sr', 'serbian', 'Serbian (Montenegro)'),
('sr_RS', 'sr', 'serbian', 'Serbian (Serbia)'),
('ss_ZA', 'ss', 'swati', 'Swati (South Africa)'),
('st_ZA', 'st', 'southern sotho', 'Southern Sotho (South Africa)'),
('sv_FI', 'sv', 'swedish', 'Swedish (Finland)'),
('sv_SE', 'sv', 'swedish', 'Swedish (Sweden)'),
('sw_KE', 'sw', 'swahili', 'Swahili (Kenya)'),
('sw_TZ', 'sw', 'swahili', 'Swahili (Tanzania)'),
('ta_IN', 'ta', 'tamil', 'Tamil (India)'),
('teo_UG', 'teo', 'teso', 'Teso (Uganda)'),
('te_IN', 'te', 'telugu', 'Telugu (India)'),
('tg_TJ', 'tg', 'tajik', 'Tajik (Tajikistan)'),
('th_TH', 'th', 'thai', 'Thai (Thailand)'),
('tig_ER', 'tig', 'tigre', 'Tigre (Eritrea)'),
('ti_ER', 'ti', 'tigrinya', 'Tigrinya (Eritrea)'),
('ti_ET', 'ti', 'tigrinya', 'Tigrinya (Ethiopia)'),
('tk_TM', 'tk', 'turkmen', 'Turkmen (Turkmenistan)'),
('tl_PH', 'tl', 'tagalog', 'Tagalog (Philippines)'),
('tn_ZA', 'tn', 'tswana', 'Tswana (South Africa)'),
('to_TO', 'to', 'tongan', 'Tongan (Tonga)'),
('tr_CY', 'tr', 'turkish', 'Turkish (Cyprus)'),
('tr_TR', 'tr', 'turkish', 'Turkish (Turkey)'),
('ts_ZA', 'ts', 'tsonga', 'Tsonga (South Africa)'),
('tt_RU', 'tt', 'tatar', 'Tatar (Russia)'),
('ug_CN', 'ug', 'uighur', 'Uighur (China)'),
('uk_UA', 'uk', 'ukrainian', 'Ukrainian (Ukraine)'),
('ur_PK', 'ur', 'urdu', 'Urdu (Pakistan)'),
('uz_UZ', 'uz', 'uzbek', 'Uzbek (Uzbekistan)'),
('ve_ZA', 've', 'venda', 'Venda (South Africa)'),
('vi_VN', 'vi', 'vietnamese', 'Vietnamese (Vietnam)'),
('wa_BE', 'wa', 'walloon', 'Walloon (Belgium)'),
('wo_SN', 'wo', 'wolof', 'Wolof (Senegal)'),
('xh_ZA', 'xh', 'xhosa', 'Xhosa (South Africa)'),
('yi_US', 'yi', 'yiddish', 'Yiddish (United States)'),
('yo_NG', 'yo', 'yoruba', 'Yoruba (Nigeria)'),
('zh_CN', 'zh', 'chinese', 'Chinese (China)'),
('zh_HK', 'zh', 'chinese', 'Chinese (Hong Kong SAR China)'),
('zh_SG', 'zh', 'chinese', 'Chinese (Singapore)'),
('zh_TW', 'zh', 'chinese', 'Chinese (Taiwan)'),
('zu_ZA', 'zu', 'zulu', 'Zulu (South Africa)');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_menu`
--

CREATE TABLE IF NOT EXISTS `tbl_menu` (
  `menu_id` int(11) NOT NULL,
  `label` varchar(100) NOT NULL,
  `link` varchar(100) NOT NULL,
  `icon` varchar(100) NOT NULL,
  `parent` int(11) NOT NULL DEFAULT '0',
  `sort` int(11) NOT NULL,
  `time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `status` tinyint(1) DEFAULT '1' COMMENT '1= active 0=inactive'
) ENGINE=InnoDB AUTO_INCREMENT=111 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `tbl_menu`
--

INSERT INTO `tbl_menu` (`menu_id`, `label`, `link`, `icon`, `parent`, `sort`, `time`, `status`) VALUES
(1, 'dashboard', 'admin/dashboard', 'fa fa-dashboard', 0, 0, '2016-06-01 05:09:50', 1),
(2, 'calendar', 'admin/calendar', 'fa fa-calendar', 0, 1, '2016-06-01 05:10:42', 1),
(4, 'client', 'admin/client/manage_client', 'fa fa-users', 0, 17, '2016-12-08 06:51:10', 1),
(5, 'mailbox', 'admin/mailbox', 'fa fa-envelope-o', 0, 18, '2016-12-08 06:51:10', 1),
(6, 'tickets', '#', 'fa fa-ticket', 0, 19, '2016-07-30 18:07:58', 1),
(7, 'all_tickets', 'admin/tickets', 'fa fa-ticket', 6, 4, '2016-05-31 01:20:22', 1),
(8, 'answered', 'admin/tickets/answered', 'fa fa-circle-o', 6, 0, '2016-05-31 01:20:22', 1),
(9, 'open', 'admin/tickets/open', 'fa fa-circle-o', 6, 1, '2016-05-31 01:20:22', 1),
(10, 'in_progress', 'admin/tickets/in_progress', 'fa fa-circle-o', 6, 2, '2016-05-31 01:20:22', 1),
(11, 'closed', 'admin/tickets/closed', 'fa fa-circle-o', 6, 3, '2016-05-31 01:20:22', 1),
(12, 'sales', '#', 'fa fa-shopping-cart', 0, 5, '2016-12-08 06:51:10', 1),
(13, 'invoice', 'admin/invoice/manage_invoice', 'fa fa-circle-o', 12, 0, '2016-07-30 18:07:57', 1),
(14, 'estimates', 'admin/estimates', 'fa fa-circle-o', 12, 2, '2016-07-30 18:07:58', 1),
(15, 'payments_received', 'admin/invoice/all_payments', 'fa fa-circle-o', 12, 3, '2016-05-31 01:28:36', 1),
(16, 'tax_rates', 'admin/invoice/tax_rates', 'fa fa-circle-o', 12, 4, '2016-05-31 01:28:36', 1),
(21, 'quotations', '#', 'fa fa-paste', 0, 26, '2016-07-30 18:07:59', 1),
(22, 'quotations', 'admin/quotations', 'fa fa-circle-o', 21, 0, '2016-05-31 01:20:23', 1),
(23, 'quotations_form', 'admin/quotations/quotations_form', 'fa fa-circle-o', 21, 1, '2016-05-31 01:20:23', 1),
(24, 'user', 'admin/user/user_list', 'fa fa-users', 0, 29, '2016-07-30 18:07:59', 1),
(25, 'settings', 'admin/settings', 'fa fa-cogs', 0, 31, '2016-07-30 18:07:59', 1),
(26, 'database_backup', 'admin/settings/database_backup', 'fa fa-database', 0, 34, '2016-07-30 18:07:59', 1),
(29, 'transactions', '#', 'fa fa-building-o', 0, 4, '2016-12-08 06:51:10', 1),
(30, 'deposit', 'admin/transactions/deposit', 'fa fa-circle-o', 29, 2, '2016-06-01 05:25:24', 1),
(31, 'expense', 'admin/transactions/expense', 'fa fa-circle-o', 29, 1, '2016-06-01 05:25:24', 1),
(32, 'transfer', 'admin/transactions/transfer', 'fa fa-circle-o', 29, 0, '2016-06-01 05:25:24', 1),
(33, 'transactions_report', 'admin/transactions/transactions_report', 'fa fa-circle-o', 29, 3, '2016-06-01 05:25:24', 1),
(34, 'balance_sheet', 'admin/transactions/balance_sheet', 'fa fa-circle-o', 29, 4, '2016-06-01 05:25:24', 1),
(36, 'bank_cash', 'admin/account/manage_account', 'fa fa-money', 0, 20, '2016-07-30 18:07:59', 1),
(39, 'items', 'admin/items/items_list', 'fa fa-cube', 0, 22, '2016-07-30 18:07:59', 1),
(42, 'report', '#', 'fa fa-bar-chart', 0, 24, '2016-07-30 18:07:59', 1),
(43, 'account_statement', 'admin/report/account_statement', 'fa fa-circle-o', 42, 5, '2016-05-31 01:20:23', 1),
(44, 'income_report', 'admin/report/income_report', 'fa fa-circle-o', 42, 6, '2016-05-31 01:20:23', 1),
(45, 'expense_report', 'admin/report/expense_report', 'fa fa-circle-o', 42, 7, '2016-05-31 01:20:23', 1),
(46, 'income_expense', 'admin/report/income_expense', 'fa fa-circle-o', 42, 8, '2016-05-31 01:20:23', 1),
(47, 'date_wise_report', 'admin/report/date_wise_report', 'fa fa-circle-o', 42, 9, '2016-05-31 01:20:23', 1),
(48, 'all_income', 'admin/report/all_income', 'fa fa-circle-o', 42, 10, '2016-05-31 01:20:23', 1),
(49, 'all_expense', 'admin/report/all_expense', 'fa fa-circle-o', 42, 11, '2016-05-31 01:20:23', 1),
(50, 'all_transaction', 'admin/report/all_transaction', 'fa fa-circle-o', 42, 12, '2016-05-31 01:20:23', 1),
(51, 'recurring_invoice', 'admin/invoice/recurring_invoice', 'fa fa-circle-o', 12, 1, '2016-07-30 18:07:58', 1),
(52, 'transfer_report', 'admin/transactions/transfer_report', 'fa fa-circle-o', 29, 5, '2016-06-01 05:25:24', 1),
(53, 'report_by_month', 'admin/report/report_by_month', 'fa fa-circle-o', 42, 13, '2016-05-31 01:20:23', 1),
(54, 'tasks', 'admin/tasks/all_task', 'fa fa-tasks', 0, 11, '2016-12-08 06:51:10', 1),
(55, 'leads', 'admin/leads', 'fa fa-rocket', 0, 10, '2016-12-08 06:51:10', 1),
(56, 'opportunities', 'admin/opportunities', 'fa fa-filter', 0, 13, '2016-12-08 06:51:10', 1),
(57, 'projects', 'admin/projects', 'fa fa-folder-open-o', 0, 2, '2016-12-08 06:51:09', 1),
(58, 'bugs', 'admin/bugs', 'fa fa-bug', 0, 16, '2016-12-08 06:51:10', 1),
(59, 'project', '#', 'fa fa-folder-open-o', 42, 0, '2016-05-31 01:20:22', 1),
(60, 'tasks_report', 'admin/report/tasks_report', 'fa fa-circle-o', 42, 1, '2016-05-31 01:20:22', 1),
(61, 'bugs_report', 'admin/report/bugs_report', 'fa fa-circle-o', 42, 2, '2016-05-31 01:20:22', 1),
(62, 'tickets_report', 'admin/report/tickets_report', 'fa fa-circle-o', 42, 3, '2016-05-31 01:20:22', 1),
(63, 'client_report', 'admin/report/client_report', 'fa fa-circle-o', 42, 4, '2016-05-31 01:20:23', 1),
(66, 'tasks_assignment', 'admin/report/tasks_assignment', 'fa fa-dot-circle-o', 59, 0, '2016-05-31 01:25:02', 1),
(67, 'bugs_assignment', 'admin/report/bugs_assignment', 'fa fa-dot-circle-o', 59, 1, '2016-05-31 01:25:02', 1),
(68, 'project_report', 'admin/report/project_report', 'fa fa-dot-circle-o', 59, 2, '2016-05-31 01:25:02', 1),
(69, 'goal_tracking', 'admin/goal_tracking', 'fa fa-shield', 0, 25, '2016-07-30 18:07:59', 1),
(70, 'departments', 'admin/departments', 'fa fa-user-secret', 0, 30, '2016-07-30 18:07:59', 1),
(71, 'holiday', 'admin/holiday', 'fa fa-calendar-plus-o', 0, 27, '2016-07-30 18:07:59', 1),
(72, 'leave_management', 'admin/leave_management', 'fa fa-plane', 0, 21, '2016-07-30 18:07:59', 1),
(73, 'utilities', '#', 'fa fa-gift', 0, 32, '2016-07-30 18:07:59', 1),
(74, 'overtime', 'admin/utilities/overtime', 'fa fa-clock-o', 73, 0, '2016-05-31 01:20:23', 1),
(75, 'stock', '#', 'fa fa-codepen', 0, 28, '2016-07-30 18:07:59', 1),
(76, 'stock_category', 'admin/stock/stock_category', 'fa fa-sliders', 75, 0, '2016-05-31 01:20:23', 1),
(77, 'manage_stock', '#', 'fa fa-archive', 75, 1, '2016-05-31 01:20:23', 1),
(78, 'assign_stock', '#', 'fa fa-align-left', 75, 2, '2016-05-31 01:20:23', 1),
(79, 'stock_report', 'admin/stock/report', 'fa fa-line-chart', 75, 3, '2016-05-31 01:20:23', 1),
(81, 'stock_list', 'admin/stock/stock_list', 'fa fa-stack-exchange', 77, 1, '2016-05-31 01:25:02', 1),
(82, 'assign_stock', 'admin/stock/assign_stock', 'fa fa-align-left', 78, 0, '2016-05-31 01:25:02', 1),
(83, 'assign_stock_report', 'admin/stock/assign_stock_report', 'fa fa-bar-chart', 78, 1, '2016-05-31 01:25:02', 1),
(84, 'stock_history', 'admin/stock/stock_history', 'fa fa-file-text-o', 77, 0, '2016-05-31 01:25:02', 1),
(85, 'performance', '#', 'fa fa-dribbble', 0, 33, '2016-07-30 18:07:59', 1),
(86, 'performance_indicator', 'admin/performance/performance_indicator', 'fa fa-random', 85, 0, '2016-05-31 01:20:23', 1),
(87, 'performance_report', 'admin/performance/performance_report', 'fa fa-calendar-o', 85, 2, '2016-05-31 01:20:23', 1),
(88, 'give_appraisal', 'admin/performance/give_performance_appraisal', 'fa fa-plus', 85, 1, '2016-05-31 01:20:23', 1),
(89, 'payroll', '#', 'fa fa-usd', 0, 12, '2016-12-08 06:51:10', 1),
(90, 'manage_salary_details', 'admin/payroll/manage_salary_details', 'fa fa-usd', 89, 2, '2016-05-20 16:07:02', 1),
(91, 'employee_salary_list', 'admin/payroll/employee_salary_list', 'fa fa-user-secret', 89, 3, '2016-05-20 16:07:02', 1),
(92, 'make_payment', 'admin/payroll/make_payment', 'fa fa-tasks', 89, 4, '2016-05-20 16:07:02', 1),
(93, 'generate_payslip', 'admin/payroll/generate_payslip', 'fa fa-list-ul', 89, 5, '2016-05-20 16:07:02', 1),
(94, 'salary_template', 'admin/payroll/salary_template', 'fa fa-money', 89, 0, '2016-05-31 01:20:21', 1),
(95, 'hourly_rate', 'admin/payroll/hourly_rate', 'fa fa-clock-o', 89, 1, '2016-05-31 01:20:22', 1),
(96, 'payroll_summary', 'admin/payroll/payroll_summary', 'fa fa-camera-retro', 89, 6, '2016-05-31 01:20:22', 1),
(97, 'provident_fund', 'admin/payroll/provident_fund', 'fa fa-briefcase', 0, 14, '2016-12-08 06:51:10', 1),
(98, 'advance_salary', 'admin/payroll/advance_salary', 'fa fa-cc-mastercard', 0, 23, '2016-07-30 18:07:59', 1),
(99, 'employee_award', 'admin/award', 'fa fa-trophy', 0, 15, '2016-12-08 06:51:10', 1),
(100, 'announcements', 'admin/announcements', 'fa fa-bullhorn icon', 0, 9, '2016-12-08 06:51:10', 1),
(101, 'training', 'admin/training', 'fa fa-suitcase', 0, 8, '2016-12-08 06:51:10', 1),
(102, 'job_circular', '#', 'fa fa-globe', 0, 7, '2016-12-08 06:51:10', 1),
(103, 'jobs_posted', 'admin/job_circular/jobs_posted', 'fa fa-ticket', 102, 0, '2016-05-31 01:20:21', 1),
(104, 'jobs_applications', 'admin/job_circular/jobs_applications', 'fa fa-compass', 102, 1, '2016-05-31 01:20:21', 1),
(105, 'attendance', '#', 'fa fa-file-text', 0, 6, '2016-12-08 06:51:10', 1),
(106, 'timechange_request', 'admin/attendance/timechange_request', 'fa fa-calendar-o', 105, 1, '2016-05-31 01:20:21', 1),
(107, 'attendance_report', 'admin/attendance/attendance_report', 'fa fa-file-text', 105, 2, '2016-05-31 01:20:21', 1),
(108, 'time_history', 'admin/attendance/time_history', 'fa fa-clock-o', 105, 0, '2016-05-31 01:20:21', 1),
(109, 'pull-down', '', '', 0, 0, '2016-06-01 05:13:20', 0),
(110, 'filemanager', 'admin/filemanager', 'fa fa-file', 0, 3, '2016-12-08 06:51:10', 1);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_mettings`
--

CREATE TABLE IF NOT EXISTS `tbl_mettings` (
  `mettings_id` int(11) NOT NULL,
  `leads_id` int(11) DEFAULT NULL,
  `opportunities_id` int(11) DEFAULT NULL,
  `meeting_subject` varchar(200) NOT NULL,
  `attendees` varchar(300) NOT NULL,
  `user_id` int(11) NOT NULL,
  `start_date` varchar(100) NOT NULL,
  `end_date` varchar(100) NOT NULL,
  `location` varchar(100) NOT NULL,
  `description` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_migrations`
--

CREATE TABLE IF NOT EXISTS `tbl_migrations` (
  `version` bigint(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_migrations`
--

INSERT INTO `tbl_migrations` (`version`) VALUES
(112);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_milestones`
--

CREATE TABLE IF NOT EXISTS `tbl_milestones` (
  `milestones_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `project_id` int(11) NOT NULL,
  `milestone_name` varchar(100) NOT NULL,
  `description` varchar(200) NOT NULL,
  `start_date` varchar(20) NOT NULL,
  `end_date` varchar(20) NOT NULL,
  `client_visible` text
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_offence_category`
--

CREATE TABLE IF NOT EXISTS `tbl_offence_category` (
  `offence_id` int(2) NOT NULL,
  `offence_category` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_online_payment`
--

CREATE TABLE IF NOT EXISTS `tbl_online_payment` (
  `online_payment_id` int(11) NOT NULL,
  `gateway_name` varchar(20) CHARACTER SET latin1 NOT NULL,
  `icon` text CHARACTER SET latin1 NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

INSERT INTO `tbl_online_payment` (`online_payment_id`, `gateway_name`, `icon`) VALUES
(1, 'paypal', 'paypal.png'),
(2, 'Stripe', 'stripe.jpg'),
(3, '2checkout', '2checkout.jpg'),
(4, 'Authorize.net', 'Authorizenet.png'),
(5, 'CCAvenue', 'CCAvenue.jpg'),
(6, 'Braintree', 'Braintree.png');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_opportunities`
--

CREATE TABLE IF NOT EXISTS `tbl_opportunities` (
  `opportunities_id` int(11) NOT NULL,
  `opportunity_name` varchar(100) NOT NULL,
  `stages` varchar(20) NOT NULL,
  `probability` varchar(20) NOT NULL,
  `close_date` varchar(20) NOT NULL,
  `opportunities_state_reason_id` int(2) NOT NULL,
  `expected_revenue` decimal(10,2) NOT NULL,
  `new_link` varchar(20) NOT NULL,
  `next_action` varchar(100) NOT NULL,
  `next_action_date` varchar(20) NOT NULL,
  `notes` varchar(500) NOT NULL,
  `permission` text
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_opportunities_state_reason`
--

CREATE TABLE IF NOT EXISTS `tbl_opportunities_state_reason` (
  `opportunities_state_reason_id` int(2) NOT NULL,
  `opportunities_state` varchar(20) NOT NULL,
  `opportunities_state_reason` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_overtime`
--

CREATE TABLE IF NOT EXISTS `tbl_overtime` (
  `overtime_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `overtime_date` date NOT NULL,
  `overtime_hours` varchar(20) NOT NULL,
  `notes` text,
  `status` enum('pending','approved','rejected') NOT NULL DEFAULT 'pending'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_payments`
--

CREATE TABLE IF NOT EXISTS `tbl_payments` (
  `payments_id` int(11) NOT NULL,
  `invoices_id` int(11) NOT NULL,
  `trans_id` varchar(64) COLLATE utf8_unicode_ci DEFAULT NULL,
  `payer_email` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `payment_method` varchar(64) COLLATE utf8_unicode_ci DEFAULT NULL,
  `amount` longtext COLLATE utf8_unicode_ci,
  `currency` varchar(64) COLLATE utf8_unicode_ci DEFAULT 'USD',
  `notes` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `payment_date` varchar(32) COLLATE utf8_unicode_ci DEFAULT NULL,
  `month_paid` varchar(32) COLLATE utf8_unicode_ci DEFAULT NULL,
  `year_paid` varchar(32) COLLATE utf8_unicode_ci DEFAULT NULL,
  `paid_by` int(11) NOT NULL,
  `created_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_payment_methods`
--

CREATE TABLE IF NOT EXISTS `tbl_payment_methods` (
  `payment_methods_id` int(11) NOT NULL,
  `method_name` varchar(64) NOT NULL DEFAULT 'Paypal'
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `tbl_payment_methods`
--

INSERT INTO `tbl_payment_methods` (`payment_methods_id`, `method_name`) VALUES
(1, 'Online'),
(2, 'PayPal'),
(3, 'Payoneer'),
(4, 'Bank Transfer'),
(5, 'Cash ');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_penalty_category`
--

CREATE TABLE IF NOT EXISTS `tbl_penalty_category` (
  `penalty_id` int(2) NOT NULL,
  `penalty_type` varchar(100) NOT NULL,
  `fine_amount` int(11) NOT NULL,
  `penalty_days` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_performance_apprisal`
--

CREATE TABLE IF NOT EXISTS `tbl_performance_apprisal` (
  `performance_appraisal_id` int(5) NOT NULL,
  `user_id` int(2) NOT NULL,
  `general_remarks` text NOT NULL,
  `appraisal_month` varchar(100) NOT NULL,
  `customer_experiece_management` tinyint(1) DEFAULT NULL COMMENT 'Technical - 1 = Beginner, 2 = Intermediate, 3 = Advanced, 4 = Expert / Leader',
  `marketing` tinyint(1) DEFAULT NULL COMMENT 'Technical - 1 = Beginner, 2 = Intermediate, 3 = Advanced, 4 = Expert / Leader',
  `management` tinyint(1) DEFAULT NULL COMMENT 'Technical - 1 = Beginner, 2 = Intermediate, 3 = Advanced, 4 = Expert / Leader',
  `administration` tinyint(1) DEFAULT NULL COMMENT 'Technical - 1 = Beginner, 2 = Intermediate, 3 = Advanced, 4 = Expert / Leader',
  `presentation_skill` tinyint(1) DEFAULT NULL COMMENT 'Technical - 1 = Beginner, 2 = Intermediate, 3 = Advanced, 4 = Expert / Leader',
  `quality_of_work` tinyint(1) DEFAULT NULL COMMENT 'Technical - 1 = Beginner, 2 = Intermediate, 3 = Advanced, 4 = Expert / Leader',
  `efficiency` tinyint(1) DEFAULT NULL COMMENT 'Technical - 1 = Beginner, 2 = Intermediate, 3 = Advanced, 4 = Expert / Leader',
  `integrity` tinyint(1) DEFAULT NULL COMMENT 'Behavioural - 1 (S) = Satisfactory, 2 (U) = Unsatisfactory, 3 (N) = Needs Improvement',
  `professionalism` tinyint(1) DEFAULT NULL COMMENT 'Behavioural - 1 (S) = Satisfactory, 2 (U) = Unsatisfactory, 3 (N) = Needs Improvement',
  `team_work` tinyint(1) DEFAULT NULL COMMENT 'Behavioural - 1 (S) = Satisfactory, 2 (U) = Unsatisfactory, 3 (N) = Needs Improvement',
  `critical_thinking` tinyint(1) DEFAULT NULL COMMENT 'Behavioural - 1 (S) = Satisfactory, 2 (U) = Unsatisfactory, 3 (N) = Needs Improvement',
  `conflict_management` tinyint(1) DEFAULT NULL COMMENT 'Behavioural - 1 (S) = Satisfactory, 2 (U) = Unsatisfactory, 3 (N) = Needs Improvement',
  `attendance` tinyint(1) DEFAULT NULL COMMENT 'Behavioural - 1 (S) = Satisfactory, 2 (U) = Unsatisfactory, 3 (N) = Needs Improvement',
  `ability_to_meed_deadline` tinyint(1) DEFAULT NULL COMMENT 'Behavioural - 1 (S) = Satisfactory, 2 (U) = Unsatisfactory, 3 (N) = Needs Improvement'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_performance_indicator`
--

CREATE TABLE IF NOT EXISTS `tbl_performance_indicator` (
  `performance_indicator_id` int(5) NOT NULL,
  `designations_id` int(2) NOT NULL,
  `customer_experiece_management` tinyint(1) DEFAULT NULL COMMENT 'Technical - 1 = Beginner, 2 = Intermediate, 3 = Advanced, 4 = Expert / Leader',
  `marketing` tinyint(1) DEFAULT NULL COMMENT 'Technical - 1 = Beginner, 2 = Intermediate, 3 = Advanced, 4 = Expert / Leader',
  `management` tinyint(1) DEFAULT NULL COMMENT 'Technical - 1 = Beginner, 2 = Intermediate, 3 = Advanced, 4 = Expert / Leader',
  `administration` tinyint(1) DEFAULT NULL COMMENT 'Technical - 1 = Beginner, 2 = Intermediate, 3 = Advanced, 4 = Expert / Leader',
  `presentation_skill` tinyint(1) DEFAULT NULL COMMENT 'Technical - 1 = Beginner, 2 = Intermediate, 3 = Advanced, 4 = Expert / Leader',
  `quality_of_work` tinyint(1) DEFAULT NULL COMMENT 'Technical - 1 = Beginner, 2 = Intermediate, 3 = Advanced, 4 = Expert / Leader',
  `efficiency` tinyint(1) DEFAULT NULL COMMENT 'Technical - 1 = Beginner, 2 = Intermediate, 3 = Advanced, 4 = Expert / Leader',
  `integrity` tinyint(1) DEFAULT NULL COMMENT 'Behavioural - 1 = Beginner, 2 = Intermediate, 3 = Advanced',
  `professionalism` tinyint(1) DEFAULT NULL COMMENT 'Behavioural - 1 = Beginner, 2 = Intermediate, 3 = Advanced',
  `team_work` tinyint(1) DEFAULT NULL COMMENT 'Behavioural - 1 = Beginner, 2 = Intermediate, 3 = Advanced',
  `critical_thinking` tinyint(1) DEFAULT NULL COMMENT 'Behavioural - 1 = Beginner, 2 = Intermediate, 3 = Advanced',
  `conflict_management` tinyint(1) DEFAULT NULL COMMENT 'Behavioural - 1 = Beginner, 2 = Intermediate, 3 = Advanced',
  `attendance` tinyint(1) DEFAULT NULL COMMENT 'Behavioural - 1 = Beginner, 2 = Intermediate, 3 = Advanced',
  `ability_to_meed_deadline` tinyint(1) DEFAULT NULL COMMENT 'Behavioural - 1 = Beginner, 2 = Intermediate, 3 = Advanced'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_pinaction`
--

CREATE TABLE IF NOT EXISTS `tbl_pinaction` (
  `pinaction_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `module_id` int(11) NOT NULL,
  `module_name` varchar(30) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_priorities`
--

CREATE TABLE IF NOT EXISTS `tbl_priorities` (
  `priority` varchar(200) COLLATE utf8_unicode_ci DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `tbl_priorities`
--

INSERT INTO `tbl_priorities` (`priority`) VALUES
('High'),
('medium'),
('low');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_private_message_send`
--

CREATE TABLE IF NOT EXISTS `tbl_private_message_send` (
  `private_message_send_id` int(11) NOT NULL,
  `send_user_id` int(11) NOT NULL,
  `receive_user_id` int(11) NOT NULL,
  `message` text NOT NULL,
  `message_time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_project`
--

CREATE TABLE IF NOT EXISTS `tbl_project` (
  `project_id` int(11) NOT NULL,
  `project_name` varchar(100) NOT NULL,
  `client_id` int(11) NOT NULL,
  `progress` varchar(50) NOT NULL,
  `calculate_progress` varchar(50) DEFAULT NULL,
  `start_date` varchar(20) NOT NULL,
  `end_date` varchar(20) NOT NULL,
  `project_cost` decimal(18,2) NOT NULL,
  `demo_url` varchar(100) NOT NULL,
  `project_status` varchar(20) NOT NULL,
  `description` text DEFAULT NULL,
  `notify_client` enum('Yes','No') NOT NULL,
  `timer_status` enum('on','off') DEFAULT NULL,
  `timer_started_by` int(11) DEFAULT NULL,
  `start_time` int(11) DEFAULT NULL,
  `logged_time` int(11) DEFAULT NULL,
  `permission` text,
  `notes` text,
  `created_time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `hourly_rate` varchar(200) DEFAULT NULL,
  `fixed_rate` varchar(10) DEFAULT NULL,
  `project_settings` text,
  `with_tasks` enum('yes','no') NOT NULL DEFAULT 'no',
  `estimate_hours` varchar(50) DEFAULT NULL,
  `billing_type` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_project_settings`
--

CREATE TABLE IF NOT EXISTS `tbl_project_settings` (
  `settings_id` int(11) NOT NULL,
  `settings` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `description` varchar(255) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=22 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `tbl_project_settings`
--

INSERT INTO `tbl_project_settings` (`settings_id`, `settings`, `description`) VALUES
(1, 'show_team_members', 'view team members'),
(2, 'show_milestones', 'view project milestones'),
(5, 'show_project_tasks', 'view project tasks'),
(6, 'show_project_attachments', 'view project attachments'),
(7, 'show_timesheets', 'view project timesheets'),
(8, 'show_project_bugs', 'view project bugs'),
(9, 'show_project_history', 'view project history'),
(10, 'show_project_calendar', 'view project calendars'),
(11, 'show_project_comments', 'view project comments'),
(13, 'show_gantt_chart', 'view Gantt chart'),
(14, 'show_project_hours', 'view project hours'),
(15, 'comment_on_project_tasks', 'access To comment on project tasks'),
(16, 'show_project_tasks_attachments', 'view task attachments'),
(20, 'show_tasks_hours', 'show_tasks_hours'),
(21, 'show_finance_overview', 'show_finance_overview');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_quotationforms`
--

CREATE TABLE IF NOT EXISTS `tbl_quotationforms` (
  `quotationforms_id` int(11) NOT NULL,
  `quotationforms_title` varchar(200) NOT NULL,
  `quotationforms_code` text NOT NULL,
  `quotationforms_status` varchar(20) NOT NULL DEFAULT 'enabled' COMMENT 'enabled/disabled',
  `quotations_created_by_id` int(11) NOT NULL,
  `quotationforms_date_created` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_quotations`
--

CREATE TABLE IF NOT EXISTS `tbl_quotations` (
  `quotations_id` int(11) NOT NULL,
  `quotations_form_title` varchar(250) NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `client_id` int(11) DEFAULT NULL,
  `name` varchar(100) DEFAULT NULL,
  `email` varchar(100) DEFAULT NULL,
  `mobile` varchar(100) DEFAULT NULL,
  `quotations_amount` decimal(10,2) DEFAULT NULL,
  `notes` text,
  `reviewer_id` int(11) DEFAULT NULL,
  `reviewed_date` date DEFAULT NULL,
  `quotations_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `quotations_status` varchar(15) DEFAULT 'pending' COMMENT 'completed/pending'
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_quotation_details`
--

CREATE TABLE IF NOT EXISTS `tbl_quotation_details` (
  `quotation_details_id` int(11) NOT NULL,
  `quotations_id` int(11) NOT NULL,
  `quotation_form_data` text,
  `quotation_data` text
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_salary_allowance`
--

CREATE TABLE IF NOT EXISTS `tbl_salary_allowance` (
  `salary_allowance_id` int(11) NOT NULL,
  `salary_template_id` int(11) NOT NULL,
  `allowance_label` varchar(200) NOT NULL,
  `allowance_value` varchar(200) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `tbl_salary_allowance`
--

INSERT INTO `tbl_salary_allowance` (`salary_allowance_id`, `salary_template_id`, `allowance_label`, `allowance_value`) VALUES
(1, 1, 'House Rent Allowance', '300'),
(2, 1, 'Medical Allowance', '100'),
(3, 1, 'Unit Trust', '200');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_salary_deduction`
--

CREATE TABLE IF NOT EXISTS `tbl_salary_deduction` (
  `salary_deduction_id` int(11) NOT NULL,
  `salary_template_id` int(11) NOT NULL,
  `deduction_label` varchar(200) NOT NULL,
  `deduction_value` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_salary_payment`
--

CREATE TABLE IF NOT EXISTS `tbl_salary_payment` (
  `salary_payment_id` int(5) NOT NULL,
  `user_id` int(11) NOT NULL,
  `payment_month` varchar(20) NOT NULL,
  `fine_deduction` varchar(200) NOT NULL,
  `payment_type` varchar(20) NOT NULL,
  `comments` text,
  `paid_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `tbl_salary_payment`
--

INSERT INTO `tbl_salary_payment` (`salary_payment_id`, `user_id`, `payment_month`, `fine_deduction`, `payment_type`, `comments`, `paid_date`) VALUES
(1, 1, '2017-03', '', '4', 'Done', '2017-02-16 02:00:02'),
(2, 1, '2017-02', '', '5', 'Done', '2017-02-16 02:00:42');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_salary_payment_allowance`
--

CREATE TABLE IF NOT EXISTS `tbl_salary_payment_allowance` (
  `salary_payment_allowance_id` int(11) NOT NULL,
  `salary_payment_id` int(11) NOT NULL,
  `salary_payment_allowance_label` varchar(200) NOT NULL,
  `salary_payment_allowance_value` varchar(200) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `tbl_salary_payment_allowance`
--

INSERT INTO `tbl_salary_payment_allowance` (`salary_payment_allowance_id`, `salary_payment_id`, `salary_payment_allowance_label`, `salary_payment_allowance_value`) VALUES
(1, 1, 'House Rent Allowance', '300'),
(2, 1, 'Medical Allowance', '100'),
(3, 1, 'Unit Trust', '200'),
(4, 2, 'House Rent Allowance', '300'),
(5, 2, 'Medical Allowance', '100'),
(6, 2, 'Unit Trust', '200');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_salary_payment_deduction`
--

CREATE TABLE IF NOT EXISTS `tbl_salary_payment_deduction` (
  `salary_payment_deduction` int(11) NOT NULL,
  `salary_payment_id` int(11) NOT NULL,
  `salary_payment_deduction_label` varchar(200) NOT NULL,
  `salary_payment_deduction_value` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_salary_payment_details`
--

CREATE TABLE IF NOT EXISTS `tbl_salary_payment_details` (
  `salary_payment_details_id` int(11) NOT NULL,
  `salary_payment_id` int(11) NOT NULL,
  `salary_payment_details_label` varchar(200) NOT NULL,
  `salary_payment_details_value` varchar(200) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `tbl_salary_payment_details`
--

INSERT INTO `tbl_salary_payment_details` (`salary_payment_details_id`, `salary_payment_id`, `salary_payment_details_label`, `salary_payment_details_value`) VALUES
(1, 1, 'Salary Grades', 'Manager'),
(2, 1, 'Basic Salary', '2000'),
(3, 1, 'Overtime Salary <small>( Per Hour)</small>', '20'),
(4, 1, 'Overtime Hours', '0:0'),
(5, 1, 'Overtime Amount', '0'),
(6, 2, 'Salary Grades', 'Manager'),
(7, 2, 'Basic Salary', '2000'),
(8, 2, 'Overtime Salary <small>( Per Hour)</small>', '20'),
(9, 2, 'Overtime Hours', '0:0'),
(10, 2, 'Overtime Amount', '0');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_salary_payslip`
--

CREATE TABLE IF NOT EXISTS `tbl_salary_payslip` (
  `payslip_id` int(5) NOT NULL,
  `payslip_number` varchar(100) DEFAULT NULL,
  `salary_payment_id` int(5) NOT NULL,
  `payslip_generate_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `tbl_salary_payslip`
--

INSERT INTO `tbl_salary_payslip` (`payslip_id`, `payslip_number`, `salary_payment_id`, `payslip_generate_date`) VALUES
(1, NULL, 2, '2017-02-16 02:00:55');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_salary_template`
--

CREATE TABLE IF NOT EXISTS `tbl_salary_template` (
  `salary_template_id` int(11) NOT NULL,
  `salary_grade` varchar(200) NOT NULL,
  `basic_salary` varchar(200) NOT NULL,
  `overtime_salary` varchar(100) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `tbl_salary_template`
--

INSERT INTO `tbl_salary_template` (`salary_template_id`, `salary_grade`, `basic_salary`, `overtime_salary`) VALUES
(1, 'Manager', '2000', '20');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_saved_items`
--

CREATE TABLE IF NOT EXISTS `tbl_saved_items` (
  `saved_items_id` int(11) NOT NULL,
  `item_name` varchar(200) COLLATE utf8_unicode_ci DEFAULT 'Item Name',
  `item_desc` longtext COLLATE utf8_unicode_ci,
  `unit_cost` decimal(10,2) DEFAULT '0.00',
  `item_tax_rate` decimal(10,2) DEFAULT '0.00',
  `item_tax_total` decimal(10,2) DEFAULT '0.00',
  `quantity` decimal(10,2) DEFAULT '0.00',
  `total_cost` decimal(10,2) DEFAULT '0.00'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_sent`
--

CREATE TABLE IF NOT EXISTS `tbl_sent` (
  `sent_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `to` varchar(100) NOT NULL,
  `subject` varchar(300) NOT NULL,
  `message_body` text NOT NULL,
  `attach_file` varchar(200) DEFAULT NULL,
  `attach_file_path` text,
  `attach_filename` text,
  `message_time` datetime NOT NULL,
  `deleted` enum('Yes','No') NOT NULL DEFAULT 'No'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_status`
--

CREATE TABLE IF NOT EXISTS `tbl_status` (
  `status_id` int(11) NOT NULL,
  `status` varchar(200) NOT NULL
) ENGINE=MyISAM AUTO_INCREMENT=6 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `tbl_status`
--

INSERT INTO `tbl_status` (`status_id`, `status`) VALUES
(1, 'answered'),
(2, 'closed'),
(3, 'open'),
(5, 'in_progress');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_stock`
--

CREATE TABLE IF NOT EXISTS `tbl_stock` (
  `stock_id` int(11) NOT NULL,
  `stock_sub_category_id` int(11) NOT NULL,
  `item_name` varchar(200) NOT NULL,
  `total_stock` int(5) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_stock_category`
--

CREATE TABLE IF NOT EXISTS `tbl_stock_category` (
  `stock_category_id` int(11) NOT NULL,
  `stock_category` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_stock_sub_category`
--

CREATE TABLE IF NOT EXISTS `tbl_stock_sub_category` (
  `stock_sub_category_id` int(11) NOT NULL,
  `stock_category_id` int(11) NOT NULL,
  `stock_sub_category` varchar(200) CHARACTER SET utf8 NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_task`
--

CREATE TABLE IF NOT EXISTS `tbl_task` (
  `task_id` int(5) NOT NULL,
  `project_id` int(11) DEFAULT NULL,
  `milestones_id` int(11) DEFAULT NULL,
  `opportunities_id` int(11) DEFAULT NULL,
  `goal_tracking_id` int(11) DEFAULT NULL,
  `task_name` varchar(200) NOT NULL,
  `task_description` text NOT NULL,
  `task_start_date` date NOT NULL,
  `due_date` date NOT NULL,
  `task_created_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `task_status` varchar(30) DEFAULT NULL,
  `task_progress` int(2) NOT NULL,
  `task_hour` varchar(10) NOT NULL,
  `tasks_notes` text,
  `timer_status` enum('on','off') NOT NULL DEFAULT 'off',
  `timer_started_by` int(11) DEFAULT NULL,
  `start_time` int(11) DEFAULT NULL,
  `logged_time` int(11) NOT NULL DEFAULT '0',
  `leads_id` int(11) DEFAULT NULL,
  `bug_id` int(11) DEFAULT NULL,
  `created_by` int(11) DEFAULT NULL,
  `permission` text,
  `client_visible` varchar(5) DEFAULT NULL,
  `custom_date` text,
  `hourly_rate` decimal(18,2) DEFAULT '0.00'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_tasks_timer`
--

CREATE TABLE IF NOT EXISTS `tbl_tasks_timer` (
  `tasks_timer_id` int(11) NOT NULL,
  `task_id` int(11) NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `start_time` varchar(64) COLLATE utf8_unicode_ci DEFAULT NULL,
  `end_time` varchar(64) COLLATE utf8_unicode_ci DEFAULT NULL,
  `date_timed` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `reason` text CHARACTER SET utf8,
  `edited_by` int(11) DEFAULT NULL,
  `project_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_task_attachment`
--

CREATE TABLE IF NOT EXISTS `tbl_task_attachment` (
  `task_attachment_id` int(5) NOT NULL,
  `task_id` int(11) DEFAULT NULL,
  `user_id` int(11) DEFAULT NULL,
  `title` varchar(200) NOT NULL,
  `description` text NOT NULL,
  `upload_time` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `leads_id` int(11) DEFAULT NULL,
  `opportunities_id` int(11) DEFAULT NULL,
  `project_id` int(11) DEFAULT NULL,
  `bug_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_task_comment`
--

CREATE TABLE IF NOT EXISTS `tbl_task_comment` (
  `task_comment_id` int(5) NOT NULL,
  `task_id` int(11) DEFAULT NULL,
  `user_id` int(11) DEFAULT NULL,
  `comment` text NOT NULL,
  `comment_datetime` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `leads_id` int(11) DEFAULT NULL,
  `opportunities_id` int(11) DEFAULT NULL,
  `project_id` int(11) DEFAULT NULL,
  `bug_id` int(11) DEFAULT NULL,
  `goal_tracking_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_task_uploaded_files`
--

CREATE TABLE IF NOT EXISTS `tbl_task_uploaded_files` (
  `uploaded_files_id` int(11) NOT NULL,
  `task_attachment_id` int(11) NOT NULL,
  `files` text NOT NULL,
  `uploaded_path` text NOT NULL,
  `file_name` text NOT NULL,
  `size` int(10) NOT NULL,
  `ext` varchar(100) NOT NULL,
  `is_image` int(2) NOT NULL,
  `image_width` int(5) NOT NULL,
  `image_height` int(5) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_tax_rates`
--

CREATE TABLE IF NOT EXISTS `tbl_tax_rates` (
  `tax_rates_id` int(11) NOT NULL,
  `tax_rate_name` varchar(25) COLLATE utf8_unicode_ci NOT NULL DEFAULT '0',
  `tax_rate_percent` decimal(10,2) NOT NULL DEFAULT '0.00',
  `permission` text COLLATE utf8_unicode_ci
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_tickets`
--

CREATE TABLE IF NOT EXISTS `tbl_tickets` (
  `tickets_id` int(10) NOT NULL,
  `project_id` int(11) DEFAULT '0',
  `ticket_code` varchar(32) DEFAULT NULL,
  `subject` varchar(200) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `body` text,
  `status` varchar(200) DEFAULT NULL,
  `departments_id` int(11) DEFAULT NULL,
  `reporter` int(10) DEFAULT '0',
  `priority` varchar(50) DEFAULT NULL,
  `upload_file` text,
  `comment` text CHARACTER SET utf8 COLLATE utf8_unicode_ci,
  `created` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `permission` text,
  `last_reply` varchar(200) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_tickets_replies`
--

CREATE TABLE IF NOT EXISTS `tbl_tickets_replies` (
  `tickets_replies_id` int(10) NOT NULL,
  `tickets_id` bigint(10) DEFAULT NULL,
  `body` text COLLATE utf8_unicode_ci,
  `replier` varchar(200) COLLATE utf8_unicode_ci DEFAULT NULL,
  `replierid` int(10) DEFAULT NULL,
  `attachment` text COLLATE utf8_unicode_ci,
  `time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_todo`
--

CREATE TABLE IF NOT EXISTS `tbl_todo` (
  `todo_id` int(11) NOT NULL,
  `title` longtext COLLATE utf8_unicode_ci NOT NULL,
  `user_id` longtext COLLATE utf8_unicode_ci NOT NULL,
  `status` int(11) NOT NULL DEFAULT '0',
  `order` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_training`
--

CREATE TABLE IF NOT EXISTS `tbl_training` (
  `training_id` int(5) NOT NULL,
  `user_id` int(11) NOT NULL,
  `assigned_by` int(11) NOT NULL,
  `training_name` varchar(100) NOT NULL,
  `vendor_name` varchar(100) NOT NULL,
  `start_date` date NOT NULL,
  `finish_date` date NOT NULL,
  `training_cost` varchar(300) DEFAULT NULL,
  `status` tinyint(1) NOT NULL DEFAULT '0' COMMENT '0 = pending, 1 = started, 2 = completed, 3 = terminated',
  `performance` tinyint(1) DEFAULT '0' COMMENT '0 = not concluded, 1 = satisfactory, 2 = average, 3 = poor, 4 = excellent',
  `remarks` text NOT NULL,
  `upload_file` text NOT NULL,
  `permission` text
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_transactions`
--

CREATE TABLE IF NOT EXISTS `tbl_transactions` (
  `transactions_id` int(11) NOT NULL,
  `project_id` int(11) DEFAULT NULL,
  `account_id` int(11) NOT NULL,
  `type` enum('Income','Expense','Transfer') NOT NULL,
  `category_id` int(11) NOT NULL,
  `amount` decimal(18,2) NOT NULL,
  `paid_by` int(11) NOT NULL DEFAULT '0',
  `payment_methods_id` int(11) NOT NULL,
  `reference` varchar(200) NOT NULL,
  `status` enum('non_approved','paid','unpaid') DEFAULT 'non_approved',
  `notes` text NOT NULL,
  `tags` text NOT NULL,
  `tax` decimal(18,2) NOT NULL DEFAULT '0.00',
  `date` date NOT NULL,
  `debit` decimal(18,2) NOT NULL DEFAULT '0.00',
  `credit` decimal(18,2) NOT NULL DEFAULT '0.00',
  `total_balance` decimal(18,2) NOT NULL DEFAULT '0.00',
  `transfer_id` int(11) NOT NULL DEFAULT '0',
  `permission` text,
  `attachement` text,
  `client_visible` enum('Yes','No') NOT NULL DEFAULT 'No',
  `added_by` int(11) NOT NULL DEFAULT '0',
  `paid` int(11) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_transfer`
--

CREATE TABLE IF NOT EXISTS `tbl_transfer` (
  `transfer_id` int(11) NOT NULL,
  `to_account_id` int(11) NOT NULL,
  `from_account_id` int(11) NOT NULL,
  `amount` decimal(18,2) NOT NULL,
  `payment_methods_id` int(11) NOT NULL,
  `reference` varchar(200) CHARACTER SET utf8 NOT NULL,
  `status` enum('Cleared','Uncleared','Reconciled','Void') CHARACTER SET utf8 NOT NULL DEFAULT 'Cleared',
  `notes` text CHARACTER SET utf8 NOT NULL,
  `date` date NOT NULL,
  `type` varchar(20) CHARACTER SET utf8 NOT NULL DEFAULT 'Transfer',
  `permission` text,
  `attachement` text
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_updates`
--

CREATE TABLE IF NOT EXISTS `tbl_updates` (
  `build` int(11) NOT NULL DEFAULT '0',
  `code` varchar(50) DEFAULT NULL,
  `date` timestamp NULL DEFAULT NULL,
  `version` varchar(10) DEFAULT NULL,
  `title` varchar(255) DEFAULT NULL,
  `description` text,
  `filename` varchar(255) DEFAULT NULL,
  `importance` enum('low','medium','high') DEFAULT 'low',
  `dependencies` varchar(255) DEFAULT NULL,
  `installed` int(11) DEFAULT '0',
  `sql` text,
  `files` text,
  `depends` varchar(255) DEFAULT NULL,
  `includes` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_uploaded_files`
--

CREATE TABLE IF NOT EXISTS `tbl_uploaded_files` (
  `uploaded_files_id` int(11) NOT NULL,
  `files_id` int(11) NOT NULL,
  `files` text NOT NULL,
  `uploaded_path` text NOT NULL,
  `file_name` text NOT NULL,
  `size` int(10) NOT NULL,
  `ext` varchar(100) NOT NULL,
  `is_image` int(2) NOT NULL,
  `image_width` int(5) NOT NULL,
  `image_height` int(5) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_users`
--

CREATE TABLE IF NOT EXISTS `tbl_users` (
  `user_id` int(11) NOT NULL,
  `username` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `password` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `email` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `role_id` int(11) NOT NULL DEFAULT '2',
  `activated` tinyint(1) NOT NULL DEFAULT '0',
  `banned` tinyint(4) NOT NULL DEFAULT '0',
  `ban_reason` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `new_password_key` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  `new_password_requested` datetime DEFAULT NULL,
  `new_email` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `new_email_key` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  `last_ip` varchar(40) COLLATE utf8_unicode_ci DEFAULT NULL,
  `last_login` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `created` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `modified` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `online_status` tinyint(1) NOT NULL DEFAULT '0' COMMENT '1 = online 0 = offline ',
  `permission` text COLLATE utf8_unicode_ci,
  `active_email` varchar(5) COLLATE utf8_unicode_ci DEFAULT NULL,
  `smtp_email_type` varchar(5) COLLATE utf8_unicode_ci DEFAULT NULL,
  `smtp_encription` varchar(5) COLLATE utf8_unicode_ci DEFAULT NULL,
  `smtp_action` varchar(5) COLLATE utf8_unicode_ci DEFAULT NULL,
  `smtp_host_name` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  `smtp_username` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  `smtp_password` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `smtp_port` varchar(10) COLLATE utf8_unicode_ci DEFAULT NULL,
  `smtp_additional_flag` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `last_postmaster_run` varchar(200) COLLATE utf8_unicode_ci DEFAULT NULL,
  `media_path_slug` text COLLATE utf8_unicode_ci
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `tbl_users`
--

INSERT INTO `tbl_users` (`user_id`, `username`, `password`, `email`, `role_id`, `activated`, `banned`, `ban_reason`, `new_password_key`, `new_password_requested`, `new_email`, `new_email_key`, `last_ip`, `last_login`, `created`, `modified`, `online_status`, `permission`, `active_email`, `smtp_email_type`, `smtp_encription`, `smtp_action`, `smtp_host_name`, `smtp_username`, `smtp_password`, `smtp_port`, `smtp_additional_flag`, `last_postmaster_run`, `media_path_slug`) VALUES
(1, 'admin', '17ada7ce7a6a9f01f0aabbb431321d365b01a3e3474f107562e738afbfe0c13abf9ea7ee61e22c990912fd2bc5ef0e4c657b4c82f132bf8e79f6dacb14d3c466', 'demo@gmail.com', 1, 1, 0, '', NULL, NULL, 'admin@teamdeck.co', '49315fd6116d162eea47a98904e37b9a', '::1', '2017-02-16 08:24:44', '0000-00-00 00:00:00', '2017-02-16 02:25:45', 1, 'all', 'on', 'on', 'on', 'on', 'imap.gmail.com', 'nayeem.edu01@gmail.com', '23611125', '993', '/notls', '1462138336', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_user_role`
--

CREATE TABLE IF NOT EXISTS `tbl_user_role` (
  `user_role_id` int(11) NOT NULL,
  `designations_id` int(11) DEFAULT NULL,
  `menu_id` int(11) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=941 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `tbl_user_role`
--

INSERT INTO `tbl_user_role` (`user_role_id`, `designations_id`, `menu_id`) VALUES
(566, 1, 1),
(567, 1, 2),
(568, 1, 110),
(569, 1, 29),
(570, 1, 32),
(571, 1, 31),
(572, 1, 30),
(573, 1, 33),
(574, 1, 34),
(575, 1, 52),
(576, 1, 12),
(577, 1, 13),
(578, 1, 51),
(579, 1, 14),
(580, 1, 15),
(581, 1, 16),
(582, 1, 105),
(583, 1, 108),
(584, 1, 106),
(585, 1, 107),
(586, 1, 102),
(587, 1, 103),
(588, 1, 104),
(589, 1, 101),
(590, 1, 100),
(591, 1, 55),
(592, 1, 54),
(593, 1, 89),
(594, 1, 94),
(595, 1, 95),
(596, 1, 90),
(597, 1, 91),
(598, 1, 92),
(599, 1, 93),
(600, 1, 96),
(601, 1, 56),
(602, 1, 97),
(603, 1, 99),
(604, 1, 58),
(605, 1, 4),
(606, 1, 5),
(607, 1, 57),
(608, 1, 6),
(609, 1, 8),
(610, 1, 9),
(611, 1, 10),
(612, 1, 11),
(613, 1, 7),
(614, 1, 36),
(615, 1, 72),
(616, 1, 39),
(617, 1, 98),
(618, 1, 42),
(619, 1, 59),
(620, 1, 66),
(621, 1, 67),
(622, 1, 68),
(623, 1, 60),
(624, 1, 61),
(625, 1, 62),
(626, 1, 63),
(627, 1, 43),
(628, 1, 44),
(629, 1, 45),
(630, 1, 46),
(631, 1, 47),
(632, 1, 48),
(633, 1, 49),
(634, 1, 50),
(635, 1, 53),
(636, 1, 69),
(637, 1, 21),
(638, 1, 22),
(639, 1, 23),
(640, 1, 71),
(641, 1, 75),
(642, 1, 76),
(643, 1, 77),
(644, 1, 84),
(645, 1, 81),
(646, 1, 78),
(647, 1, 82),
(648, 1, 83),
(649, 1, 79),
(650, 1, 24),
(651, 1, 70),
(652, 1, 25),
(653, 1, 73),
(654, 1, 74),
(655, 1, 85),
(656, 1, 86),
(657, 1, 88),
(658, 1, 87),
(659, 1, 26),
(847, 2, 1),
(848, 2, 2),
(849, 2, 57),
(850, 2, 110),
(851, 2, 29),
(852, 2, 32),
(853, 2, 31),
(854, 2, 30),
(855, 2, 33),
(856, 2, 34),
(857, 2, 52),
(858, 2, 12),
(859, 2, 13),
(860, 2, 51),
(861, 2, 14),
(862, 2, 15),
(863, 2, 16),
(864, 2, 105),
(865, 2, 108),
(866, 2, 106),
(867, 2, 107),
(868, 2, 102),
(869, 2, 103),
(870, 2, 104),
(871, 2, 101),
(872, 2, 100),
(873, 2, 55),
(874, 2, 54),
(875, 2, 89),
(876, 2, 94),
(877, 2, 95),
(878, 2, 90),
(879, 2, 91),
(880, 2, 92),
(881, 2, 93),
(882, 2, 96),
(883, 2, 56),
(884, 2, 97),
(885, 2, 99),
(886, 2, 58),
(887, 2, 4),
(888, 2, 5),
(889, 2, 6),
(890, 2, 8),
(891, 2, 9),
(892, 2, 10),
(893, 2, 11),
(894, 2, 7),
(895, 2, 36),
(896, 2, 72),
(897, 2, 39),
(898, 2, 98),
(899, 2, 42),
(900, 2, 59),
(901, 2, 66),
(902, 2, 67),
(903, 2, 68),
(904, 2, 60),
(905, 2, 61),
(906, 2, 62),
(907, 2, 63),
(908, 2, 43),
(909, 2, 44),
(910, 2, 45),
(911, 2, 46),
(912, 2, 47),
(913, 2, 48),
(914, 2, 49),
(915, 2, 50),
(916, 2, 53),
(917, 2, 69),
(918, 2, 21),
(919, 2, 22),
(920, 2, 23),
(921, 2, 71),
(922, 2, 75),
(923, 2, 76),
(924, 2, 77),
(925, 2, 84),
(926, 2, 81),
(927, 2, 78),
(928, 2, 82),
(929, 2, 83),
(930, 2, 79),
(931, 2, 24),
(932, 2, 70),
(933, 2, 25),
(934, 2, 73),
(935, 2, 74),
(936, 2, 85),
(937, 2, 86),
(938, 2, 88),
(939, 2, 87),
(940, 2, 26);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_working_days`
--

CREATE TABLE IF NOT EXISTS `tbl_working_days` (
  `working_days_id` int(11) NOT NULL,
  `day_id` int(5) NOT NULL,
  `start_hours` time NOT NULL,
  `end_hours` time NOT NULL,
  `flag` tinyint(1) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `tbl_working_days`
--

INSERT INTO `tbl_working_days` (`working_days_id`, `day_id`, `start_hours`, `end_hours`, `flag`) VALUES
(1, 1, '15:15:00', '16:15:00', 1),
(2, 2, '00:00:00', '00:00:00', 0),
(3, 3, '16:15:00', '17:15:00', 1),
(4, 4, '00:00:00', '00:00:00', 0),
(5, 5, '17:15:00', '18:15:00', 1),
(6, 6, '00:00:00', '00:00:00', 0),
(7, 7, '18:15:00', '19:15:00', 1);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `installer`
--
ALTER TABLE `installer`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_accounts`
--
ALTER TABLE `tbl_accounts`
  ADD PRIMARY KEY (`account_id`);

--
-- Indexes for table `tbl_account_details`
--
ALTER TABLE `tbl_account_details`
  ADD PRIMARY KEY (`account_details_id`);

--
-- Indexes for table `tbl_activities`
--
ALTER TABLE `tbl_activities`
  ADD PRIMARY KEY (`activities_id`);

--
-- Indexes for table `tbl_advance_salary`
--
ALTER TABLE `tbl_advance_salary`
  ADD PRIMARY KEY (`advance_salary_id`);

--
-- Indexes for table `tbl_announcements`
--
ALTER TABLE `tbl_announcements`
  ADD PRIMARY KEY (`announcements_id`);

--
-- Indexes for table `tbl_assign_item`
--
ALTER TABLE `tbl_assign_item`
  ADD PRIMARY KEY (`assign_item_id`);

--
-- Indexes for table `tbl_attendance`
--
ALTER TABLE `tbl_attendance`
  ADD PRIMARY KEY (`attendance_id`);

--
-- Indexes for table `tbl_bug`
--
ALTER TABLE `tbl_bug`
  ADD PRIMARY KEY (`bug_id`);

--
-- Indexes for table `tbl_calls`
--
ALTER TABLE `tbl_calls`
  ADD PRIMARY KEY (`calls_id`);

--
-- Indexes for table `tbl_client`
--
ALTER TABLE `tbl_client`
  ADD PRIMARY KEY (`client_id`);

--
-- Indexes for table `tbl_clock`
--
ALTER TABLE `tbl_clock`
  ADD PRIMARY KEY (`clock_id`);

--
-- Indexes for table `tbl_clock_history`
--
ALTER TABLE `tbl_clock_history`
  ADD PRIMARY KEY (`clock_history_id`);

--
-- Indexes for table `tbl_config`
--
ALTER TABLE `tbl_config`
  ADD PRIMARY KEY (`config_key`);

--
-- Indexes for table `tbl_countries`
--
ALTER TABLE `tbl_countries`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_currencies`
--
ALTER TABLE `tbl_currencies`
  ADD PRIMARY KEY (`code`);

--
-- Indexes for table `tbl_custom_field`
--
ALTER TABLE `tbl_custom_field`
  ADD PRIMARY KEY (`custom_field_id`);

--
-- Indexes for table `tbl_days`
--
ALTER TABLE `tbl_days`
  ADD PRIMARY KEY (`day_id`);

--
-- Indexes for table `tbl_departments`
--
ALTER TABLE `tbl_departments`
  ADD PRIMARY KEY (`departments_id`);

--
-- Indexes for table `tbl_designations`
--
ALTER TABLE `tbl_designations`
  ADD PRIMARY KEY (`designations_id`);

--
-- Indexes for table `tbl_discipline`
--
ALTER TABLE `tbl_discipline`
  ADD PRIMARY KEY (`discipline_id`);

--
-- Indexes for table `tbl_draft`
--
ALTER TABLE `tbl_draft`
  ADD PRIMARY KEY (`draft_id`);

--
-- Indexes for table `tbl_email_templates`
--
ALTER TABLE `tbl_email_templates`
  ADD PRIMARY KEY (`email_templates_id`);

--
-- Indexes for table `tbl_employee_award`
--
ALTER TABLE `tbl_employee_award`
  ADD PRIMARY KEY (`employee_award_id`);

--
-- Indexes for table `tbl_employee_bank`
--
ALTER TABLE `tbl_employee_bank`
  ADD PRIMARY KEY (`employee_bank_id`);

--
-- Indexes for table `tbl_employee_document`
--
ALTER TABLE `tbl_employee_document`
  ADD PRIMARY KEY (`document_id`);

--
-- Indexes for table `tbl_employee_payroll`
--
ALTER TABLE `tbl_employee_payroll`
  ADD PRIMARY KEY (`payroll_id`);

--
-- Indexes for table `tbl_estimates`
--
ALTER TABLE `tbl_estimates`
  ADD PRIMARY KEY (`estimates_id`), ADD UNIQUE KEY `reference_no` (`reference_no`);

--
-- Indexes for table `tbl_estimate_items`
--
ALTER TABLE `tbl_estimate_items`
  ADD PRIMARY KEY (`estimate_items_id`);

--
-- Indexes for table `tbl_expense_category`
--
ALTER TABLE `tbl_expense_category`
  ADD PRIMARY KEY (`expense_category_id`);

--
-- Indexes for table `tbl_files`
--
ALTER TABLE `tbl_files`
  ADD PRIMARY KEY (`files_id`);

--
-- Indexes for table `tbl_form`
--
ALTER TABLE `tbl_form`
  ADD PRIMARY KEY (`form_id`);

--
-- Indexes for table `tbl_goal_tracking`
--
ALTER TABLE `tbl_goal_tracking`
  ADD PRIMARY KEY (`goal_tracking_id`);

--
-- Indexes for table `tbl_goal_type`
--
ALTER TABLE `tbl_goal_type`
  ADD PRIMARY KEY (`goal_type_id`);

--
-- Indexes for table `tbl_holiday`
--
ALTER TABLE `tbl_holiday`
  ADD PRIMARY KEY (`holiday_id`);

--
-- Indexes for table `tbl_hourly_rate`
--
ALTER TABLE `tbl_hourly_rate`
  ADD PRIMARY KEY (`hourly_rate_id`);

--
-- Indexes for table `tbl_inbox`
--
ALTER TABLE `tbl_inbox`
  ADD PRIMARY KEY (`inbox_id`);

--
-- Indexes for table `tbl_income_category`
--
ALTER TABLE `tbl_income_category`
  ADD PRIMARY KEY (`income_category_id`);

--
-- Indexes for table `tbl_invoices`
--
ALTER TABLE `tbl_invoices`
  ADD PRIMARY KEY (`invoices_id`), ADD UNIQUE KEY `reference_no` (`reference_no`);

--
-- Indexes for table `tbl_items`
--
ALTER TABLE `tbl_items`
  ADD PRIMARY KEY (`items_id`);

--
-- Indexes for table `tbl_item_history`
--
ALTER TABLE `tbl_item_history`
  ADD PRIMARY KEY (`item_history_id`);

--
-- Indexes for table `tbl_job_appliactions`
--
ALTER TABLE `tbl_job_appliactions`
  ADD PRIMARY KEY (`job_appliactions_id`);

--
-- Indexes for table `tbl_job_circular`
--
ALTER TABLE `tbl_job_circular`
  ADD PRIMARY KEY (`job_circular_id`);

--
-- Indexes for table `tbl_languages`
--
ALTER TABLE `tbl_languages`
  ADD PRIMARY KEY (`code`);

--
-- Indexes for table `tbl_leads`
--
ALTER TABLE `tbl_leads`
  ADD PRIMARY KEY (`leads_id`);

--
-- Indexes for table `tbl_lead_source`
--
ALTER TABLE `tbl_lead_source`
  ADD PRIMARY KEY (`lead_source_id`);

--
-- Indexes for table `tbl_lead_status`
--
ALTER TABLE `tbl_lead_status`
  ADD PRIMARY KEY (`lead_status_id`);

--
-- Indexes for table `tbl_leave_application`
--
ALTER TABLE `tbl_leave_application`
  ADD PRIMARY KEY (`leave_application_id`);

--
-- Indexes for table `tbl_leave_category`
--
ALTER TABLE `tbl_leave_category`
  ADD PRIMARY KEY (`leave_category_id`);

--
-- Indexes for table `tbl_locales`
--
ALTER TABLE `tbl_locales`
  ADD PRIMARY KEY (`locale`);

--
-- Indexes for table `tbl_menu`
--
ALTER TABLE `tbl_menu`
  ADD PRIMARY KEY (`menu_id`);

--
-- Indexes for table `tbl_mettings`
--
ALTER TABLE `tbl_mettings`
  ADD PRIMARY KEY (`mettings_id`);

--
-- Indexes for table `tbl_milestones`
--
ALTER TABLE `tbl_milestones`
  ADD PRIMARY KEY (`milestones_id`);

--
-- Indexes for table `tbl_offence_category`
--
ALTER TABLE `tbl_offence_category`
  ADD PRIMARY KEY (`offence_id`);

--
-- Indexes for table `tbl_online_payment`
--
ALTER TABLE `tbl_online_payment`
  ADD PRIMARY KEY (`online_payment_id`);

--
-- Indexes for table `tbl_opportunities`
--
ALTER TABLE `tbl_opportunities`
  ADD PRIMARY KEY (`opportunities_id`);

--
-- Indexes for table `tbl_opportunities_state_reason`
--
ALTER TABLE `tbl_opportunities_state_reason`
  ADD PRIMARY KEY (`opportunities_state_reason_id`);

--
-- Indexes for table `tbl_overtime`
--
ALTER TABLE `tbl_overtime`
  ADD PRIMARY KEY (`overtime_id`);

--
-- Indexes for table `tbl_payments`
--
ALTER TABLE `tbl_payments`
  ADD PRIMARY KEY (`payments_id`);

--
-- Indexes for table `tbl_payment_methods`
--
ALTER TABLE `tbl_payment_methods`
  ADD PRIMARY KEY (`payment_methods_id`);

--
-- Indexes for table `tbl_penalty_category`
--
ALTER TABLE `tbl_penalty_category`
  ADD PRIMARY KEY (`penalty_id`);

--
-- Indexes for table `tbl_performance_apprisal`
--
ALTER TABLE `tbl_performance_apprisal`
  ADD PRIMARY KEY (`performance_appraisal_id`);

--
-- Indexes for table `tbl_performance_indicator`
--
ALTER TABLE `tbl_performance_indicator`
  ADD PRIMARY KEY (`performance_indicator_id`);

--
-- Indexes for table `tbl_pinaction`
--
ALTER TABLE `tbl_pinaction`
  ADD PRIMARY KEY (`pinaction_id`);

--
-- Indexes for table `tbl_private_message_send`
--
ALTER TABLE `tbl_private_message_send`
  ADD PRIMARY KEY (`private_message_send_id`);

--
-- Indexes for table `tbl_project`
--
ALTER TABLE `tbl_project`
  ADD PRIMARY KEY (`project_id`);

--
-- Indexes for table `tbl_project_settings`
--
ALTER TABLE `tbl_project_settings`
  ADD PRIMARY KEY (`settings_id`);

--
-- Indexes for table `tbl_quotationforms`
--
ALTER TABLE `tbl_quotationforms`
  ADD PRIMARY KEY (`quotationforms_id`);

--
-- Indexes for table `tbl_quotations`
--
ALTER TABLE `tbl_quotations`
  ADD PRIMARY KEY (`quotations_id`);

--
-- Indexes for table `tbl_quotation_details`
--
ALTER TABLE `tbl_quotation_details`
  ADD PRIMARY KEY (`quotation_details_id`);

--
-- Indexes for table `tbl_salary_allowance`
--
ALTER TABLE `tbl_salary_allowance`
  ADD PRIMARY KEY (`salary_allowance_id`);

--
-- Indexes for table `tbl_salary_deduction`
--
ALTER TABLE `tbl_salary_deduction`
  ADD PRIMARY KEY (`salary_deduction_id`);

--
-- Indexes for table `tbl_salary_payment`
--
ALTER TABLE `tbl_salary_payment`
  ADD PRIMARY KEY (`salary_payment_id`);

--
-- Indexes for table `tbl_salary_payment_allowance`
--
ALTER TABLE `tbl_salary_payment_allowance`
  ADD PRIMARY KEY (`salary_payment_allowance_id`);

--
-- Indexes for table `tbl_salary_payment_deduction`
--
ALTER TABLE `tbl_salary_payment_deduction`
  ADD PRIMARY KEY (`salary_payment_deduction`);

--
-- Indexes for table `tbl_salary_payment_details`
--
ALTER TABLE `tbl_salary_payment_details`
  ADD PRIMARY KEY (`salary_payment_details_id`);

--
-- Indexes for table `tbl_salary_payslip`
--
ALTER TABLE `tbl_salary_payslip`
  ADD PRIMARY KEY (`payslip_id`);

--
-- Indexes for table `tbl_salary_template`
--
ALTER TABLE `tbl_salary_template`
  ADD PRIMARY KEY (`salary_template_id`);

--
-- Indexes for table `tbl_saved_items`
--
ALTER TABLE `tbl_saved_items`
  ADD PRIMARY KEY (`saved_items_id`);

--
-- Indexes for table `tbl_sent`
--
ALTER TABLE `tbl_sent`
  ADD PRIMARY KEY (`sent_id`);

--
-- Indexes for table `tbl_status`
--
ALTER TABLE `tbl_status`
  ADD PRIMARY KEY (`status_id`);

--
-- Indexes for table `tbl_stock`
--
ALTER TABLE `tbl_stock`
  ADD PRIMARY KEY (`stock_id`);

--
-- Indexes for table `tbl_stock_category`
--
ALTER TABLE `tbl_stock_category`
  ADD PRIMARY KEY (`stock_category_id`);

--
-- Indexes for table `tbl_stock_sub_category`
--
ALTER TABLE `tbl_stock_sub_category`
  ADD PRIMARY KEY (`stock_sub_category_id`);

--
-- Indexes for table `tbl_task`
--
ALTER TABLE `tbl_task`
  ADD PRIMARY KEY (`task_id`);

--
-- Indexes for table `tbl_tasks_timer`
--
ALTER TABLE `tbl_tasks_timer`
  ADD PRIMARY KEY (`tasks_timer_id`);

--
-- Indexes for table `tbl_task_attachment`
--
ALTER TABLE `tbl_task_attachment`
  ADD PRIMARY KEY (`task_attachment_id`);

--
-- Indexes for table `tbl_task_comment`
--
ALTER TABLE `tbl_task_comment`
  ADD PRIMARY KEY (`task_comment_id`);

--
-- Indexes for table `tbl_task_uploaded_files`
--
ALTER TABLE `tbl_task_uploaded_files`
  ADD PRIMARY KEY (`uploaded_files_id`);

--
-- Indexes for table `tbl_tax_rates`
--
ALTER TABLE `tbl_tax_rates`
  ADD KEY `Index 1` (`tax_rates_id`);

--
-- Indexes for table `tbl_tickets`
--
ALTER TABLE `tbl_tickets`
  ADD PRIMARY KEY (`tickets_id`);

--
-- Indexes for table `tbl_tickets_replies`
--
ALTER TABLE `tbl_tickets_replies`
  ADD PRIMARY KEY (`tickets_replies_id`);

--
-- Indexes for table `tbl_todo`
--
ALTER TABLE `tbl_todo`
  ADD PRIMARY KEY (`todo_id`);

--
-- Indexes for table `tbl_training`
--
ALTER TABLE `tbl_training`
  ADD PRIMARY KEY (`training_id`);

--
-- Indexes for table `tbl_transactions`
--
ALTER TABLE `tbl_transactions`
  ADD PRIMARY KEY (`transactions_id`);

--
-- Indexes for table `tbl_transfer`
--
ALTER TABLE `tbl_transfer`
  ADD PRIMARY KEY (`transfer_id`);

--
-- Indexes for table `tbl_updates`
--
ALTER TABLE `tbl_updates`
  ADD PRIMARY KEY (`build`);

--
-- Indexes for table `tbl_uploaded_files`
--
ALTER TABLE `tbl_uploaded_files`
  ADD PRIMARY KEY (`uploaded_files_id`);

--
-- Indexes for table `tbl_users`
--
ALTER TABLE `tbl_users`
  ADD PRIMARY KEY (`user_id`), ADD UNIQUE KEY `username` (`username`);

--
-- Indexes for table `tbl_user_role`
--
ALTER TABLE `tbl_user_role`
  ADD PRIMARY KEY (`user_role_id`);

--
-- Indexes for table `tbl_working_days`
--
ALTER TABLE `tbl_working_days`
  ADD PRIMARY KEY (`working_days_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `tbl_accounts`
--
ALTER TABLE `tbl_accounts`
  MODIFY `account_id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `tbl_account_details`
--
ALTER TABLE `tbl_account_details`
  MODIFY `account_details_id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `tbl_activities`
--
ALTER TABLE `tbl_activities`
  MODIFY `activities_id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=22;
--
-- AUTO_INCREMENT for table `tbl_advance_salary`
--
ALTER TABLE `tbl_advance_salary`
  MODIFY `advance_salary_id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `tbl_announcements`
--
ALTER TABLE `tbl_announcements`
  MODIFY `announcements_id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `tbl_assign_item`
--
ALTER TABLE `tbl_assign_item`
  MODIFY `assign_item_id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `tbl_attendance`
--
ALTER TABLE `tbl_attendance`
  MODIFY `attendance_id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `tbl_bug`
--
ALTER TABLE `tbl_bug`
  MODIFY `bug_id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `tbl_calls`
--
ALTER TABLE `tbl_calls`
  MODIFY `calls_id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `tbl_client`
--
ALTER TABLE `tbl_client`
  MODIFY `client_id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `tbl_clock`
--
ALTER TABLE `tbl_clock`
  MODIFY `clock_id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `tbl_clock_history`
--
ALTER TABLE `tbl_clock_history`
  MODIFY `clock_history_id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `tbl_countries`
--
ALTER TABLE `tbl_countries`
  MODIFY `id` int(6) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=242;
--
-- AUTO_INCREMENT for table `tbl_custom_field`
--
ALTER TABLE `tbl_custom_field`
  MODIFY `custom_field_id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `tbl_days`
--
ALTER TABLE `tbl_days`
  MODIFY `day_id` int(5) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=8;
--
-- AUTO_INCREMENT for table `tbl_departments`
--
ALTER TABLE `tbl_departments`
  MODIFY `departments_id` int(10) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=9;
--
-- AUTO_INCREMENT for table `tbl_designations`
--
ALTER TABLE `tbl_designations`
  MODIFY `designations_id` int(5) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `tbl_discipline`
--
ALTER TABLE `tbl_discipline`
  MODIFY `discipline_id` int(5) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `tbl_draft`
--
ALTER TABLE `tbl_draft`
  MODIFY `draft_id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `tbl_email_templates`
--
ALTER TABLE `tbl_email_templates`
  MODIFY `email_templates_id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=60;
--
-- AUTO_INCREMENT for table `tbl_employee_award`
--
ALTER TABLE `tbl_employee_award`
  MODIFY `employee_award_id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `tbl_employee_bank`
--
ALTER TABLE `tbl_employee_bank`
  MODIFY `employee_bank_id` int(5) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `tbl_employee_document`
--
ALTER TABLE `tbl_employee_document`
  MODIFY `document_id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `tbl_employee_payroll`
--
ALTER TABLE `tbl_employee_payroll`
  MODIFY `payroll_id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `tbl_estimates`
--
ALTER TABLE `tbl_estimates`
  MODIFY `estimates_id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `tbl_estimate_items`
--
ALTER TABLE `tbl_estimate_items`
  MODIFY `estimate_items_id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `tbl_expense_category`
--
ALTER TABLE `tbl_expense_category`
  MODIFY `expense_category_id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `tbl_files`
--
ALTER TABLE `tbl_files`
  MODIFY `files_id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `tbl_form`
--
ALTER TABLE `tbl_form`
  MODIFY `form_id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=11;
--
-- AUTO_INCREMENT for table `tbl_goal_tracking`
--
ALTER TABLE `tbl_goal_tracking`
  MODIFY `goal_tracking_id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `tbl_goal_type`
--
ALTER TABLE `tbl_goal_type`
  MODIFY `goal_type_id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `tbl_holiday`
--
ALTER TABLE `tbl_holiday`
  MODIFY `holiday_id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `tbl_hourly_rate`
--
ALTER TABLE `tbl_hourly_rate`
  MODIFY `hourly_rate_id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `tbl_inbox`
--
ALTER TABLE `tbl_inbox`
  MODIFY `inbox_id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `tbl_income_category`
--
ALTER TABLE `tbl_income_category`
  MODIFY `income_category_id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `tbl_invoices`
--
ALTER TABLE `tbl_invoices`
  MODIFY `invoices_id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `tbl_items`
--
ALTER TABLE `tbl_items`
  MODIFY `items_id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `tbl_item_history`
--
ALTER TABLE `tbl_item_history`
  MODIFY `item_history_id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `tbl_job_appliactions`
--
ALTER TABLE `tbl_job_appliactions`
  MODIFY `job_appliactions_id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `tbl_job_circular`
--
ALTER TABLE `tbl_job_circular`
  MODIFY `job_circular_id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `tbl_leads`
--
ALTER TABLE `tbl_leads`
  MODIFY `leads_id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `tbl_lead_source`
--
ALTER TABLE `tbl_lead_source`
  MODIFY `lead_source_id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `tbl_lead_status`
--
ALTER TABLE `tbl_lead_status`
  MODIFY `lead_status_id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `tbl_leave_application`
--
ALTER TABLE `tbl_leave_application`
  MODIFY `leave_application_id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `tbl_leave_category`
--
ALTER TABLE `tbl_leave_category`
  MODIFY `leave_category_id` int(2) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `tbl_menu`
--
ALTER TABLE `tbl_menu`
  MODIFY `menu_id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=111;
--
-- AUTO_INCREMENT for table `tbl_mettings`
--
ALTER TABLE `tbl_mettings`
  MODIFY `mettings_id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `tbl_milestones`
--
ALTER TABLE `tbl_milestones`
  MODIFY `milestones_id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `tbl_offence_category`
--
ALTER TABLE `tbl_offence_category`
  MODIFY `offence_id` int(2) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `tbl_online_payment`
--
ALTER TABLE `tbl_online_payment`
  MODIFY `online_payment_id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `tbl_opportunities`
--
ALTER TABLE `tbl_opportunities`
  MODIFY `opportunities_id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `tbl_opportunities_state_reason`
--
ALTER TABLE `tbl_opportunities_state_reason`
  MODIFY `opportunities_state_reason_id` int(2) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `tbl_overtime`
--
ALTER TABLE `tbl_overtime`
  MODIFY `overtime_id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `tbl_payments`
--
ALTER TABLE `tbl_payments`
  MODIFY `payments_id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `tbl_payment_methods`
--
ALTER TABLE `tbl_payment_methods`
  MODIFY `payment_methods_id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT for table `tbl_penalty_category`
--
ALTER TABLE `tbl_penalty_category`
  MODIFY `penalty_id` int(2) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `tbl_performance_apprisal`
--
ALTER TABLE `tbl_performance_apprisal`
  MODIFY `performance_appraisal_id` int(5) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `tbl_performance_indicator`
--
ALTER TABLE `tbl_performance_indicator`
  MODIFY `performance_indicator_id` int(5) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `tbl_pinaction`
--
ALTER TABLE `tbl_pinaction`
  MODIFY `pinaction_id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `tbl_private_message_send`
--
ALTER TABLE `tbl_private_message_send`
  MODIFY `private_message_send_id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `tbl_project`
--
ALTER TABLE `tbl_project`
  MODIFY `project_id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `tbl_project_settings`
--
ALTER TABLE `tbl_project_settings`
  MODIFY `settings_id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=22;
--
-- AUTO_INCREMENT for table `tbl_quotationforms`
--
ALTER TABLE `tbl_quotationforms`
  MODIFY `quotationforms_id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `tbl_quotations`
--
ALTER TABLE `tbl_quotations`
  MODIFY `quotations_id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `tbl_quotation_details`
--
ALTER TABLE `tbl_quotation_details`
  MODIFY `quotation_details_id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `tbl_salary_allowance`
--
ALTER TABLE `tbl_salary_allowance`
  MODIFY `salary_allowance_id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `tbl_salary_deduction`
--
ALTER TABLE `tbl_salary_deduction`
  MODIFY `salary_deduction_id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `tbl_salary_payment`
--
ALTER TABLE `tbl_salary_payment`
  MODIFY `salary_payment_id` int(5) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `tbl_salary_payment_allowance`
--
ALTER TABLE `tbl_salary_payment_allowance`
  MODIFY `salary_payment_allowance_id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=7;
--
-- AUTO_INCREMENT for table `tbl_salary_payment_deduction`
--
ALTER TABLE `tbl_salary_payment_deduction`
  MODIFY `salary_payment_deduction` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `tbl_salary_payment_details`
--
ALTER TABLE `tbl_salary_payment_details`
  MODIFY `salary_payment_details_id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=11;
--
-- AUTO_INCREMENT for table `tbl_salary_payslip`
--
ALTER TABLE `tbl_salary_payslip`
  MODIFY `payslip_id` int(5) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `tbl_salary_template`
--
ALTER TABLE `tbl_salary_template`
  MODIFY `salary_template_id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `tbl_saved_items`
--
ALTER TABLE `tbl_saved_items`
  MODIFY `saved_items_id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `tbl_sent`
--
ALTER TABLE `tbl_sent`
  MODIFY `sent_id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `tbl_status`
--
ALTER TABLE `tbl_status`
  MODIFY `status_id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT for table `tbl_stock`
--
ALTER TABLE `tbl_stock`
  MODIFY `stock_id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `tbl_stock_category`
--
ALTER TABLE `tbl_stock_category`
  MODIFY `stock_category_id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `tbl_stock_sub_category`
--
ALTER TABLE `tbl_stock_sub_category`
  MODIFY `stock_sub_category_id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `tbl_task`
--
ALTER TABLE `tbl_task`
  MODIFY `task_id` int(5) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `tbl_tasks_timer`
--
ALTER TABLE `tbl_tasks_timer`
  MODIFY `tasks_timer_id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `tbl_task_attachment`
--
ALTER TABLE `tbl_task_attachment`
  MODIFY `task_attachment_id` int(5) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `tbl_task_comment`
--
ALTER TABLE `tbl_task_comment`
  MODIFY `task_comment_id` int(5) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `tbl_task_uploaded_files`
--
ALTER TABLE `tbl_task_uploaded_files`
  MODIFY `uploaded_files_id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `tbl_tax_rates`
--
ALTER TABLE `tbl_tax_rates`
  MODIFY `tax_rates_id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `tbl_tickets`
--
ALTER TABLE `tbl_tickets`
  MODIFY `tickets_id` int(10) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `tbl_tickets_replies`
--
ALTER TABLE `tbl_tickets_replies`
  MODIFY `tickets_replies_id` int(10) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `tbl_todo`
--
ALTER TABLE `tbl_todo`
  MODIFY `todo_id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `tbl_training`
--
ALTER TABLE `tbl_training`
  MODIFY `training_id` int(5) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `tbl_transactions`
--
ALTER TABLE `tbl_transactions`
  MODIFY `transactions_id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `tbl_transfer`
--
ALTER TABLE `tbl_transfer`
  MODIFY `transfer_id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `tbl_uploaded_files`
--
ALTER TABLE `tbl_uploaded_files`
  MODIFY `uploaded_files_id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `tbl_users`
--
ALTER TABLE `tbl_users`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `tbl_user_role`
--
ALTER TABLE `tbl_user_role`
  MODIFY `user_role_id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=941;
--
-- AUTO_INCREMENT for table `tbl_working_days`
--
ALTER TABLE `tbl_working_days`
  MODIFY `working_days_id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=8;
