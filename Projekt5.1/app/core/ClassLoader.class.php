<?php

namespace app\core;

class ClassLoader {
    private $prefixLengthsPsr4 = [];
    private $prefixDirsPsr4 = [];
    private $fallbackDirsPsr4 = [];
    private $registered = false;


    public function register() {
        if ($this->registered) {
            return;
        }

        spl_autoload_register([$this, 'loadClass'], true, true);
        $this->registered = true;
    }


    public function unregister() {
        if (!$this->registered) {
            return;
        }
        spl_autoload_unregister([$this, 'loadClass']);
        $this->registered = false;
    }


    public function addNamespace(string $prefix, string $baseDir) {
        $prefix = trim($prefix, '\\') . '\\';

        $baseDir = rtrim($baseDir, DIRECTORY_SEPARATOR) . DIRECTORY_SEPARATOR;

        if (isset($prefix[0])) {
            $this->prefixLengthsPsr4[$prefix[0]][$prefix] = strlen($prefix);
            $this->prefixDirsPsr4[$prefix] = $baseDir;
        }
    }


     public function addFallbackDir(string $baseDir) {
         $this->fallbackDirsPsr4[] = rtrim($baseDir, DIRECTORY_SEPARATOR) . DIRECTORY_SEPARATOR;
     }

    public function loadClass(string $class) {
        $class = trim($class, '\\');
        $file = $this->findFile($class);

        if ($file) {

            require_once $file;
            return $file;
        }

        return false;
    }

    private function findFile(string $class) {

        $logicalPathPsr4 = strtr($class, '\\', DIRECTORY_SEPARATOR) . '.class.php';


        $first = $class[0] ?? null;
        if (isset($this->prefixLengthsPsr4[$first])) {
            foreach ($this->prefixLengthsPsr4[$first] as $prefix => $length) {

                if (0 === strpos($class, $prefix)) {
                    $baseDir = $this->prefixDirsPsr4[$prefix];

                    $file = $baseDir . substr($logicalPathPsr4, $length);

                    if (file_exists($file)) {
                        return $file;
                    }
                }
            }
        }

        foreach ($this->fallbackDirsPsr4 as $baseDir) {
            $file = $baseDir . $logicalPathPsr4;
            if (file_exists($file)) {
                return $file;
            }
        }

        return false;
    }
}
