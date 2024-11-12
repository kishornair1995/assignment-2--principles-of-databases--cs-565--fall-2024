<?php
require_once 'config.php';

function connectDatabase() {
    $dsn = "mysql:host=" . DBHOST . ";dbname=" . DBNAME;
    try {
        $pdo = new PDO($dsn, DBUSER, DBPASS);
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        return $pdo;
    } catch (PDOException $e) {
        echo "Database connection failed: " . $e->getMessage();
        exit;
    }
}

function getMacOSVersions($pdo) {
    $stmt = $pdo->prepare("SELECT version_name, release_name, darwin_os_number, date_announced, date_released, date_latest_release FROM macOS_versions ORDER BY date_released ASC");
    $stmt->execute();
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}

function getComputerInventory($pdo) {
    $stmt = $pdo->prepare("SELECT model_name, model_identifier, model_number, part_number, serial_number, darwin_os_number, latest_darwin_os_number, url FROM computer_inventory");
    $stmt->execute();
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}
function getOSSupport($pdo) {
    $stmt = $pdo->prepare("SELECT model, installed_os, last_supported_os
                           FROM os_support
                           ORDER BY FIELD(model,
                                'MacBook (Retina, 12-inch, Early 2015)',
                                'MacBook Pro (15-inch, 2.53GHz, Mid 2009)',
                                'MacBook Pro (15-inch, 2016)',
                                'iMac (Retina 5K, 27-inch, Late 2014)',
                                'Mac Pro (Late 2013)',
                                'MacBook Pro (15-inch, 2.4GHz, Mid 2010)',
                                'Mac Pro (Mid 2010)')");
    $stmt->execute();
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}

?>
