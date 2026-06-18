<?php

namespace Database\Seeders;

use BezhanSalleh\FilamentShield\Support\Utils;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;
use Spatie\Permission\PermissionRegistrar;

class ShieldSeeder extends Seeder
{
    /**
     * Admin ve editor rollerini tanımlar.
     *
     * Admin: Tüm resource'lara tam erişim
     * Editor: Post, Category, Tag, FAQ, Testimonial resource'larına erişim
     *         Settings, Appointment status değişikliği ve user management kısıtlı
     */
    public function run(): void
    {
        // Reset cached roles and permissions
        app()[PermissionRegistrar::class]->forgetCachedPermissions();

        // Admin rolü - super_admin olarak tanımlanır, tüm erişime sahiptir
        $superAdminRole = Role::firstOrCreate(
            ['name' => 'super_admin', 'guard_name' => 'web']
        );

        // Admin rolü (normal admin)
        $adminRole = Role::firstOrCreate(
            ['name' => 'admin', 'guard_name' => 'web']
        );

        // Editor rolü
        $editorRole = Role::firstOrCreate(
            ['name' => 'editor', 'guard_name' => 'web']
        );

        // Panel User rolü
        Role::firstOrCreate(
            ['name' => 'panel_user', 'guard_name' => 'web']
        );

        // Editor rolü için izinleri tanımla
        // Editor yalnızca Post, Category, Tag, FAQ, Testimonial kaynaklarına erişebilir
        $editorPermissions = [
            // Post permissions
            'view_any_post',
            'view_post',
            'create_post',
            'update_post',
            'delete_post',

            // Category permissions
            'view_any_category',
            'view_category',
            'create_category',
            'update_category',
            'delete_category',

            // Tag permissions
            'view_any_tag',
            'view_tag',
            'create_tag',
            'update_tag',
            'delete_tag',

            // FAQ permissions
            'view_any_faq',
            'view_faq',
            'create_faq',
            'update_faq',
            'delete_faq',
            'reorder_faq',

            // Testimonial permissions
            'view_any_testimonial',
            'view_testimonial',
            'create_testimonial',
            'update_testimonial',
            'delete_testimonial',
            'reorder_testimonial',
        ];

        // Create editor permissions
        foreach ($editorPermissions as $permission) {
            Permission::firstOrCreate(
                ['name' => $permission, 'guard_name' => 'web']
            );
        }

        // Admin rolü için tüm izinleri tanımla (kaynak bazlı)
        $adminPermissions = array_merge($editorPermissions, [
            // Service permissions
            'view_any_service',
            'view_service',
            'create_service',
            'update_service',
            'delete_service',
            'reorder_service',

            // Appointment permissions
            'view_any_appointment',
            'view_appointment',
            'create_appointment',
            'update_appointment',
            'delete_appointment',

            // Contact Message permissions
            'view_any_contact::message',
            'view_contact::message',
            'update_contact::message',

            // Page permissions
            'view_any_page',
            'view_page',
            'create_page',
            'update_page',
            'delete_page',

            // Team Member permissions
            'view_any_team::member',
            'view_team::member',
            'create_team::member',
            'update_team::member',
            'delete_team::member',
            'reorder_team::member',

            // Shield Role permissions
            'view_any_role',
            'view_role',
            'create_role',
            'update_role',
            'delete_role',

            // Site Settings page permission
            'view_manage::site::settings',
        ]);

        // Create admin permissions
        foreach ($adminPermissions as $permission) {
            Permission::firstOrCreate(
                ['name' => $permission, 'guard_name' => 'web']
            );
        }

        // Assign all permissions to admin role
        $adminRole->syncPermissions(
            Permission::where('guard_name', 'web')->get()
        );

        // Assign editor permissions to editor role
        $editorRole->syncPermissions(
            Permission::whereIn('name', $editorPermissions)
                ->where('guard_name', 'web')
                ->get()
        );
    }
}
