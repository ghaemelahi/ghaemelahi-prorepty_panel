@extends('layouts.app')
@section('title', 'خانه')

@section('content')
    {{-- دادهٔ خام برای کارت‌های خلاصه (بعداً از کنترلر مقداردهی کنید) --}}
    @php
        // $stats = [
        //     'buyers_count' => 0,
        //     'sellers_count' => 0,
        //     'total_sell_requests' => 0,
        //     'total_deals' => 0,
        // ];
        $shareChartData = $shareChartData ?? [
            ['label' => 'A', 'value' => 60],
            ['label' => 'B', 'value' => 40],
        ];
    @endphp

    {{-- کارت‌های خلاصه — اول صفحه --}}
    <div class="row g-3 mb-4">
        <div class="col-lg-3 col-sm-6">
            <div class="card bg-white border-0 rounded-10 h-100">
                <div class="card-body p-4">
                    <div class="d-flex justify-content-between align-items-center mb-2">
                        <span class="text-gray-light fs-14">تعداد خریداران</span>
                        <div class="icon bg-opacity-10 bg-primary rounded-8 p-2">
                            <i data-feather="users" class="text-primary" style="width:20px;height:20px"></i>
                        </div>
                    </div>
                    <h3 class="body-font fw-bold fs-4 mb-0" id="stat_buyers">{{ number_format($cadr_info['count_buyers']) }}</h3>
                </div>
            </div>
        </div>
        <div class="col-lg-3 col-sm-6">
            <div class="card bg-white border-0 rounded-10 h-100">
                <div class="card-body p-4">
                    <div class="d-flex justify-content-between align-items-center mb-2">
                        <span class="text-gray-light fs-14">تعداد فروشندگان</span>
                        <div class="icon bg-opacity-10 bg-success rounded-8 p-2">
                            <i data-feather="user-check" class="text-success" style="width:20px;height:20px"></i>
                        </div>
                    </div>
                    <h3 class="body-font fw-bold fs-4 mb-0" id="stat_sellers">{{ number_format($cadr_info['count_sellers']) }}</h3>
                </div>
            </div>
        </div>
        <div class="col-lg-3 col-sm-6">
            <div class="card bg-white border-0 rounded-10 h-100">
                <div class="card-body p-4">
                    <div class="d-flex justify-content-between align-items-center mb-2">
                        <span class="text-gray-light fs-14">کل درخواست‌های فروش</span>
                        <div class="icon bg-opacity-10 bg-warning rounded-8 p-2">
                            <i data-feather="file-text" class="text-warning" style="width:20px;height:20px"></i>
                        </div>
                    </div>
                    <h3 class="body-font fw-bold fs-4 mb-0" id="stat_sell_requests">{{ number_format($cadr_info['count_seller_requests']) }}</h3>
                </div>
            </div>
        </div>
        <div class="col-lg-3 col-sm-6">
            <div class="card bg-white border-0 rounded-10 h-100">
                <div class="card-body p-4">
                    <div class="d-flex justify-content-between align-items-center mb-2">
                        <span class="text-gray-light fs-14">کل درخواست‌های خرید</span>
                        <div class="icon bg-opacity-10 bg-info rounded-8 p-2">
                            <i data-feather="shopping-cart" class="text-info" style="width:20px;height:20px"></i>
                        </div>
                    </div>
                    <h3 class="body-font fw-bold fs-4 mb-0" id="stat_total_deals">{{ number_format($cadr_info['count_buyer_requests']) }}</h3>
                </div>
            </div>
        </div>
    </div>


    {{-- نمودار خطی — گزارش کلی --}}
    <div class="row mb-4">
        <div class="col-12">
            <div class="card bg-white border-0 rounded-10">
                <div class="card-body p-4">
                    <div class="d-flex justify-content-between align-items-center flex-wrap gap-2 border-bottom pb-20 mb-20">
                        <h4 class="fw-semibold fs-18 mb-0">گزارش کلی</h4>
                        <select id="report_type_select" class="form-select form-select-sm" style="width: auto; min-width: 120px;">
                            <option value="daily"  @selected($report_type  == 'daily') >روزانه</option>
                            <option value="weekly"  @selected($report_type  == 'weekly') >هفتگی</option>
                            <option value="monthly"  @selected($report_type  == 'monthly') >ماهانه</option>
                            <option value="yearly"  @selected($report_type  == 'yearly') >سالانه</option>
                        </select>
                    </div>
                    <div id="dashboard_audience_line" style="min-height: 320px;"></div>
                </div>
            </div>
        </div>
    </div>

    {{-- کل گزارش (دونات + KPIها) و گزارش کلی (رادار) --}}
    <div class="row">
        <div class="col-lg-5 col-xxl-4 mb-4">
            <div class="card bg-white border-0 rounded-10 h-100">
                <div class="card-body p-4">
                    <h4 class="fw-semibold fs-18 mb-4">گزارش کلی</h4>
                    {{-- <div class="text-center mb-4">
                        <div id="dashboard_total_revenue_donut" style="min-height: 220px;"></div>
                    </div> --}}
                    <ul class="ps-0 mb-0 list-unstyled">
                        <li class="d-flex justify-content-between align-items-center border-bottom py-3">
                            <span class="text-gray-light">تعداد کل درخواست‌ها</span>
                            <span class="fw-semibold"><span id="kpi_avg_session">{{$report_total_revenue['all_requests_count']}}</span></span>
                        </li>
                        <li class="d-flex justify-content-between align-items-center border-bottom py-3">
                            <span class="text-gray-light">تعداد خریداران</span>
                            <span class="fw-semibold"><span id="kpi_conversion">{{$report_total_revenue['all_buyers_count']}}</span>
                        </li>
                        <li class="d-flex justify-content-between align-items-center border-bottom py-3">
                            <span class="text-gray-light">تعداد ملک‌های فروش رفته</span>
                            <span class="fw-semibold"><span id="kpi_avg_duration">{{$report_total_revenue['sell_buildings_count']}}</span>
                        </li>
                        <li class="d-flex justify-content-between align-items-center border-bottom py-3">
                            <span class="text-gray-light">تعداد خانه‌های اجاره‌ای</span>
                            <span class="fw-semibold"><span id="kpi_weekly_revenue">{{$report_total_revenue['rent_houses_count']}}</span>
                        </li>
                        <li class="d-flex justify-content-between align-items-center border-bottom py-3">
                            <span class="text-gray-light">تعداد زمین ها</span>
                            <span class="fw-semibold"><span id="kpi_order_rate">{{$report_total_revenue['earth_lands_count']}}</span>
                        </li>
                        <li class="d-flex justify-content-between align-items-center border-bottom py-3">
                            <span class="text-gray-light">تعداد ملک مسکونی</span>
                            <span class="fw-semibold"><span id="kpi_order_rate">{{$report_total_revenue['residential_lands_count']}}</span>
                        </li>
                        <li class="d-flex justify-content-between align-items-center border-bottom py-3">
                            <span class="text-gray-light">تعداد آرشیوها</span>
                            <span class="fw-semibold"><span id="kpi_avg_visitors">{{$report_total_revenue['archive_buildings_count']}}</span>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
        <div class="col-lg-7 col-xxl-8 mb-4">
            <div class="card bg-white border-0 rounded-10 h-100">
                <div class="card-body p-4">
                    <div class="d-flex justify-content-between align-items-center flex-wrap gap-2 border-bottom pb-20 mb-20">
                        <h4 class="fw-semibold fs-18 mb-0">گزارش ورودی/خروجی</h4>
                        <select id="import_export_type_select" class="form-select form-select-sm" style="width: auto; min-width: 120px;">
                            <option value="daily" @selected($import_export_type == 'daily')>روزانه</option>
                            <option value="weekly" @selected($import_export_type == 'weekly')>هفتگی</option>
                            <option value="monthly" @selected($import_export_type == 'monthly')>ماهانه</option>
                            <option value="yearly" @selected($import_export_type == 'yearly')>سالانه</option>
                        </select>
                    </div>
                    <div id="dashboard_revenue_radar" style="min-height: 520px;"></div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('scripts')
<script>
document.addEventListener('DOMContentLoaded', function() {
    if (typeof ApexCharts === 'undefined') return;

    // ========== دیتای نمودار سهم — از کنترلر با $shareChartData مقداردهی می‌شود ==========
    var shareChartData = @json($shareChartData ?? []);
    
    // ========== دیتای نمودار گزارش کلی — از کنترلر ==========
    var reportChartData = @json($report_chart ?? []);
    var reportType = '{{ $report_type ?? "monthly" }}';
    
    // ========== دیتای نمودار ورودی/خروجی — از کنترلر ==========
    var importExportData = @json($report_import_export ?? []);
    var importExportType = '{{ $import_export_type ?? "monthly" }}';
    var persianMonths = ['فروردین', 'اردیبهشت', 'خرداد', 'تیر', 'مرداد', 'شهریور', 'مهر', 'آبان', 'آذر', 'دی', 'بهمن', 'اسفند'];
    
    // تبدیل داده‌های گزارش به فرمت نمودار
    function prepareReportChartData(data, type) {
        var categories = [];
        var dontSellData = [];
        var sellData = [];
        var archiveData = [];
        
        if (!data || (!data.dont_sell && !data.sell && !data.archive)) {
            return { categories: [], series: [] };
        }
        
        // برای daily و yearly که ساختار آرایه نیست
        if (type === 'daily' || type === 'yearly') {
            var dontSell = Array.isArray(data.dont_sell) ? data.dont_sell : (data.dont_sell ? [data.dont_sell] : []);
            var sell = Array.isArray(data.sell) ? data.sell : (data.sell ? [data.sell] : []);
            var archive = Array.isArray(data.archive) ? data.archive : (data.archive ? [data.archive] : []);
            
            // اگر daily: روزهای ماه
            if (type === 'daily') {
                var maxLen = Math.max(dontSell.length, sell.length, archive.length);
                for (var i = 0; i < maxLen; i++) {
                    var label = dontSell[i]?.lable || sell[i]?.lable || archive[i]?.lable || (i + 1);
                    categories.push(label + '');
                    dontSellData.push(dontSell[i]?.data || 0);
                    sellData.push(sell[i]?.data || 0);
                    archiveData.push(archive[i]?.data || 0);
                }
            } else if (type === 'yearly') {
                // اگر yearly: سال‌ها
                var maxLen = Math.max(dontSell.length, sell.length, archive.length);
                for (var i = 0; i < maxLen; i++) {
                    var label = dontSell[i]?.lable || sell[i]?.lable || archive[i]?.lable || (i + 1);
                    categories.push(label);
                    dontSellData.push(dontSell[i]?.data || 0);
                    sellData.push(sell[i]?.data || 0);
                    archiveData.push(archive[i]?.data || 0);
                }
            }
        } else {
            // برای weekly و monthly که آرایه هستند
            var dontSell = Array.isArray(data.dont_sell) ? data.dont_sell : [];
            var sell = Array.isArray(data.sell) ? data.sell : [];
            var archive = Array.isArray(data.archive) ? data.archive : [];
            
            var maxLen = Math.max(dontSell.length, sell.length, archive.length);
            for (var i = 0; i < maxLen; i++) {
                var label = dontSell[i]?.lable || sell[i]?.lable || archive[i]?.lable || (i + 1);
                
                if (type === 'monthly') {
                    // تبدیل شماره ماه به نام شمسی
                    var monthNum = parseInt(label);
                    if (monthNum >= 1 && monthNum <= 12) {
                        label = persianMonths[monthNum - 1];
                    }
                } else if (type === 'weekly') {
                    label = 'هفته ' + label;
                }
                
                categories.push(label);
                dontSellData.push(dontSell[i]?.data || 0);
                sellData.push(sell[i]?.data || 0);
                archiveData.push(archive[i]?.data || 0);
            }
        }
        
        return {
            categories: categories,
            series: [
                { name: 'فروخته نشده', data: dontSellData },
                { name: 'فروخته شده', data: sellData },
                { name: 'آرشیو شده', data: archiveData }
            ]
        };
    }
    
    var reportChartConfig = prepareReportChartData(reportChartData, reportType);
    var totalRevenuePercent = 65;
    // تبدیل داده‌های ورودی/خروجی به فرمت نمودار رادار
    function prepareImportExportData(data, type) {
        var categories = [];
        var sellerData = [];
        var buyerData = [];
        
        var sellerRequest = Array.isArray(data?.seller_request) ? data.seller_request : [];
        var buyerRequests = Array.isArray(data?.buyer_requests) ? data.buyer_requests : [];
        
        var maxLen = Math.max(sellerRequest.length, buyerRequests.length);
        
        // اگر داده‌ای وجود ندارد، حداقل دسته‌بندی‌های پیش‌فرض ایجاد کن
        if (maxLen === 0) {
            if (type === 'monthly') {
                // برای ماهانه: 12 ماه شمسی
                for (var m = 1; m <= 12; m++) {
                    categories.push(persianMonths[m - 1]);
                    sellerData.push(0);
                    buyerData.push(0);
                }
            } else if (type === 'daily') {
                // برای روزانه: روزهای ماه جاری (حداکثر 31)
                var daysInMonth = 31;
                for (var d = 1; d <= daysInMonth; d++) {
                    categories.push(d + '');
                    sellerData.push(0);
                    buyerData.push(0);
                }
            } else if (type === 'weekly') {
                // برای هفتگی: 4 هفته
                for (var w = 1; w <= 4; w++) {
                    categories.push('هفته ' + w);
                    sellerData.push(0);
                    buyerData.push(0);
                }
            } else if (type === 'yearly') {
                // برای سالانه: سال جاری
                var currentYear = new Date().getFullYear();
                var jalaliYear = currentYear - 621; // تقریبی
                categories.push(jalaliYear + '');
                sellerData.push(0);
                buyerData.push(0);
            }
        } else {
            // اگر داده وجود دارد، از داده‌های واقعی استفاده کن
            for (var i = 0; i < maxLen; i++) {
                var label = sellerRequest[i]?.lable || buyerRequests[i]?.lable || (i + 1);
                
                if (type === 'monthly') {
                    // تبدیل شماره ماه به نام شمسی
                    var monthNum = parseInt(label);
                    if (monthNum >= 1 && monthNum <= 12) {
                        label = persianMonths[monthNum - 1];
                    }
                } else if (type === 'weekly') {
                    label = 'هفته ' + label;
                } else if (type === 'daily') {
                    label = label + '';
                } else if (type === 'yearly') {
                    label = label + '';
                }
                
                categories.push(label);
                sellerData.push(sellerRequest[i]?.data || 0);
                buyerData.push(buyerRequests[i]?.data || 0);
            }
        }
        
        return {
            categories: categories,
            series: [
                { name: 'درخواست فروشندگان', data: sellerData },
                { name: 'درخواست خریداران', data: buyerData }
            ]
        };
    }
    
    var radarChartConfig = prepareImportExportData(importExportData, importExportType);

    // ——— نمودار سهم (نیم‌دایره‌های پیشرفت با گرادیان) ———
    // مقداردهی بعدی: فقط shareChartData را عوض کنید یا از Blade: shareChartData = @json($shareChartData);
    var shareEl = document.getElementById('dashboard_share_chart');
    var shareLegendEl = document.getElementById('dashboard_share_legend');
    if (shareEl && shareChartData && shareChartData.length > 0) {
        var colors = ['#6366f1', '#8b5cf6', '#06b6d4', '#10b981', '#f59e0b'];
        var chartHtml = '';
        shareChartData.forEach(function(item, i) {
            var color = colors[i % colors.length];
            var value = Math.min(100, Math.max(0, Number(item.value) || 0));
            var r = 72;
            var cx = r + 8;
            var cy = r + 12;
            var stroke = 14;
            var halfCircleLength = Math.PI * r;
            var dashArray = halfCircleLength;
            var dashOffset = halfCircleLength - (value / 100) * halfCircleLength;
            var id = 'shareGrad' + i;
            chartHtml += '<div class="share-gauge-item text-center" style="flex: 0 0 auto;">';
            chartHtml += '<svg width="' + (r * 2 + 24) + '" height="' + (r + 50) + '" viewBox="0 0 ' + (r * 2 + 24) + ' ' + (r + 50) + '" style="max-width: 160px;">';
            chartHtml += '<defs><linearGradient id="' + id + '" x1="0%" y1="0%" x2="100%" y2="100%"><stop offset="0%" style="stop-color:' + color + ';stop-opacity:1"/><stop offset="100%" style="stop-color:' + color + ';stop-opacity:0.6"/></linearGradient></defs>';
            chartHtml += '<path d="M ' + (cx - r) + ' ' + cy + ' A ' + r + ' ' + r + ' 0 0 1 ' + (cx + r) + ' ' + cy + '" fill="none" stroke="#EDEFF5" stroke-width="' + stroke + '" stroke-linecap="round"/>';
            chartHtml += '<path d="M ' + (cx - r) + ' ' + cy + ' A ' + r + ' ' + r + ' 0 0 1 ' + (cx + r) + ' ' + cy + '" fill="none" stroke="url(#' + id + ')" stroke-width="' + stroke + '" stroke-linecap="round" stroke-dasharray="' + dashArray + '" stroke-dashoffset="' + dashOffset + '" style="transition: stroke-dashoffset 0.6s ease;"/>';
            chartHtml += '<text x="' + (cx) + '" y="' + (cy + 8) + '" text-anchor="middle" font-family="Open Sans,Arial" font-size="28" font-weight="700" fill="#260944">' + value + '%</text>';
            chartHtml += '<text x="' + (cx) + '" y="' + (cy + r - 10) + '" text-anchor="middle" font-family="Open Sans,Arial" font-size="14" font-weight="600" fill="#5B5B98">' + (item.label || '') + '</text>';
            chartHtml += '</svg></div>';
        });
        shareEl.innerHTML = chartHtml;
        if (shareLegendEl) {
            shareLegendEl.innerHTML = shareChartData.map(function(item, i) {
                var c = colors[i % colors.length];
                return '<div class="d-flex align-items-center mb-2"><span class="rounded-circle d-inline-block me-2 flex-shrink-0" style="width:12px;height:12px;background:' + c + '"></span><span class="fw-semibold text-body">' + (item.label || '') + ' ' + (item.value != null ? item.value + '%' : '') + '</span></div>';
            }).join('');
        }
    }

    // ——— نمودار خطی گزارش کلی ———
    var lineEl = document.querySelector('#dashboard_audience_line');
    var lineChart = null;
    
    function renderReportChart() {
        if (!lineEl) return;
        
        var config = prepareReportChartData(reportChartData, reportType);
        
        if (lineChart) {
            lineChart.updateOptions({
                series: config.series,
                xaxis: { categories: config.categories }
            });
        } else {
            lineChart = new ApexCharts(lineEl, {
                series: config.series,
                chart: { type: 'line', height: 320, toolbar: { show: false } },
                colors: ['#EE368C', '#2DB6F5', '#5B5B98'],
                stroke: { curve: 'smooth', width: 2 },
                markers: { size: 4 },
                xaxis: { categories: config.categories },
                yaxis: { min: 0, tickAmount: 5 },
                grid: { borderColor: '#EDEFF5', strokeDashArray: 4 },
                legend: { position: 'top', horizontalAlign: 'left' },
                dataLabels: { enabled: false }
            });
            lineChart.render();
        }
    }
    
    // رندر اولیه
    renderReportChart();
    
    // تغییر نوع گزارش با AJAX
    var reportTypeSelect = document.getElementById('report_type_select');
    if (reportTypeSelect) {
        reportTypeSelect.addEventListener('change', function() {
            var selectedType = this.value;
            
            // نمایش لودینگ
            if (lineEl) {
                lineEl.style.opacity = '0.5';
                lineEl.style.pointerEvents = 'none';
            }
            
            // درخواست AJAX برای دریافت JSON
            fetch('{{ route("dashbord") }}?report_type=' + selectedType + '&json=1', {
                method: 'GET',
                headers: {
                    'X-Requested-With': 'XMLHttpRequest',
                    'Accept': 'application/json'
                }
            })
            .then(function(response) {
                if (!response.ok) {
                    throw new Error('Network response was not ok');
                }
                return response.json();
            })
            .then(function(data) {
                if (data && data.report_chart) {
                    reportChartData = data.report_chart;
                    reportType = selectedType;
                    renderReportChart();
                    if (lineEl) {
                        lineEl.style.opacity = '1';
                        lineEl.style.pointerEvents = 'auto';
                    }
                } else {
                    throw new Error('Invalid data received');
                }
            })
            .catch(function(error) {
                console.error('Error:', error);
                // در صورت خطا، صفحه را reload کنیم
                if (lineEl) {
                    lineEl.style.opacity = '1';
                    lineEl.style.pointerEvents = 'auto';
                }
                window.location.href = '{{ route("dashbord") }}?report_type=' + selectedType;
            });
        });
    }

    // ——— دونات کل درآمد (۶۵٪) ———
    var donutEl = document.querySelector('#dashboard_total_revenue_donut');
    if (donutEl) {
        var donutChart = new ApexCharts(donutEl, {
            series: [totalRevenuePercent, 100 - totalRevenuePercent],
            chart: { type: 'donut', height: 220 },
            labels: ['درآمد', 'باقی‌مانده'],
            colors: ['#757FEF', '#EDEFF5'],
            legend: { show: false },
            dataLabels: { enabled: false },
            plotOptions: {
                pie: {
                    donut: {
                        size: '75%',
                        labels: {
                            show: true,
                            name: { show: true, label: 'درآمد' },
                            value: { show: true, formatter: function(v) { return v + '%'; } },
                            total: { show: true, label: '', formatter: function(w) { return totalRevenuePercent + '%'; } }
                        }
                    }
                }
            }
        });
        donutChart.render();
    }

    // ——— رادار گزارش ورودی/خروجی ———
    var radarEl = document.querySelector('#dashboard_revenue_radar');
    var radarChart = null;
    
    function renderRadarChart() {
        if (!radarEl) return;
        
        var config = prepareImportExportData(importExportData, importExportType);
        
        // محاسبه حداکثر مقدار برای تنظیم yaxis
        var allValues = [];
        config.series.forEach(function(s) {
            s.data.forEach(function(v) {
                allValues.push(v);
            });
        });
        var maxValue = Math.max.apply(null, allValues);
        var yaxisMax = maxValue > 0 ? maxValue * 1.2 : 10; // اگر همه صفر هستند، حداکثر 10 نمایش بده
        
        if (radarChart) {
            radarChart.updateOptions({
                series: config.series,
                xaxis: { categories: config.categories },
                yaxis: {
                    min: 0,
                    max: yaxisMax,
                    tickAmount: 5
                }
            });
        } else {
            // محاسبه حداکثر مقدار برای تنظیم yaxis
            var allValues = [];
            config.series.forEach(function(s) {
                s.data.forEach(function(v) {
                    allValues.push(v);
                });
            });
            var maxValue = Math.max.apply(null, allValues);
            var minValue = Math.min.apply(null, allValues);
            
            // اگر همه مقادیر صفر هستند، حداقل یک مقدار کوچک برای نمایش تنظیم کن
            var yaxisMin = 0;
            var yaxisMax = maxValue > 0 ? maxValue * 1.2 : 10; // اگر همه صفر هستند، حداکثر 10 نمایش بده
            
            radarChart = new ApexCharts(radarEl, {
                series: config.series,
                chart: { type: 'radar', height: 520 },
                xaxis: { categories: config.categories },
                yaxis: {
                    min: yaxisMin,
                    max: yaxisMax,
                    tickAmount: 5
                },
                colors: ['#757FEF', '#F59E0B'],
                fill: { opacity: 0.3 },
                stroke: { width: 2 },
                legend: { position: 'bottom' },
                plotOptions: { radar: { size: 200, polygons: { strokeColors: '#EDEFF5' } } }
            });
            radarChart.render();
        }
    }
    
    // رندر اولیه
    renderRadarChart();
    
    // تغییر نوع گزارش ورودی/خروجی با AJAX
    var importExportTypeSelect = document.getElementById('import_export_type_select');
    if (importExportTypeSelect) {
        importExportTypeSelect.addEventListener('change', function() {
            var selectedType = this.value;
            
            // نمایش لودینگ
            if (radarEl) {
                radarEl.style.opacity = '0.5';
                radarEl.style.pointerEvents = 'none';
            }
            
            // درخواست AJAX برای دریافت JSON
            fetch('{{ route("dashbord") }}?import_export_type=' + selectedType + '&json=1', {
                method: 'GET',
                headers: {
                    'X-Requested-With': 'XMLHttpRequest',
                    'Accept': 'application/json'
                }
            })
            .then(function(response) {
                if (!response.ok) {
                    throw new Error('Network response was not ok');
                }
                return response.json();
            })
            .then(function(data) {
                if (data && data.report_import_export) {
                    importExportData = data.report_import_export;
                    importExportType = selectedType;
                    renderRadarChart();
                    if (radarEl) {
                        radarEl.style.opacity = '1';
                        radarEl.style.pointerEvents = 'auto';
                    }
                } else {
                    throw new Error('Invalid data received');
                }
            })
            .catch(function(error) {
                console.error('Error:', error);
                // در صورت خطا، صفحه را reload کنیم
                if (radarEl) {
                    radarEl.style.opacity = '1';
                    radarEl.style.pointerEvents = 'auto';
                }
                window.location.href = '{{ route("dashbord") }}?import_export_type=' + selectedType;
            });
        });
    }

    if (typeof feather !== 'undefined') feather.replace();
});
</script>
@endsection
