<?php

namespace Kanboard\Plugin\ProjectReports\Word;

use PhpOffice\PhpWord\PhpWord;
use Kanboard\Plugin\ProjectReports\Word\Styles\Styles;
use PhpOffice\PhpWord\IOFactory;

class Document {
    private $section;
    private string $docName;
    private Styles $styles;
    private PhpWord $phpWord;

    function __construct($docName) {
        $this->docName = $docName;
        $this->phpWord = new PhpWord();
        $this->section = $this->phpWord->addSection();
        $this->styles = new Styles();
    }

    public function getDocName() {
        return $this->docName;
    }

    public function writeTitle($title) {
        $this->section->addText(
            $title,
            $this->styles->getTitleStyles(),
            $this->styles->getTitleAlignment(),
        );
    }

    public function writeTopLevelHeader($header) {
        $this->section->addText(
            $header,
            $this->styles->getTopLevelHeaderStyles(),
            $this->styles->getTopLevelHeaderAlignment(),
        );
    }
    
    public function writeHeader($header) {
        $this->section->addText(
            $header,
            $this->styles->getHeaderStyles(),
            $this->styles->getHeaderAlignment(),
        );
    }

    public function writeContent($content) {
        if (strlen($content) > 0) {
            $textrun = $this->section->addTextRun($this->styles->getContentParagraphStyle());
            $linkPattern = '~[a-z]+://\S+~';
            $words = explode(' ', $content);
            foreach ($words as $word) {
                if (preg_match($linkPattern, $word)) {
                    $textrun->addLink(
                        $word,
                        $word.' ',
                        $this->styles->getLinkStyles(),
                    );
                } else {
                    $textrun->addText(
                        $word.' ',
                        $this->styles->getContentStyles(),
                    );
                }
            }
            $textrun->addText('<w:br/>', $this->styles->getContentStyles());
        }
    }

    public function addImageAttachment($src) {
        $this->section->addImage(
            $src,
            $this->styles->getImageStyles(),
        );
    }

    public function addLinkAttachment($link, $label) {
        $this->section->addLink(
            $link,
            $label,
            $this->styles->getLinkStyles(),
            $this->styles->getContentParagraphStyle(),
        );
    }

    public function save() {
        $objWriter = IOFactory::createWriter($this->phpWord, 'Word2007');
        $objWriter->save($this->getDocName());
    }
}