<?php
include './INCLUDES/config.php';

$query = "SELECT * FROM WEB_DAILY_SALES_BRANCH_VIEW";

$statement = oci_parse($conn, $query);
oci_set_client_identifier($conn, 'AL32UTF8');

oci_execute($statement);

echo '
<div class="table-responsive">
    <table class="table table-bordered" align="center">
        <thead class="table-warning">
            <tr>
            <th rowspan="2">DATE</th>
            <th rowspan="2">BRANCH_NO</th>
            <th rowspan="2">BRANCH_DESC</th>
            <th colspan="4">Net DAILY Sales</th>
            <th colspan="2">CUSTOMER</th>
            <th colspan="2">QTY SOLD</th>
                <th colspan="2">AVERAGE BASKET</th>
                <th colspan="3">AVG ITEM SELLING PRICE</th>
                <th colspan="2">MARGIN</th>
                <th rowspan="2">AVERAGE STOCKE</th>
            </tr>
            <tr>
                <th>ACTUAL</th>
                <th>BUDGET</th>
                <th>GTH</th>
                <th>VAR</th>
                <th>COUNT</th>
                <th>GTH</th>
                <th>ACTUAL</th>
                <th>GTH</th>
                <th>ACTUAL</th>
                <th>GTH</th>
                <th>NET MARGIN</th>
                <th>WASTE</th>
                <th>NET MARGIN AFTER WASTE</th>
                <th>ACTUAL</th>
                <th>GTH</th>
            </tr>
        </thead>
        <tbody>';

        while ($row = oci_fetch_assoc($statement)) {
            echo '<tr>';
            foreach ($row as $columnName => $value) {
                // Apply iconv for 'SECTION_CODE_NAME' column
                if ($columnName === 'BRANCH_DESC') {
                    $value = iconv('WINDOWS-1256', 'UTF-8', $value);
                }
                
             
                
                echo '<td>' . $value . '</td>';
            }
            echo '</tr>';
        }

echo '
        </tbody>
    </table>
</div>';

oci_close($conn);
?>
