<?php

namespace App\Http\Enums;

enum PlanBillingTriggerTypeEnum: string
{
    case BeginningOfPeriod = 'beggining_of_period';
    case EndOfPeriod = 'end_of_period';
    case DayOfMonth = 'day_of_month';
}
