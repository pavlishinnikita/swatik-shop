<?php

namespace App\Services;

use App\Models\GoodCommand;
use App\Models\Order;
use App\Models\SubscriptionDuration;
use Illuminate\Database\Eloquent\Collection;
use Thedudeguy\Rcon;

/**
 * @package App\Services
 * @category Services
 *
 * class CommandService - service class for working with commands
 */
class CommandService
{
    const COMMAND_PARAM_REGEXP = "/{[a-z0-9\_\.\#\@\%\&]+}/";

    private $rcon;

    public function __construct()
    {
        try {
            $this->rcon = new Rcon(
                getenv("RCON_HOST"),
                getenv("RCON_PORT"),
                getenv("RCON_PASSWORD"),
                100
            );
        } catch (\Exception $e) {
            logger()->error('RCON is down:'. $e->getMessage());
        }
    }

    /**
     * Process running commands for goods
     * @param array|Collection $goods - items for run command for
     * @param array $params - params for preparing command
     * @return array
     */
    public function processGoodCommands(array|Collection $goods, array $params) : array
    {
        $failedGoodIds = [];
        if (array_key_exists('duration', $params)) {
            $params[GoodCommand::SUBSCRIBE_SUBCOMMAND_NAME] = ($params['duration'] ?? '') === SubscriptionDuration::VALUE_FOREVER ? GoodCommand::SUBSCRIBE_SUBCOMMANDS[SubscriptionDuration::VALUE_FOREVER] : GoodCommand::SUBSCRIBE_SUBCOMMANDS['others'];
        }
        foreach ($goods as $good) {
            foreach ($good['commands'] as $command) {
                $preparedCommand = $this->prepareCommandWithParams($command['command'] ?? '', $params);
                if (empty($preparedCommand)) {
                    continue;
                }
                $isSuccess = $this->runCommand($preparedCommand);
                if (!$isSuccess) {
                    $failedGoodIds[] = $good['id'] ?? 0;
                }
            }
        }

        return $failedGoodIds;
    }

    /**
     * Runs specific prepared command via RCON
     * @param string $command - command to apply
     * @return bool - status of execution
     */
    public function runCommand(string $command) : bool
    {
        try {
            if ($this->rcon->connect()) {
                $this->rcon->sendCommand($command);
                $response = $this->rcon->getResponse();
                // log command running status
            }
        } catch (\Exception $e) {
            logger()->error('Delivering command error:' . $e->getMessage(), [
                'command' => $command,
            ]);
            return false;
        } finally {
            $this->rcon->disconnect();
        }

        return true;
    }

    /**
     * Prepares command with params
     * @param string $command - command for preparing
     * @param array $params - params for the command
     * @return string - prepared command
     */
    public function prepareCommandWithParams(string $command, array $params) : string
    {
        if (empty($command)) {
            return '';
        }
        $matches = [];
        $preparedCommand = $command;
        preg_match_all(self::COMMAND_PARAM_REGEXP, $command, $matches);
        foreach (($matches[0] ?? []) as $key => $commandParam) {
            if (array_key_exists(trim($commandParam, "{}"), $params)) {
                $preparedCommand = str_replace(
                    $commandParam,
                    $params[trim($commandParam, "{}")],
                    $preparedCommand);
            }
        }
        return trim($preparedCommand, ' ');
    }
}
