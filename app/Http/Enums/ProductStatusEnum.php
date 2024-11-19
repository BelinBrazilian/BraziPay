<?php

namespace App\Http\Enums;

enum ProductStatusEnum: string 
{
    case Active = 'active';
    case Inactive = 'inactive';
    case Deleted = 'deleted';
}
