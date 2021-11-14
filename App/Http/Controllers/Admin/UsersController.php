<?php


namespace App\Http\Controllers\Admin;


use App\Http\Functions\TemplateEngine;
use App\Http\Functions\Validate;
use App\Http\Libraries\Authentication\Csrf;
use App\Http\Libraries\Pagination\LaravelPaginator;
use App\Http\Libraries\Pagination\Paginator;
use App\Http\Models\FeaturedImage;
use App\Http\Models\Image;
use App\Http\Models\Profile;
use App\Http\Models\RegisterRequest;
use App\Http\Models\SiteSettings;
use App\Http\Models\User;
use App\Http\Models\UserSettings;
use Laminas\Diactoros\ServerRequest;
use mbamber1986\Authclient\Auth;
use Migrations\Register_Request;
use MiladRahimi\PhpRouter\Url;

class UsersController
{

    public $id;
    public $email;
    public $username;
    public $first_name;
    public $last_name;
    public $password;
    public $admin_password;
    public $confirm_password;
    public $is_crew;
    public $is_admin;
    public $required;

    public function __construct(Validate $validate)
    {
        if ($_SERVER["REQUEST_METHOD"] == "POST") $this->id = $validate->Post("id");
        $this->email = $validate->Post("email");
        $this->username = $validate->Post("username");
        $this->first_name = $validate->Post("first_name");
        $this->last_name = $validate->Post("last_name");
        $this->password = $validate->Post("password");
        $this->admin_password = $validate->Post("admin_password");
        $this->confirm_password = $validate->Post("confirm");
        $this->is_crew = $validate->Post("is_crew");
        $this->is_admin = $validate->Post("is_admin");

    }

    public function index(Url $url)
    {
        $id = User::orderBy("id", "desc")->limit(1)->get()->first();
        $users = User::all();
        $latest = User::orderBy("id", "DESC")->take(5)->get();
        $requests = RegisterRequest::orderBy("id","desc");
        $pagination = new LaravelPaginator("10","request_per_page");
        $requests = $pagination->paginate($requests);

        echo TemplateEngine::View("Pages.Backend.AdminCp.Users.index", ["users" => $users, "latest" => $latest,"settings"=>SiteSettings::where("id",1), "url" => $url, "id" => $id,"requests"=>$requests]);
    }

    public function create(URL $url)
    {
        $settings = SiteSettings::where("id",1)->where("open_registration", 0)->count();
        $settings ==1 ? $status = false : $status = true;
        echo TemplateEngine::View("Pages.Backend.AdminCp.Users.new", ["users" => $users, "url" => $url,"status"=>$status]);
    }

    public function store(Url $url, Csrf $csrf, Validate $validate, Auth $auth)
    {
        if ($csrf->Verify() == true) {
            $settings = SiteSettings::where("id",1)->where("open_registration", 0)->count();

            if ($settings == 1) {
                $status = false;
                if(RegisterRequest::where("email",$this->email)->get()->count()==1)
                {
                    $error = "There is already a Pending Request for that Account";
                }
                else
                {
                   if (User::where("email", $this->email)->get()->count() == 1) {
                        $error = "An Account with that email Address already Exists";
                    }
                   else
                    {
                        $request = new RegisterRequest();
                        $request->email = $this->email;
                        $request->token = $validate->RequestHexKey();
                        $request->save();
                        redirect($url->make("auth.admin.users.home"));
                    }
                }

            } else {
                $status = true;
                $user = new User();
                if (User::where("username", $this->username)->get()->count() == 1) {
                    $error = "that username is already taken";
                } elseif (User::where("email", $this->email)->get()->count() == 1) {
                    $error = "That Email Address is already Taken";
                } elseif ((empty($this->password)) || (empty($this->confirm_password))) {
                    $error = "password or password confirmation cannot be empty";
                } elseif
                ($this->password != $this->confirm_password) {
                    $error = "Passwords do not match";
                } else {
                    $validate->AddRequired(["email", "username", "first_name", "last_name", "password", "confirm"]);
                    if ($validate->Allowed() == false) {
                        $error = "invalid field";
                        $required = $validate->is_required;
                    } else {
                        if ($validate->HasStrongPassword($this->password) == false) {
                            $error = "Password Strengh Does not meet our Requirments";
                        } elseif (!$auth->RequirePassword($this->admin_password)) {
                            $error = "Your User Password does not match the record";
                        } else {
                            $users = new User();
                            $users->username = $this->username;
                            $users->email = $this->email;
                            $user->is_admin = $this->is_admin;
                            $users->password = password_hash($this->password, PASSWORD_DEFAULT);
                            $users->save();

                            $profile = new Profile();
                            $profile->user_id = $users->id;
                            $profile->is_crew = $this->is_crew;
                            $profile->first_name = $this->first_name;
                            $profile->last_name = $this->last_name;
                            $profile->save();

                            $settings = new UserSettings();
                            $settings->user_id = $users->id;
                            $settings->two_factor_auth = 0;
                            $settings->display_full_name = 1;
//            if display full name = 0 then display username;
                            $settings->display_dob = 1;
                            $settings->display_email = 1;
                            $settings->save();
                            redirect($url->make("auth.admin.users.home"));
                        }
                    }
                }
            }
        }



        echo TemplateEngine::View("Pages.Backend.AdminCp.Users.new", ["user" => $user, "url" => $url, "error" => $error, "required" => $required, "post" => $this,"status"=>$status]);

    }

    public function search(Url $url, ServerRequest $request)
    {
        $keyword = $request->getQueryParams()['keyword'];


        $users = User::wherehas("Profile", function ($q) use ($keyword) {
            $q->where("first_name", "LIKE", "%$keyword%")->orwhere("last_name", "LIKE", "%$keyword%");
        })->orwhereRaw('MATCH (username,email) AGAINST (?)', array($keyword))->orwhere("username", "LIKE", "%$keyword%")->get();

        if ($users->count() == 0) {
            $message = "No Username With that Name has Been found in our database";
        }
        echo TemplateEngine::View("Pages.Backend.AdminCp.Users.index", ["users" => $users, "url" => $url, "message" => $message]);


    }

    public function edit($id, Url $url)
    {
        $id = base64_decode($id);
        $user = User::where("id", $id)->get();

        if ($user->count() == 1) {
            echo TemplateEngine::View("Pages.Backend.AdminCp.Users.edit", ["user" => $user->first(), "url" => $url]);
        } else {
            echo "user} doesnt exisit";
        }


    }

    public function update($id, Url $url, Csrf $csrf, Validate $validate, Auth $auth)
    {
//Get validation
        if ($csrf->Verify() == true) {
            $id = base64_decode($id);
            $user = User::where("id", $id)->get();
            if ($user->count() == 1) {
                $user = $user->first();
                $validate->AddRequired(["username", "email", "first_name", "last_name"]);

                if ($validate->Allowed() == false) {
                    $error = "Some Missing fields are required";
                    $required = $validate->is_required;
                } else {
                    if (!$auth->RequirePassword($this->admin_password)) {
                        $error = "Your User Password does not match the record";
                    } else {
                        $user->username = $this->username;
                        $user->email = $this->email;
                        $user->is_admin = $this->is_admin;
                        $user->save();
//
                        $profile = Profile::find($user->id);
                        $profile->is_crew = $this->is_crew;
                        $profile->first_name = $this->first_name;
                        $profile->last_name = $this->last_name;
                        $profile->save();
                        redirect($url->make("auth.admin.users.home"));
                    }
                }
                echo TemplateEngine::View("Pages.Backend.AdminCp.Users.edit", ["user" => $user, "url" => $url, "post" => $this, "error" => $error, "required" => $required]);
                exit();
            }

        }

    }

    public function delete($id, Url $url)
    {
        $user = User::where("id", $id);
        if ($user->count() == 1) {
            UserSettings::where("user_id", $id)->delete();
            Profile::where("user_id", $id)->delete();


//        FInd Images and delete them
            $images = Image::where("user_id", $id);
            if ($images->count() >= 1) {
                foreach ($images as $image) {
                    unlink(__DIR__ . "/../../../../img/uploads/$image->image_name");
                    Image::find($image->id)->delete();
                    FeaturedImage::where("image_id", $image_id)->delete();
                }
            }
//            finally delete the users account;
            $user->delete();
        } else {
            echo "no user found";
        }
        redirect($url->make("auth.admin.users.home"));

    }


}