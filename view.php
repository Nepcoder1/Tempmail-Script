<?php
function extractEmailParts($email) {
    $parts = explode("@", $email);
    $username = $parts[0];
    $domain = $parts[1];

    return [
        'username' => $username,
        'domain' => $domain
    ];
}

function getEmailDetails($email) {
    $emailParts = extractEmailParts($email);
    $username = $emailParts['username'];
    $domain = $emailParts['domain'];

    $url = 'https://www.1secmail.com/api/v1/?action=getMessages&login='.$username.'&domain='.$domain;
    $json = file_get_contents($url);
    $data = json_decode($json, true);

    $id = $data[0]['id'];
    $from = $data[0]['from'];
    $subject = $data[0]['subject'];
    $date = $data[0]['date'];
    $body = $data[0]['body'];

    return [
        'id' => $id,
        'from' => $from,
        'subject' => $subject,
        'date' => $date,
        'body' => $body,
    ];
}

$email = $_GET['id'];
$details = getEmailDetails($email);

echo '<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=no">
    <title>Email Inbox</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-image: url(""); /* Add your background image path here */
            background-size: cover;
            background-repeat: no-repeat;
            background-attachment: fixed;
            margin: 0;
            padding: 0;
        }

        .container {
            max-width: 100%;
            text-align: center;
            padding: 20px;
        }

        .email-table {
            background-color: rgba(255, 255, 255, 0.8);
            border-radius: 10px;
            padding: 20px;
            margin: 0 auto;
            width: 90%;
            max-width: 600px;
        }

        h1 {
            text-align: center;
            color: #333;
            padding: 20px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
        }

        th, td {
            padding: 10px;
            text-align: left;
        }

        .email-body {
            padding: 20px;
        }

        .custom-button {
            background-color: #007BFF;
            color: #fff;
            border: none;
            padding: 10px 20px;
            border-radius: 5px;
            cursor: pointer;
            margin: 5px;
        }

        .custom-button:hover {
            background-color: #0056b3;
        }
    </style>
</head>
<body>';

if (isset($details['id']) && !empty($details['id'])) {
    $emailParts = extractEmailParts($email);
    $username = $emailParts['username'];
    $domain = $emailParts['domain'];
    $id = $details['id'];

    echo '<div class="container">';
    echo '<h1>Email Inbox</h1>';
    echo '<table class="email-table">';
    echo '  <tr>';
    echo '    <td><strong>From:</strong></td>';
    echo '    <td>'.$details['from'].'</td>';
    echo '  </tr>';
    echo '  <tr>';
    echo '    <td><strong>Subject:</strong></td>';
    echo '    <td>'.$details['subject'].'</td>';
    echo '  </tr>';
    echo '  <tr>';
    echo '    <td><strong>Date:</strong></td>';
    echo '    <td>'.$details['date'].'</td>';
    echo '  </tr>';
    echo '  <tr>';
    echo '    <td class="email-body" colspan="2">';
    echo '      '.$details['body'];
    echo '    </td>';
    echo '  </tr>';
    echo '  <tr>';
    echo '    <td colspan="2">';
    echo '      <a href="./read.php?login='.$username.'&domain='.$domain.'&id='.$id.'"><button class="custom-button">Back to Inbox</button></a>';
    echo '    </td>';
    echo '  </tr>';
    echo '</table>';
    echo '</div>';
} else {
    echo '<div class="container">';
    echo '<h1>Email Inbox</h1>';
    echo '<p>No email found.</p>';
    echo '</div>';
}

echo '</body>
</html>';
