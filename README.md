# Userstamps

Userstamps es un paquete de Laravel diseñado para facilitar la gestión automática de las columnas `created_by` y `updated_by` en tus modelos Eloquent. Esto es útil cuando quieres mantener un registro de quién creó o actualizó un registro en tu base de datos.

## Instalación

Puedes instalar el paquete a través de Composer utilizando el siguiente comando:

```bash
composer require everth/userstamps dev-main
```
Para activar el proveedor de servicios hay que añadir la siguiente linea en config/app.php en el array providers:
```php
Everth\UserStamps\Providers\UserStampsProvider::class
```
Esto nos proporcionará dos nuevos metodos para las migraciones, `nullableUserStamps` y `userStamps`, ambos crearán dos campos en la tabla, `created_by` y `updated_by` que se relacionarán con la tabla `users`, en el caso de `nullableUserStamps` ambos campos serán nulables, mientras que en `userStamps` solamente será nulable el campo `updated_by`.
```php
Schema::create('test', function (Blueprint $table) {
    $table->id();

    $table->string('name');

    $table->nullableUserStamps();
    $table->timestamps();
});
```

Para que estos campos se actualizen automaticamente tenemos que crearle un modelo e importar la clase `UserStampsTrait`.
```php
use Everth\UserStamps\UserStampsTrait;

class Test extends Model
{
    use HasFactory;
    use UserStampsTrait;

    protected $table = 'test';

    protected $fillable = [
        'name',
    ];
}
```
