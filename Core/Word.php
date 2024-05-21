<?php

namespace Kanboard\Plugin\ProjectReports\Core;

require_once __DIR__.'/../vendor/autoload.php';

use PhpOffice\PhpWord\PhpWord;

class Word {
    private $phpWord;

    public function __construct() {
        $phpWord = new PhpWord();
    }
}