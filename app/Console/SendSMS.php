<?php

namespace App\Console;

use App\Jobs\ApplicationSuccessfulEmail;
use App\Jobs\SendOtpEmail;
use App\Models\User;
use App\Traits\SmsApi;
use Exception;
use Illuminate\Console\Command;

class SendSMS extends Command
{
    use SmsApi;

    protected $signature = 'sendSMSAndEmails';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Send email and SMS to users who have submitted their challans';

    /**
     * Create a new command instance.
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return void
     * @throws Exception
     */
    public function handle(): void
    {
        $users = User::query()
            ->where(
                'transaction_id',
                '!=',
                null
            );

        $users->chunk(50, function ($users) {
            foreach ($users as $user) {

                dispatch(new ApplicationSuccessfulEmail($user->email));
                $this->sendSms($user->mobile_number, 'Dear Applicant, This is to confirm that your application has been successfully submitted. Thank you for applying to UHS.');

                sleep(1);
                info('SMS and Email send for userId: '.$user->id.' and mobile number is '.$user->mobile_number);
            }
        });
    }
}
