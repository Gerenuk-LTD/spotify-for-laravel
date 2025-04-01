<?php

namespace Gerenuk\SpotifyForLaravel;

use Gerenuk\SpotifyForLaravel\Exceptions\SpotifyApiException;
use Gerenuk\SpotifyForLaravel\Exceptions\ValidatorException;
use Gerenuk\SpotifyForLaravel\Helpers\Validator;
use GuzzleHttp\Exception\GuzzleException;
use GuzzleHttp\Exception\RequestException;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Session;

class SpotifyRequest
{
    public array $requestedParams = [];

    private string $endpoint;

    private array $acceptedParams;

    private string $accessToken;

    private string $apiUrl;

    private string $method;

    public function __construct(string $endpoint, array $acceptedParams = [], ?string $accessToken = null)
    {
        $this->endpoint = $endpoint;
        $this->acceptedParams = $acceptedParams;
        $this->accessToken = $accessToken ?? Session::get('spotify_access_token');
        $this->apiUrl = config('spotify-for-laravel.api_url');
        $this->method = 'GET';
    }

    /**
     * Execute the request. This is the final method for getting data and has to be called at the end of the method chain.
     *
     * @throws Exceptions\SpotifyApiException
     * @throws GuzzleException
     */
    public function get(?string $responseArrayKey = null): array
    {
        // If requestedParams is empty just set an empty array rather than do the intersect.
        $finalParams = empty($this->requestedParams) ? [] : $this->createFinalParams(collect($this->acceptedParams),
            collect($this->requestedParams));
        $response = $this->send($this->method, $this->endpoint, $finalParams);

        if ($responseArrayKey) {
            return $response[$responseArrayKey];
        }

        return $response;
    }

    /**
     * This merges the requested and accepted parameters and outputs the final parameters ready for the API call.
     */
    private function createFinalParams(Collection $acceptedParams, Collection $requestedParams): array
    {
        $intersectedRequestedParams = $requestedParams->intersectByKeys($acceptedParams);

        $mergedParams = $acceptedParams->merge($intersectedRequestedParams);

        $validParams = $mergedParams->filter(function ($value) {
            return $value !== null;
        });

        return $validParams->toArray();
    }

    /**
     * Make the API request.
     *
     * @throws SpotifyApiException|GuzzleException
     */
    private function send(string $method, string $endpoint, array $params = []): array
    {
        try {
            $client = new \Gerenuk\SpotifyForLaravel\SpotifyClient;
            $response = $client->request($method, $this->apiUrl.$endpoint.'?'.http_build_query($params), [
                'headers' => [
                    'Content-Type' => 'application/json',
                    'Accepts' => 'application/json',
                    'Authorization' => 'Bearer '.$this->accessToken,
                ],
            ]);
        } catch (RequestException $e) {
            $errorResponse = $e->getResponse();
            $status = $errorResponse->getStatusCode();

            $message = $errorResponse->getReasonPhrase();

            throw new SpotifyApiException($message, $status, $errorResponse);
        }

        return json_decode((string) $response->getBody(), true);
    }

    /**
     * Set the country if provided.
     *
     * @return $this
     *
     * @throws Exceptions\ValidatorException
     */
    public function country(?string $country = null): self
    {
        $this->setRequestedParam('country', $country);

        return $this;
    }

    /**
     * Add the requested parameters to an array.
     *
     *
     * @throws Exceptions\ValidatorException
     */
    private function setRequestedParam(string $requestedParam, int|string|null $value): void
    {
        Validator::validateRequestedParam($requestedParam, $this->acceptedParams);

        $this->requestedParams[$requestedParam] = $value;
    }

    /**
     * Set the fields if provided.
     *
     * @return $this
     *
     * @throws Exceptions\ValidatorException
     */
    public function fields(string $fields): self
    {
        $this->setRequestedParam('fields', $fields);

        return $this;
    }

    /**
     * Set include_external if provided.
     *
     * @return $this
     *
     * @throws Exceptions\ValidatorException
     */
    public function includeExternal(string $value): self
    {
        $this->setRequestedParam('include_external', $value);

        return $this;
    }

    /**
     * Set include_groups if provided.
     *
     * @return $this
     *
     * @throws Exceptions\ValidatorException
     */
    public function includeGroups(string $value): self
    {
        $this->setRequestedParam('include_groups', $value);

        return $this;
    }

    /**
     * Set the limit if provided.
     *
     * @return $this
     *
     * @throws Exceptions\ValidatorException
     */
    public function limit(int $limit): self
    {
        $this->setRequestedParam('limit', $limit);

        return $this;
    }

    /**
     * Set the offset if provided.
     *
     * @return $this
     *
     * @throws Exceptions\ValidatorException
     */
    public function offset(int $offset): self
    {
        $this->setRequestedParam('offset', $offset);

        return $this;
    }

    /**
     * Set the market if provided.
     *
     * @return $this
     *
     * @throws Exceptions\ValidatorException
     */
    public function market(?string $market = null): self
    {
        $this->setRequestedParam('market', $market);

        return $this;
    }

    /**
     * Set the locale if provided.
     *
     * @return $this
     *
     * @throws Exceptions\ValidatorException
     */
    public function locale(?string $locale = null): self
    {
        $this->setRequestedParam('locale', $locale);

        return $this;
    }

    /**
     * Set the timestamp if provided.
     *
     * @return $this
     *
     * @throws Exceptions\ValidatorException
     */
    public function timestamp(string $timestamp): self
    {
        $this->setRequestedParam('timestamp', $timestamp);

        return $this;
    }

    /**
     * Set the time range if provided.
     *
     * @return $this
     *
     * @throws Exceptions\ValidatorException
     */
    public function timeRange(string $timeRange): self
    {
        $this->setRequestedParam('time_range', $timeRange);

        return $this;
    }

    /**
     * Set the additional types if provided.
     *
     * @return $this
     *
     * @throws Exceptions\ValidatorException
     */
    public function additionalTypes(array|string $types): self
    {
        $this->setRequestedParam('additional_types', $types);

        return $this;
    }

    /**
     * Set the before unix timestamp if provided.
     *
     * @return $this
     *
     * @throws ValidatorException
     */
    public function before(string $timestamp): self
    {
        $this->setRequestedParam('before', $timestamp);

        return $this;
    }

    /**
     * Set the after unix timestamp if provided.
     *
     * @return $this
     *
     * @throws ValidatorException
     */
    public function after(string $timestamp): self
    {
        $this->setRequestedParam('after', $timestamp);

        return $this;
    }

    /**
     * Set the position if provided.
     *
     * @return $this
     *
     * @throws ValidatorException
     */
    public function position(int $position): self
    {
        $this->setRequestedParam('position', $position);

        return $this;
    }

    /**
     * Set the ids to check if provided.
     *
     * @return $this
     *
     * @throws ValidatorException
     */
    public function contains(array|string $ids): self
    {
        $this->acceptedParams = ['ids' => Validator::validateArgument('ids', $ids)];
        $this->endpoint = $this->endpoint.'/contains';

        $this->setRequestedParam('contains', $ids);

        return $this;
    }

    /**
     * Set the ids to add if provided.
     *
     * @return $this
     *
     * @throws ValidatorException
     */
    public function add(array|string $ids): self
    {
        $this->acceptedParams = ['ids' => Validator::validateArgument('ids', $ids)];
        $this->method = 'PUT';

        $this->setRequestedParam('ids', $ids);

        return $this;
    }

    /**
     * Set the ids to remove if provided.
     *
     * @return $this
     *
     * @throws ValidatorException
     */
    public function remove(array|string $ids): self
    {
        $this->acceptedParams = [
            'ids' => Validator::validateArgument('ids', $ids),
            'market' => null,
        ];
        $this->method = 'DELETE';

        $this->setRequestedParam('ids', $ids);

        return $this;
    }

    /**
     * @throws GuzzleException
     * @throws SpotifyApiException
     */
    public function save(): array
    {
        $finalParams = $this->createFinalParams(collect($this->acceptedParams), collect($this->requestedParams));

        return $this->send($this->method, $this->endpoint, $finalParams);
    }

    /**
     * Execute the request. This is the final method for checking data and has to be called at the end of the method chain.
     *
     * @throws Exceptions\SpotifyApiException
     * @throws GuzzleException
     */
    public function check(): array
    {
        $finalParams = $this->createFinalParams(collect($this->acceptedParams), collect($this->requestedParams));

        return $this->send($this->method, $this->endpoint, $finalParams);
    }
}
