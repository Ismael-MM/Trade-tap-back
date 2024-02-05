<?php

namespace Tests\Feature\Http\Controllers\Api\v1;

use App\Models\Cliente;
use App\Models\Solicitud;
use App\Models\Trabajador;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use JMac\Testing\Traits\AdditionalAssertions;
use PHPUnit\Framework\Attributes\Test;
use Tests\TestCase;

/**
 * @see \App\Http\Controllers\Api\v1\SolicitudController
 */
final class SolicitudControllerTest extends TestCase
{
    use AdditionalAssertions, RefreshDatabase, WithFaker;

    #[Test]
    public function index_behaves_as_expected(): void
    {
        $solicituds = Solicitud::factory()->count(3)->create();

        $response = $this->get(route('solicitud.index'));

        $response->assertOk();
        $response->assertJsonStructure([]);
    }


    #[Test]
    public function store_uses_form_request_validation(): void
    {
        $this->assertActionUsesFormRequest(
            \App\Http\Controllers\Api\v1\SolicitudController::class,
            'store',
            \App\Http\Requests\Api\v1\SolicitudStoreRequest::class
        );
    }

    #[Test]
    public function store_saves(): void
    {
        $descripcion = $this->faker->text();
        $titulo = $this->faker->word();
        $estado = $this->faker->randomElement(/** enum_attributes **/);
        $trabajador = Trabajador::factory()->create();
        $cliente = Cliente::factory()->create();

        $response = $this->post(route('solicitud.store'), [
            'descripcion' => $descripcion,
            'titulo' => $titulo,
            'estado' => $estado,
            'trabajador_id' => $trabajador->id,
            'cliente_id' => $cliente->id,
        ]);

        $solicituds = Solicitud::query()
            ->where('descripcion', $descripcion)
            ->where('titulo', $titulo)
            ->where('estado', $estado)
            ->where('trabajador_id', $trabajador->id)
            ->where('cliente_id', $cliente->id)
            ->get();
        $this->assertCount(1, $solicituds);
        $solicitud = $solicituds->first();

        $response->assertCreated();
        $response->assertJsonStructure([]);
    }


    #[Test]
    public function show_behaves_as_expected(): void
    {
        $solicitud = Solicitud::factory()->create();

        $response = $this->get(route('solicitud.show', $solicitud));

        $response->assertOk();
        $response->assertJsonStructure([]);
    }


    #[Test]
    public function update_uses_form_request_validation(): void
    {
        $this->assertActionUsesFormRequest(
            \App\Http\Controllers\Api\v1\SolicitudController::class,
            'update',
            \App\Http\Requests\Api\v1\SolicitudUpdateRequest::class
        );
    }

    #[Test]
    public function update_behaves_as_expected(): void
    {
        $solicitud = Solicitud::factory()->create();
        $descripcion = $this->faker->text();
        $titulo = $this->faker->word();
        $estado = $this->faker->randomElement(/** enum_attributes **/);
        $trabajador = Trabajador::factory()->create();
        $cliente = Cliente::factory()->create();

        $response = $this->put(route('solicitud.update', $solicitud), [
            'descripcion' => $descripcion,
            'titulo' => $titulo,
            'estado' => $estado,
            'trabajador_id' => $trabajador->id,
            'cliente_id' => $cliente->id,
        ]);

        $solicitud->refresh();

        $response->assertOk();
        $response->assertJsonStructure([]);

        $this->assertEquals($descripcion, $solicitud->descripcion);
        $this->assertEquals($titulo, $solicitud->titulo);
        $this->assertEquals($estado, $solicitud->estado);
        $this->assertEquals($trabajador->id, $solicitud->trabajador_id);
        $this->assertEquals($cliente->id, $solicitud->cliente_id);
    }


    #[Test]
    public function destroy_deletes_and_responds_with(): void
    {
        $solicitud = Solicitud::factory()->create();

        $response = $this->delete(route('solicitud.destroy', $solicitud));

        $response->assertNoContent();

        $this->assertModelMissing($solicitud);
    }
}
