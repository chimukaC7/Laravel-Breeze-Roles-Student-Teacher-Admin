<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
    use HasFactory;

    //useful for views
    protected $primaryKey = "role_id";
    public $incrementing = false;
    protected $perPage = 20;
    public $timestamps = false;

    const CREATED_AT = "date_created";
    const UPDATED_AT = "date_updated";

    protected $fillable = ['name'];

    //php artisan stub:publish
}
