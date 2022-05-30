<?php

namespace App\Http\Enums;

enum SubscriptionStatuses : string
{
    case ACTIVE = 'active';
    case PAUSED = 'paused';
    case DISABLED = 'disabled';
}
