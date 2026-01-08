<?php
namespace App\Enums\Otp;

use Illuminate\Validation\Rules\Enum;


/**
 * @method static static EMAIL()
 * @method static static SMS()
 * @method static static CUSTOM()
 */
class OtpTypes extends Enum
{
    public const EMAIL = 1;

    public const SMS = 2;

}
