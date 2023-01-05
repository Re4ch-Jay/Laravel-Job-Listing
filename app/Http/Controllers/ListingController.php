<?php

namespace App\Http\Controllers;

use App\Models\Listing;
use Illuminate\Http\Request;

class ListingController extends Controller
{
    // display all 
    public function index(Request $request) {
        dd($request);
        return view('listings.index', [
            'listings' => Listing::all(),
            'title' => 'Job Listing | Home'
        ]);
    }

    // display single 
    public function show($id) {
        $listing = Listing::find($id);

        if($listing) {
            return view('listings.show', [
                'listing' => Listing::find($id),
                'title' => 'Job Listing | Details'
            ]);
        }else{
            abort('404');
        }
    }
}
