<?php
// Simple migration runner: applies SQL files in db_migrations in alphabetical order
// Usage: php scripts/run_migrations.php
$dir = __DIR__ . '/../db_migrations';
$files = glob($dir . '/*.sql');
sort($files, SORT_STRING);
// DB credentials from env or defaults
$dbh = getenv('DB_HOST') ?: '127.0.0.1';
$dbuser = getenv('DB_USER') ?: 'root';
$dbpass = getenv('DB_PASS') ?: '';
$dbname = getenv('DB_NAME') ?: 'lucidstar';
$mysqli = new mysqli($dbh, $dbuser, $dbpass, $dbname);
if ($mysqli->connect_errno) {
    fwrite(STDERR, "DB connect error: " . $mysqli->connect_error . "\n");
    exit(1);
}
// ensure migrations table
$mysqli->query("CREATE TABLE IF NOT EXISTS migrations (\n  id INT AUTO_INCREMENT PRIMARY KEY,\n  filename VARCHAR(255) NOT NULL UNIQUE,\n  applied_at DATETIME NOT NULL\n) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;") or die($mysqli->error);
foreach ($files as $f) {
    $fname = basename($f);
    // skip files already applied
    $stmt = $mysqli->prepare('SELECT 1 FROM migrations WHERE filename = ? LIMIT 1');
    $stmt->bind_param('s', $fname);
    $stmt->execute();
    $res = $stmt->get_result();
    if ($res && $res->num_rows > 0) {
        echo "Skipping $fname (already applied)\n";
        continue;
    }
    echo "Applying $fname...\n";
    $sql = file_get_contents($f);
    if ($sql === false) { echo "Failed to read $f\n"; continue; }
    if ($mysqli->multi_query($sql)) {
        do { /* drain */ } while ($mysqli->more_results() && $mysqli->next_result());
        if ($mysqli->errno) {
            echo "Error applying $fname: " . $mysqli->error . "\n";
            exit(1);
        }
        $stmt = $mysqli->prepare('INSERT INTO migrations (filename, applied_at) VALUES (?, NOW())');
        $stmt->bind_param('s', $fname);
        $stmt->execute();
        echo "Applied $fname\n";
    } else {
        echo "Error running $fname: " . $mysqli->error . "\n";
        exit(1);
    }
}
echo "Migrations complete.\n";
