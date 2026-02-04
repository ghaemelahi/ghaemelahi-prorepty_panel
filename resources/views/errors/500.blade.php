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

        /* استایل ساعت شنی */
        .hourglass-wrap {
            display: flex;
            align-items: center;
            justify-content: center;
            margin: 1.3rem 0 1.6rem;
        }

        .hourglass {
            --size: 180px;
            width: calc(var(--size));
            height: calc(var(--size) * 1.6);
            position: relative;
        }

        .bulb {
            position: absolute;
            left: 50%;
            transform: translateX(-50%);
            width: 68%;
            background: #fff;
            border: 4px solid rgba(28, 109, 208, 0.08);
            overflow: hidden;
        }

        .bulb.top {
            top: 0;
            height: 48%;
            border-bottom-left-radius: 60% 40%;
            border-bottom-right-radius: 60% 40%;
        }

        .bulb.bottom {
            bottom: 0;
            height: 48%;
            border-top-left-radius: 60% 40%;
            border-top-right-radius: 60% 40%;
        }

        .sand-top {
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            height: 60%;
            background: linear-gradient(180deg, rgba(255, 122, 0, 0.95), rgba(255, 145, 56, 0.95));
            animation: topDrain 4s linear infinite;
        }

        .sand-bottom {
            position: absolute;
            bottom: 0;
            left: 0;
            right: 0;
            height: 0%;
            background: linear-gradient(180deg, rgba(255, 145, 56, 0.95), rgba(255, 122, 0, 0.95));
            animation: bottomFill 4s linear infinite;
        }

        .sand-stream {
            position: absolute;
            left: 50%;
            transform: translateX(-50%);
            top: 45%;
            width: 6px;
            height: 0;
            background: rgba(255, 122, 0, 0.95);
            animation: streamDrop 1s linear infinite;
        }

        @keyframes topDrain {
            0% {
                height: 60%
            }

            100% {
                height: 8%
            }
        }

        @keyframes bottomFill {
            0% {
                height: 0%
            }

            100% {
                height: 52%
            }
        }

        @keyframes streamDrop {
            0% {
                height: 0;
                opacity: 0
            }

            30% {
                height: 40px;
                opacity: 1
            }

            100% {
                height: 0;
                opacity: 0
            }
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

            <!-- ساعت شنی -->
            <div class="hourglass-wrap">
                <div class="hourglass">
                    <div class="bulb top">
                        <div class="sand-top"></div>
                    </div>
                    <div class="sand-stream"></div>
                    <div class="bulb bottom">
                        <div class="sand-bottom"></div>
                    </div>
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
