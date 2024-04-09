<?php

namespace Modules\Asset\Classes;

use Illuminate\Http\Response;

class JS
{
    private $base_path = null;

    public function setBasePath($base_path)
    {
        $this->base_path = $base_path;
    }

    public function stripQueryStrings($path)
    {
        return preg_replace('!\?(.*)$!', '', $path);
    }

    public function load($path)
    {
        $headers = [];

        if($this->base_path === null) {
            $this->base_path = public_path();
        }

        $path = $this->stripQueryStrings($path);

        if(preg_match( '/([a-z0-9\_\-])\.min\.js/i', $path, $m)) {

            $master_file_path = $this->base_path . '/js/' . str_replace('.min.js', '.js', $path);
            $min_file_path    = $this->base_path . '/js/' . $path;

            if(is_file($master_file_path)) {
                $last_master_modified_time = filemtime($master_file_path);

                $min_modified_time = null;

                if(is_file($min_file_path)) {
                    $min_modified_time = filemtime($min_file_path);
                }

                if($min_modified_time === null || $last_master_modified_time > $min_modified_time) {
                    $minified = $this->minify(file_get_contents($master_file_path));
                    file_put_contents($min_file_path, $minified);
                }

                $headers['Content-type']        = 'application/javascript';
                $headers['Cache-Control']       = 'public, must-revalidate, post-check=0, pre-check=0';
                $headers['Etag']                = md5($last_master_modified_time);
                $headers['Last-modified']       = gmdate("D, d M Y H:i:s", $min_modified_time) . " GMT";

                return response()->file($min_file_path, $headers);

            }
            elseif(is_file($min_file_path)) {
                return response()->file($min_file_path, $headers);
            }

        }
        elseif(is_file($master_file_path = $this->base_path . '/js/' . $path)) {

            $last_master_modified_time = filemtime($master_file_path);

            $headers['Content-type']        = 'application/javascript';
            $headers['Cache-Control']       = 'public, must-revalidate, post-check=0, pre-check=0';
            $headers['Etag']                = md5($last_master_modified_time);
            $headers['Last-modified']       = gmdate("D, d M Y H:i:s", $last_master_modified_time) . " GMT";


            return response()->file($master_file_path, $headers);
        }

        return response(null, 404);

    }

    public function minify($js)
    {
        $jsshrink = new JSShrink();

        return $jsshrink::minify($js);
    }

}
