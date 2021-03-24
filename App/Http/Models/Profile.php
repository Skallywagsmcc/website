<?php


namespace App\Http\Models;


use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class Profile extends Controller
{
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function Image()
    {
        return $this->hasOne(Image::class,"id","profile_pic")
            ->where("user_id",\App\Http\Libraries\Authentication\Auth::id());
    }
}