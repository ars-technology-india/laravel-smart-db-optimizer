<?php

use Illuminate\Support\Facades\Route;
use AshokDevatwal\SmartDbOptimizer\Models\QueryLog;

Route::get('/smartdb/queries', function () {
    return response()->json(QueryLog::all());
});
