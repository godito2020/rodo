<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\SearchLog;
use Illuminate\Support\Facades\DB;

class AdminSearchAnalyticsController extends Controller
{
    public function index(Request $request)
    {
        $days = (int)$request->input('periodo', 30);
        $dateLimit = now()->subDays($days);

        // 1. Top searched terms
        $topKeywords = SearchLog::where('created_at', '>=', $dateLimit)
            ->select('query', DB::raw('count(*) as total_searches'), DB::raw('max(created_at) as last_searched'), DB::raw('avg(results_count) as avg_results'))
            ->groupBy('query')
            ->orderBy('total_searches', 'desc')
            ->take(15)
            ->get();

        // 2. Searches with zero results (opportunity keywords)
        $zeroResultSearches = SearchLog::where('created_at', '>=', $dateLimit)
            ->where('results_count', 0)
            ->select('query', DB::raw('count(*) as total_attempts'), DB::raw('max(created_at) as last_searched'))
            ->groupBy('query')
            ->orderBy('total_attempts', 'desc')
            ->take(15)
            ->get();

        // 3. Geographic locations
        $locations = SearchLog::where('created_at', '>=', $dateLimit)
            ->select('city', 'country', DB::raw('count(*) as count'))
            ->whereNotNull('city')
            ->groupBy('city', 'country')
            ->orderBy('count', 'desc')
            ->take(10)
            ->get();

        // 4. Detailed search history table with filters
        $historyQuery = SearchLog::with('user');

        if ($search = $request->input('termino')) {
            $historyQuery->where('query', 'like', "%{$search}%");
        }

        $logs = $historyQuery->latest('created_at')->paginate(20)->withQueryString();

        $totalSearches = SearchLog::where('created_at', '>=', $dateLimit)->count();
        $uniqueUsers = SearchLog::where('created_at', '>=', $dateLimit)->distinct('ip_address')->count('ip_address');

        return view('admin.analytics.searches', compact(
            'topKeywords',
            'zeroResultSearches',
            'locations',
            'logs',
            'days',
            'totalSearches',
            'uniqueUsers'
        ));
    }

    public function clearLogs()
    {
        SearchLog::truncate();
        return back()->with('success', 'Historial de búsquedas vaciado correctamente.');
    }
}
