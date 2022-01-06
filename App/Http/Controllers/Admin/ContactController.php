<?php
namespace App\Http\Controllers\Admin;


use App\Http\Functions\TemplateEngine;
use App\Http\Functions\Validate;
use App\Http\Libraries\Authentication\Csrf;
use App\Http\Models\Address;
use App\Http\Models\Resources;
use MiladRahimi\PhpRouter\Url;
use Plugins\Managers\AddressBook;
use Plugins\Managers\ResourceManager;

class ContactController
{


    public $addresses;
    public $request;
    public $resources;
    public $required;
    public $entity_name;
    public $showform;


//    Address book
    public $title;
    public $slug;
    public $name;
    public $street;
    public $street_2; //optional
    public $city;
    public $county;
    public $postcode;
    public $error;

//end Addressbook


//ResourceManager

    public $type;
    public $value;

    public function __construct(Validate $validate, AddressBook $addressBook)
    {
        $this->entity_name = "page/contact";

        if ($_SERVER['REQUEST_METHOD'] == "POST") {
            $this->title = $validate->Post("title");
            $this->slug = slug($validate->Post("title"));
            $this->name = $validate->Post("name");
            $this->street = $validate->Post("street");
            $this->street_2 = $validate->Post("street_2");
            $this->city = $validate->Post("city");
            $this->county = $validate->Post("county");
            $this->postcode = $validate->Post("postcode");
            $this->type = $validate->Post("type");
        }
        $this->showform = true;
        $this->type = $addressBook->type;
    }


//    Address management
    public function index(Url $url)
    {

        $this->address = Address::where("entity_name", $this->entity_name)->get();
        $this->resources = Resources::where("entity_name", $this->entity_name)->get();
        echo TemplateEngine::View("Pages.Backend.AdminCp.Contactus.index", ["url" => $url, "request" => $this]);
    }


    public function address_new(Url $url)
    {
        echo TemplateEngine::View("Pages.Backend.AdminCp.Contactus.Addresses.index", ["url" => $url, "request" => $this]);
    }

    public function address_store(Url $url, Csrf $csrf, Validate $validate, AddressBook $addressBook)
    {
        if ($csrf->Verify() == true) {
            $validate->AddRequired(["title", "name", "street", "city", "county", "postcode"]);
            if ($validate->Allowed() == false) {
                $this->error = "The Following Fields have been left empty and are Required";
                $this->required = $validate->is_required;
            } else {
                $addressBook->new($this->entity_name);
                if ($addressBook->status == true) {
                    redirect($url->make("auth.admin.contact.home"));
                } else {
                    $this->error = "Address Creation Failed";
                }
            }
        }

        echo TemplateEngine::View("Pages.Backend.AdminCp.Contactus.Addresses.index", ["url" => $url, "request" => $this]);
    }

    public function address_edit($id, Url $url)
    {
        $this->id = base64_decode($id);
        $this->address = Address::where("id", $this->id)->get();
        if ($this->address->count() == 1) {
            $this->address = $this->address->first();
        } else {
            $this->error = "Resource Not found";
        }
        echo TemplateEngine::View("Pages.Backend.AdminCp.Contactus.Addresses.edit", ["url" => $url, "request" => $this]);
    }

    public function address_update($id, Url $url, Csrf $csrf, Validate $validate, AddressBook $addressBook)
    {
        //        instantiate the csrf token

        $this->id = base64_decode($id);
        if ($csrf->Verify() == true) {
            $validate->AddRequired(["title", "name", "street", "city", "county", "postcode"]);

            if ($validate->Allowed() == false) {
                $this->error = "The Following Fields have been left empty and are Required";
                $this->required = $validate->is_required;
            } else {
                $addressBook->edit($this->id, $this->entity_name);
                if ($addressBook->status == true) {
                    redirect($url->make("auth.admin.contact.home"));
                } else {
                    $this->error = "Address Creation Failed";
                }
            }
        } else {
            $this->error = "csrf token is invalid";
        }
        echo TemplateEngine::View("Pages.Backend.AdminCp.Contactus.Addresses.edit", ["url" => $url, "request" => $this]);
    }


    public function address_delete(Url $url, $id, AddressBook $addressBook)
    {
        $this->id = base64_decode($id);
        $addressBook->delete($this->id);
        if ($addressBook->status == true) {
            redirect($url->make("auth.admin.contact.home"));
        } else {
            exit("Request could not be found or deleted : <a href='" . $url->make("auth.admin.contact.home") . "'>Click here </a> to Go Back");
        }
    }

//    End Address Management


    public function resource_new(Url $url)
    {
        echo TemplateEngine::View("Pages.Backend.AdminCp.Contactus.Resources.new", ["url" => $url, "request" => $this]);
    }


    public function resource_store(Url $url, Csrf $csrf, Validate $validate,ResourceManager $resourceManager)
{
        $validate->AddRequired(["name", "type", "value"]);
        if ($csrf->Verify() == true) {
            if ($validate->Allowed() == false) {
                $this->error = "Please enter the required fields";
                $this->required = $validate->is_required;
            } else {
                $resourceManager->new($this->entity_name);
                if ($resourceManager->status == true) {
                    redirect($url->make("auth.admin.contact.home"));
                } else {
                    $this->error = "save failed";
                }
            }
        } else {
            $this->error = "csrf token is invalid";
            $this->showform = false;
        }
        echo TemplateEngine::View("Pages.Backend.AdminCp.Contactus.Resources.new", ["url" => $url, "request" => $this]);
    }

    public function resource_edit($id,Url $url,ResourceManager $resourceManager, Csrf $csrf , Validate $validate)
    {
        $this->id = base64_decode($id);
        $this->resources = Resources::where("id",$this->id)->get();
        if($this->resources->count() == 1)
        {
            $this->resources = $this->resources->first();
        }
        else
        {
            $this->error = "Resource cannot be found";
            $this->showform = false;
        }
        echo TemplateEngine::View("Pages.Backend.AdminCp.Contactus.Resources.edit", ["url" => $url, "request" => $this]);
    }

    public function resource_update($id,Url $url,ResourceManager $resourceManager, Csrf $csrf , Validate $validate)
    {
        $this->id = base64_decode($id);
        echo $this->id;
    }


    public function resource_delete(Url $url,$id,ResourceManager $resourceManager)
    {
        $this->id = base64_decode($id);
        $resourceManager->delete($this->id);
        if($resourceManager->status == true)
        {
            redirect($url->make("auth.admin.contact.home"));
        }
        else
        {
            $this->error =  "delete failed";
        }
    }

//    End resource manager
}