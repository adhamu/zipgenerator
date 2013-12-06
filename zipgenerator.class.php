<?php
    //https://adhamu@bitbucket.org/adhamu/zipgenerator.git
    class ZIPGenerator
    {

        private $zip;
        private $zip_filename;
        private $zip_location;
        private $files_to_zip;
        private $process_type;

        public function __construct($filename)
        {
            if (!extension_loaded("zip") || !file_exists($source)) {
                throw new Exception("ZipArchive module not found");
            } else {
                $this->zip = new ZipArchive();

                if (!$zip->open($this->zip_filename, ZIPARCHIVE::CREATE)) {
                    throw new Exception("Failed created a new ZipArchive");
                }
            }
        }

        public function get()
        {
            header("Content-Type: application/zip");
            header("Content-Length: " . filesize($this->zip_filename);
            header("Content-Disposition: attachment; filename=".$this->zip_filename."");

            $this->finish();
        }

        private function addDirectoryFiles($source)
        {
            if (is_dir($source)) {
                $files = new RecursiveIteratorIterator(new RecursiveDirectoryIterator($source));

                foreach ($files as $file) {
                    $file = sanitizeFilename($file);

                    if (is_dir($file) === true) {
                        $zip->addEmptyDir(str_replace($source . "/", "", $file . "/"));
                    } elseif (is_file($file) === true) {
                        $zip->addFromString(str_replace($source . "/", "", $file), file_get_contents($file));
                    }
                }
            } else {
                throw new Exception("This is not a valid directory");
            }
        }

        private function addSingleFile($source)
        {
            if (is_file($source)) {
                $this->zip->addFromString(basename($source), file_get_contents($source));
            } else {
                throw new Exception("This is not a valid file");
            }
        }

        private function sanitizeFilename($filename)
        {
            return str_replace("\\", "/", $filename);
        }

        private function finish()
        {
            $this->zip->close();

            if ($this->process_type === "stream") {
                readfile($this->zip_filename);
                unlink($this->zip_filename);
            }
        }

        public function setProcessType($type)
        {
            $this->process_type = $type;
        }

    }
