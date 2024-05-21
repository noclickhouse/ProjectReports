<?php

namespace Kanboard\Plugin\ProjectReports\UseCase;

use PhpOffice\PhpWord\PhpWord;
use Kanboard\Plugin\ProjectReports\Word\Document;

class WritingUseCase {
    private Document $document;
    private $dateParser;
    private $taskFileModel;
    private $taskGettingModel;

    function __construct($dateParser, $taskFileModel, $taskGettingModel) {
        $this->dateParser = $dateParser;
        $this->taskFileModel = $taskFileModel;
        $this->taskGettingModel = $taskGettingModel;
    }

    public function generateReport($project, $from, $to, $filesDir, $baseUrl) {
        $this->document = new Document($this->generateDocName($project['name'], $from, $to));

        $this->document->writeTitle('Отчет по проекту "'.$project['name'].'" за период с '.$from.' по '.$to.'.');

        $from = $this->dateParser->removeTimeFromTimestamp($this->dateParser->getTimestamp($from));
        $to = $this->dateParser->removeTimeFromTimestamp($this->dateParser->getTimestamp($to));

        for ($i = 1; $i < 5; $i++) {
            $tasks = $this->taskGettingModel->getByColumn($project['id'], $i, $from, $to);
            
            $topLevelHeader = '';
            switch ($i) {
                case 1:
                    $topLevelHeader = 'Непринятые задачи';
                    break;
                case 2:
                    $topLevelHeader = 'Принятые задачи';
                    break;
                case 3:
                    $topLevelHeader = 'Задачи в работу';
                    break;
                case 4:
                    $topLevelHeader = 'Выполненные задачи';
                    break;
                default:
                    $topLevelHeader = '';
                    break;      
            }
            
            if (count($tasks) > 0) {
                $this->document->writeTopLevelHeader($topLevelHeader);
            } 
            
            foreach ($tasks as $task) {
                $this->document->writeHeader($task['title']);
                $this->document->writeContent($task['description']);
    
                $images = $this->taskFileModel->getAllImages($task['id']);

                if (count($images) > 0) {
                    $this->document->writeContent('<w:br/>');
                }
    
                foreach ($images as $image) {
                    $source = file_get_contents(str_replace('\\', '/', $filesDir.'\\'.$image['path']));
                    $this->document->addImageAttachment($source);
                    $this->document->writeContent('<w:br/>');
                }
    
                $docs = $this->taskFileModel->getAllDocuments($task['id']);
                
                if (count($docs) > 0) {
                    $this->document->writeContent('<w:br/>');
                    $this->document->writeContent('Документы:');
                }
                
                foreach ($docs as $doc) {
                    $this->document->addLinkAttachment($baseUrl.'?controller=FileViewerController&action=download&task_id='.$task['id'].'&file_id='.$doc['id'], $doc['name']);
                }

                if (count($docs) > 0) {
                    $this->document->writeContent('<w:br/>');
                }
            }
        }

        $this->document->save();
    }

    public function getDocument() {
        return $this->document;
    }

    private function generateDocName($projectName, $from, $to) {
        return $projectName.'_'.str_replace('/', '-', $from).'_'.str_replace('/', '-', $to).'.docx';
    }
}