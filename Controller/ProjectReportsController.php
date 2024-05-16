<?php

namespace Kanboard\Plugin\ProjectReports\Controller;

use Kanboard\Controller\BaseController;

class ProjectReportsController extends BaseController {
    public function show() {
        $project = $this->getProject();

        $this->response->html($this->template->render('ProjectReports:report_view/show', array(
            'project' => $project,
            'title'   => $project['name'],
        )));
    }
}