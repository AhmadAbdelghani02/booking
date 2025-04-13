<?php

namespace App\Http\Controllers;

use App\Models\Room;
use App\Models\Hotel;
use App\Models\Region;
use Illuminate\Http\Request;

class AdminHotelsController extends Controller
{
    public function index(Request $request) {

        $hotels = Hotel::orderBy('created_at', 'desc')->paginate(7);
        $regions = Region::all();

        if ($request->ajax()) {
            return view('admin.hotels.table', compact('hotels', 'regions'))->render();
        }
    
        return view('admin.hotels.index', compact('hotels', 'regions'));
    
    }

    public function create() {

        return view('admin.hotels.create');

    }

    public function show($id) {
        $rooms = Room::with('hotel')->where('hotel_id', $id)->get();
        $hotel = Hotel::findOrFail($id);
        return view('admin.hotels.show', compact('rooms', "hotel"));
    }

    public function store(Request $request) {

        $validatedData = $request->validate([
            'name' => 'required|string',
            'is_featured' => 'nullable|boolean',
            'region_id' => 'required|exists:regions,id',
            'longitude' => 'required|numeric',
            'latitude' => 'required|numeric',
            'address' => 'required|string',
            'stars' => 'required|integer|between:1,5',
            'description' => 'required|string',    
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        $validatedData = $request->except('image');
        
        if ($request->hasFile('image')) {
            $validatedData['image'] = $request->file('image')->store('hotels', 'public');
        }

        Hotel::create($validatedData); // Save the order
        return redirect()->route('admin.hotels.index')->with('success', 'Hotel created successfully!');
    }

    public function edit($id)
    {
        $hotel = Hotel::findOrFail($id);
        $regions = Region::all();
   
        if (request()->ajax()) {
            // Render the edit modal view with the order data
            $view = view('admin.hotels.edit', compact('hotel', 'regions'))->render();
            return response()->json(['html' => $view]);
        }

        // Fallback: Return a full view if the request is not AJAX (optional)
        return view('admin.hotels.edit', compact('hotel', 'regions'));
    }

    public function update(Request $request, $id)
    {
        $validatedData = $request->validate([
            'name' => 'required|string',
            'address' => 'required|string',
            'is_featured' => 'nullable|boolean',
            'longitude' => 'required|numeric',
            'latitude' => 'required|numeric',
            'description' => 'required|string', 
            'region_id' => 'required|exists:regions,id',   
            'stars' => 'required|integer|between:1,5',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048'
        ], [
            'image.max' => 'Image size is too big. Maximum size is 2MB.',
            'image.mimes' => 'Image must be a file of type: jpeg, png, jpg, gif.',
            'image.image' => 'The file must be an image.',
            'image.required' => 'Image is required.',
            'name.required' => 'Name is required.',
            'address.required' => 'address is required.',
            'description.required' => 'Description is required.',
        ]);

        $validatedData = $request->except('image');

        $hotel = Hotel::findOrFail($id);
        
        if ($request->hasFile('image')) {
            $validatedData['image'] = $request->file('image')->store('hotels', 'public');
        }
        
        
        $hotel->update($validatedData);
        return redirect()->back()->with('success', 'Hotel updated successfully!');
    }

    public function destroy($id)
    {
        $hotels = Hotel::findOrFail($id);
        $hotels->delete(); // This sets the 'deleted_at' timestamp

        return redirect()->route('admin.hotels.index')->with('success', 'Hotel deleted successfully!');
    }
}