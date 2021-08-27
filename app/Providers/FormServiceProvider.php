<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Form;
class FormServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
     Form::component('bsText', 'components.form.text',['text_label', 'name', 'placeholder', 'type', 'object', 'disabled']);
     Form::component('bsTextArea', 'components.form.textarea', ['text_label', 'name', 'text_content']);
     Form::component('bsSubmit', 'components.form.submit', ['value', 'name', 'bg_btn']);
     Form::component('bsSelect', 'components.form.select',['text_label','name', 'value', 'text_option', 'text_name_option']);
        //Register the form components
       // Form::component('hidden', 'components.form.hidden', ['name', 'value' => null, 'attributes' => []]);
   }
 }
