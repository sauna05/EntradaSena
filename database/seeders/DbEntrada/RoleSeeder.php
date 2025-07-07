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

        // Crear roles de gestion de asistencia y programacion
        $role1 = Role::create(['name' => 'Administrador_asistencia']);
        $role10 = Role::create(['name' => 'Administrador_programacion']);

        $role2 = Role::create(['name' => 'Admin-Entrada']);
        // $role3 = Role::create(['name' => 'Acceso-Entrada']);
        $role4 = Role::create(['name' => 'Apoyo-Coordinacion-Juicios-Evaluativos']);
        $role5 = Role::create(['name' => 'Admin-Programacion']);
        $role6 = Role::create(['name' => 'Sofia-Programacion']);
        $role7 = Role::create(['name' => 'Seguimiento-Programacion']);
        $role8 = Role::create(['name' => 'Inspector-Programacion']);
        $role9 = Role::create(['name' => 'Aprendiz']);
        // $role10 = Role::create(['name' => 'Instructor']);

        // Permisos del módulo de la entrada
        // Permission::create(['name' => 'entrance.create'])->syncRoles([$role3]);
        // Permission::create(['name' => 'entrance.store'])->syncRoles([$role3]);

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


        //---------------------- Permisos del módulo de Programación -------------------------------

        //esto es para la vista de programas
        Permission::create(['name' => 'programming.admin'])->syncRoles([$role10, $role5]);

         //agregar permiso de agregar programa con roles de 2 usuarios
        Permission::create(['name' => 'programing.programan_store_add'])->assignRole($role10, $role2);

        //permiso del modulo de programacion de fichas
        Permission::create(['name' => 'programmig.programming_cohort_index'])->syncRoles([$role10, $role5]);
        Permission::create(['name' => 'programmig.programming_cohort_Register'])->syncRoles([$role10, $role5]);
        // Permiso para entrada de los aprendices
        Permission::create(['name' => 'apprentice.show'])->assignRole($role9);

        //permisos para la vista y de reprogramacion
        Permission::create(['name' => 'programmig.programming_update_index'])->syncRoles([$role10, $role5]);
        Permission::create(['name' => 'programmig.programming_update_store'])->syncRoles([$role10, $role5]);






        Permission::create(['name' => 'programing.add_apprentices_cohorts'])->assignRole($role10, $role2);
        Permission::create(['name' => 'programing.add_apprentices_store'])->assignRole($role10, $role2);
        //permiso para ver aprendices en su ficha y programa correspondiente
        Permission::create(['name' => 'programing.apprentices_list'])->assignRole($role10, $role2);
        Permission::create(['name' => 'programing.apprentices_cohorts_list'])->assignRole($role10, $role2);


        //permiso para gestionar competencias

        Permission::create(['name' => 'programing.competencies_index'])->assignRole($role10, $role2);

        Permission::create(['name' => 'programing.competencies_store'])->assignRole($role10, $role2);

        //permisos para agregar competencias a un programa

         Permission::create(['name' => 'programing.competencies_programming_index'])->assignRole($role10, $role2);

        Permission::create(['name' => 'programing.competencies_programming_store'])->assignRole($role10, $role2);

        //permiso para ver las competencias con sus respectivos programas
        Permission::create(['name' => 'programing.competencies_programan_index'])->assignRole($role10, $role2);


        //permiso para lagestion instrcutor en el apartado de programacion instrcutor

        Permission::create(['name' => 'programing.instructor_programan_index'])->assignRole($role10, $role2);

        //permiso para permitir ver la vista de programacion de instrcutor
        Permission::create(['name' => 'programing.register_programming_instructor_index'])->assignRole($role10, $role2);

        //permiso para registrar programacion de instructor
        Permission::create(['name' => 'programing.register_programming_instructor_store'])->assignRole($role10, $role2);

        //permiso para actualizar programacion a ok despues que se registre en sofia plus
        // 1 prmero permiso para la vista de actualizar programacion
        Permission::create(['name' => 'programing.programming_update_index'])->assignRole($role10, $role2);
        //2 permiso para actulizar la programacion a estado ok
        Permission::create(['name' => 'programing.programming_update'])->assignRole($role10, $role2);

        //permiso para el listado de programaciones y sus estados
        Permission::create(['name' => 'programing.programming_index_states'])->assignRole($role10, $role2);

        //permiso para la vista de asignar competencia al perfil de instructores
        Permission::create(['name' => 'programing.instructors_competences_profile'])->assignRole($role10, $role2);

        //permiso para el registro de competencia en los perfiles de instructores
        Permission::create(['name' => 'programing.instructors_competencies_profile_store'])->assignRole($role10, $role2);

        //permisos de la gestion de ambientes
        //permiso para la visualizacion de ambientes
        Permission::create(['name' => 'programing.classrooms_programming_classrooms_index'])->assignRole($role10, $role2);

        Permission::create(['name' => 'programmig.programming_update_store_programing'])->assignRole($role10, $role2);
        //permiso para el agregado de ambientes

        Permission::create(['name' => 'programing.classrooms_programming_classrooms_store'])->assignRole($role10, $role2);

        //agregar permisos Para gestion de formulario
        Permission::create(['name' => 'programing.unrecorded_days_index'])->assignRole($role10, $role2);
        Permission::create(['name' => 'programing.unrecorded_days_store'])->assignRole($role10, $role2);

        //Permiso para registro de ambientes
        Permission::create(['name' => 'programing.classroom_store'])->assignRole($role10, $role2);
        //permiso para eliminar dia calendario
        Permission::create(['name' => 'programing.unrecorded_days_delete'])->assignRole($role10, $role2);

        //permiso para eliminar ambiene
        Permission::create(['name' => 'programing.ambiente_delete'])->assignRole($role10, $role2);
        Permission::create(['name' => 'programing.ambiente_update'])->assignRole($role10, $role2);
    }
}
