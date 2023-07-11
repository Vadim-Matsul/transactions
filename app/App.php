<?php

declare(strict_types = 1);

function getFolderFilesPaths (string $dirName): array {
   $files = [];

   foreach (scandir($dirName) as $partialFilePath){
       if (is_dir($partialFilePath)) continue;
       $files[] = $dirName . $partialFilePath;
   }

   return $files;
}

function getFileContent (string $filePath, ?callable $normalizer = null): array {
    if (!file_exists($filePath)){
        $message = 'File: ' . "$filePath" . ' does not exist';
        trigger_error($message, E_USER_ERROR);
    }

    $file = fopen($filePath, 'r');

    $content = [];
    while (($dataArr = fgetcsv($file)) !== false){
        if (is_callable($normalizer)){
            $dataArr = $normalizer($dataArr);
        }

        $content[] = $dataArr;
    }

    return $content;
}

function normalizeTransaction (array $transactionContent): array {
    [$data, $checkNumber, $desc, $amount] = $transactionContent;

    $amount = (float)str_replace(['$', ','], '', $amount);

    return [
        'date' => $data,
        'checkNumber' => $checkNumber,
        'desc' => $desc,
        'amount' => $amount,
    ];
}

function calculateTotalTransactions (array $transactions): array {
    $totals = ['netTotal' => 0, 'totalIncome' => 0, 'totalExpense' => 0];

    foreach ($transactions as $transaction){
        $totals['netTotal'] += $transaction['amount'];

        if ($transaction['amount'] > 0) {
            $totals['totalIncome'] += $transaction['amount'];
        } else {
            $totals['totalExpense'] += $transaction['amount'];
        }
    }

    return $totals;
}