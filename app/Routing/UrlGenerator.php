<?php

namespace App\Routing;

use Illuminate\Routing\UrlGenerator as BaseUrlGenerator;

class UrlGenerator extends BaseUrlGenerator
{
    /**
     * Determine if the given path is a valid URL.
     * Supports data URIs (data:image/...) and blob URIs without prepending domain.
     *
     * @param  string  $path
     * @return bool
     */
    public function isValidUrl($path)
    {
        if (str_starts_with($path, 'data:') || str_starts_with($path, 'blob:')) {
            return true;
        }

        return parent::isValidUrl($path);
    }
}
