@if(($inline_form ?? false) !== false)
{!! $inline_form->renderOpen() !!}
<div class="grid-container">
    <div class="grid-x ">
        <div class="large-12 medium-12 small-12">
            {!! $inline_form->fields['name']->render() !!}
        </div>
        <div class="large-12 medium-12 small-12">
            {!! $inline_form->fields['telephone_number']->render() !!}
        </div>
        <div class="large-12 medium-12 small-12">
            {!! $inline_form->fields['email']->render() !!}
            {!! $inline_form->fields['liame']->render() !!}
        </div>
        <div class="large-12 medium-12 small-12">
            <div>
                {!! $inline_form->fields['send']->render() !!}
            </div>
        </div>
    </div>
</div>

{!! $inline_form->renderClose() !!}

{!! $page->addJS('<script src="/modules/FormBuilder/js/pristine.min.js"></script>','top') !!}

<style>
    .input_input {
        padding:0.3rem;
        border-radius: 0.2rem;
        outline: none;
        border:1px solid #CCCCCC;
        box-shadow: inset 0 1px 2px rgba(10, 10, 10, 0.1);
        width:100%;
    }
    .input_textarea {
        padding:0.3rem;
        border-radius: 0.2rem;
        outline: none;
        border:1px solid #CCCCCC;
        margin-bottom: 0.2rem;
    }
    .pristine-error {
        color: #cc4b37;
        font-size:0.75rem;
        border-left:5px solid #cc4b37;
        margin-bottom: 1rem;
        padding-left:0.6rem;
        margin-top:0.4rem;
        font-weight: bold;
    }
    .has-danger .input {
        border:1px solid #cc4b37;
    }
</style>
@endif
