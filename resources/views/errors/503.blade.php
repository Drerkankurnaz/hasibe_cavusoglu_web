<!DOCTYPE html>
<html lang="tr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $title ?? 'Site Bakımda' }} - Psikolog Hasibe Çavuşoğlu</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }
        body {
            font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, sans-serif;
            background: linear-gradient(135deg, #3d3272 0%, #4eaac8 100%);
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 20px;
        }
        .container {
            background: white;
            border-radius: 20px;
            padding: 60px 40px;
            max-width: 550px;
            width: 100%;
            text-align: center;
            box-shadow: 0 25px 60px rgba(0,0,0,0.15);
        }
        .icon {
            font-size: 64px;
            margin-bottom: 24px;
        }
        h1 {
            font-size: 28px;
            color: #3d3272;
            margin-bottom: 20px;
            font-weight: 700;
        }
        .message {
            font-size: 16px;
            color: #555;
            line-height: 1.8;
            margin-bottom: 24px;
        }
        .highlight {
            color: #4eaac8;
            font-weight: 600;
            font-size: 15px;
        }
        .footer-text {
            margin-top: 32px;
            font-size: 14px;
            color: #999;
            border-top: 1px solid #eee;
            padding-top: 20px;
        }
        @media (max-width: 480px) {
            .container {
                padding: 40px 24px;
            }
            h1 {
                font-size: 22px;
            }
            .message {
                font-size: 15px;
            }
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="icon">🔧</div>
        <h1>{{ $title ?? 'Site Bakımda' }}</h1>
        <p class="message">{{ $message ?? 'Sitemizi sizin için daha iyi hale getirmek adına kısa bir bakım çalışması yapıyoruz. Kısa süre içinde tekrar hizmetinizde olacağız.' }}</p>
        <p class="highlight">Anlayışınız için teşekkür ederiz.</p>
        <p class="footer-text">Psikolog Hasibe Çavuşoğlu</p>
    </div>
</body>
</html>
