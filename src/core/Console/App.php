<?php


namespace Elementary\Console;


use Elementary\Console\API\AppInterface;
use Symfony\Component\Console\Application;
use Symfony\Component\Console\Output\ConsoleOutput;

class App extends Application implements AppInterface
{

    public function __construct()
    {
        parent::__construct('Elementary', '1.0.0');
    }

    public function boot()
    {
        $commandClasses = json_decode(file_get_contents(APP_DIR . '/config/commands.json'));
        $this->addCommands(array_map(function ($command){
            return app()->get($command);
        }, $commandClasses->commands));


        $this->run();
    }

}