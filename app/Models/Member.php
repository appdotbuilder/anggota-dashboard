<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

/**
 * App\Models\Member
 *
 * @property int $id
 * @property string $member_number
 * @property string $name
 * @property string $savings_pokok
 * @property string $savings_wajib
 * @property string $savings_sukarela
 * @property string $total_loans
 * @property int $notifications_count
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 *
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\LoanItem> $loanItems
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Transaction> $transactions
 * @property-read int|null $loan_items_count
 * @property-read int|null $transactions_count
 *
 * @method static \Illuminate\Database\Eloquent\Builder|Member newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Member newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Member query()
 * @method static \Illuminate\Database\Eloquent\Builder|Member whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Member whereMemberNumber($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Member whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Member whereSavingsPokok($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Member whereSavingsWajib($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Member whereSavingsSukarela($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Member whereTotalLoans($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Member whereNotificationsCount($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Member whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Member whereUpdatedAt($value)
 * @method static \Database\Factories\MemberFactory factory($count = null, $state = [])
 *
 * @mixin \Eloquent
 */
class Member extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'member_number',
        'name',
        'savings_pokok',
        'savings_wajib',
        'savings_sukarela',
        'total_loans',
        'notifications_count',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'savings_pokok' => 'decimal:2',
        'savings_wajib' => 'decimal:2',
        'savings_sukarela' => 'decimal:2',
        'total_loans' => 'decimal:2',
        'notifications_count' => 'integer',
    ];

    /**
     * Get the loan items for the member.
     */
    public function loanItems(): HasMany
    {
        return $this->hasMany(LoanItem::class);
    }

    /**
     * Get the transactions for the member.
     */
    public function transactions(): HasMany
    {
        return $this->hasMany(Transaction::class);
    }

    /**
     * Get the total savings amount.
     *
     * @return float
     */
    public function getTotalSavingsAttribute(): float
    {
        return (float)$this->savings_pokok + (float)$this->savings_wajib + (float)$this->savings_sukarela;
    }
}