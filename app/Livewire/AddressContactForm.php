<?php

namespace App\Livewire;

use Livewire\Component;

class AddressContactForm extends Component
{
    public  $model;
    public $addresses = [];
    public $contacts = [];

    public function mount()
    {
       
        $this->addresses = $this->model->addresses()->get()->mapWithKeys(function ($address) {
            return [
                $address->id => [
                    'id' => $address->id,
                    'uuid' => $address->uuid,
                    'street' => $address->street,
                    'street_extra' => $address->street_extra,
                    'city' => $address->city,
                    'state' => $address->state,
                    'post_code' => $address->post_code,
                    'country_id' => $address->country_id,
                    'notes' => $address->notes,
                    'lat' => $address->lat,
                    'lng' => $address->lng,
                    'properties' => $address->properties,
                    'addressable_type' => $address->addressable_type,
                    'addressable_id' => $address->addressable_id,
                    'is_public' => $address->is_public,
                    'is_primary' => $address->is_primary,
                    'is_billing' => $address->is_billing,
                    'is_shipping' => $address->is_shipping,
                    'created_at' => $address->created_at,
                    'updated_at' => $address->updated_at,
                    'deleted_at' => $address->deleted_at,
                    'user_id' => $address->user_id,
                ],
            ];
        })->toArray();

        $this->contacts = $this->model->contacts()->get()->mapWithKeys(function ($contact) {
            return [
                $contact->id => [
                    'id' => $contact->id,
                    'uuid' => $contact->uuid,
                    'type' => $contact->type,
                    'gender' => $contact->gender,
                    'first_name' => $contact->first_name,
                    'middle_name' => $contact->middle_name,
                    'last_name' => $contact->last_name,
                    'company' => $contact->company,
                    'extra' => $contact->extra,
                    'position' => $contact->position,
                    'phone' => $contact->phone,
                    'mobile' => $contact->mobile,
                    'fax' => $contact->fax,
                    'email' => $contact->email,
                    'email_invoice' => $contact->email_invoice,
                    'website' => $contact->website,
                    'vat_id' => $contact->vat_id,
                    'address_id' => $contact->address_id,
                    'contactable_type' => $contact->contactable_type,
                    'contactable_id' => $contact->contactable_id,
                    'is_public' => $contact->is_public,
                    'is_primary' => $contact->is_primary,
                    'notes' => $contact->notes,
                    'properties' => $contact->properties,
                    'created_at' => $contact->created_at,
                    'updated_at' => $contact->updated_at,
                    'deleted_at' => $contact->deleted_at,
                    'title' => $contact->title,
                ],
            ];
        })->toArray();
        
        
        // $this->addresses=$this->model->addresses()->get(); 
    }
    public function addAddress()
    {
        $userId = auth()->id();

        $this->model->addresses()->create(['user_id' => $userId]);
    }


    public function updateAddress($addressId)
    {
        // Find the address by ID
        $address = $this->model->addresses()->findOrFail($addressId);

        // Update the address with the data from the component
        $address->update([
            'street' => $this->addresses[$addressId]['street'],
            'city' => $this->addresses[$addressId]['city'],
            'state' => $this->addresses[$addressId]['state'],
            'zip' => $this->addresses[$addressId]['zip'],
        ]);
    }

    public function removeAddress($id)
    {
        $this->model->addresses()->findOrFail($id)->delete();
    }

    public function addContact()
    {
        $this->model->contacts()->create([]);
    }

    public function updateContact($contactId)
    {
        // Find the contact by ID
        $contact = $this->model->contacts()->findOrFail($contactId);

        // Update the contact with the data from the component
        $contact->update([
            'middle_name' => $this->contacts[$contactId]['middle_name'],
            'first_name' => $this->contacts[$contactId]['first_name'],
            'email' => $this->contacts[$contactId]['email'],
            'phone' => $this->contacts[$contactId]['phone'],
        ]);
    }

    public function removeContact($id)
    {
        $this->model->contacts()->findOrFail($id)->delete();
    }

    public function render()
    {
        return view('livewire.address-contact-form');
    }
}
