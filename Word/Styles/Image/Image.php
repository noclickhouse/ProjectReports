<?php

namespace Kanboard\Plugin\ProjectReports\Word\Styles\Image;

class Image {
    private int $width;
    private string $wrappingStyle;
    private string $alignment;
    private int $wrapDistanceVertical;

    function __construct($width, $wrappingStyle, $alignment, $wrapDistanceVertical) {
        $this->width = $width;
        $this->wrappingStyle = $wrappingStyle;
        $this->alignment = $alignment;
        $this->wrapDistanceVertical = $wrapDistanceVertical;
    }

    public function getWidth() {
        return $this->width;
    }

    public function getWrappingStyle() {
        return $this->wrappingStyle;
    }

    public function getAlignment() {
        return $this->alignment;
    }

    public function getWrapDistanceVertical() {
        return $this->wrapDistanceVertical;
    }
}