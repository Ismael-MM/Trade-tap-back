<?php

namespace Tests\Feature\Http\Controllers\Api\v1;

use App\Models\Cliente;
use App\Models\Reserva;
use App\Models\Trabajador;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use JMac\Testing\Traits\AdditionalAssertions;
use PHPUnit\Framework\Attributes\Test;
use Tests\TestCase;

/**
 * @see \App\Http\Controllers\Api\v1\ReservaController
 */
final class ReservaControllerTest extends TestCase
{
    use AdditionalAssertions, RefreshDatabase, WithFaker;

    #[Test]
    public function index_behaves_as_expected(): void
    {
        $reservas = Reserva::factory()->count(3)->create();

        $response = $this->get(route('reserva.index'));

        $response->assertOk();
        $response->assertJsonStructure([]);
    }


    #[Test]
    public function store_uses_form_request_validation(): void
    {
        $this->assertActionUsesFormRequest(
            \App\Http\Controllers\Api\v1\ReservaController::class,
            'store',
            \App\Http\Requests\Api\v1\ReservaStoreRequest::class
        );
    }

    #[Test]
    public function store_saves(): void
    {
        $estado = $this->faker->randomElement(/** enum_attributes **/);
        $trabajador = Trabajador::factory()->create();
        $cliente = Cliente::factory()->create();

        $response = $this->post(route('reserva.store'), [
            'estado' => $estado,
            'trabajador_id' => $trabajador->id,
            'cliente_id' => $cliente->id,
        ]);

        $reservas = Reserva::query()
            ->where('estado', $estado)
            ->where('trabajador_id', $trabajador->id)
            ->where('cliente_id', $cliente->id)
            ->get();
        $this->assertCount(1, $reservas);
        $reserva = $reservas->first();

        $response->assertCreated();
        $response->assertJsonStructure([]);
    }


    #[Test]
    public function show_behaves_as_expected(): void
    {
        $reserva = Reserva::factory()->create();

        $response = $this->get(route('reserva.show', $reserva));

        $response->assertOk();
        $response->assertJsonStructure([]);
    }


    #[Test]
    public function update_uses_form_request_validation(): void
    {
        $this->assertActionUsesFormRequest(
            \App\Http\Controllers\Api\v1\ReservaController::class,
            'update',
            \App\Http\Requests\Api\v1\ReservaUpdateRequest::class
        );
    }

    #[Test]
    public function update_behaves_as_expected(): void
    {
        $reserva = Reserva::factory()->create();
        $estado = $this->faker->randomElement(/** enum_attributes **/);
        $trabajador = Trabajador::factory()->create();
        $cliente = Cliente::factory()->create();

        $response = $this->put(route('reserva.update', $reserva), [
            'estado' => $estado,
            'trabajador_id' => $trabajador->id,
            'cliente_id' => $cliente->id,
        ]);

        $reserva->refresh();

        $response->assertOk();
        $response->assertJsonStructure([]);

        $this->assertEquals($estado, $reserva->estado);
        $this->assertEquals($trabajador->id, $reserva->trabajador_id);
        $this->assertEquals($cliente->id, $reserva->cliente_id);
    }


    #[Test]
    public function destroy_deletes_and_responds_with(): void
    {
        $reserva = Reserva::factory()->create();

        $response = $this->delete(route('reserva.destroy', $reserva));

        $response->assertNoContent();

        $this->assertModelMissing($reserva);
    }
}
