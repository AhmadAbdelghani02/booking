<div class="modal fade" id="editHotelModal" tabindex="-1" aria-labelledby="editHotelLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            @if(isset($hotel))
            <form id="editHotelForm" action="{{ route('admin.hotels.update', $hotel->id) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                <div class="modal-header">
                    <h5 class="modal-title" id="editHotelLabel">
                        <i class="bi bi-pencil"></i>
                        Edit "{{ $hotel->name }}"</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="mb-3">
                        <label for="is_featured" class="form-label">Featured Hotel:</label><br>
                        <div class="d-flex gap-4">
                            <input type="radio" class="form-check-input" id="yes" name="is_featured" value="1"> Yes</input>
                            <input type="radio" class="form-check-input" id="no" name="is_featured" value="0"> No</input>
                        </div>
                    </div>
                    <div class="mb-3">
                        <label for="name" class="form-label">Name</label>
                        <input type="text" step="any" class="form-control" id="name" name="name" required placeholder="Enter the hotel name" 
                        value="{{ $hotel->name }}">
                    </div>
                    <div class="mb-3">
                        <label for="region_id" class="form-label">City\Area</label>
                        <select class="form-select" id="region_id" name="region_id" required>
                                <option value="{{ $hotel->region_id ?? '' }}"  selected>{{ $hotel->region->name ?? 'No City Assigned'}}</option>
                                @foreach ($regions as $region)
                                    @if ($region->id != $hotel->region_id)
                                    <option value="{{ $region->id }}" {{ old('region_id') == $region->id ? 'selected' : '' }}>
                                        {{ $region->name }}
                                    </option>
                                    @endif
                                @endforeach
                        </select>
                    </div> 
                    <div class="mb-3">
                        <label for="stars" class="form-label">Hotel's Stars</label>
                        <select class="form-select" id="stars" name="stars" required>
                            <option value="{{ old('stars') }}" disabled selected>-- Select the stars rating --</option>
                            <option value="1" {{ old('stars') == 1 ? 'selected' : '' }}>1 Star</option>
                            <option value="2" {{ old('stars') == 2 ? 'selected' : '' }}>2 Stars</option>
                            <option value="3" {{ old('stars') == 3 ? 'selected' : '' }}>3 Stars</option>
                            <option value="4" {{ old('stars') == 4 ? 'selected' : '' }}>4 Stars</option>
                            <option value="5" {{ old('stars') == 5 ? 'selected' : '' }}>5 Stars</option>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="address" class="form-label">address</label>
                        <input  type="text" class="form-control" id="address" name="address" required
                        placeholder="Enter the hotel address"
                        value="{{ $hotel->address }}"></input>
                    </div>
                    <div class="mb-3">
                        <label for="description" class="form-label">Description</label>
                        <textarea class="form-control" id="description" name="description" required
                        placeholder="Enter the description">{{ $hotel->description }}</textarea>
                    </div>
                    <div class="mb-3">
                        <label for="longitude" class="form-label">Longitude</label>
                        <input type="number" step="any" class="form-control" id="longitude" name="longitude" required placeholder="Enter the hotel name" 
                        value="{{ $hotel->longitude }}">
                    </div>
                    <div class="mb-3">
                        <label for="latitude" class="form-label">Latitude</label>
                        <input type="number" step="any" class="form-control" id="latitude" name="latitude" required placeholder="Enter the hotel name" 
                        value="{{ $hotel->latitude }}">
                    </div>
                    <div class="mb-3">
                        <label for="image" class="form-label">Hotel Picture</label>
                        <input 
                        type="file" 
                        class="form-control" 
                        id="image" 
                        name="image" 
                        accept=".jpeg,.jpg,.png" 
                        >
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary">Update Hotel</button>
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                </div>
            </form>
            @else
                <p>No Hotels available to edit.</p>
            @endif
        </div>
    </div>
</div>