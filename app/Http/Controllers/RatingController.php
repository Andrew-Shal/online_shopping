<?php

namespace App\Http\Controllers;

use App\User;
use App\Rating;
use Illuminate\Http\Request;

class RatingController extends Controller
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
    public function create($pid)
    {
        return view('dynamic_pages.ratings.create')->with('pid', $pid);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        if (!auth()->user()) return redirect()->back()->with('error', 'you need to login before adding a rating');

        $user = User::find(auth()->user()->id);

        $ratings = Rating::where('user_id', $user->id)->where('product_id', $request->input('p_id'))->get();

        if (count($ratings) > 0) return redirect()->back()->with('error', 'you can only add one rating to a product');

        $this->validate($request, [
            'rating' => 'required',
            'review' => 'required',
            'p_id' => 'required'
        ]);

        $rating = new Rating;
        $rating->rating = $request->input('rating');
        $rating->review = $request->input('review');
        $rating->product_id = $request->input('p_id');
        $rating->user_id = auth()->user()->id;

        $rating->save();

        return redirect()->back()->with('success', 'Ratings successfully added!');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Rating  $rating
     * @return \Illuminate\Http\Response
     */
    public function show(Rating $rating)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Rating  $rating
     * @return \Illuminate\Http\Response
     */
    public function edit(Rating $rating)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Rating  $rating
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Rating $rating)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Rating  $rating
     * @return \Illuminate\Http\Response
     */
    public function destroy(Rating $rating)
    {
        //
    }
}
