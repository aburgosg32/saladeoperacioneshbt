<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\PermissionRegistrar;

class RolesYPermisosSeeder extends Seeder
{
    public function run(): void
    {
        app()[PermissionRegistrar::class]->forgetCachedPermissions();

        $permisos = [
            'solicitudes.ver',
            'solicitudes.crear',
            'solicitudes.editar',
            'solicitudes.programar',
            'solicitudes.eliminar',

            'panel.ver',
            'paneltv.ver',

            'ejecucion.ver',
            'ejecucion.iniciar',
            'ejecucion.culminar',

            'reportes.ver',
            'reportes.exportar',
        ];

        foreach ($permisos as $permiso) {
            Permission::firstOrCreate(['name' => $permiso]);
        }

        $rolMedico = Role::firstOrCreate(['name' => 'medico']);
        $rolJefe = Role::firstOrCreate(['name' => 'jefe_sala']);

        $rolMedico->syncPermissions([
            'solicitudes.ver',
            'solicitudes.crear',
            'paneltv.ver',
            'ejecucion.ver',
        ]);

        $rolJefe->syncPermissions([
            'solicitudes.ver',
            'solicitudes.crear',
            'solicitudes.editar',
            'solicitudes.programar',
            'solicitudes.eliminar',

            'panel.ver',
            'paneltv.ver',

            'ejecucion.ver',
            'ejecucion.iniciar',
            'ejecucion.culminar',

            'reportes.ver',
            'reportes.exportar',
        ]);
    }
}
