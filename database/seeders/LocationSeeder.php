<?php

namespace Database\Seeders;

use App\Models\Location;
use Illuminate\Database\Seeder;

class LocationSeeder extends Seeder
{
    public function run(): void
    {
        $locations = [
            [
                'name' => 'Migura Wash Pekanbaru Pusat',
                'code' => 'MIG-PKU-01',
                'address' => 'Jl. Sudirman No. 123, Pekanbaru, Riau 28116',
                'latitude' => 0.478652,
                'longitude' => 101.402108,
                'phone' => '0761-1234567',
                'email' => 'pekanbaru@migurawash.com',
                'open_time' => '08:00:00',
                'close_time' => '20:00:00',
                'operating_days' => ['monday', 'tuesday', 'wednesday', 'thursday', 'friday', 'saturday', 'sunday'],
                'max_service_radius_km' => 10,
                'daily_capacity' => 50,
                'slot_capacity' => 5,
                'is_active' => true,
                'is_main_branch' => true,
                'sort_order' => 1,
                'description' => 'Cabang utama Migura Wash di pusat kota Pekanbaru. Dilengkapi dengan fasilitas lengkap dan staff profesional.',
                'facilities' => ['parking', 'wifi', 'waiting_room', 'toilet', 'musholla', 'cafeteria'],
            ],
            [
                'name' => 'Migura Wash Marpoyan',
                'code' => 'MIG-PKU-02',
                'address' => 'Jl. HR. Soebrantas KM 10, Marpoyan, Pekanbaru, Riau 28282',
                'latitude' => 0.469478,
                'longitude' => 101.384644,
                'phone' => '0761-7654321',
                'email' => 'marpoyan@migurawash.com',
                'open_time' => '08:00:00',
                'close_time' => '20:00:00',
                'operating_days' => ['monday', 'tuesday', 'wednesday', 'thursday', 'friday', 'saturday', 'sunday'],
                'max_service_radius_km' => 8,
                'daily_capacity' => 40,
                'slot_capacity' => 4,
                'is_active' => true,
                'is_main_branch' => false,
                'sort_order' => 2,
                'description' => 'Cabang Migura Wash di area Marpoyan, strategis dan mudah dijangkau.',
                'facilities' => ['parking', 'wifi', 'waiting_room', 'toilet', 'musholla'],
            ],
            [
                'name' => 'Migura Wash Arengka',
                'code' => 'MIG-PKU-03',
                'address' => 'Jl. Arifin Ahmad, Arengka, Pekanbaru, Riau 28294',
                'latitude' => 0.513924,
                'longitude' => 101.447983,
                'phone' => '0761-9876543',
                'email' => 'arengka@migurawash.com',
                'open_time' => '09:00:00',
                'close_time' => '21:00:00',
                'operating_days' => ['monday', 'tuesday', 'wednesday', 'thursday', 'friday', 'saturday', 'sunday'],
                'max_service_radius_km' => 7,
                'daily_capacity' => 35,
                'slot_capacity' => 4,
                'is_active' => true,
                'is_main_branch' => false,
                'sort_order' => 3,
                'description' => 'Cabang baru Migura Wash di area Arengka dengan konsep modern.',
                'facilities' => ['parking', 'wifi', 'waiting_room', 'toilet'],
            ],
        ];

        foreach ($locations as $location) {
            Location::create($location);
        }
    }
}
