<?php

namespace App\Traits;

use Exception;
use Throwable;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Http;

trait SmsApi
{

    protected function sendSms($phonenumber, $message)
    {

        try {
            $results = Http::get(
                config('sms_api.api') . "?Username=" . config('sms_api.sms-username') . "&Password=" . config('sms_api.sms-password') . "&From=UHS-LAHORE&To=" . $phonenumber . "&Message=" . $message
            );
        } catch (Throwable $exception) {
            Log::error('Wordpress API Get error: ' . $exception->getMessage());
            
            // TODO
        }
        if (!$results->successful()) {
            throw new Exception('Connection problem to wordpress site');
        }
        return $results;
    }
}
