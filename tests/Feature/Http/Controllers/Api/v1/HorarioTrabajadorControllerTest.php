<?php

namespace Tests\Feature\Http\Controllers\Api\v1;

use App\Models\HorarioTrabajador;
use App\Models\Trabajador;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use JMac\Testing\Traits\AdditionalAssertions;
use PHPUnit\Framework\Attributes\Test;
use Tests\TestCase;

/**
 * @see \App\Http\Controllers\Api\v1\HorarioTrabajadorController
 */
final class HorarioTrabajadorControllerTest extends TestCase
{
    use AdditionalAssertions, RefreshDatabase, WithFaker;

    #[Test]
    public function index_behaves_as_expected(): void
    {
        $horarioTrabajadors = HorarioTrabajador::factory()->count(3)->create();

        $response = $this->get(route('horario-trabajador.index'));

        $response->assertOk();
        $response->assertJsonStructure([]);
    }


    #[Test]
    public function store_uses_form_request_validation(): void
    {
        $this->assertActionUsesFormRequest(
            \App\Http\Controllers\Api\v1\HorarioTrabajadorController::class,
            'store',
            \App\Http\Requests\Api\v1\HorarioTrabajadorStoreRequest::class
        );
    }

    #[Test]
    public function store_saves(): void
    {
        $rango = $this->faker->randomElement(/** enum_attributes **/);
        $hora_comienzo = $this->faker->dateTime();
        $hora_final = $this->faker->dateTime();
        $trabajador = Trabajador::factory()->create();

        $response = $this->post(route('horario-trabajador.store'), [
            'rango' => $rango,
            'hora_comienzo' => $hora_comienzo,
            'hora_final' => $hora_final,
            'trabajador_id' => $trabajador->id,
        ]);

        $horarioTrabajadors = HorarioTrabajador::query()
            ->where('rango', $rango)
            ->where('hora_comienzo', $hora_comienzo)
            ->where('hora_final', $hora_final)
            ->where('trabajador_id', $trabajador->id)
            ->get();
        $this->assertCount(1, $horarioTrabajadors);
        $horarioTrabajador = $horarioTrabajadors->first();

        $response->assertCreated();
        $response->assertJsonStructure([]);
    }


    #[Test]
    public function show_behaves_as_expected(): void
    {
        $horarioTrabajador = HorarioTrabajador::factory()->create();

        $response = $this->get(route('horario-trabajador.show', $horarioTrabajador));

        $response->assertOk();
        $response->assertJsonStructure([]);
    }


    #[Test]
    public function update_uses_form_request_validation(): void
    {
        $this->assertActionUsesFormRequest(
            \App\Http\Controllers\Api\v1\HorarioTrabajadorController::class,
            'update',
            \App\Http\Requests\Api\v1\HorarioTrabajadorUpdateRequest::class
        );
    }

    #[Test]
    public function update_behaves_as_expected(): void
    {
        $horarioTrabajador = HorarioTrabajador::factory()->create();
        $rango = $this->faker->randomElement(/** enum_attributes **/);
        $hora_comienzo = $this->faker->dateTime();
        $hora_final = $this->faker->dateTime();
        $trabajador = Trabajador::factory()->create();

        $response = $this->put(route('horario-trabajador.update', $horarioTrabajador), [
            'rango' => $rango,
            'hora_comienzo' => $hora_comienzo,
            'hora_final' => $hora_final,
            'trabajador_id' => $trabajador->id,
        ]);

        $horarioTrabajador->refresh();

        $response->assertOk();
        $response->assertJsonStructure([]);

        $this->assertEquals($rango, $horarioTrabajador->rango);
        $this->assertEquals($hora_comienzo, $horarioTrabajador->hora_comienzo);
        $this->assertEquals($hora_final, $horarioTrabajador->hora_final);
        $this->assertEquals($trabajador->id, $horarioTrabajador->trabajador_id);
    }


    #[Test]
    public function destroy_deletes_and_responds_with(): void
    {
        $horarioTrabajador = HorarioTrabajador::factory()->create();

        $response = $this->delete(route('horario-trabajador.destroy', $horarioTrabajador));

        $response->assertNoContent();

        $this->assertModelMissing($horarioTrabajador);
    }
}
