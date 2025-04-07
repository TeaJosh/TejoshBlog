<?php
class Template {
    public $content;
    public $title;
    public $headerSubtitle;

    public function render() {
        // Include the header
        include('header.php');
        // Display the content
        echo $this->content;
        // Include the footer
        include('footer.php');
    }

    // Define the Display method
    public function Display() {
        $this->render();
    }
}
?>
