<?php

namespace Kanboard\Plugin\ProjectReports;

use Kanboard\Core\Plugin\Base;
use Kanboard\Core\Translator;

class Plugin extends Base
{
    public function initialize()
    {
        $this->template->hook->attach('template:project:dropdown', 'ProjectReports:project_dropdown/reports');
    }

    public function onStartup()
    {
        Translator::load($this->languageModel->getCurrentLanguage(), __DIR__.'/Locale');
    }

    public function getPluginName()
    {
        return 'ProjectReports';
    }

    public function getPluginDescription()
    {
        return t('Generation a reports for the selected project');
    }

    public function getPluginAuthor()
    {
        return 'Rustam Urazov';
    }

    public function getPluginVersion()
    {
        return '1.0.0';
    }

    public function getPluginHomepage()
    {
        return 'https://github.com/noclickhouse/ProjectReports';
    }
}

