<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\File;

class MakeService extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'make:service {name}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Create a new service class';

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        // Get the service name from the argument
        $name = $this->argument('name');

        // Define the path and filename for the service
        $path = app_path('Services/' . $name . '.php');

        // Check if the file already exists
        if (File::exists($path)) {
            $this->error("Service {$name} already exists!");
            return;
        }

        // Create the Services directory if it doesn't exist
        if (!File::isDirectory(app_path('Services'))) {
            File::makeDirectory(app_path('Services'));
        }

        // Create the service file with basic structure
        File::put($path, $this->getServiceStub($name));

        $this->info("Service {$name} created successfully!");
    }

    /**
     * Get the service class stub content.
     *
     * @param string $name
     * @return string
     */
    protected function getServiceStub($name)
    {
        return <<<EOD
        <?php

        namespace App\Services;

        class {$name}
        {
            // Your business logic here
        }

        EOD;
    }
}
