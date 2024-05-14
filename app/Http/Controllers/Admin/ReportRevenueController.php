<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Transaction;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Support\Facades\DB;
use App\Exports\RevenueExport;

class ReportRevenueController extends Controller
{
    public function __construct()
    {
        $this->middleware('permission:report-resource', ['only' => ['index','fillterRevenue','exportRevenue']]);
    }

    public function index()
    {

        $revenue = Transaction::query()->where('status', 'accept')->where('action', 'import')->sum('price_promotion');
        $revenue_today = Transaction::where('status', 'accept')->where('action', 'import')->whereDate('created_at', today())->sum('price_promotion');
        $bill_today = Transaction::where('status', 'accept')->where('action', 'import')->whereDate('created_at', today())->count();
        $bill = Transaction::query()->where('action', 'import')->count();
        $bill_false = Transaction::query()->where('action', 'import')->where('status', 'cancel')->count();
        $revenue_service_today = Transaction::query()->where('action', 'export')->whereDate('created_at', today())->sum('point');
        $revenue_service = Transaction::query()->where('status', 'accept')->where('action', 'export')->sum('point');
        $revenueByDay = Transaction::select(DB::raw('DATE(created_at) as revenue_date'), DB::raw('SUM(point) as revenue_total'))->groupBy('revenue_date')->orderBy('revenue_date')->where('status', 'accept')->where('action', 'import')->whereBetween('created_at', [Carbon::now()->subDays(30), Carbon::now()])->get();

        // Tạo mảng chứa ngày và giá trị doanh thu


        // dd($revenueByDay);
        // dd($bill,$bill_false);
        return view('admin.report.revenue.index', compact('revenue', 'revenue_today', 'bill', 'bill_false', 'bill_today', 'revenue_service', 'revenue_service_today', 'revenueByDay'));
    }
    public function fillterRevenue(Request $request)
    {
        $date_start = $request->input('date_start');
        if ($date_start === null) {
            $date_start = 0;
        }
        $date_end = $request->input('date_end');
        if ($date_end === null) {
            $date_end = Carbon::now();
        }
        $query = Transaction::query();
        if ($date_end != null) {
            $query->where('created_at', '<=', $date_end);
        }
        if ($date_start == null && $date_end == null) {
            $query->where('created_at', '<=', Carbon::now());
        }
        if ($date_start != null) {
            $query->where('created_at', '>=', $date_start);
        }
        $revenue = $query->where('status', 'accept')->where('action', 'import')->sum('price_promotion'); //
        $revenue_service = Transaction::where('action', 'export')->whereBetween('created_at', [$date_start, $date_end])->sum('point'); //
        $bill = $query->where('action', 'import')->count(); //
        $bill_false = $query->where('action', 'import')->where('status', 'cancel')->count(); //
        // dd($revenue_service,$bill,$bill_false);
        $revenue_today = Transaction::where('status', 'accept')->where('action', 'import')->whereDate('created_at', today())->sum('point');
        $bill_today = Transaction::where('status', 'accept')->where('action', 'import')->whereDate('created_at', today())->count();
        $revenue_service_today = Transaction::query()->where('action', 'export')->whereDate('created_at', today())->sum('point');
        $revenueByDay = Transaction::select(DB::raw('DATE(created_at) as revenue_date'), DB::raw('SUM(point) as revenue_total'))->groupBy('revenue_date')->orderBy('revenue_date')->where('status', 'accept')->where('action', 'import')->whereBetween('created_at', [Carbon::now()->subDays(30), Carbon::now()])->get();
        // dd($date_start,$date_end);
        return view('admin.report.revenue.index', compact('revenue', 'revenue_today', 'bill', 'bill_false', 'bill_today', 'revenue_service', 'revenue_service_today', 'date_start', 'date_end', 'revenueByDay'));
    }

    public function exportRevenue()
    {
        $revenue = Transaction::query()->where('status', 'accept')->where('action', 'import')->sum('point');
        $revenue_today = Transaction::where('status', 'accept')->where('action', 'import')->whereDate('created_at', today())->sum('point');
        $bill_today = Transaction::where('status', 'accept')->where('action', 'import')->whereDate('created_at', today())->count();
        $bill = Transaction::query()->where('action', 'import')->count();
        $bill_false = Transaction::query()->where('action', 'import')->where('status', 'cancel')->count();
        $revenue_service_today = Transaction::query()->where('action', 'export')->whereDate('created_at', today())->sum('point');
        $revenue_service = Transaction::query()->where('status', 'accept')->where('action', 'export')->sum('point');
        $revenueByDay = Transaction::select(DB::raw('DATE(created_at) as revenue_date'), DB::raw('SUM(point) as revenue_total'))
            ->groupBy('revenue_date')
            ->orderBy('revenue_date')
            ->where('status', 'accept')
            ->where('action', 'import')
            ->whereBetween('created_at', [Carbon::now()->subDays(30), Carbon::now()])
            ->get();

            return Excel::download(
                new RevenueExport(
                    $revenue, $revenue_today, $bill_today, $bill, $bill_false,
                    $revenue_service_today, $revenue_service, $revenueByDay
                ),
                'bao_cao_doanh_thu.xlsx'
            );
    }
}
