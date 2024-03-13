<?php
include './includes/config.php';

$query = "SELECT COUNT(DISTINCT BRANCH_NAME) AS TOTAL_BRANCHES, SUM(LOST_SALES_VALUE) AS TOTAL_LOST_SALES 
          FROM WEB_ZERO_LOST_SALES_BR_VIEW";
$statement = oci_parse($conn, $query);
oci_set_client_identifier($conn, 'AL32UTF8');
oci_execute($statement);

$row = oci_fetch_assoc($statement);
$totalBranches = $row['TOTAL_BRANCHES'];
$totalLostSales = $row['TOTAL_LOST_SALES'];

oci_close($conn);
?>

<div class="col-md-6 col-sm-6 col-lg-6 col-xl-6">
    <div class="card dash-widget">
        <div class="card-body">
            <span class="dash-widget-icon"><i class="fa fa-building"></i></span>
            <div class="dash-widget-info">
                <h3><?php echo $totalBranches; ?></h3>
                <span>عدد الافرع</span>
            </div>
        </div>
    </div>
</div>

<div class="col-md-6 col-sm-6 col-lg-6 col-xl-6">
    <div class="card dash-widget">
        <div class="card-body">
            <span class="dash-widget-icon"><i class="fa fa-cubes"></i></span>
            <div class="dash-widget-info">
                <h3><?php echo $totalLostSales; ?></h3>
                <span>مجموع قيم المبيعات المفقودة</span>
            </div>
        </div>
    </div>
</div>
