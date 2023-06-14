<?php

namespace App\Console\Commands;

use App\Models\Order;
use App\Models\OrderGood;
use App\Services\CommandService;
use App\Services\ExchangeRate\ExchangeRateServiceFactory;
use App\Services\MailerService;
use Illuminate\Console\Command;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Arr;
use Symfony\Component\Console\Command\Command as ConsoleCommand;

class ExchangeRateCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'exchange-rate-commands:run {--remove=}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Gets exchange rate for current currency for the day';

    /**
     * Execute the console command.
     *
     * @param MailerService $mailerService - service for sending email messages
     *
     * @return int
     */
    public function handle(MailerService $mailerService)
    {
        try {
            $removeRates = $this->option('remove');
            if (strtotime($removeRates)) {
                // remove data
            } else {
                $exchangeRateService = ExchangeRateServiceFactory::build(env('CURRENCY_CODE'));
                $saved = $exchangeRateService->save([
                    'currentCurrency' => env('CURRENCY_CODE'),
                ]);
                if (!$saved) {
                    throw new \Exception("There are no exchange rate for the currency " . env('CURRENCY_CODE'));
                }
            }
        } catch (\Exception $e) {
            $mailerService->sendRaw(
                explode('|', env('MAIL_WARNING_RECIPIENTS')),
                env('MAIL_WARNING_ADDRESS'),
                'WARNING',
                'APP ISSUE',
                'Error getting exchange rate:' . $e->getMessage()
            );
            logger()->error('Error getting exchange rate:' . $e->getMessage());
            return ConsoleCommand::FAILURE;
        }
        return ConsoleCommand::SUCCESS;
    }
}
