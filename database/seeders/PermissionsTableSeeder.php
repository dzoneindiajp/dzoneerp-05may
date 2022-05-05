<?php

namespace Database\Seeders;

use App\Models\Permission;
use Illuminate\Database\Seeder;

class PermissionsTableSeeder extends Seeder
{
    public function run()
    {
        $permissions = [
            [
                'id'    => 1,
                'title' => 'user_management_access',
            ],
            [
                'id'    => 2,
                'title' => 'permission_create',
            ],
            [
                'id'    => 3,
                'title' => 'permission_edit',
            ],
            [
                'id'    => 4,
                'title' => 'permission_show',
            ],
            [
                'id'    => 5,
                'title' => 'permission_delete',
            ],
            [
                'id'    => 6,
                'title' => 'permission_access',
            ],
            [
                'id'    => 7,
                'title' => 'role_create',
            ],
            [
                'id'    => 8,
                'title' => 'role_edit',
            ],
            [
                'id'    => 9,
                'title' => 'role_show',
            ],
            [
                'id'    => 10,
                'title' => 'role_delete',
            ],
            [
                'id'    => 11,
                'title' => 'role_access',
            ],
            [
                'id'    => 12,
                'title' => 'user_create',
            ],
            [
                'id'    => 13,
                'title' => 'user_edit',
            ],
            [
                'id'    => 14,
                'title' => 'user_show',
            ],
            [
                'id'    => 15,
                'title' => 'user_delete',
            ],
            [
                'id'    => 16,
                'title' => 'user_access',
            ],
            [
                'id'    => 17,
                'title' => 'asset_management_access',
            ],
            [
                'id'    => 18,
                'title' => 'asset_category_create',
            ],
            [
                'id'    => 19,
                'title' => 'asset_category_edit',
            ],
            [
                'id'    => 20,
                'title' => 'asset_category_show',
            ],
            [
                'id'    => 21,
                'title' => 'asset_category_delete',
            ],
            [
                'id'    => 22,
                'title' => 'asset_category_access',
            ],
            [
                'id'    => 23,
                'title' => 'asset_location_create',
            ],
            [
                'id'    => 24,
                'title' => 'asset_location_edit',
            ],
            [
                'id'    => 25,
                'title' => 'asset_location_show',
            ],
            [
                'id'    => 26,
                'title' => 'asset_location_delete',
            ],
            [
                'id'    => 27,
                'title' => 'asset_location_access',
            ],
            [
                'id'    => 28,
                'title' => 'asset_status_create',
            ],
            [
                'id'    => 29,
                'title' => 'asset_status_edit',
            ],
            [
                'id'    => 30,
                'title' => 'asset_status_show',
            ],
            [
                'id'    => 31,
                'title' => 'asset_status_delete',
            ],
            [
                'id'    => 32,
                'title' => 'asset_status_access',
            ],
            [
                'id'    => 33,
                'title' => 'asset_create',
            ],
            [
                'id'    => 34,
                'title' => 'asset_edit',
            ],
            [
                'id'    => 35,
                'title' => 'asset_show',
            ],
            [
                'id'    => 36,
                'title' => 'asset_delete',
            ],
            [
                'id'    => 37,
                'title' => 'asset_access',
            ],
            [
                'id'    => 38,
                'title' => 'assets_history_access',
            ],
            [
                'id'    => 39,
                'title' => 'basic_c_r_m_access',
            ],
            [
                'id'    => 40,
                'title' => 'crm_status_create',
            ],
            [
                'id'    => 41,
                'title' => 'crm_status_edit',
            ],
            [
                'id'    => 42,
                'title' => 'crm_status_show',
            ],
            [
                'id'    => 43,
                'title' => 'crm_status_delete',
            ],
            [
                'id'    => 44,
                'title' => 'crm_status_access',
            ],
            [
                'id'    => 45,
                'title' => 'crm_customer_create',
            ],
            [
                'id'    => 46,
                'title' => 'crm_customer_edit',
            ],
            [
                'id'    => 47,
                'title' => 'crm_customer_show',
            ],
            [
                'id'    => 48,
                'title' => 'crm_customer_delete',
            ],
            [
                'id'    => 49,
                'title' => 'crm_customer_access',
            ],
            [
                'id'    => 50,
                'title' => 'crm_note_create',
            ],
            [
                'id'    => 51,
                'title' => 'crm_note_edit',
            ],
            [
                'id'    => 52,
                'title' => 'crm_note_show',
            ],
            [
                'id'    => 53,
                'title' => 'crm_note_delete',
            ],
            [
                'id'    => 54,
                'title' => 'crm_note_access',
            ],
            [
                'id'    => 55,
                'title' => 'crm_document_create',
            ],
            [
                'id'    => 56,
                'title' => 'crm_document_edit',
            ],
            [
                'id'    => 57,
                'title' => 'crm_document_show',
            ],
            [
                'id'    => 58,
                'title' => 'crm_document_delete',
            ],
            [
                'id'    => 59,
                'title' => 'crm_document_access',
            ],
            [
                'id'    => 60,
                'title' => 'faq_management_access',
            ],
            [
                'id'    => 61,
                'title' => 'faq_category_create',
            ],
            [
                'id'    => 62,
                'title' => 'faq_category_edit',
            ],
            [
                'id'    => 63,
                'title' => 'faq_category_show',
            ],
            [
                'id'    => 64,
                'title' => 'faq_category_delete',
            ],
            [
                'id'    => 65,
                'title' => 'faq_category_access',
            ],
            [
                'id'    => 66,
                'title' => 'faq_question_create',
            ],
            [
                'id'    => 67,
                'title' => 'faq_question_edit',
            ],
            [
                'id'    => 68,
                'title' => 'faq_question_show',
            ],
            [
                'id'    => 69,
                'title' => 'faq_question_delete',
            ],
            [
                'id'    => 70,
                'title' => 'faq_question_access',
            ],
            [
                'id'    => 71,
                'title' => 'profile_password_edit',
            ],
        ];

        Permission::insert($permissions);
    }
}
