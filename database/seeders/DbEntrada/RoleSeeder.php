<?php

namespace Database\Seeders\DbEntrada;

    use Illuminate\Database\Seeder;
    use Illuminate\Support\Facades\DB;
use Spatie\Permission\Models\Permission;
//Modelos de Spatie-Permissions
    use Spatie\Permission\Models\Role;

    class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {

        //Para DB se importa illuminate support facades db

        // DB::connection('db_entrada')->table('roles')->insert([
        //     ['role' => 'Administrador', 'created_at' => now(), 'updated_at' => now()],
        //     ['role' => 'Entrada', 'created_at' => now(), 'updated_at' => now()],
        //     ['role' => 'Coordinador', 'created_at' => now(), 'updated_at' => now()],
        //     ['role' => 'Aprendiz', 'created_at' => now(), 'updated_at' => now()],
        //     ['role' => 'Instructor Contratista', 'created_at' => now(), 'updated_at' => now()],
        //     ['role' => 'Instructor De Planta', 'created_at' => now(), 'updated_at' => now()],
        //     ['role' => 'Administrativo', 'created_at' => now(), 'updated_at' => now()],
        // ]);
        

       $role1= Role::create(['name'=>'Administrador']);

        $role2 =Role::create(['name'=>'Admin-Entrada']);
        $role3= Role::create(['name' => 'Acceso-Entrada']);

        $role4 = Role::create(['name' => 'Admin-Programacion']);
        $role5 = Role::create(['name' => 'Sofia-Programacion']);
        $role6 = Role::create(['name' => 'Seguimiento-Programacion']);
        $role7 = Role::create(['name' => 'Inspector-Programacion']);

        $role8 = Role::create(['name' => 'Aprendiz']);
        $role9 = Role::create(['name' => 'Instructor']);


        //Permisos del modulo de la entrada
        Permission::create(['name' => 'entrance.create'])->syncRoles([$role3]);
        Permission::create(['name' => 'entrance.store'])->syncRoles([$role3]);

        //Permisos del modulo de administración de la entrada
        Permission::create(['name' => 'entrance.admin'])->syncRoles([$role1, $role2]);
        Permission::create(['name' => 'entrance.people.index'])->syncRoles([$role1, $role2]);
        Permission::create(['name' => 'entrance.people.create'])->syncRoles([$role1, $role2]);
        Permission::create(['name' => 'entrance.people.store'])->syncRoles([$role1, $role2]);
        Permission::create(['name' => 'entrance.people.update'])->syncRoles([$role1, $role2]);
        Permission::create(['name' => 'entrance.people.delete'])->syncRoles([$role1, $role2]);
        Permission::create(['name' => 'entrance.excel.upload'])->syncRoles([$role1, $role2]);


        //Permisos del modulo de Programación
        Permission::create(['name' => 'programming.admin'])->syncRoles([$role1, $role4]);


        //Permisos del modulo de entrada de los aprendices
        Permission::create(['name' => 'apprentice.show'])->assignRole($role8);




        

        





    }
}
