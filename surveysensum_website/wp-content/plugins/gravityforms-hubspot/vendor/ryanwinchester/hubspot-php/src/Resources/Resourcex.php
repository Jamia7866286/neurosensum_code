<?php

namespace SevenShores\Hubspot\Resources;
// CRTR To be new name

abstract class Resourcex
{
    /**
     * @var \SevenShores\Hubspot\Http\Client
     */
    protected $client;

    /**
     * Makin' a good ole resource
     *
     * @param \SevenShores\Hubspot\Http\Client $client
     */
    function __construct($client)
    {
        $this->client = $client;
    }

    /**
     * Convert a time, DateTime, or string to a millisecond timestamp.
     *
     * @param \DateTime|int|null $time
     * @return int|null
     */
    protected function timestamp($time)
    {
        return ms_timestamp($time);
    }
}
