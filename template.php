<?php
class Template {
    public $content;
    public $title;
    public $headerSubtitle;

    public function render() {
        include('header.php');
        echo $this->content;
        include('footer.php');
    }
}
?>
