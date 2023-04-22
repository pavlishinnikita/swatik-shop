<?php

namespace App\Console\Commands;

use App\Models\Good;
use App\Models\GoodCategory;
use App\Models\GoodCommand;
use App\Models\Order;
use App\Models\OrderGood;
use App\Services\CommandService;
use App\Services\MailerService;
use Illuminate\Console\Command;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Arr;
use Symfony\Component\Console\Command\Command as ConsoleCommand;
use Symfony\Component\Yaml\Yaml;

class InitAppCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:init';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Once inits app for the production';

    /**
     * Executes the console command.
     *
     *
     * @return int
     */
    public function handle()
    {
        try {
            $initData = Yaml::parse(file_get_contents(resource_path() . "/yaml/init.yaml"));
            foreach ($initData['categories'] ?? [] as $category) {
                //#region good category creation
                $goodCategory = new GoodCategory();
                if ($category['type'] == 'одиночная') {
                    $category['type'] = GoodCategory::TYPE_SIMPLE;
                } elseif ($category['type'] == 'весовая') {
                    $category['type'] = GoodCategory::TYPE_COUNTABLE;
                } else {
                    $category['type'] = GoodCategory::TYPE_MULTIPLE;
                }
                $goodCategory->fill($category);
                $goodCategory->save($category);
                //#endregion
                foreach ($category['goods'] as $goodData) {
                    //#region good creation
                    $good = new Good();
                    if ($goodData['type'] == 'обычный') {
                        $goodData['type'] = Good::TYPE_DEFAULT;
                    } elseif ($goodData['type'] == 'привилегия') {
                        $goodData['type'] = Good::TYPE_PRIVILEGE;
                    } else {
                        $goodData['type'] = Good::TYPE_CASE;
                    }
                    $good->fill($goodData);
                    //#endregion
                    $goodCategory->goods()->save($good);
                    $goodCommand = new GoodCommand($goodData['command']);
                    $good->command()->save($goodCommand);
                }
            }
        } catch (\Exception $e) {
            logger()->error('Error during init application:' . $e->getMessage());
            return ConsoleCommand::FAILURE;
        }
        return ConsoleCommand::SUCCESS;
    }
}
