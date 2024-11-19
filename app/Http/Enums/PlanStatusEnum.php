<?php

namespace App\Http\Enums;

enum PlanStatusEnum:string
{
    case Active = 'active';
    case Inactive = 'inactive';
    case Deleted = 'deleted';
}
