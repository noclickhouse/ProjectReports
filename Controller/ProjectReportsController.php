<?php

namespace Kanboard\Plugin\ProjectReports\Controller;

require_once __DIR__.'/../vendor/autoload.php';

use Kanboard\Controller\BaseController;
use PhpOffice\PhpWord\PhpWord;
use DateTime;
use Kanboard\Plugin\ProjectReports\UseCase\WritingUseCase;

class ProjectReportsController extends BaseController {
    public function export() {
        $project = $this->getProject();

        if ($this->request->isPost()) {
            $from = $this->request->getRawValue('from');
            $to = $this->request->getRawValue('to');

            if ($from && $to) {
                $writingUseCase = new WritingUseCase($this->dateParser, $this->taskFileModel, $this->taskGettingModel);
                $writingUseCase->generateReport($project, $from, $to, FILES_DIR, $this->helper->url->base());
                $this->uploadFile($project['id'], $writingUseCase->getDocument()->getDocName());
            }
        } else {
            $this->response->html($this->template->render('ProjectReports:export/'.'report', array(
                'values'  => array(
                    'project_id' => $project['id'],
                    'from'       => '',
                    'to'         => '',
                ),
                'errors'  => array(),
                'project' => $project,
                'title'   => t('Generate a report'),
            )));
        }
    }

    private function uploadFile($projectId, $path) {
        $fileId = $this->projectFileModel->uploadContent($projectId, $path, base64_encode(file_get_contents($path)));
                
        if ($fileId) {
            $this->downloadFile($projectId, $fileId, $path);
        } else {
            $this->flash->failure(t('It is impossible to generate a report.'));
        }
    }

    private function downloadFile($projectId, $fileId, $path) {
        if (unlink($path)) {
            $this->response->redirect($this->helper->url->to('FileViewerController', 'download', array('project_id' => $projectId, 'file_id' => $fileId)));
        } else {
            $this->flash->failure(t('The file cannot be uploaded.'));
        }
    }
}