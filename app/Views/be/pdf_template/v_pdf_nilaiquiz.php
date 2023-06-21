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
                <th>Soal ID</th>
                <th>Jawaban 1</th>
                <th>Jawaban 2</th>
                <th>Jawaban</th>
                <th>Pembelajaran</th>
            </tr>
        </thead>
        <tbody>
            <?php $i = 1; ?>
            <?php foreach ($data as $row) { ?>
                <tr>
                    <td><?= $i++; ?></td>
                    <td><?= $row['nama']; ?></td>
                    <td><?= $row['soal_id']; ?></td>
                    <td><?= $row['jawaban1']; ?></td>
                    <td><?= $row['jawaban2']; ?></td>
                    <td><?= $row['jawaban']; ?></td>
                    <td><?= $row['pembelajaran']; ?></td>
                </tr>
            <?php } ?>
        </tbody>
    </table>
</body>

</html>