<?php
namespace classes;

class Page {
    private $title, $directory;
    public function __construct(string $title = 'Test assignment', string $directory = ''){
        $this->title = $title;
        $this->directory = empty($directory) ? $directory : $directory . '/';
    }

    public function getTitle(): string {
        return htmlspecialchars($this->title);
    }

    public function getJsMainPath(): string {
        return "/assets/js/{$this->directory}main.js";
    }

    static public function redirectTo(string $path): void {
        header("Location: " . $path);
        exit;
    }

}
