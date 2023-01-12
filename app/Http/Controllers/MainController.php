<?php

namespace App\Http\Controllers;

use App\Models\Package;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class MainController extends Controller
{
    public function index()
    {
        if(auth()->check() && auth()->user()->role == 'admin'){
            return redirect()->route('admin.dashboard');
        }
        return view('index');
    }

    public function pricing()
    {
        $packages = Package::all();
        $data = [
            'title' => Str::title('package price list'),
            'packages' => $packages,
            'subtitle' => 'START TODAY',
            'subtitle_description' => 'Up Your Imagination'
        ];
        return view('pricing', $data);
    }

    public function subscribe(Request $request)
    {
        # code...
    }
}
