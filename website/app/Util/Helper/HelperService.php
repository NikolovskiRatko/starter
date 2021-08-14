<?php

namespace App\Util\Helper;


class HelperService implements HelperServiceInterface
{
    public function getSlug($string)
    {
        return str_slug($string, '_');
    }
}