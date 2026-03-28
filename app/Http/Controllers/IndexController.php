<?php

namespace App\Http\Controllers;

use App\Http\Helpers\Tally;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class IndexController extends Controller
{
    public function index(Request $request) {
        $validator = Validator::make($request->all(), [
            'report_type' => 'nullable|in:daily,weekly,monthly,yearly',
            'import_export_type' => 'nullable|in:daily,weekly,monthly,yearly',
        ]);

        // dd($request->all());
        if ($validator->fails()) {
            if ($request->wantsJson() || $request->has('json')) {
                return response()->json(['error' => 'Invalid report_type'], 400);
            }
            return redirect()->back()->withErrors($validator, 'error_report_type');
        }
        $report_type = $request->report_type ?? 'monthly';
        $import_export_type = $request->import_export_type ?? 'monthly';

        $cadr_info = Tally::cadr_info();
        

        $report_chart = Tally::report_chart($report_type);
        $report_import_export = Tally::report_import_export($import_export_type);

        $report_total_revenue = Tally::report_total_revenue();
        
        // اگر درخواست JSON است
        if ($request->wantsJson() || $request->has('json')) {
            return response()->json([
                'report_chart' => $report_chart,
                'report_import_export' => $report_import_export,
                'report_type' => $report_type,
                'import_export_type' => $import_export_type
            ]);
        }
        
        return view('index', compact('report_chart', 'report_type', 'report_import_export', 'import_export_type', 'cadr_info', 'report_total_revenue'));
    }
}
