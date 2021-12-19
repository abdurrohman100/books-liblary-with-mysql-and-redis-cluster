<?php

namespace App\Http\Controllers;
use App\Models\Book;
use App\Models\Reservation;
use Illuminate\Http\Request;
use Session;
use Illuminate\Support\Facades\Storage;

class DashboardController extends Controller
{
    //
    public function getHome(Request $request) {

        $books= Book::orderBy('title')->paginate(10);
        $count= Book::orderBy('title')->count();
        
        return view('Home.home-catalog')->with('books',$books)->with('count',$count);
    }

    public function getBook(Request $request, $id) {

        $book= Book::find($id);
        $count= reservation::where('book_id',$id)->count();

        $uid= Session::get('id');
        $reservation=null;
        if ($uid != NUll){
            $reservation = Reservation::where('user_id', $uid)
                ->where('book_id',$book)
                ->whereNull('checked_in_at')
                ->first();
        }
        // $count= reservation::where('book_id',$id)->->count();

        
        
        return view('Home.book-detail')->with('book',$book)->with('count',$count)->with('res',$reservation);
    }

    public function searchBook(Request $request) {

        $query = $request->input('query');
        $book= Book::where('title',"like","%".$query."%")->orWhere('author',"like","%".$query."%")->paginate(10);
        $count= Book::where('title',"like","%".$query."%")->orWhere('author',"like","%".$query."%")->count();
        
        return view('Home.search-catalog')->with('books',$book)->with('count',$count);
    }

    public function getAdminHome(Request $request) {

        $books= Book::orderBy('title')->paginate(10);
        $count= Book::orderBy('title')->count();
        
        return view('Dashboard.pages.welcome')->with('books',$books)->with('count',$count);
    }
}
