<?php

namespace Tests\Feature\Http\Controllers\Api\v1;

use App\Models\Encargo;
use App\Models\Reserva;
use App\Models\Servicio;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use JMac\Testing\Traits\AdditionalAssertions;
use PHPUnit\Framework\Attributes\Test;
use Tests\TestCase;

/**
 * @see \App\Http\Controllers\Api\v1\ServicioController
 */
final class ServicioControllerTest extends TestCase
{
    use AdditionalAssertions, RefreshDatabase, WithFaker;

    #[Test]
    public function index_behaves_as_expected(): void
    {
        $servicios = Servicio::factory()->count(3)->create();

        $response = $this->get(route('servicio.index'));

        $response->assertOk();
        $response->assertJsonStructure([]);
    }


    #[Test]
    public function store_uses_form_request_validation(): void
    {
        $this->assertActionUsesFormRequest(
            \App\Http\Controllers\Api\v1\ServicioController::class,
            'store',
            \App\Http\Requests\Api\v1\ServicioStoreRequest::class
        );
    }

    #[Test]
    public function store_saves(): void
    {
        $encargo = Encargo::factory()->create();
        $reserva = Reserva::factory()->create();

        $response = $this->post(route('servicio.store'), [
            'encargo_id' => $encargo->id,
            'reserva_id' => $reserva->id,
        ]);

        $servicios = Servicio::query()
            ->where('encargo_id', $encargo->id)
            ->where('reserva_id', $reserva->id)
            ->get();
        $this->assertCount(1, $servicios);
        $servicio = $servicios->first();

        $response->assertCreated();
        $response->assertJsonStructure([]);
    }


    #[Test]
    public function show_behaves_as_expected(): void
    {
        $servicio = Servicio::factory()->create();

        $response = $this->get(route('servicio.show', $servicio));

        $response->assertOk();
        $response->assertJsonStructure([]);
    }


    #[Test]
    public function update_uses_form_request_validation(): void
    {
        $this->assertActionUsesFormRequest(
            \App\Http\Controllers\Api\v1\ServicioController::class,
            'update',
            \App\Http\Requests\Api\v1\ServicioUpdateRequest::class
        );
    }

    #[Test]
    public function update_behaves_as_expected(): void
    {
        $servicio = Servicio::factory()->create();
        $encargo = Encargo::factory()->create();
        $reserva = Reserva::factory()->create();

        $response = $this->put(route('servicio.update', $servicio), [
            'encargo_id' => $encargo->id,
            'reserva_id' => $reserva->id,
        ]);

        $servicio->refresh();

        $response->assertOk();
        $response->assertJsonStructure([]);

        $this->assertEquals($encargo->id, $servicio->encargo_id);
        $this->assertEquals($reserva->id, $servicio->reserva_id);
    }


    #[Test]
    public function destroy_deletes_and_responds_with(): void
    {
        $servicio = Servicio::factory()->create();

        $response = $this->delete(route('servicio.destroy', $servicio));

        $response->assertNoContent();

        $this->assertModelMissing($servicio);
    }
}
