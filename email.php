<?php
    $recipient = 'armand.szil22@gmail.com'; // Replace with your Gmail address
    $subject = 'Új rendelés!';

    // Function to safely get POST data
    function getPostData($key) {
        return isset($_POST[$key]) ? $_POST[$key] : 'N/A';
    }

    // Collecting shipping details
    $shippingDetails = "Szállítási adatok:\n" .
                       "Családnév: " . getPostData('lastname') . "\n" .
                       "Keresztnév: " . getPostData('firstname') . "\n" .
                       "Cím: " . getPostData('address') . "\n" .
                       "Irányítószám: " . getPostData('zipcode') . "\n" .
                       "Város: " . getPostData('city') . "\n" .
                       "Adószám: " . getPostData('taxnumber') . "\n" .
                       "Email: " . getPostData('email') . "\n";

    // Check if billing details are different
    $billingDetails = "Számlázási adatok:\n";
    if (isset($_POST['sameAsDelivery']) && $_POST['sameAsDelivery'] == 'on') {
        $billingDetails .= "Családnév: " . getPostData('billing_lastname') . "\n" .
                           "Keresztnév: " . getPostData('billing_firstname') . "\n" .
                           "Cím: " . getPostData('billing_address') . "\n" .
                           "Irányítószám: " . getPostData('billing_zipcode') . "\n" .
                           "Város: " . getPostData('billing_city') . "\n" .
                           "Adószám: " . getPostData('billing_taxnumber') . "\n";
    } else {
        $billingDetails .= "Számlázási adatok megegyeznek a szállítási adatokkal.\n";
    }

    // Collecting book order details
    $bookOrderDetails = "Megrendelt könyvek:\n";
    foreach ($_POST['bookQuantity'] as $book => $quantity) {
        if ($quantity > 0) {
            $bookOrderDetails .= "$book: $quantity darab\n";
        }
    }

    // Additional message
    $additionalMessage = "Üzenet: " . getPostData('message');

    // Constructing the full message
    $fullMessage = $shippingDetails . "\n" . $billingDetails . "\n" . $bookOrderDetails . "\n" . $additionalMessage;

    // Email Headers
    $headers = "From: info@lexica.hu" . "\r\n"; // Replace with a valid address on your domain
    $headers .= "Reply-To: " . getPostData('email') . "\r\n";
    $headers .= "X-Mailer: PHP/" . phpversion();

    // Sending the email
    mail($recipient, $subject, $fullMessage, $headers);
?>
