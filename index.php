<?php
require 'includes/functions.php';

// Connect to the database
$pdo = connectDatabase();

// Fetch macOS versions, inventory, and OS support data
$macosVersions = getMacOSVersions($pdo);
$inventory = getComputerInventory($pdo);
$osSupport = getOSSupport($pdo);
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Apple Macintosh Computer Inventory</title>
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=IBM+Plex+Sans:ital,wght@0,200;0,500;1,200;1,500&display=swap">
  <link rel="stylesheet" href="css/style.css">
</head>
<body>
  <header>
    <h1>Apple Macintosh Computer Inventory</h1>
  </header>
  <main>
    <!-- Section for macOS Version Count -->
    <section>
      <h2>How Many Versions of macOS Have Been Released?</h2>
      <div>
        <p>There have been <b><?php echo count($macosVersions); ?></b> versions of macOS released thus far.</p>
      </div>
    </section>


    <!-- Section for All macOS Versions Details -->
    <section>
      <h2>Show the Version Name, Release Name, Official Darwin OS Number, Date Announced, Date Released, and Date of Latest Release of All macOS Versions, Listed by Date Order</h2>
      <div>
        <table>
          <thead>
            <tr>
              <th>Version Name</th>
              <th>Release Name</th>
              <th>Official Darwin OS Number</th>
              <th>Date Announced</th>
              <th>Date Released</th>
              <th>Date of Latest Release</th>
            </tr>
          </thead>
          <tbody>
            <?php foreach ($macosVersions as $version): ?>
              <tr>
                <td><?php echo htmlspecialchars($version['version_name'] ?? ''); ?></td>
                <td><?php echo htmlspecialchars($version['release_name'] ?? ''); ?></td>
                <td><?php echo htmlspecialchars($version['darwin_os_number'] ?? ''); ?></td>
                <td><?php echo htmlspecialchars($version['date_announced'] ?? ''); ?></td>
                <td><?php echo htmlspecialchars($version['date_released'] ?? ''); ?></td>
                <td><?php echo htmlspecialchars($version['date_latest_release'] ?? ''); ?></td>
              </tr>
            <?php endforeach; ?>
          </tbody>
        </table>
      </div>
    </section>


    <!-- Section for macOS Versions and Release Years -->
    <section>
      <h2>Show the Version Name (Release Name) and Year Released of all macOS Versions, Listed by Date Released</h2>
      <div>
        <table>
          <thead>
            <tr>
              <th>Version Name (Release Name)</th>
              <th>Year Released</th>
            </tr>
          </thead>
          <tbody>
            <?php foreach ($macosVersions as $version): ?>
              <tr>
                <td><?php echo htmlspecialchars($version['version_name'] ?? '') . " (" . htmlspecialchars($version['release_name'] ?? '') . ")"; ?></td>
                <td><?php echo htmlspecialchars(date('Y', strtotime($version['date_released'])) ?? ''); ?></td>
              </tr>
            <?php endforeach; ?>
          </tbody>
        </table>
      </div>
    </section>


    <!-- Section for Current Inventory Details -->
    <section>
      <h2>Show the Current Inventory (Excluding Comments)</h2>
      <div>
        <table>
          <thead>
            <tr>
              <th>Model Name</th>
              <th>Model Identifier</th>
              <th>Model Number</th>
              <th>Part Number</th>
              <th>Serial Number</th>
              <th>Darwin OS Number</th>
              <th>Latest Supporting Darwin OS Number</th>
              <th>URL</th>
            </tr>
          </thead>
          <tbody>
            <?php foreach ($inventory as $item): ?>
              <tr>
                <td><?php echo htmlspecialchars($item['model_name'] ?? ''); ?></td>
                <td><?php echo htmlspecialchars($item['model_identifier'] ?? ''); ?></td>
                <td><?php echo htmlspecialchars($item['model_number'] ?? ''); ?></td>
                <td><?php echo htmlspecialchars($item['part_number'] ?? ''); ?></td>
                <td><?php echo htmlspecialchars($item['serial_number'] ?? ''); ?></td>
                <td><?php echo htmlspecialchars($item['darwin_os_number'] ?? ''); ?></td>
                <td><?php echo htmlspecialchars($item['latest_darwin_os_number'] ?? ''); ?></td>
                <td><a href="<?php echo htmlspecialchars($item['url'] ?? ''); ?>" target="_blank" rel="noopener">Link</a></td>
              </tr>
            <?php endforeach; ?>
          </tbody>
        </table>
      </div>
    </section>


    <!-- Section for Installed and Supported OS of Inventory -->
    <section>
      <h2>Show the Model, Installed/Original OS, and the Last Supported OS For the Current Inventory</h2>
      <div>
        <table>
          <thead>
            <tr>
              <th>Model</th>
              <th>Installed/Original OS</th>
              <th>Last Supported OS</th>
            </tr>
          </thead>
          <tbody>
            <?php foreach ($osSupport as $support): ?>
              <tr>
                <td><?php echo htmlspecialchars($support['model'] ?? ''); ?></td>
                <td><?php echo htmlspecialchars($support['installed_os'] ?? ''); ?></td>
                <td><?php echo htmlspecialchars($support['last_supported_os'] ?? ''); ?></td>
              </tr>
            <?php endforeach; ?>
          </tbody>
        </table>
      </div>
