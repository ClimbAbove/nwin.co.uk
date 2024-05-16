<?php

namespace Modules\Asset\Classes;

use Illuminate\Http\Response;
use Intervention\Image\ImageManager;
use Intervention\Image\Drivers\Gd\Driver;
class Image
{
    private $base_path = null;
    private $max_width = 1800;
    private $max_height = 1800;
    private $master_file_path = null;
    private $resize_mode = null;
    private $resize_width = null;
    private $resize_height = null;
    private $pathinfo = null;

    public function setBasePath($base_path)
    {
        $this->base_path = $base_path;
    }

    /**
     * load
     *
     * main method
     *
     * @param  $path
     *
     * @return Response|mixed|\Symfony\Component\HttpFoundation\BinaryFileResponse|void
     *
     * @throws \Illuminate\Contracts\Container\BindingResolutionException
     */
    public function load($path)
    {
        $headers = [];

        if($this->base_path === null) {
            $this->base_path = public_path();
        }

        if(preg_match( '/\-(RS|RSTC|RSTF)\-([0-9]+|auto?)x([0-9]+|auto?)\.(png|gif|jpg|webp)/', $path, $m)) {

            // Get the original file and check the stamps
            $master_path = $this->base_path . '/images/' . str_replace($m[0], '', $path) . '.' . $m[4];
            $last_master_modified_time = gmdate("D, d M Y H:i:s", filemtime($master_path)) . " GMT";

            $cached_file_path = $this->base_path . '/cache/images/' . $path;

            // If file cached
            if(
                is_file($cached_file_path) &&
                ($last_master_modified_time <= gmdate("D, d M Y H:i:s", filemtime($cached_file_path)) . " GMT")
            ) {
                $last_modified_time = gmdate("D, d M Y H:i:s", filemtime($cached_file_path)) . " GMT";

                $headers['Cache-Control']       = 'public, must-revalidate, post-check=0, pre-check=0';
                $headers['Etag']                = md5($last_modified_time);
                $headers['X-HIT']                = 'HIT';

                return response()->file($this->base_path . '/cache/images/' . $path, $headers);
            }

            $path = str_replace($m[0], '', $path) . '.' . $m[4];
            $this->resize_mode = $m[1];
            $this->resize_width = $m[2];
            $this->resize_height = $m[3];

            if($this->resize_width !== 'auto' && $this->resize_width > $this->max_width) {
                $this->resize_width = $this->max_width;
            }

            if($this->resize_height !== 'auto' && $this->resize_height > $this->max_height) {
                $this->resize_height = $this->max_height;
            }
        }

        $this->pathinfo = pathinfo($this->base_path. '/images/' . $path);

        $this->master_file_path = $this->base_path . '/images/' .  $path;

        if(!is_file($this->master_file_path)) {
            return;
        }

        switch($this->resize_mode) {
            case 'RSTC':
                $image = $this->resizeToCover();
            break;

            case 'RSTF':
                $image = $this->resizeToFit();
            break;

            case 'RS':
                $image = $this->resize();
            break;

            default:
                $image = $this->getMaster();
                $cached_file_path = $this->master_file_path;
            break;
        }

        $last_modified_time = gmdate("D, d M Y H:i:s", filemtime($image->dirname .'/'.$image->basename)) . " GMT";

        $headers = [];
        $headers['Cache-Control']       = 'public, must-revalidate, post-check=0, pre-check=0';
        $headers['Etag']                = md5($last_modified_time);
        $headers['X-HIT']               = 'MISS';
        $headers['Content-type']        = $image->mime;

        // Make the webp variant.
        if($m[4] !== 'webp') {
            $image_webp = $image;
            $image_webp->encode('webp', 90)->save(preg_replace('/\.png$/', '.webp', $cached_file_path), 75);
        }

        return response()->make($image, 200, $headers);
    }

    /**
     * getMaster
     *
     * loads the master (non-cached) image.
     *
     * @param   none
     *
     * @return \Intervention\Image\Image
     */
    public function getMaster()
    {
      //  $manager = new ImageManager(['driver' => 'gd']);
        //return $manager->make($this->master_file_path);
        $manager = new ImageManager(new Driver());
        return $manager->read($this->master_file_path);
    }

    /**
     * save
     *
     * method to image to cache path
     *
     * @param $image
     *
     * @return mixed|null
     */
    private function save($image)
    {
        $cache_path = str_replace($this->base_path, '', $this->pathinfo['dirname']);
        $cache_path = $this->base_path . '/cache' . $cache_path;

        if(!is_dir($cache_path)) {
            mkdir($cache_path, 0755, true);
        }

        $save_path = ($cache_path . '/' . $this->pathinfo['filename'] . '-' . $this->resize_mode .'-' . $this->resize_width . 'x' . $this->resize_height . '.' . $this->pathinfo['extension']);

        switch($image->exif('FILE.MimeType')) {
            case 'image/png':
                return $image->save($save_path, 70);
            case 'image/jpeg':
                return $image->save($save_path, 70);
            case 'image/gif':
                return $image->save($save_path, 70);
            case 'image/webp':
                return $image->save($save_path, 70);
        }

        return null;
    }

    /**
     * resize
     *
     * method to do resizing:
     *
     * if /image/photo-200x200  - image will be resized to 200 width and 200 height
     * if /image/photo-200xauto - image will be resized to 200 width and auto height maintaining aspect ratio.
     * if /image/photo-autox200 - image will be resized to 200 height and auto width maintaining aspect ratio.
     *
     * @param  none
     *
     * @return mixed|null
     */
    public function resize()
    {
        $manager = new ImageManager(['driver' => 'gd']);
        $image   = $manager->make($this->master_file_path);

        if($this->resize_width == 'auto') {
            $image->resize( null, $this->resize_height, function ($constraint) {
                $constraint->aspectRatio();
            });
        }
        elseif($this->resize_height == 'auto') {
            $image->resize( $this->resize_height, null, function ($constraint) {
                $constraint->aspectRatio();
            });
        }
        else {
            $image->resize($this->resize_width, $this->resize_height);
        }


        return $this->save($image);
    }

    /**
     * resizeToFit
     *
     * method to resize and image to fit within dimensions. Any 'space' resulting will be filled with #FFFFFF
     * by default.
     *
     * @param  none
     *
     * @return mixed|null
     */
    public function resizeToFit()
    {
        $manager = new ImageManager(['driver' => 'gd']);
        $image   = $manager->make($this->master_file_path);

        $width   = $image->width();
        $height  = $image->height();

        $height_ratio = $this->resize_width / $height;
        $width_ratio  = $this->resize_height / $width;
        $ratio        = min($height_ratio, $width_ratio);

        if($ratio > 1.0) {
            $ratio = 1.0;
        }

        // compute sizes
        $height = floor($height * $ratio);
        $width  = floor($width * $ratio);

        $image->resize($width, $height);

        $background_color = 'FFFFFF';

        $image->resizeCanvas($this->resize_width, $this->resize_height, 'center', false, $background_color);

        return $this->save($image);
    }

    /**
     * resizeToCover
     *
     * method to cover a given dimension with an image fully, may result in image cropping.
     *
     * @param  none
     *
     * @return mixed|null
     */
    public function resizeToCover()
    {
        $manager = new ImageManager(new Driver());

        $image =  $manager->read($this->master_file_path);
        $image->cover($this->resize_width, $this->resize_height);



        return $this->save($image);
    }
}
