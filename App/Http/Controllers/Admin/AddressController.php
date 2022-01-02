<?php


namespace App\Http\Controllers\Admin;


use App\Http\Functions\TemplateEngine;
use App\Http\Functions\Validate;
use App\Http\Models\Address;
use App\Libraries\Filemanager;
use mbamber1986\Authclient\Auth;
use App\Http\Libraries\Authentication\Csrf;
use App\Http\Libraries\Pagination\LaravelPaginator;
use App\Http\Models\Image;
use App\Http\Models\Article;
use Laminas\Diactoros\ServerRequest;
use Migrations\Images;
use MiladRahimi\PhpRouter\Url;


class AddressController
{

    public $title;
    public $user_id;
    public $slug;
    public $name;
    public $street;
    public $street_2; //optional
    public $city;
    public $county;
    public $postcode;
    public $contactus;
    public $error;
    public $required;
    private $entity_name;
    public $request;

    public function __construct(Validate $validate)
    {
        if ($_SERVER['REQUEST_METHOD'] == "POST") {
            $this->title = $validate->Post("title");
            $this->slug = slug($validate->Post("title"));
            $this->name = $validate->Post("name");
            $this->street = $validate->Post("street");
            $this->street_2 = $validate->Post("street_2");
            $this->city = $validate->Post("city");
            $this->county = $validate->Post("county");
            $this->postcode = $validate->Post("postcode");
            $this->contactus = $validate->Post("contactus");
        }
        $this->entity_name = "address/general";
    }

    public function index(Url $url)
    {
        $address = Address::where("entity_name",$this->entity_name)->orderBy("id", "ASC");
        $paginator = new LaravelPaginator("10", "page");
        $address = $paginator->paginate($address);
        $links = $paginator->page_links();
        echo TemplateEngine::View("Pages.Backend.AdminCp.Addresses.index", ["url" => $url, "addresses" => $address, "links" => $links]);
    }

    public function show(Url $url, $id)
    {
        $id = base64_decode($id);
        $address = Address::where("id", $id)->get();

        echo TemplateEngine::View("Pages.Backend.AdminCp.Addresses.view", ["url" => $url, "address" => $address,]);
    }

    public function create(Url $url,ServerRequest $request)
    {
        $this->request = $request->getQueryParams()["action"];
        echo TemplateEngine::View("Pages.Backend.AdminCp.Addresses.new", ["url" => $url,"action"=>$this]);
    }


    public function store(Url $url, Csrf $csrf, Auth $auth, Validate $validate)
    {

        if ($csrf->Verify() == true) {
            $validate->AddRequired(["title", "name", "street", "city", "county", "postcode"]);
            if ($validate->Allowed() == false) {
                $this->error = "The Following Fields have been left empty and are Required";
                $this->required = $validate->is_required;
            } else {
                $address = new Address();
                $address->user_id = $auth->id();
                $this->contactus == 1 ? $address->entity_name = $this->entity_name : $address->contactus = 0;
                $address->title = $this->title;
                $address->slug = $this->slug;
                $address->name = $this->name;
                $address->street = $this->street;
                $address->street_2 = $this->street_2;
                $address->city = $this->city;
                $address->county = $this->county;
                $address->postcode = $this->postcode;
                if($address->save())
                {
                    redirect($url->make("auth.admin.addresses.home"));
                }
                else
                {
                    $this->error = "An Error Occurred when Saving";
                }
            }
        }
        echo TemplateEngine::View("Pages.Backend.AdminCp.Addresses.new", ["url" => $url,"post"=>$this,"error"=>$this->error,"required"=>$this->required]);
    }

    public function edit($id, Url $url)
    {
        $id = base64_decode($id);
        $address = Address::where("id", $id)->get();
        if ($address->count() == 1) {
            $address = $address->first();
        }
        echo TemplateEngine::View("Pages.Backend.AdminCp.Addresses.edit", ["url" => $url, "address" => $address]);
    }

    public function update($id, Url $url, Csrf $csrf, Auth $auth, Validate $validate)
    {
//        instantiate the csrf token
        if ($csrf->Verify() == true) {
            $id = base64_decode($id);
            $address = Address::where("id", $id)->get();
            if ($address->count() == 1) {
//                Instantiate requirement
        $address = $address->first();
                $validate->AddRequired(["title", "name", "street", "city", "county", "postcode"]);
//                Check if validation is false;
                if ($validate->Allowed() == false) {
                    $this->error = "The Following Fields have been left empty and are Required";
                    $this->required = $validate->is_required;
                } else {
//                    Update the settings

                    $address->user_id = $auth->id();
                    $address->title = $this->title;
                    $address->contactus = $this->contactus;
                    $address->slug = slug($this->title);
                    $address->name = $this->name;
                    $address->street = $this->street;
                    $address->street_2 = $this->street_2;
                    $address->city = $this->city;
                    $address->county = $this->county;
                    $address->postcode = $this->postcode;

//                    DO the save and redired
                    if ($address->save()) {
                        redirect($url->make("auth.admin.addresses.home"));
                    }
                    else
                    {
//                        Throw and error
                        $this->error = "Update Failed";
                    }
                }
            }
//            Display the template
            echo TemplateEngine::View("Pages.Backend.AdminCp.Addresses.edit", ["url" => $url, "address" => $address, "post" => $this, "error" => $this->error, "required" => $this->required]);
        }
    }

    public function delete(Url $url, $id)
    {
        $id = base64_decode($id);
        $address = Address::where("id", $id);
        if ($address->count() == 1) {
            $address->delete();
            redirect($url->make("auth.admin.addresses.home"));
        } else {
            exit("An Error occurred");
        }
    }
}