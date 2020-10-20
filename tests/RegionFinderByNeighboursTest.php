<?php

declare(strict_types=1);

namespace eortega\SimpleImageEditor\Tests;

use PHPUnit\Framework\TestCase;
use eortega\SimpleImageEditor\Image;
use eortega\SimpleImageEditor\Pixel;
use eortega\SimpleImageEditor\RegionFinderByNeighbours;

/**
 * @covers RegionFinderByNeighbours
 */
class RegionFinderByNeighboursTest extends TestCase
{

    /**
     * @covers RegionFinderByNeighbours::FindPixelsWithColor
     */
    public function testFindPixelsWithColor(): void
    {
        $expectedF[4][0] = new Pixel(4,0, 'F');
        $expectedF[2][1] = new Pixel(2,1, 'F');
        $expectedH[4][2] = new Pixel(4,2, 'H');

        $imgX5Y3 = new Image(5, 3);
        $imgX5Y3->updatePixelColor(3, 2, 'F');
        $imgX5Y3->updatePixelColor(5, 1, 'F');
        $imgX5Y3->updatePixelColor(5, 3, 'H');

        $regionFinder = new RegionFinderByNeighbours;
        $whereIsF = $regionFinder->findPixelsWithColor('F', $imgX5Y3);
        $whereIsH = $regionFinder->findPixelsWithColor('H', $imgX5Y3);

        self::assertEquals($expectedF, $whereIsF);
        self::assertEquals($expectedH, $whereIsH);
    }
}
