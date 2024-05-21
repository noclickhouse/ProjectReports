<?php

namespace Kanboard\Plugin\ProjectReports\Word\Styles;

use \PhpOffice\PhpWord\SimpleType\Jc;
use Kanboard\Plugin\ProjectReports\Word\Styles\Font\Font;
use Kanboard\Plugin\ProjectReports\Word\Styles\Image\Image;

class Styles {
    private Font $titleStyles;
    private Font $headerStyles;
    private Font $topLevelHeaderStyles;
    private Font $contentStyles;
    private Font $linkStyles;
    private Image $imageStyles;

    function __construct(
        $titleStyles = new Font('Times New Roman', 20, false, Jc::CENTER),
        $headerStyles = new Font('Times New Roman', 18, true),
        $topLevelHeaderStyles = new Font('Times New Roman', 20, true, Jc::CENTER),
        $contentStyles = new Font('Times New Roman', 14, false, Jc::START, false),
        $linkStyles = new Font('Times New Roman', 14, false, Jc::START, false, '1155CC'),
        $imageStyles = new Image('300', 'behind', Jc::CENTER, 20),
    ) {
        $this->titleStyles = $titleStyles;
        $this->headerStyles = $headerStyles;
        $this->topLevelHeaderStyles = $topLevelHeaderStyles;
        $this->contentStyles = $contentStyles;
        $this->linkStyles = $linkStyles;
        $this->imageStyles = $imageStyles;
    }

    public function getTitleStyles() {
        return array(
            'name' => $this->titleStyles->getFamily(),
            'size' => $this->titleStyles->getSize(),
            'bold' => $this->titleStyles->isBold(),
            'color' => $this->titleStyles->getColor(),
        );
    }

    public function getTitleAlignment() {
        return array(
            'alignment' => $this->titleStyles->getAlignment(),
        );
    }

    public function getHeaderStyles() {
        return array(
            'name' => $this->headerStyles->getFamily(),
            'size' => $this->headerStyles->getSize(),
            'bold' => $this->headerStyles->isBold(),
            'color' => $this->headerStyles->getColor(),
        );
    }

    public function getHeaderAlignment() {
        return array(
            'alignment' => $this->headerStyles->getAlignment(),
        );
    }

    public function getTopLevelHeaderStyles() {
        return array(
            'name' => $this->topLevelHeaderStyles->getFamily(),
            'size' => $this->topLevelHeaderStyles->getSize(),
            'bold' => $this->topLevelHeaderStyles->isBold(),
            'color' => $this->topLevelHeaderStyles->getColor(),
        );
    }

    public function getTopLevelHeaderAlignment() {
        return array(
            'alignment' => $this->topLevelHeaderStyles->getAlignment(),
        );
    }

    public function getContentStyles() {
        return array(
            'name' => $this->contentStyles->getFamily(),
            'size' => $this->contentStyles->getSize(),
            'bold' => $this->contentStyles->isBold(),
            'color' => $this->contentStyles->getColor(),
        );
    }

    public function getContentParagraphStyle() {
        return array(
            'alignment' => $this->contentStyles->getAlignment(),
            'keepNext' => $this->contentStyles->getKeepNext(),
        );
    }

    public function getImageStyles() {
        return array(
            'width' => $this->imageStyles->getWidth(),
            'wrappingStyle' => $this->imageStyles->getWrappingStyle(),
            'alignment' => $this->imageStyles->getAlignment(),
            'wrapDistanceTop' => $this->imageStyles->getWrapDistanceVertical(),
            'wrapDistanceBottom' => $this->imageStyles->getWrapDistanceVertical(),
        );
    }

    public function getLinkStyles() {
        return array(
            'name' => $this->linkStyles->getFamily(),
            'size' => $this->linkStyles->getSize(),
            'bold' => $this->linkStyles->isBold(),
            'color' => $this->linkStyles->getColor(),
        );
    }
}