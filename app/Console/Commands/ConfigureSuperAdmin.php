<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class ConfigureSuperAdmin extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:configure-super-admin';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Configure super admin role with all permissions';


    /**
     * Execute the console command.
     */
    public function handle()
    {
        $superAdminRole = Role::findByName('super-admin');
        $permissions = Permission::pluck('name');
        $superAdminRole->syncPermissions($permissions);

        $this->info('Super admin role configured with all permissions.');
    }
}
