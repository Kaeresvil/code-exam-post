<?php

namespace App\Console\Commands;

use App\Models\Post;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Http;

class FetchJsonPlaceholderData extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:fetch-json-placeholder-data';

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
        $response = Http::get('https://jsonplaceholder.typicode.com/posts');
        if( $response->failed() ) {
            $this->error('Failed to fetch data from JSON Placeholder');
            return;
        }
        
        try {
         DB::beginTransaction();
       
        foreach ($response->json() as $post) {
            Post::updateOrCreate(['id' => $post['id'], 'user_id' => 1], $post);
        }
             DB::commit();
        } catch (\Exception $e) {
             DB::rollBack();
            throw $e;
            return;
        }
      
    }
}
