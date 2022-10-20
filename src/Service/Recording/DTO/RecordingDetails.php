<?php

declare(strict_types=1);

namespace ClickMeeting\Service\Recording\DTO;

class RecordingDetails
{
    
    private int $status;
    private int $duration;
    private string $url;
    
    private function __construct()
    {
    }
    
    public static function fromJson(string $response): self 
    {
        $dto = new self;
        
        $decode = json_decode($response, false);
        $dto->status = $decode->recording->status;
        $dto->duration = $decode->recording->file->duration;
        $dto->url = $decode->recording->file->url;
        
        return $dto;
    }
    
    public function getStatus(): int
    {
        return $this->status;
    }

    public function getDuration(): int
    {
        return $this->duration;
    }
    
    public function getRecordingUrl(): string
    {
        return $this->url;
    }
}