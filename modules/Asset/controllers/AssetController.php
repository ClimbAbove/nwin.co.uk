<?php

namespace Modules\Asset\Controllers;

use App\Classes\Helpers\Directories;
use App\Http\Controllers\Abstracts\AbstractController;
use Intervention\Image\ImageManager;
use Modules\Asset\Classes\CSS;
use Modules\Asset\Classes\Image;
use Modules\Asset\Classes\JS;

class AssetController extends AbstractController
{
    public function imageLoad($path)
    {
        $image = new Image();

        return $image->load($path);
    }

    public function convertToWebP()
    {

        if(config('app.env') === 'local') {
            $converted = [];

            $public = public_path('images');

            $files = Directories::scanDirectory($public);

            $chunks = array_chunk($files, 50);

            foreach ($chunks as $index => $files) {
                foreach ($files as $file_path) {
                    if (preg_match('/\.(png|gif|jpe?g)$/', $file_path, $ext)) {

                        $webp_path = (preg_replace('/' . $ext[1] . '/', 'webp', $file_path));

                        if (is_file($webp_path) === false) {
                            $manager = new ImageManager(['driver' => 'gd']);

                            $image = $manager->make($file_path);

                            $image->encode('webp', 90)->save($webp_path, 75);

                            $converted[] = $webp_path;
                        }

                    }
                }
            }
        }
    }


    public function cssLoad($path)
    {
        $css = new CSS();

        return $css->load($path);
    }

    public function jsLoad($path)
    {
        $js = new JS();

        return $js->load($path);
    }


}
