<?php
    include("../../includes/header.php");
    include("../../includes/menu.php");

    function validateFile($file, $dir) {
        $uploadOk = true;
        $filename = basename($file["name"]);
        $target = $dir . $filename;
        $filetype = strtolower(pathinfo($target, PATHINFO_EXTENSION));

        if ($file["size"] > 5000000) {
            echo "<p style='color: red;'>File is too big!";
            $uploadOk = false;
        }

        if ($filetype !== "json") {
            echo "<p style='color: red;'>Invalid file type. Please upload a JSON file.";
            $uploadOk = false;
        }

        if (!$uploadOk) {
            echo "<p style='color: red;'>File was not uploaded.";
            return false;
        }

        if (move_uploaded_file($file["tmp_name"], $target)) {
            echo "File successfully uploaded";
            return $target;
        } else {
            echo "<p style='color: red;'>There was a problem uploading the file";
            return false;
        }
    }

    function generateTable($arr) {
        $table = "<table class='jsonTable' border='1'><thead><tr><th>Key</th><th>Value</th></tr></thead><tbody>";
        
        foreach ($arr as $key => $val) {
            $table .= "<tr><td class='key'><strong>" . htmlspecialchars($key) . "</strong></td><td>";
            
            if (is_array($val)) {
                $table .= generateTable($val);
            } else {
                $table .= htmlspecialchars($val);
            }

            $table .= "</td></tr>";
        }

        $table .= "</tbody></table>";
        return $table;
    }

    function processData($data) {  
        $dataArray = json_decode($data, true);

        if (!is_array($dataArray)) {
            return "<p style='color: red;'>Invalid JSON data.</p>";
        }

        return generateTable($dataArray);
    }

    if (isset($_POST["submit"])) {
        $jsonfile = $_FILES["jsonfile"];
        $uploadDir = "../../uploads/";

        if (!is_dir($uploadDir)) {
            mkdir($uploadDir, 0777, true);
        }

        $target = validateFile($jsonfile, $uploadDir);

        if ($target) {
            $jsonData = file_get_contents($target);
            echo "<h3>Processed Data:</h3>";
            echo processData($jsonData);
        }
    }
?>

<?php
    include("../../includes/footer.php");
?>
