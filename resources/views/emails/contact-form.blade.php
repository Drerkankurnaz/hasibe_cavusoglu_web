<!DOCTYPE html>
<html lang="tr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Yeni İletişim Mesajı</title>
    <style>
        body {
            font-family: Arial, Helvetica, sans-serif;
            line-height: 1.6;
            color: #333;
            background-color: #f4f4f4;
            margin: 0;
            padding: 0;
        }
        .container {
            max-width: 600px;
            margin: 20px auto;
            background-color: #ffffff;
            border-radius: 4px;
            overflow: hidden;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
        }
        .header {
            background-color: #4a90a4;
            color: #ffffff;
            padding: 20px 30px;
            text-align: center;
        }
        .header h1 {
            margin: 0;
            font-size: 22px;
            font-weight: normal;
        }
        .content {
            padding: 30px;
        }
        .field {
            margin-bottom: 15px;
            border-bottom: 1px solid #eee;
            padding-bottom: 15px;
        }
        .field:last-child {
            border-bottom: none;
            margin-bottom: 0;
            padding-bottom: 0;
        }
        .field-label {
            font-weight: bold;
            color: #555;
            font-size: 13px;
            text-transform: uppercase;
            letter-spacing: 0.5px;
            margin-bottom: 4px;
        }
        .field-value {
            font-size: 15px;
            color: #333;
        }
        .message-content {
            background-color: #f9f9f9;
            padding: 15px;
            border-radius: 4px;
            border-left: 3px solid #4a90a4;
            white-space: pre-wrap;
            word-wrap: break-word;
        }
        .footer {
            background-color: #f9f9f9;
            padding: 15px 30px;
            text-align: center;
            font-size: 12px;
            color: #999;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="header">
            <h1>Yeni İletişim Mesajı</h1>
        </div>

        <div class="content">
            <div class="field">
                <div class="field-label">Ad Soyad</div>
                <div class="field-value">{{ $contactMessage->name }}</div>
            </div>

            <div class="field">
                <div class="field-label">E-posta</div>
                <div class="field-value">
                    <a href="mailto:{{ $contactMessage->email }}">{{ $contactMessage->email }}</a>
                </div>
            </div>

            @if($contactMessage->phone)
            <div class="field">
                <div class="field-label">Telefon</div>
                <div class="field-value">
                    <a href="tel:{{ $contactMessage->phone }}">{{ $contactMessage->phone }}</a>
                </div>
            </div>
            @endif

            @if($contactMessage->subject)
            <div class="field">
                <div class="field-label">Konu</div>
                <div class="field-value">{{ $contactMessage->subject }}</div>
            </div>
            @endif

            <div class="field">
                <div class="field-label">Mesaj</div>
                <div class="message-content">{{ $contactMessage->message }}</div>
            </div>
        </div>

        <div class="footer">
            Bu mesaj {{ config('app.name') }} iletişim formu üzerinden gönderilmiştir.<br>
            Gönderim tarihi: {{ $contactMessage->created_at?->format('d.m.Y H:i') ?? now()->format('d.m.Y H:i') }}
        </div>
    </div>
</body>
</html>
