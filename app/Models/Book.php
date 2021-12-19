<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Book extends Model
{
    use HasFactory;

    protected $table = 'books';
    protected $primaryKey = 'b_id';
    protected $fillable = ['b_id','title','author','cover_image'];


    public function checkout(User $user) {
        $this->reservations()->create([
            'user_id' => $user->id,
            'checked_out_at' => now(),
        ]);
    }

    public function path() {
        return '/books/'.$this->id;
    }

    public function checkin($user) {
        $reservation = $this->reservations()->where('user_id', $user->id)
        ->whereNotNull('checked_out_at')
        ->whereNull('checked_in_at')
        ->first();

        if(is_null($reservation)) {
            throw new \Exception();
        }

        $reservation->update([
            'checked_in_at' => now(),
        ]);
    }

    public function reservations(){
        return $this->hasMany(Reservation::class);
    }
}
