$(document).ready(function () {
    function updateData() {
        $.ajax({
            url: 'function.php',
            type: 'GET',
            dataType: 'json',
            success: function (data) {
                var newData = '';

                $.each(data, function (index, item) {
                    newData += '<p>ID: ' + item.id + ' - Content: ' + item.content + '</p>';
                });

                $('#dataContainer').html(newData);
            },
            error: function (xhr, status, error) {
                console.error('Error fetching data: ' + status + ' - ' + error);
            }
        });
    }

    updateData();

    setInterval(updateData, 5000);
});
