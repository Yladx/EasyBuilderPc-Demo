<p><strong>Build Name:</strong> {{ $buildinfo->build_name }}</p>
<p><strong>Tag:</strong> {{ $buildinfo->tag }}</p>
<p><strong>Description:</strong> {{ $buildinfo->build_note }}</p>
<p><strong>User ID:</strong> {{ $buildinfo->user->name ?? 'N/A' }}</p>

<p><strong>Average Rating:</strong> {{ $averageRating ? number_format($averageRating, 2) : 'No ratings yet' }}</p>

@if(auth()->check())
    @if($userHasRated)
        <p>You already rated this build: {{ $userRating }} stars</p>
    @else
        <button class="btn btn-primary" id="rateNowBtn">Rate Now</button>

        <div class="card card-body d-none mt-3" id="ratingForm">
            <h5>Rate this Build</h5>
            <form method="POST" action="{{ route('rate.build') }}">
                @csrf
                <input type="hidden" name="build_id" value="{{ $buildinfo->id }}"> <!-- Assuming you have a $build variable with the build object -->
                <div class="mb-3">
                    <label class="form-label">Select Rating</label>
                    <div class="form-check-inline">
                        @for($i = 1; $i <= 5; $i++)
                            <input class="form-check-input" type="radio" name="rating" id="rating{{ $i }}" value="{{ $i }}">
                            <label class="form-check-label" for="rating{{ $i }}">{{ $i }}</label>
                        @endfor
                    </div>
                </div>
                <button type="submit" class="btn btn-success">Submit Rating</button>
            </form>

        </div>
    @endif
@else
    <p><a href="{{ route('login') }}" class="btn btn-warning">Login to rate this build</a></p>
@endif

<!-- Collapsible sections for each part -->
<div class="accordion mt-3" id="buildDetailsAccordion">
    @foreach(['gpu', 'cpu', 'motherboard', 'ram', 'storage', 'powerSupply', 'pcCase'] as $component)
        <div class="accordion-item">
            <h2 class="accordion-header" id="heading{{ ucfirst($component) }}">
                <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#collapse{{ ucfirst($component) }}" aria-expanded="true" aria-controls="collapse{{ ucfirst($component) }}">
                    <strong>{{ ucfirst($component) }}:</strong> {{ $buildinfo->$component->name ?? 'N/A' }}
                </button>
            </h2>
            <div id="collapse{{ ucfirst($component) }}" class="accordion-collapse collapse" aria-labelledby="heading{{ ucfirst($component) }}" data-bs-parent="#buildDetailsAccordion">
                <div class="accordion-body">
                    @foreach($buildinfo->$component->getFillable() as $attr)
                    @if(!in_array($attr, ['name', 'id', 'image'])) <!-- Exclude name, id, and image -->
                        <strong>{{ ucfirst(str_replace('_', ' ', $attr)) }}:</strong> {{ $buildinfo->$component->$attr ?? 'N/A' }}<br>
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
                <strong>Accessories:</strong> {{ $buildinfo->accessories ?? 'N/A' }}
            </button>
        </h2>
        <div id="collapseAccessories" class="accordion-collapse collapse" aria-labelledby="headingAccessories" data-bs-parent="#buildDetailsAccordion">
            <div class="accordion-body">
                Some additional Accessories information here.
            </div>
        </div>
    </div>
</div>


