<?php

namespace App\Contracts;

use Lecturize\Addresses\Traits\HasContacts;
use Lecturize\Addresses\Traits\HasAddresses;

interface HasContactsAndAddresses
{
    use HasContacts, HasAddresses;
}