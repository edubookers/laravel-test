<?php

namespace App\Component\Billing;

use Carbon\Carbon;

class DueDateCalculator implements DueDateInterface
{
    public function periods(?Carbon $billingStartDate = null, ?Carbon $now = null): int
    {
        return $now->diffInMonths($billingStartDate);
    }

    public function nextDueDate(?Carbon $billingStartDate = null, ?Carbon $now = null): Carbon
    {
        $endOfMonth = $now->copy()->endOfMonth()->startOfDay();

        if ($billingStartDate < $now && !$now->isSameMonth($billingStartDate) && $endOfMonth->eq($now)) {
            return $now->addMonth()->endOfMonth();
        }

        return $now->endOfMonth();
    }

}
