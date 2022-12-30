<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\Movie;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class MovieController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $movies = Movie::all();
        return view('admin.pages.movies', ['movies' => $movies]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.pages.movie-create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $data = $request->except('_token');
        // dd($data);
        $request->validate([
            'title' => 'required|string',
            'small_thumbnail' => 'required|mimes:png,jpg,jpeg',
            'large_thumbnail' => 'required|mimes:png,jpg,jpeg',
            'trailer' => 'required|url',
            'movie' => 'required|url',
            'casts' => 'required|string',
            'categories' => 'required|string',
            'release_date' => 'required|string',
            'about' => 'required|string',
            'short_about' => 'required|string',
            'duration' => 'required|string',
            'featured' => 'required',
        ]);

        $smallThumbnail = $request->small_thumbnail;
        $largeThumbnail = $request->large_thumbnail;

        $originalSmallThumbnailName = Str::random(10) . $smallThumbnail->getClientOriginalName();
        $originalLargeThumbnailName = Str::random(10) . $largeThumbnail->getClientOriginalName();

        $smallThumbnail->storeAs('public/thumbnail', $originalSmallThumbnailName);
        $largeThumbnail->storeAs('public/thumbnail', $originalLargeThumbnailName);

        $data['small_thumbnail'] = $originalSmallThumbnailName;
        $data['large_thumbnail'] = $originalLargeThumbnailName;

        Movie::create($data);

        return redirect()
            ->route('admin.movie')
            ->with('success', 'Movie Created!');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $movie = Movie::findOrFail($id);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $movie = Movie::findOrFail($id);

        return view('admin.pages.movie-edit', ['movie' => $movie]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $data = $request->except('_token');
        $request->validate([
            'title' => 'required|string',
            'small_thumbnail' => 'mimes:png,jpg,jpeg',
            'large_thumbnail' => 'mimes:png,jpg,jpeg',
            'trailer' => 'required|url',
            'movie' => 'required|url',
            'casts' => 'required|string',
            'categories' => 'required|string',
            'release_date' => 'required|string',
            'about' => 'required|string',
            'short_about' => 'required|string',
            'duration' => 'required|string',
            'featured' => 'required',
        ]);
        $movie = Movie::findOrFail($id);
        if ($request->small_thumbnail) {
            //store a new image thumbnail
            $smallThumbnail = $request->small_thumbnail;
            $originalSmallThumbnailName = Str::random(10) . $smallThumbnail->getClientOriginalName();
            $smallThumbnail->storeAs('public/thumbnail', $originalSmallThumbnailName);
            $data['small_thumbnail'] = $originalSmallThumbnailName;
            //delete current thumbnail on storage
            Storage::delete('public/thumbnail/' . $movie->small_thumbnail);
        }
        if ($request->large_thumbnail) {
            //store a new image thumbnail
            $largeThumbnail = $request->large_thumbnail;
            $originalLargeThumbnailName = Str::random(10) . $largeThumbnail->getClientOriginalName();
            $largeThumbnail->storeAs('public/thumbnail', $originalLargeThumbnailName);
            $data['large_thumbnail'] = $originalLargeThumbnailName;
            //delete current thumbnail on storage
            Storage::delete('public/thumbnail/' . $movie->large_thumbnail);
        }


        $movie->update($data);
        return redirect()
            ->route('admin.movie')
            ->with('success', 'Movie updated!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $movie = Movie::find($id);

        $movie->delete();
        return redirect()
            ->route('admin.movie')
            ->with('success', 'Movie Deleted!');
    }
}
