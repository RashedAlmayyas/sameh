<?php
include './includes/config.php';

$query = "SELECT COUNT(DISTINCT GRP1_CODE) AS TOTAL_GRPS, COUNT(DISTINCT DEPT_CODE) AS TOTAL_DEPTS FROM WEB_DAILY_SALES_DEPT_VIEW";
$statement = oci_parse($conn, $query);
oci_set_client_identifier($conn, 'AL32UTF8');
oci_execute($statement);

$row = oci_fetch_assoc($statement);
$totalGroups = $row['TOTAL_GRPS'];
$totalDepts = $row['TOTAL_DEPTS'];

oci_close($conn);
?>

<div class="col-md-6 col-sm-6 col-lg-6 col-xl-6">
    <div class="card dash-widget">
        <div class="card-body">
            <span class="dash-widget-icon"><i class="fa fa-building"></i></span>
            <div class="dash-widget-info">
                <h3><?php echo $totalGroups; ?></h3>
                <span>عدد الاقسام</span>
            </div>
        </div>
    </div>
</div>

<div class="col-md-6 col-sm-6 col-lg-6 col-xl-6">
    <div class="card dash-widget">
        <div class="card-body">
            <span class="dash-widget-icon"><i class="fa fa-cubes"></i></span>
            <div class="dash-widget-info">
                <h3><?php echo $totalDepts; ?></h3>
                <span>عدد الاصناف</span>
            </div>
        </div>
    </div>
</div>
