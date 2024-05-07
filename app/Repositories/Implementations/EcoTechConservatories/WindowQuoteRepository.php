<?php

namespace App\Repositories\Implementations\EcoTechConservatories;

use App\Classes\Elements\Answer\AnswerElement;
use App\Classes\Elements\Form\FormElement;
use App\Classes\Elements\FormField\FormFieldElement;
use App\Repositories\Abstracts\AbstractRepository;
use App\Classes\Elements\Questionnaire\QuestionnaireElement;
use App\Classes\Elements\Question\QuestionElement;
use App\Repositories\Implementations\QuoteController;
use App\Repositories\Interfaces\WindowQuoteRepositoryInterface;

class WindowQuoteRepository extends AbstractRepository implements WindowQuoteRepositoryInterface
{

    public function getQuestionnaire()
    {
        $questionnaire_element = new QuestionnaireElement();
        //  $questionnaire_element->getIntegrationConfig([]);
        $questionnaire_element->id = 'window_quote';
        $questionnaire_element->text = 'Window Quote';
        $questionnaire_element->setSaveAction([QuoteController::class, 'saveConservatoryQuote']);

        $question = new QuestionElement();
        $question->id = 'product_type';
        $question->type = 'tile';
        $question->min_answers = 1;
        $question->text = 'What are you looking for?';
        $question->sub_text = 'What are you looking for?';
        $question->next_step = 'form_step_1';

        $answer = new AnswerElement();
        $answer->id = 'new_conservatory';
        $answer->text = 'New Conservatory';
        $answer->value = 'new_conservatory';
        $answer->icon = '/images/icons/conservatory.svg';

        $question->pushAnswer($answer);

        $answer = new AnswerElement();
        $answer->id = 'conservatory_repair';
        $answer->value = 'conservatory_repair';
        $answer->text = 'Conservatory Repair';
        $answer->icon = '/images/icons/door.svg';
        $question->pushAnswer($answer);

        $answer = new AnswerElement();
        $answer->id = 'conservatory_roof';
        $answer->value = 'conservatory_roof';
        $answer->text = 'Conservatory Roof';
        $answer->icon = '/images/icons/conservatory-roof.svg';
        $question->pushAnswer($answer);

        $answer = new AnswerElement();
        $answer->id = 'windows';
        $answer->value = 'windows';
        $answer->text = 'Windows';
        $answer->icon = '/images/icons/window.svg';
        $question->pushAnswer($answer);

        $answer = new AnswerElement();
        $answer->id = 'doors';
        $answer->value = 'doors';
        $answer->text = 'Doors';
        $answer->icon = '/images/icons/door.svg';
        $question->pushAnswer($answer);

        $answer = new AnswerElement();
        $answer->id = 'orangeries';
        $answer->value = 'orangeries';
        $answer->text = 'Orangeries';
        $answer->icon = '/images/icons/orangery.svg';
        $question->pushAnswer($answer);



        $answer = new AnswerElement();
        $answer->id = 'roof_line';
        $answer->value = 'roof_line';
        $answer->text = 'Roof Line';
        $answer->icon = '/images/icons/roof-line.svg';
        $question->pushAnswer($answer);

        $answer = new AnswerElement();
        $answer->id = 'garden_room';
        $answer->value = 'garden_room';
        $answer->text = 'Garden Room';
        $answer->icon = '/images/icons/garden-room.svg';
        $question->pushAnswer($answer);


        $questionnaire_element->pushStep($question);


        $form_one = new FormElement();
        $form_one->id = 'form_step_1';
        $form_one->name = 'form_step_1';
        $form_one->next_step = 'form_step_2';

        $field = new FormFieldElement([
            'name' => 'postcode',
            'label' => 'Postcode',
            'type' => 'text',
        ]);
        $form_one->pushField($field);



        $field = new FormFieldElement([
            'name' => 'next',
            'label' => 'Next',
            'type' => 'button',
        ]);
        $form_one->pushField($field);


        $form_one->setRules([
            'postcode' => 'required|min:5'
        ]);

        $questionnaire_element->pushStep($form_one);


        $form_two = new FormElement();
        $form_two->id = 'form_step_2';
        $form_two->name = 'form_step_2';

        $field = new FormFieldElement([
            'name' => 'name',
            'label' => 'Your Name',
            'type' => 'text',
        ]);
        $form_two->pushField($field);

        $field = new FormFieldElement([
            'name' => 'email',
            'label' => 'Your Email',
            'type' => 'text',
        ]);
        $form_two->pushField($field);

        $field = new FormFieldElement([
            'name' => 'telephone',
            'label' => 'Your Telephone',
            'type' => 'text',
        ]);
        $form_two->pushField($field);



        $form_two->setRules([
            'name' => 'required',
            'email' => 'required|min:5',
            'telephone' => 'required|min:8',
        ]);

        $form_two->setRulesMessages([
            'name.required' => 'Please tell us your name',
            'email.required' => 'Please tell us your email address',
            'telephone.required' => 'Please tell us your contact phone number',
        ]);

        $field = new FormFieldElement([
            'name' => 'next',
            'label' => 'Next',
            'type' => 'submit',
        ]);
        $form_two->pushField($field);

        $questionnaire_element->pushStep($form_two);




        return $questionnaire_element;
    }


}
