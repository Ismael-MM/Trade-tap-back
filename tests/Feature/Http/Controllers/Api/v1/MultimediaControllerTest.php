<?php

namespace Tests\Feature\Http\Controllers\Api\v1;

use App\Models\Multimedia;
use App\Models\Valoracion;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use JMac\Testing\Traits\AdditionalAssertions;
use PHPUnit\Framework\Attributes\Test;
use Tests\TestCase;

/**
 * @see \App\Http\Controllers\Api\v1\MultimediaController
 */
final class MultimediaControllerTest extends TestCase
{
    use AdditionalAssertions, RefreshDatabase, WithFaker;

    #[Test]
    public function index_behaves_as_expected(): void
    {
        $multimedia = Multimedia::factory()->count(3)->create();

        $response = $this->get(route('multimedia.index'));

        $response->assertOk();
        $response->assertJsonStructure([]);
    }


    #[Test]
    public function store_uses_form_request_validation(): void
    {
        $this->assertActionUsesFormRequest(
            \App\Http\Controllers\Api\v1\MultimediaController::class,
            'store',
            \App\Http\Requests\Api\v1\MultimediaStoreRequest::class
        );
    }

    #[Test]
    public function store_saves(): void
    {
        $tipo = $this->faker->randomElement(/** enum_attributes **/);
        $url = $this->faker->url();
        $valoracion = Valoracion::factory()->create();

        $response = $this->post(route('multimedia.store'), [
            'tipo' => $tipo,
            'url' => $url,
            'valoracion_id' => $valoracion->id,
        ]);

        $multimedia = Multimedia::query()
            ->where('tipo', $tipo)
            ->where('url', $url)
            ->where('valoracion_id', $valoracion->id)
            ->get();
        $this->assertCount(1, $multimedia);
        $multimedia = $multimedia->first();

        $response->assertCreated();
        $response->assertJsonStructure([]);
    }


    #[Test]
    public function show_behaves_as_expected(): void
    {
        $multimedia = Multimedia::factory()->create();

        $response = $this->get(route('multimedia.show', $multimedia));

        $response->assertOk();
        $response->assertJsonStructure([]);
    }


    #[Test]
    public function update_uses_form_request_validation(): void
    {
        $this->assertActionUsesFormRequest(
            \App\Http\Controllers\Api\v1\MultimediaController::class,
            'update',
            \App\Http\Requests\Api\v1\MultimediaUpdateRequest::class
        );
    }

    #[Test]
    public function update_behaves_as_expected(): void
    {
        $multimedia = Multimedia::factory()->create();
        $tipo = $this->faker->randomElement(/** enum_attributes **/);
        $url = $this->faker->url();
        $valoracion = Valoracion::factory()->create();

        $response = $this->put(route('multimedia.update', $multimedia), [
            'tipo' => $tipo,
            'url' => $url,
            'valoracion_id' => $valoracion->id,
        ]);

        $multimedia->refresh();

        $response->assertOk();
        $response->assertJsonStructure([]);

        $this->assertEquals($tipo, $multimedia->tipo);
        $this->assertEquals($url, $multimedia->url);
        $this->assertEquals($valoracion->id, $multimedia->valoracion_id);
    }


    #[Test]
    public function destroy_deletes_and_responds_with(): void
    {
        $multimedia = Multimedia::factory()->create();

        $response = $this->delete(route('multimedia.destroy', $multimedia));

        $response->assertNoContent();

        $this->assertModelMissing($multimedia);
    }
}
