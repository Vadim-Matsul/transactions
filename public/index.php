<?php

$root = dirname(__DIR__) . DIRECTORY_SEPARATOR;

define('APP_PATH', $root . 'app' . DIRECTORY_SEPARATOR);
define('FILES_PATH', $root . 'transactions_csv' . DIRECTORY_SEPARATOR);
define('VIEWS_PATH', $root . 'views' . DIRECTORY_SEPARATOR);


/* * */
require APP_PATH . 'App.php';
require APP_PATH . 'helpers.php';

function getTransactions (): array {
    $transactionFiles = getFolderFilesPaths(FILES_PATH);

    $allTransactions = [];
    foreach ($transactionFiles as $transactionFile){
        $transactionContent = getFileContent($transactionFile, 'normalizeTransaction');
        $allTransactions = array_merge($allTransactions, $transactionContent);
    }

    return $allTransactions;
}

$transactions = getTransactions();
$total = calculateTotalTransactions($transactions);
require VIEWS_PATH . 'transactions.php';





