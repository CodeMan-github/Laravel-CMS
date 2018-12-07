<?php

namespace App;

use Illuminate\Contracts\Auth\Authenticatable as AuthenticatableContract;
use Illuminate\Contracts\Auth\CanResetPassword as CanResetPasswordContract;
use Illuminate\Database\Eloquent\Model;
use DB;
use Auth;
use Session;

class Users extends Model implements AuthenticatableContract, CanResetPasswordContract
{

    const TYPE_ADMIN = "admin";
    const TYPE_CUSTOMER = "customer";
    const TYPE_PUBLISHER = "publisher";
    const TYPE_AUTHOR = "author";

    const GENDER_MALE = "male";
    const GENDER_FEMALE = "female";

    protected $table = 'users';


    public static function hasPermission($permission)
    {

        $users_group = DB::table('users_groups')->where("user_id", Auth::user()->id)->first();

        $group = Groups::find($users_group->group_id);

        if ($group->name == Users::TYPE_ADMIN) {
            return true;
        }

        $permissions = explode(",", $group->permissions);

        if (in_array($permission, $permissions)) {
            return true;
        } else {
            return false;
        }

    }

    //getAuthPassword , getAuthIdentifier , getRememberToken , getRememberTokenName, setRememberToken , getEmailForPasswordReset
    /**
     * Get the unique identifier for the user.
     *
     * @return mixed
     */
    public function getAuthIdentifier()
    {
        return $this->id;
    }

    /**
     * Get the password for the user.
     *
     * @return string
     */
    public function getAuthPassword()
    {
        return $this->password;
    }

    /**
     * Get the token value for the "remember me" session.
     *
     * @return string
     */
    public function getRememberToken()
    {
        return $this->remember_token;
    }

    /**
     * Set the token value for the "remember me" session.
     *
     * @param  string $value
     * @return void
     */
    public function setRememberToken($value)
    {
        $this->remember_token = $value;;
    }

    /**
     * Get the column name for the "remember me" token.
     *
     * @return string
     */
    public function getRememberTokenName()
    {
        return $this->remember_token;
    }

    /**
     * Get the e-mail address where password reset links are sent.
     *
     * @return string
     */
    public function getEmailForPasswordReset()
    {
        return $this->email;
    }


}

