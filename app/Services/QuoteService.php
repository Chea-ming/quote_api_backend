<?php

namespace App\Services;

use GuzzleHttp\Client;
use GuzzleHttp\Exception\RequestException;

/**
 * Service class for handling quote-related business logic.
 */
class QuoteService
{
    protected $client;

    /**
     * Initialize the HTTP client for the Quotable API.
     */
    public function __construct()
    {
        $this->client = new Client([
            'base_uri' => 'https://zenquotes.io/',
            'timeout' => 10.0,
        ]);
    }

    /**
     * Fetch a random quote from the Quotable API.
     *
     * @return array
     * @throws \Exception
     */
    public function getRandomQuote()
    {
        try {
            $response = $this->client->get('api/random');
            $data = json_decode($response->getBody(), true);

            $quote = $data[0];

            return [
                'content' => $quote['q'],
                'author' => $quote['a'],
            ];
        } catch (RequestException $e) {
            // Handle network-related errors (timeout, DNS, 500, etc.)
            $message = 'Unable to fetch a quote from ZenQuotes due to a network error: ' . $e->getMessage();
            throw new \Exception($message);
        } catch (\JsonException $e) {
            // Handle JSON decoding errors
            throw new \Exception('Failed to parse ZenQuotes response: Invalid JSON format.');
        }
    }
}