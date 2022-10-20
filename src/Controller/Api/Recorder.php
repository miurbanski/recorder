<?php

declare(strict_types=1);

namespace ClickMeeting\Controller\Api;

use ClickMeeting\Service\Recording\DTO\RecordingDetails;
use ClickMeeting\Service\Recording\HttpClient\RecorderClient;
use FOS\RestBundle\Controller\AbstractFOSRestController;
use Http\Client\HttpClient;
use Http\Message\RequestFactory;
use FOS\RestBundle\Controller\Annotations\Get;

class Recorder extends AbstractFOSRestController
{
    /**
     * @Get("/details/{recordingId}", name="details")
     */
    public function details(RecorderClient $client, int $recordingId): array
    {
        $recorderDetails = $client->getDetails($recordingId);
        
        return [
            'status' => $recorderDetails->getStatus(),
            'duration' => $recorderDetails->getDuration(),
            'url' => $recorderDetails->getRecordingUrl(),
        ];
        
    }

}
