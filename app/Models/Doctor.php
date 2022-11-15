<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Doctor extends Model
{
    use HasFactory;
    protected $primaryKey = 'id';
    protected $fillable = [
        'strNumber',
        'birthDate',
        'address',
        'specialization',
        'practicePlace',
        'note',
        'user_id'
    ];
    public function user()
    {
        return $this->hasOne(User::class);
    }
}
