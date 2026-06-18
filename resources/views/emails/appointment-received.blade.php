<!DOCTYPE html>
<html lang="tr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Randevu Talebiniz Alındı</title>
    <style>
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            line-height: 1.6;
            color: #333;
            background-color: #f4f4f4;
            margin: 0;
            padding: 0;
        }
        .container {
            max-width: 600px;
            margin: 30px auto;
            background-color: #ffffff;
            border-radius: 8px;
            overflow: hidden;
            box-shadow: 0 2px 10px rgba(0,0,0,0.1);
        }
        .header {
            background-color: #5c9ead;
            color: #ffffff;
            padding: 30px;
            text-align: center;
        }
        .header h1 {
            margin: 0;
            font-size: 24px;
            font-weight: 600;
        }
        .content {
            padding: 30px;
        }
        .content p {
            margin: 0 0 15px;
        }
        .details-table {
            width: 100%;
            border-collapse: collapse;
            margin: 20px 0;
        }
        .details-table td {
            padding: 12px 15px;
            border-bottom: 1px solid #eee;
        }
        .details-table td:first-child {
            font-weight: 600;
            color: #555;
            width: 40%;
        }
        .status-badge {
            display: inline-block;
            padding: 4px 12px;
            border-radius: 4px;
            font-size: 13px;
            font-weight: 600;
            background-color: #ffeaa7;
            color: #6c5800;
        }
        .footer {
            background-color: #f8f9fa;
            padding: 20px 30px;
            text-align: center;
            font-size: 13px;
            color: #888;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="header">
            <h1>Randevu Talebiniz Alındı</h1>
        </div>
        <div class="content">
            <p>Sayın <strong>{{ $appointment->name }}</strong>,</p>
            <p>Randevu talebiniz başarıyla alınmıştır. En kısa sürede talebiniz değerlendirilecek ve size bilgi verilecektir.</p>

            <table class="details-table">
                <tr>
                    <td>Hizmet</td>
                    <td>{{ $appointment->service?->title ?? '-' }}</td>
                </tr>
                <tr>
                    <td>Tercih Edilen Tarih</td>
                    <td>{{ $appointment->preferred_at->format('d.m.Y H:i') }}</td>
                </tr>
                <tr>
                    <td>Durum</td>
                    <td><span class="status-badge">Beklemede</span></td>
                </tr>
            </table>

            <p>Herhangi bir sorunuz varsa bizimle iletişime geçmekten çekinmeyin.</p>
            <p>Sağlıklı günler dileriz.</p>
        </div>
        <div class="footer">
            <p>Bu e-posta otomatik olarak gönderilmiştir. Lütfen yanıtlamayınız.</p>
        </div>
    </div>
</body>
</html>
