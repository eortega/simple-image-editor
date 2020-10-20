<?php

declare(strict_types=1);

namespace eortega\SimpleImageEditor;

interface RegionFinder
{
    public function find(Pixel $pixel, Image $image) : array;
}
