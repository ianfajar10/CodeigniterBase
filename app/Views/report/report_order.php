<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Milestone Coffee - Laporan Data Pemesanan</title>
    <style>
        body {
            font-family: Arial, sans-serif;
        }

        table {
            width: 100%;
            border-collapse: collapse;
        }

        th,
        td {
            border: 1px solid #ddd;
            padding: 8px;
            text-align: left;
        }

        th {
            background-color: #f2f2f2;
        }
    </style>
</head>

<body>
    <h1><?= $title ?></h1>
    <table>
        <thead>
            <tr>
                <th>No</th>
                <th>No Pesanan</th>
                <th>User ID</th>
                <th>Meja</th>
                <th>Status</th>
                <th>Total Amount</th>
            </tr>
        </thead>
        <tbody>
            <?php $count = 1; ?>
            <?php foreach ($data as $order) : ?>
                <tr>
                    <td><?= $count++ ?></td>
                    <td><?= $order['no_pesanan'] ?></td>
                    <td><?= $order['user_id'] ?></td>
                    <td><?= $order['table'] ?></td>
                    <td><?= $order['status'] ?></td>
                    <td><?= $order['total_amount'] ?></td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</body>

</html>