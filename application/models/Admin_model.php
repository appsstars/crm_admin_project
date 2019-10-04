<?php

class Admin_Model extends MY_Model
{

    public $_table_name;
    public $_order_by;
    public $_primary_key;

    public function select_menu_by_uri($uriSegment)
    {

        $this->db->select('tbl_menu.*', FALSE);
        $this->db->from('tbl_menu');
        $this->db->where('link', $uriSegment);
        $query_result = $this->db->get();
        $result = $query_result->row();
        if (count($result)) {
            $menuId[] = $result->menu_id;
            $menuId = $this->select_menu_by_id($result->parent, $menuId);
        } else {

            return false;
        }
        if (!empty($menuId)) {
            $lastId = end($menuId);
            $parrent = $this->select_menu_first_parent($lastId);
            array_push($menuId, $parrent->parent);
            return $menuId;
        }
    }


    public function select_menu_by_id($id, $menuId)
    {
        $this->db->select('tbl_menu.*', FALSE);
        $this->db->from('tbl_menu');
        $this->db->where('menu_id', $id);
        $query_result = $this->db->get();
        $result = $query_result->row();
        if (count($result)) {
            array_push($menuId, $result->menu_id);
            if ($result->parent != 0) {
                $result = self::select_menu_by_id($result->parent, $menuId);
            }
        }
        return $menuId;
    }

    public function select_menu_first_parent($lastId)
    {
        $this->db->select('tbl_menu.*', FALSE);
        $this->db->from('tbl_menu');
        $this->db->where('menu_id', $lastId);
        $query_result = $this->db->get();
        $result = $query_result->row();
        return $result;
    }

    public function get_transactions_list_by_date($type, $start_date, $end_date)
    {
        $this->db->select('tbl_transactions.*', FALSE);
        $this->db->from('tbl_transactions');
        $this->db->where('type', $type);
        $this->db->where('date >=', $start_date);
        $this->db->where('date <=', $end_date);
        $query_result = $this->db->get();
        $result = $query_result->result();
        return $result;
    }

    public function get_goal_report_by_month($start_date, $end_date)
    {
        $this->db->select('tbl_goal_tracking.*', FALSE);
        $this->db->from('tbl_goal_tracking');
        $this->db->where('end_date >=', $start_date);
        $this->db->where('end_date <=', $end_date);
        $query_result = $this->db->get();
        $result = $query_result->result();
        $all_type = $this->db->get('tbl_goal_type')->result();
        foreach ($all_type as $v_type) {
            if (!empty($result)) {
                foreach ($result as $item) {
                    if ($v_type->goal_type_id == $item->goal_type_id) {
                        $goal_achieve[$v_type->goal_type_id]['target'][] = $item->achievement;
                        $goal_achieve[$v_type->goal_type_id]['achievement'][] = $this->admin_model->get_progress($item);
                    } else {
                        $goal_achieve[$v_type->goal_type_id]['target'][] = 0;
                        $goal_achieve[$v_type->goal_type_id]['achievement'][] = array('achievement' => 0);
                    }
                }
            }
        }

        if (!empty($goal_achieve)) {
            $goal_achieve = $goal_achieve;
        } else {
            $goal_achieve = array();
        }
        return $goal_achieve;
    }

    public function get_transactions_list_by_month($start_date, $end_date)
    {
        $this->db->select('tbl_transactions.*', FALSE);
        $this->db->from('tbl_transactions');
        $this->db->where('date >=', $start_date);
        $this->db->where('date <=', $end_date);
        $query_result = $this->db->get();
        $result = $query_result->result();
        return $result;
    }

    public function calculate_amount($year, $month)
    {
        $amount = $this->db->select_sum('amount')
            ->where(array('month_paid' => $month, 'year_paid' => $year))
            ->get('tbl_payments')
            ->row()->amount;
        return ($amount > 0) ? $amount : 0;
    }

    public function check_user_name($user_name, $user_id)
    {
        $this->db->select('tbl_users.*', false);
        $this->db->from('tbl_users');
        if ($user_id) {
            $this->db->where('user_id !=', $user_id);
        }
        $this->db->where('username', $user_name);
        $query_result = $this->db->get();
        $result = $query_result->row();

        return $result;
    }


    public function get_lang()
    {
        if ($this->session->userdata('lang')) {
            return $this->session->userdata('lang');
        } else {
            $query = $this->db->select('language')->where('user_id', $this->session->userdata('user_id'))->get('tbl_account_details');
            if ($query->num_rows() > 0) {
                $row = $query->row();
                return $row->language;
            }
        }
    }

    public function get_update_info()
    {

        $curl = curl_init();
        curl_setopt_array($curl, array(
            CURLOPT_RETURNTRANSFER => 1,
            CURLOPT_SSL_VERIFYHOST => 0,
            CURLOPT_SSL_VERIFYPEER => 0,
            CURLOPT_TIMEOUT => 30,
            CURLOPT_URL => 'http://uniquecoder.com/system_updates/Ultimate/latest_version.php',
            CURLOPT_POST => 1,
            CURLOPT_POSTFIELDS => array(
                'update_info' => 'true',
                'current_version' => $this->get_current_db_version()
            )
        ));

        $result = curl_exec($curl);
        $error = '';

        if (!$curl || !$result) {
            $error = 'Curl Error - Contact your hosting provider with the following error as reference: Error: "' . curl_error($curl) . '" - Code: ' . curl_errno($curl);
        }

        curl_close($curl);

        if ($error != '') {
            return $error;
        }

        return $result;
    }

    public function get_current_db_version()
    {
        $this->db->limit(1);
        return $this->db->get('tbl_migrations')->row()->version;
    }

    public function is_db_upgrade_required($v = '')
    {
        if (!is_numeric($v)) {
            $v = $this->get_current_db_version();
        }
        $this->load->config('migration');
        if ((int)$this->config->item('migration_version') !== (int)$v) {
            return true;
        }
        return false;
    }

    public function upgrade_database_silent()
    {
        $this->load->config('migration');
        $this->load->library('migration', array(
            'migration_enabled' => true,
            'migration_type' => $this->config->item('migration_type'),
            'migration_table' => $this->config->item('migration_table'),
            'migration_auto_latest' => $this->config->item('migration_auto_latest'),
            'migration_version' => $this->config->item('migration_version'),
            'migration_path' => $this->config->item('migration_path')
        ));

        if ($this->migration->current() === FALSE) {
            return array(
                'success' => false,
                'message' => $this->migration->error_string()
            );
        } else {
            return array(
                'success' => true
            );
        }
    }

    public function upgrade_database()
    {
        if (!is_really_writable(APPPATH . 'config/config.php')) {
            show_error('/config/config.php file is not writable. You need to change the permissions to 755. This error occurs while trying to update database to latest version.');
            die;
        }
        $update = $this->upgrade_database_silent();
        if ($update['success'] == false) {
            show_error($update['message']);
        } else {
            $type = 'success';
            $message = "Your database is up to date";
            set_message($type, $message);
            redirect($_SERVER['HTTP_REFERER']);
        }
    }

}
