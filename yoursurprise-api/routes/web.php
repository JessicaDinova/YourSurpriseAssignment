<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/api/debug-all-tables', function () {
    $tables = DB::select("SELECT name FROM sqlite_master WHERE type='table'");
    
    $tableStructures = [];
    foreach ($tables as $table) {
        $columns = DB::select("PRAGMA table_info(\"{$table->name}\")");
        $tableStructures[$table->name] = [
            'columns' => $columns,
            'sample_data' => DB::table($table->name)->limit(2)->get()
        ];
    }
    
    return response()->json($tableStructures);
});