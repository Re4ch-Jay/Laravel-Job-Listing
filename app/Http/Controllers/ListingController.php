<?php

namespace App\Http\Controllers;

use App\Models\Listing;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class ListingController extends Controller
{
    // display all 
    public function index() {
        return view('listings.index', [
            'listings' => Listing::latest()->filter(request(['tag', 'search']))->paginate(4),
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

    // show create page
    public function create() {
        return view('listings.create', [
            'title' => 'Job Listing | Create'
        ]);
    }

    // Store Listing Data
    public function store(Request $request) {
        $formFields = $request->validate([
            'title' => 'required',
            'company' => ['required', Rule::unique('listings', 'company')],
            'location' => 'required',
            'website' => 'required',
            'email' => ['required', 'email'],
            'tags' => 'required',
            'description' => 'required'
        ]);

        if($request->hasFile('logo')) {
            $formFields['logo'] = $request->file('logo')->store('logos', 'public');
        }

        Listing::create($formFields);

        return redirect('/')->with('message', 'Listing created successfully!');
    }


}
