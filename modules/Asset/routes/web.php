<?php

use Modules\Asset\Controllers\AssetController;

if(config('app.env') === 'local') {

    Route::get('images/convert-to-webp', [AssetController::class, 'convertToWebP']);

    Route::get('/js/{path}', [AssetController::class, 'jsLoad'])->where('path', '[A-Za-z\/\.\_\-0-9]+');
    Route::get('/css/{path}', [AssetController::class, 'cssLoad'])->where('path', '[A-Za-z\/\.\_\-0-9]+');
    Route::get('/images/{path}', [AssetController::class, 'imageLoad'])->where('path', '[A-Za-z\/\.\_\-0-9]+');

} else {
    Route::get('/images/{path}', [AssetController::class, 'imageLoad'])->where('path', '[A-Za-z\/\.\_\-0-9]+');
    Route::any('{catchall}', function() {

        $uri = preg_replace('@^/assets@', '', request()->getRequestUri());
        $uri = preg_replace('!\?(.*)$!', '', $uri);

        if(is_file($file = public_path() . $uri)) {

            $pi = pathinfo($file);

            switch($pi['extension']) {
                case 'css':
                    $headers['Content-type']   = 'text/css';
                break;
                case 'js':
                    $headers['Content-type']   = 'application/javascript';
                break;
                case 'jpg':
                case 'jpeg':
                    $headers['Content-type']   = 'image/jpeg';
                break;
                case 'png':
                    $headers['Content-type']   = 'image/png';
                break;
                case 'gif':
                    $headers['Content-type']   = 'image/gif';
                break;
            }

            $last_modified_time = filemtime($file);

            $headers['Cache-Control']  = 'public, must-revalidate, post-check=0, pre-check=0';
            $headers['Etag']           = md5($last_modified_time);

            // Strip query string.
            $file = preg_replace('!\?(.*)$!', '', $file);

            return response()->file($file, $headers);
        }
        else {
            return response(null, 404);
        }
    })->where('catchall', '.*');
}



