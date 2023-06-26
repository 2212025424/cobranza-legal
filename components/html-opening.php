<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo (isset($document_title) && !empty($document_title) ? $document_title . ' | ' . APP_NAME : 'Sitio web oficial | ' . APP_NAME ) ?></title>
    <link rel="stylesheet" type="text/css" href="<?php echo ROUTE_CSS . 'modifiers.css?' . time(); ?>" />
    <link rel="stylesheet" type="text/css" href="<?php echo ROUTE_CSS . 'elements.css?' . time(); ?>" />
    <link rel="stylesheet" type="text/css" href="<?php echo ROUTE_CSS . 'components.css?' . time(); ?>" />
    <link rel="stylesheet" type="text/css" href="<?php echo ROUTE_CSS . 'responsive.css?' . time(); ?>" />
</head>
<body>