<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ExchRate extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'exch_rates';

    protected $guarded = [];
}
