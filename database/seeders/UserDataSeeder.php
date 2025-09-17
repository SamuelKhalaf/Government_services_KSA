<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UserDataSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $this->command->info('Seeding Users, Roles, and Permissions...');

        // Seed roles
        $this->seedRoles();
        
        // Seed permissions
        $this->seedPermissions();
        
        // Seed role permissions
        $this->seedRolePermissions();
        
        // Seed users
        $this->seedUsers();
        
        // Seed user roles
        $this->seedUserRoles();
        
        // Seed user permissions
        $this->seedUserPermissions();

        $this->command->info('Users, Roles, and Permissions seeded successfully!');
    }

    private function seedRoles()
    {
        $roles = [
            ['id' => 1, 'name' => 'admin', 'guard_name' => 'web', 'created_at' => now(), 'updated_at' => now()],
            ['id' => 2, 'name' => 'employee', 'guard_name' => 'web', 'created_at' => now(), 'updated_at' => now()],
        ];

        foreach ($roles as $role) {
            DB::table('roles')->updateOrInsert(
                ['id' => $role['id']],
                $role
            );
        }
    }

    private function seedPermissions()
    {
        $permissions = [
            ['id' => 1, 'name' => 'view_dashboard', 'guard_name' => 'web', 'created_at' => now(), 'updated_at' => now()],
            ['id' => 4, 'name' => 'view_users', 'guard_name' => 'web', 'created_at' => now(), 'updated_at' => now()],
            ['id' => 5, 'name' => 'create_users', 'guard_name' => 'web', 'created_at' => now(), 'updated_at' => now()],
            ['id' => 6, 'name' => 'update_users', 'guard_name' => 'web', 'created_at' => now(), 'updated_at' => now()],
            ['id' => 7, 'name' => 'delete_users', 'guard_name' => 'web', 'created_at' => now(), 'updated_at' => now()],
            ['id' => 9, 'name' => 'view_roles', 'guard_name' => 'web', 'created_at' => now(), 'updated_at' => now()],
            ['id' => 10, 'name' => 'create_roles', 'guard_name' => 'web', 'created_at' => now(), 'updated_at' => now()],
            ['id' => 11, 'name' => 'update_roles', 'guard_name' => 'web', 'created_at' => now(), 'updated_at' => now()],
            ['id' => 12, 'name' => 'delete_roles', 'guard_name' => 'web', 'created_at' => now(), 'updated_at' => now()],
            ['id' => 13, 'name' => 'view_permissions', 'guard_name' => 'web', 'created_at' => now(), 'updated_at' => now()],
            ['id' => 14, 'name' => 'assign_permissions', 'guard_name' => 'web', 'created_at' => now(), 'updated_at' => now()],
            ['id' => 15, 'name' => 'view_all_clients', 'guard_name' => 'web', 'created_at' => now(), 'updated_at' => now()],
            ['id' => 16, 'name' => 'view_assigned_clients', 'guard_name' => 'web', 'created_at' => now(), 'updated_at' => now()],
            ['id' => 17, 'name' => 'create_clients', 'guard_name' => 'web', 'created_at' => now(), 'updated_at' => now()],
            ['id' => 18, 'name' => 'update_clients', 'guard_name' => 'web', 'created_at' => now(), 'updated_at' => now()],
            ['id' => 19, 'name' => 'delete_clients', 'guard_name' => 'web', 'created_at' => now(), 'updated_at' => now()],
            ['id' => 21, 'name' => 'view_client_employees', 'guard_name' => 'web', 'created_at' => now(), 'updated_at' => now()],
            ['id' => 22, 'name' => 'create_client_employees', 'guard_name' => 'web', 'created_at' => now(), 'updated_at' => now()],
            ['id' => 23, 'name' => 'update_client_employees', 'guard_name' => 'web', 'created_at' => now(), 'updated_at' => now()],
            ['id' => 24, 'name' => 'delete_client_employees', 'guard_name' => 'web', 'created_at' => now(), 'updated_at' => now()],
            ['id' => 25, 'name' => 'view_all_documents', 'guard_name' => 'web', 'created_at' => now(), 'updated_at' => now()],
            ['id' => 26, 'name' => 'view_assigned_documents', 'guard_name' => 'web', 'created_at' => now(), 'updated_at' => now()],
            ['id' => 27, 'name' => 'upload_documents', 'guard_name' => 'web', 'created_at' => now(), 'updated_at' => now()],
            ['id' => 28, 'name' => 'update_documents', 'guard_name' => 'web', 'created_at' => now(), 'updated_at' => now()],
            ['id' => 29, 'name' => 'delete_documents', 'guard_name' => 'web', 'created_at' => now(), 'updated_at' => now()],
            ['id' => 30, 'name' => 'download_documents', 'guard_name' => 'web', 'created_at' => now(), 'updated_at' => now()],
            ['id' => 32, 'name' => 'view_all_tasks', 'guard_name' => 'web', 'created_at' => now(), 'updated_at' => now()],
            ['id' => 33, 'name' => 'view_assigned_tasks', 'guard_name' => 'web', 'created_at' => now(), 'updated_at' => now()],
            ['id' => 34, 'name' => 'create_tasks', 'guard_name' => 'web', 'created_at' => now(), 'updated_at' => now()],
            ['id' => 35, 'name' => 'update_tasks', 'guard_name' => 'web', 'created_at' => now(), 'updated_at' => now()],
            ['id' => 36, 'name' => 'delete_tasks', 'guard_name' => 'web', 'created_at' => now(), 'updated_at' => now()],
            ['id' => 38, 'name' => 'complete_tasks', 'guard_name' => 'web', 'created_at' => now(), 'updated_at' => now()],
            ['id' => 39, 'name' => 'view_all_notifications', 'guard_name' => 'web', 'created_at' => now(), 'updated_at' => now()],
            ['id' => 40, 'name' => 'view_own_notifications', 'guard_name' => 'web', 'created_at' => now(), 'updated_at' => now()],
            ['id' => 41, 'name' => 'create_notifications', 'guard_name' => 'web', 'created_at' => now(), 'updated_at' => now()],
            ['id' => 42, 'name' => 'mark_notifications_read', 'guard_name' => 'web', 'created_at' => now(), 'updated_at' => now()],
            ['id' => 43, 'name' => 'delete_notifications', 'guard_name' => 'web', 'created_at' => now(), 'updated_at' => now()],
            ['id' => 44, 'name' => 'view_financial_packages', 'guard_name' => 'web', 'created_at' => now(), 'updated_at' => now()],
            ['id' => 45, 'name' => 'create_financial_packages', 'guard_name' => 'web', 'created_at' => now(), 'updated_at' => now()],
            ['id' => 46, 'name' => 'update_financial_packages', 'guard_name' => 'web', 'created_at' => now(), 'updated_at' => now()],
            ['id' => 47, 'name' => 'delete_financial_packages', 'guard_name' => 'web', 'created_at' => now(), 'updated_at' => now()],
            ['id' => 48, 'name' => 'assign_packages_to_clients', 'guard_name' => 'web', 'created_at' => now(), 'updated_at' => now()],
            ['id' => 51, 'name' => 'view_client_reports', 'guard_name' => 'web', 'created_at' => now(), 'updated_at' => now()],
            ['id' => 53, 'name' => 'create_permissions', 'guard_name' => 'web', 'created_at' => now(), 'updated_at' => now()],
            ['id' => 54, 'name' => 'delete_permissions', 'guard_name' => 'web', 'created_at' => now(), 'updated_at' => now()],
            ['id' => 56, 'name' => 'view_company_documents', 'guard_name' => 'web', 'created_at' => now(), 'updated_at' => now()],
            ['id' => 57, 'name' => 'create_company_documents', 'guard_name' => 'web', 'created_at' => now(), 'updated_at' => now()],
            ['id' => 58, 'name' => 'update_company_documents', 'guard_name' => 'web', 'created_at' => now(), 'updated_at' => now()],
            ['id' => 59, 'name' => 'delete_company_documents', 'guard_name' => 'web', 'created_at' => now(), 'updated_at' => now()],
            ['id' => 60, 'name' => 'manage_civil_defense_licenses', 'guard_name' => 'web', 'created_at' => now(), 'updated_at' => now()],
            ['id' => 61, 'name' => 'manage_municipality_licenses', 'guard_name' => 'web', 'created_at' => now(), 'updated_at' => now()],
            ['id' => 62, 'name' => 'manage_branch_registrations', 'guard_name' => 'web', 'created_at' => now(), 'updated_at' => now()],
            ['id' => 63, 'name' => 'view_document_dashboard', 'guard_name' => 'web', 'created_at' => now(), 'updated_at' => now()],
            ['id' => 64, 'name' => 'view_document_types', 'guard_name' => 'web', 'created_at' => now(), 'updated_at' => now()],
            ['id' => 65, 'name' => 'create_document_types', 'guard_name' => 'web', 'created_at' => now(), 'updated_at' => now()],
            ['id' => 66, 'name' => 'update_document_types', 'guard_name' => 'web', 'created_at' => now(), 'updated_at' => now()],
            ['id' => 67, 'name' => 'delete_document_types', 'guard_name' => 'web', 'created_at' => now(), 'updated_at' => now()],
            ['id' => 69, 'name' => 'renew_client_packages', 'guard_name' => 'web', 'created_at' => now(), 'updated_at' => now()],
            ['id' => 70, 'name' => 'cancel_client_packages', 'guard_name' => 'web', 'created_at' => now(), 'updated_at' => now()],
            ['id' => 71, 'name' => 'manage_task_documents', 'guard_name' => 'web', 'created_at' => now(), 'updated_at' => now()],
            ['id' => 72, 'name' => 'view_employee_monitoring', 'guard_name' => 'web', 'created_at' => now(), 'updated_at' => now()],
            ['id' => 73, 'name' => 'view_employee_login_logs', 'guard_name' => 'web', 'created_at' => now(), 'updated_at' => now()],
            ['id' => 74, 'name' => 'view_employee_activity_logs', 'guard_name' => 'web', 'created_at' => now(), 'updated_at' => now()],
            ['id' => 75, 'name' => 'view_employee_click_tracking', 'guard_name' => 'web', 'created_at' => now(), 'updated_at' => now()],
            ['id' => 76, 'name' => 'view_employee_screen_time', 'guard_name' => 'web', 'created_at' => now(), 'updated_at' => now()],
            ['id' => 77, 'name' => 'view_employee_screenshots', 'guard_name' => 'web', 'created_at' => now(), 'updated_at' => now()],
            ['id' => 78, 'name' => 'manage_employee_monitoring', 'guard_name' => 'web', 'created_at' => now(), 'updated_at' => now()],
        ];

        foreach ($permissions as $permission) {
            DB::table('permissions')->updateOrInsert(
                ['id' => $permission['id']],
                $permission
            );
        }
    }

    private function seedRolePermissions()
    {
        $rolePermissions = [
            // Admin role permissions
            ['permission_id' => 1, 'role_id' => 1], ['permission_id' => 4, 'role_id' => 1], ['permission_id' => 5, 'role_id' => 1],
            ['permission_id' => 6, 'role_id' => 1], ['permission_id' => 7, 'role_id' => 1], ['permission_id' => 9, 'role_id' => 1],
            ['permission_id' => 10, 'role_id' => 1], ['permission_id' => 11, 'role_id' => 1], ['permission_id' => 12, 'role_id' => 1],
            ['permission_id' => 13, 'role_id' => 1], ['permission_id' => 14, 'role_id' => 1], ['permission_id' => 15, 'role_id' => 1],
            ['permission_id' => 16, 'role_id' => 1], ['permission_id' => 17, 'role_id' => 1], ['permission_id' => 18, 'role_id' => 1],
            ['permission_id' => 19, 'role_id' => 1], ['permission_id' => 21, 'role_id' => 1], ['permission_id' => 22, 'role_id' => 1],
            ['permission_id' => 23, 'role_id' => 1], ['permission_id' => 24, 'role_id' => 1], ['permission_id' => 25, 'role_id' => 1],
            ['permission_id' => 26, 'role_id' => 1], ['permission_id' => 27, 'role_id' => 1], ['permission_id' => 28, 'role_id' => 1],
            ['permission_id' => 29, 'role_id' => 1], ['permission_id' => 30, 'role_id' => 1], ['permission_id' => 32, 'role_id' => 1],
            ['permission_id' => 33, 'role_id' => 1], ['permission_id' => 34, 'role_id' => 1], ['permission_id' => 35, 'role_id' => 1],
            ['permission_id' => 36, 'role_id' => 1], ['permission_id' => 38, 'role_id' => 1], ['permission_id' => 40, 'role_id' => 1],
            ['permission_id' => 42, 'role_id' => 1], ['permission_id' => 43, 'role_id' => 1], ['permission_id' => 44, 'role_id' => 1],
            ['permission_id' => 45, 'role_id' => 1], ['permission_id' => 46, 'role_id' => 1], ['permission_id' => 47, 'role_id' => 1],
            ['permission_id' => 48, 'role_id' => 1], ['permission_id' => 51, 'role_id' => 1], ['permission_id' => 53, 'role_id' => 1],
            ['permission_id' => 54, 'role_id' => 1], ['permission_id' => 56, 'role_id' => 1], ['permission_id' => 57, 'role_id' => 1],
            ['permission_id' => 58, 'role_id' => 1], ['permission_id' => 59, 'role_id' => 1], ['permission_id' => 60, 'role_id' => 1],
            ['permission_id' => 61, 'role_id' => 1], ['permission_id' => 62, 'role_id' => 1], ['permission_id' => 63, 'role_id' => 1],
            ['permission_id' => 64, 'role_id' => 1], ['permission_id' => 65, 'role_id' => 1], ['permission_id' => 66, 'role_id' => 1],
            ['permission_id' => 67, 'role_id' => 1], ['permission_id' => 69, 'role_id' => 1], ['permission_id' => 70, 'role_id' => 1],
            ['permission_id' => 71, 'role_id' => 1], ['permission_id' => 72, 'role_id' => 1], ['permission_id' => 73, 'role_id' => 1],
            ['permission_id' => 74, 'role_id' => 1], ['permission_id' => 75, 'role_id' => 1], ['permission_id' => 76, 'role_id' => 1],
            ['permission_id' => 77, 'role_id' => 1], ['permission_id' => 78, 'role_id' => 1],
            // Employee role permissions
            ['permission_id' => 16, 'role_id' => 2], ['permission_id' => 21, 'role_id' => 2], ['permission_id' => 26, 'role_id' => 2],
            ['permission_id' => 28, 'role_id' => 2], ['permission_id' => 30, 'role_id' => 2], ['permission_id' => 33, 'role_id' => 2],
            ['permission_id' => 35, 'role_id' => 2], ['permission_id' => 38, 'role_id' => 2], ['permission_id' => 40, 'role_id' => 2],
            ['permission_id' => 58, 'role_id' => 2], ['permission_id' => 59, 'role_id' => 2], ['permission_id' => 60, 'role_id' => 2],
            ['permission_id' => 61, 'role_id' => 2], ['permission_id' => 62, 'role_id' => 2],
        ];

        foreach ($rolePermissions as $rolePermission) {
            DB::table('role_has_permissions')->updateOrInsert(
                ['permission_id' => $rolePermission['permission_id'], 'role_id' => $rolePermission['role_id']],
                $rolePermission
            );
        }
    }

    private function seedUsers()
    {
        $users = [
            [
                'id' => 13, 'name' => 'Angelica Gleason', 'email' => 'bednar.golden@example.net',
                'email_verified_at' => '2025-03-29 18:19:33', 'password' => '$2y$12$w/AEdANDBaZXPcza8QVlM.0NkPFKPNxSN0eiNhO4a9iQyrhd3fib6',
                'status' => 'active', 'last_login_at' => '2025-09-17 01:11:25', 'national_id' => null,
                'preferred_language' => 'ar', 'avatar' => null, 'address' => null, 'created_by' => null,
                'phone_number' => '+1.458.386.9122', 'remember_token' => 'zyIjEODGya',
                'created_at' => '2025-03-29 18:19:42', 'updated_at' => '2025-09-17 01:11:25'
            ],
            [
                'id' => 22, 'name' => 'Aubrey Brakus', 'email' => 'tryan@example.org',
                'email_verified_at' => '2025-03-29 18:19:36', 'password' => '$2y$12$ztAYWpdEU1OzX5rPnlFiBO4e2DZ8Ekqb8zSAt760rF5s.tMU76wOC',
                'status' => 'active', 'last_login_at' => null, 'national_id' => null,
                'preferred_language' => 'ar', 'avatar' => null, 'address' => null, 'created_by' => null,
                'phone_number' => '+1 (360) 780-6324', 'remember_token' => 'SUSRitr9U6',
                'created_at' => '2025-03-29 18:19:42', 'updated_at' => '2025-03-29 18:19:42'
            ],
            [
                'id' => 23, 'name' => 'Cayla Schimmel', 'email' => 'huel.yasmine@example.org',
                'email_verified_at' => '2025-03-29 18:19:36', 'password' => '$2y$12$3k7/YT3KTuckFNiRNCDDdO7.vnB543Bxp.8gjKWhj9kyAIZmzpAG6',
                'status' => 'active', 'last_login_at' => null, 'national_id' => null,
                'preferred_language' => 'ar', 'avatar' => null, 'address' => null, 'created_by' => null,
                'phone_number' => '+1-231-932-6929', 'remember_token' => '30SriKP6GE',
                'created_at' => '2025-03-29 18:19:42', 'updated_at' => '2025-03-29 18:19:42'
            ],
            [
                'id' => 27, 'name' => 'Allen Rutherford', 'email' => 'icie.dare@example.org',
                'email_verified_at' => '2025-03-29 18:19:37', 'password' => '$2y$12$4zHI6NvW9SZveeGQ3u/7Ie.Um5dc3XG.RrGhdoiOMq12zXLnS7dIq',
                'status' => 'inactive', 'last_login_at' => null, 'national_id' => '12342134',
                'preferred_language' => 'en', 'avatar' => null, 'address' => 'asdfasdfasafd', 'created_by' => null,
                'phone_number' => '+553-42375678568', 'remember_token' => 'uxoodb0pQ0',
                'created_at' => '2025-03-29 18:19:42', 'updated_at' => '2025-08-29 06:18:50'
            ],
            [
                'id' => 30, 'name' => 'Alda Auer DVM', 'email' => 'mertie.sawayn@example.com',
                'email_verified_at' => '2025-03-29 18:19:38', 'password' => '$2y$12$oswZCyHg8K9AbPh1QjeAcO6JhSKS3RUoDSBgD1GRUTAdSTCpbCAtS',
                'status' => 'inactive', 'last_login_at' => null, 'national_id' => null,
                'preferred_language' => 'ar', 'avatar' => null, 'address' => null, 'created_by' => null,
                'phone_number' => '847-669-4241', 'remember_token' => 'VUDxSbS6B5',
                'created_at' => '2025-03-29 18:19:43', 'updated_at' => '2025-08-29 06:08:09'
            ],
            [
                'id' => 32, 'name' => 'Clotilde Stamm Jr.', 'email' => 'stacy.waters@example.net',
                'email_verified_at' => '2025-03-29 18:19:38', 'password' => '$2y$12$Hlcj/5n4v0LHo45oKDh6LuQwD8AwN9B72QAGT49bs73.eMn3OaKG.',
                'status' => 'active', 'last_login_at' => null, 'national_id' => null,
                'preferred_language' => 'ar', 'avatar' => null, 'address' => null, 'created_by' => null,
                'phone_number' => '240.429.9759', 'remember_token' => 'woJy53I4GF',
                'created_at' => '2025-03-29 18:19:43', 'updated_at' => '2025-03-29 18:19:43'
            ],
            [
                'id' => 43, 'name' => 'مدير النظام', 'email' => 'admin@example.com',
                'email_verified_at' => '2025-08-26 23:06:33', 'password' => '$2y$12$NA48WfZMms4wWANRs2NXLOlxmku8NGtZgZrug2bTfv.cs6.t5z1ki',
                'status' => 'active', 'last_login_at' => '2025-09-17 13:19:09', 'national_id' => '1234567890',
                'preferred_language' => 'ar', 'avatar' => null, 'address' => 'الرياض، المملكة العربية السعودية', 'created_by' => null,
                'phone_number' => '+966500000001', 'remember_token' => null,
                'created_at' => '2025-08-26 23:06:33', 'updated_at' => '2025-09-17 14:00:38'
            ],
            [
                'id' => 44, 'name' => 'موظف وثائق', 'email' => 'employee@example.com',
                'email_verified_at' => '2025-08-26 23:06:33', 'password' => '$2y$12$cT9zJV7YwJ/pUQaZlVftC.PrBkkAt4YiT..MKf8wcuUa4G9C9PtO2',
                'status' => 'active', 'last_login_at' => '2025-09-17 00:56:10', 'national_id' => '0987654321',
                'preferred_language' => 'ar', 'avatar' => null, 'address' => 'جدة، المملكة العربية السعودية', 'created_by' => 43,
                'phone_number' => '+966500000002', 'remember_token' => null,
                'created_at' => '2025-08-26 23:06:33', 'updated_at' => '2025-09-17 00:56:10'
            ],
            [
                'id' => 45, 'name' => 'أحمد محمد العبدالله', 'email' => 'ahmed@example.com',
                'email_verified_at' => '2025-08-26 23:06:33', 'password' => '$2y$12$Dxb.9UGwlAWQLhUTushR7u9bVjhKJHNwpStBi.gWlMa/72YMVwQdO',
                'status' => 'active', 'last_login_at' => null, 'national_id' => '1111111111',
                'preferred_language' => 'ar', 'avatar' => null, 'address' => 'المملكة العربية السعودية', 'created_by' => 43,
                'phone_number' => '+966500000003', 'remember_token' => null,
                'created_at' => '2025-08-26 23:06:33', 'updated_at' => '2025-08-26 23:06:33'
            ],
            [
                'id' => 46, 'name' => 'فاطمة علي الأحمد', 'email' => 'fatima@example.com',
                'email_verified_at' => '2025-08-26 23:06:34', 'password' => '$2y$12$cMdtXJtdCIC2EeNad7zLQ.gmAFmX2MAHFUn4PjLoq2kUz46R9O.Me',
                'status' => 'active', 'last_login_at' => '2025-08-27 00:35:42', 'national_id' => '2222222222',
                'preferred_language' => 'ar', 'avatar' => null, 'address' => 'المملكة العربية السعودية', 'created_by' => 43,
                'phone_number' => '+966500000004', 'remember_token' => null,
                'created_at' => '2025-08-26 23:06:34', 'updated_at' => '2025-08-27 00:35:42'
            ],
            [
                'id' => 47, 'name' => 'محمد عبدالرحمن السعد', 'email' => 'mohammed@example.com',
                'email_verified_at' => '2025-08-26 23:06:34', 'password' => '$2y$12$mkits7E8TCbdoo82ZX94r.T4meLAhsDsBdkOw5clFVzSb.AppAB/q',
                'status' => 'active', 'last_login_at' => null, 'national_id' => '3333333333',
                'preferred_language' => 'ar', 'avatar' => null, 'address' => 'المملكة العربية السعودية', 'created_by' => 43,
                'phone_number' => '+966500000005', 'remember_token' => null,
                'created_at' => '2025-08-26 23:06:34', 'updated_at' => '2025-08-26 23:06:34'
            ],
        ];

        foreach ($users as $user) {
            DB::table('users')->updateOrInsert(
                ['id' => $user['id']],
                $user
            );
        }
    }

    private function seedUserRoles()
    {
        $userRoles = [
            ['role_id' => 2, 'model_type' => 'App\\Models\\User', 'model_id' => 13],
            ['role_id' => 1, 'model_type' => 'App\\Models\\User', 'model_id' => 22],
            ['role_id' => 1, 'model_type' => 'App\\Models\\User', 'model_id' => 23],
            ['role_id' => 1, 'model_type' => 'App\\Models\\User', 'model_id' => 27],
            ['role_id' => 1, 'model_type' => 'App\\Models\\User', 'model_id' => 30],
            ['role_id' => 2, 'model_type' => 'App\\Models\\User', 'model_id' => 32],
            ['role_id' => 1, 'model_type' => 'App\\Models\\User', 'model_id' => 43],
            ['role_id' => 2, 'model_type' => 'App\\Models\\User', 'model_id' => 44],
            ['role_id' => 2, 'model_type' => 'App\\Models\\User', 'model_id' => 45],
            ['role_id' => 2, 'model_type' => 'App\\Models\\User', 'model_id' => 46],
            ['role_id' => 2, 'model_type' => 'App\\Models\\User', 'model_id' => 47],
        ];

        foreach ($userRoles as $userRole) {
            DB::table('model_has_roles')->updateOrInsert(
                ['role_id' => $userRole['role_id'], 'model_type' => $userRole['model_type'], 'model_id' => $userRole['model_id']],
                $userRole
            );
        }
    }

    private function seedUserPermissions()
    {
        $userPermissions = [
            // User 22 permissions
            ['permission_id' => 72, 'model_type' => 'App\\Models\\User', 'model_id' => 22],
            ['permission_id' => 73, 'model_type' => 'App\\Models\\User', 'model_id' => 22],
            ['permission_id' => 74, 'model_type' => 'App\\Models\\User', 'model_id' => 22],
            ['permission_id' => 75, 'model_type' => 'App\\Models\\User', 'model_id' => 22],
            ['permission_id' => 76, 'model_type' => 'App\\Models\\User', 'model_id' => 22],
            ['permission_id' => 77, 'model_type' => 'App\\Models\\User', 'model_id' => 22],
            ['permission_id' => 78, 'model_type' => 'App\\Models\\User', 'model_id' => 22],
            // User 23 permissions
            ['permission_id' => 72, 'model_type' => 'App\\Models\\User', 'model_id' => 23],
            ['permission_id' => 73, 'model_type' => 'App\\Models\\User', 'model_id' => 23],
            ['permission_id' => 74, 'model_type' => 'App\\Models\\User', 'model_id' => 23],
            ['permission_id' => 75, 'model_type' => 'App\\Models\\User', 'model_id' => 23],
            ['permission_id' => 76, 'model_type' => 'App\\Models\\User', 'model_id' => 23],
            ['permission_id' => 77, 'model_type' => 'App\\Models\\User', 'model_id' => 23],
            ['permission_id' => 78, 'model_type' => 'App\\Models\\User', 'model_id' => 23],
            // User 27 permissions
            ['permission_id' => 72, 'model_type' => 'App\\Models\\User', 'model_id' => 27],
            ['permission_id' => 73, 'model_type' => 'App\\Models\\User', 'model_id' => 27],
            ['permission_id' => 74, 'model_type' => 'App\\Models\\User', 'model_id' => 27],
            ['permission_id' => 75, 'model_type' => 'App\\Models\\User', 'model_id' => 27],
            ['permission_id' => 76, 'model_type' => 'App\\Models\\User', 'model_id' => 27],
            ['permission_id' => 77, 'model_type' => 'App\\Models\\User', 'model_id' => 27],
            ['permission_id' => 78, 'model_type' => 'App\\Models\\User', 'model_id' => 27],
            // User 30 permissions
            ['permission_id' => 72, 'model_type' => 'App\\Models\\User', 'model_id' => 30],
            ['permission_id' => 73, 'model_type' => 'App\\Models\\User', 'model_id' => 30],
            ['permission_id' => 74, 'model_type' => 'App\\Models\\User', 'model_id' => 30],
            ['permission_id' => 75, 'model_type' => 'App\\Models\\User', 'model_id' => 30],
            ['permission_id' => 76, 'model_type' => 'App\\Models\\User', 'model_id' => 30],
            ['permission_id' => 77, 'model_type' => 'App\\Models\\User', 'model_id' => 30],
            ['permission_id' => 78, 'model_type' => 'App\\Models\\User', 'model_id' => 30],
            // User 43 permissions
            ['permission_id' => 72, 'model_type' => 'App\\Models\\User', 'model_id' => 43],
            ['permission_id' => 73, 'model_type' => 'App\\Models\\User', 'model_id' => 43],
            ['permission_id' => 74, 'model_type' => 'App\\Models\\User', 'model_id' => 43],
            ['permission_id' => 75, 'model_type' => 'App\\Models\\User', 'model_id' => 43],
            ['permission_id' => 76, 'model_type' => 'App\\Models\\User', 'model_id' => 43],
            ['permission_id' => 77, 'model_type' => 'App\\Models\\User', 'model_id' => 43],
            ['permission_id' => 78, 'model_type' => 'App\\Models\\User', 'model_id' => 43],
        ];

        foreach ($userPermissions as $userPermission) {
            DB::table('model_has_permissions')->updateOrInsert(
                ['permission_id' => $userPermission['permission_id'], 'model_type' => $userPermission['model_type'], 'model_id' => $userPermission['model_id']],
                $userPermission
            );
        }
    }
}
