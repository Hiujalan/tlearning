<!DOCTYPE html>
<html>

<head>
    <title>Data Soal</title>
    <style>
        /* Atur tampilan PDF sesuai kebutuhan */
        body {
            font-family: Arial, sans-serif;
        }

        table {
            border-collapse: collapse;
        }

        table th,
        table td {
            border: 1px solid black;
            padding: 8px;
        }
    </style>
</head>

<body>
    <h1>Data Nilai Soal</h1>

    <table>
        <thead>
            <tr>
                <th>#</th>
                <th>Nama</th>
                <th>Jumlah Soal</th>
                <th>Penyelesaian</th>
                <th>Benar</th>
                <th>Salah</th>
                <th>Skor</th>
                <th>Pembelajaran</th>
            </tr>
        </thead>
        <tbody>
            <?php $i=1; ?>
            <?php foreach ($data as $row) { ?>
                <tr>
                    <td><?= $i++; ?></td>
                    <td><?= $row['nama']; ?></td>
                    <td><?= $row['jumlah_soal']; ?></td>
                    <td><?= $row['penyelesaian']; ?></td>
                    <td><?= $row['benar']; ?></td>
                    <td><?= $row['salah']; ?></td>
                    <td><?= $row['skor']; ?></td>
                    <td><?= $row['pembelajaran']; ?></td>
                </tr>
            <?php } ?>
        </tbody>
    </table>
</body>

</html>