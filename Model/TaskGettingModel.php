<?php 

namespace Kanboard\Plugin\ProjectReports\Model;

use Kanboard\Core\Base;
use Kanboard\Model\TaskModel;

class TaskGettingModel extends Base {
    
    public function getByColumn($projectId, $columnId, $from, $to) {
        return $this->db->table(TaskModel::TABLE)
            ->eq(TaskModel::TABLE.'.project_id', $projectId)
            ->eq(TaskModel::TABLE.'.column_id', $columnId)
            ->gt(TaskModel::TABLE.'.date_modification', $from)
            ->lt(TaskModel::TABLE.'.date_modification', $to)
            ->findAll();
    }
}