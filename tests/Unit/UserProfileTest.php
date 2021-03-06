<?php

namespace Tests\Unit;

use App\User;
use App\UserProfile;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Tests\TestCase;

class UserProfileTest extends TestCase
{
    /**
     * @test
     * @testdox Un perfil de usuario pertenece a un usuario.
     */
    function a_user_profile_belongs_to_a_user()
    {
        // $this->markTestIncomplete();

        $user = factory(User::class)->create();
        $userProfile = factory(UserProfile::class)->create([
            'website' => 'https://styde.net',
            'user_id' => $user->id,
        ]);

        // Prueba que sea una relacion de pertenecencia
        $this->assertInstanceOf(BelongsTo::class, $userProfile->user());
        // Prueba que seea de la misma instancia
        $this->assertInstanceOf(User::class, $userProfile->user);
        $this->assertTrue($userProfile->user->is($user));
    }
}
