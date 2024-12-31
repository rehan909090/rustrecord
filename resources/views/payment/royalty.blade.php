<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pembayaran Royalti</title>
</head>
<body>
    <h1>Pembayaran Royalti untuk {{ $artist->name }}</h1>
    <p>Royalti yang harus dibayarkan: Rp{{ number_format($artist->royalty_balance, 0, ',', '.') }}</p>

    <form action="{{ route('royalty.payment.process', $artist->id) }}" method="POST">
        @csrf
        <label for="first_name">Nama Depan:</label>
        <input type="text" name="first_name" id="first_name" required><br>

        <label for="last_name">Nama Belakang:</label>
        <input type="text" name="last_name" id="last_name" required><br>

        <label for="email">Email:</label>
        <input type="email" name="email" id="email" required><br>

        <label for="phone">Nomor Telepon:</label>
        <input type="text" name="phone" id="phone" required><br>

        <button type="submit">Bayar Royalti</button>
    </form>
</body>
</html>
