<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class ChatController extends Controller
{
    const TOKEN = "7558590028:AAGe9fmAu2W5Jw2Gd3_MM3ccrAYyIMpRXTE";
    const URL = "https://api.telegram.org/bot" . self::TOKEN . "/";

    public function index(Request $request)
    {
        $update = $request->input();

        if (isset($update["message"])) {
            $chat_id = $update["message"]["chat"]["id"];
            $text = $update["message"]["text"];

            if ($text == "/start") {
                $this->sendMessage($chat_id, $text);
            } else {

                $this->answer($chat_id, $text);

            }
        }
    }

    private function sendMessage(int $chat_id, string $text): void
    {
        $url = self::URL . "sendMessage";

        $data = [
            'chat_id' => $chat_id,
            'text' => "<b>Botga xush kelibsiz. Savolingizni yozing.</b>",
            'parse_mode' => "HTML"
        ];

        file_get_contents($url . '?' . http_build_query($data));
    }

    public function answer(string $chat_id, string $text): void
    {
        $url = self::URL . "sendMessage";

        $data = [
            'chat_id' => $chat_id,
            'text' => $text,
            'parse_mode' => "HTML"
        ];

        file_get_contents($url . '?' . http_build_query($data));


    }
}
