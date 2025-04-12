<div class="modal fade" id="createHotelModal" tabindex="-1" aria-labelledby="createHotelModal" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="createHotelModal">
                    <i class="bi bi-building-add"></i>
                    Add New Hotel
                </h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                @if ($errors->any())
                        <div class="alert alert-danger">
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                @endif
                <form action="{{ route('admin.hotels.store') }}" method="POST" enctype="multipart/form-data" >
                    @csrf

                      
                    <div class="mb-3">
                        <label for="name" class="form-label">Featured Hotel:</label><br>
                        <div class="d-flex gap-4">
                            <input type="radio" class="form-check-input" id="yes" name="is_featured" required value="1"> Yes</input>
                            <input type="radio" class="form-check-input" id="no" name="is_featured" required value="0"> No</input>
                        </div>
                    </div>
                    <div class="mb-3">
                        <label for="name" class="form-label">Name</label>
                        <input type="text" step="any" class="form-control" id="name" name="name" required placeholder="Enter the hotel name" 
                        value="{{ old('name') }}">
                    </div>
                    <div class="mb-3">
                        <label for="region_id" class="form-label">City\Area</label>
                        <select class="form-select" id="region_id" name="region_id" required>
                                <option value="{{ old('region_id') }}" disabled selected>-- Select the city\area --</option>
                                @foreach ($regions as $region)
                                    <option value="{{ $region->id }}" {{ old('region_id') == $region->id ? 'selected' : '' }}>
                                        {{ $region->name }}
                                    </option>
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
                        value="{{ old('address') }}"></input>
                    </div>
                    <div class="mb-3">
                        <label for="description" class="form-label">Description</label>
                        <input type="text" class="form-control" id="description" name="description" required
                        placeholder="Enter the description">
                    </div>
                    <div class="mb-3">
                        <label for="longitude" class="form-label">Longitude</label>
                        <input type="number" step="any" class="form-control" id="longitude" name="longitude" required placeholder="Enter the hotel name" 
                        value="{{ old('longitude') }}">
                    </div>
                    <div class="mb-3">
                        <label for="latitude" class="form-label">Latitude</label>
                        <input type="number" step="any" class="form-control" id="latitude" name="latitude" required placeholder="Enter the hotel name" 
                        value="{{ old('latitude') }}">
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
                    <div class="d-flex gap-2 justify-content-end align-items-center">
                        <button type="submit" class="btn btn-primary">Create Hotel</button>
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>