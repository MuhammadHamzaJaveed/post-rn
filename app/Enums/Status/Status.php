<?php

namespace App\Enums\Status;

use Illuminate\Validation\Rules\Enum;

/**
 * @method static static APPROVED()
 * @method static static PENDING()
 * @method static static REJECTED()
 */
final class Status extends Enum
{
    public const APPROVED = 1;

    public const PENDING = 2;

    public const REJECTED = 3;

    public const UNVERIFIED = 4;

}
