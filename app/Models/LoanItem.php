<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * App\Models\LoanItem
 *
 * @property int $id
 * @property int $member_id
 * @property string $name
 * @property string|null $code
 * @property string $amount
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 *
 * @property-read \App\Models\Member $member
 *
 * @method static \Illuminate\Database\Eloquent\Builder|LoanItem newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|LoanItem newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|LoanItem query()
 * @method static \Illuminate\Database\Eloquent\Builder|LoanItem whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|LoanItem whereMemberId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|LoanItem whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|LoanItem whereCode($value)
 * @method static \Illuminate\Database\Eloquent\Builder|LoanItem whereAmount($value)
 * @method static \Illuminate\Database\Eloquent\Builder|LoanItem whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|LoanItem whereUpdatedAt($value)
 * @method static \Database\Factories\LoanItemFactory factory($count = null, $state = [])
 *
 * @mixin \Eloquent
 */
class LoanItem extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'member_id',
        'name',
        'code',
        'amount',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'amount' => 'decimal:2',
    ];

    /**
     * Get the member that owns the loan item.
     */
    public function member(): BelongsTo
    {
        return $this->belongsTo(Member::class);
    }
}