<?php
//NOTE: you must register child synthesizers in AppServiceProvider
namespace App\Classes\Elements\Abstracts;

use Livewire\Mechanisms\HandleComponents\Synthesizers\Synth;

abstract class AbstractElementSynthesizer extends Synth
{

    /**
     * match
     *
     * method required by LiveWire synths, to determine if the target is a match for this synthesizer
     *
     * @param $target
     *
     * @return bool
     */
    public static function match($target)
    {
        $fqns_class_name = get_called_class();

        $fqns_class_name_slugs = explode('\\', $fqns_class_name);
        $class_namespace = implode('\\', array_slice($fqns_class_name_slugs, 0, (count($fqns_class_name_slugs) - 1)));
        $class_name = array_pop($fqns_class_name_slugs);

        $synthesizer_class_name = explode('\\', $fqns_class_name);
        $synthesizer_class_name = preg_replace('/Synthesizer$/', '', $synthesizer_class_name);
        $synthesizer_class_name = array_pop($synthesizer_class_name);

        $dto_class_name =  $synthesizer_class_name . '';
        $fqns_dto_class_name = $class_namespace . '\\' . $dto_class_name;

        return $target instanceof $fqns_dto_class_name;
    }

    /**
     * hydrate
     *
     * LiveWire method required by synths, to hydrate the data into a new instance of the specified class.
     *
     * @param $value
     *
     * @return mixed
     */
    public function hydrate($value)
    {
        $element_class_name = $this->getElementClassName();

        $instance = new $element_class_name['fqns_class_name'];

        $instance->hydrate(
            $value
        );

        return $instance;
    }

    /**
     * dehydrate
     *
     * @param $target
     *
     * @return array
     */
    public function dehydrate($target)
    {
        return [
            get_object_vars($target),
            []
        ];
    }

    /**
     * get
     *
     * @param $target
     * @param $key
     *
     * @return mixed|null
     */
    public function get(&$target, $key)
    {
        return $target->{$key};
    }

    /**
     * set
     *
     * @param $target
     * @param $key
     * @param $value
     *
     * @return mixed|null
     */
    public function set(&$target, $key, $value)
    {
        $target->{$key} = $value;
    }

    /**
     * getElementClassName
     *
     * Helper, so we can attempt to reuse code. This must match code in match().
     *
     * @return mixed|null - returns the class name and the FQNS class name.
     */

    private function getElementClassName()
    {
        $fqns_class_name = get_called_class();

        $fqns_class_name_slugs = explode('\\', $fqns_class_name);
        $class_namespace = implode('\\', array_slice($fqns_class_name_slugs, 0, (count($fqns_class_name_slugs) - 1)));
        $class_name = array_pop($fqns_class_name_slugs);

        $synthesizer_class_name = explode('\\', $fqns_class_name);
        $synthesizer_class_name = preg_replace('/Synthesizer$/', '', $synthesizer_class_name);
        $synthesizer_class_name = array_pop($synthesizer_class_name);

        $dto_class_name =  $synthesizer_class_name . '';
        $fqns_dto_class_name = $class_namespace . '\\' . $dto_class_name;

        return [
            'class_name' => $dto_class_name,
            'fqns_class_name' => $fqns_dto_class_name,
        ];
    }
}


