<?php

namespace Tests\Feature;

use App\Models\Categoria;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Spatie\Permission\Models\Permission;
use Tests\TestCase;

class CategoriaControllerTest extends TestCase
{
    use RefreshDatabase;

    protected $user;

    protected function setUp(): void
    {
        parent::setUp();

        $permisos = [
            'ver-categoria',
            'crear-categoria',
            'editar-categoria',
            'eliminar-categoria'
        ];

        foreach ($permisos as $permiso) {
            Permission::firstOrCreate(['name' => $permiso]);
        }

        $this->user = User::factory()->create();
        $this->user->givePermissionTo($permisos);
        $this->actingAs($this->user);
    }

    public function test_list_all_categories(): void
    {
        Categoria::factory()
            ->count(5)
            ->create();

        $response = $this->get(route('categorias.index'));
        $this->assertDatabaseCount('categorias', 5);
        $response->assertStatus(200);
    }


    public function test_show_the_create_view(): void
    {
        $response = $this->get(route('categorias.create'));
        $response->assertStatus(200);
        $response->assertViewIs('categoria.create');
    }

    public function test_store_categoria_successfully(): void
    {
        $data = [
            'nombre' => 'Categoría Ejemplo',
            'descripcion' => 'Esta es una descripción de ejemplo.',
        ];

        $response = $this->post(route('categorias.store'), $data);

        $this->assertDatabaseHas('caracteristicas', [
            'nombre' => 'Categoría Ejemplo',
            'descripcion' => 'Esta es una descripción de ejemplo.',
        ]);

        $response->assertRedirect(route('categorias.index'))
            ->assertSessionHas('success', 'Categoría registrada');
    }

    public function test_show_the_edit_view(): void
    {
        $categoria = Categoria::factory()->create();

        $response = $this->get(route('categorias.edit', $categoria));

        $response->assertStatus(200);
        $response->assertViewIs('categoria.edit');

        $response->assertViewHas('categoria', $categoria);
    }

    public function test_update_category_successfully(): void
    {
        $categoria = Categoria::factory()->create();

        $data = [
            'nombre' => 'Nuevo Nombre',
            'descripcion' => 'Nueva Descripción',
        ];

        $response = $this->patch(route('categorias.update', $categoria), $data);

        $response->assertRedirect(route('categorias.index'))
            ->assertSessionHas('success', 'Categoría editada');

        $this->assertDatabaseHas('caracteristicas', [
            'nombre' => 'Nuevo Nombre',
            'descripcion' => 'Nueva Descripción',
        ]);
    }

    public function test_toogle_a_category_successfully(): void
    {
        $categoria = Categoria::factory()->create();

        //Comprobación de activo a inactivo
        $response = $this->delete(route('categorias.destroy', $categoria->id));
        $this->assertDatabaseHas('caracteristicas', [
            'id' => $categoria->caracteristica->id,
            'estado' => 0,
        ]);
        $response->assertRedirect(route('categorias.index'));
        $response->assertSessionHas('success', 'Categoría eliminada');

        //Comprobación de inactivo a activo
        $response = $this->delete(route('categorias.destroy', $categoria->id));
        $this->assertDatabaseHas('caracteristicas', [
            'id' => $categoria->caracteristica->id,
            'estado' => 1,
        ]);
        $response->assertRedirect(route('categorias.index'));
        $response->assertSessionHas('success', 'Categoría restaurada');
    }
}
