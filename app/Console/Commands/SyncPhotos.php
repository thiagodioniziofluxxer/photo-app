<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class SyncPhotos extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:sync-photos';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $directories = Storage::disk('public')->directories('photos');
        foreach ($directories as $dir){
            $files = Storage::disk('public')->files($dir);
            foreach ($files as $file){
                $destiny  = 'geral'.Str::replace($dir,'', $file);

                if(!Storage::disk('public')->exists($destiny)){
                    $this->output->info( "Salvando arquivo $file");
                    Storage::disk('public')->move($file, $destiny);

                }
            }
        }
    }
}
