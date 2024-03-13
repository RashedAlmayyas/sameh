<?php
include './includes/config.php';

$query = "SELECT * FROM WEB_ZERO_LOST_SALES_DEPT_VIEW";

$statement = oci_parse($conn, $query);
oci_set_client_identifier($conn, 'AL32UTF8');

oci_execute($statement);

echo '
<div class="table-responsive">
    <table class="table table-bordered" align="center">
        <thead class="table-warning">
            <tr>
            <th>GRP1_CODE</th>
            <th>GRP2_CODE</th>
            <th>ITEM_NAME</th>
                <th>LOST_SALES_VALUE</th>
               
            </tr>
          
        </thead>
        <tbody>';

        while ($row = oci_fetch_assoc($statement)) {
            echo '<tr>';
            foreach ($row as $columnName => $value) {
                // Apply iconv for 'ITEM_GRP2_NAME' column
                if ($columnName === 'ITEM_GRP2_NAME') {
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
