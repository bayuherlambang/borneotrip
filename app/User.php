<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;

    protected $fillable = [
        'username', 'password', 'level_id', 'fullname', 'email'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    public function level()
    {
        return $this->belongsTo(UsersLevel::class);
    }

    public function comparePassword($password){
        return Hash::check($password, $this->password);
    }

    public function resetPassword($newpass)
    {
        $this->password = bcrypt($newpass);
        $this->save();
    }

    public function lastLogin()
    {
    if (LogLoginUsers::where('username', $this->username)->orderBy('id','desc')->first() == null){
            return "belum pernah login";
        }

        return LogLoginUsers::where('username', $this->username)->orderBy('id','desc')->first()->tanggal('created_at');
    }
}
