<?php

namespace App\Message;

class Processing
{
    private string $id;

    private string $content;

    private ?string $email;

    public function __construct(string $content)
    {
        $this->content = $content;
        $this->id = uniqid();
        $this->email = json_decode($content)->email ?? null;
    }

    public function getContent(): string
    {
        return $this->content;
    }

    public function getId(): string
    {
        return $this->id;
    }

    public function getEmail(): ?string
    {
        return $this->email;
    }
}