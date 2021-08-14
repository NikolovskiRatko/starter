<?php

namespace App\Util\Translations;

class TranslationsRepository implements TranslationsRepositoryInterface
{
    public function createTranslations($model)
    {
        // Get default locale from config or use en if not set
        $default = config('translatable.locale') ? config('translatable.locale') : 'en';
        $translations = $model->getTranslationsArray();
        $locales = config('translatable.locales');
        // Init Object
        $obj = array();
        foreach ($locales as $lang) {
            foreach($translations[$default] as $key => $field){
                $obj[$lang][$key] = $field;
            }
        }
        $translate = $model->fill($obj);
        $translate->save();
        return $translate;
    }

    public function saveLanguage($model, $lang, $request = null)
    {
        foreach ($model->translatedAttributes as $property_name) {
            if ($request) {
                $model->translate($lang)->{$property_name} = $request->get($property_name);
            } else {
                $model->translate($lang)->{$property_name} = '';
            }
        }
        $model->save();
        return $model;
    }

    public function saveLanguageSingleField($model, $lang, $field, $value)
    {
        $model->translateOrNew($lang)->{$field} = $value; 
        $model->save();
        return $model;
    }

    public function defaultTranslations($model, $field){
        // Get default locale from config or use en if not set
        $default = config('translatable.locale') ? config('translatable.locale') : 'en';
        $locales = config('translatable.locales');
        foreach ($locales as $lang) {
            if ($lang === $default) continue;
            $translation = $model->translate($lang)->{$field};
            if (($translation === '') || is_null($translation)) {
                $this->saveLanguageSingleField($model, $lang, $field, $model->{$field});
            }
        }
    }
}
