<?php

namespace App\Component\Billing;

use Carbon\Carbon;

class DueDateCalculator implements DueDateInterface
{
    public function periods(?Carbon $billingStartDate = null, ?Carbon $now = null): int
    {
        throw new \Exception('Not implemented');
    }

    public function nextDueDate(?Carbon $billingStartDate = null, ?Carbon $now = null): Carbon
    {
        throw new \Exception('Not implemented');
    }
}
