<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Utilities extends Admin_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->model('utilities_model');

        $this->load->helper('ckeditor');
        $this->data['ckeditor'] = array(
            'id' => 'ck_editor',
            'path' => 'asset/js/ckeditor',
            'config' => array(
                'toolbar' => "Full",
                'width' => "99.8%",
                'height' => "400px"
            )
        );
    }

    public function overtime()
    {
        $data['title'] = lang('overtime_details');
        // active check with current month
        $data['current_month'] = date('m');
        if ($this->input->post('year', TRUE)) { // if input year
            $data['year'] = $this->input->post('year', TRUE);
        } else { // else current year
            $data['year'] = date('Y'); // get current year
        }
        // get all expense list by year and month
        $data['all_overtime_info'] = $this->get_overtime_info($data['year']);

        $data['subview'] = $this->load->view('admin/utilities/overtime/overtime', $data, TRUE);
        $this->load->view('admin/_layout_main', $data);
    }

    public function add_overtime($id = null)
    {
        // active check with current month
        $data['current_month'] = date('m');
        if ($this->input->post('year', TRUE)) { // if input year
            $data['year'] = $this->input->post('year', TRUE);
        } else { // else current year
            $data['year'] = date('Y'); // get current year
        }

        $data['all_employee'] = $this->utilities_model->get_all_employee();
        if (!empty($id)) {
            $data['overtime_info'] = $this->utilities_model->get_overtime_info_by_emp_id($id);
        }
        $data['modal_subview'] = $this->load->view('admin/utilities/overtime/new_overtime', $data, FALSE);
        $this->load->view('admin/_layout_modal', $data);
    }

    public function get_overtime_info($year, $month = NULL)
    {// this function is to create get monthy recap report
        if (!empty($month)) {
            if ($month >= 1 && $month <= 9) { // if i<=9 concate with Mysql.becuase on Mysql query fast in two digit like 01.
                $start_date = $year . "-" . '0' . $month . '-' . '01';
                $end_date = $year . "-" . '0' . $month . '-' . '31';
            } else {
                $start_date = $year . "-" . $month . '-' . '01';
                $end_date = $year . "-" . $month . '-' . '31';
            }
            $get_expense_list = $this->utilities_model->get_overtime_info_by_date($start_date, $end_date); // get all report by start date and in date
        } else {
            for ($i = 1; $i <= 12; $i++) { // query for months
                if ($i >= 1 && $i <= 9) { // if i<=9 concate with Mysql.becuase on Mysql query fast in two digit like 01.
                    $start_date = $year . "-" . '0' . $i . '-' . '01';
                    $end_date = $year . "-" . '0' . $i . '-' . '31';
                } else {
                    $start_date = $year . "-" . $i . '-' . '01';
                    $end_date = $year . "-" . $i . '-' . '31';
                }
                $get_expense_list[$i] = $this->utilities_model->get_overtime_info_by_date($start_date, $end_date); // get all report by start date and in date
            }
        }
        return $get_expense_list; // return the result
    }

    public function overtime_report_pdf($year, $month)
    {
        $data['overtime_info'] = $this->get_overtime_info($year, $month);
        $month_name = date('F', strtotime($year . '-' . $month)); // get full name of month by date query
        $data['monthyaer'] = $month_name . '  ' . $year;

        $this->load->helper('dompdf');
        $viewfile = $this->load->view('admin/utilities/overtime/overtime_report_pdf', $data, TRUE);
        pdf_create($viewfile, 'Overtime Report  - ' . $data['monthyaer']);
    }

    public function save_overtime($id = NULL)
    {
        $data = $this->utilities_model->array_from_post(array('user_id', 'overtime_date', 'overtime_hours', 'notes'));
        if (empty($data['user_id'])) {
            $data['user_id'] = $this->session->userdata('user_id');
        }
        // check existing data by employee id and date
        $where = array('user_id' => $data['user_id'], 'overtime_date' => $data['overtime_date']);
        // duplicate value check in DB
        if (!empty($id)) { // if id exist in db update data
            $overtime_id = array('overtime_id !=' => $id);
        } else { // if id is not exist then set id as null
            $overtime_id = null;
        }
        $check_existing_data = $this->utilities_model->check_update('tbl_overtime', $where, $overtime_id);
        if (!empty($check_existing_data)) {
            $type = "error";
            $message = lang('overtime_already_exist');
        } else {
            if ($this->session->userdata('user_type') == 1) {
                $data['status'] = 'approved';
            } elseif (empty($id)) {

                $data['status'] = 'pending';
                $profile_info = $this->utilities_model->check_by(array('user_id' => $data['user_id']), 'tbl_account_details');
                // get departments head user id
                $designation_info = $this->utilities_model->check_by(array('designations_id' => $profile_info->designations_id), 'tbl_designations');
                // get departments head by departments id
                $dept_head = $this->utilities_model->check_by(array('departments_id' => $designation_info->departments_id), 'tbl_departments');

                if (!empty($dept_head->department_head_id)) {
                    $overtime_email = config_item('overtime_email');
                    if (!empty($overtime_email) && $overtime_email == 1) {
                        $email_template = $this->utilities_model->check_by(array('email_group' => 'overtime_request_email'), 'tbl_email_templates');
                        $user_info = $this->utilities_model->check_by(array('user_id' => $dept_head->department_head_id), 'tbl_users');
                        $message = $email_template->template_body;
                        $subject = $email_template->subject;
                        $username = str_replace("{NAME}", $profile_info->fullname, $message);
                        $message = str_replace("{SITE_NAME}", config_item('company_name'), $username);
                        $data['message'] = $message;
                        $message = $this->load->view('email_template', $data, TRUE);

                        $params['subject'] = $subject;
                        $params['message'] = $message;
                        $params['resourceed_file'] = '';
                        $params['recipient'] = $user_info->email;
                        $this->utilities_model->send_email($params);
                    }
                }
            }

            $this->utilities_model->_table_name = "tbl_overtime"; //table name
            $this->utilities_model->_primary_key = "overtime_id";
            $id = $this->utilities_model->save($data, $id);
            $type = "success";
            $message = lang('overtime_saved');

            // save into activities
            $activities = array(
                'user' => $this->session->userdata('user_id'),
                'module' => 'overtime',
                'module_field_id' => $id,
                'activity' => lang('activity_new_overtime'),
                'icon' => 'fa-copy',
                'value1' => $data['overtime_date'],
            );
            // Update into tbl_project
            $this->utilities_model->_table_name = "tbl_activities"; //table name
            $this->utilities_model->_primary_key = "activities_id";
            $this->utilities_model->save($activities);
        }
        set_message($type, $message);
        redirect('admin/utilities/overtime'); //redirect page
    }

    public function change_overtime_status($status, $id)

    {
        $overtime_info = $this->db->where('overtime_id', $id)->get('tbl_overtime')->row();
        $data['status'] = $status;
        if ($status == 'approved') {
            $this->send_overtime_status_by_email($overtime_info, true);
        } elseif ($status == 'rejected') {
            $this->send_overtime_status_by_email($overtime_info);
        }
        $this->utilities_model->_table_name = "tbl_overtime"; //table name
        $this->utilities_model->_primary_key = "overtime_id";
        $id = $this->utilities_model->save($data, $id);
        $type = "success";
        $message = lang('overtime_change_status');
        // save into activities
        $activities = array(
            'user' => $this->session->userdata('user_id'),
            'module' => 'overtime',
            'module_field_id' => $id,
            'activity' => lang('activity_new_overtime'),
            'icon' => 'fa-copy',
            'value1' => $overtime_info->overtime_date,
        );
        // Update into tbl_project
        $this->utilities_model->_table_name = "tbl_activities"; //table name
        $this->utilities_model->_primary_key = "activities_id";
        $this->utilities_model->save($activities);
        set_message($type, $message);
        redirect($_SERVER['HTTP_REFERER']);
    }

    function send_overtime_status_by_email($appl_info, $approve = null)
    {
        $overtime_email = config_item('overtime_email');
        if (!empty($overtime_email) && $overtime_email == 1) {
            if (!empty($approve)) {
                $email_template = $this->utilities_model->check_by(array('email_group' => 'overtime_approved_email'), 'tbl_email_templates');
            } else {
                $email_template = $this->utilities_model->check_by(array('email_group' => 'overtime_reject_email'), 'tbl_email_templates');
            }
            $user_info = $this->utilities_model->check_by(array('user_id' => $appl_info->user_id), 'tbl_users');
            $message = $email_template->template_body;
            $subject = $email_template->subject;
            $Date = str_replace("{DATE}", $appl_info->overtime_date, $message);
            $hours = str_replace("{HOUR}", $appl_info->overtime_hours, $Date);
            $message = str_replace("{SITE_NAME}", config_item('company_name'), $hours);
            $data['message'] = $message;
            $message = $this->load->view('email_template', $data, TRUE);

            $params['subject'] = $subject;
            $params['message'] = $message;
            $params['resourceed_file'] = '';
            $params['recipient'] = $user_info->email;

            $this->utilities_model->send_email($params);
        } else {
            return true;
        }
    }

    public function delete_overtime($id)
    {
        $this->utilities_model->_table_name = "tbl_overtime"; //table name
        $this->utilities_model->_primary_key = "overtime_id";
        $this->utilities_model->delete($id);
        // save into activities
        $activities = array(
            'user' => $this->session->userdata('user_id'),
            'module' => 'overtime',
            'module_field_id' => $id,
            'activity' => lang('activity_delete_overtime'),
            'icon' => 'fa-copy',
            'value1' => $this->db->where('overtime_id', $id)->get('tbl_overtime')->row()->overtime_date,
        );
        // Update into tbl_project
        $this->utilities_model->_table_name = "tbl_activities"; //table name
        $this->utilities_model->_primary_key = "activities_id";
        $this->utilities_model->save($activities);

        $type = "success";
        $message = lang('overtime_deleted');
        set_message($type, $message);
        redirect('admin/utilities/overtime'); //redirect page
    }

}
