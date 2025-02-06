<?php

namespace App\Http\Controllers;

use App\Models\Series;
use Illuminate\Http\Request;

class SeriesController extends Controller
{
    //

    public function index(Request $request)
    {
        $series= Series::all();

        return $request->user();
    }
    public function show(Request $request){
        $series = Series::find($request->id);
        return $request->user();

    }


    public function store(Request $request){
        $series = new Series();
        $series->title = $request->title;
        $series->save();

    }
    public function update(Request $request){
        $series = Series::find($request->id);
        $series->title = $request->title;
        $series->save();

    }
    public function destroy(Request $request){
        $series = Series::find($request->id);
        $series->delete();
        return true;

    }
    public function search(Request $request){

    }
}
