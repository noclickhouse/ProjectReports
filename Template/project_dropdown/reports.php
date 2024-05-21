<li>
    <?= $this->modal->medium('clock-o', t('Generate a report'), 'ProjectReportsController', 'export', array('plugin' => 'ProjectReports', 'project_id' => $project['id'])) ?>
</li>