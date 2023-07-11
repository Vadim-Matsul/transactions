<!DOCTYPE html>
<html>
    <head>
        <title>Transactions</title>
        <style>
            table {
                width: 100%;
                border-collapse: collapse;
                text-align: center;
            }

            table tr th, table tr td {
                padding: 5px;
                border: 1px #eee solid;
            }

            tfoot tr th, tfoot tr td {
                font-size: 20px;
            }

            tfoot tr th {
                text-align: right;
            }
        </style>
    </head>

    <body>
        <table>
            <thead>
                <tr>
                    <th>Date</th>
                    <th>Check</th>
                    <th>Description</th>
                    <th>Amount</th>
                </tr>
            </thead>

            <tbody>
               <?php if (!empty($transactions)): ?>
                    <?php foreach ($transactions as $transaction): ?>
                        <tr>
                            <td><?= formatDate($transaction['date']) ?></td>
                            <td><?= $transaction['checkNumber']?></td>
                            <td><?= $transaction['desc']?></td>
                            <td>
                                <?php if ($transaction['amount'] < 0): ?>
                                    <span style="color: red">
                                        <?= formatPrice($transaction['amount']) ?>
                                    </span>
                                <?php elseif($transaction['amount'] > 0): ?>
                                    <span style="color: green">
                                        <?= formatPrice($transaction['amount']) ?>
                                    </span>
                                <?php else: ?>
                                    <span>
                                        <?= formatPrice($transaction['amount']) ?>
                                    </span>
                                <?php endif ?>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                <?php endif; ?>
            </tbody>

            <tfoot style="font-weight: 600;">
                <tr>
                    <th colspan="3">Total Income: </th>
                    <td style="color: green;">
                        <?= formatPrice($total['totalIncome']) ?>
                    </td>
                </tr>
                <tr>
                    <th colspan="3">Total Expense: </th>
                    <td style="color: red;">
                        <?= formatPrice($total['totalExpense'])  ?>
                    </td>
                </tr>
                <tr>
                    <th colspan="3">Net total: </th>
                    <td>
                        <?= formatPrice($total['netTotal'])  ?>
                    </td>
                </tr>
            </tfoot>
        </table>
    </body>
</html>