<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Reservation extends Model
{
    use HasFactory;

    protected $table = 'reservations';
    protected $primaryKey = 'rsv_id';
    protected $fillable = ['rsv_id','user_id','book_id','checked_out_at','checked_in_at'];
}
