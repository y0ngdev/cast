<?php

namespace App\Http\Controllers;

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
}
