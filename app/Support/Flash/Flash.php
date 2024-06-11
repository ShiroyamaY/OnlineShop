<?php

namespace App\Support\Flash;


use Illuminate\Contracts\Session\Session;

class Flash
{
    protected const MESSAGE_KEY = 'shop_message_key';

    protected const MESSAGE_CLASS_KEY = 'shop_message_class';

    public function __construct(
        public Session $session
    ){}

    function get(): ?FlashMessage
    {
        if(!$this->session->has(self::MESSAGE_KEY))
        {
            return null;
        }

        return new FlashMessage(
            $this->session->get(self::MESSAGE_KEY),
            $this->session->get(self::MESSAGE_CLASS_KEY)
        );
    }
    public function info($message): void
    {
        $this->flash($message,'info');
    }

    public function alert($message): void
    {
        $this->flash($message,'alert');
    }

    public function flash($message,$name): void
    {
        $this->session->flash(self::MESSAGE_KEY,$message);
        $this->session->flash(self::MESSAGE_CLASS_KEY,$name);
    }
}
