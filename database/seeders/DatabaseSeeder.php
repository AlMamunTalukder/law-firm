<?php

namespace Database\Seeders;

use App\Models\User;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{

    public function run(): void
    {
        $this->call([
            UserSeeder::class,
            DivisionSeeder::class,
            DistrictSeeder::class,
            AreaSeeder::class,
            DesignationSeeder::class,
            CategorySeeder::class,
            SectionSeeder::class,

            SettingSeeder::class,

            SocialMediaSeeder::class,
            PermissionFeatureSeeder::class,
            PermissionSeeder::class,
            RoleSeeder::class,
            ModelHasRoleSeeder::class,
            FooterSeeder::class,

        ]);
    }
}
