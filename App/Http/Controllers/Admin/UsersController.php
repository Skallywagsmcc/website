<?php


namespace App\Http\Controllers\Admin;


use App\Http\Functions\TemplateEngine;
use App\Http\Functions\Validate;
use App\Http\Libraries\Authentication\Csrf;
use App\Http\Libraries\Pagination\LaravelPaginator;
use App\Http\Libraries\Pagination\Paginator;
use App\Http\Models\FeaturedImage;
use App\Http\Models\Image;
use App\Http\Models\PasswordRequest;
use App\Http\Models\Profile;
use App\Http\Models\RegisterRequest;
use App\Http\Models\SiteSettings;
use App\Http\Models\Token;
use App\Http\Models\User;
use App\Http\Models\UserSettings;
use Laminas\Diactoros\ServerRequest;
use mbamber1986\Authclient\Auth;
use Migrations\Register_Requests;
use Migrations\User_Settings;
use MiladRahimi\PhpRouter\Url;
use PHPMailer\PHPMailer\Exception;
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;

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
    public $error;
    public $required;


    public $status;
    private $user_exists;
    private $entity_name;

    public function __construct(Validate $validate)
    {

        $this->status = false;
        $this->user_exists = false;
        $this->entity_name = "request/registration";
        if ($_SERVER["REQUEST_METHOD"] == "POST") {

            $this->id = $validate->Post("id");
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

    }

    public function index(Url $url)
    {
        $id = User::orderBy("id", "desc")->limit(1)->get()->first();
        $users = User::all();
        $latest = User::orderBy("id", "DESC")->take(5)->get();
        $requests = RegisterRequest::orderBy("id", "desc");
        $pagination = new LaravelPaginator("10", "request_per_page");
        $requests = $pagination->paginate($requests);

        echo TemplateEngine::View("Pages.Backend.AdminCp.Users.index", ["users" => $users, "latest" => $latest, "settings" => SiteSettings::where("id", 1), "url" => $url, "id" => $id, "requests" => $requests]);
    }

    public function create(URL $url)
    {
        $settings = SiteSettings::where("id", 1)->where("open_registration", 1)->count();
        $settings == 1 ? $this->status = true : $this->status = false;
        echo TemplateEngine::View("Pages.Backend.AdminCp.Users.new", ["users" => $users, "url" => $url, "request"=>$this]);
    }

    public function store(Url $url, Csrf $csrf, Validate $validate, Auth $auth)
    {

//Variables

        SiteSettings::where("id", 1)->where("open_registration", 0)->count() == 1 ? $this->status = true : $this->status = false;
        User::where("email",$this->email)->get()->count() == 1 ? $this->user_exists = true : $this->user_exists = false;

//        Step 1 Verify the csrf token

        if($csrf->Verify()==true)
        {

//            check if email exisits for account.

//            if no send create the user, Profile, and usersettings

//            Send the request to the tokens database

//            Email the user
            if($this->user_exists == true)
            {
                $this->error = "It seems the email you are trying to register is linked to another account.";
            }
            else
            {
            if(($this->password != $this->confirm_password) && ($this->status == false))
            {
            $this->error = "Passwords do not match";
            }
            elseif(($validate->HasStrongPassword($this->password) == false)  && ($this->status == false))
            {
            $this->error = "Password does not follow our strong password policy";
            }
            else
            {
                $user = new User();
                $user->email = $this->email;
                if($this->status == false)
                {
                    $user->userame = $this->username;
                    $user->password = password_hash($this->password,PASSWORD_DEFAULT);
                    $user->is_admin = $this->is_admin;
                }
                $user->status = 1;
                $user->save();

//create profile and settings
                $profile = new Profile();
                $profile->user_id = $user->id;
                $profile->first_name = $this->first_name;
                $profile->last_name = $this->last_name;
                if($this->status == false) {
                    $profile->is_crew = $this->is_crew;
                }
                $profile->save();

                    $settings = new UserSettings();
                    $settings->user_id = $user->id;
                if($this->status == false) {
                    $settings->two_factor_auth = 0;
                    $settings->display_full_name = 1;
//            if display full name = 0 then display username;
                    $settings->display_dob = 1;
                    $settings->display_email = 1;
                }
                $settings->save();

//                Send the registration request here

                if($this->status == true)
                {
                   $request = Token::where("entity_name")->where("user_id",$user->id)->get();

                   if($request->count()==1)
                   {
                       $request->first();
                   }
                   else
                   {
                       $request = new Token();
                   }
                   $request->user_id = $user->id;
                   $request->entity_name = $this->entity_name;
                   $request->token_hex = $validate->RequestHexKey();
                   $request->token_key = rand(000001,999999);
                   $request->expires = date("Y-m-d H:i:s",strtotime("+24 hours"));
                   $request->save();

//                   Send the email out

                    $mail = new PHPMailer(true);

                    try {
                        //Server settings
                        $mail->SMTPDebug = SMTP::DEBUG_OFF;         //Enable verbose debug output
                        $mail->isSMTP();                                            //Send using SMTP
                        $mail->Host = $_ENV['SMTP_HOST'];          //Set the SMTP server to send through
                        $mail->SMTPAuth = true;                                   //Enable SMTP authentication
                        $mail->Username = $_ENV['SMTP_USERNAME'];    //SMTP username
                        $mail->Password = $_ENV['SMTP_PASSWORD'];    //SMTP password
//                $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;         //Enable TLS encryption; `PHPMailer::ENCRYPTION_SMTPS` encouraged
                        $mail->Port = 587;        //TCP port to connect to, use 465 for `PHPMailer::ENCRYPTION_SMTPS` above

                        //Recipients
                        $mail->setFrom("no-reply@skallywags.club", "no reply");
                        $mail->addAddress($user->email, $user->Profile->first_name . " ". $user->Profile->last_name);     //Add a recipient

                        //Content
                        $mail->isHTML(true);                                  //Set email format to HTML
                        $mail->Subject = "Welcome to the club : Your Account request";
                        $mail->Body = "<div><img src='" . $_ENV['LOGO'] . "' alt='logo' height='100' width='100'/></div>";
                        $mail->Body .= "Hello " . $user->Profile->first_name . "<hr>";
                        $mail->Body .= "Thank you for joining our site as this is a closed Registration you will be required to join using a token and key request system Please follow the instructions below<hr>";
                        $mail->Body .= "Step 1: Copy this token_key <strong>" . $request->token_key . "</strong><br>";
                        $mail->Body .= "Step 2: Click on link the below to be taken to the registration page<br>";
                        $mail->Body .= "Step 3: Continue to fill our the remainder of  your account using the form <br>";
                        $mail->Body .= "Step 4: Paste your token key into the box token_key input field <br>";
                        $mail->Body .= "Step 5: Submit your request and welcome to the comunity <hr>";
                        $mail->Body .= "Continue your registration : <a href='" . $_ENV['DOMAIN'] . $url->make("register", ["token_hex" => $request->token_hex]) . "'>Click Here</a> <br><br>";
                        $mail->Body .= "If your think this was sent in error please disregard this email and continue to <a href='" . $_ENV['DOMAIN'] . $url->make("auth.admin.users.delete.request", ["user_id" => $user->id, "token_hex" => $request->token_hex, "token_key" => $request->token_key]) . "'>Cancel this request</a> and this account will be deleted<hr>";
                        $mail->Body .= "Have Any questions please feel free to <a href='" . $_ENV['DOMAIN'] . $url->make("contact-us") . "'>Click here</a> to contact us";
                        $mail->send();
                        $this->status = true;
                        redirect($url->make("login"));
                    } catch (Exception $e) {
                        echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
                    }


                }
            }

            }

        }
        else
        {
            $this->error = "The Csrf Token is no Longer valid";
        }

        echo TemplateEngine::View("Pages.Backend.AdminCp.Users.new", ["user" => $user, "url" => $url, "required" => $required,"request"=>$this]);

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

    public function deleterequest(Url $url,$user_id,$token_hex,$token_key)
    {
        $request = Token::where("user_id",$user_id)->where("entity_name",$this->entity_name)->where("token_hex",$token_hex)->where("token_key",$token_key);
        if($request->count() == 1)
        {
         Profile::where("user_id",$user_id)->delete();
         UserSettings::where("user_id",$user_id)->delete();
         User::where("id",$user_id)->delete();
         $request->delete();

         redirect($url->make("homepage"));
        }
//        Delete all data from requests
    }


    

}