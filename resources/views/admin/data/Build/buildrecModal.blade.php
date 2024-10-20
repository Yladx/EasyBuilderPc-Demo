
<style>
    .selected-tag {
        display: inline-block;
        margin: 5px;
        padding: 5px;
        border: 1px solid #007bff;
        border-radius: 5px;
        background-color: #e9ecef;
    }
</style>


<div class="modal fade" id="buildrecommendModal" tabindex="-1" aria-labelledby="createBuildLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="createBuildLabel">Create a New PC Build</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form action="{{ route('builds.store') }}" method="POST">
                    @csrf

                    <!-- Build Name -->
                    <div class="mb-3">
                        <label for="build_name" class="form-label">Build Name</label>
                        <input type="text" class="form-control" id="build_name" name="build_name" required>
                    </div>

                    <div class="mb-3">
                        <label for="tag" class="form-label">Tags</label>
                        <input type="text" class="form-control" id="tag" value="Recommended" name="tag" required readonly>
                    </div>

                    <div id="selected-tags-container"></div>

                    <div class="mb-3">
                        <label class="form-label">Select Tags</label>
                        <div id="checkbox-container">
                            <div class="form-check">
                                <input type="checkbox" class="form-check-input" id="checkbox-Gaming" value="Gaming" onchange="updateTags()">
                                <label class="form-check-label" for="checkbox-Gaming">Gaming</label>
                            </div>
                            <div class="form-check">
                                <input type="checkbox" class="form-check-input" id="checkbox-Office" value="Office" onchange="updateTags()">
                                <label class="form-check-label" for="checkbox-Office">Office</label>
                            </div>
                            <div class="form-check">
                                <input type="checkbox" class="form-check-input" id="checkbox-School" value="School" onchange="updateTags()">
                                <label class="form-check-label" for="checkbox-School">School</label>
                            </div>
                        </div>
                    </div>


                    <div class="mb-3">
                        <label for="total_tdp" class="form-label">Total TDP</label>
                        <input type="text" class="form-control" id="total_tdp" name="total_tdp" value="0" readonly>
                    </div>

                    <!-- Motherboard Selection -->
                    <div class="mb-3" id="motherboardDiv">
                        <label for="motherboard_id" class="form-label">Motherboard</label>
                        <select class="form-select" id="motherboard_id" name="motherboard_id" required>
                            <option value="" selected disabled>Select a Motherboard</option>
                            @foreach ($motherboards as $motherboard)
                                <option value="{{ $motherboard->id }}">{{ $motherboard->name }}</option>
                            @endforeach
                        </select>
                    </div>

                    <!-- CPU Selection -->
                    <div class="mb-3" id="cpuDiv" style="display: none;">
                        <label for="cpu_id" class="form-label">CPU</label>
                        <select class="form-select" id="cpu_id" name="cpu_id" required>
                            <option value="" selected disabled>Select a CPU</option>
                        </select>
                    </div>

                    <!-- GPU Selection -->
                    <div class="mb-3" id="gpuDiv" style="display: none;">
                        <label for="gpu_id" class="form-label">GPU</label>
                        <select class="form-select" id="gpu_id" name="gpu_id" required>
                            <option value="" selected disabled>Select a GPU</option>
                        </select>
                    </div>

                    <!-- RAM Selection -->
                    <div class="mb-3" id="ramDiv" style="display: none;">
                        <label for="ram_id" class="form-label">RAM</label>
                        <select class="form-select" id="ram_id" name="ram_id" required>
                            <option value="" selected disabled>Select RAM</option>
                        </select>
                    </div>

                    <!-- Storage Selection -->
                    <div class="mb-3" id="storageDiv" style="display: none;">
                        <label for="storage_id" class="form-label">Storage</label>
                        <select class="form-select" id="storage_id" name="storage_id" required>
                            <option value="" selected disabled>Select Storage</option>
                        </select>
                    </div>

                    <!-- Power Supply Selection -->
                    <div class="mb-3">
                        <label for="power_supply_id" class="form-label">Power Supply</label>
                        <select class="form-select" id="power_supply_id" name="power_supply_id" required>
                            <option value="" selected disabled>Select a Power Supply</option>
                            @foreach ($powerSupplies as $powerSupply)
                                <option value="{{ $powerSupply->id }}">{{ $powerSupply->name }}</option>
                            @endforeach
                        </select>
                    </div>

                    <!-- Computer Case Selection -->
                    <div class="mb-3" id="caseDiv" style="display: none;">
                        <label for="case_id" class="form-label">Computer Case</label>
                        <select class="form-select" id="case_id" name="case_id" required>
                            <option value="" selected disabled>Select a Computer Case</option>
                        </select>
                    </div>

                    <!-- Accessories -->
                    <div class="mb-3">
                        <label for="accessories" class="form-label">Accessories</label>
                        <textarea class="form-control" id="accessories" name="accessories" rows="3"></textarea>
                    </div>

                    <!-- Published Checkbox -->
 <div class="mb-3 form-check">
    <input type="checkbox" class="form-check-input" id="published" name="published" value="1" >

    <label class="form-check-label" for="published">: Published your Build</label>

</div>


                    <button type="submit" class="btn btn-primary">Create Build</button>
                </form>
            </div>
        </div>
    </div>
</div>
<script>

document.getElementById('motherboard_id').addEventListener('change', function() {
    const motherboardId = this.value;

    // Fetch compatible CPUs
    fetch(`/api/compatible-cpus/${motherboardId}`)
        .then(response => response.json())
        .then(data => {
            const cpuSelect = document.getElementById('cpu_id');
            cpuSelect.innerHTML = '<option value="" selected disabled>Select a CPU</option>';
            data.forEach(cpu => {
                cpuSelect.innerHTML += `<option value="${cpu.id}">${cpu.name}</option>`;
            });
            document.getElementById('cpuDiv').style.display = 'block'; // Show CPU selection
        });

    // Fetch compatible GPUs
    fetch(`/api/compatible-gpus/${motherboardId}`)
        .then(response => response.json())
        .then(data => {
            const gpuSelect = document.getElementById('gpu_id');
            gpuSelect.innerHTML = '<option value="" selected disabled>Select a GPU</option>';
            data.forEach(gpu => {
                gpuSelect.innerHTML += `<option value="${gpu.id}">${gpu.name}</option>`;
            });
            document.getElementById('gpuDiv').style.display = 'block'; // Show GPU selection
        });

    // Fetch compatible RAMs
    fetch(`/api/compatible-rams/${motherboardId}`)
        .then(response => response.json())
        .then(data => {
            const ramSelect = document.getElementById('ram_id');
            ramSelect.innerHTML = '<option value="" selected disabled>Select RAM</option>';
            data.forEach(ram => {
                ramSelect.innerHTML += `<option value="${ram.id}">${ram.name}</option>`;
            });
            document.getElementById('ramDiv').style.display = 'block'; // Show RAM selection
        });

    // Fetch compatible Storages
    fetch(`/api/compatible-storages/${motherboardId}`)
        .then(response => response.json())
        .then(data => {
            const storageSelect = document.getElementById('storage_id');
            storageSelect.innerHTML = '<option value="" selected disabled>Select Storage</option>';
            data.forEach(storage => {
                storageSelect.innerHTML += `<option value="${storage.id}">${storage.name}</option>`;
            });
            document.getElementById('storageDiv').style.display = 'block'; // Show Storage selection
        });
});

// Add an event listener for the GPU selection to fetch compatible cases
document.getElementById('gpu_id').addEventListener('change', function() {
    const motherboardId = document.getElementById('motherboard_id').value;
    const gpuId = this.value; // Get the selected GPU ID

    // Ensure that both motherboard and GPU are selected before fetching compatible cases
    if (motherboardId && gpuId) {
        fetch(`/api/compatible-cases/${motherboardId}/${gpuId}`)
            .then(response => response.json())
            .then(data => {
                const caseSelect = document.getElementById('case_id');
                caseSelect.innerHTML = '<option value="" selected disabled>Select a Computer Case</option>';

                data.forEach(computerCase => {
                    caseSelect.innerHTML += `<option value="${computerCase.id}">${computerCase.name}</option>`;
                });

                document.getElementById('caseDiv').style.display = 'block'; // Show Case selection
            })
            .catch(error => {
                console.error('Error fetching compatible cases:', error);
            });
    } else {
        document.getElementById('caseDiv').style.display = 'none'; // Hide case selection if conditions are not met
    }
});

// Add event listener for the CPU selection to fetch compatible power supplies
document.getElementById('cpu_id').addEventListener('change', fetchCompatiblePowerSupplies);
document.getElementById('gpu_id').addEventListener('change', fetchCompatiblePowerSupplies);
document.getElementById('ram_id').addEventListener('change', fetchCompatiblePowerSupplies);
document.getElementById('storage_id').addEventListener('change', fetchCompatiblePowerSupplies);
</script>

    </script>



<script>
    const selectedTags = new Set(['Recommended']); // Initialize with the default tag

    function updateTags() {
        const tagInput = document.getElementById('tag');
        const selectedTagsContainer = document.getElementById('selected-tags-container');

        // Clear previous tags, but keep the "Recommended" tag
        selectedTagsContainer.innerHTML = '<div class="selected-tag">Recommended</div>';

        // Get all checkboxes
        const checkboxes = document.querySelectorAll('#checkbox-container input[type="checkbox"]');

        // Iterate through checkboxes to get checked values
        checkboxes.forEach(checkbox => {
            if (checkbox.checked) {
                selectedTags.add(checkbox.value); // Add to the Set
                checkbox.parentElement.style.display = 'none'; // Hide checkbox if selected
            } else {
                checkbox.parentElement.style.display = ''; // Show checkbox if not selected
            }
        });

        // Update the input field with selected tags, excluding "Recommended"
        tagInput.value = Array.from(selectedTags).join(','); // Join tags with commas without spaces

        // Display selected tags with remove buttons, excluding "Recommended"
        selectedTags.forEach(tag => {
            if (tag !== 'Recommended') {
                const tagElement = document.createElement('div');
                tagElement.className = 'selected-tag';
                tagElement.id = `selected-${tag}`; // Assign a unique ID for removal

                const tagText = document.createTextNode(tag);
                const removeButton = document.createElement('button');
                removeButton.innerText = 'x'; // Remove button
                removeButton.className = 'btn btn-danger btn-sm ml-2';
                removeButton.onclick = function () {
                    selectedTags.delete(tag); // Remove from Set
                    const checkbox = document.getElementById(`checkbox-${tag}`);

                    // Show the checkbox again
                    checkbox.parentElement.style.display = ''; // Show checkbox again
                    checkbox.checked = false; // Uncheck the checkbox

                    // Update the input field
                    tagInput.value = Array.from(selectedTags).join(','); // Update input with remaining tags
                    tagElement.remove(); // Remove tag element from display
                };

                tagElement.appendChild(tagText);
                tagElement.appendChild(removeButton);
                selectedTagsContainer.appendChild(tagElement);
            }
        });
    }

    // Set published value based on checkbox state
    function setPublishedValue(checkbox) {
        const value = checkbox.checked ? '1' : '0';
        // Optionally, you can set a hidden input to send this value
        const publishedInput = document.createElement('input');
        publishedInput.type = 'hidden';
        publishedInput.name = 'published';
        publishedInput.value = value;

        // Check if the input already exists and remove it if needed
        const existingInput = document.querySelector('input[name="published"]');
        if (existingInput) {
            existingInput.remove();
        }
        document.querySelector('form').appendChild(publishedInput);
    }
</script>

