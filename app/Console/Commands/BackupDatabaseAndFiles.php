<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
use Illuminate\Support\Facades\Log;

class BackupDatabaseAndFiles extends Command
{
    // The name and signature of the console command.
    protected $signature = 'backup:database-and-files';

    // The console command description.
    protected $description = 'Create an SQL dump and copy files to another disk';

    // Execute the console command.
    public function handle()
    {
        try{
            // Create a timestamp for the dump file and backup folder.
            $timestamp = Carbon::now()->format('Y-m-d_H-i-s');
            $backupFolder = "/mnt/nfs-share/private_mbbs/{$timestamp}";
            $sqlDumpFile = "{$backupFolder}/database.sql";

            // Create backup folder if it doesn't exist.
            if (!File::exists($backupFolder)) {
                File::makeDirectory($backupFolder, 0755, true);
            }

            // Run the command to create the SQL dump (using mysqldump)
            $databaseName = env('DB_DATABASE');
            $username = env('DB_USERNAME');
            $password = env('DB_PASSWORD');
            $host = env('DB_HOST', '127.0.0.1');
            
            $command = "mysqldump --user={$username} --password={$password} --host={$host} {$databaseName} > {$sqlDumpFile}";

            // Execute the command to generate SQL dump.
            $this->info("Creating SQL dump for the database...");
            exec($command);

            $this->info("SQL dump created at {$sqlDumpFile}");

            // Now copy files from one disk to another (e.g., from local to external disk).
            $sourceDirectory = public_path('storage'); // Adjust as needed.

            // Ensure the destination disk exists.
            // if (!Storage::disk($destinationDisk)->exists("private_mbbs/{$timestamp}")) {
            //     Storage::disk($destinationDisk)->makeDirectory("private_mbbs/{$timestamp}");
            // }

            // Copy all files from the source to the backup directory on the external disk.
            $this->info("Copying files to external disk...");
            $files = File::allFiles($sourceDirectory);
            $filteredFiles = array_filter($files, function ($file) {
                // Exclude files if they are in the 'livewire-temp' directory
                return !str_contains($file->getPathname(), 'livewire-temp');
            });
            
            foreach ($filteredFiles as $file) {
                if(Storage::exists($sourceDirectory.$file->getRelativePathname())){
                    $destinationPath = 'private_mbbs/'.$timestamp. '/' . $file->getRelativePathname();
                    Storage::disk('backup')->put($destinationPath, File::get($file));
                }
            }

            $this->info("Files copied to external disk.");

            $this->info("Backup completed successfully.");
            Log::channel('backup')->info('Backup completed successfully.');
        }catch(\Exception $e){
            Log::channel('backup')->info($e->getMessage());
        }
    }
}
