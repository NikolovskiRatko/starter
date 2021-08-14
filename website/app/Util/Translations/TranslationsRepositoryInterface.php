<?php

namespace App\Util\Translations;

use Illuminate\Database\Eloquent\Model;
use Request;

interface TranslationsRepositoryInterface
{
    /**
     * @param Model $model Model instance
     *
     * @return Model Model instance
     */
    public function createTranslations($model);

    /**
     * @param Model $model Model instance
     * @param string $lang locale
     * @param Request $request Api Request
     *
     * @return Model Model instance
     */
    public function saveLanguage($model, $lang, $request);

    /**
     * @param Model $model Model instance
     * @param string $lang locale
     * @param string $field field
     * @param string $value value
     *
     * @return Model Model instance
     */
    public function saveLanguageSingleField($model, $lang, $field, $value);

    /**
     * @param Model $model Model instance
     * @param string $field field
     *
     * @return Model Model instance
     */
    public function defaultTranslations($model, $field);
}