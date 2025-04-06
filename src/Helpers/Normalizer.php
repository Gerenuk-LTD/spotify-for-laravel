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

    /**
     * Normalize the provided body argument.
     */
    public static function normalizeBodyArgument(array|string $argument): array
    {
        if (is_string($argument)) {
            $argument = str_replace(' ', '', $argument);
            $argument = explode(',', $argument);
        }

        return $argument;
    }
}
