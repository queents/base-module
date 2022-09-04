<?php

namespace Modules\Base\Console;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\File;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Input\InputArgument;

class InstallVilt extends Command
{

    public string $publish;
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $name = 'vilt:install';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'This Command help you to generate the full file and view for VILT framework';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->publish = module_path('Base') . '/Publish';
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        /*
         * Step 1 Copy And Publish Assets
         */
        $this->info('Install Jetstream');
        $this->runArtisan('jetstream:install', [
            "inertia"
        ]);
        $this->info('Migrate Jetstream Tables');
        $this->runArtisan('migrate');
        $this->info('Copy tailwind.config.js');
        $this->handelFile('/tailwind.config.js', base_path('/tailwind.config.js'));
        $this->info('Copy vite.config.js');
        $this->handelFile('/vite.config.js', base_path('/vite.config.js'));
        $this->info('Copy postcss.config.js');
        $this->handelFile('/postcss.config.js', base_path('/postcss.config.js'));
        $this->info('Copy package.json');
        $this->handelFile('/package.json', base_path('/package.json'));
        $this->info('Copy HandleInertiaRequests.php');
        $this->handelFile('/app/Http/Middleware/HandleInertiaRequests.php', app_path('/Http/Middleware/HandleInertiaRequests.php'));
        $this->info('Copy modules.php');
        $this->handelFile('/config/modules.php', config_path('/modules.php'));
        $this->info('Copy app.php');
        $this->handelFile('/config/app.php', config_path('/app.php'));
        $this->info('Copy placeholder.webp');
        $this->handelFile('/public/placeholder.webp', public_path('/placeholder.webp'));
        $this->info('Copy css');
        $this->handelFile('/resources/css', resource_path('/'), 'folder');
        $this->info('Copy js');
        $this->handelFile('/resources/js', resource_path('/'), 'folder');
        $this->info('Copy views');
        $this->handelFile('/resources/views', resource_path('/'), 'folder');
        $this->info('Copy stubs');
        $this->handelFile('/stubs/nwidart-stubs', base_path('/stubs'), 'folder');
        $this->info('Clear cache');
        $this->runArtisan('optimize:clear');
        $this->info('Install Main Roles and User');
        $this->runArtisan('roles:install');
        $this->info('Please run npm i & npm run build');
    }

    public function handelFile(string $from, string $to, string $type = 'file'): bool
    {
        $checkIfFileEx = $this->checkFile($to);
        if($checkIfFileEx){
            $this->deleteFile($to);
            $this->copyFile($this->publish .$from, $to);
        }
        else {
            $this->copyFile($this->publish .$from, $to);
        }
    }

    public function runArtisan(string $command, array $args=[]): bool
    {
        return Artisan::call($command, $args);
    }
    public function checkFile(string $path): bool
    {
        return File::exists($path);
    }
    public function copyFile(string $from,string $to, string $type ='file'): bool
    {
        $copy = File::copy($from , $to);

        if($type === 'folder'){
            $copy = File::copyDirectory($from , $to);
        }

        return $copy;
    }
    public function deleteFile(string $path, string $type ='file'): bool
    {
        $delete = File::delete($path);

        if($type === 'folder'){
            $delete = File::deleteDirectory($path);
        }

        return $delete;
    }
}
