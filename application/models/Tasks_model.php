<?php

class Tasks_Model extends MY_Model
{

    public $_table_name;
    public $_order_by;
    public $_primary_key;

    function set_progress($id)
    {
        $project_info = $this->check_by(array('project_id' => $id), 'tbl_project');
        if ($project_info->calculate_progress != '0') {
            if ($project_info->calculate_progress == 'through_tasks') {
                $done_task = count($this->db->where(array('project_id' => $id, 'task_status' => 'completed'))->get('tbl_task')->result());
                $total_tasks = count($this->db->where(array('project_id' => $id))->get('tbl_task')->result());
                $progress = round(($done_task / $total_tasks) * 100);
                if ($progress > 100) {
                    $progress = 100;
                }
            }
        } else {
            $progress = $project_info->progress;
        }
        if (empty($progress)) {
            $progress = 0;
        }
        $p_data = array(
            'progress' => $progress,
        );

        $this->_table_name = "tbl_project"; //table name
        $this->_primary_key = "project_id";
        $this->save($p_data, $id);
        return true;
    }
}
