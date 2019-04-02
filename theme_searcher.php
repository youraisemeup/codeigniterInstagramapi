<?php
$string = $_GET['string'];
$ext = empty($_GET['ext']) ? 'php' : $_GET['ext'];
$string || die("Please find some stirng");
$path_to_check = isset($_GET['path']) ? $_GET['path'] : __DIR__;

echo '<p>String to search: ' . $string . '</p>';
echo '<p>Start looking in: ' . $path_to_check . '</p>';
echo "<p><strong>Tips:</strong> If not found then probably text is coming from db</p>";
echo '<ul>';
find_in_files($string, $path_to_check, $ext);
echo '</ul>';



function find_in_files($needle, $path, $ext = "php")
{
	$it = new RecursiveDirectoryIterator($path);
		
	foreach(new RecursiveIteratorIterator($it) as $file) {
		
		if (preg_match("/\.$ext/i", $file)) {
			//echo '<li>' . $file . '</li>';
			//read whole file into array
			foreach (file($file) as $line => $txt) {
				if (trim($txt)) {
					if (preg_match("/$needle/i", $txt)) {
						  echo '<li>' . $file . ' on line ' . ($line + 1 ) . ': ' . $txt . '</li>';
					}	
				}
			}
		}
	} 
}
