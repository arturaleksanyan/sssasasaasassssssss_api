<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Test extends Model
{
    use HasFactory;

    public function newtests()
    {
        return $this->hasMany(Newtest::class, "test_id", "id");
    }

    protected $fillable = ["name", "id"];
}
