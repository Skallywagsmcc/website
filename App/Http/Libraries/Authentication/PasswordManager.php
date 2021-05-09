<?php


namespace App\Http\Libraries\Authentication;


use App\Http\Functions\Validate;
use App\Http\Models\PasswordRequest;
use App\Http\Models\User;
use Closure;
use MiladRahimi\PhpRouter\Url;

class PasswordManager extends Auth
{

    public $Approved;


    public function SendRequest(Validate $validate)
    {
        $user = User::where(["email"=>$validate->Post("email"),"username"=>$validate->Post("username")])->get();
        if($user->count() == 1)
        {
            $user = $user->first();
            $this->SaveRequest($user);
        }
}

    public function SaveRequest(User $user)
    {
        $this->Approved = false;
        $password =  $user->PasswordRequests($user->id)->where("user_id",$user->id)->get();
        $password->count()  == 0 ? $request = new PasswordRequest() : $request = PasswordRequest::find($user->PasswordRequests->id);
        $request->user_id = $user->id;
        $request->hex = $this->ObtainKey();
        $request->key = rand(100000,999999);
        $request->expires = time() + 3600;
        $request->save();
        $this->Approved = true;
        echo "<a href='http://skallywagsmcc.club/auth/reset-password/retrieve/".$request->id."/".$request->hex."'>Click Here</a>";
    }

    public function RetrieveRequest($id,$hex)
    {
     $this->Approved = false;
        $password = PasswordRequest::where(["id"=>$id,"hex"=>$hex])->get();
        echo $id;
        if($password->count() == 1)
        {
            $this->Approved = true;
        }

    }

}