<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Relations\Pivot;
use Illuminate\Database\Eloquent\SoftDeletes;

class CopyLoan extends Pivot
{
    //
    use SoftDeletes;
}
