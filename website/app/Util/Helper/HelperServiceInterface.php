<?php

namespace App\Util\Helper;

interface HelperServiceInterface
{
    /**
     * @param string $string
     *
     * @return string
     */
    public function getSlug($string);
}
