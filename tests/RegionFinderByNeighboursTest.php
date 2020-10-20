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
        $expectedF[3][2] = new Pixel(3,2, 'F');
        $expectedF[5][1] = new Pixel(5,1, 'F');
        $expectedH[5][3] = new Pixel(5,3, 'H');

        $imgX5Y3 = new Image(5, 3);
        $imgX5Y3->updatePixelColor(3, 2, 'F');
        $imgX5Y3->updatePixelColor(5, 1, 'F');
        $imgX5Y3->updatePixelColor(5, 3, 'H');
        /*
         ['O', 'O', 'O', 'O', 'F']
         ['O', 'O', 'F', 'O', 'O']
         ['O', 'O', 'O', 'O', 'H']
         */

        $regionFinder = new RegionFinderByNeighbours;
        $whereIsF = $regionFinder->findPixelsWithColor('F', $imgX5Y3);
        $whereIsH = $regionFinder->findPixelsWithColor('H', $imgX5Y3);

        self::assertEquals($expectedF, $whereIsF);
        self::assertEquals($expectedH, $whereIsH);
    }

    /**
     * @covers RegionFinderByNeighbours::find
     */
    public function testFind(): void
    {
        $expectedRegion[5][1] = new Pixel(5,1, 'F');
        $expectedRegion[3][2] = new Pixel(3,2, 'F');
        $expectedRegion[5][2] = new Pixel(5,2, 'F');
        $expectedRegion[5][3] = new Pixel(5,3, 'F');

        $imgX5Y3 = new Image(5, 3);
        $imgX5Y3->updatePixelColor(5, 1, 'F');
        $imgX5Y3->updatePixelColor(3, 2, 'F');
        $imgX5Y3->updatePixelColor(5, 2, 'F');
        $imgX5Y3->updatePixelColor(5, 3, 'F');
        /*
         ['O', 'O', 'O', 'O', 'F']
         ['O', 'O', 'F', 'O', 'F']
         ['O', 'O', 'O', 'O', 'F']
         */

        $regionFinder = new RegionFinderByNeighbours;
        $region = $regionFinder->find(new Pixel(3,2, 'F'), $imgX5Y3);
        self::assertEquals($expectedRegion, $region);
    }
}
