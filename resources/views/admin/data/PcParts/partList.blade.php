<!-- Dropdown to select the component -->
<div class="form-group">
    <label for="componentType">Select Component:</label>
    <select class="form-control" id="componentType">
        <option value="">-- Select Component --</option>
        <option value="cpus">CPUs</option>
        <option value="gpus">GPUs</option>
        <option value="motherboards">Motherboards</option>
        <option value="rams">RAMs</option>
        <option value="storages">Storages</option>
        <option value="power_supplies">Power Supplies</option>
        <option value="cases">Cases</option>
    </select>
</div>

<!-- Table to display the component data -->
<table class="table table-bordered" id="componentTable" style="display:none;">
    <thead id="componentTableHead">
        <!-- Dynamic table header will be populated here -->
    </thead>
    <tbody id="componentTableBody">
        <!-- Dynamic table body will be populated here -->
    </tbody>
</table>


<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

<script type="text/javascript">
  $(document).ready(function () {
    $('#componentType').on('change', function () {
        var componentType = $(this).val();

        if (componentType !== '') {
            $.ajax({
                url: '/get-component-data',
                type: 'POST',
                data: {
                    componentType: componentType,
                    _token: '{{ csrf_token() }}' // Include CSRF token for security
                },
                success: function (response) {
                    if (response.columns && response.data) {
                        // Show the table
                        $('#componentTable').show();

                        // Clear the table head and body
                        $('#componentTableHead').empty();
                        $('#componentTableBody').empty();

                        // Add 'Action' column for edit/delete buttons
                        response.columns.push('Action');

                        // Populate the table header
                        var headerRow = '<tr>';
                        response.columns.forEach(function (column) {
                            headerRow += '<th>' + column + '</th>';
                        });
                        headerRow += '</tr>';
                        $('#componentTableHead').append(headerRow);

                        // Populate the table body
                        response.data.forEach(function (row) {
                            var bodyRow = '<tr>';
                            response.columns.forEach(function (column) {
                                if (column !== 'Action') {
                                    bodyRow += '<td>' + (row[column] !== null ? row[column] : '') + '</td>';
                                }
                            });

                            // Add Edit and Delete buttons for each row
                            bodyRow += '<td>';
                            bodyRow += '<button class="btn btn-primary btn-sm edit-btn" data-id="' + row.id + '">Edit</button> ';
                            bodyRow += '<button class="btn btn-danger btn-sm delete-btn" data-id="' + row.id + '">Delete</button>';
                            bodyRow += '</td>';

                            bodyRow += '</tr>';
                            $('#componentTableBody').append(bodyRow);
                        });

                        // Add click event handlers for Edit and Delete buttons
                        $('.edit-btn').on('click', function () {
                            var id = $(this).data('id');
                            // Redirect to the edit page (you can customize this URL)
                            window.location.href = '/component/' + componentType + '/' + id + '/edit';
                        });

                        $('.delete-btn').on('click', function () {
                            var id = $(this).data('id');
                            if (confirm('Are you sure you want to delete this item?')) {
                                // Perform delete action (make an AJAX request or redirect)
                                $.ajax({
                                    url: '/component/' + componentType + '/' + id + '/delete',
                                    type: 'DELETE',
                                    data: { _token: '{{ csrf_token() }}' },
                                    success: function (result) {
                                        alert('Item deleted successfully');
                                        // Optionally, refresh the table or remove the deleted row
                                        $('#componentType').trigger('change');
                                    },
                                    error: function (error) {
                                        console.log('Error:', error);
                                    }
                                });
                            }
                        });
                    } else {
                        $('#componentTable').hide();
                    }
                },
                error: function (error) {
                    console.log('Error:', error);
                }
            });
        } else {
            $('#componentTable').hide();
        }
    });
});

</script>
