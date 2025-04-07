<?php
class Template {
    public $content;
    public $title;
    public $headerSubtitle;

    public function render() {
        // Include the header
        include(__DIR__ . '/includes/header.php'); // Adjust the path to the includes folder
        // Display the content
        echo $this->content;
        // Include the footer
        include(__DIR__ . '/includes/footer.php'); // Adjust the path to the includes folder
    }

    // Define the Display method
    public function Display() {
        $this->render();
    }
}
?>
