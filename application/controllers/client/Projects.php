<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Projects extends Client_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->model('items_model');
        $this->load->model('invoice_model');

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

    public function index($id = NULL)
    {
        $data['title'] = lang('all_project');
        $data['breadcrumbs'] = lang('project');
        $data['page'] = lang('project');
        // get all assign_user
        $this->items_model->_table_name = 'tbl_users';
        $this->items_model->_order_by = 'user_id';
        $data['assign_user'] = $this->items_model->get_by(array('role_id !=' => '2'), FALSE);
        if (!empty($id)) {
            $data['active'] = 2;
            $data['project_info'] = $this->items_model->check_by(array('project_id' => $id), 'tbl_project');
        } else {
            $data['active'] = 1;
        }
        $data['subview'] = $this->load->view('client/projects/all_project', $data, TRUE);
        $this->load->view('client/_layout_main', $data); //page load
    }

    public function saved_project($id = NULL)
    {
        $this->items_model->_table_name = 'tbl_project';
        $this->items_model->_primary_key = 'project_id';
        $data = $this->items_model->array_from_post(array('project_name', 'start_date', 'end_date','billing_type', 'project_cost', 'hourly_rate', 'demo_url', 'description'));
        $data['client_id'] = $this->session->userdata('client_id');
        if (empty($id)) {
            $data['project_status'] = 'started';
            $data['progress'] = '0';
        }

        $return_id = $this->items_model->save($data, $id);

        $assigned_to['assigned_to'] = $this->items_model->allowad_user_id('57');

        if (!empty($id)) {
            $id = $id;
            $action = 'activity_update_project';
            $msg = lang('update_project');
        } else {
            $id = $return_id;
            $action = 'activity_save_project';
            $msg = lang('save_project');
            $this->send_project_notify_client($return_id);
            $this->send_project_notify_assign_user($return_id, $assigned_to['assigned_to']);
        }
        $activity = array(
            'user' => $this->session->userdata('user_id'),
            'module' => 'project',
            'module_field_id' => $id,
            'activity' => $action,
            'icon' => 'fa-circle-o',
            'value1' => $data['project_name']
        );
        $this->items_model->_table_name = 'tbl_activities';
        $this->items_model->_primary_key = 'activities_id';
        $this->items_model->save($activity);
        // messages for user
        $type = "success";
        $message = $msg;
        set_message($type, $message);
        redirect('client/projects');
    }

    public function send_project_notify_assign_user($project_id, $users)
    {

        $email_template = $this->items_model->check_by(array('email_group' => 'assigned_project'), 'tbl_email_templates');
        $project_info = $this->items_model->check_by(array('project_id' => $project_id), 'tbl_project');
        $message = $email_template->template_body;

        $subject = $email_template->subject;

        $project_name = str_replace("{PROJECT_NAME}", $project_info->project_name, $message);

        $assigned_by = str_replace("{ASSIGNED_BY}", ucfirst($this->session->userdata('name')), $project_name);
        $Link = str_replace("{PROJECT_LINK}", base_url() . 'client/projects/project_details/' . $project_id, $assigned_by);
        $message = str_replace("{SITE_NAME}", config_item('company_name'), $Link);

        $data['message'] = $message;
        $message = $this->load->view('email_template', $data, TRUE);

        $params['subject'] = $subject;
        $params['message'] = $message;
        $params['resourceed_file'] = '';

        foreach ($users as $v_user) {
            $login_info = $this->items_model->check_by(array('user_id' => $v_user), 'tbl_users');
            $params['recipient'] = $login_info->email;
            $this->items_model->send_email($params);
        }
    }

    public function send_project_notify_client($project_id, $complete = NULL)
    {
        if (!empty($complete)) {
            $email_template = $this->items_model->check_by(array('email_group' => 'complete_projects'), 'tbl_email_templates');
        } else {
            $email_template = $this->items_model->check_by(array('email_group' => 'client_notification'), 'tbl_email_templates');
        }
        $project_info = $this->items_model->check_by(array('project_id' => $project_id), 'tbl_project');
        $client_info = $this->items_model->check_by(array('client_id' => $project_info->client_id), 'tbl_client');
        $message = $email_template->template_body;

        $subject = $email_template->subject;

        $clientName = str_replace("{CLIENT_NAME}", $client_info->name, $message);
        $project_name = str_replace("{PROJECT_NAME}", $project_info->project_name, $clientName);

        $Link = str_replace("{PROJECT_LINK}", base_url() . 'client/projects/project_details/' . $project_id, $project_name);
        $message = str_replace("{SITE_NAME}", config_item('company_name'), $Link);

        $data['message'] = $message;
        $message = $this->load->view('email_template', $data, TRUE);

        $params['subject'] = $subject;
        $params['message'] = $message;
        $params['resourceed_file'] = '';

        $params['recipient'] = $client_info->email;
        $this->items_model->send_email($params);
    }

    public function project_details($id, $active = NULL, $op_id = NULL)
    {
        $data['title'] = lang('project_details');
        $data['breadcrumbs'] = lang('project_details');
        $data['page'] = lang('project');
        //get all task information
        $data['project_details'] = $this->items_model->check_by(array('project_id' => $id), 'tbl_project');

        $this->items_model->_table_name = "tbl_task_attachment"; //table name
        $this->items_model->_order_by = "project_id";
        $data['files_info'] = $this->items_model->get_by(array('project_id' => $id), FALSE);

        if (!empty($data['files_info'])) {
            foreach ($data['files_info'] as $key => $v_files) {
                $this->items_model->_table_name = "tbl_task_uploaded_files"; //table name
                $this->items_model->_order_by = "task_attachment_id";
                $data['project_files_info'][$key] = $this->items_model->get_by(array('task_attachment_id' => $v_files->task_attachment_id), FALSE);
            }
        }
        if ($active == 2) {
            $data['active'] = 2;
            $data['miles_active'] = 1;
            $data['task_active'] = 1;
            $data['bugs_active'] = 1;
            $data['time_active'] = 1;
        } elseif ($active == 3) {
            $data['active'] = 3;
            $data['miles_active'] = 1;
            $data['task_active'] = 1;
            $data['bugs_active'] = 1;
            $data['time_active'] = 1;
        } elseif ($active == 4) {
            $data['active'] = 4;
            $data['miles_active'] = 1;
            $data['task_active'] = 1;
            $data['bugs_active'] = 1;
            $data['time_active'] = 1;
        } elseif ($active == 5) {
            $data['active'] = 5;
            $data['miles_active'] = 1;
            $data['task_active'] = 1;
            $data['bugs_active'] = 1;
            $data['time_active'] = 1;
        } elseif ($active == 'milestone') {
            $data['active'] = 5;
            $data['miles_active'] = 2;
            $data['task_active'] = 1;
            $data['bugs_active'] = 1;
            $data['time_active'] = 1;
            $data['milestones_info'] = $this->items_model->check_by(array('milestones_id' => $op_id), 'tbl_milestones');
        } elseif ($active == 6) {
            $data['active'] = 6;
            $data['miles_active'] = 1;
            $data['task_active'] = 1;
            $data['bugs_active'] = 1;
            $data['time_active'] = 1;
        } elseif ($active == 7) {
            $data['active'] = 7;
            $data['miles_active'] = 1;
            $data['task_active'] = 1;
            $data['bugs_active'] = 1;
            if (!empty($op_id)) {
                $data['time_active'] = 2;
                $data['project_timer_info'] = $this->items_model->check_by(array('tasks_timer_id' => $op_id), 'tbl_tasks_timer');
            } else {
                $data['time_active'] = 1;
            }
        } elseif ($active == 8) {
            $data['active'] = 8;
            $data['miles_active'] = 1;
            $data['task_active'] = 1;
            $data['bugs_active'] = 1;
            $data['time_active'] = 1;
        } elseif ($active == 10) {
            $data['active'] = 10;
            $data['miles_active'] = 1;
            $data['task_active'] = 1;
            $data['bugs_active'] = 1;
            $data['time_active'] = 1;
        }  elseif ($active == 13) {
            $data['active'] = 13;
            $data['miles_active'] = 1;
            $data['task_active'] = 1;
            $data['bugs_active'] = 1;
            $data['time_active'] = 1;
        } elseif ($active == 15) {
            $data['active'] = 15;
            $data['miles_active'] = 1;
            $data['task_active'] = 1;
            $data['bugs_active'] = 1;
            $data['time_active'] = 1;
        } else {
            $data['active'] = 1;
            $data['miles_active'] = 1;
            $data['task_active'] = 1;
            $data['bugs_active'] = 1;
            $data['time_active'] = 1;
        }


        $data['subview'] = $this->load->view('client/projects/project_details', $data, TRUE);
        $this->load->view('client/_layout_main', $data);
    }


    public function save_comments()
    {

        $data['project_id'] = $this->input->post('project_id', TRUE);
        $data['comment'] = $this->input->post('comment', TRUE);
        $data['user_id'] = $this->session->userdata('user_id');

        //save data into table.
        $this->items_model->_table_name = "tbl_task_comment"; // table name
        $this->items_model->_primary_key = "task_comment_id"; // $id
        $this->items_model->save($data);

        // save into activities
        $activities = array(
            'user' => $this->session->userdata('user_id'),
            'module' => 'project',
            'module_field_id' => $data['project_id'],
            'activity' => 'activity_new_project_comment',
            'icon' => 'fa-ticket',
            'value1' => $data['comment'],
        );
        // Update into tbl_project
        $this->items_model->_table_name = "tbl_activities"; //table name
        $this->items_model->_primary_key = "activities_id";
        $this->items_model->save($activities);


        $type = "success";
        $message = lang('project_comment_save');
        set_message($type, $message);
        redirect('client/projects/project_details/' . $data['project_id'] . '/' . '3');
    }

    public function delete_comments($project_id, $task_comment_id)
    {
        //save data into table.
        $this->items_model->_table_name = "tbl_task_comment"; // table name
        $this->items_model->_primary_key = "task_comment_id"; // $id
        $this->items_model->delete($task_comment_id);

        $type = "success";
        $message = lang('task_comment_deleted');
        set_message($type, $message);
        redirect('client/projects/project_details/' . $project_id . '/' . '3');
    }

    public function save_attachment($task_attachment_id = NULL)
    {
        $data = $this->items_model->array_from_post(array('title', 'description', 'project_id'));
        $data['user_id'] = $this->session->userdata('user_id');

        // save and update into tbl_files
        $this->items_model->_table_name = "tbl_task_attachment"; //table name
        $this->items_model->_primary_key = "task_attachment_id";
        if (!empty($task_attachment_id)) {
            $id = $task_attachment_id;
            $this->items_model->save($data, $id);
            $msg = lang('project_file_updated');
        } else {
            $id = $this->items_model->save($data);
            $msg = lang('project_file_added');
        }

        if (!empty($_FILES['task_files']['name']['0'])) {
            $old_path_info = $this->input->post('uploaded_path');
            if (!empty($old_path_info)) {
                foreach ($old_path_info as $old_path) {
                    unlink($old_path);
                }
            }
            $mul_val = $this->items_model->multi_uploadAllType('task_files');

            foreach ($mul_val as $val) {
                $val == TRUE || redirect('client/projects/project_details/' . $data['project_id'] . '/' . '4');
                $fdata['files'] = $val['path'];
                $fdata['file_name'] = $val['fileName'];
                $fdata['uploaded_path'] = $val['fullPath'];
                $fdata['size'] = $val['size'];
                $fdata['ext'] = $val['ext'];
                $fdata['is_image'] = $val['is_image'];
                $fdata['image_width'] = $val['image_width'];
                $fdata['image_height'] = $val['image_height'];
                $fdata['task_attachment_id'] = $id;
                $this->items_model->_table_name = "tbl_task_uploaded_files"; // table name
                $this->items_model->_primary_key = "uploaded_files_id"; // $id
                $this->items_model->save($fdata);
            }
        }
        // save into activities
        $activities = array(
            'user' => $this->session->userdata('user_id'),
            'module' => 'project',
            'module_field_id' => $id,
            'activity' => 'activity_new_project_attachment',
            'icon' => 'fa-ticket',
            'value1' => $data['title'],
        );
        // Update into tbl_project
        $this->items_model->_table_name = "tbl_activities"; //table name
        $this->items_model->_primary_key = "activities_id";
        $this->items_model->save($activities);
        // messages for user
        $type = "success";
        $message = $msg;
        set_message($type, $message);
        redirect('client/projects/project_details/' . $data['project_id'] . '/' . '4');
    }

    public function delete_files($project_id, $task_attachment_id)
    {
        $file_info = $this->items_model->check_by(array('task_attachment_id' => $task_attachment_id), 'tbl_task_attachment');
        // save into activities
        $activities = array(
            'user' => $this->session->userdata('user_id'),
            'module' => 'project',
            'module_field_id' => $project_id,
            'activity' => 'activity_project_attachfile_deleted',
            'icon' => 'fa-ticket',
            'value1' => $file_info->title,
        );
        // Update into tbl_project
        $this->items_model->_table_name = "tbl_activities"; //table name
        $this->items_model->_primary_key = "activities_id";
        $this->items_model->save($activities);

        //save data into table.
        $this->items_model->_table_name = "tbl_task_attachment"; // table name        
        $this->items_model->delete_multiple(array('task_attachment_id' => $task_attachment_id));

        //save data into table.
        $this->items_model->_table_name = "tbl_task_uploaded_files"; // table name        
        $this->items_model->delete_multiple(array('task_attachment_id' => $task_attachment_id));

        $type = "success";
        $message = lang('project_attachfile_deleted');
        set_message($type, $message);
        redirect('client/projects/project_details/' . $project_id . '/' . '4');
    }


    public function download_files($project_id, $uploaded_files_id)
    {

        $this->load->helper('download');

        $uploaded_files_info = $this->items_model->check_by(array('uploaded_files_id' => $uploaded_files_id), 'tbl_task_uploaded_files');
        if (!empty($uploaded_files_info->uploaded_path)) {

            $data = file_get_contents($uploaded_files_info->uploaded_path); // Read the file's contents
            if (!empty($data)) {
                force_download($uploaded_files_info->file_name, $data);
            } else {
                $type = "error";
                $message = lang('operation_failed');
                set_message($type, $message);
                redirect('client/projects/project_details/' . $project_id . '/3');
            }

        } else {
            $type = "error";
            $message = lang('operation_failed');
            set_message($type, $message);
            redirect('client/projects/project_details/' . $project_id . '/3');

        }

    }

}
