<?php

namespace App\Http\Controllers\Api\v1;

use App\Http\Resources\PropertyResource;
use App\Models\property;
use App\Http\Controllers\Controller;
use App\Http\Requests\StorepropertyRequest;
use App\Http\Requests\UpdatepropertyRequest;
use Illuminate\Http\Request;

class PropertyController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return PropertyResource::collection(property::all());
    }


    /**
     * Store a newly created resource in storage.
     */
    public function store(StorepropertyRequest $request)
    {
      $property = property::create($request->validated());

      return PropertyResource::make( $property);
    }

    /**
     * Display the specified resource.
     */
    public function show(property $property)
    {
        return PropertyResource::make($property);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(property $property)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdatepropertyRequest $request, property $property)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(property $property)
    {
        //
    }

    public function filterByType($type)
    {
        $properties = property::where('type', $type)->get();
        return PropertyResource::collection($properties);
    }

    public function search(Request $request)
    {
        $query = property::query();
        if ($request->has('type')) {
          $query->where('type', $request->input('type'));
        }
    
        if ($request->has('price_min')) {
            $query->where('price', '>=', $request->input('price_min'));
        }
    
        if ($request->has('price_max')) {
            $query->where('price', '<=', $request->input('price_max'));
        }

            
        if ($request->has('size_min')) {
          $query->where('size', '>=', $request->input('size_min'));
        }
    
        if ($request->has('size_max')) {
            $query->where('size', '<=', $request->input('size_max'));
        }
    
        if ($request->has('location')) {
            $query->where('address', 'like', '%' . $request->input('location') . '%');
        }
    
        if ($request->has('bedrooms')) {
            $query->where('number_of_bedrooms', $request->input('bedrooms'));
        }
        
        if ($request->has('geolat') || $request->has('geolng')) {
          if (!$request->has('geolng') || !$request->has('geolat') || !$request->has('radius')) {
              return response()->json([
                  'error' => 'geolng, geolat and radius must be specified altogether.'
              ], 400);
          }
        }

        if ($request->has('geolat') && $request->has('geolng') && $request->has('radius')) {
          $geolat = $request->input('geolat');
          $geolng = $request->input('geolng');
          $radius = $request->input('radius');

          $query->whereRaw(
            "ST_Distance_Sphere(POINT(geolng, geolat), POINT(?, ?)) <= ?",
            [$geolng, $geolat, $radius]
          );
        
       }
    
        $properties = $query->get();
    
        return PropertyResource::collection($properties);
    }

}
