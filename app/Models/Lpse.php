<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Lpse extends Model
{
    use HasFactory;

    // protected $connection   = 'mysql';
    protected $table        = 'lpse';
    protected $primaryKey   = 'id';

    protected $fillable      = [
        'name',
        'address',
        'url',
        'province_id',
        'status',
        'post_by',
        'img'
    ];


    public function auction()
    {
        return $this->hasMany(Auction::class, 'lpse_id','id');
    }
}
