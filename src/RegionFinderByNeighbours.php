<?php

declare(strict_types=1);

namespace eortega\SimpleImageEditor;

class RegionFinderByNeighbours implements RegionFinder
{
    public function find(Pixel $pixel, Image $image): array
    {
        // TODO: Implement find() method.
        $r[$pixel->getX()][$pixel->getY()] = $pixel;

    }

    public function findPixelsWithColor(string $color, Image $image): array
    {
        $pixels = [];

        for ($y=0; $y < $image->getHeight(); $y++) {
            for ($x=0; $x < $image->getWidth(); $x++) {
                $image->getLayout()[$y][$x] !== $color ? : $pixels [$x+1][$y+1] = new Pixel ($x+1, $y+1, $color);
            }
        }

        return $pixels;
    }
}
