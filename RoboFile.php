<?php
require __DIR__ . '/vendor/autoload.php';

class RoboFile extends \Robo\Tasks
{
    use voodoo44\Robo\Task\Deployment\Version;
    use voodoo44\Robo\Task\Deployment\GenerateConfiguration;

    function version()
    {
        $version = $this->taskVersion()
            ->run();

        echo $version;
    }

    function replace()
    {
        $testreplace = array(
            '##foo.bar##' => 'bar',
            '##foo.baz##' => 'baz'
        );

        $this->taskGenerateConfiguration(array('test.ini.dist' => 'test.ini'))
            ->replace($testreplace)
            ->run();
    }
}
