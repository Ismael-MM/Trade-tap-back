<?php

namespace Tests\Feature\Http\Controllers\Api\v1;

use App\Models\Cliente;
use App\Models\Propuesta;
use App\Models\Propuestum;
use App\Models\Trabajador;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use JMac\Testing\Traits\AdditionalAssertions;
use PHPUnit\Framework\Attributes\Test;
use Tests\TestCase;

/**
 * @see \App\Http\Controllers\Api\v1\PropuestaController
 */
final class PropuestaControllerTest extends TestCase
{
    use AdditionalAssertions, RefreshDatabase, WithFaker;

    #[Test]
    public function index_behaves_as_expected(): void
    {
        $propuesta = Propuesta::factory()->count(3)->create();

        $response = $this->get(route('propuestum.index'));

        $response->assertOk();
        $response->assertJsonStructure([]);
    }


    #[Test]
    public function store_uses_form_request_validation(): void
    {
        $this->assertActionUsesFormRequest(
            \App\Http\Controllers\Api\v1\PropuestaController::class,
            'store',
            \App\Http\Requests\Api\v1\PropuestaStoreRequest::class
        );
    }

    #[Test]
    public function store_saves(): void
    {
        $nombre = $this->faker->word();
        $descripcion = $this->faker->text();
        $cliente = Cliente::factory()->create();
        $trabajador = Trabajador::factory()->create();

        $response = $this->post(route('propuestum.store'), [
            'nombre' => $nombre,
            'descripcion' => $descripcion,
            'cliente_id' => $cliente->id,
            'trabajador_id' => $trabajador->id,
        ]);

        $propuesta = Propuestum::query()
            ->where('nombre', $nombre)
            ->where('descripcion', $descripcion)
            ->where('cliente_id', $cliente->id)
            ->where('trabajador_id', $trabajador->id)
            ->get();
        $this->assertCount(1, $propuesta);
        $propuestum = $propuesta->first();

        $response->assertCreated();
        $response->assertJsonStructure([]);
    }


    #[Test]
    public function show_behaves_as_expected(): void
    {
        $propuestum = Propuesta::factory()->create();

        $response = $this->get(route('propuestum.show', $propuestum));

        $response->assertOk();
        $response->assertJsonStructure([]);
    }


    #[Test]
    public function update_uses_form_request_validation(): void
    {
        $this->assertActionUsesFormRequest(
            \App\Http\Controllers\Api\v1\PropuestaController::class,
            'update',
            \App\Http\Requests\Api\v1\PropuestaUpdateRequest::class
        );
    }

    #[Test]
    public function update_behaves_as_expected(): void
    {
        $propuestum = Propuesta::factory()->create();
        $nombre = $this->faker->word();
        $descripcion = $this->faker->text();
        $cliente = Cliente::factory()->create();
        $trabajador = Trabajador::factory()->create();

        $response = $this->put(route('propuestum.update', $propuestum), [
            'nombre' => $nombre,
            'descripcion' => $descripcion,
            'cliente_id' => $cliente->id,
            'trabajador_id' => $trabajador->id,
        ]);

        $propuestum->refresh();

        $response->assertOk();
        $response->assertJsonStructure([]);

        $this->assertEquals($nombre, $propuestum->nombre);
        $this->assertEquals($descripcion, $propuestum->descripcion);
        $this->assertEquals($cliente->id, $propuestum->cliente_id);
        $this->assertEquals($trabajador->id, $propuestum->trabajador_id);
    }


    #[Test]
    public function destroy_deletes_and_responds_with(): void
    {
        $propuestum = Propuesta::factory()->create();
        $propuestum = Propuestum::factory()->create();

        $response = $this->delete(route('propuestum.destroy', $propuestum));

        $response->assertNoContent();

        $this->assertModelMissing($propuestum);
    }
}
