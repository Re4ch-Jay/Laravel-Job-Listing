<?php

namespace App\Http\Controllers;

use App\Models\Listing;
use Illuminate\Validation\Rule;

class ListingController extends Controller
{
    // display all 
    public function index() {
        return view('listings.index', [
            'listings' => Listing::latest()->filter(request(['tag', 'search']))->get(),
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

    // store data in to db
    public function store() {
        $formFields = request()->validate([
            'title' => 'required',
            'company' => ['required', Rule::unique('listings', 'company')], // table and column
            'location' => 'required',
            'website' => 'required',
            'email' => ['required', 'email'],
            'tags' => 'required',
            'description' => 'required',
        ]);

        Listing::create($formFields);
        
        return redirect('/');
    }

}
