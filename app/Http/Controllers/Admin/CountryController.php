<?php

namespace App\Http\Controllers\Admin;

use App\Models\Country;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use App\Http\Requests\CountryRequest;

class CountryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data = Country::all();
        return view ('admin.country.country', compact('data'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.country.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(CountryRequest $request)
    {
        $country = new Country();
        $country->name = $request->input('name');
        $country->save();
        return redirect('/admin/country/')->with('success', 'Country created successfully.');
    }

    public function delete($id)
    {
        Country::destroy($id);
        return redirect('/admin/country/')->with('success', 'Country deleted successfully.');
    }
}
