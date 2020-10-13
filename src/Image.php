<?php

declare(strict_types=1);

namespace eortega\SimpleImageEditor;

final class Image
{
    protected const DEFAULT_COLOR = 'O';

    private int $width;
    private int $height;
    private array $layout;

    public function __construct(int $width, int $height)
    {
        $this->width = $width;
        $this->height = $height;
        $this->void();
    }

    public function getLayout(): array
    {
        return $this->layout;
    }

    public function void() : void
    {
        $this->layout = array_fill(
            0,
            $this->height,
            array_fill(0, $this->width, self::DEFAULT_COLOR)
        );
    }

    public function print(): void
    {
        for ($y=0; $y <= $this->height; $y++) {
            for ($x=0; $x <= $this->width; $x++) {
                echo $this->layout[$y][$x];
            }
            echo "\n";
        }
    }

    public function updatePixelColor(int $x, int $y, String $color): void
    {
        $this->layout[$y - 1][$x - 1] = $color;
    }
}