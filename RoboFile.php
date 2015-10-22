<?php
require __DIR__ . '/vendor/autoload.php';

class RoboFile extends \Robo\Tasks
{
    use voodoo44\Robo\Task\Deployment\Version;

    function version()
    {
        $version = $this->taskVersion()
            ->run();

        echo $version;
    }
}
