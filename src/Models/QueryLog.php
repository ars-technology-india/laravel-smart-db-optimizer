<?php

namespace AshokDevatwal\SmartDbOptimizer\Models;

use Illuminate\Database\Eloquent\Model;

class QueryLog extends Model
{
    protected $fillable = ['query', 'bindings', 'time'];
}
