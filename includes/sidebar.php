<?php
include 'config.php';
$userID = $_SESSION['user_id'];
$username = $_SESSION['username'];

oci_set_client_identifier($conn, 'AL32UTF8');

$sql = '
    SELECT WP.WEB_PAGE_DESC_A AS PARENT_DESC, WP.WEB_PAGE_ID AS PARENT_ID, WC.WEB_PAGE_DESC_A AS CHILD_DESC, WC.WEB_PAGE_ID AS CHILD_ID
    FROM WEB_USER_PROGRAMS_VIEW WP
    LEFT JOIN WEB_USER_PROGRAMS_VIEW WC ON WC.PARENT_WEB_PROG_ID = WP.WEB_PROG_ID
    WHERE WC.WEB_USER_ID = :userID AND WP.WEB_USER_ID = :userID
    ORDER BY WP.WEB_PAGE_ID, WC.WEB_PAGE_ID
';

$stid = oci_parse($conn, $sql);

oci_bind_by_name($stid, ':userID', $userID);

oci_execute($stid);

echo '<div class="sidebar" id="sidebar">';
echo '    <div class="sidbar">';
echo '        <div class="sidebar-inner slimscroll">';
echo '            <div id="sidebar-menu" class="sidebar-menu">';

echo '      <ul>';
echo '    <li> 
<a href="dashboard.php"><i class="la la-dashboard"></i> <span>لوحة التحكم</span></a>
</li>           ';

$currentParent = null;

while ($row = oci_fetch_assoc($stid)) {
    $parentDesc = iconv('WINDOWS-1256', 'UTF-8', $row['PARENT_DESC']);
    $childDesc = iconv('WINDOWS-1256', 'UTF-8', $row['CHILD_DESC']);
    $parentID = $row['PARENT_ID'];
    $childID = $row['CHILD_ID'];

    if ($currentParent !== $parentDesc) {
        if ($currentParent !== null) {
            echo '                        </ul>';
            echo '                    </li>';
        }

        echo '                    <li class="submenu">';
        echo '                        <a href="#"><i class="la la-files-o"></i> <span>' . htmlspecialchars($parentDesc, ENT_QUOTES, 'UTF-8') . '</span> <span class="menu-arrow"></span></a>';
        echo '                        <ul style="display: none;">';
    }

    echo '<li><a href="' . urlencode($childID) . '?base64_encode(childID=' . urlencode($childID) . '&childDesc=' . urlencode($childDesc) . '">' . htmlspecialchars($childDesc, ENT_QUOTES, 'UTF-8') . '</a></li>';

    $currentParent = $parentDesc;
}

if ($currentParent !== null) {
    echo '                        </ul>';
    echo '                    </li>';
}

echo '                </ul>';
echo '            </div>';
echo '        </div>';
echo '    </div>';
echo '</div>';

oci_free_statement($stid);
oci_close($conn);
?>
