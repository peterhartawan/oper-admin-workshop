<?php

namespace App\Services;

use Firebase\JWT\JWT;
use GuzzleHttp\Client;
use GuzzleHttp\Exception\ClientException;
use GuzzleHttp\Psr7\Response;

/**
 * Ref: https://github.com/DarshPhpDev/phpzoomapi/blob/master/zoomApi.php
 * Ref: https://github.com/MinaWilliam/zoom-api
 * Ref: https://marketplace.zoom.us/docs/api-reference/zoom-api/meetings/meetings
 */
class ZoomApiServices
{
    public const ERR_USER_NOT_FOUND = 1001;
    public const ERR_MEET_NOT_EXIST = 3001;

    private const MEETING_STATUS_END = 'end';

    private $apiPoint = 'https://api.zoom.us/v2';
    private $key;
    private $secret;
    private $client;

    public function __construct($key, $secret)
    {
        $this->key = $key;
        $this->secret = $secret;
        $this->client = new Client();
    }

    private function generateJWT($key, $secret)
    {
        $token = [
            'iss' => $key,
            'exp' => time() + 60,
        ];

        return JWT::encode($token, $secret);
    }

    private function headers()
    {
        return [
            'Authorization' => 'Bearer ' . $this->generateJWT($this->key, $this->secret),
            'Content-Type' => 'application/json',
            'Accept' => 'application/json',
        ];
    }

    private function result(Response $response)
    {
        $result = json_decode((string)$response->getBody(), true);

        $result['code'] = $response->getStatusCode();

        return $result;
    }

    private function get($method, $fields = [])
    {
        try {
            $response = $this->client->request('GET', $this->apiPoint . $method, [
                'query' => $fields,
                'headers' => $this->headers(),
            ]);

            return $this->result($response);

        } catch (ClientException $e) {
            return (array)json_decode($e->getResponse()->getBody()->getContents());
        }
    }

    private function post($method, $fields)
    {
        $body = json_encode($fields, JSON_PRETTY_PRINT);

        try {
            $response = $this->client->request('POST', $this->apiPoint . $method,
                ['body' => $body, 'headers' => $this->headers()]);

            return $this->result($response);

        } catch (ClientException $e) {
            return (array)json_decode($e->getResponse()->getBody()->getContents());
        }
    }

    protected function put($method, $fields)
    {
        $body = json_encode($fields, JSON_PRETTY_PRINT);

        try {
            $response = $this->client->request('PUT', $this->apiPoint . $method,
                ['body' => $body, 'headers' => $this->headers()]);

            return $this->result($response);

        } catch (ClientException $e) {
            return (array)json_decode($e->getResponse()->getBody()->getContents());
        }
    }

    private function delete($method)
    {
        try {
            $response = $this->client->request('DELETE', $this->apiPoint . $method,
                [ 'headers' => $this->headers()]);

            return $this->result($response);

        } catch (ClientException $e) {
            return (array)json_decode($e->getResponse()->getBody()->getContents());
        }
    }

    public function getUser($email)
    {
        return $this->get("/users/$email");
    }

    public function createMeeting(string $userId, $config = [])
    {
        $date = date('Y-m-dTh:i:00') . 'Z';
        $data = [
            'topic' => $config['topic'] ?? 'Consultation With Customer ' . $date,
            'type' => $config['type'] ?? 2,
            'start_time' => $config['start_time'] ?? $date,
            'duration' => $config['duration'] ?? 30,
            'password' => $config['password'] ?? mt_rand(),
            'timezone' => 'Asia/Jakarta',
            'agenda' => 'Consultation',
            'settings' => [
                'host_video' => true,
                'participant_video' => true,
                'cn_meeting' => false,
                'in_meeting' => false,
                'join_before_host' => true,
                'mute_upon_entry' => false,
                'watermark' => false,
                'use_pmi' => false,
                'approval_type' => 1,
                'registration_type' => 1,
                'audio' => 'voip',
                'auto_recording' => 'none',
                'waiting_room' => false
            ]
        ];

        return $this->post("/users/{$userId}/meetings", $data);
    }

    public function listMeeting(string $userId)
    {
        return $this->get("/users/{$userId}/meetings");
    }

    public function updateMeetingStatus(string $meetingId,  string $action) {
        $data = [
            'action' => $action,
        ];

        return $this->put("/meetings/{$meetingId}/status", $data);
    }

    public function forceEndMeeting(string $meetingId)
    {
        return $this->updateMeetingStatus($meetingId, self::MEETING_STATUS_END);
    }

    public function deleteMeeting(string $meetingId)
    {
        return $this->delete("/meetings/{$meetingId}");
    }

    public function checkMeeting(string $meetingId)
    {
        return $this->get("/meetings/{$meetingId}");
    }
}
