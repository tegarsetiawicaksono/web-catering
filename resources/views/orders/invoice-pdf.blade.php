<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <title>Invoice #{{ $order->id }}</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            line-height: 1.6;
            color: #333;
            margin: 0;
            padding: 0;
        }

        .container {
            max-width: 800px;
            margin: 0 auto;
            padding: 40px;
        }

        .header {
            text-align: center;
            margin-bottom: 40px;
            padding-bottom: 20px;
            border-bottom: 3px solid #FB923C;
            position: relative;
        }

        .header h1 {
            color: #FB923C;
            margin: 0;
            font-size: 32px;
            text-transform: uppercase;
        }

        .header p {
            color: #666;
            margin: 10px 0 0;
            font-size: 16px;
        }

        .company-info {
            text-align: center;
            margin-bottom: 20px;
            font-size: 14px;
            color: #666;
        }

        .invoice-title {
            background: #FB923C;
            color: white;
            padding: 10px 20px;
            display: inline-block;
            border-radius: 4px;
            margin-bottom: 30px;
        }

        .info-grid {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 40px;
            margin-bottom: 40px;
        }

        .info-section {
            background: #f8f9fa;
            padding: 20px;
            border-radius: 8px;
        }

        .info-section h3 {
            color: #FB923C;
            margin-top: 0;
            margin-bottom: 15px;
            font-size: 18px;
        }

        .info-section p {
            margin: 8px 0;
            color: #444;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 30px;
            background: white;
            border-radius: 8px;
            overflow: hidden;
        }

        th {
            background-color: #f3f4f6;
            font-weight: 600;
            color: #FB923C;
            text-transform: uppercase;
            font-size: 14px;
            padding: 12px;
        }

        td {
            padding: 12px;
            border-bottom: 1px solid #eee;
        }

        tr:last-child td {
            border-bottom: none;
        }

        .total-section {
            background: #f8f9fa;
            padding: 20px;
            border-radius: 8px;
            margin-top: 30px;
        }

        .total {
            text-align: right;
            font-size: 24px;
            color: #FB923C;
            font-weight: bold;
        }

        .footer {
            margin-top: 50px;
            padding-top: 20px;
            border-top: 2px solid #eee;
            text-align: center;
            color: #666;
            font-size: 14px;
        }

        .qr-section {
            text-align: center;
            margin-top: 30px;
        }

        .payment-info {
            background: #fff3e0;
            border: 2px solid #FB923C;
            padding: 15px;
            border-radius: 8px;
            margin-top: 30px;
        }

        .payment-info h3 {
            color: #FB923C;
            margin: 0 0 10px 0;
        }

        .payment-proof-section {
            background: #f0f9ff;
            border: 2px solid #3b82f6;
            padding: 20px;
            border-radius: 8px;
            margin-top: 30px;
            page-break-inside: avoid;
        }

        .payment-proof-section h3 {
            color: #3b82f6;
            margin: 0 0 15px 0;
        }

        .payment-proof-grid {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 20px;
            margin-top: 15px;
        }

        .payment-proof-details {
            font-size: 13px;
        }

        .payment-proof-details p {
            margin: 5px 0;
        }

        .payment-proof-image {
            text-align: center;
        }

        .payment-proof-image img {
            max-width: 100%;
            height: auto;
            border: 2px solid #ddd;
            border-radius: 8px;
            max-height: 400px;
        }

        .status-paid {
            position: absolute;
            top: 0;
            right: 0;
            background: #4CAF50;
            color: white;
            padding: 5px 15px;
            border-radius: 4px;
            transform: rotate(15deg);
        }
    </style>
</head>

<body>
    <div class="container">
        <div class="header">
            <h1>Rejosari Catering</h1>
            <p class="company-info">
                Jl. Niaga, Kedonsari, Penyangkringan, Kec. Weleri, Kabupaten Kendal, Jawa Tengah 51355<br>
                Telp: 0822-2711-0771 | Email: rejosaricatering.rs@gmail.com
            </p>
            @if($order->status === 'completed')
            <div class="status-paid">LUNAS</div>
            @endif
        </div>

        <div class="invoice-title">
            INVOICE #{{ str_pad($order->id, 5, '0', STR_PAD_LEFT) }}
        </div>

        <div class="info-grid">
            <div class="info-section">
                <h3>Informasi Pelanggan</h3>
                <p><strong>Nama:</strong> {{ $order->customer_name }}</p>
                <p><strong>Email:</strong> {{ $order->email }}</p>
                <p><strong>No. Telepon:</strong> {{ $order->phone }}</p>
                <p><strong>Alamat:</strong> <br>
                    {{ $order->street_address }}<br>
                    Kec. {{ $order->district }}<br>
                    {{ $order->city }}<br>
                    {{ $order->province }}
                </p>
            </div>

            <div class="info-section">
                <h3>Informasi Acara</h3>
                <p><strong>Tanggal Acara:</strong> {{ \Carbon\Carbon::parse($order->event_date)->translatedFormat('l, d F Y') }}</p>
                <p><strong>Waktu Acara:</strong> {{ \Carbon\Carbon::parse($order->event_time)->format('H:i') }} WIB</p>
                <p><strong>Status:</strong> {{ ucfirst($order->status) }}</p>
                <p><strong>Order Dibuat:</strong> {{ $order->created_at->translatedFormat('l, d F Y - H:i') }} WIB</p>
            </div>
        </div>

        <div class="order-details">
            <table>
                <thead>
                    <tr>
                        <th style="width: 40%">Item</th>
                        <th style="width: 20%">Jumlah</th>
                        <th style="width: 20%">Harga</th>
                        <th style="width: 20%">Total</th>
                    </tr>
                </thead>
                <tbody>
                    @if($order->items)
                    @foreach($order->items as $item)
                    <tr>
                        <td>{{ $item['name'] }}</td>
                        <td>{{ $item['quantity'] }} pax</td>
                        <td>Rp {{ number_format($item['price'], 0, ',', '.') }}</td>
                        <td>Rp {{ number_format($item['price'] * $item['quantity'], 0, ',', '.') }}</td>
                    </tr>
                    @endforeach
                    @else
                    <tr>
                        <td>{{ $order->package_name }}</td>
                        <td>{{ $order->quantity }} porsi</td>
                        <td>Rp {{ number_format($order->package_price, 0, ',', '.') }}</td>
                        <td>Rp {{ number_format($order->total_price, 0, ',', '.') }}</td>
                    </tr>
                    @endif
                </tbody>
            </table>

            <div class="total-section">
                <div class="total">
                    Total Pembayaran: Rp {{ number_format($order->total_price, 0, ',', '.') }}
                </div>
            </div>

            <div class="payment-info">
                <h3>Informasi Pembayaran</h3>
                <p><strong>Metode Pembayaran:</strong> {{ $order->payment_method ?? 'Transfer Bank' }}</p>
                @if($order->payment_method && in_array($order->payment_method, ['BCA', 'BNI', 'BRI', 'Mandiri']))
                <p><strong>Bank {{ $order->payment_method }}</strong><br>
                    No. Rekening: 1234567890<br>
                    a.n: PT Rejosari Catering</p>
                @else
                <p><strong>Bank BCA</strong><br>
                    No. Rekening: 1234567890<br>
                    a.n: PT Rejosari Catering</p>
                @endif
            </div>

            @if($order->latestPaymentVerification)
            <div class="payment-proof-section">
                <h3>✓ Bukti Pembayaran</h3>
                <div class="payment-proof-grid">
                    <div class="payment-proof-details">
                        <p><strong>Status:</strong>
                            @if($order->latestPaymentVerification->status === 'verified')
                            <span style="color: #4CAF50;">✓ Terverifikasi</span>
                            @elseif($order->latestPaymentVerification->status === 'pending')
                            <span style="color: #FB923C;">⏳ Menunggu Verifikasi</span>
                            @else
                            <span style="color: #dc2626;">✗ Ditolak</span>
                            @endif
                        </p>
                        <p><strong>Bank Pengirim:</strong> {{ $order->latestPaymentVerification->bank_name }}</p>
                        <p><strong>No. Rekening:</strong> {{ $order->latestPaymentVerification->account_number }}</p>
                        <p><strong>Nama Pengirim:</strong> {{ $order->latestPaymentVerification->account_name }}</p>
                        <p><strong>Jumlah Transfer:</strong> Rp {{ number_format($order->latestPaymentVerification->amount, 0, ',', '.') }}</p>
                        <p><strong>Tanggal Transfer:</strong> {{ $order->latestPaymentVerification->transfer_date->translatedFormat('d F Y, H:i') }} WIB</p>
                        @if($order->latestPaymentVerification->transfer_receipt_number)
                        <p><strong>No. Referensi:</strong> {{ $order->latestPaymentVerification->transfer_receipt_number }}</p>
                        @endif
                    </div>
                    <div class="payment-proof-image">
                        <p style="margin-bottom: 10px; font-size: 12px; color: #666;"><strong>Screenshot Bukti Transfer:</strong></p>
                        <img src="{{ public_path('storage/' . $order->latestPaymentVerification->payment_proof) }}" alt="Bukti Transfer">
                    </div>
                </div>
            </div>
            @endif
        </div>

        <div class="footer">
            <p>Terima kasih atas kepercayaan Anda kepada Rejosari Catering</p>
            <p>Untuk informasi lebih lanjut, silakan hubungi kami di 0822-2711-0771</p>
        </div>
    </div>
    </div>
</body>

</html>