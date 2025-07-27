<?php
// show_inventory.php

// Connect to database
try {
    $db = new PDO("mysql:host=localhost;dbname=inventory_db", "root", "");
    $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // Get all items
    $stmt = $db->prepare("SELECT * FROM items");
    $stmt->execute();
    $items = $stmt->fetchAll(PDO::FETCH_ASSOC);

} catch (PDOException $e) {
    echo "Connection failed: " . $e->getMessage();
    exit();
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>My Inventory</title>
</head>
<body>
    <h1>My Inventory</h1>
    <table border="1" cellpadding="5">
        <tr>
            <th>Item Name</th>
            <th>Category</th>
            <th>Quantity</th>
            <th>Purchase Date</th>
        </tr>
        <?php 
        foreach ($items as $item) {
            echo "<tr>";
            echo "<td>" . htmlspecialchars($item['item_name']) . "</td>";
            echo "<td>" . htmlspecialchars($item['category']) . "</td>";
            echo "<td>" . htmlspecialchars($item['quantity']) . "</td>";
            echo "<td>" . htmlspecialchars($item['purchase_date']) . "</td>";
            echo "</tr>";
        }
        ?>
    </table>
</body>
</html>

