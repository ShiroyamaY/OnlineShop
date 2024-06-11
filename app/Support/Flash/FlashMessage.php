<?php

namespace App\Support\Flash;

class FlashMessage
{
    public function __construct(
        protected string $message,
        protected string $class,
    ){}
    public function getMessage(): string{
        return $this->message;
    }
    public function getClass(): string{
        return $this->class;
    }
}
