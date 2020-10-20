<?php

declare(strict_types=1);

namespace eortega\SimpleImageEditor;

class RegionFinderByNeighbours implements RegionFinder
{
    public function find(Pixel $pixel, Image $image): array
    {
        $r = [];
        //Pixels with the same color as received $pixel belongs to R, $pixel inclusive
        $r+= $this->findPixelsWithColor($pixel->getColor(), $image);
        /* @todo verifiy if P(x,y) shares a common side with any pixel in R. $pixel belongs to R
         */

        return $r;
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
