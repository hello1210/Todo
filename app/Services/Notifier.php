<?php
namespace App\Services;

class Notifier
{
    public static function send(string $message)
    {
        // maybe log, mail, or push a notification
        echo "Sending: " . $message;
    }
}
