<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Milestone Coffee - Laporan Data Produk Terjual</title>
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
                <th>Nama Produk</th>
                <th>Quantity</th>
                <th>Price</th>
            </tr>
        </thead>
        <tbody>
            <?php $count = 1; ?>
            <?php foreach ($data as $item) : ?>
                <tr>
                    <td><?= $count++ ?></td>
                    <td><?= $item['name'] ?></td>
                    <td><?= $item['quantity'] ?></td>
                    <td><?= $item['price'] ?></td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</body>

</html>