<?php
namespace Plugins\Managers;

use App\Http\Functions\Validate;
use App\Http\Models\Address;
use MiladRahimi\PhpRouter\Url;

class AddressBook
{

    /* Add this into your forms when you require an address file
     *
     * //    Linked to Address book
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
    }

    within your view for @include("Includes.Forms.Addresses.new)
    within your view for edit form @include("Includes.Forms.Addresses.edit)

    the includes do not have the form tags or the button these are required within your page you wish toi include as the action address can change depending on your needs button may have seperate values

     * */


    public $title;
    public $slug;
    public $name;
    public $street;
    public $street_2; //optional
    public $city;
    public $county;
    public $postcode;
    public $status;
    public $error;
    public $type;


    public function push(Url $url, $entity_name)
    {
        switch ($entity_name) {
            case "page/contact";
                redirect($url->make("auth.admin.contact.home"));
                break;
            case "address/general";
                redirect($url->make("auth.admin.addresses.home"));
                break;
            default;
                break;
        }


    public function __construct(Validate $validate)
    {
        $this->status = false;

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
        $this->type = ["url","email","telephone"];
    }


    public function new($entity_name)
    {
        $address = new Address();
        $address->entity_name = $entity_name;
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
            $this->status = true;
        }
        else
        {
            $this->status = false;
        }
    }

    public function edit($id,$entity_name)
    {
        $address = Address::where("id", $id)->get();
        $this->count = $address->count();
        if($this->count == 1)
        {
            $address = $address->first();
            $address->title = $this->title;
            $address->entity_name = $entity_name;
            $address->slug = slug($this->title);
            $address->name = $this->name;
            $address->street = $this->street;
            $address->street_2 = $this->street_2;
            $address->city = $this->city;
            $address->county = $this->county;
            $address->postcode = $this->postcode;
            if ($address->save()) {
                $this->status = true;
            } else {
                $this->status = false;
            }
        }
        else
        {
            $this->error = "We could not find the request you was looking for";
        }

    }

    public function override()
    {

    }

    public function delete($id)
    {
        $address = Address::where("id", $id);
        if ($address->count() == 1) {
            $address->delete();
            $this->status = true;
        } else {
            echo "not deleted";
            $this->status = false;
        }
    }
}