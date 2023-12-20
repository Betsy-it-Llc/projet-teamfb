<?php
namespace App\Traits;

use App\Models\User;
use Illuminate\Support\Facades\Hash;

trait SyncsWithUserModel {

    public function syncWithUser(array $userData): User {
        $userData['password'] = Hash::make($userData['password']);

        // On utilise la classe du modèle actuel comme origine
        $userData['origin'] = static::class;

        $user = User::updateOrCreate(
            ['email' => $userData['email']],
            $userData
        );

        // $this->user_id = $user->id;
        // $this->save();

        return $user;
    }


    // Vérification de la synchronisation de l'utilisateur.
    public function isUserSynced(string $email): bool
    {
        return User::where('email', $email)->exists();
    }
}
