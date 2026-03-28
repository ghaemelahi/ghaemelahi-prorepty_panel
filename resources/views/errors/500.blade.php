<!DOCTYPE html>
<html lang="fa" dir="rtl">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width,initial-scale=1">
    <title>خطا ۵۰۰ — خطای سرور</title>

    <!-- Bootstrap 4 -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">

    <!-- فونت فارسی -->
    <link href="https://fonts.googleapis.com/css2?family=Vazirmatn:wght@300;400;600;700&display=swap" rel="stylesheet">

    <style>
        :root {
            --bg: #ffffff;
            --primary-blue: #1c6dd0;
            /* آبی */
            --accent-orange: #ff7a00;
            /* نارنجی */
            --muted: #6b7280;
        }

        html,
        body {
            height: 100%;
            background: var(--bg);
            font-family: 'Vazirmatn', Tahoma, sans-serif;
            direction: rtl;
            text-align: right;
            color: #111827;
        }

        .page-wrap {
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 2rem;
        }

        .card-centered {
            width: 100%;
            max-width: 760px;
            border: 0;
            border-radius: 16px;
            box-shadow: 0 10px 30px rgba(28, 109, 208, 0.08);
            padding: 2.2rem;
            background: linear-gradient(180deg, rgba(255, 255, 255, 1) 0%, rgba(250, 250, 254, 1) 100%);
            text-align: center;
        }

        /* هدر خطا */
        .error-badge {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            gap: .7rem;
            margin-bottom: 1rem;
        }

        .error-circle {
            width: 64px;
            height: 64px;
            border-radius: 50%;
            background: linear-gradient(135deg, rgba(28, 109, 208, 0.12), rgba(255, 122, 0, 0.08));
            display: flex;
            align-items: center;
            justify-content: center;
            border: 1px solid rgba(28, 109, 208, 0.06);
        }

        .error-num {
            font-weight: 700;
            color: var(--primary-blue);
            font-size: 1.25rem;
        }

        .error-title {
            font-size: 1.25rem;
            font-weight: 700;
            color: var(--accent-orange);
        }

        .subtext {
            color: var(--muted);
            margin-bottom: 1.6rem;
        }

        /* انیمیشن خطای ۵۰۰ — نماد خرابی سرور */
        .error-animation-wrap {
            display: flex;
            align-items: center;
            justify-content: center;
            margin: 1.3rem 0 1.6rem;
        }

        .error-500-icon {
            width: 140px;
            height: 140px;
            position: relative;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        /* دایرهٔ پشت با پالس (خطای سرور) */
        .error-500-icon .ring {
            position: absolute;
            inset: 0;
            border-radius: 50%;
            border: 5px solid rgba(220, 53, 69, 0.25);
            animation: errorPulse 2s ease-in-out infinite;
        }

        .error-500-icon .ring::before {
            content: '';
            position: absolute;
            inset: -5px;
            border-radius: 50%;
            border: 3px solid transparent;
            border-top-color: #dc3545;
            border-right-color: #dc3545;
            animation: ringSpin 3s linear infinite;
        }

        /* مثلث هشدار + علامت تعجب */
        .error-500-icon .triangle {
            position: relative;
            width: 0;
            height: 0;
            border-left: 42px solid transparent;
            border-right: 42px solid transparent;
            border-bottom: 72px solid #ff7a00;
            filter: drop-shadow(0 4px 12px rgba(255, 122, 0, 0.35));
            animation: iconWobble 2s ease-in-out infinite;
        }

        .error-500-icon .triangle::after {
            content: '!';
            position: absolute;
            top: 28px;
            left: 50%;
            transform: translateX(-50%);
            font-size: 36px;
            font-weight: 800;
            color: #fff;
            font-family: 'Vazirmatn', Tahoma, sans-serif;
            animation: exclamationBlink 1.5s ease-in-out infinite;
        }

        @keyframes errorPulse {
            0%, 100% { transform: scale(1); opacity: 0.6; }
            50%      { transform: scale(1.05); opacity: 1; }
        }

        @keyframes ringSpin {
            0%   { transform: rotate(0deg); }
            100% { transform: rotate(360deg); }
        }

        @keyframes iconWobble {
            0%, 100% { transform: rotate(0deg) scale(1); }
            25%      { transform: rotate(-3deg) scale(1.02); }
            75%      { transform: rotate(3deg) scale(1.02); }
        }

        @keyframes exclamationBlink {
            0%, 100% { opacity: 1; }
            50%      { opacity: 0.7; }
        }

        .small-note {
            margin-top: .8rem;
            color: var(--muted);
        }

        .action-buttons {
            margin-top: 2rem;
            display: flex;
            gap: 1rem;
            justify-content: center;
            flex-wrap: wrap;
        }
    </style>
</head>

<body>
    <div class="page-wrap">
        <div class="card-centered text-center">
            <div class="error-badge">
                <div class="error-circle">
                    <div class="error-num">۵۰۰</div>
                </div>
                <div>
                    <div class="error-title">خطای سرور</div>
                    <div class="subtext">متأسفانه مشکلی در سرور رخ داده است</div>
                </div>
            </div>

            <!-- انیمیشن خطای ۵۰۰ -->
            <div class="error-animation-wrap">
                <div class="error-500-icon">
                    <div class="ring"></div>
                    <div class="triangle"></div>
                </div>
            </div>

            <div class="small-note">
                لطفاً چند لحظه صبر کنید و دوباره تلاش کنید. اگر مشکل ادامه داشت، با پشتیبانی تماس بگیرید.
            </div>

            <div class="action-buttons">
                <button onclick="window.location.reload()" class="btn btn-primary">تلاش مجدد</button>
                <a href="/" class="btn btn-outline-primary">بازگشت به صفحه اصلی</a>
            </div>
        </div>
    </div>
</body>

</html>
