<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;

    protected $fillable = [
        'UserFname', 'UserLname','Username', 'UserPassword', 'DateRegistered'
    ];

    // Table Name
    protected $table = 'tbl_user';

    //Primary Key
    public $primaryKey = 'Pk_UserId';

    public $timestamps = false;
    protected $rememberTokenName = false;

    // Set Custom Password Column Name On Login
    public function getAuthPassword()
    {
        return $this->UserPassword;
    }
}
