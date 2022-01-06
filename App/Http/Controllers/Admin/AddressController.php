<?php


namespace App\Http\Controllers\Admin;


use App\Http\Functions\TemplateEngine;
use App\Http\Functions\Validate;
use App\Http\Libraries\Authentication\Csrf;
use App\Http\Libraries\Pagination\LaravelPaginator;
use App\Http\Models\Address;
use Laminas\Diactoros\ServerRequest;
use mbamber1986\Authclient\Auth;
use MiladRahimi\PhpRouter\Url;
use Plugins\Managers\AddressBook;


class AddressController
{

    public $user_id;
    public $entity_name;
    public $error;
    public $required;
    public $address;
    public $showform;
    public $id;


//    Linked to Address book
    public $title;
    public $slug;
    public $name;
    public $street;
    public $street_2; //optional
    public $city;
    public $county;
    public $postcode;

//    End Address Book


    public function __construct(Validate $validate,AddressBook $addressBook)
    {
        if ($_SERVER['REQUEST_METHOD'] == "POST") {
            $this->title = $addressBook->title;
            $this->slug = $addressBook->slug;
            $this->name = $addressBook->name;
            $this->street = $addressBook->street;
            $this->street_2 = $addressBook->street_2;
            $this->city = $addressBook->city;
            $this->county = $addressBook->county;
            $this->postcode = $addressBook->postcode;
        }

        $this->entity_name = "address/general";
        $this->error = $addressBook->error;
        $this->showform = true;
    }

    public function index(Url $url)
    {
        $address = Address::orderBy("id", "ASC");
        $paginator = new LaravelPaginator("10", "page");
        $address = $paginator->paginate($address);
        $links = $paginator->page_links();
        echo TemplateEngine::View("Pages.Backend.AdminCp.Addresses.index", ["url" => $url, "addresses" => $address, "links" => $links]);
    }

    public function show(Url $url, $id)
    {
        $id = base64_decode($id);
        $this->address = Address::where("id", $id)->get();

        echo TemplateEngine::View("Pages.Backend.AdminCp.Addresses.view", ["url" => $url, "request"=>$this]);
    }

    public function create(Url $url, ServerRequest $request)
    {
        echo TemplateEngine::View("Pages.Backend.AdminCp.Addresses.new", ["url" => $url, "action" => $this]);
    }


    public function store(Url $url, Csrf $csrf, Auth $auth, Validate $validate, AddressBook $addressBook)
    {

        if ($csrf->Verify() == true) {
            $validate->AddRequired(["title", "name", "street", "city", "county", "postcode"]);
            if ($validate->Allowed() == false) {
                $this->error = "The Following Fields have been left empty and are Required";
                $this->required = $validate->is_required;
            } else {
                $addressBook->new($this->entity_name);
                if ($addressBook->status == true) {
                    redirect($url->make("auth.admin.addresses.home"));
                }
                else
                {
                    $this->error = "Address Creation Failed";
                }
            }
        }
        echo TemplateEngine::View("Pages.Backend.AdminCp.Addresses.new", ["url" => $url, "request"=>$this]);
    }

    public function edit($id, Url $url)
    {
        $this->id = base64_decode($id);
        $this->address = Address::where("entity_name",$this->entity_name)->where("id",$this->id)->get();
        if($this->address->count() == 0)
        {
//            $this->address = $this->address->first();
            $this->error = "Request not found";
            $this->showform = false;
        }
        else
        {
            $this->address = $this->address->first();
            $this->showform = true;
        }
        echo TemplateEngine::View("Pages.Backend.AdminCp.Addresses.edit", ["url" => $url, "request"=>$this]);
    }

    public function update($id, Url $url, Csrf $csrf, Auth $auth, Validate $validate,AddressBook $addressBook)
    {
//        instantiate the csrf token

        $this->id = base64_decode($id);
        if ($csrf->Verify() == true) {
            $validate->AddRequired(["title", "name", "street", "city", "county", "postcode"]);

            if ($validate->Allowed() == false) {
                $this->error = "The Following Fields have been left empty and are Required";
                $this->required = $validate->is_required;
            } else {
                $addressBook->edit($this->id,$this->entity_name);
                if($addressBook->status == true)
                {
                    redirect($url->make("auth.admin.addresses.home"));
                }
                else
                {
                    $this->error = "Address Creation Failed";
                }
            }
            //            Display the template
        }
        else
        {
            $this->error = "csrf token is invalid";
        }
        echo TemplateEngine::View("Pages.Backend.AdminCp.Addresses.edit", ["url" => $url,"request"=>$this]);
    }

    public function delete(Url $url, $id,AddressBook $addressBook)
    {
        $this->id = base64_decode($id);
        $addressBook->delete($this->id);
        if($addressBook->status == true)
        {
            redirect($url->make("auth.admin.addresses.home"));
        }
        else
        {
         exit("Request could not be found or deleted : <a href='".$url->make("auth.admin.addresses.home")."'>Click here </a> to Go Back");
        }
    }
}