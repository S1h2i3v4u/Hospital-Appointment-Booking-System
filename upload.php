<?php
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_FILES['pdf_file'])) {
    $file = $_FILES['pdf_file'];

    if ($file['error'] === UPLOAD_ERR_OK) {
        $uploadDir = 'uploads/';
        $filePath = $uploadDir . basename($file['name']);

        // Move uploaded file
        if (move_uploaded_file($file['tmp_name'], $filePath)) {
            // Run Python script
            $escapedFilePath = escapeshellarg($filePath);
            $command = "python analyze_report.py $escapedFilePath";
            $output = shell_exec($command);

            echo "<div class='result'>";
            echo "<h2>📊 Report Analysis Result:</h2>";
            echo "<pre>$output</pre>";
            echo "</div>";
        } else {
            echo "<div class='error'>❌ Failed to move uploaded file.</div>";
        }
    } else {
        echo "<div class='error'>❌ File upload error: " . $file['error'] . "</div>";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Radiology Report Analysis</title>
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;700&display=swap" rel="stylesheet">
    <style>
        /* General Styles */
        body {
            font-family: 'Roboto', sans-serif;
            background-color: #f4f7fc;
            margin: 0;
            padding: 0;
            color: #333;
        }

        h1 {
            text-align: center;
            color: #4CAF50;
            margin-top: 20px;
        }

        .container {
            max-width: 800px;
            margin: 0 auto;
            background-color: #fff;
            padding: 30px;
            border-radius: 10px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            margin-top: 30px;
        }

        .form-section {
            text-align: center;
            margin-bottom: 30px;
        }

        input[type="file"] {
            padding: 10px;
            font-size: 16px;
            margin-bottom: 20px;
            border: 1px solid #ddd;
            border-radius: 5px;
            background-color: #fafafa;
        }

        button {
            background-color: #4CAF50;
            color: white;
            padding: 10px 20px;
            border: none;
            font-size: 16px;
            border-radius: 5px;
            cursor: pointer;
        }

        button:hover {
            background-color: #45a049;
        }

        .error {
            color: #ff4c4c;
            background-color: #ffe6e6;
            padding: 10px;
            border-radius: 5px;
            text-align: center;
            margin-top: 20px;
        }

        .result {
            background-color: #e7f9e7;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }

        pre {
            background-color: #f1f1f1;
            padding: 20px;
            border-radius: 5px;
            overflow-x: auto;
            font-family: monospace;
            color: #333;
        }

        @media (max-width: 768px) {
            .container {
                padding: 15px;
            }

            h1 {
                font-size: 24px;
            }

            button {
                font-size: 14px;
            }
        }
    </style>
</head>
<body>

    <div class="container">
        <h1>📄 Upload Radiology Report (PDF)</h1>

        <div class="form-section">
            <form method="POST" enctype="multipart/form-data">
                <input type="file" name="pdf_file" accept=".pdf" required>
                <br>
                <button type="submit">Analyze Report</button>
            </form>
        </div>

        <!-- Display the result here -->
    </div>

</body>
</html>
