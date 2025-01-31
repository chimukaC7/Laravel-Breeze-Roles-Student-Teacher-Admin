<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'role_id',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function getRedirectRouteName()
    {
        return match ((int)$this->role_id) {
            1 => 'student.timetable',
            2 => 'teacher.timetable',
            3 => 'admin.users',
        };
    }

    //transform data using mutator or Observe
    // public function setFieldNameAttribute(){

    // }

    // public function setStartAtAttribute($value){
    //     $this->attributes['start_at'] = Carbon::createFromFormat('m/d/Y', $value)->format('Y-m-d');

    // }

}
