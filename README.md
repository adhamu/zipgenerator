# ZIPGenerator
A PHP class for creating ZIP files.

# Example Usage
	<?php
		// Example 1 - Adding a single file
	    $zip = new ZIPGenerator("files.zip");
	    $zip->addSingleFile("C:/Users/Amit/Pictures/photo.jpg");
	    $zip->get();

	    // Example 2 - Adding a directory of files
	    $zip = new ZIPGenerator("files.zip");
	    $zip->addDirectoryFiles("C:/Users/Amit/Pictures/");
	    $zip->get();
    ?>

If you want to download the file as soon as it is generated instead of silently saving it to the specified location, you can do the following:
    <?php
        $zip->setProcessType("stream");
    ?>