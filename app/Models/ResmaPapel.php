<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ResmaPapel extends Model
{
    use HasFactory;

    protected $dates = ['date']; 

    protected $guarded = []; // NECESSARIO PARA ATUALIZA 

    public function user(){  // RELACAO DE N PRA 1
        return $this->belongsTo(User::class);
    }
}
