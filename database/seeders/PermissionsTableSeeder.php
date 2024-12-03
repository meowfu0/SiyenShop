<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class PermissionsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::statement('ALTER TABLE messages AUTO_INCREMENT = 1;');
        $permission = [
            [
                'permission_name' => 'edit_profile',
                'created_at' => Carbon::now(),
            ],

            [
                'permission_name' => 'access_dashboard',
                'created_at' => Carbon::now(),
            ],

            [
                'permission_name' => 'view_sales_stats',
                'created_at' => Carbon::now(),
            ],

            [
                'permission_name' => 'generate_reports',
                'created_at' => Carbon::now(),
            ],

            [
                'permission_name' => 'inventory_alerts',
                'created_at' => Carbon::now(),
            ],

            [
                'permission_name' => 'export_data',
                'created_at' => Carbon::now(),
            ],

            [
                'permission_name' => 'view_orders',
                'created_at' => Carbon::now(),
            ],

            [
                'permission_name' => 'update_order_status',
                'created_at' => Carbon::now(),
            ],

            [
                'permission_name' => 'confirm_payments',
                'created_at' => Carbon::now(),
            ],

            [
                'permission_name' => 'deny_invalid_payments',
                'created_at' => Carbon::now(),
            ],

            [
                'permission_name' => 'send_payment_confirm_notif',
                'created_at' => Carbon::now(),
            ],

            [
                'permission_name' => 'add_products',
                'created_at' => Carbon::now(),
            ],

            [
                'permission_name' => 'edit_products',
                'created_at' => Carbon::now(),
            ],

            [
                'permission_name' => 'delete_products',
                'created_at' => Carbon::now(),
            ],

            [
                'permission_name' => 'generate_reports',
                'created_at' => Carbon::now(),
            ],

            [
                'permission_name' => 'mark_product_unavailable',
                'created_at' => Carbon::now(),
            ],

            [
                'permission_name' => 'low_stocks_alert',
                'created_at' => Carbon::now(),
            ],

            [
                'permission_name' => 'access_chatbox',
                'created_at' => Carbon::now(),
            ],

            [
                'permission_name' => 'respond_to_queries',
                'created_at' => Carbon::now(),
            ],
        ];

        DB::table('permissions')->insert($permission);
    }
}
