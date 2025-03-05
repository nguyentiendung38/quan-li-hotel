<?php

namespace App\Http\Controllers\Page;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Location;
use App\Models\Tour;
use App\Models\Article;
use App\Models\Comment;
use App\Models\Hotel;
use Mail;

class HomeController extends Controller
{
    //
    public function index()
    { 
        
        $locations = Location::all();
        $articles = Article::latest()->limit(3)->get();
        $tours = Tour::latest()->limit(3)->get();
        $comments = Comment::latest()->limit(3)->get();
        $newHotels = Hotel::orderByDesc('created_at')->limit(3)->get();
        $viewData = [
            'locations' => $locations,
            'articles' => $articles,
            'tours' => $tours,
            'comments' => $comments,
            'newHotels' => $newHotels
        ];
        return view('page.home.index', $viewData);
    }

    public function contact()
    {
        return view('page.contact.index');
    }

    public function about()
    {
        $comments = Comment::with('user')->where('cm_status', 2)->limit(10)->get();
        return view('page.about.index', compact('comments'));
    }

    public function transport()
    {
        return view('page.transport.index');
    }

    public function changeReturn()
    {
        return view('page.return.index');
    }

    public function security()
    {
        return view('page.security.index');
    }

    public function vnpay()
    {
        return view('page.vnpay.index');
    }
    
}
