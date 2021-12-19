<?php

namespace App\Http\Controllers;

use App\Models\Reservation;
use Session;
use App\Models\Book;
use Illuminate\Http\Request;

class ReservationsController extends Controller
{
    
    
    // public function __construct(){
    //     $this->middleware('auth');
    // }

    public function borrowing($book) {

        $uid= Session::get('id');

        // dd($book);

        Reservation::create([
            'user_id' => $uid,
            'book_id'   => $book,
            'checked_out_at' => now(),
        ]);

        return redirect()->back();

        // $book->checkout($uid);
    }

    public function returning($book) {
        $uid= Session::get('id');
        try {
            $reservation = Reservation::where('user_id', $uid)
            ->where('book_id',$book)
            ->whereNotNull('checked_out_at')
            ->whereNull('checked_in_at')
            ->first();
    
            if(is_null($reservation)) {
                throw new \Exception();
            }
    
            $reservation->update([
                'checked_in_at' => now(),
            ]);
            return redirect()->back();

        } catch(\Exception $err) {
            return response([], 404);
        }

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
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Reservation  $reservation
     * @return \Illuminate\Http\Response
     */
    public function show(Reservation $reservation)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Reservation  $reservation
     * @return \Illuminate\Http\Response
     */
    public function edit(Reservation $reservation)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Reservation  $reservation
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Reservation $reservation)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Reservation  $reservation
     * @return \Illuminate\Http\Response
     */
    public function destroy(Reservation $reservation)
    {
        //
    }
}
