<?php

namespace App\Models;

use App\Contracts\Models\MainModelInterface;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class AmortizationSchedule extends Model implements MainModelInterface
{
    use HasFactory;

    protected $table = 'amortization_schedules';

    protected $fillable = [
        'loan_id', 'month', 'starting_balance', 'monthly_payment', 'principal_component', 'interest_component', 'ending_balance'
    ];

    /**
     * @return BelongsTo
     */
    public function loan():BelongsTo
    {
        return $this->belongsTo(Loan::class, 'loan_id');
    }

}
