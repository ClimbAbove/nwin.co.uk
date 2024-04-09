<?php

namespace App\Classes\Elements\Abstracts;

use App\Classes\Elements\Answer\AnswerElement;
use App\Classes\Elements\Form\FormElement;
use App\Classes\Elements\FormElementGroup\FormElementGroup;
use App\Classes\Elements\FormField\FormFieldElement;
use App\Classes\Elements\Question\QuestionElement;
use App\Classes\Elements\Questionnaire\QuestionnaireElement;
use Illuminate\Support\Str;
use Livewire\Wireable;

class AbstractQuestionnaireElement implements Wireable {

    public $_object;             // automatically populated with the extended class FQNS, so it can be hydrated back correctly.
    public $_sets;               // array that stores the key => value of any magic set* method. This is as Livewire drops non-public properties.
    public $_readonly = [];      // Array of properties that are read only.
    public string $id;           // Id of element.
    public string $text = '';    // Text / label / caption.
    public $value = null;        // Value of element.
    protected $guard = null;     // string or callback that is run prior to a step.
    protected $next_step = null; // string or callback that is the next step.

    /**
     * __construct
     *
     * @param  array  $bulk_assignments  - array of properties to hydrate the class with.
     */
    public function __construct(array $bulk_assignments = [])
    {


        $this->id = uniqid();

        if(is_array($bulk_assignments)) {
            $this->hydrate($bulk_assignments);
        }

        $this->_object = get_called_class();

        return $this;
    }

    /**
     * __set
     *
     * magic method to set properties. If a property is protected then we check if a set* method exists then use that.
     *
     * @param $property
     * @param $value
     *
     * @return void
     */
    public function __set($property, $value)
    {
        if(method_exists($this, $magic_method = 'set' . Str::Studly($property))) {
            return $this->$magic_method($value);
        }
    }

    /**
     * __get
     *
     * magic method to get properties. If a property is protected then we check if a get* method exists then use that.
     *
     * @param $property
     *
     * @return void
     */
    public function __get($property)
    {
        if(method_exists($this, $magic_method = 'get' . Str::Studly($property))) {
            return $this->$magic_method();
        }
    }

    /**
     * hydrate
     *
     * Hydrate the class with an array of properties.
     *
     * @param  array  $input  - array of properties to hydrate the class with.
     * @param  bool  $last  - if true, then this is the last element in the array of elements, so we can skip the
     *     _set magic method.
     *
     * @return void
     */
    public function hydrate($input, $last = false)
    {

        // If Element has a magic propertyMethod, thus is in _sets, then set it then if it has a get method, then
        // use that.

        // If this class has protected properties and corresponding magic set* methods, then within the set* method
        // the property_name and value need to be added to the _set array (as Livewire drops non-public properties,
        // but we need them to be protected so __set/__get works). This checks for any _set and iterates then then
        // sets via the magic set* and get* if applicable.
        if(isset($input['_sets'])) {

            foreach ($input['_sets'] as $property => $property_value) {

                if(method_exists($this, $magic_method = 'set' . Str::Studly($property))) {
                    $this->$magic_method($property_value);
                } else {
                    dd('AbstractQuestionnaireElement _set element with no method! ' . $property);
                }

                if(method_exists($this, $magic_method = 'get' . Str::Studly($property))) {
                    $this->$property = $this->$magic_method();
                }
                else {
                    $this->$property = $property_value;
                }
            }

        }

        // Loop through $input (which is an element class) properties, if it is any array then it could be an array of
        // child elements that need to be cast and hydrated.
        foreach($input as $key => &$value) {


            if (in_array($key, ($this->_readonly ?? [])) === false) {

                if(is_array($value)) {

                    foreach($value as &$key_value) {

                        $_object = null;
                        $_object_skip_hydrate = false;

                        if(is_object($key_value)) {
                            if($key_value->_object ?? false) {
                                $_object = $key_value->_object;
                                $_object_skip_hydrate = true;
                            }
                        }
                        elseif(isset($key_value['_object'])) {
                            $_object = $key_value['_object'];
                        }

                        // Hydrate and cast any array of element objects.
                        if($_object) {

                            if($_object_skip_hydrate !== true) {
                                $casted_object = new $_object();
                                $casted_object->hydrate($key_value);
                                $key_value = $casted_object;
                            }
                        }
                        else {

                            if($key !== '_sets') {
                                // Hydrate and cast any single element objects.
                                if(is_array($value) && isset($value['_object'])) {
                                    $casted_object = new $value['_object']();
                                    $casted_object->hydrate($value, true);
                                    $value = $casted_object;
                                }
                            }
                        }
                    }
                }

                $this->$key = $value;

            }

        }
    }

    public function toLivewire()
    {
        $return = [];

        foreach($this->getProperties() as $property => $value) {
            $return[$property] = $this->$property;
        }

        return $return;

    }

    public static function fromLivewire($value)
    {
        switch(get_called_class()) {
            case AnswerElement::class:
                $text = $value['text'];
                $label = $value['label'];
              //  return new static($text, $label);
            break;

            case QuestionElement::class:
                $text = $value['text'];
             //   return new static($text);
            break;

            case FormElementGroup::class:
                $fields = $value['fields'];
              //  return new static($fields);
                break;

            case FormElement::class:
                $text = $value['text'];
               // return new static($text);
                break;


            case FormFieldElement::class:
                $text = $value['text'];
              //  return new static($text);
                break;


            case QuestionnaireElement::class:


                $s = new static($id, $text, $value, $guard, $next_step, $current_step_index);

                return $s;
            break;

            default:
                dd('fromLivewire error');
                break;
        }

    }

    /**
     * getProperties
     *
     * returns all the properties of a class.
     *
     * @return array
     */

    public function getProperties()
    {
        return (get_object_vars($this));
    }

    /**
     * castToArray
     *
     * provide a anything to this method and if its not an array aleady, it will next the $value
     * in an array.
     *
     * @param $value
     *
     * @return array
     */
    public function castToArray($value)
    {
        if(is_array($value)) {
           return $value;
        }

        return [$value];
    }


    /**
     * setGuard
     *
     * set callback that is run immediately prior to the step.
     *
     * @param  array  $object  [SomeClass::class, 'method'] - Callback that is run immediately prior to the step.
     *                         Callback must return an element.
     *
     * @return $this
     */
    public function setGuard(array $class_method)
    {
        $this->guard = $class_method;
        $this->_sets['guard'] = $this->guard;

        return $this;
    }

    /**
     * getGuard
     *
     * @param  $object
     *
     * @return $this
     */
    public function getGuard()
    {
        return $this->guard;
    }

    /**
     * setNextStepId
     *
     * @param  $object
     *
     * @return $this
     */
    public function setNextStep($object)
    {
        $this->next_step = $object;
        $this->_sets['next_step'] = $this->next_step;

        return $this;
    }

    /**
     * getNextStepId
     *
     * @return mixed|null
     */
    public function getNextStep()
    {
        return $this->next_step;
    }


}
