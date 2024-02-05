<?php

namespace Tests\Feature\Http\Controllers\Api\v1;

use App\Models\HorarioInhabilitado;
use App\Models\Trabajador;
use Carbon\Carbon;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use JMac\Testing\Traits\AdditionalAssertions;
use PHPUnit\Framework\Attributes\Test;
use Tests\TestCase;

/**
 * @see \App\Http\Controllers\Api\v1\HorarioInhabilitadoController
 */
final class HorarioInhabilitadoControllerTest extends TestCase
{
    use AdditionalAssertions, RefreshDatabase, WithFaker;

    #[Test]
    public function index_behaves_as_expected(): void
    {
        $horarioInhabilitados = HorarioInhabilitado::factory()->count(3)->create();

        $response = $this->get(route('horario-inhabilitado.index'));

        $response->assertOk();
        $response->assertJsonStructure([]);
    }


    #[Test]
    public function store_uses_form_request_validation(): void
    {
        $this->assertActionUsesFormRequest(
            \App\Http\Controllers\Api\v1\HorarioInhabilitadoController::class,
            'store',
            \App\Http\Requests\Api\v1\HorarioInhabilitadoStoreRequest::class
        );
    }

    #[Test]
    public function store_saves(): void
    {
        $fecha = $this->faker->date();
        $trabajador = Trabajador::factory()->create();

        $response = $this->post(route('horario-inhabilitado.store'), [
            'fecha' => $fecha,
            'trabajador_id' => $trabajador->id,
        ]);

        $horarioInhabilitados = HorarioInhabilitado::query()
            ->where('fecha', $fecha)
            ->where('trabajador_id', $trabajador->id)
            ->get();
        $this->assertCount(1, $horarioInhabilitados);
        $horarioInhabilitado = $horarioInhabilitados->first();

        $response->assertCreated();
        $response->assertJsonStructure([]);
    }


    #[Test]
    public function show_behaves_as_expected(): void
    {
        $horarioInhabilitado = HorarioInhabilitado::factory()->create();

        $response = $this->get(route('horario-inhabilitado.show', $horarioInhabilitado));

        $response->assertOk();
        $response->assertJsonStructure([]);
    }


    #[Test]
    public function update_uses_form_request_validation(): void
    {
        $this->assertActionUsesFormRequest(
            \App\Http\Controllers\Api\v1\HorarioInhabilitadoController::class,
            'update',
            \App\Http\Requests\Api\v1\HorarioInhabilitadoUpdateRequest::class
        );
    }

    #[Test]
    public function update_behaves_as_expected(): void
    {
        $horarioInhabilitado = HorarioInhabilitado::factory()->create();
        $fecha = $this->faker->date();
        $trabajador = Trabajador::factory()->create();

        $response = $this->put(route('horario-inhabilitado.update', $horarioInhabilitado), [
            'fecha' => $fecha,
            'trabajador_id' => $trabajador->id,
        ]);

        $horarioInhabilitado->refresh();

        $response->assertOk();
        $response->assertJsonStructure([]);

        $this->assertEquals(Carbon::parse($fecha), $horarioInhabilitado->fecha);
        $this->assertEquals($trabajador->id, $horarioInhabilitado->trabajador_id);
    }


    #[Test]
    public function destroy_deletes_and_responds_with(): void
    {
        $horarioInhabilitado = HorarioInhabilitado::factory()->create();

        $response = $this->delete(route('horario-inhabilitado.destroy', $horarioInhabilitado));

        $response->assertNoContent();

        $this->assertModelMissing($horarioInhabilitado);
    }
}
