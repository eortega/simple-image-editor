<?php

declare(strict_types=1);

namespace eortega\SimpleImageEditor\Tests;

use PHPUnit\Framework\TestCase;
use eortega\SimpleImageEditor\Image;
use eortega\SimpleImageEditor\Pixel;
use eortega\SimpleImageEditor\RegionFinderByNeighbours;
use SebastianBergmann\FileIterator\Facade;

/**
 * Class ExampleTest
 * @covers SimpleImageEditor
 */
class ExampleTest extends TestCase
{
    public function testExample(): void
    {
        $expected = [
            ['J', 'J', 'J', 'J', 'J'],
            ['J', 'J', 'Z', 'Z', 'J'],
            ['J', 'W', 'J', 'J', 'J'],
            ['J', 'W', 'J', 'J', 'J'],
            ['J', 'J', 'J', 'J', 'J'],
            ['J', 'J', 'J', 'J', 'J'],
        ];

        $img = new Image(5, 6);
        $img->drawByRegion('J', 3, 3, new RegionFinderByNeighbours());
        $img->drawVerticalLine(2,3,4,'W');
        $img->drawHorizontalLine(3,4,2,'Z');
        self::assertSame($expected, $img->getLayout());
    }
}
