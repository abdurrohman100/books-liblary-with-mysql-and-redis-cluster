<?php

namespace App\Http\Controllers;

use App\Models\Book;
use Illuminate\Http\Request;
use Session;
use Illuminate\Support\Facades\Storage;

class BooksController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $books= Book::orderBy('title')->get();

        return view('Dashboard.pages.list-buku')->with('buku',$books);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        // echo csrf_token();
        return view('dashboard.pages.create-buku');
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
            'title' => 'required',
            'author' => 'required',
            'cover_image' => 'required|image|max:2048',

        ]);
        try{
            // echo "apa";
            $inputt= $request->all();
            $name= md5($request->input('title')).".".$request->file('cover_image')->getClientOriginalExtension();
            $path="/cover/";
            $cover = $request->file('cover_image')->storeAs(
                'public/cover', $name
            );
            Book::create([
                'title'                  => $request->input('title'),
                'author'           => $request->input('author'),
                'cover_image'           => $path.$name,
            ]);
            Session::flash('success', 'Buku berhasil didaftarkan');
            return redirect('/book/create');
        }
        catch(\Illuminate\Database\QueryException $e)
        {
            $errorCode = $e->errorInfo[1];
            $errorMsg = $e->errorInfo[2];
            return redirect('/book/create');
        }
    }
    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Book  $book
     * @return \Illuminate\Http\Response
     */
    public function show(Book $book)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Book  $book
     * @return \Illuminate\Http\Response
     */
    public function edit(Book $book)
    {
        //
        return view('Dashboard.pages.edit-buku')->with('buku',$book);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Book  $book
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Book $book)
    {
        //
        $filec=$request->file('cover_image');
        if(isset($filec)){
            $this->validate($request, [
                'title' => 'required',
                'author' => 'required',
                'cover_image' => 'required|image|max:2048',
        
            ]);
        }
        else{
            $this->validate($request, [
                'title' => 'required',
                'author' => 'required',
        
            ]);
        }
            
            try{

                
                if(isset($filec)){
                    $name= md5($request->input('title')).".".$request->file('cover_image')->getClientOriginalExtension();
                    $path="/cover/";
                    $cover = $request->file('cover_image')->storeAs(
                        'public/cover', $name
                    );
                    $data=[
                        'title'                  => $request->input('title'),
                        'author'           => $request->input('author'),
                        'cover_image'           => $path.$name,
                    ];
                }else{
                    $data=[
                        'title'                  => $request->input('title'),
                        'author'           => $request->input('author'),
                    ];
                }
                $book->update($data);
            
            Session::flash('success', 'Buku berhasil diperbarui');
            return redirect('/book');
        }
        catch(\Illuminate\Database\QueryException $e)
        {
            $errorCode = $e->errorInfo[1];
            $errorMsg = $e->errorInfo[2];
            return redirect('/book');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Book  $book
     * @return \Illuminate\Http\Response
     */
    public function destroy(Book $book)
    {
        
    try{

        $book->delete();
        
        Session::flash('success', 'Buku berhasil dihapus');
        return redirect('/book');
    }
    catch(\Illuminate\Database\QueryException $e)
    {
        $errorCode = $e->errorInfo[1];
        $errorMsg = $e->errorInfo[2];
        return redirect('/book');
    }
    }
}
