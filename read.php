<?php

$login = $_GET['login'];
$domain = $_GET['domain'];
$id = $_GET['id'];

$url = 'https://www.1secmail.com/api/v1/?action=readMessage&login='.$login.'&domain='.$domain.'&id='.$id.'';
$json = file_get_contents($url);
$data = json_decode($json);

$html = '<div>';
$html .= '<p><strong>From:</strong> ' . $data->from . '</p>';
$html .= '<p><strong>Subject:</strong> ' . $data->subject . '</p>';
$html .= '<p><strong>Date:</strong> ' . $data->date . '</p>';

if (!empty($data->attachments)) {
    $html .= '<p><strong>Attachments:</strong></p>';
    $html .= '<ul>';
    foreach ($data->attachments as $attachment) {
        $html .= '<li>' . $attachment->filename . ' (' . $attachment->size . ' bytes)</li>';
    }
    $html .= '</ul>';
}

$html .= '<hr>';
$html .= '<p>' . nl2br($data->body) . '</p>';
$html .= '</div>';

echo $html;

?>