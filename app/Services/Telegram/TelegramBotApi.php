<?php
declare(strict_types=1);
namespace App\Services\Telegram;


use App\Services\Telegram\Exceptions\TelegramBotApiException;
use Illuminate\Support\Facades\Http;
use Throwable;

class TelegramBotApi
{
    public const HOST = 'https://api.telegram.org/123bot';

    public static function sendMessage(string $token,int $chat_id,string $message): bool
    {
        try {
            $response = Http::get(self::HOST . $token . "/sendMessage",[
                'chat_id' => $chat_id,
                'text' => $message
            ])->throw()->json();

            return $response['ok'] ?? false;
        } catch (Throwable $exception){
            report(new TelegramBotApiException($exception->getMessage()));

            return false;
        }

    }
}
