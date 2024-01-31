<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FaqKontak extends Model
{
    use HasFactory;
    protected $table = 'faq_kontaks';
    protected $primaryKey = 'id';
    protected $fillable= [
        'pertanyaan',
        'jawaban',
    ];
}
