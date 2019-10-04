<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Opportunities extends Admin_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->model('items_model');

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

        $data['title'] = lang('all_opportunities');
        // get permission user by menu id
        $data['assign_user'] = $this->items_model->allowad_user('56');

        $opportunities_state_reason = $this->db->get('tbl_opportunities_state_reason')->result();
        foreach ($opportunities_state_reason as $opportunities_state) {
            $data['all_state'][$opportunities_state->opportunities_state][] = $opportunities_state;
        }
        if (!empty($id)) {
            $data['active'] = 2;
            $can_edit = $this->items_model->can_action('tbl_opportunities', 'edit', array('opportunities_id' => $id));
            if (!empty($can_edit)) {
                $data['opportunity_info'] = $this->items_model->check_by(array('opportunities_id' => $id), 'tbl_opportunities');
            }
        } else {
            $data['active'] = 1;
        }

        $data['all_opportunity'] = $this->items_model->get_permission('tbl_opportunities');

        $data['subview'] = $this->load->view('admin/opportunities/all_opportunities', $data, TRUE);
        $this->load->view('admin/_layout_main', $data); //page load
    }

    public function saved_opportunity($id = NULL)
    {
        $this->items_model->_table_name = 'tbl_opportunities';
        $this->items_model->_primary_key = 'opportunities_id';

        $data = $this->items_model->array_from_post(array('opportunity_name', 'stages', 'probability', 'close_date', 'opportunities_state_reason_id', 'expected_revenue', 'new_link', 'next_action', 'next_action_date', 'notes'));
        $permission = $this->input->post('permission', true);
        if (!empty($permission)) {

            if ($permission == 'everyone') {
                $assigned = 'all';
            } else {
                $assigned_to = $this->items_model->array_from_post(array('assigned_to'));
                if (!empty($assigned_to['assigned_to'])) {
                    foreach ($assigned_to['assigned_to'] as $assign_user) {
                        $assigned[$assign_user] = $this->input->post('action_' . $assign_user, true);
                    }
                }
            }
            if ($assigned != 'all') {
                $assigned = json_encode($assigned);
            }
            $data['permission'] = $assigned;
        } else {
            set_message('error', lang('assigned_to') . ' Field is required');
            redirect($_SERVER['HTTP_REFERER']);
        }
        // update root category
        $where = array('opportunity_name' => $data['opportunity_name']);
        // duplicate value check in DB
        if (!empty($id)) { // if id exist in db update data
            $opportunities_id = array('opportunities_id !=' => $id);
        } else { // if id is not exist then set id as null
            $opportunities_id = null;
        }

        // check whether this input data already exist or not
        $check_opportunity = $this->items_model->check_update('tbl_opportunities', $where, $opportunities_id);
        if (!empty($check_opportunity)) { // if input data already exist show error alert
            // massage for user
            $type = 'error';
            $msg = "<strong style='color:#000'>" . $data['opportunity_name'] . '</strong>  ' . lang('already_exist');
        } else { // save and update query                                    
            $return_id = $this->items_model->save($data, $id);
            if (!empty($id)) {
                $id = $id;
                $action = 'activity_update_opportunity';
                $msg = lang('update_opportunity');
            } else {
                $id = $return_id;
                $action = 'activity_save_opportunity';
                $msg = lang('save_opportunity');
            }
            save_custom_field(8, $id);
            $activity = array(
                'user' => $this->session->userdata('user_id'),
                'module' => 'opportunity',
                'module_field_id' => $id,
                'activity' => $action,
                'icon' => 'fa-circle-o',
                'value1' => $data['opportunity_name']
            );
            $this->items_model->_table_name = 'tbl_activities';
            $this->items_model->_primary_key = 'activities_id';
            $this->items_model->save($activity);
            // messages for user
            $type = "success";
        }
        $message = $msg;
        set_message($type, $message);
        redirect($_SERVER['HTTP_REFERER']);
    }

    public function update_users($id)
    {
        $can_edit = $this->items_model->can_action('tbl_opportunities', 'edit', array('opportunities_id' => $id));
        if (!empty($can_edit)) {
            // get permission user by menu id
            $data['assign_user'] = $this->items_model->allowad_user('56');

            $data['opportunities_info'] = $this->items_model->check_by(array('opportunities_id' => $id), 'tbl_opportunities');
            $data['modal_subview'] = $this->load->view('admin/opportunities/_modal_users', $data, FALSE);
            $this->load->view('admin/_layout_modal', $data);
        } else {
            set_message('error', lang('there_in_no_value'));
            redirect($_SERVER['HTTP_REFERER']);
        }
    }

    public function update_member($id)
    {
        $can_edit = $this->items_model->can_action('tbl_opportunities', 'edit', array('opportunities_id' => $id));
        if (!empty($can_edit)) {
            $opp_info = $this->items_model->check_by(array('opportunities_id' => $id), 'tbl_opportunities');

            $permission = $this->input->post('permission', true);
            if (!empty($permission)) {

                if ($permission == 'everyone') {
                    $assigned = 'all';
                } else {
                    $assigned_to = $this->items_model->array_from_post(array('assigned_to'));
                    if (!empty($assigned_to['assigned_to'])) {
                        foreach ($assigned_to['assigned_to'] as $assign_user) {
                            $assigned[$assign_user] = $this->input->post('action_' . $assign_user, true);
                        }
                    }
                }
                if ($assigned != 'all') {
                    $assigned = json_encode($assigned);
                }
                $data['permission'] = $assigned;
            } else {
                set_message('error', lang('assigned_to') . ' Field is required');
                redirect($_SERVER['HTTP_REFERER']);
            }

//save data into table.
            $this->items_model->_table_name = "tbl_opportunities"; // table name
            $this->items_model->_primary_key = "opportunities_id"; // $id
            $this->items_model->save($data, $id);

            $msg = lang('update_opportunity');
            $activity = 'activity_update_opportunity';
// save into activities
            $activities = array(
                'user' => $this->session->userdata('user_id'),
                'module' => 'opportunity',
                'module_field_id' => $id,
                'activity' => $activity,
                'icon' => 'fa-ticket',
                'value1' => $opp_info->opportunity_name,
            );
// Update into tbl_project
            $this->items_model->_table_name = "tbl_activities"; //table name
            $this->items_model->_primary_key = "activities_id";
            $this->items_model->save($activities);

            $type = "success";
            $message = $msg;
            set_message($type, $message);
        } else {
            set_message('error', lang('there_in_no_value'));
        }
        redirect($_SERVER['HTTP_REFERER']);
    }

    public function change_state($id, $opportunities_state_reason_id)
    {
        $can_edit = $this->items_model->can_action('tbl_opportunities', 'edit', array('opportunities_id' => $id));
        if (!empty($can_edit)) {
            $data['opportunities_state_reason_id'] = $opportunities_state_reason_id;
            $this->items_model->_table_name = 'tbl_opportunities';
            $this->items_model->_primary_key = 'opportunities_id';
            $this->items_model->save($data, $id);
            // messages for user
            $type = "success";
            $message = lang('change_status');
            set_message($type, $message);

        } else {
            set_message('error', lang('there_in_no_value'));
        }
        redirect($_SERVER['HTTP_REFERER']);
    }

    public function opportunity_details($id, $active = NULL, $op_id = NULL)
    {
        $data['title'] = lang('opportunity_details');
        $data['page_header'] = lang('task_management');
        //get all task information
        $data['opportunity_details'] = $this->items_model->check_by(array('opportunities_id' => $id), 'tbl_opportunities');

        $this->items_model->_table_name = "tbl_task_attachment"; //table name
        $this->items_model->_order_by = "task_id";
        $data['files_info'] = $this->items_model->get_by(array('opportunities_id' => $id), FALSE);

        foreach ($data['files_info'] as $key => $v_files) {
            $this->items_model->_table_name = "tbl_task_uploaded_files"; //table name
            $this->items_model->_order_by = "task_attachment_id";
            $data['project_files_info'][$key] = $this->items_model->get_by(array('task_attachment_id' => $v_files->task_attachment_id), FALSE);
        }

        if ($active == 2) {
            $data['active'] = 2;
            $data['sub_active'] = 1;
            $data['sub_metting'] = 1;
            $data['task_active'] = 1;
            $data['bugs_active '] = 1;
        } elseif ($active == 3) {
            $data['active'] = 3;
            $data['sub_active'] = 1;
            $data['sub_metting'] = 1;
            $data['task_active'] = 1;
            $data['bugs_active '] = 1;
        } elseif ($active == 4) {
            $data['active'] = 4;
            $data['sub_active'] = 1;
            $data['sub_metting'] = 1;
            $data['task_active'] = 1;
            $data['bugs_active '] = 1;
        } elseif ($active == 5) {
            $data['active'] = 5;
            $data['sub_active'] = 1;
            $data['sub_metting'] = 1;
            $data['task_active'] = 1;
            $data['bugs_active '] = 1;
        } elseif ($active == 'metting') {
            $data['active'] = 3;
            $data['sub_active'] = 1;
            $data['sub_metting'] = 2;
            $data['task_active'] = 1;
            $data['bugs_active '] = 1;
            $data['mettings_info'] = $this->items_model->check_by(array('mettings_id' => $op_id), 'tbl_mettings');
        } elseif ($active == 'call') {
            $data['active'] = 2;
            $data['sub_active'] = 2;
            $data['call_info'] = $this->items_model->check_by(array('calls_id' => $op_id), 'tbl_calls');
            $data['sub_metting'] = 1;
            $data['task_active'] = 1;
            $data['bugs_active '] = 1;
        } else {
            $data['active'] = 1;
            $data['sub_active'] = 1;
            $data['sub_metting'] = 1;
            $data['task_active'] = 1;
            $data['bugs_active '] = 1;
        }

        $data['subview'] = $this->load->view('admin/opportunities/opportunities_details', $data, TRUE);
        $this->load->view('admin/_layout_main', $data);
    }

    public function saved_call($opportunities_id, $id = NULL)
    {
        $data = $this->items_model->array_from_post(array('date', 'call_summary', 'client_id', 'user_id'));

        $data['opportunities_id'] = $opportunities_id;
        $this->items_model->_table_name = 'tbl_calls';
        $this->items_model->_primary_key = 'calls_id';
        $return_id = $this->items_model->save($data, $id);
        if (!empty($id)) {
            $id = $id;
            $action = 'activity_update_opportunity_call';
            $msg = lang('update_opportunity_call');
        } else {
            $id = $return_id;
            $action = 'activity_save_opportunity_call';
            $msg = lang('save_opportunity_call');
        }
        $activity = array(
            'user' => $this->session->userdata('user_id'),
            'module' => 'opportunity',
            'module_field_id' => $opportunities_id,
            'activity' => $action,
            'icon' => 'fa-circle-o',
            'value1' => $data['call_summary']
        );
        $this->items_model->_table_name = 'tbl_activities';
        $this->items_model->_primary_key = 'activities_id';
        $this->items_model->save($activity);
        // messages for user
        $type = "success";
        $message = $msg;
        set_message($type, $message);
        redirect('admin/opportunities/opportunity_details/' . $opportunities_id . '/' . '2');
    }

    public function delete_opportunity_call($opportunities_id, $id)
    {

        $calls_info = $this->items_model->check_by(array('calls_id' => $id), 'tbl_calls');
        $activity = array(
            'user' => $this->session->userdata('user_id'),
            'module' => 'opportunity',
            'module_field_id' => $opportunities_id,
            'activity' => 'activity_opportunity_call_deleted',
            'icon' => 'fa-circle-o',
            'value1' => $calls_info->call_summary
        );
        $this->items_model->_table_name = 'tbl_activities';
        $this->items_model->_primary_key = 'activities_id';
        $this->items_model->save($activity);
        $this->items_model->_table_name = 'tbl_calls';
        $this->items_model->_primary_key = 'calls_id';
        $this->items_model->delete($id);
        $type = 'success';
        $message = lang('opportunity_call_deleted');
        set_message($type, $message);
        redirect('admin/opportunities/opportunity_details/' . $opportunities_id . '/' . '2');
    }

    public function saved_metting($opportunities_id, $id = NULL)
    {
        $this->items_model->_table_name = 'tbl_mettings';
        $this->items_model->_primary_key = 'mettings_id';

        $data = $this->items_model->array_from_post(array('meeting_subject', 'user_id', 'location', 'description'));
        $data['start_date'] = strtotime($this->input->post('start_date') . ' ' . date('H:i', strtotime($this->input->post('start_time'))));
        $data['end_date'] = strtotime($this->input->post('end_date') . ' ' . date('H:i', strtotime($this->input->post('end_time'))));
        $data['opportunities_id'] = $opportunities_id;
        $user_id = serialize($this->items_model->array_from_post(array('attendees')));
        if (!empty($user_id)) {
            $data['attendees'] = $user_id;
        } else {
            $data['attendees'] = '-';
        }
        $return_id = $this->items_model->save($data, $id);

        if (!empty($id)) {
            $id = $id;
            $action = 'activity_update_opportunity_metting';
            $msg = lang('update_opportunity_metting');
        } else {
            $id = $return_id;
            $action = 'activity_save_opportunity_metting';
            $msg = lang('save_opportunity_metting');
        }
        $activity = array(
            'user' => $this->session->userdata('user_id'),
            'module' => 'opportunity',
            'module_field_id' => $opportunities_id,
            'activity' => $action,
            'icon' => 'fa-circle-o',
            'value1' => $data['meeting_subject']
        );

        $this->items_model->_table_name = 'tbl_activities';
        $this->items_model->_primary_key = 'activities_id';
        $this->items_model->save($activity);
        // messages for user
        $type = "success";
        $message = $msg;
        set_message($type, $message);
        redirect('admin/opportunities/opportunity_details/' . $opportunities_id . '/' . '3');
    }

    public function delete_leads_mettings($opportunities_id, $id)
    {
        $mettings_info = $this->items_model->check_by(array('mettings_id' => $id), 'tbl_mettings');

        $activity = array(
            'user' => $this->session->userdata('user_id'),
            'module' => 'leads',
            'module_field_id' => $opportunities_id,
            'activity' => 'activity_leads_call_deleted',
            'icon' => 'fa-circle-o',
            'value1' => $mettings_info->meeting_subject
        );
        $this->items_model->_table_name = 'tbl_activities';
        $this->items_model->_primary_key = 'activities_id';
        $this->items_model->save($activity);
        $this->items_model->_table_name = 'tbl_mettings';
        $this->items_model->_primary_key = 'mettings_id';
        $this->items_model->delete($id);
        $type = 'success';
        $message = lang('mettings_deleted');
        set_message($type, $message);
        redirect('admin/opportunities/opportunity_details/' . $opportunities_id . '/' . '3');
    }


    public function save_comments()
    {

        $data['opportunities_id'] = $this->input->post('opportunities_id', TRUE);
        $data['comment'] = $this->input->post('comment', TRUE);
        $data['user_id'] = $this->session->userdata('user_id');

        //save data into table.
        $this->items_model->_table_name = "tbl_task_comment"; // table name
        $this->items_model->_primary_key = "task_comment_id"; // $id
        $this->items_model->save($data);

        // save into activities
        $activities = array(
            'user' => $this->session->userdata('user_id'),
            'module' => 'opportunity',
            'module_field_id' => $data['opportunities_id'],
            'activity' => 'activity_new_opportunity_comment',
            'icon' => 'fa-ticket',
            'value1' => $data['comment'],
        );
        // Update into tbl_project
        $this->items_model->_table_name = "tbl_activities"; //table name
        $this->items_model->_primary_key = "activities_id";
        $this->items_model->save($activities);


        $type = "success";
        $message = lang('opportunity_comment_save');
        set_message($type, $message);
        redirect('admin/opportunities/opportunity_details/' . $data['opportunities_id'] . '/' . '4');
    }

    public function delete_comments($opportunities_id, $task_comment_id)
    {
        //save data into table.
        $this->items_model->_table_name = "tbl_task_comment"; // table name
        $this->items_model->_primary_key = "task_comment_id"; // $id
        $this->items_model->delete($task_comment_id);

        $type = "success";
        $message = lang('task_comment_deleted');
        set_message($type, $message);
        redirect('admin/opportunities/opportunity_details/' . $opportunities_id . '/' . '4');
    }

    public function save_attachment($task_attachment_id = NULL)
    {
        $data = $this->items_model->array_from_post(array('title', 'description', 'opportunities_id'));
        $data['user_id'] = $this->session->userdata('user_id');

        // save and update into tbl_files
        $this->items_model->_table_name = "tbl_task_attachment"; //table name
        $this->items_model->_primary_key = "task_attachment_id";
        if (!empty($task_attachment_id)) {
            $id = $task_attachment_id;
            $this->items_model->save($data, $id);
            $msg = lang('opportunity_file_updated');
        } else {
            $id = $this->items_model->save($data);
            $msg = lang('opportunity_file_added');
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
                $val == TRUE || redirect('admin/opportunities/opportunity_details/' . $data['opportunities_id'] . '/' . '5');
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
            'module' => 'opportunity',
            'module_field_id' => $id,
            'activity' => 'activity_new_opportunity_attachment',
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
        redirect('admin/opportunities/opportunity_details/' . $data['opportunities_id'] . '/' . '5');
    }

    public function delete_files($opportunities_id, $task_attachment_id)
    {
        $file_info = $this->items_model->check_by(array('task_attachment_id' => $task_attachment_id), 'tbl_task_attachment');
        // save into activities
        $activities = array(
            'user' => $this->session->userdata('user_id'),
            'module' => 'opportunity',
            'module_field_id' => $opportunities_id,
            'activity' => 'activity_opportunity_attachfile_deleted',
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

        $type = "success";
        $message = lang('opportunity_attachfile_deleted');
        set_message($type, $message);
        redirect('admin/opportunities/opportunity_details/' . $opportunities_id . '/' . '5');
    }

    public function delete_opportunity($id)
    {
        $can_delete = $this->items_model->can_action('tbl_opportunities', 'delete', array('opportunities_id' => $id));
        if (!empty($can_delete)) {
            $opportunity_info = $this->items_model->check_by(array('opportunities_id' => $id), 'tbl_opportunities');

            $activity = array(
                'user' => $this->session->userdata('user_id'),
                'module' => 'opportunity',
                'module_field_id' => $id,
                'activity' => 'activity_opportunity_deleted',
                'icon' => 'fa-circle-o',
                'value1' => $opportunity_info->opportunity_name
            );
            $this->items_model->_table_name = 'tbl_activities';
            $this->items_model->_primary_key = 'activities_id';
            $this->items_model->save($activity);

            //delete data into table.
            $this->items_model->_table_name = "tbl_calls"; // table name
            $this->items_model->delete_multiple(array('opportunities_id' => $id));

            //delete data into table.
            $this->items_model->_table_name = "tbl_mettings"; // table name
            $this->items_model->delete_multiple(array('opportunities_id' => $id));

            //delete data into table.
            $this->items_model->_table_name = "tbl_task_comment"; // table name
            $this->items_model->delete_multiple(array('opportunities_id' => $id));

            $this->items_model->_table_name = "tbl_task_attachment"; //table name
            $this->items_model->_order_by = "task_id";
            $files_info = $this->items_model->get_by(array('opportunities_id' => $id), FALSE);

            foreach ($files_info as $v_files) {
                //save data into table.
                $this->items_model->_table_name = "tbl_task_uploaded_files"; // table name
                $this->items_model->delete_multiple(array('task_attachment_id' => $v_files->task_attachment_id));
            }
            //save data into table.
            $this->items_model->_table_name = "tbl_task_attachment"; // table name
            $this->items_model->delete_multiple(array('opportunities_id' => $id));

            //save data into table.
            $this->items_model->_table_name = "tbl_task"; // table name
            $this->items_model->delete_multiple(array('opportunities_id' => $id));

            $this->items_model->_table_name = 'tbl_opportunities';
            $this->items_model->_primary_key = 'opportunities_id';
            $this->items_model->delete($id);
            $type = 'success';
            $message = lang('opportunity_deleted');
            set_message($type, $message);
        } else {
            set_message('error', lang('there_in_no_value'));
        }
        redirect($_SERVER['HTTP_REFERER']);
    }

}
