<?php

namespace Modules\Page\Classes;

use App\DTOs\PageMetaDTO;
use App\Services\Interfaces\PageMetaServiceInterface;
use Carbon\Carbon;
use Modules\Asset\Classes\CSS;
use Modules\Asset\Classes\JS;

class Page
{
    private static $instance;

    private $inline_css = [];
    private $current_inline_css_location;
    private $inline_js = [];
    private $current_inline_js_location;
    private $current_inline_js_object_event;
    private $title;
    private $timestamps = [];
    private $sitemap = true;
    private $meta = [];
    private $links = [];

    public $url;
    public $js = [];
    public $css = [];

    /**
     * singleton method
     *
     * @param  none
     *
     * @return Page
     */
    public static function getInstance() {

        if (!isset(self::$instance)) {
            self::$instance = new self();
        }

        return self::$instance;
    }

    /**
     * public function sitemap
     *
     * if set from a page then it will toggle is the page will appear in the sitemap.
     * the default for this is true.
     *
     * IMPORTANT: This should always be called BEFORE timestamps, due to the way it works.
     *
     * @param bool $value
     * @return void
     */
    public function sitemap(bool $value = true)
    {
        self::$instance->sitemap = $value;
    }

    /**
     * createdAt
     *
     * if set then will set the site map lastmod date. The default is from app.website_launch_datetime.
     *
     * @param $date_time
     *
     * @return void
     */
    public function createdAt($date_time)
    {
        self::$instance->timestamps['created_at'] = Carbon::createFromFormat('Y-m-d H:i:s', $date_time);

        if(!isset(self::$instance->timestamps['updated_at'])) {
            self::$instance->timestamps['updated_at'] = self::$instance->timestamps['created_at'];
        }

        self::$instance->setPageMeta();
    }

    /**
     * updatedAt
     *
     * if set then will set the site map lastmod date. The default is from app.website_launch_datetime.
     *
     * @param $date_time
     *
     * @return void
     */
    public function updatedAt($date_time)
    {
        self::$instance->timestamps['updated_at'] = Carbon::createFromFormat('Y-m-d H:i:s', $date_time);

        if(!isset(self::$instance->timestamps['created_at'])) {
            self::$instance->timestamps['created_at'] = self::$instance->timestamps['updated_at'];
        }

        self::$instance->setPageMeta();
    }

    /**
     * getTimestamps
     *
     * method that returns the createdAt and updatedAt timestamps.
     *
     * @param string $key      - (optional) if passed the it will return that timestamp: created_at | updated_at
     *
     * @param string $format   - (optional) date format to return timestamp(s) in.
     *
     * @return array|mixed
     */
    public function getTimestamps(string $key = null, $format = null)
    {
        if($key === null) {
            if($format === null) {
                return self::$instance->timestamps;
            }

            $formatted_timestamps = [];

            foreach(self::$instance->timestamps as $key => $value) {
                $formatted_timestamps[$key] = $value->format($format);
            }

            return $formatted_timestamps;

        }
        else {
            if($format === null) {
                return self::$instanc->timestamps[$key];
            }

            return self::$instance->timestamps[$key]->format($format);
        }
    }

    /**
     * setPageMeta
     *
     * @return void
     *
     * @throws \Illuminate\Contracts\Container\BindingResolutionException
     */
    public function setPageMeta()
    {

            $page_meta_dto                  = new PageMetaDTO();
            $page_meta_dto->url             = request()->path();
            $page_meta_dto->sitemap         = self::$instance->sitemap;
            $page_meta_dto->page_created_at = self::$instance->getTimestamps('created_at', 'c');
            $page_meta_dto->page_updated_at = self::$instance->getTimestamps('updated_at', 'c');

            $page_meta_service = app()->make(PageMetaServiceInterface::class);
            $page_meta_service->upsertPageMeta($page_meta_dto);
    }

    /**
     * getSrc
     *
     * returns the src attribute of the script tag.
     *
     * @param string  $js - HTML script tag
     *
     * @return mixed|void - src attribute
     */
    private function getAttribute(string $attribute, string $string): string
    {
        if(preg_match('~' . $attribute . '=(\"|\')(\??[^(\'|")]+)~', $string, $m))
        {
            return $m[2];
        }
    }

    /**
     * getSrc
     *
     * returns the src attribute of the script tag.
     *
     * @param string  $js - HTML script tag
     *
     * @return mixed|void - src attribute
     */
    private function getSrc(string $js): string
    {
        return self::$instance->getAttribute('src', $js);
    }

    /**
     * getHref
     *
     * returns the href attribute of the style tag.
     *
     * @param string  $css - HTML style tag
     *
     * @return mixed|void - href attribute
     */
    private function getHref(string $css)
    {
        return self::$instance->getAttribute('href', $css);
    }

    /**
     * hasCSS
     *
     * checks if this CSS href is already on the stack.
     *
     * @param  string $css
     *
     * @return bool
     */
    public function hasCSS(string $css): bool
    {
        $href = self::$instance->getHref($css);

        if(isset(self::$instance->css['top'][$href]) || isset(self::$instance->css['bottom'][$href])) {
            return true;
        }

        return false;
    }

    /**
     * hasJS
     *
     * checks if this JS src is already on the stack.
     *
     * @param  string $css
     *
     * @return bool
     */
    public function hasJS(string $js): bool
    {
        $src = self::$instance->getSrc($js);

        if(isset(self::$instance->js['top'][$src]) || isset(self::$instance->js['bottom'][$src])) {
            return true;
        }

        return false;
    }

    /**
     * addCSS
     *
     * method to add a css file to the page. if working correctly will only add it once too.
     *
     * adds a CSS file to the stack.
     *
     * @param string $css      - style / link tag
     * @param string $location - set if tags with appear at top or bottom of html.
     *
     * @return string
     */
    public function addCSS(string $css, string $location = 'bottom'): string
    {
        if(!self::$instance->hasCSS($css)) {
            $href  = self::$instance->getHref($css);
            if(!in_array($href, (self::$instance->css[$location] ?? []))) {
                self::$instance->css[$location][] = $css;
            }
        }

        return '';
    }

    /**
     * addCSSInline
     *
     * method that if given a CSS file path / link tag will inline its contents.
     *
     * @param string $css      - relative path to a CSS file OR a full link tag
     * @param string $location - top | bottom
     *
     * @return void
     */
    public function addCSSInline(string $css, string $location = 'top')
    {
        // Extract src from link tag
        if((substr($css, 0, 1) == '/') && preg_match('/rel\s?\=/', $css)) {
            $css = self::$instance->getHref($css);
        }

        if(preg_match('/\'?css\/([^\'|\"]+)/', $css, $m)) {
            $css = file_get_contents(public_path() .'/css/'. $m[1]);
            $css_instance = new CSS();
            $css = $css_instance->minify($css);
            self::$instance->css['inline_' . $location][] = $css;
        }
    }

    /**
     * startCSSInline
     *
     * method that starts the inline js
     *
     * @param  string $location
     *
     * @return void
     */
    public function startCSSInline($location = 'top')
    {
        self::$instance->current_inline_css_location = $location;
        ob_start();
    }

    /**
     * endCSSInline
     *
     * method that ends and collects the inline js
     *
     * @return void
     */
    public function endCSSInline()
    {
        // Remove any internal <style> tags.
        $inline_css = trim(preg_replace('#<style(.*?)>(.*?)</style>#is', "$2", (ob_get_contents())));
        self::$instance->css['inline_' . self::$instance->current_inline_css_location][] = $inline_css;
        ob_end_clean();
    }


    /**
     * getCSSInline
     *
     * returns inline CSS.
     *
     * @param  string  $location - top | bottom
     *
     * @return string
     */
    public function getCSSInline($location = 'bottom')
    {
        if(count(self::$instance->css['inline_' . $location] ?? [])) {
            $code =  implode(PHP_EOL, self::$instance->css['inline_' . $location]);
            $css = new CSS();

            return '<style>' . $css->minify($code) . '</style>';
        }
    }

    /**
     * getCSS
     *
     * @param  string  $location - top | bottom
     *
     * @return string
     */
    public function getCSS($location)
    {
        $merged = array_merge(self::$instance->css['layout_' . $location] ?? [], self::$instance->css[$location] ?? []);
        return str_replace('<link ', '<link ', implode(PHP_EOL, $merged ?? []));
    }

    /**
     * addJS
     *
     * @param  string  $js       - full script tag
     * @param  string  $location - top | bottom
     *
     * @return string
     */
    public function addJS(string $js, string $location = 'bottom'): string
    {
        \Log::error($js);
        if(preg_match('~^(//|http)~', $js)) {
            $src = $js;
            self::$instance->js[$location][] = $src;
        }
        elseif(!self::$instance->hasJS($js)) {
            $src  = self::$instance->getSrc($js);

            $js = str_replace('<script','<script ', $js);

            if(!in_array($js, self::$instance->js[$location] ?? [])) {
                self::$instance->js[$location][] = $js;
            }
        }

        return '';
    }

    /**
     * addJSInline
     *
     * @param  string  $js       - full script tag
     * @param  string  $location - top | bottom
     *
     * @return string
     */
    public function addJSInline(string $js, string $location = 'top')
    {
        if(preg_match('/\'?js\/([^\']+)/', $js, $m)) {
            $js = file_get_contents(public_path() .'/js/'. $m[1]);
            $js_instance = new JS();
            $js = $js_instance->minify($js);
        }

        self::$instance->js['inline_' . $location][] = $js;
    }

    /**
     * getJS
     *
     * method that returns js
     *
     * @param  string  $js       - full script tag
     * @param  string  $location - top | bottom
     *
     * @return string
     */
    public function getJS($location)
    {
        $merged = array_merge(self::$instance->js['layout_' . $location] ?? [] , self::$instance->js[$location] ?? []);

        return implode(PHP_EOL, $merged ?? []);
    }

    /**
     * startJSInline
     *
     * method that starts the inline js
     *
     * @param  string $location
     * @param  string $object_event - javascript object and the event i.e. window.load | document.DOMContentLoaded
     *
     * @return void
     */
    public function startJSInline($location = 'bottom', $object_event = 'document.DOMContentLoaded')
    {
        self::$instance->current_inline_js_location = $location;
        self::$instance->current_inline_js_object_event = $object_event;
        ob_start();
    }

    /**
     * endJSInline
     *
     * method that ends and collects the inline js
     *
     * @return void
     */
    public function endJSInline()
    {
        // Remove any internal <script> tags.
        $inline_js = trim(preg_replace('#<script(.*?)>(.*?)</script>#is', "$2", (ob_get_contents())));
        self::$instance->inline_js[self::$instance->current_inline_js_location][self::$instance->current_inline_js_object_event][] = $inline_js;
        ob_end_clean();

    }

    /**
     * getJSInline
     *
     * method that returns any inline JS for a given location.
     *
     * @param  string  $location - top | bottom
     *
     * @return string|void
     */
    public function getJSInline($location = 'bottom')
    {
        if(isset(self::$instance->inline_js[$location])) {

            $code = [];

            foreach(self::$instance->inline_js[$location] as $js_blocks)
            {
                list($object, $event) = explode('.', self::$instance->current_inline_js_object_event);
                $code[] = $object . ".addEventListener('" . $event . "', function() {";

                foreach($js_blocks as $js_block) {
                    $code[] = $js_block;
                }

                $code[] = "})";
            }

            $js = new JS();

            return '<script>' . $js->minify(implode(PHP_EOL, $code ?? [])) . '</script>';
        }

    }

    /**
     * Title
     *
     * set the page title.
     * using this methods allows a cental place to control titles.
     *
     * @param $title
     * @param $suffix
     *
     * @return void
     */
    public function title($title, $suffix = true)
    {
        self::$instance->title = trim($title);

        if($suffix) {
            self::$instance->title = trim(self::$instance->title . ' | NWIN');
        }
    }

    /**
     * getTitle
     *
     * returns the title (if set).
     *
     * @return string|void
     */
    public function getTitle()
    {
        if(self::$instance->title === null) {
            return;
        }

        return '<title>' . trim(htmlentities(self::$instance->title)) . '</title>';
    }

    /**
     * addMeta
     *
     * sets a meta property.
     * prevent duplication.
     *
     * @param string $property_or_name
     * @param string $content
     *
     * @return void
     */
    public function addMeta(string $property_or_name, string $content = null)
    {
        self::$instance->meta[$property_or_name] = [
            $property_or_name => $content
        ];
    }

    /**
     * addRawMeta
     *
     * method to allow a full raw html meta tag to be added to page->meta array.
     * using this will prevent duplicate tags. Raw will take override any tags of the same name
     *
     * @param  string $raw_meta_tag - raw HTML meta tag
     *
     * @return void
     */
    public function addRawMeta(string $raw_meta_tag)
    {
        $raw_single_tags = array_filter(explode('<', $raw_meta_tag));

        $cleaned_tags = [];

        foreach($raw_single_tags ?? [] as $raw_single_tag) {
            $cleaned_tags[] = '<' . trim($raw_single_tag);
        }

        foreach($cleaned_tags ?? [] as $cleaned_tag) {
            if(preg_match_all('/(.*(property|name)\s*\=\s*(\'|\")([^\'|\"]+)(\'|\")([^\>]+).*)/', $cleaned_tag, $tags)) {
                foreach($tags[0] as $index => $tag) {
                    self::$instance->meta['__raw'][$tags[4][$index]] = [
                        $tags[4][$index] => $tags[1][$index]
                    ];
                }
          }
        }

        return;
    }

    /**
     * getMeta
     *
     * returns meta tags.
     *
     * @param $property
     *
     * @return string
     */
    public function getMeta()
    {
        $html = [];

        // If no title, but page title set, then set the og:title to page title;
        if(self::$instance->title !== null && isset(self::$instance->meta['title']) === false) {
            self::$instance->meta['og:title'] = [
                'og:title' => self::$instance->title
            ];
        }

        foreach(self::$instance->meta as $property_or_name => $data) {

            if(preg_match('/\:/', $property_or_name)) {
                $property_or_name_key = 'property';
            }
            else {
                $property_or_name_key = 'name';
            }

            if($property_or_name !== '__raw' && !isset(self::$instance->meta['__raw'][$property_or_name])) {
                foreach ($data as $value) {
                    $html[] = '<meta ' . $property_or_name_key . '="' . htmlentities($property_or_name) . '" content="' . htmlentities($value) . '">';
                }
            }
            elseif($property_or_name === '__raw') {
                foreach ($data as $key => $value) {
                    $html[] = $value[$key];
                }
            }

        }

        return implode(PHP_EOL, $html);
    }

    /**
     * addLink
     *
     * add link tags.
     *
     * @param string $href
     * @param string $rel
     * @param array $attrs
     * @return void
     */
    public function addLink(string $href, string $rel, array $attrs = [])
    {
        self::$instance->links[$href] = [
            $href =>  array_merge(['href' => $href, 'rel' => $rel], $attrs),
        ];
    }

    /**
     * getLinks
     *
     * returns link tags.
     *
     * @return string
     */
    public function getLinks()
    {
        $html = [];
        foreach(self::$instance->links as $index => $link) {
            if($index == '__raw')
            {
                foreach($link as $raw_link_data) {
                    foreach($raw_link_data as $raw_link_datum) {

                        $html[] = $raw_link_datum;
                    }
                }
            }
            else {
                $temp = '<link';
                foreach ($link as $attrs) {
                    foreach ($attrs as $key => $value) {
                        $temp .= ' ' . $key . '="' . $value . '"';
                    }
                }
                $temp   .= '>';
                $html[] = $temp;
            }
        }

        return implode(PHP_EOL, $html);
    }

    /**
     * addRawLink
     *
     * method to allow a full raw html link tag to be added to page->links array.
     * using this will prevent duplicate tags. Raw will take override any tags of the same name
     *
     * @param  string $raw_meta_tag - raw HTML meta tag
     *
     * @return void
     */
    public function addRawLink(string $raw_meta_tag)
    {
        if(preg_match_all('/(.*href\s*\=\s*(\'|\")([^\'|\"]+)(\'|\")([^\>]+).*)/', $raw_meta_tag, $tags)) {

            foreach($tags[0] as $index => $tag) {
                self::$instance->links['__raw'][$tags[3][$index]] = [
                    $tags[3][$index] => $tags[0][$index]
                ];
            }
        }
    }
    /**
     * image
     *
     * Helper to sort out next gen images
     *
     * returns an <img> and <source tags>
     *
     * $image = [
     *      'alt' => 'xxx',
     *      'src' => [
     *          'png' => '/images/....',
     *          'webp' => '/images/....',
     *          'gif' => '/images/....',
     *      ]
     * ]
     *
     * @param $image
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function image($image, $class = null, $options = [])
    {
        $options['lazy'] = $options['lazy'] ?? true;
        $options['width'] = $options['width'] ?? 'auto';
        $options['height'] = $options['height'] ?? 'auto';
        $options['class'] = 'image ' . ($class ?? ' webp');

        return view('partials/image', ['image' => $image, 'options' => $options]);
    }

    /**
     * backgroundImage
     *
     * returns the inline CSS for a background image.
     *
     *             {!! $page->backgroundImage([
     *                'jpg' => '/images/heros/engineer_at_door.jpg',
     *                'webp' => '/images/heros/engineer_at_door.webp',
     *              ]) !!}
     *
     * @param $image
     * @param $class
     * @param $options
     *
     * @return string
     */
    public function backgroundImage($image, $class = null, $options = [])
    {

        $options['res'] = ($options['res'] ?? '1x');

        if(!is_array($image)) {
            $ext = preg_match('/\.(jpeg|jpg|gif|svg|png)/', $image, $e);
            $image = [$e[1] => $image];
        }
        else {
            // Fix any incorrect keys.
            foreach($image as $index => $i)
            {
                $ext = preg_match('/\.(jpeg|jpg|gif|svg|png)/', $i, $e);
//@TODO:: this is where the jpeg to jpg thing might get fixed.
                if($ext && $e[1] !== $index) {
                    $image[$e[1]] = $image;
                    unset($image[$index]);
                }
            }
        }

        $default_ext = array_values(array_intersect(['jpg', 'jpeg', 'png', 'gif'], array_keys($image)))[0];

        $style = [];
        $style[] = "background-image: url('" .$image[$default_ext] . "');";

        if(isset($image['webp'])) {
            $style[] = "background-image: -webkit-image-set(url('" . $image['webp'] . "') " .  $options['res'] . ", url('" . $image[$default_ext] . "') " .  $options['res'] . ");";
            $style[] = "background-image: image-set(url('" . $image['webp'] . "') " .  $options['res'] . ", url('" . $image[$default_ext] . "') " .  $options['res'] . ";)";
        }

        return implode(' ', $style);
    }

}
