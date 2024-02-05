<?php

namespace Tests\Feature\Http\Controllers\Api\v1;

use App\Models\HorarioReserva;
use App\Models\Reserva;
use Carbon\Carbon;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use JMac\Testing\Traits\AdditionalAssertions;
use PHPUnit\Framework\Attributes\Test;
use Tests\TestCase;

/**
 * @see \App\Http\Controllers\Api\v1\HorarioReservaController
 */
final class HorarioReservaControllerTest extends TestCase
{
    use AdditionalAssertions, RefreshDatabase, WithFaker;

    #[Test]
    public function index_behaves_as_expected(): void
    {
        $horarioReservas = HorarioReserva::factory()->count(3)->create();

        $response = $this->get(route('horario-reserva.index'));

        $response->assertOk();
        $response->assertJsonStructure([]);
    }


    #[Test]
    public function store_uses_form_request_validation(): void
    {
        $this->assertActionUsesFormRequest(
            \App\Http\Controllers\Api\v1\HorarioReservaController::class,
            'store',
            \App\Http\Requests\Api\v1\HorarioReservaStoreRequest::class
        );
    }

    #[Test]
    public function store_saves(): void
    {
        $fecha = $this->faker->date();
        $hora_comienzo = $this->faker->dateTime();
        $hora_final = $this->faker->dateTime();
        $reserva = Reserva::factory()->create();

        $response = $this->post(route('horario-reserva.store'), [
            'fecha' => $fecha,
            'hora_comienzo' => $hora_comienzo,
            'hora_final' => $hora_final,
            'reserva_id' => $reserva->id,
        ]);

        $horarioReservas = HorarioReserva::query()
            ->where('fecha', $fecha)
            ->where('hora_comienzo', $hora_comienzo)
            ->where('hora_final', $hora_final)
            ->where('reserva_id', $reserva->id)
            ->get();
        $this->assertCount(1, $horarioReservas);
        $horarioReserva = $horarioReservas->first();

        $response->assertCreated();
        $response->assertJsonStructure([]);
    }


    #[Test]
    public function show_behaves_as_expected(): void
    {
        $horarioReserva = HorarioReserva::factory()->create();

        $response = $this->get(route('horario-reserva.show', $horarioReserva));

        $response->assertOk();
        $response->assertJsonStructure([]);
    }


    #[Test]
    public function update_uses_form_request_validation(): void
    {
        $this->assertActionUsesFormRequest(
            \App\Http\Controllers\Api\v1\HorarioReservaController::class,
            'update',
            \App\Http\Requests\Api\v1\HorarioReservaUpdateRequest::class
        );
    }

    #[Test]
    public function update_behaves_as_expected(): void
    {
        $horarioReserva = HorarioReserva::factory()->create();
        $fecha = $this->faker->date();
        $hora_comienzo = $this->faker->dateTime();
        $hora_final = $this->faker->dateTime();
        $reserva = Reserva::factory()->create();

        $response = $this->put(route('horario-reserva.update', $horarioReserva), [
            'fecha' => $fecha,
            'hora_comienzo' => $hora_comienzo,
            'hora_final' => $hora_final,
            'reserva_id' => $reserva->id,
        ]);

        $horarioReserva->refresh();

        $response->assertOk();
        $response->assertJsonStructure([]);

        $this->assertEquals(Carbon::parse($fecha), $horarioReserva->fecha);
        $this->assertEquals($hora_comienzo, $horarioReserva->hora_comienzo);
        $this->assertEquals($hora_final, $horarioReserva->hora_final);
        $this->assertEquals($reserva->id, $horarioReserva->reserva_id);
    }


    #[Test]
    public function destroy_deletes_and_responds_with(): void
    {
        $horarioReserva = HorarioReserva::factory()->create();

        $response = $this->delete(route('horario-reserva.destroy', $horarioReserva));

        $response->assertNoContent();

        $this->assertModelMissing($horarioReserva);
    }
}
