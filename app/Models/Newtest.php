<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Newtest extends Model
{
    use HasFactory;

    public function test()
    {
        return $this->belongsTo(Newtest::class, "test_id", "id");
    }

    protected $fillable = ["name", "id", "test_id"];
}
