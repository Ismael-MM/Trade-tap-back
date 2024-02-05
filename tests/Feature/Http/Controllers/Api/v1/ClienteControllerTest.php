<?php

namespace Tests\Feature\Http\Controllers\Api\v1;

use App\Models\Cliente;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use JMac\Testing\Traits\AdditionalAssertions;
use PHPUnit\Framework\Attributes\Test;
use Tests\TestCase;

/**
 * @see \App\Http\Controllers\Api\v1\ClienteController
 */
final class ClienteControllerTest extends TestCase
{
    use AdditionalAssertions, RefreshDatabase, WithFaker;

    #[Test]
    public function index_behaves_as_expected(): void
    {
        $clientes = Cliente::factory()->count(3)->create();

        $response = $this->get(route('cliente.index'));

        $response->assertOk();
        $response->assertJsonStructure([]);
    }


    #[Test]
    public function store_uses_form_request_validation(): void
    {
        $this->assertActionUsesFormRequest(
            \App\Http\Controllers\Api\v1\ClienteController::class,
            'store',
            \App\Http\Requests\Api\v1\ClienteStoreRequest::class
        );
    }

    #[Test]
    public function store_saves(): void
    {
        $response = $this->post(route('cliente.store'));

        $response->assertCreated();
        $response->assertJsonStructure([]);

        $this->assertDatabaseHas(clientes, [ /* ... */ ]);
    }


    #[Test]
    public function show_behaves_as_expected(): void
    {
        $cliente = Cliente::factory()->create();

        $response = $this->get(route('cliente.show', $cliente));

        $response->assertOk();
        $response->assertJsonStructure([]);
    }


    #[Test]
    public function update_uses_form_request_validation(): void
    {
        $this->assertActionUsesFormRequest(
            \App\Http\Controllers\Api\v1\ClienteController::class,
            'update',
            \App\Http\Requests\Api\v1\ClienteUpdateRequest::class
        );
    }

    #[Test]
    public function update_behaves_as_expected(): void
    {
        $cliente = Cliente::factory()->create();

        $response = $this->put(route('cliente.update', $cliente));

        $cliente->refresh();

        $response->assertOk();
        $response->assertJsonStructure([]);
    }


    #[Test]
    public function destroy_deletes_and_responds_with(): void
    {
        $cliente = Cliente::factory()->create();

        $response = $this->delete(route('cliente.destroy', $cliente));

        $response->assertNoContent();

        $this->assertModelMissing($cliente);
    }
}
