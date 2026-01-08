<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\Pivot;

class SeatCategoryUser extends Pivot
{
    use HasFactory;

    /**
     * @return BelongsTo
     */
    public function seatCategory(): BelongsTo
    {
        return $this->belongsTo(SeatCategory::class, 'seat_category_id', 'id');
    }

    /**
     * @return BelongsTo
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }
}
