<?php
include 'db.php';

function parseQuestions($text) {
    $blocks = preg_split("/\r?\n\s*\r?\n/", trim($text));
    $questions = [];

    foreach ($blocks as $block) {
        $lines = array_values(array_filter(array_map('trim', preg_split("/\r?\n/", $block))));
        if (count($lines) === 0) continue;

        $questionText = array_shift($lines);
        $options = [];
        $answer = '';

        foreach ($lines as $line) {
            if (stripos($line, 'ANSWER') === 0) {
                $answer = trim(preg_replace('/^ANSWER\s*:?\s*/i', '', $line));
            } else {
                $options[] = $line;
            }
        }

        $questions[] = [
            'question' => $questionText,
            'options' => $options,
            'answer'  => $answer
        ];
    }

    return $questions;
}

$message = '';
$uploadedQuestions = [];

if (isset($_FILES['quizfile']) && $_FILES['quizfile']['error'] === UPLOAD_ERR_OK) {
    $content = file_get_contents($_FILES['quizfile']['tmp_name']);
    $uploadedQuestions = parseQuestions($content);

    // Lưu vào DB
    foreach ($uploadedQuestions as $q) {
        $opts = $q['options'] + ['', '', '', '']; // đảm bảo có 4 option
        $stmt = $pdo->prepare("INSERT INTO questions (question, option_a, option_b, option_c, option_d, answer)
                               VALUES (:question, :a, :b, :c, :d, :answer)");
        $stmt->execute([
            ':question' => $q['question'],
            ':a' => $opts[0],
            ':b' => $opts[1],
            ':c' => $opts[2],
            ':d' => $opts[3],
            ':answer' => $q['answer'],
        ]);
    }
    $message = "Đã lưu " . count($uploadedQuestions) . " câu hỏi vào CSDL.";
}
?>
<!DOCTYPE html>
<html lang="vi">
<head>
<meta charset="UTF-8">
<title>Đề thi</title>
<style>
    body { font-family: Arial; max-width: 900px; margin: 20px auto; line-height: 1.6; }
    .question { border: 1px solid #ddd; background: #fafafa; padding: 15px; margin-bottom: 15px; border-radius: 8px; }
    .options { margin-top: 8px; padding-left: 18px; }
    .option { margin: 4px 0; }
    .answer { margin-top: 10px; color: green; font-weight: bold; }
</style>
</head>
<body>
<h2>Đề thi trắc nghiệm</h2>

<?php if ($message): ?>
<p style="color:green;"><?= $message ?></p>
<?php endif; ?>

<form method="POST" enctype="multipart/form-data" style="margin-bottom:18px;">
    <label>Chọn file TXT: </label>
    <input type="file" name="quizfile" accept=".txt" required>
    <button type="submit">Upload và Lưu vào CSDl</button>
</form>

<?php if (!empty($uploadedQuestions)): ?>
    <h3>Câu hỏi:</h3>
    <?php foreach ($uploadedQuestions as $i => $q): ?>
        <div class="question">
            <strong>Câu <?= $i + 1 ?>:</strong> <?= htmlspecialchars($q['question']) ?>
            <div class="options">
                <?php foreach ($q['options'] as $opt): ?>
                    <div class="option"><?= htmlspecialchars($opt) ?></div>
                <?php endforeach; ?>
            </div>
            <div class="answer">Đáp án đúng: <?= htmlspecialchars($q['answer']) ?></div>
        </div>
    <?php endforeach; ?>
<?php endif; ?>

</body>
</html>
