<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Metadata Search</title>

    <!-- Bootstrap CSS for styling -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- jQuery, Bootstrap JS, and DatePicker library -->
    <link rel="stylesheet"
        href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/css/bootstrap-datepicker.min.css">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/js/bootstrap-datepicker.min.js">
    </script>
    <!-- jQuery -->

    <!-- Date Range Picker CSS and JS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.css">
    <script src="https://cdn.jsdelivr.net/npm/moment/moment.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.min.js"></script>


    <!-- DataTables CSS and JS -->
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/jquery.dataTables.min.css">
    <script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>
    <style>
    .custom-btn {
        background-color: #6c63ff;
        /* Primary background color */
        border: 2px solid #6c63ff;
        /* Border matching the background */
        color: white;
        /* White text */
        font-weight: bold;
        /* Bold text */
        padding: 10px;
        /* Adjust padding for size */
        border-radius: 8px;
        /* Smooth rounded corners */
        transition: background-color 0.3s ease, color 0.3s ease;
        /* Smooth transitions */
    }

    .custom-btn:hover {
        background-color: white;
        /* Invert background on hover */
        color: #6c63ff;
        /* Text color changes on hover */
        border-color: #6c63ff;
        /* Keep border color */
    }
    </style>
</head>

<body class="bg-light">

    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
        <div class="container-fluid">
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav"
                aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item">
                        <a class="nav-link" href="<?php echo base_url('create_user') ?>">Add New User</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="<?php echo base_url('/user/profile') ?>">Profile</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="<?php echo base_url('logout') ?>">Logout</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>
    <div class="container py-5">

        <div class="card">
            <div class="card-body">
                <h2 class="mb-4 text-center">Metadata Search</h2>

                <!-- Filter Form -->
                <form method="get" action="<?php echo base_url('song_page'); ?>">

                    <div class="row ">
                        <div class="col-md-4">
                            <label for="song_name" class="form-label">Song Name <small>(Use Comma to
                                    separate)</small></label>
                            <input type="text" name="song_name" id='song_name' class="form-control"
                                placeholder="Song Name (Use Comma to separate)">
                        </div>
                        <div class="col-md-4">
                            <label for="label_name" class="form-label">Label Name <small>(Use Comma to
                                    separate)</small></label>
                            <input type="text" name="label_name" id='label_name' class="form-control"
                                placeholder="Label Name (Use Comma to separate)">
                        </div>
                        <div class="col-md-4">
                            <label for="isrc" class="form-label">ISRC <small>(Use Comma to separate)</small></label>
                            <input type="text" name="isrc" id='isrc' class="form-control"
                                placeholder="ISRC (Use Comma to separate)">
                        </div>

                    </div>

                    <div class="row mt-2">
                        <div class="col-md-4">
                            <label for="date_range" class="form-label">Search by Date</label>
                            <input type="text" id="date_range" name="date_range" class="form-control"
                                placeholder="Select Date Range">
                        </div>
                        <div class="col-md-4">
                            <label for="status" class="form-label">Search by Status</label>
                            <select name="status" id='status' class="form-control">
                                <option value="">Select Status</option>
                                <?php foreach ($metadataStatus as $status) {?>
                                <option value="<?php echo $status['status_id']; ?>">
                                    <?php echo $status['status_name']; ?>
                                </option>
                                <?php }?>
                            </select>
                        </div>

                    </div>

                    <div class="card-footer mt-3">
                        <div class="row mt-3 justify-content-end">
                            <div class="col-md-4 d-flex align-items-end">
                                <button type="submit" class="btn custom-btn w-100">Search For Metadata</button>
                            </div>
                        </div>
                    </div>
                </form>

            </div>
            <!-- Card Footer -->

        </div>
    </div>


    <div class="container py-5">
        <h3 class="mb-4 text-center">Metadata Table</h3>
        <!-- Metadata Table -->

        <div class="d-flex justify-content-end mb-2">
            <div class="col-md-4 d-flex align-items-end">
                <button class="btn custom-btn w-50" id="exportButton">Export Data</button>


            </div>
        </div>


        <table class="table table-striped" id="metadataTable">
            <thead>
                <tr>
                    <th>Song Name</th>
                    <th>ISRC</th>
                    <th>Singer</th>
                    <th>Music Label</th>
                    <th>Status</th>
                </tr>
            </thead>
            <tbody>
                <?php if (! empty($metadata)): ?>
                <?php foreach ($metadata as $data): ?>
                <tr>
                    <td><img src="<?php echo base_url('public/img/' . esc($data['inlay_file_url'] ?? 'default.png')); ?>"
                            alt="Song Image" class="rounded-circle"
                            style="width: 50px; height: 50px; object-fit: cover; margin-right: 10px;">
                        <span><?php echo esc($data['songName']); ?></span>

                    </td>
                    <td><?php echo esc($data['isrc']); ?></td>
                    <td><?php echo esc($data['artist'] ?? 'NA'); ?></td>
                    <td><?php echo esc($data['parentLabelCompany'] ?? 'NA'); ?></td>
                    <td><?php echo esc($data['status_name']); ?></td>
                </tr>
                <?php endforeach; ?>
                <?php else: ?>
                <tr>
                    <td colspan="6">No metadata found.</td>
                </tr>

                <?php endif; ?>
            </tbody>
        </table>

        <!-- Pagination Links with Styling -->


    </div>

    <!-- Render pagination links -->

    </div>
    <script>
    var base_url = '<?php echo base_url(); ?>';

    $(document).ready(function() {
        $('#date_range').daterangepicker({
            autoUpdateInput: false, // Prevent auto-filling the input by default
            opens: 'left',
            locale: {
                format: 'YYYY-MM-DD', // Customize date format
                cancelLabel: 'Clear' // Add a clear button
            }
        });

        // Set input when a date is selected
        $('#date_range').on('apply.daterangepicker', function(ev, picker) {
            $(this).val(picker.startDate.format('YYYY-MM-DD') + ' - ' + picker.endDate.format(
                'YYYY-MM-DD'));
        });

        // Clear input when 'Clear' button is clicked
        $('#date_range').on('cancel.daterangepicker', function(ev, picker) {
            $(this).val('');
        });

        // Initialize DataTable with searchable set to false
        $('#metadataTable').DataTable({
            searching: false // Disable the search functionality
        });



        // On click of filter button, collect filter inputs and fetch data
        $('#exportButton').click(function() {
            // Collect form input values
            var song_name = $('#song_name').val();
            var label_name = $('#label_name').val();
            var isrc = $('#isrc').val();
            var status = $('#status').val();
            var date_range = $('#date_range').val();

            // Perform AJAX POST request to exportMetadata
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
                    responseType: 'blob' // Set response type to blob for file download
                },
                success: function(data) {
                    // Create a download link dynamically and download the Excel file
                    var blob = new Blob([data], {
                        type: "application/vnd.openxmlformats-officedocument.spreadsheetml.sheet"
                    });
                    var url = window.URL.createObjectURL(blob);
                    var a = document.createElement('a');
                    a.href = url;
                    a.download = 'metadata.xlsx'; // Set filename
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