<?php namespace App\Console\Commands;

use Illuminate\Console\Command;
use Symfony\Component\Console\Input\InputOption;
use Illuminate\Http\Request;

class CallRoute extends Command {

    protected $name = 'route:call';
    protected $description = 'Call route from CLI';

    public function __construct()
    {
        parent::__construct();
    }

    public function handle()
    {
        $request = Request::create($this->option('uri'), $this->option('type'), array_diff_key($this->options(), array_flip(['uri', 'type'])));
        $this->info(app()['Illuminate\Contracts\Http\Kernel']->handle($request));
    }

    protected function getOptions()
    {
        return [
            ['uri', null, InputOption::VALUE_REQUIRED, 'The path of the route to be called', null],
            ['type', null, InputOption::VALUE_REQUIRED, 'The type of the route to be called', null],
            ['query', null, InputOption::VALUE_OPTIONAL, 'The type of the route to be called', null],
            ['foreign_table_id', null, InputOption::VALUE_OPTIONAL, 'The type of the route to be called', null],
        ];
    }

}
