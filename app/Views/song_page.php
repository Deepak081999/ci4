<?php include 'common/header.php'; ?>

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

<?php include 'common/footer.php'; ?>