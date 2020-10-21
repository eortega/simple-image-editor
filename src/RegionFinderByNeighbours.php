<?php

declare(strict_types=1);

namespace eortega\SimpleImageEditor;

class RegionFinderByNeighbours implements RegionFinder
{
    /**
     * @param Pixel $pixel
     * @param Image $image
     * @return array eg: [Pixel(4, 5, 'color'), Pixel(2, 3, 'color')]
     */
    public function find(Pixel $pixel, Image $image): array
    {
        $r = [];
        $region = [];
        //Pixels with the same color as received $pixel belongs to R, $pixel inclusive
        $r+= $this->findPixelsWithColor($pixel->getColor(), $image);
        /* @todo verifiy if P(x,y) shares a common side with any pixel in R. $pixel belongs to R
         */
        for($y = 1; $y<= $image->getHeight(); $y++) {
            for($x = 1; $x<= $image->getWidth(); $x++) {
                if(!isset($r[$x][$y])) {
                    continue;
                }

                if($this->pixelHasNeighbours($r[$x][$y], $image, $r)) {
                    $region[] = $r[$x][$y];
                } else {
                    unset($r[$x][$y]);
                }
            }
        }

        return $region;
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

    public function pixelHasNeighbours(Pixel $pixel, Image $image, array $region): bool
    {
        for($y = $pixel->getY() - 1; $y <= $pixel->getY() + 1; $y++) {

            if($y < 1 || $y > $image->getHeight()) {
                continue;
            }

            for($x = $pixel->getX() - 1; $x <= $pixel->getX() + 1; $x++) {

                if($x < 1 || $x > $image->getWidth()) {
                    continue;
                }

                //Check is not pixel under review
                if($x === $pixel->getX() && $y === $pixel->getY()) {
                    continue;
                }

                //[x][y] is part of r?
                if(isset($region[$x][$y])) {
                    return true;
                }
            }
        }

        return false;
    }
}
