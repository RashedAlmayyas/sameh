<?php
include './includes/config.php';

$query = "SELECT COUNT(DISTINCT BRANCH_NO) AS TOTAL_GRPS FROM WEB_DAILY_SALES_BRANCH_VIEW";
$statement = oci_parse($conn, $query);
oci_set_client_identifier($conn, 'AL32UTF8');
oci_execute($statement);

$row = oci_fetch_assoc($statement);
$totalGroups = $row['TOTAL_GRPS'];

oci_close($conn);
?>

<div class="col-md-6 col-sm-6 col-lg-6 col-xl-6">
    <div class="card dash-widget">
        <div class="card-body">
            <span class="dash-widget-icon"><i class="fa fa-building"></i></span>
            <div class="dash-widget-info">
                <h3><?php echo $totalGroups; ?></h3>
                <span>عدد الفروع</span>
            </div>
        </div>
    </div>
</div>

