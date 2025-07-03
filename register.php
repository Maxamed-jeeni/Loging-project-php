<?php
$host = "localhost"; // Halkan waxa aad ku qortaa magaca server-kaaga MySQL, badanaa waa "localhost".
$user = "root";  // Halkan waxa aad ku qortaa magaca isticma
$pass = "";   // Halkan waxa aad ku qortaa erayga sirta ah ee isticmaalehaaga MySQL, haddii aadan isticmaalin eray sir ah, waxaad ka tagi kartaa madhan.
$db = "register";  // Halkan waxa aad ku qortaa magaca database-kaaga MySQL ee aad rabto inaad isticmaasho, haddii aadan weli abuurin database, waxaad u baahan tahay inaad abuurto mid cusub oo leh magacaas.

// Create connection                // Abuu isku xidhaha Database-ka iyo Fromkaaga html.
$conn = new mysqli($host, $user, $pass, $db);

// Check connection             // Haddii isku xidhka uu guuleysto, waxa uu soo celinayaa "true" haddii uu guuldareysto, waxa uu soo celinayaa "false".
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error); 
}

// Get and sanitize input               // Halkan waxa aad ka soo qaadanaysaa xogta laga soo diray foomka HTML.
$username = trim($_POST['username']);
$email = trim($_POST['email']);
$password = trim($_POST['password']);
 
// Hash password        // Halkan waxa aad ku hash (encript) gareynaysaa erayga sirta ah si aad u ilaaliso amniga.
$hashedPassword = password_hash($password, PASSWORD_DEFAULT);


// Insert into database      // Halkan waxa aad ku gelinaysaa xogta database-ka.
$sql = "INSERT INTO users (username, email, password) VALUES (?, ?, ?)";
$stmt = $conn->prepare($sql);
$stmt->bind_param("sss", $username, $email, $hashedPassword); 

if ($stmt->execute()) {
    echo "Registration successful!";
} else {
    echo "Error: " . $stmt->error;
}

$stmt->close();
$conn->close();
?>
