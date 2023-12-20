<?php

namespace App\Services\MediaLibrary;

use Spatie\MediaLibrary\MediaCollections\Models\Media;
use Spatie\MediaLibrary\Support\PathGenerator\PathGenerator;

class CustomPathGenerator implements PathGenerator
{   
    
    public function getPath(Media $media): string
    {
        $path = config('media-library.prefix', '');

        if ($path !== '') {
            $path .= '/';
        }

        if ($folder = $media->getCustomProperty('folder')) {
            $path .= $folder . '/';
        }
        return $path;
    }

    public function getPathForConversions(Media $media): string
    {
        return $this->getPath($media) . "conversions/";
    }

    public function getPathForResponsiveImages(Media $media): string
    {
        return $this->getPath($media) . "responsive/";
    }
}