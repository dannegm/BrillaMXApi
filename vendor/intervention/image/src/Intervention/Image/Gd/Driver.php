<?php

namespace Intervention\Image\Gd;

use \Intervention\Image\Size;

class Driver extends \Intervention\Image\AbstractDriver
{
    /**
     * Creates new instance of driver
     *
     * @param Decoder $decoder
     * @param Encoder $encoder
     */
    public function __construct(Decoder $decoder = null, Encoder $encoder = null)
    {
        if ( ! $this->coreAvailable()) {
            throw new \Intervention\Image\Exception\NotSupportedException(
                "GD Library extension not available with this PHP installation."
            );
        }

        $this->decoder = $decoder ? $decoder : new Decoder;
        $this->encoder = $encoder ? $encoder : new Encoder;
    }

    /**
     * Creates new image instance
     *
     * @param  integer $width
     * @param  integer $height
     * @param  string  $background
     * @return \Intervention\Image\Image
     */
    public function newImage($width, $height, $background = null)
    {
        // create empty resource
        $core = imagecreatetruecolor($width, $height);
        $image = new \Intervention\Image\Image(new self, $core);

        // set background color
        $background = new Color($background);
        imagefill($image->getCore(), 0, 0, $background->getInt());

        return $image;
    }

    /**
     * Reads given string into color object
     *
     * @param  string $value
     * @return AbstractColor
     */
    public function parseColor($value)
    {
        return new Color($value);
    }

    /**
     * Checks if core module installation is available
     *
     * @return boolean
     */
    protected function coreAvailable()
    {
        return (extension_loaded('gd') && function_exists('gd_info'));
    }

    /**
     * Returns clone of given core
     *
     * @return mixed
     */
    public function cloneCore($core)
    {
        $width = imagesx($core);
        $height = imagesy($core);
        $clone = imagecreatetruecolor($width, $height);
        imagealphablending($clone, false);
        imagesavealpha($clone, true);
        
        imagecopy($clone, $core, 0, 0, 0, 0, $width, $height);

        return $clone;
    }
}
