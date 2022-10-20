<?php

declare(strict_types=1);

namespace ClickMeeting\Service\Recording\HttpClient;

use ClickMeeting\Service\Recording\DTO\RecordingDetails;
use Http\Client\HttpClient;
use Http\Message\RequestFactory;

class RecorderClient
{
    private HttpClient $client;
    private RequestFactory $requestFactory;
    
    public function __construct(HttpClient $client, RequestFactory $requestFactory)
    {
        $this->client = $client;
        $this->requestFactory = $requestFactory;
    }

    public function getDetails(int $recordingId): RecordingDetails
    {
        $request = $this->requestFactory->createRequest('GET', '/recordings/'.$recordingId.'.json');
        $response = $this->client->sendRequest($request);
        
        return RecordingDetails::fromJson($response->getBody());
    }
}
