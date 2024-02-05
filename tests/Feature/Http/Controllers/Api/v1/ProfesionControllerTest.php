<?php

namespace Tests\Feature\Http\Controllers\Api\v1;

use App\Models\Profesion;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use JMac\Testing\Traits\AdditionalAssertions;
use PHPUnit\Framework\Attributes\Test;
use Tests\TestCase;

/**
 * @see \App\Http\Controllers\Api\v1\ProfesionController
 */
final class ProfesionControllerTest extends TestCase
{
    use AdditionalAssertions, RefreshDatabase, WithFaker;

    #[Test]
    public function index_behaves_as_expected(): void
    {
        $profesions = Profesion::factory()->count(3)->create();

        $response = $this->get(route('profesion.index'));

        $response->assertOk();
        $response->assertJsonStructure([]);
    }


    #[Test]
    public function store_uses_form_request_validation(): void
    {
        $this->assertActionUsesFormRequest(
            \App\Http\Controllers\Api\v1\ProfesionController::class,
            'store',
            \App\Http\Requests\Api\v1\ProfesionStoreRequest::class
        );
    }

    #[Test]
    public function store_saves(): void
    {
        $nombre = $this->faker->word();
        $familia_profesional = $this->faker->word();

        $response = $this->post(route('profesion.store'), [
            'nombre' => $nombre,
            'familia_profesional' => $familia_profesional,
        ]);

        $profesions = Profesion::query()
            ->where('nombre', $nombre)
            ->where('familia_profesional', $familia_profesional)
            ->get();
        $this->assertCount(1, $profesions);
        $profesion = $profesions->first();

        $response->assertCreated();
        $response->assertJsonStructure([]);
    }


    #[Test]
    public function show_behaves_as_expected(): void
    {
        $profesion = Profesion::factory()->create();

        $response = $this->get(route('profesion.show', $profesion));

        $response->assertOk();
        $response->assertJsonStructure([]);
    }


    #[Test]
    public function update_uses_form_request_validation(): void
    {
        $this->assertActionUsesFormRequest(
            \App\Http\Controllers\Api\v1\ProfesionController::class,
            'update',
            \App\Http\Requests\Api\v1\ProfesionUpdateRequest::class
        );
    }

    #[Test]
    public function update_behaves_as_expected(): void
    {
        $profesion = Profesion::factory()->create();
        $nombre = $this->faker->word();
        $familia_profesional = $this->faker->word();

        $response = $this->put(route('profesion.update', $profesion), [
            'nombre' => $nombre,
            'familia_profesional' => $familia_profesional,
        ]);

        $profesion->refresh();

        $response->assertOk();
        $response->assertJsonStructure([]);

        $this->assertEquals($nombre, $profesion->nombre);
        $this->assertEquals($familia_profesional, $profesion->familia_profesional);
    }


    #[Test]
    public function destroy_deletes_and_responds_with(): void
    {
        $profesion = Profesion::factory()->create();

        $response = $this->delete(route('profesion.destroy', $profesion));

        $response->assertNoContent();

        $this->assertModelMissing($profesion);
    }
}
