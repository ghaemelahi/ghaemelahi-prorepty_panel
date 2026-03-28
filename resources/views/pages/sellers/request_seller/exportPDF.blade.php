<!DOCTYPE html>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />

<head>
    <meta charset="UTF-8">
    <title>کارت ملک</title>

    <style>
        @page {
            margin: 20px;
        }

        /* فونت داخلی DomPDF؛ فارسی را درست نمایش می‌دهد و نیازی به لود فایل ندارد */
        body {
            font-family: DejaVu Sans, sans-serif;
            direction: rtl;
            text-align: right;
        }

        * {
            direction: rtl;
            unicode-bidi: embed;
        }

        .header-table {
            width: 100%;
            border-bottom: 2px solid #0f3460;
            padding-bottom: 10px;
            margin-bottom: 20px;
        }

        .brand {
            font-size: 20px;
            font-weight: bold;
        }

        .sub {
            font-size: 12px;
            color: #555;
        }

        .date {
            font-size: 12px;
            text-align: left;
        }

        .section-title {
            font-weight: bold;
            font-size: 14px;
            margin-top: 20px;
            margin-bottom: 8px;
            border-right: 4px solid #0f3460;
            padding-right: 6px;
        }

        table.info {
            width: 100%;
            border-collapse: collapse;
        }

        table.info td {
            padding: 6px 4px;
            vertical-align: top;
        }

        .label {
            font-size: 11px;
            color: #777;
        }

        .value {
            font-weight: bold;
            font-size: 13px;
        }

        .price {
            font-size: 15px;
            font-weight: bold;
            color: #0f3460;
        }

        .images-table {
            width: 100%;
            margin-top: 10px;
        }

        .images-table td {
            width: 20%;
            padding: 5px;
        }

        .images-table img {
            width: 100%;
            height: 100px;
            object-fit: cover;
            border: 1px solid #ccc;
        }

        .amenity-box {
            display: inline-block;
            border: 1px solid #0f3460;
            padding: 3px 8px;
            margin: 3px;
            font-size: 12px;
        }
    </style>
</head>

<body>
    @php
        /** معکوس کردن متن فارسی برای نمایش درست در DomPDF (رفع مشکل ترتیب حروف) */
        $rtl = function ($s) {
            if ($s === null) {
                return '—';
            }
            if ((string) $s === '') {
                return '';
            }
            $chars = preg_split('//u', (string) $s, -1, PREG_SPLIT_NO_EMPTY);
            return implode('', array_reverse($chars));
        };
    @endphp

    {{-- HEADER --}}
    <table class="header-table">
        <tr>
            <td>
                <div class="brand">{{ $rtl('راگه') }}</div>
                <div class="sub">{{ $rtl('دفتر املاک') }}</div>
            </td>
            <td class="date">
                {{ $rtl('تاریخ') }}: {{ $date ?? '' }}
            </td>
        </tr>
    </table>

    {{-- IMAGES --}}
    @if (!empty($images) && count($images) > 0)
        <div class="section-title">{{ $rtl('تصاویر') }}</div>

        <table class="images-table">
            <tr>
                @foreach ($images->take(5) as $img)
                    <td>
                        @if (!empty($img->data_uri))
                            <img src="{{ $img->data_uri }}">
                        @endif
                    </td>
                @endforeach
            </tr>
        </table>
    @endif

    @php $r = $item ?? null; @endphp

    @if ($r)

        {{-- SELLER --}}
        <div class="section-title">{{ $rtl('فروشنده') }}</div>
        <table class="info">
            <tr>
                <td>
                    <div class="label">{{ $rtl('نام فروشنده') }}</div>
                    <div class="value">{{ $rtl($r->seller_name ?? '—') }}</div>
                </td>
                <td>
                    <div class="label">{{ $rtl('شماره تماس') }}</div>
                    <div class="value">{{ $r->seller_phone ?? '—' }}</div>
                </td>
            </tr>
        </table>

        {{-- PROPERTY --}}
        <div class="section-title">{{ $rtl('مشخصات ملک') }}</div>
        <table class="info">
            <tr>
                <td>
                    <div class="label">{{ $rtl('نوع درخواست') }}</div>
                    <div class="value">
                        {{ $rtl(($r->request_type ?? '') == 'sell' ? 'فروش' : 'اجاره') }}
                    </div>
                </td>
                <td>
                    <div class="label">{{ $rtl('نوع ملک') }}</div>
                    <div class="value">
                        @if ($r->reoperty_type == 'tejari')
                            {{ $rtl('تجاری') }}
                        @elseif($r->reoperty_type == 'maskoni')
                            {{ $rtl('مسکونی') }}
                        @elseif($r->reoperty_type == 'earth_maskoni')
                            {{ $rtl('زمین مسکونی') }}
                        @elseif($r->reoperty_type == 'earth_tejari')
                            {{ $rtl('زمین تجاری') }}
                        @else
                            {{ $rtl($r->reoperty_type ?? '—') }}
                        @endif
                    </div>
                </td>
            </tr>

            <tr>
                <td>
                    <div class="label">{{ $rtl('ابعاد') }}</div>
                    <div class="value">{{ $r->dimensions_building ?? '—' }}</div>
                </td>
                <td>
                    <div class="label">{{ $rtl('سال ساخت') }}</div>
                    <div class="value">{{ $r->year_manufacture ?? '—' }}</div>
                </td>
            </tr>

            <tr>
                <td>
                    <div class="label">{{ $rtl('نوع سند') }}</div>
                    <div class="value">{{ $rtl($r->document_type ?? '—') }}</div>
                </td>
                <td>
                    <div class="label">{{ $rtl('تعداد خواب') }}</div>
                    <div class="value">{{ $r->number_bedrooms ?? '—' }}</div>
                </td>
            </tr>

            <tr>
                <td colspan="2">
                    <div class="label">{{ $rtl('قیمت') }}</div>
                    <div class="price">
                        @if (isset($r->price))
                            {{ number_format((int) $r->price) }} {{ $rtl('تومان') }}
                        @else
                            —
                        @endif
                    </div>
                </td>
            </tr>
        </table>

        {{-- AMENITIES --}}
        <div class="section-title">{{ $rtl('امکانات') }}</div>

        @if (!empty($r->water) || !empty($r->electric) || !empty($r->gas) || !empty($r->telephone))
            @if (!empty($r->water))
                <span class="amenity-box">{{ $rtl('آب') }}</span>
            @endif
            @if (!empty($r->electric))
                <span class="amenity-box">{{ $rtl('برق') }}</span>
            @endif
            @if (!empty($r->gas))
                <span class="amenity-box">{{ $rtl('گاز') }}</span>
            @endif
            @if (!empty($r->telephone))
                <span class="amenity-box">{{ $rtl('تلفن') }}</span>
            @endif
        @else
            —
        @endif

    @endif

</body>

</html>
