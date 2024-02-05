<?php

namespace Tests\Feature\Http\Controllers\Api\v1;

use App\Models\Trabajador;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use JMac\Testing\Traits\AdditionalAssertions;
use PHPUnit\Framework\Attributes\Test;
use Tests\TestCase;

/**
 * @see \App\Http\Controllers\Api\v1\TrabajadorController
 */
final class TrabajadorControllerTest extends TestCase
{
    use AdditionalAssertions, RefreshDatabase, WithFaker;

    #[Test]
    public function index_behaves_as_expected(): void
    {
        $trabajadors = Trabajador::factory()->count(3)->create();

        $response = $this->get(route('trabajador.index'));

        $response->assertOk();
        $response->assertJsonStructure([]);
    }


    #[Test]
    public function store_uses_form_request_validation(): void
    {
        $this->assertActionUsesFormRequest(
            \App\Http\Controllers\Api\v1\TrabajadorController::class,
            'store',
            \App\Http\Requests\Api\v1\TrabajadorStoreRequest::class
        );
    }

    #[Test]
    public function store_saves(): void
    {
        $cif = $this->faker->word();
        $descripcion = $this->faker->text();
        $situacion = $this->faker->randomElement(/** enum_attributes **/);

        $response = $this->post(route('trabajador.store'), [
            'cif' => $cif,
            'descripcion' => $descripcion,
            'situacion' => $situacion,
        ]);

        $trabajadors = Trabajador::query()
            ->where('cif', $cif)
            ->where('descripcion', $descripcion)
            ->where('situacion', $situacion)
            ->get();
        $this->assertCount(1, $trabajadors);
        $trabajador = $trabajadors->first();

        $response->assertCreated();
        $response->assertJsonStructure([]);
    }


    #[Test]
    public function show_behaves_as_expected(): void
    {
        $trabajador = Trabajador::factory()->create();

        $response = $this->get(route('trabajador.show', $trabajador));

        $response->assertOk();
        $response->assertJsonStructure([]);
    }


    #[Test]
    public function update_uses_form_request_validation(): void
    {
        $this->assertActionUsesFormRequest(
            \App\Http\Controllers\Api\v1\TrabajadorController::class,
            'update',
            \App\Http\Requests\Api\v1\TrabajadorUpdateRequest::class
        );
    }

    #[Test]
    public function update_behaves_as_expected(): void
    {
        $trabajador = Trabajador::factory()->create();
        $cif = $this->faker->word();
        $descripcion = $this->faker->text();
        $situacion = $this->faker->randomElement(/** enum_attributes **/);

        $response = $this->put(route('trabajador.update', $trabajador), [
            'cif' => $cif,
            'descripcion' => $descripcion,
            'situacion' => $situacion,
        ]);

        $trabajador->refresh();

        $response->assertOk();
        $response->assertJsonStructure([]);

        $this->assertEquals($cif, $trabajador->cif);
        $this->assertEquals($descripcion, $trabajador->descripcion);
        $this->assertEquals($situacion, $trabajador->situacion);
    }


    #[Test]
    public function destroy_deletes_and_responds_with(): void
    {
        $trabajador = Trabajador::factory()->create();

        $response = $this->delete(route('trabajador.destroy', $trabajador));

        $response->assertNoContent();

        $this->assertModelMissing($trabajador);
    }
}
