<?php

namespace Tests\Feature\Http\Controllers\Api\v1;

use App\Models\Publicacion;
use App\Models\Trabajador;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use JMac\Testing\Traits\AdditionalAssertions;
use PHPUnit\Framework\Attributes\Test;
use Tests\TestCase;

/**
 * @see \App\Http\Controllers\Api\v1\PublicacionController
 */
final class PublicacionControllerTest extends TestCase
{
    use AdditionalAssertions, RefreshDatabase, WithFaker;

    #[Test]
    public function index_behaves_as_expected(): void
    {
        $publicacions = Publicacion::factory()->count(3)->create();

        $response = $this->get(route('publicacion.index'));

        $response->assertOk();
        $response->assertJsonStructure([]);
    }


    #[Test]
    public function store_uses_form_request_validation(): void
    {
        $this->assertActionUsesFormRequest(
            \App\Http\Controllers\Api\v1\PublicacionController::class,
            'store',
            \App\Http\Requests\Api\v1\PublicacionStoreRequest::class
        );
    }

    #[Test]
    public function store_saves(): void
    {
        $url = $this->faker->url();
        $trabajador = Trabajador::factory()->create();

        $response = $this->post(route('publicacion.store'), [
            'url' => $url,
            'trabajador_id' => $trabajador->id,
        ]);

        $publicacions = Publicacion::query()
            ->where('url', $url)
            ->where('trabajador_id', $trabajador->id)
            ->get();
        $this->assertCount(1, $publicacions);
        $publicacion = $publicacions->first();

        $response->assertCreated();
        $response->assertJsonStructure([]);
    }


    #[Test]
    public function show_behaves_as_expected(): void
    {
        $publicacion = Publicacion::factory()->create();

        $response = $this->get(route('publicacion.show', $publicacion));

        $response->assertOk();
        $response->assertJsonStructure([]);
    }


    #[Test]
    public function update_uses_form_request_validation(): void
    {
        $this->assertActionUsesFormRequest(
            \App\Http\Controllers\Api\v1\PublicacionController::class,
            'update',
            \App\Http\Requests\Api\v1\PublicacionUpdateRequest::class
        );
    }

    #[Test]
    public function update_behaves_as_expected(): void
    {
        $publicacion = Publicacion::factory()->create();
        $url = $this->faker->url();
        $trabajador = Trabajador::factory()->create();

        $response = $this->put(route('publicacion.update', $publicacion), [
            'url' => $url,
            'trabajador_id' => $trabajador->id,
        ]);

        $publicacion->refresh();

        $response->assertOk();
        $response->assertJsonStructure([]);

        $this->assertEquals($url, $publicacion->url);
        $this->assertEquals($trabajador->id, $publicacion->trabajador_id);
    }


    #[Test]
    public function destroy_deletes_and_responds_with(): void
    {
        $publicacion = Publicacion::factory()->create();

        $response = $this->delete(route('publicacion.destroy', $publicacion));

        $response->assertNoContent();

        $this->assertModelMissing($publicacion);
    }
}
