<?php

declare(strict_types=1);

namespace eortega\SimpleImageEditor\Tests;

use PHPUnit\Framework\TestCase;
use eortega\SimpleImageEditor\Image;
use eortega\SimpleImageEditor\Pixel;

/**
 * @covers Image
 */
class ImageTest extends TestCase
{

    /**
     */
    public function testConstructor(): void
    {
        $expectedX2Y4 = [
            ['O', 'O'],
            ['O', 'O'],
            ['O', 'O'],
            ['O', 'O']
        ];

        $imgX2Y4 = new Image(2, 4);

        self::assertSame($expectedX2Y4, $imgX2Y4->getLayout());

        $expectedX5Y3 = [
            ['O', 'O', 'O', 'O', 'O'],
            ['O', 'O', 'O', 'O', 'O'],
            ['O', 'O', 'O', 'O', 'O'],
        ];

        $imgX5Y3 = new Image(5, 3);

        self::assertSame($expectedX5Y3, $imgX5Y3->getLayout());
    }

    /**
     * @covers Image::updatePixelColor
     */
    public function testUpdatePixelColor(): void
    {
        $expectedX5Y3 = [
            ['O', 'O', 'O', 'O', 'O'],
            ['O', 'O', 'F', 'O', 'O'],
            ['O', 'O', 'O', 'O', 'O'],
        ];

        $imgX5Y3 = new Image(5, 3);
        $imgX5Y3->updatePixelColor(3, 2, 'F');

        self::assertSame($expectedX5Y3, $imgX5Y3->getLayout());

        $expected = [
            ['O', 'O', 'O', 'O', 'H'],
            ['O', 'O', 'F', 'O', 'O'],
            ['A', 'O', 'O', 'O', 'C'],
        ];

        $imgX5Y3->updatePixelColor(1, 3, 'A');
        $imgX5Y3->updatePixelColor(5, 3, 'C');
        $imgX5Y3->updatePixelColor(5, 1, 'H');

        self::assertSame($expected, $imgX5Y3->getLayout());
    }

    /**
     * @covers Image::drawVerticalLine
     */
    public function testDrawVerticalLine(): void
    {
        $expectedX5Y3 = [
            ['O', 'O', 'F', 'O', 'O'],
            ['O', 'O', 'F', 'O', 'O'],
            ['O', 'O', 'F', 'O', 'O'],
        ];

        $imgX5Y3 = new Image(5, 3);
        $imgX5Y3->drawVerticalLine(3, 1, 3, 'F');

        self::assertSame($expectedX5Y3, $imgX5Y3->getLayout());

        $expected = [
            ['Y', 'O', 'F', 'O', 'O'],
            ['Y', 'O', 'F', 'O', 'Y'],
            ['O', 'O', 'F', 'O', 'Y'],
        ];

        $imgX5Y3->drawVerticalLine(5, 2, 3, 'Y');
        $imgX5Y3->drawVerticalLine(1, 1, 2, 'Y');

        self::assertSame($expected, $imgX5Y3->getLayout());
    }

    /**
     * @covers Image::drawHorizontalLine
     */
    public function testDrawHorizontalLine(): void
    {
        $expectedX5Y3 = [
            ['O', 'O', 'F', 'F', 'F'],
            ['O', 'O', 'O', 'O', 'O'],
            ['X', 'X', 'X', 'X', 'X'],
        ];

        $imgX5Y3 = new Image(5, 3);
        $imgX5Y3->drawHorizontalLine(3, 5, 1, 'F');
        $imgX5Y3->drawHorizontalLine(1, 5, 3, 'X');
        self::assertSame($expectedX5Y3, $imgX5Y3->getLayout());

        $expected = [
            ['O', 'O', 'F', 'F', 'F'],
            ['Z', 'Z', 'Z', 'O', 'O'],
            ['X', 'X', 'X', 'X', 'X'],
        ];

        $imgX5Y3->drawHorizontalLine(1, 3, 2, 'Z');

        self::assertSame($expected, $imgX5Y3->getLayout());
    }

    /**
     * @covers Image::FindPixelsWithColor
     */
    public function testFindPixelsWithColor(): void
    {
        $expectedF = [new Pixel(4, 0, 'F'), new Pixel(2,1, 'F')];
        $expectedH = [new Pixel(4, 2, 'H')];

        $imgX5Y3 = new Image(5, 3);
        $imgX5Y3->updatePixelColor(3, 2, 'F');
        $imgX5Y3->updatePixelColor(5, 1, 'F');
        $imgX5Y3->updatePixelColor(5, 3, 'H');

        $whereisF = $imgX5Y3->findPixelsWithColor('F');
        $whereisH = $imgX5Y3->findPixelsWithColor('H');

        self::assertEquals($expectedF, $whereisF);
        self::assertEquals($expectedH, $whereisH);
    }
}
