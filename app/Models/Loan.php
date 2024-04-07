<?php

namespace App\Models;

use App\Contracts\Models\MainModelInterface;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Loan extends Model implements MainModelInterface
{
    use HasFactory;

    protected $table = 'loans';

    protected $fillable = [
        'loan_amount', 'interest_rate', 'loan_term'
    ];


    /**
     * @return HasMany
     */
    public function amortizationSchedules():HasMany
    {
        return $this->hasMany(AmortizationSchedule::class);
    }

}
