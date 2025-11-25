<?php
// Ziel-URL (neue Adresse)
$neue_url = "https://punklifebalance.de/de";

// Sende den 301-Header
header("HTTP/1.1 301 Moved Permanently");

// Sende die neue Location
header("Location: " . $neue_url);

// Beende das Skript, um sicherzustellen, dass keine weiteren Inhalte geladen werden
exit();
?>

