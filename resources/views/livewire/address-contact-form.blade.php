<div class="container mt-4">
    <div class="mb-4">
        <h2>Addresses</h2>
        @foreach ($model->addresses as $address)
            <div class="mb-3">
                <input class="mb-2 form-control" wire:model="addresses.{{ $address->id }}.street" type="text" placeholder="Street" />
                <input class="mb-2 form-control" wire:model="addresses.{{ $address->id }}.city" type="text" placeholder="City" />
                <input class="mb-2 form-control" wire:model="addresses.{{ $address->id }}.state" type="text" placeholder="State" />
                <input class="mb-2 form-control" wire:model="addresses.{{ $address->id }}.zip" type="text" placeholder="Zip" />
                <button class="mb-2 btn btn-primary" wire:click="updateAddress({{ $address->id }})">Sauvegarder</button>
                <button class="mb-2 btn btn-danger" wire:confirm="Êtes-vous sûr de vouloir supprimer cette adresse ? Cette action est irréversible." wire:click="removeAddress({{ $address->id }})">Supprimer</button>
            </div>
        @endforeach
        <button class="btn btn-primary" wire:click="addAddress">Add Address</button>
    </div>

    <div>
        <h2>Contacts</h2>
        @foreach ($model->contacts as $contact)
            <div class="mb-3">
                <input class="mb-2 form-control" wire:model="contacts.{{ $contact->id }}.middle_name" type="text" placeholder="Nom" />
                <input class="mb-2 form-control" wire:model="contacts.{{ $contact->id }}.first_name" type="text" placeholder="Prénom" />
                <input class="mb-2 form-control" wire:model="contacts.{{ $contact->id }}.email" type="text" placeholder="Email" />
                <input class="mb-2 form-control" wire:model="contacts.{{ $contact->id }}.phone" type="text" placeholder="Phone" />
                <button class="mb-2 btn btn-primary" wire:click="updateContact({{ $contact->id }})">Sauvegarder</button>
                <button class="mb-2 btn btn-danger" wire:confirm="Êtes-vous sûr de vouloir supprimer ce contact ? Cette action est irréversible." wire:click="removeContact({{ $contact->id }})">Supprimer</button>
            </div>
        @endforeach
        <button class="btn btn-primary" wire:click="addContact">Add Contact</button>
    </div>
</div>
