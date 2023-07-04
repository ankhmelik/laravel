<?php

namespace App\Console;


use Illuminate\Console\Command;
use Illuminate\Support\Facades\Http;


class Test1 extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'test1';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }



    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $botToken = config('services.tg.key');
        $chatId =  "-1001750994025";
        $url = "https://api.telegram.org/bot{$botToken}/sendMessage";

        $message="test1";

        $response = Http::post($url, [
            'chat_id' => $chatId,
            'text' => $message,
        ]);

        if ($response->successful()) {
            echo 'Message sent successfully!';
        } else {
            echo 'Error: ' . $response->json('description');
        }





    }

}
