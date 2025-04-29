<?php

namespace Database\Seeders\DbEntrada;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // 🔁 Forzar conexión al modelo en tiempo de ejecución
        app(Role::class)->setConnection('db_entrada');
        app(Permission::class)->setConnection('db_entrada');

        // Crear roles
        $role1 = Role::create(['name' => 'Administrador']);
        $role2 = Role::create(['name' => 'Admin-Entrada']);
        $role3 = Role::create(['name' => 'Acceso-Entrada']);
        $role4 = Role::create(['name' => 'Apoyo-Coordinacion-Juicios-Evaluativos']);
        $role5 = Role::create(['name' => 'Admin-Programacion']);
        $role6 = Role::create(['name' => 'Sofia-Programacion']);
        $role7 = Role::create(['name' => 'Seguimiento-Programacion']);
        $role8 = Role::create(['name' => 'Inspector-Programacion']);
        $role9 = Role::create(['name' => 'Aprendiz']);
        $role10 = Role::create(['name' => 'Instructor']);

        // Permisos del módulo de la entrada
        Permission::create(['name' => 'entrance.create'])->syncRoles([$role3]);
        Permission::create(['name' => 'entrance.store'])->syncRoles([$role3]);

        // Permisos del módulo de administración de la entrada
        Permission::create(['name' => 'entrance.admin'])->syncRoles([$role1, $role2]);
        Permission::create(['name' => 'entrance.people.index'])->syncRoles([$role1, $role2]);
        Permission::create(['name' => 'entrance.people.create'])->syncRoles([$role1, $role2]);
        Permission::create(['name' => 'entrance.people.store'])->syncRoles([$role1, $role2]);
        Permission::create(['name' => 'entrance.people.update'])->syncRoles([$role1, $role2]);
        Permission::create(['name' => 'entrance.people.delete'])->syncRoles([$role1, $role2]);
        Permission::create(['name' => 'entrance.people.show'])->syncRoles([$role1, $role2]);
        Permission::create(['name' => 'entrance.excel.upload'])->syncRoles([$role1, $role2]);
        Permission::create(['name' => 'entrance.people.edit'])->syncRoles([$role1, $role2]);

        // Permisos para inasistencias
        Permission::create(['name' => 'entrance.absence.index'])->syncRoles([$role1, $role2]);
        Permission::create(['name' => 'entrance.absence.show'])->syncRoles([$role1, $role2]);

        // Permisos para asistencia
        Permission::create(['name' => 'entrance.assistance.index'])->syncRoles([$role1, $role2]);
        Permission::create(['name' => 'entrance.assistance.show'])->syncRoles([$role1, $role2]);
        Permission::create(['name' => 'entrance.assistance.show_history'])->syncRoles([$role1, $role2]);
        Permission::create(['name' => 'entrance.assistance.all'])->syncRoles([$role1, $role2]);

        // Permiso para exportar en Excel
        Permission::create(['name' => 'entrance.assistance.export'])->syncRoles([$role1, $role2]);

        // Permisos del módulo de Programación
        Permission::create(['name' => 'programming.admin'])->syncRoles([$role1, $role5]);

        // Permiso para entrada de los aprendices
        Permission::create(['name' => 'apprentice.show'])->assignRole($role9);
    }
}
