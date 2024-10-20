<!-- user.BuildDetails.blade.php -->
<form action="{{ route('builds.update', $userbuildinfo->id) }}" method="POST">
    @csrf
    @method('PUT')

    <div>
        <p>
            <strong>Build Name:</strong>
            <input type="text" id="buildName" name="build_name" class="form-control" value="{{ $userbuildinfo->build_name }}" readonly>
        </p>

        <p>
            <strong>Tag:</strong>
            <input type="text" id="tag" name="tag" class="form-control" value="{{ $userbuildinfo->tag }}" readonly>
        </p>

        <p>
            <strong>Description:</strong>
            <textarea id="buildNote" name="build_note" class="form-control" readonly>{{ $userbuildinfo->build_note }}</textarea>
        </p>

        <p>
            <strong>Published:</strong>
            <input type="hidden" name="is_published" value="0"> <!-- Hidden input for unchecked state -->
            <input type="checkbox" id="isPublished" name="is_published" value="1" {{ $userbuildinfo->published ? 'checked' : '' }} disabled>
        </p>
            </div>


<!-- Collapsible sections for each part -->
<div class="accordion mt-3" id="buildDetailsAccordion">
    @foreach(['gpu', 'cpu', 'motherboard', 'ram', 'storage', 'powerSupply', 'pcCase'] as $component)
        <div class="accordion-item">
            <h2 class="accordion-header" id="heading{{ ucfirst($component) }}">
                <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#collapse{{ ucfirst($component) }}" aria-expanded="true" aria-controls="collapse{{ ucfirst($component) }}">
                    <strong>{{ ucfirst($component) }}:</strong> {{ $userbuildinfo->$component->name ?? 'N/A' }}
                </button>
            </h2>
            <div id="collapse{{ ucfirst($component) }}" class="accordion-collapse collapse" aria-labelledby="heading{{ ucfirst($component) }}" data-bs-parent="#buildDetailsAccordion">
                <div class="accordion-body">
                    @foreach($userbuildinfo->$component->getFillable() as $attr)
                    @if(!in_array($attr, ['name', 'id', 'image'])) <!-- Exclude name, id, and image -->
                        <strong>{{ ucfirst(str_replace('_', ' ', $attr)) }}:</strong> {{ $userbuildinfo->$component->$attr ?? 'N/A' }}<br>
                    @endif
                @endforeach

                </div>
            </div>
        </div>
    @endforeach

               <!-- Accessories Section -->
    <div class="accordion-item">
        <h2 class="accordion-header" id="headingAccessories">
            <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#collapseAccessories" aria-expanded="true" aria-controls="collapseAccessories">
                <strong>Accessories:</strong> {{ $userbuildinfo->accessories ?? 'N/A' }}
            </button>
        </h2>
        <div id="collapseAccessories" class="accordion-collapse collapse" aria-labelledby="headingAccessories" data-bs-parent="#buildDetailsAccordion">
            <div class="accordion-body">
                Some additional Accessories information here.
            </div>
        </div>
    </div>
</div>

    <!-- Modal Footer -->
    <div class="modal-footer">
        <button type="button" class="btn btn-secondary" id="editButton">Edit</button>
        <button type="submit" class="btn btn-success d-none" id="saveButton">Save</button>
    </div>
</form>

