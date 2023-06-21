<!DOCTYPE html>
<html>

<head>
    <title>Data Soal</title>
    <style>
        body {
            font-family: Arial, sans-serif;
        }

        .question {
            margin-bottom: 20px;
        }

        .question-title {
            font-weight: bold;
        }

        .options {
            margin-top: 10px;
        }

        .option {
            margin-bottom: 5px;
        }
    </style>
</head>

<body>

    <?php foreach ($data as $row) { ?>
        <div class="question">
            <div class="question-title"><?= $row['soal_id']; ?>. <?= $row['soal']; ?>? ... Dan ... </div>
            <div class="options">
                <div class="option">
                    <label for="">A.</label>
                    <label for="answer1"><?= $row['opsi1']; ?></label>
                </div>
                <div class="option">
                    <label for="">B.</label>
                    <label for="answer1"><?= $row['opsi2']; ?></label>
                </div>
                <div class="option">
                    <label for="">C.</label>
                    <label for="answer1"><?= $row['opsi3']; ?></label>
                </div>
                <div class="option">
                    <label for="">D.</label>
                    <label for="answer1"><?= $row['opsi4']; ?></label>
                </div>
            </div>
        </div>
    <?php } ?>

</body>

</html>