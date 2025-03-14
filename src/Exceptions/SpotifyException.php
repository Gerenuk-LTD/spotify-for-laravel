<?php

namespace Gerenuk\SpotifyForLaravel\Exceptions;

use Exception;

class SpotifyException extends Exception
{
    protected mixed $apiResponse;

    public function __construct(?string $message = null, $code = 0, $apiResponse = null, ?Exception $previous = null)
    {
        parent::__construct($message, $code, $previous);

        $this->apiResponse = $apiResponse;
    }

    /**
     * Get the API Response.
     */
    public function getApiResponse()
    {
        return $this->apiResponse;
    }
}
