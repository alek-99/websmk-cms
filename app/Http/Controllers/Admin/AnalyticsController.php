<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Berita;
use App\Models\BeritaAnalytic;
use Illuminate\Http\Request;
use Carbon\Carbon;

class AnalyticsController extends Controller
{
    public function index(Request $request)
    {
        $period = $request->get('period', 'month'); // month, week, year
        $fromDate = $this->getFromDate($period);
        
        // Total stats
        $analytics = BeritaAnalytic::where('date', '>=', $fromDate)->get();
        
        $totalViews = $analytics->sum('views');
        $totalUniqueViews = $analytics->sum('unique_views');
        $totalShares = $analytics->sum('shares');
        $avgReadingTime = $analytics->avg('avg_reading_time');

        // Top performing articles
        $topArticles = Berita::join('berita_analytics', 'beritas.id', '=', 'berita_analytics.berita_id')
            ->where('berita_analytics.date', '>=', $fromDate)
            ->select('beritas.id', 'beritas.title', 'beritas.slug')
            ->selectRaw('SUM(berita_analytics.views) as total_views')
            ->selectRaw('SUM(berita_analytics.unique_views) as total_unique_views')
            ->selectRaw('AVG(berita_analytics.avg_reading_time) as avg_time')
            ->groupBy('beritas.id', 'beritas.title', 'beritas.slug')
            ->orderByDesc('total_views')
            ->limit(10)
            ->get();

        // Views chart data
        $chartData = BeritaAnalytic::where('date', '>=', $fromDate)
            ->selectRaw('date, SUM(views) as views, SUM(unique_views) as unique_views')
            ->groupBy('date')
            ->orderBy('date', 'asc')
            ->get();

        // Category statistics
        $categoryStats = Berita::join('berita_category', 'beritas.id', '=', 'berita_category.berita_id')
            ->join('berita_categories', 'berita_category.berita_category_id', '=', 'berita_categories.id')
            ->select('berita_categories.name', 'berita_categories.id')
            ->selectRaw('COUNT(beritas.id) as count')
            ->selectRaw('SUM(beritas.views) as total_views')
            ->groupBy('berita_categories.id', 'berita_categories.name')
            ->get();

        // Reading time heatmap
        $readingTimeData = BeritaAnalytic::where('date', '>=', $fromDate)
            ->selectRaw('date, AVG(avg_reading_time) as avg_time')
            ->groupBy('date')
            ->orderBy('date', 'asc')
            ->pluck('avg_time', 'date');

        return view('admin.analytics.index', compact(
            'period', 'totalViews', 'totalUniqueViews', 'totalShares',
            'avgReadingTime', 'topArticles', 'chartData', 'categoryStats', 'readingTimeData'
        ));
    }

    public function export(Request $request)
    {
        $period = $request->get('period', 'month');
        $format = $request->get('format', 'csv'); // csv, excel, pdf
        $fromDate = $this->getFromDate($period);

        $analytics = BeritaAnalytic::where('date', '>=', $fromDate)
            ->with('berita:id,title,slug')
            ->orderBy('date', 'desc')
            ->get();

        if ($format === 'csv') {
            return $this->exportAsCSV($analytics, $period);
        } elseif ($format === 'excel') {
            return $this->exportAsExcel($analytics, $period);
        }

        return back()->with('error', 'Format tidak didukung');
    }

    private function exportAsCSV($analytics, $period)
    {
        $filename = 'analytics_' . $period . '_' . date('Y-m-d_His') . '.csv';

        $headers = array(
            'Content-Type' => 'text/csv',
            'Content-Disposition' => 'attachment; filename="' . $filename . '"',
        );

        $callback = function () use ($analytics) {
            $file = fopen('php://output', 'w');
            fputcsv($file, ['Tanggal', 'Berita', 'Views', 'Unique Views', 'Shares', 'Avg Reading Time']);

            foreach ($analytics as $record) {
                fputcsv($file, [
                    $record->date,
                    $record->berita->title ?? '-',
                    $record->views,
                    $record->unique_views,
                    $record->shares,
                    round($record->avg_reading_time, 2) . ' menit'
                ]);
            }

            fclose($file);
        };

        return response()->stream($callback, 200, $headers);
    }

    private function exportAsExcel($analytics, $period)
    {
        $filename = 'analytics_' . $period . '_' . date('Y-m-d_His') . '.xlsx';

        // Using array data to return simple table format
        $headers = array(
            'Content-Type' => 'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet',
            'Content-Disposition' => 'attachment; filename="' . $filename . '"',
        );

        $callback = function () use ($analytics) {
            $file = fopen('php://output', 'w');
            fputcsv($file, ['Tanggal', 'Berita', 'Views', 'Unique Views', 'Shares', 'Avg Reading Time']);

            foreach ($analytics as $record) {
                fputcsv($file, [
                    $record->date,
                    $record->berita->title ?? '-',
                    $record->views,
                    $record->unique_views,
                    $record->shares,
                    round($record->avg_reading_time, 2)
                ]);
            }

            fclose($file);
        };

        return response()->stream($callback, 200, $headers);
    }

    private function getFromDate($period)
    {
        switch ($period) {
            case 'week':
                return Carbon::now()->subWeeks(1)->startOfDay();
            case 'year':
                return Carbon::now()->subYear()->startOfDay();
            case 'month':
            default:
                return Carbon::now()->subMonth()->startOfDay();
        }
    }
}
