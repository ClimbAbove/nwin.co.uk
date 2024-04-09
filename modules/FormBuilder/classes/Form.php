<?php
/**
 * Form
 *
 * Abstract base form class that all forms using the framework form builder should extend.
 *
 */
namespace Modules\FormBuilder\Classes;

use App\Classes\Helpers\TimeCloak;
use App\Classes\UserMessage;
use Modules\FormBuilder\Traits\CommonAttributesTrait;

abstract class Form
{
    use CommonAttributesTrait;

    public $id;
    public $name;
    public $action;
    public $method;
    public $enctype;
    public $return_url;
    public $fields = [];
    public $data = [];
    public $validation_rules;
    private $form_validator;
    private $has_been_rendered = 0;

    /**
     * __construct
     *
     * sets up the form defaults.
     *
     * @param   none
     *
     * @return  $this
     */
    public function __construct()
    {
        $this->name    = $this->generateFormName();
        $this->id      = $this->name;
        $this->method  = 'POST';
        $this->enctype = 'multipart/form-data';
        $current_url   = parse_url(url()->current());

        $this->action  = $current_url['path'] ?? '/';

        if($query = request()->query()) {
            $this->action .= '?' . http_build_query($query);
        }

        return $this;
    }

    public function action($route_or_url)
    {
        $this->action = $route_or_url;

        return $this;
    }

    /**
     * method
     *
     * set the form's method; post (default) | get. Doing so will also sort out enctype.
     *
     * @param   string  $method - get | post
     *
     * @return  $this
     */
    public function method(string $method)
    {
        switch($method = strtolower($method)) {
            case 'post':
                $this->method = $method;
                $this->enctype('multipart/form-data');
                break;

            default:
                $this->method = $method;
                $this->enctype('application/x-www-form-urlencoded');
                break;
        }

        return $this;
    }

    /**
     * enctype
     *
     * set the form's enctype
     *
     * @param   string  $enctype - multipart/form-data | application/x-www-form-urlencoded
     *
     * @return  $this
     */
    public function enctype(string $enctype)
    {
        $this->enctype = $enctype;

        return $this;
    }

    /**
     * returnURL
     *
     * set the form's return url.
     *
     * @param  string    $url
     *
     * @return $this
     */
    public function returnUrl(string $url)
    {
        $this->return_url = $url;

        return $this;
    }

    /**
     * returnRoute
     *
     * set the form's return url, given a laravel route name and params.
     *
     * @param string    $route_name
     * @param array     $params
     *
     * @return $this
     */
    public function returnRoute(string $route_name, array $params = [])
    {
        $this->return_url = route($route_name, $params);

        return $this;
    }

    /**
     * __call
     *
     * form's magic helper method that enables form fields to be added in the build() method via $this->text('fieldname');
     * syntax.
     *
     * Basically a proxy to create a new instance of a FormField and assign to this form's fields property.
     *
     * @param string    $form_field_type - any valid field type; input, select, password ...
     * @param array     $params
     *
     * @return FormField
     */
    public function __call(string $form_field_type, array $params)
    {
        $field_name = array_shift($params);

        $form_field = new FormField($this);

        return $this->addFormField($form_field->$form_field_type($field_name));
    }

    /**
     * addFormField
     *
     * adds a FormField object to this form. This is called internally, if using __call(), but having separate
     * enables us to add FormFields outside of the standard means.
     *
     * @param  FormField $form_field
     *
     * @return FormField
     */
    public function addFormField(FormField $form_field)
    {
        $this->setFormFieldValueFromSession($form_field);

        return $this->fields[$form_field->name_singular] = $form_field;
    }

    /**
     * setFormFieldValueFromSession
     *
     * If the request contains the current $form_field->name, then we assume (which may backfire due to collisions)
     * that is from the submission controller, so if present in the request we add to session, so that on error
     * the form field is populated for user.
     *
     * If the request does not contain the current $form_field_name, then we check if it is in the session, and if
     * so set it to the value, and clear it.
     *
     * Else, nothing.
     *
     * @param  FormField     $form_field
     *
     * @return void
     *
     * @throws \Psr\Container\ContainerExceptionInterface
     * @throws \Psr\Container\NotFoundExceptionInterface
     */
    private function setFormFieldValueFromSession(FormField &$form_field)
    {
        if(($value = request()->input($form_field->name)) !== null) {
            session()->put('__form.' . $this->name . '.fields.' . $form_field->name, $value);
            if(in_array($form_field->type, ['select'])) {
                $form_field->selected_value = $value;
            }
            else {
                $form_field->value = $value;
            }
        }
        elseif(($value = session()->get('__form.' . $this->name . '.fields.' . $form_field->name)) !== null) {

            if(in_array($form_field->type, ['select', 'radio', 'checkbox'])) {
               $form_field->selected_value = $value;
            }
            else {
                $form_field->value = $value;
            }

            session()->forget('__form.' . $this->name . '.fields.' . $form_field->name);
        }
    }

    /**
     * clearSessionFormFieldValues
     *
     * will clear any session data for this form.
     *
     * @return void
     */
    public function clearSessionFormFieldValues()
    {
        session()->forget('__form.' . $this->name);
    }

    /**
     * field
     *
     * returns a specific form field.
     *
     * @param string    $name
     *
     * @return mixed|FormField
     */
    public function field(string $name)
    {
        return $this->fields[$name] ?? new FormField();
    }

    /**
     * setRule
     *
     * helper method, that creates a new FormValidationRule for a field on this form. Gives us the syntax
     * $this->setRule() in the setValidation() method.
     *
     * @param string $field_name
     *
     * @return FormFieldValidationRule
     */
    public function setRule(string $field_name)
    {
        $rule = new FormFieldValidationRule($field_name);

        $this->validation_rules[$field_name] = $rule;

        return $rule;
    }

    /**
     * generateFormName
     *
     * generates a form name, used for default form name, can be overridden.
     *
     * @return string
     */
    private function generateFormName()
    {
        // This is actually faster than string manipulation.
        $child_form = ((new \ReflectionClass($this))->getShortName());
        $child_form = ltrim(preg_replace('/([A-Z])/', "_$1", $child_form), '_');
        $child_form = preg_replace('/[0-9]+/', "_$1", $child_form);

        return strtolower($child_form);
    }

    /**
     * getValidationRules
     *
     * returns all form's validation rules.
     *
     * @return mixed
     */
    public function getValidationRules()
    {
        // TESTING BUILD IT SO WE ADD FIELDS, THIS SET SESSION
        $this->build();

        // As it's called from a controller, janky way to skoot through and update this fields type, then we can use it
        // for the laravel validation i.e. numeric.
        foreach($this->validation_rules as $field_name => &$rules) {
            $rules->field_type = ($this->fields[$field_name]->type ?? null);
        }

        return $this->validation_rules;
    }

    /**
     * getRule
     *
     * returns a specific fields validation rules.
     *
     * @param string $field_name
     *
     * @return mixed|null
     */
    public function getRule($field_name)
    {
        return $this->validation_rules[$field_name] ?? null;
    }

    /**
     * getSubmitButton
     *
     * return the submit button form field. Useful for multiple instances of same form etc
     *
     * @param  none
     *
     * @return FormField
     */
    public function getSubmitButton()
    {
        foreach($this->fields as $field) {
            if($field->type == 'submit' || $field->type == 'button' && $field->name == 'submit') {
                return $field;
            }
        }

        return null;
    }

    /**
     * validate
     *
     * validate this form (from controller).
     *
     * @param $request
     *
     * @return void
     */
    public function validate($form, $request)
    {
        $this->form_validator = new FormValidator($form);

        if($this->form_validator->validate($request)->isInvalid()) {
            return false;
        }

        return true;
    }

    public function getValidationMessages()
    {
        return $this->form_validator->getErrors();
    }

    /**
     * RENDER
     */

    /**
     * renderOpen
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function renderOpen()
    {
        if($this->has_been_rendered == 0) {
            $this->has_been_rendered++;
        } else {
            $this->id = preg_replace('/\_\_[0-9]+$/', '', $this->id) . '__' . $this->has_been_rendered;
            $this->has_been_rendered++;
        }

        return FormRender::open($this);
    }

    /**
     * renderClose
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function renderClose()
    {
        return FormRender::close($this);
    }

    /**
     * render
     *
     * @return void
     */
    public function render()
    {
        $html = [];
        $html[] = $this->renderOpen();

        foreach(($this->fields ?? []) as $field) {
            $field->id = $field->id;
            $html[] = $field->render();
        }

        $html[] = $this->renderClose();

        return implode(PHP_EOL, $html);
    }
}
