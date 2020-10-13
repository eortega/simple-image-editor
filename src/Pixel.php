<?php

declare(strict_types=1);

namespace eortega\SimpleImageEditor;

final class Pixel
{
    private int $x;
    private int $y;
    private string $color;

    /**
     * Pixel constructor.
     * @param int $x
     * @param int $y
     * @param string $color
     */
    public function __construct(int $x, int $y, string $color)
    {
        $this->x = $x;
        $this->y = $y;
        $this->color = $color;
    }

    /**
     * @return int
     */
    public function getX(): int
    {
        return $this->x;
    }

    /**
     * @param int $x
     */
    public function setX(int $x): void
    {
        $this->x = $x;
    }

    /**
     * @return int
     */
    public function getY(): int
    {
        return $this->y;
    }

    /**
     * @param int $y
     */
    public function setY(int $y): void
    {
        $this->y = $y;
    }

    /**
     * @return string
     */
    public function getColor(): string
    {
        return $this->color;
    }

    /**
     * @param string $color
     */
    public function setColor(string $color): void
    {
        $this->color = $color;
    }
}