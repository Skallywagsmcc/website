<?php


namespace App\Http\Controllers\Admin;


use App\Http\Functions\TemplateEngine;
use App\Http\Functions\Validate;
use App\Http\Libraries\Authentication\Csrf;
use App\Http\Models\FeaturedImage;
use App\Http\Models\Image;
use App\Http\Models\Profile;
use App\Http\Models\SiteSettings;
use App\Http\Models\Token;
use App\Http\Models\User;
use App\Http\Models\UserSettings;
use App\Http\traits\Activity_log;
use App\Http\traits\Ban_manager;
use App\Http\traits\Passwords;
use App\Http\traits\Users;
use Laminas\Diactoros\ServerRequest;
use mbamber1986\Authclient\Auth;
use MiladRahimi\PhpRouter\Url;
use PHPMailer\PHPMailer\Exception;
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;

class UsersController implements \App\Http\Interfaces\Users
{

    use Ban_manager;
    use Users;
    use Passwords;
    use Activity_log;


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


    public $user_groups;
    public $users;
    public $status_type;
    public $showform;
    public $status;
    public $banning;
    public $expires;
    private $user_exists;
    private $entity_name;

    private $admin_pw;

    public function __construct(Validate $validate)
    {


        $this->status = false;
        $this->user_exists = false;
        $this->entity_name = "request/registration";
        if ($_SERVER["REQUEST_METHOD"] == "POST") {

            $this->id = $validate->Post("id");
            $this->email = str_replace(" ","",$validate->Post("email"));
            $this->username = $validate->Post("username");
            $this->first_name = $validate->Post("first_name");
            $this->last_name = $validate->Post("last_name");
            $this->password = $validate->Post("password");
            $this->admin_password = $validate->Post("admin_password");
            $this->confirm_password = $validate->Post("confirm");
            $this->is_crew = $validate->Post("is_crew");
            $this->is_admin = $validate->Post("is_admin");

            $this->admin_pw = $validate->Post("admin_pw");
        }
        $this->showform = true;

    }

    public function index(Url $url)
    {

//        Find all users by status group

        $this->user_groups = User::Groupby("status")->limit(5)->get();


        echo TemplateEngine::View("Pages.Backend.AdminCp.Users.index", ["users" => $users, "latest" => $latest, "settings" => SiteSettings::where("id", 1), "url" => $url, "id" => $id, "request" => $this]);
    }

    public function statustype($status)
    {
        $status = $this->getuser($status)->first()->status;
        switch ($status) {
            case 0 :
                $status = "Guest Accounts";
                break;
            case 1 :
                $status = "Pending User accounts";
                break;
            case 2 :
                $status = "Banned User Accounts";
                break;
            case 3 :
                $status = "Active User Accounts";
                break;
        }

        return $status;
    }

    public function getuser($status)
    {
        return $this->users = User::where("status", $status)->get();
    }

    public function create(URL $url)
    {
        $settings = SiteSettings::where("id", 1)->where("open_registration", 1)->count();
        $settings == 1 ? $this->status = true : $this->status = false;
        echo TemplateEngine::View("Pages.Backend.AdminCp.Users.new", ["users" => $users, "url" => $url, "request" => $this]);
    }

    public function store(Url $url, Csrf $csrf, Validate $validate, Auth $auth)
    {

//Variables

        SiteSettings::where("id", 1)->where("open_registration", 0)->count() == 1 ? $this->status = true : $this->status = false;
        User::where("email", $this->email)->get()->count() == 1 ? $this->user_exists = true : $this->user_exists = false;

//        Step 1 Verify the csrf token

        if ($csrf->Verify() == true) {

            if(!filter_var($this->email,FILTER_VALIDATE_EMAIL))
            {
                $this->error = "not a valid email address";
            }
            elseif ($this->user_exists == true) {
                $this->error = "It seems the email you are trying to register is linked to another account.";
            }
            elseif($validate->HasStrongPassword($this->admin_password) == false)
            {
                $this->error = "Please  Enter your Account Password to proceed";
            }
            else {
//                Create the user;

                $user = new User();
                $user->email = $this->email;
                $this->is_admin == 1 ? $user->is_admin = 1 : $user->is_admin = 0;
                $user->save();

//create profile and settings
                $profile = new Profile();
                $profile->user_id = $user->id;
                $profile->first_name = $this->first_name;
                $profile->last_name = $this->last_name;
                $this->is_crew == 1 ? $profile->is_crew = 1 : $profile->is_crew = 0;
                $profile->save();

                $settings = new UserSettings();
                $settings->save();

                $this->status = true;

//                Send the registration request here

                if ($this->status == true) {
                    $request = Token::where("entity_name")->where("user_id", $user->id)->get();

                    if ($request->count() == 1) {
                        $request->first();
                    } else {
                        $request = new Token();
                    }
                    $request->user_id = $user->id;
                    $request->entity_name = $this->entity_name;
                    $request->token_hex = $validate->RequestHexKey();
                    $request->token_key = rand(000001, 999999);
                    $request->expires = date("Y-m-d H:i:s", strtotime("+24 hours"));
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
                        $mail->addAddress($user->email, $user->Profile->first_name . " " . $user->Profile->last_name);     //Add a recipient

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
//                        $this->addurl("http://".$_SERVER["HTTP_HOST"].$url->make("auth.admin.users.home"))->$this->newactivity("user","create",true);
                        redirect($url->make("auth.admin.users.home"));
                    } catch (Exception $e) {
                        $this->error = "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
                    }
                }

            }

        } else {
            $this->error = "The Csrf Token is no Longer valid";
        }

        echo TemplateEngine::View("Pages.Backend.AdminCp.Users.new", ["user" => $user, "url" => $url, "required" => $required, "request" => $this]);

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
        $this->user = $this->findusers($id);
        if($this->user->count() == 1)
        {
            $this->user = $this->user->first();
//            Instantiate the Ban
            $this->load($this->user->id);
            $this->banconfirmed() == true ? $this->disableform = true : $this->disableform = false;

        }
        else
        {
            $this->showform = false;
            $this->error = "User Cannot be found in database";
        }

        echo TemplateEngine::View("Pages.Backend.AdminCp.Users.edit", ["url" => $url, "request" => $this]);
    }

    public function update($id, Url $url, Csrf $csrf, Validate $validate, Auth $auth)
    {
//Get validation
        if ($csrf->Verify() == true) {
            $id = base64_decode($id);
            $user = $this->findusers($id);
            if ($user->count() == 1) {
                $user = $user->first();
                $validate->AddRequired(["username", "email", "first_name", "last_name"]);

                if ($validate->Allowed() == false) {
                    $error = "Some Missing fields are required";
                    $required = $validate->is_required;
                }
                else {
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
                        $this->addurl("http://".$_SERVER["HTTP_HOST"].$url->make("auth.admin.users.home"))->$this->newactivity("user","update",true);
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
        $id = base64_decode($id);
    }

    public function deleterequest(Url $url, $user_id, $token_hex, $token_key)
    {
        $this->DeleteUserRequest($user_id, $token_hex, $token_key) == true ? redirect($_SERVER['HTTP_REFERER']) : exit("An Error Occurred : Deletion Failed");
    }


}