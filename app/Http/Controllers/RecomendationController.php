<?php

namespace App\Http\Controllers;

use App\Recomendation;
use Illuminate\Http\Request;

class RecomendationController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth', ['except' => ['index', 'show']]);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('Recomendation.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'rating' => 'required',
            'review' => 'nullable',
            'p_id' => 'required'
        ]);

        $rating = new Rating;
        $rating->rating = $request->input('rating');
        $rating->review = $request->input('review');
        $rating->product_id = $request->input('p_id');
        $rating->user_id = auth()->user()->id;
    
        $rating->save();

        return redirect('/products')->with('success_message','Ratings successfully added!');
        
    }

    


}
