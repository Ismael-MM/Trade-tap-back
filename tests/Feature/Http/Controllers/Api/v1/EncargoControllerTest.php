<?php

namespace Tests\Feature\Http\Controllers\Api\v1;

use App\Models\Cliente;
use App\Models\Encargo;
use App\Models\Trabajador;
use Carbon\Carbon;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use JMac\Testing\Traits\AdditionalAssertions;
use PHPUnit\Framework\Attributes\Test;
use Tests\TestCase;

/**
 * @see \App\Http\Controllers\Api\v1\EncargoController
 */
final class EncargoControllerTest extends TestCase
{
    use AdditionalAssertions, RefreshDatabase, WithFaker;

    #[Test]
    public function index_behaves_as_expected(): void
    {
        $encargos = Encargo::factory()->count(3)->create();

        $response = $this->get(route('encargo.index'));

        $response->assertOk();
        $response->assertJsonStructure([]);
    }


    #[Test]
    public function store_uses_form_request_validation(): void
    {
        $this->assertActionUsesFormRequest(
            \App\Http\Controllers\Api\v1\EncargoController::class,
            'store',
            \App\Http\Requests\Api\v1\EncargoStoreRequest::class
        );
    }

    #[Test]
    public function store_saves(): void
    {
        $estado = $this->faker->randomElement(/** enum_attributes **/);
        $fecha_entregada = $this->faker->date();
        $fecha_entregada1 = $this->faker->date();
        $trabajador = Trabajador::factory()->create();
        $cliente = Cliente::factory()->create();

        $response = $this->post(route('encargo.store'), [
            'estado' => $estado,
            'fecha_entregada' => $fecha_entregada,
            'fecha_entregada1' => $fecha_entregada1,
            'trabajador_id' => $trabajador->id,
            'cliente_id' => $cliente->id,
        ]);

        $encargos = Encargo::query()
            ->where('estado', $estado)
            ->where('fecha_entregada', $fecha_entregada)
            ->where('fecha_entregada1', $fecha_entregada1)
            ->where('trabajador_id', $trabajador->id)
            ->where('cliente_id', $cliente->id)
            ->get();
        $this->assertCount(1, $encargos);
        $encargo = $encargos->first();

        $response->assertCreated();
        $response->assertJsonStructure([]);
    }


    #[Test]
    public function show_behaves_as_expected(): void
    {
        $encargo = Encargo::factory()->create();

        $response = $this->get(route('encargo.show', $encargo));

        $response->assertOk();
        $response->assertJsonStructure([]);
    }


    #[Test]
    public function update_uses_form_request_validation(): void
    {
        $this->assertActionUsesFormRequest(
            \App\Http\Controllers\Api\v1\EncargoController::class,
            'update',
            \App\Http\Requests\Api\v1\EncargoUpdateRequest::class
        );
    }

    #[Test]
    public function update_behaves_as_expected(): void
    {
        $encargo = Encargo::factory()->create();
        $estado = $this->faker->randomElement(/** enum_attributes **/);
        $fecha_entregada = $this->faker->date();
        $fecha_entregada1 = $this->faker->date();
        $trabajador = Trabajador::factory()->create();
        $cliente = Cliente::factory()->create();

        $response = $this->put(route('encargo.update', $encargo), [
            'estado' => $estado,
            'fecha_entregada' => $fecha_entregada,
            'fecha_entregada1' => $fecha_entregada1,
            'trabajador_id' => $trabajador->id,
            'cliente_id' => $cliente->id,
        ]);

        $encargo->refresh();

        $response->assertOk();
        $response->assertJsonStructure([]);

        $this->assertEquals($estado, $encargo->estado);
        $this->assertEquals(Carbon::parse($fecha_entregada), $encargo->fecha_entregada);
        $this->assertEquals(Carbon::parse($fecha_entregada1), $encargo->fecha_entregada1);
        $this->assertEquals($trabajador->id, $encargo->trabajador_id);
        $this->assertEquals($cliente->id, $encargo->cliente_id);
    }


    #[Test]
    public function destroy_deletes_and_responds_with(): void
    {
        $encargo = Encargo::factory()->create();

        $response = $this->delete(route('encargo.destroy', $encargo));

        $response->assertNoContent();

        $this->assertModelMissing($encargo);
    }
}
