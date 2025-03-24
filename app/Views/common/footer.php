<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/js/bootstrap-datepicker.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/moment/moment.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.min.js"></script>
<script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>

<script>
var base_url = '<?php echo base_url(); ?>';

function validateImageSize(input) {
    const file = input.files[0]; // Get the uploaded file

    if (file) {
        const img = new Image();
        img.src = URL.createObjectURL(file); // Create a temporary object URL for the file

        img.onload = function() {
            console.log("Width: ", img.width, "Height: ", img.height); // Debugging output

            // Validate the width and height to be exactly 200x200 pixels
            if (img.width >= 200 && img.height >= 200) {
                alert("Image must be exactly 200x200 pixels. " +
                    "Your image dimensions are: " + img.width + "x" + img.height + " pixels.");

                input.value = ''; // Clear the input if validation fails
            }
        };
    }
}

$(document).ready(function() {
    $('#date_range').daterangepicker({
        autoUpdateInput: false,
        opens: 'left',
        locale: {
            format: 'YYYY-MM-DD',
            cancelLabel: 'Clear'
        }
    });

    $('#date_range').on('apply.daterangepicker', function(ev, picker) {
        $(this).val(picker.startDate.format('YYYY-MM-DD') + ' - ' + picker.endDate.format(
            'YYYY-MM-DD'));
    });

    $('#date_range').on('cancel.daterangepicker', function(ev, picker) {
        $(this).val('');
    });

    $('#metadataTable').DataTable({
        searching: false
    });

    $('#exportButton').click(function() {
        var song_name = $('#song_name').val();
        var label_name = $('#label_name').val();
        var isrc = $('#isrc').val();
        var status = $('#status').val();
        var date_range = $('#date_range').val();

        $.ajax({
            url: base_url + 'exportMetadata',
            type: "POST",
            data: {
                song_name: song_name,
                label_name: label_name,
                isrc: isrc,
                status: status,
                date_range: date_range
            },
            xhrFields: {
                responseType: 'blob'
            },
            success: function(data) {
                var blob = new Blob([data], {
                    type: "application/vnd.openxmlformats-officedocument.spreadsheetml.sheet"
                });
                var url = window.URL.createObjectURL(blob);
                var a = document.createElement('a');
                a.href = url;
                a.download = 'metadata.xlsx';
                document.body.appendChild(a);
                a.click();
                a.remove();
                window.URL.revokeObjectURL(url);
            },
            error: function(xhr, status, error) {
                console.error('Error exporting Excel:', error);
            }
        });
    });
});
</script>

</body>

</html>