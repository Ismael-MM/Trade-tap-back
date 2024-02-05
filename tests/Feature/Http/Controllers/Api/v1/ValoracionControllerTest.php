<?php

namespace Tests\Feature\Http\Controllers\Api\v1;

use App\Models\Cliente;
use App\Models\Servicio;
use App\Models\Trabajador;
use App\Models\Valoracion;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use JMac\Testing\Traits\AdditionalAssertions;
use PHPUnit\Framework\Attributes\Test;
use Tests\TestCase;

/**
 * @see \App\Http\Controllers\Api\v1\ValoracionController
 */
final class ValoracionControllerTest extends TestCase
{
    use AdditionalAssertions, RefreshDatabase, WithFaker;

    #[Test]
    public function index_behaves_as_expected(): void
    {
        $valoracions = Valoracion::factory()->count(3)->create();

        $response = $this->get(route('valoracion.index'));

        $response->assertOk();
        $response->assertJsonStructure([]);
    }


    #[Test]
    public function store_uses_form_request_validation(): void
    {
        $this->assertActionUsesFormRequest(
            \App\Http\Controllers\Api\v1\ValoracionController::class,
            'store',
            \App\Http\Requests\Api\v1\ValoracionStoreRequest::class
        );
    }

    #[Test]
    public function store_saves(): void
    {
        $Puntuacion = $this->faker->randomFloat(/** decimal_attributes **/);
        $cliente = Cliente::factory()->create();
        $trabajador = Trabajador::factory()->create();
        $serivicio_id = $this->faker->randomNumber();
        $servicio = Servicio::factory()->create();

        $response = $this->post(route('valoracion.store'), [
            'Puntuacion' => $Puntuacion,
            'cliente_id' => $cliente->id,
            'trabajador_id' => $trabajador->id,
            'serivicio_id' => $serivicio_id,
            'servicio_id' => $servicio->id,
        ]);

        $valoracions = Valoracion::query()
            ->where('Puntuacion', $Puntuacion)
            ->where('cliente_id', $cliente->id)
            ->where('trabajador_id', $trabajador->id)
            ->where('serivicio_id', $serivicio_id)
            ->where('servicio_id', $servicio->id)
            ->get();
        $this->assertCount(1, $valoracions);
        $valoracion = $valoracions->first();

        $response->assertCreated();
        $response->assertJsonStructure([]);
    }


    #[Test]
    public function show_behaves_as_expected(): void
    {
        $valoracion = Valoracion::factory()->create();

        $response = $this->get(route('valoracion.show', $valoracion));

        $response->assertOk();
        $response->assertJsonStructure([]);
    }


    #[Test]
    public function update_uses_form_request_validation(): void
    {
        $this->assertActionUsesFormRequest(
            \App\Http\Controllers\Api\v1\ValoracionController::class,
            'update',
            \App\Http\Requests\Api\v1\ValoracionUpdateRequest::class
        );
    }

    #[Test]
    public function update_behaves_as_expected(): void
    {
        $valoracion = Valoracion::factory()->create();
        $Puntuacion = $this->faker->randomFloat(/** decimal_attributes **/);
        $cliente = Cliente::factory()->create();
        $trabajador = Trabajador::factory()->create();
        $serivicio_id = $this->faker->randomNumber();
        $servicio = Servicio::factory()->create();

        $response = $this->put(route('valoracion.update', $valoracion), [
            'Puntuacion' => $Puntuacion,
            'cliente_id' => $cliente->id,
            'trabajador_id' => $trabajador->id,
            'serivicio_id' => $serivicio_id,
            'servicio_id' => $servicio->id,
        ]);

        $valoracion->refresh();

        $response->assertOk();
        $response->assertJsonStructure([]);

        $this->assertEquals($Puntuacion, $valoracion->Puntuacion);
        $this->assertEquals($cliente->id, $valoracion->cliente_id);
        $this->assertEquals($trabajador->id, $valoracion->trabajador_id);
        $this->assertEquals($serivicio_id, $valoracion->serivicio_id);
        $this->assertEquals($servicio->id, $valoracion->servicio_id);
    }


    #[Test]
    public function destroy_deletes_and_responds_with(): void
    {
        $valoracion = Valoracion::factory()->create();

        $response = $this->delete(route('valoracion.destroy', $valoracion));

        $response->assertNoContent();

        $this->assertModelMissing($valoracion);
    }
}
