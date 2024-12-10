<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Student extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'email', 'class_id', 'section_id'];
    protected $with = ['class', 'section'];

    public function class()
    {
        return $this->belongsTo(Classes::class, 'class_id'); // Sesuaikan dengan nama model kelas
    }

    public function section()
    {
        return $this->belongsTo(Section::class); // Sesuaikan dengan nama model section
    }
}
