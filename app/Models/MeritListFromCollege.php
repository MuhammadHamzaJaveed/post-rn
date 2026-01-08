<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class MeritListFromCollege extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'selection_list_id',
        'college_from',
        'college_to',
        'seat_id',
        'student_affidavit_path',
        'college_affidavit_path',
        'is_paid',
        'is_joined',
        'is_stay',
        'status',
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function seat(): BelongsTo
    {
        return $this->belongsTo(Seat::class, 'seat_id');
    }

    public function college(): BelongsTo
    {
        return $this->belongsTo(College::class, 'college_to');
    }

    public function college_from(): BelongsTo
    {
        return $this->belongsTo(College::class, 'college_from');
    }

    public function collegeFrom(): BelongsTo
    {
        return $this->belongsTo(College::class,'college_from');
    }

    public function selectionList(): BelongsTo
    {
        return $this->belongsTo(SelectionList::class,'selection_list_id');
    }

    public function seatCategoryId(): BelongsTo
    {
        return $this->belongsTo(SeatCategory::class,'seat_category_id');
    }
}
