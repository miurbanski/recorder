<?php

declare(strict_types=1);

namespace Tests\Functional\Controller\Api\Recorder;

use ClickMeeting\Service\Recording\DTO\RecordingDetails;
use ClickMeeting\Service\Recording\HttpClient\RecorderClient;
use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;


class GetRecorderDetailsApiRequestTest extends WebTestCase 
{
    public function testGetRecorderDetailsApiRequestSuccess()
    {
        $client = static::createClient();
        $response = $this->createMock('Psr\Http\Message\ResponseInterface');
        $response->method('getBody')->willReturn(<<<JSON

'{"recording":{"id":902681,"source_url":"https://pgierszewski.clickmeeting.com/491616438/08bdd99336186bb0e6a5f9005afd76b3?recorder_id=887951",
"callback_url":"","status":7,"status_message":null,"created_at":"2018-05-17T12:33:55Z","updated_at":"2018-05-17T12:42:21Z",
"customs":{"recorder_id":887951,"cc_js_tester":0,"storage":"nfs"},"width":1280,"height":720,"tag_list":["recorder_id:887951"],
"file":{"id":898785,"format":"MPEG4","width":1280,"height":720,"duration":477.2,
"filesize":36355262,"created_at":"2018-05-17T12:42:17Z","updated_at":"2018-05-17T12:42:21Z",
"recording_id":902681,"url":"http://web-rec-hq.implix.com/2018/5/17/rec-lw-us-5/902681/98a12852f3dfb7d710763712b5880b30/recording.mp4",
"thumbnails_url":"http://web-rec-hq.implix.com/2018/5/17/rec-lw-us-5/902681/98a12852f3dfb7d710763712b5880b30/thumbs/"}}}
JSON
        );
        $client->getContainer()->get('httplug.client.mock')->addResponse($response);
        
        /** @var RecorderClient $service */
        $service = $client->getContainer()->get(RecorderClient::class);
        
        $details = $service->getDetails(32);
        
        self::assertInstanceOf(RecordingDetails::class, $details);
        self::assertSame(7, $details->getStatus());
        self::assertSame(123, $details->getDuration());
    }
    
}