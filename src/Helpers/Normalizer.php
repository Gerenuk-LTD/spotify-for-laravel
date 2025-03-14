<?php

namespace Gerenuk\SpotifyForLaravel\Helpers;

class Normalizer
{
    /**
     * Normalize the provided argument.
     */
    public static function normalizeArgument(array|string $argument): string
    {
        if (is_array($argument)) {
            $argument = collect($argument)->implode(',');
        } elseif (is_string($argument)) {
            $argument = str_replace(' ', '', $argument);
        }

        return $argument;
    }
}
