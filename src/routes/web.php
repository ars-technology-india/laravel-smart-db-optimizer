<?php

use Illuminate\Support\Facades\Route;
use SmartDbOptimizer\Models\QueryLog;

Route::get('/smartdb/queries', function () {
    return response()->json(QueryLog::all());
});
