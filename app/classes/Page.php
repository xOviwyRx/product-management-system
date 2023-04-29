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
        return self::urlFor("assets/js/{$this->directory}main.js");
    }

    static public function urlFor(string $path): string {
        $public_end = strpos($_SERVER['SCRIPT_NAME'], '/public') + 7;
        $root =  substr($_SERVER['SCRIPT_NAME'], 0, $public_end);
        if ($path[0] != '/') {
            $path = "/" . $path;
        }
        return $root . $path;
    }

    static public function redirectTo(string $path) {
        $url = self::urlFor($path);
        header("Location: " . $url);
        exit;
    }

}
