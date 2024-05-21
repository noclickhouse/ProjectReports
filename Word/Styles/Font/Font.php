<?php

namespace Kanboard\Plugin\ProjectReports\Word\Styles\Font;

use \PhpOffice\PhpWord\SimpleType\Jc;

class Font {
    private string $family;
    private int $size;
    private bool $bold;
    private string $alignment;
    private bool $kkepNext;
    private string $color;

    function __construct(string $family, int $size, bool $bold, string $alignment = Jc::START, bool $keepNext = true, string $color = '000000') {
        $this->family = $family;
        $this->size = $size;
        $this->bold = $bold;
        $this->alignment = $alignment;
        $this->keepNext = $keepNext;
        $this->color = $color;
    }

    public function getFamily() {
        return $this->family;
    }

    public function getSize() {
        return $this->size;
    }

    public function isBold() {
        return $this->bold;
    }

    public function getAlignment() {
        return $this->alignment;
    }

    public function getKeepNext() {
        return $this->keepNext;
    }

    public function getColor() {
        return $this->color;
    }
}