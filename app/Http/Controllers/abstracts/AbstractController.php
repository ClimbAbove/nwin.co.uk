<?php


namespace App\Http\Controllers\Abstracts;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller;
use Modules\Page\Classes\Page;

abstract class AbstractController extends Controller
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    protected $static;

    public function render($view, $data = [])
    {
        $page = Page::getInstance();

        $data['page'] = $page;

        return view($view, $data);


    }
}
