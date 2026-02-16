<!DOCTYPE html>
<html>
<head>
    <title>Respon Kuesioner Baru</title>
</head>
<body style="font-family: Arial, sans-serif; line-height: 1.6; color: #333;">
    <h2 style="color: #d63384;">Respon Kuesioner Baru Diterima!</h2>
    <p>Halo Hamdani,</p>
    <p>Ada responden baru yang telah menyelesaikan kuesioner.</p>
    
    <h3>Data Responden:</h3>
    <ul>
        <li><strong>Nama:</strong> {{ $data['nama'] ?? '-' }}</li>
        <li><strong>No. WhatsApp:</strong> {{ $data['nowa'] ?? '-' }}</li>
        <li><strong>Waktu Submit:</strong> {{ $data['timestamp'] ?? now()->format('Y-m-d H:i:s') }}</li>
    </ul>

    <h3>Jawaban Kuesioner:</h3>
    <table border="1" cellpadding="5" cellspacing="0" style="border-collapse: collapse; width: 100%; max-width: 600px;">
        <thead>
            <tr style="background-color: #f2f2f2;">
                <th>No</th>
                <th>Kombinasi</th>
                <th>Jawaban</th>
            </tr>
        </thead>
        <tbody>
            @for($i = 1; $i <= 10; $i++)
                <tr>
                    <td style="text-align: center;">{{ $i }}</td>
                    <td>Kombinasi {{ $i }}</td>
                    <td style="text-align: center;">
                        @if(isset($data["kom_$i"]) && $data["kom_$i"] == 1)
                            <span style="color: green; font-weight: bold;">Cocok</span>
                        @else
                            <span style="color: red;">Tidak Cocok</span>
                        @endif
                    </td>
                </tr>
            @endfor
        </tbody>
    </table>

    <p style="margin-top: 20px;">
        <em>Email ini dikirim otomatis oleh sistem Kuesioner Kecocokan Warna.</em>
    </p>
</body>
</html>
