<?php

namespace App\Http\Controllers;

use App\Models\Taxonomy;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Inertia\Inertia;
use Inertia\Response;

class TaxonomyController extends Controller
{
    //
    public function index(): Response
    {
        return Inertia::render('Taxonomy/Index', [
            'taxonomies' => Taxonomy::all(),
        ]);
    }

    public function create(): Response
    {
        return Inertia::render('Taxonomy/Create');
    }

    public function store(Request $request)
    {

        $request->merge(['slug' => Str::slug($request->slug)]);

        $request->validate([
            'name' => 'required|string|max:255',
            'slug' => 'required|string|lowercase|max:255|unique:taxonomies,slug',
            'order' => 'required|integer',

        ]);
        Taxonomy::create($request->all());

        return redirect(route('taxonomy.index'));
    }
}
