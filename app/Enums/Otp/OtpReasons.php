<?php
namespace App\Enums\Otp;

use Illuminate\Validation\Rules\Enum;


/**
 * @method static static EMAILVERIFICATION()
 * @method static static PASSWORDRESET()
 * @method static static EDITFORM()
 * @method static static RESETPASSWORD()
 * @method static static CUSTOM()
 */
class OtpReasons extends Enum
{
    public const EMAILVERIFICATION = 1;

    public const PHONEVERIFICATION = 2;

    public const EDITFORM = 3;

    public const RESETPASSWORD = 4;
 
}
