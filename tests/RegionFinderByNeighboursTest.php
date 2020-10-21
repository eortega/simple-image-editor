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
     * @covers RegionFinderByNeighbours::pixelHasNeighbours
     */
    public function testPixelHasNeighbours(): void
    {
        /*  ['F', 'O', 'O', 'F', 'F']
            ['O', 'F', 'F', 'O', 'O']
            ['O', 'O', 'O', 'O', 'F'] */
        $mockedRegion[1][1] = new Pixel(4,1, 'F');
        $mockedRegion[4][1] = new Pixel(4,1, 'F');
        $mockedRegion[5][1] = new Pixel(5,1, 'F');
        $mockedRegion[2][2] = new Pixel(3,2, 'F');
        $mockedRegion[3][2] = new Pixel(3,2, 'F');
        $mockedRegion[5][3] = new Pixel(5,3, 'F');

        $imgX5Y3 = new Image(5, 3);
        $imgX5Y3->updatePixelColor(1, 1, 'F');
        $imgX5Y3->updatePixelColor(4, 1, 'F');
        $imgX5Y3->updatePixelColor(5, 1, 'F');
        $imgX5Y3->updatePixelColor(2, 2, 'F');
        $imgX5Y3->updatePixelColor(3, 2, 'F');
        $imgX5Y3->updatePixelColor(5, 3, 'F');

        $regionFinder = new RegionFinderByNeighbours;
        $pixelX4Y1 = $regionFinder->pixelHasNeighbours(new Pixel(1,1, 'F'), $imgX5Y3, $mockedRegion);
        self::assertTrue($pixelX4Y1);

        $pixelX4Y1 = $regionFinder->pixelHasNeighbours(new Pixel(4,1, 'F'), $imgX5Y3, $mockedRegion);
        self::assertTrue($pixelX4Y1);

        $pixelX5Y1 = $regionFinder->pixelHasNeighbours(new Pixel(5,1, 'F'), $imgX5Y3, $mockedRegion);
        self::assertTrue($pixelX5Y1);

        $pixelX3Y2 = $regionFinder->pixelHasNeighbours(new Pixel(3,2, 'F'), $imgX5Y3, $mockedRegion);
        self::assertTrue($pixelX3Y2);

        $pixelX5Y3 = $regionFinder->pixelHasNeighbours(new Pixel(5,3, 'F'), $imgX5Y3, $mockedRegion);
        self::assertFalse($pixelX5Y3);
    }

    /**
     * @covers RegionFinderByNeighbours::find
     */
    public function testFind(): void
    {
        $expectedRegion  = [
            new Pixel(4,1, 'F'),
            new Pixel(5,1, 'F'),
            new Pixel(3,2, 'F')
            //new Pixel(5,3, 'F') Don't belong to R cause doesn't have a neighbour in R
        ];

        $img = new Image(5, 4);
        $img->updatePixelColor(4, 1, 'F');
        $img->updatePixelColor(5, 1, 'F');
        $img->updatePixelColor(3, 2, 'F');
        $img->updatePixelColor(5, 3, 'F');
        $img->updatePixelColor(1, 4, 'F');
        /*
          ['O', 'O', 'O', 'F', 'F']
          ['O', 'O', 'F', 'O', 'O']
          ['O', 'O', 'O', 'O', 'F']
          ['F', 'O', 'O', 'O', 'F']
         */

        $regionFinder = new RegionFinderByNeighbours;
        $region = $regionFinder->find(new Pixel(3,2, 'F'), $img);
        self::assertTrue(true);
        self::assertEquals($expectedRegion, $region);
    }
}
