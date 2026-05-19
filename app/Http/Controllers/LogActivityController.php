<?php
// app/Http/Controllers/LogActivityController.php

namespace App\Http\Controllers;

use App\Models\StockMutation;
use Illuminate\Http\Request;

class LogActivityController extends Controller
{
    public function index()
    {
        $activityLogs = StockMutation::with(['product', 'user'])
            ->orderBy('created_at', 'desc')
            ->paginate(15);
        
        $totalStockIn = StockMutation::where('type', 'in')->count();
        $totalStockOut = StockMutation::where('type', 'out')->count();
        $totalActions = StockMutation::count();
        
        return view('admin.log-activity', compact('activityLogs', 'totalStockIn', 'totalStockOut', 'totalActions'));
    }
}