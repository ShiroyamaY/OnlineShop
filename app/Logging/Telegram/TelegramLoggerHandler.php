<?php
declare(strict_types=1);
namespace App\Logging\Telegram;

use App\Services\Telegram\TelegramBotApi;
use Monolog\Handler\AbstractProcessingHandler;
use Monolog\Logger;
use Monolog\LogRecord;

class TelegramLoggerHandler extends AbstractProcessingHandler
{
    protected string $token;
    protected int $chat_id;
    public function __construct(array $config)
    {
        $level = Logger::toMonologLevel($config['level']);

        parent::__construct($level);

        $this->token = $config['token'];
        $this->chat_id = (int)$config['chat_id'];
    }

    protected function write(LogRecord $record): void
    {
        TelegramBotApi::sendMessage(
            $this->token,
            $this->chat_id,
            $record->formatted
        );
    }
}
