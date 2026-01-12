<?php
// test lang ito
$ip = "192.168.1.15"; // Update this to  real IP
$externalUrl = "http://$ip/EscaPinas/frontend/integs/api/sendUsers.php"; 

// 1. Get the JSON data from the other system
// Use @ to suppress errors and handle them manually
$json_data = @file_get_contents($adrian_url);

if ($json_data === FALSE) {
    die("<h2 style='color:red;'>Connection Error:</h2> 
         <p>Could not reach Adrian's system at <b>$ip</b>.</p>
         <p>Check if:
            <ul>
                <li>Both computers are on the same Wi-Fi.</li>
                <li>Adrian's Firewall is allowing Apache.</li>
                <li>The URL path is correct.</li>
            </ul>
         </p>");
}

// 2. Decode the JSON data into a PHP array
$externalUsers = json_decode($json_data, true);


if (!empty($externalUsers)) {
    // 3. Display the data in an HTML Table
    echo "<table border='1' cellpadding='10' style='border-collapse: collapse; width: 100%; font-family: Arial, sans-serif;'>";
    echo "<tr style='background-color: #333; color: white;'>
            <th>Partner User ID</th>
            <th>Username</th>
            <th>Email Address</th>
            <th>Password Hash (Encrypted)</th>
          </tr>";

    foreach ($externalUsers as $user) {
        // Use htmlspecialchars to prevent XSS if they have weird characters in names
        $id    = htmlspecialchars($user['user_id'] ?? 'N/A');
        $name  = htmlspecialchars($user['first_name'] ?? 'N/A');
        $email = htmlspecialchars($user['email'] ?? 'N/A');
        $hash  = htmlspecialchars($user['password'] ?? 'N/A');

        echo "<tr>";
        echo "<td>$id</td>";
        echo "<td>$name</td>";
        echo "<td>$email</td>";
        echo "<td style='word-break: break-all; font-family: monospace;'>$hash</td>";
        echo "</tr>";
    }
    echo "</table>";
    echo "<p><b>Total Users found on Adrian's system:</b> " . count($externalUsers) . "</p>";
} else {
    echo "<p style='color:orange;'>Connected, but no user data was returned. The array is empty.</p>";
}
?>