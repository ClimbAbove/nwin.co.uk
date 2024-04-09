<?php

namespace Modules\Asset\Classes;

use Illuminate\Http\Response;

class CSS
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

        if(preg_match( '/([a-z0-9\_\-])\.min\.css/i', $path, $m)) {

            $master_file_path = $this->base_path . '/css/' . str_replace('.min.css', '.css', $path);
            $min_file_path    = $this->base_path . '/css/' . $path;

            if(is_file($master_file_path)) {
               // $last_master_modified_time = gmdate("D, d M Y H:i:s", filemtime($master_file_path)) . " GMT";
                $last_master_modified_timestamp = filemtime($master_file_path);
                $last_master_modified_time = gmdate($last_master_modified_timestamp);

                $min_modified_time = null;

                if(is_file($min_file_path)) {
                    $min_modified_time = filemtime($min_file_path);
                }

                if($min_modified_time === null || $last_master_modified_time > $min_modified_time) {
                    // Minify
                    $minified = $this->minify(file_get_contents($master_file_path));

                    file_put_contents($min_file_path, $minified);

                }

                $headers['Content-type']        = 'text/css';
                $headers['Cache-Control']       = 'public, must-revalidate, post-check=0, pre-check=0';
                $headers['Etag']                = md5($last_master_modified_time);
                $headers['Last-modified']       = gmdate("D, d M Y H:i:s", $last_master_modified_time) . " GMT";

                return response()->file($min_file_path, $headers);

            }
            elseif(is_file($min_file_path)) {
                $min_modified_time = filemtime($min_file_path);

                $headers['Content-type']        = 'text/css';
                $headers['Cache-Control']       = 'public, must-revalidate, post-check=0, pre-check=0';
                $headers['Etag']                = md5($min_modified_time);
                $headers['Last-modified']       = gmdate("D, d M Y H:i:s", $min_modified_time) . " GMT";

                return response()->file($min_file_path, $headers);
            }

        }
        elseif(is_file($master_file_path = $this->base_path . '/css/' . $path)) {

            $last_master_modified_time = filemtime($master_file_path);

            $headers['Content-type']        = 'text/css';
            $headers['Cache-Control']       = 'public, must-revalidate, post-check=0, pre-check=0';
            $headers['Etag']                = md5($last_master_modified_time);
            $headers['Last-modified']       = gmdate("D, d M Y H:i:s", $last_master_modified_time) . " GMT";

            return response()->file($master_file_path, $headers);
        }

        return response(null, 404);

    }

    function minify($css_standard)
    {
        $css_min = preg_replace('!/\*[^*]*\*+([^/][^*]*\*+)*/!', '', $css_standard);
        $css_min = preg_replace('/([a-z0-9\-\_])\s+([.|#])/', "$1 $2", $css_min);
        $css_min = str_replace(array("\r\n", "\r", "\n", "\t", '  ', '    ', '    '), '', $css_min);
        $css_min = str_replace('{ ', '{', $css_min);
        $css_min = str_replace(' }', '}', $css_min);
        $css_min = str_replace(' }', '}', $css_min);
        $css_min = str_replace('@mediaonly', '@media only', $css_min);
        return str_replace('; ', ';', $css_min);
    }
}
