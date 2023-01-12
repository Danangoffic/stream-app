<?php

namespace App\Http\Controllers\member;

use App\Http\Controllers\Controller;
use App\Models\Movie;
use App\Models\UserPremium;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use PDO;

class DashboardController extends Controller
{
    /**
     * Dashboard Index
     */
    public function index()
    {
        $movies = Movie::all();
        $movies_featured = Movie::where('featured', 1)->limit(2)->get();
        $data = [
            'movies' => $movies,
            'movies_featured' => $movies_featured,
            'title' => 'My Dashboard',
            'subtitle' => 'Watch Today',
            'subtitle_description' => 'Our selected movies for your mood'
        ];
        return view('member.dashboard', $data);
    }

    public function movie_detail(Request $request, $id)
    {
        $movie = Movie::findOrFail($id);
        $data = [
            'title' => $movie->title,
            'subtitle' => 'Watch Today',
            'subtitle_description' => 'Our selected movies for your mood',
            'movie' => $movie
        ];
        return view('member.movie-detail', $data);
    }

    public function movie_watch(Request $request, Movie $movie)
    {
        if(!$movie){
            return back()->withErrors(['movie' => 'The movie you\'re looking for is not listed!']);
        }

        $userPremium = UserPremium::where('user_id', auth()->user()->id)->first();
        if(!$userPremium){
            return redirect()->route('home.pricelist')->withErrors(['user' => 'You need to subscribe to watch the movie!']);
        }
        $endOfSubscription = $userPremium->end_of_subscription;
        $carbonDate = Carbon::createFromFormat('Y-m-d', $endOfSubscription);
        $isValid = $carbonDate->greaterThan(now());
        if(!$isValid){
            return redirect()->route('home.pricelist')->withErrors(['user' => 'Your subscription is ended, please make a renewal!']);
        }

        $data = [
            'title' => $movie->title,
            'subtitle' => 'Watch Today',
            'subtitle_description' => 'Our selected movies for your mood',
            'movie' => $movie
        ];

        return view('member.watching', $data);
    }

    public function subscription()
    {
        $userId = auth()->user()->id;
        $userPremium = UserPremium::with(['package'])->where('user_id', $userId)->first();
        if(!$userPremium){
            return redirect()->route('home.pricelist');
        }
        // $transaction =

        $data = [
            'title' => 'Manage Subscription',
            'subtitle' => 'Subscription',
            'subtitle_description' => 'Spend to get more good memories',
            'userPremium' => $userPremium
        ];
        return view('member.subscirption', $data);
    }

    public function stop_subscription($id)
    {
        $userPremium = UserPremium::findOrFail($id);
        $userPremium->delete();

        return redirect()->route('member.dashboard')->with('success', 'Success stopping your subscription!');

    }
}
