<!DOCTYPE html>
<html lang="fa" dir="rtl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>کارت ملک — راگه</title>
    {{-- <link href="https://fonts.googleapis.com/css2?family=Vazirmatn:wght@300;400;500;600;700&display=swap" rel="stylesheet"> --}}
    <style>
        :root {
            --primary: #0f3460;
            --primary-light: #1a4a7a;
            --primary-bg: #e8eef5;
            --text: #1a1a2e;
            --text-muted: #6b7280;
            --border: #e5e7eb;
            --white: #ffffff;
            --radius: 12px;
            --radius-sm: 8px;
            --shadow: 0 2px 8px rgba(15, 52, 96, 0.06);
            --shadow-lg: 0 8px 24px rgba(15, 52, 96, 0.08);
        }
        * { box-sizing: border-box; margin: 0; padding: 0; }
        body {
            font-family: 'Vazirmatn', Tahoma, sans-serif;
            direction: rtl;
            text-align: right;
            color: var(--text);
            max-width: 210mm;
            margin: 0 auto;
            padding: 24px;
            background: #f8fafc;
            line-height: 1.6;
        }
        .no-print {
            margin-bottom: 24px;
            display: flex;
            justify-content: flex-end;
        }
        .btn-pdf {
            font-family: inherit;
            padding: 14px 28px;
            font-size: 15px;
            font-weight: 600;
            background: linear-gradient(135deg, var(--primary) 0%, var(--primary-light) 100%);
            color: var(--white);
            border: none;
            border-radius: var(--radius);
            cursor: pointer;
            box-shadow: var(--shadow);
            transition: transform 0.15s, box-shadow 0.15s;
        }
        .btn-pdf:hover {
            transform: translateY(-1px);
            box-shadow: 0 4px 14px rgba(15, 52, 96, 0.25);
        }

        /* ========== هدر سربرگ ========== */
        .header {
            background: linear-gradient(135deg, #0f3460 0%, #16213e 50%, #1a1a2e 100%);
            border-radius: var(--radius);
            padding: 24px 28px;
            margin-bottom: 24px;
            display: flex;
            align-items: center;
            justify-content: space-between;
            flex-wrap: wrap;
            gap: 16px;
            color: var(--white);
            box-shadow: var(--shadow-lg);
            position: relative;
            overflow: hidden;
        }
        .header::before {
            content: '';
            position: absolute;
            top: 0;
            right: 0;
            width: 40%;
            height: 100%;
            background: linear-gradient(90deg, transparent, rgba(255,255,255,0.03));
            pointer-events: none;
        }
        .header-right {
            display: flex;
            align-items: center;
            gap: 20px;
        }
        .logo-box {
            width: 64px;
            height: 64px;
            border-radius: var(--radius-sm);
            background: rgba(255,255,255,0.12);
            display: flex;
            align-items: center;
            justify-content: center;
            flex-shrink: 0;
            overflow: hidden;
        }
        .logo-box img {
            width: 100%;
            height: 100%;
            object-fit: contain;
        }
        .logo-placeholder {
            font-size: 28px;
            font-weight: 700;
            color: rgba(255,255,255,0.95);
        }
        .brand-wrap {}
        .brand {
            font-size: 26px;
            font-weight: 700;
            letter-spacing: 0.5px;
            margin-bottom: 2px;
        }
        .brand-sub {
            font-size: 13px;
            font-weight: 400;
            opacity: 0.9;
            color: rgba(255,255,255,0.9);
        }
        .header-left {
            text-align: left;
        }
        .doc-date {
            font-size: 13px;
            font-weight: 500;
            color: rgba(255,255,255,0.95);
        }
        .doc-date span { opacity: 0.85; font-weight: 400; }

        /* ========== کارت‌ها ========== */
        .card {
            background: var(--white);
            border-radius: var(--radius);
            padding: 20px 24px;
            margin-bottom: 20px;
            box-shadow: var(--shadow);
            border: 1px solid var(--border);
        }
        .section-title {
            font-size: 15px;
            font-weight: 700;
            color: var(--primary);
            margin-bottom: 14px;
            padding-right: 12px;
            border-right: 4px solid var(--primary);
        }
        .info-grid {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 16px 24px;
        }
        .info-item {}
        .label {
            font-size: 11px;
            font-weight: 600;
            color: var(--text-muted);
            text-transform: uppercase;
            letter-spacing: 0.3px;
            margin-bottom: 4px;
        }
        .value {
            font-size: 14px;
            font-weight: 600;
            color: var(--text);
        }
        .price {
            font-size: 18px;
            font-weight: 700;
            color: var(--primary);
        }

        /* ========== گالری تصاویر ========== */
        .gallery {
            display: grid;
            grid-template-columns: repeat(5, 1fr);
            gap: 10px;
        }
        .gallery-item {
            aspect-ratio: 4/3;
            border-radius: var(--radius-sm);
            overflow: hidden;
            background: var(--primary-bg);
            border: 1px solid var(--border);
        }
        .gallery-item img {
            width: 100%;
            height: 100%;
            object-fit: cover;
        }

        /* ========== امکانات ========== */
        .amenities {
            display: flex;
            flex-wrap: wrap;
            gap: 8px;
        }
        .amenity-box {
            display: inline-block;
            padding: 6px 14px;
            background: var(--primary-bg);
            color: var(--primary);
            border-radius: 20px;
            font-size: 13px;
            font-weight: 600;
        }

        @media print {
            body { background: #fff; padding: 16px; }
            .no-print { display: none !important; }
            .card { box-shadow: none; border: 1px solid var(--border); }
            .header { box-shadow: none; }
        }
    </style>
</head>
<body>

    <div class="no-print">
        <button type="button" class="btn-pdf" id="btnSavePdf">ذخیره به صورت PDF</button>
    </div>

    {{-- سربرگ --}}
    <header class="header">
        <div class="header-right">
            <div class="logo-box">
                @if (!empty($logo_url))
                    <img src="{{ $logo_url }}" alt="لوگو">
                @else
                    <span class="logo-placeholder">ر</span>
                @endif
            </div>
            <div class="brand-wrap">
                <div class="brand">راگه</div>
                <div class="brand-sub">دفتر املاک</div>
            </div>
        </div>
        <div class="header-left">
            <div class="doc-date"><span>تاریخ:</span> {{ $date ?? '' }}</div>
        </div>
    </header>

    @if (!empty($images) && count($images) > 0)
        <div class="card">
            <div class="section-title">تصاویر</div>
            <div class="gallery">
                @foreach ($images->take(5) as $img)
                    <div class="gallery-item">
                        @if (!empty($img->data_uri))
                            <img src="{{ $img->data_uri }}" alt="">
                        @endif
                    </div>
                @endforeach
            </div>
        </div>
    @endif

    @php $r = $item ?? null; @endphp
    @if ($r)

        <div class="card">
            <div class="section-title">فروشنده</div>
            <div class="info-grid">
                <div class="info-item">
                    <div class="label">نام فروشنده</div>
                    <div class="value">{{ $r->seller_name ?? '—' }}</div>
                </div>
                <div class="info-item">
                    <div class="label">شماره تماس</div>
                    <div class="value">{{ $r->seller_phone ?? '—' }}</div>
                </div>
            </div>
        </div>

        <div class="card">
            <div class="section-title">مشخصات ملک</div>
            <div class="info-grid">
                <div class="info-item">
                    <div class="label">نوع درخواست</div>
                    <div class="value">{{ ($r->request_type ?? '') == 'sell' ? 'فروش' : 'اجاره' }}</div>
                </div>
                <div class="info-item">
                    <div class="label">نوع ملک</div>
                    <div class="value">
                        @if ($r->reoperty_type == 'tejari') تجاری
                        @elseif($r->reoperty_type == 'maskoni') مسکونی
                        @elseif($r->reoperty_type == 'earth_maskoni') زمین مسکونی
                        @elseif($r->reoperty_type == 'earth_tejari') زمین تجاری
                        @else {{ $r->reoperty_type ?? '—' }}
                        @endif
                    </div>
                </div>
                <div class="info-item">
                    <div class="label">ابعاد</div>
                    <div class="value">{{ $r->dimensions_building ?? '—' }}</div>
                </div>
                <div class="info-item">
                    <div class="label">سال ساخت</div>
                    <div class="value">{{ $r->year_manufacture ?? '—' }}</div>
                </div>
                <div class="info-item">
                    <div class="label">نوع سند</div>
                    <div class="value">{{ $r->document_type ?? '—' }}</div>
                </div>
                <div class="info-item">
                    <div class="label">تعداد خواب</div>
                    <div class="value">{{ $r->number_bedrooms ?? '—' }}</div>
                </div>
                <div class="info-item" style="grid-column: 1 / -1;">
                    <div class="label">قیمت</div>
                    <div class="price">
                        @if (isset($r->price))
                            {{ number_format((int) $r->price) }} تومان
                        @else
                            —
                        @endif
                    </div>
                </div>
            </div>
        </div>

        <div class="card">
            <div class="section-title">امکانات</div>
            @if (!empty($r->water) || !empty($r->electric) || !empty($r->gas) || !empty($r->telephone))
                <div class="amenities">
                    @if (!empty($r->water))<span class="amenity-box">آب</span>@endif
                    @if (!empty($r->electric))<span class="amenity-box">برق</span>@endif
                    @if (!empty($r->gas))<span class="amenity-box">گاز</span>@endif
                    @if (!empty($r->telephone))<span class="amenity-box">تلفن</span>@endif
                </div>
            @else
                <span class="value">—</span>
            @endif
        </div>

    @endif

    <script>
        (function() {
            var btn = document.getElementById('btnSavePdf');
            if (btn) btn.onclick = function() { window.print(); };
        })();
    </script>
</body>
</html>
