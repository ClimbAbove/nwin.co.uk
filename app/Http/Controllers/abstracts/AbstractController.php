<?php
namespace App\Http\Controllers\Abstracts;

use App\Classes\Helpers;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller;
use Modules\Page\Classes\Page;
abstract class AbstractController extends Controller
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    protected $static;
    public function render($view, $data = [], $merge_data = [], $tidy = true, $minify_html = true)
    {
        $page = Page::getInstance();

        $data['page'] = $page;

        $rendered = view($view, $data, $merge_data);

        $rendered = Helpers::minifyHTML($rendered);

        return $rendered;
    }
}
