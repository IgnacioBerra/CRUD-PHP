<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class Login
 *
 * @property $id
 * @property $email
 * @property $password
 * @property $created_at
 * @property $updated_at
 *
 * @package App
 * @mixin \Illuminate\Database\Eloquent\Builder
 */
class Login extends Model
{
    
    protected $table = 'logins';
    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = ['email','password'];
    


}
