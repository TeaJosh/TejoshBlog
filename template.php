<?php
class Template {
    public $title = "Default Title";
    public $headerSubtitle = "";
    public $content = "";

    public function display() {
        ?>
        <!DOCTYPE html>
        <html lang="en">
        <head>
            <meta charset="UTF-8">
            <title><?= htmlspecialchars($this->title) ?></title>
            <link rel="stylesheet" href="../styles.css"> <!-- Optional CSS -->
            <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
            <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
        </head>
        <body>
            <div class="container">
                <header>
                    <h1><?= htmlspecialchars($this->title) ?></h1>
                    <?php if ($this->headerSubtitle): ?>
                        <h2><?= htmlspecialchars($this->headerSubtitle) ?></h2>
                    <?php endif; ?>
                </header>

                <main>
                    <?= $this->content ?>
                </main>

                <footer>
                    <hr>
                    <p>&copy; <?= date("Y") ?> My Website</p>
                </footer>
            </div>
        </body>
        </html>
        <?php
    }
}
?>
