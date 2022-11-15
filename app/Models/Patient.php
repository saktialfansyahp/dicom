<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Patient extends Model
{
    use HasFactory;
    protected $table = 'patients';
    protected $primaryKey = 'id_patient';
    protected $fillable = [
        'medicalRecordNumber',
        'name',
        'birth_date',
        'gender',
        'phoneNumber',
        'email',
        'address',
        'disease',
        'note',
        'id_user',
    ];
    public function user()
    {
        return $this->belongsTo(User::class);
    }
    public function dicom()
    {
        return $this->hasMany(Dicom::class);
    }
}
