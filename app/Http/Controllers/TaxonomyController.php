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
        return Inertia::render('Taxonomy/Index');
    }

    public function create(): Response
    {
        return Inertia::render('Taxonomy/Create');
    }

    public function store(Request $request): Response

    {


        $request->validate([
            'name' => 'required|string|max:255',
            'slug' => 'required|string',
            'order' => 'required|integer',

        ]);

        $slug = $request->slug;

        if (!Str::startsWith($request->slug, '/')) {
            $slug = '/' . $request->slug;
        }


        $user = Taxonomy::create([
            'name' => $request->name,
            'slug' =>  Str::slug($slug),
            'order' => $request->order,

        ]);
    }
}
