<script>
        let pristine_{{preg_replace('/\-/','_',$form->id)}};
        window.addEventListener("load", function(event) {
            let form = document.getElementById("{{ $form->id }}");

            let config = {
                classTo: 'field_container',
                errorClass: 'has-danger',
                successClass: 'has-success',
                errorTextParent: 'field_container',
                errorTextTag: 'div',
                errorTextClass: 'text-help'
            };
            pristine_{{preg_replace('/\-/','_',$form->id)}} = new Pristine(form, config, true);
            form.addEventListener('submit', function(e) {
               e.preventDefault();
               form.classList.remove('has-errors');
               pristine_{{preg_replace('/\-/','_',$form->id)}}.validate();

               if(pristine_{{preg_replace('/\-/','_',$form->id)}}.getErrors().length > 0) {
                  form.classList.add('has-errors');
                  return false;
               }
               form.submit();
            });
        });
    </script>
    {{ csrf_field() }}
</form>

