<?php
declare(strict_types=1);
namespace eortega\SimpleImageEditor;
require_once('vendor/autoload.php');

final class SimpleImageEditor
{
    private Image $image;

    public function __construct()
    {
        $this->readInput();
    }

    protected function readInput()
    {
        do {
            $command = readline('>');
            $params =  explode(' ', trim($command));
            switch ($params[0]) {
                case 'I':
                    //Creates a new image, eg: I 10 5
                    $this->image = new Image((int) $params[1], (int) $params[2]);
                    break;
                case 'C':
                    //Clear the current image
                    $this->image->void();
                    break;
                case 'L':
                    // Colour a pixel with the received color, eg: L x y C
                    $this->image->updatePixelColor((int) $params[1],(int) $params[2], $params[3]);
                    break;
                case 'V':
                    // Draw vertical segment, eg: V x y1 y2 C
                    $this->image->drawVerticalLine((int) $params[1],(int) $params[2], (int) $params[3], $params[4]);
                    break;
                case 'H':
                    // Draw an horizontal segment, eg: V x1 x2 y C
                    break;
                case 'F':
                    // Draw an region , eg: V x y C
                    break;
                case 'S':
                    $this->image->print();
                    break;
            }
        } while($command !== 'X');
    }
}

$imageEditor = new SimpleImageEditor();
