<?php
namespace voodoo44\Robo\Task\Deployment;
use Robo\Common\IO;
use Robo\Contract\TaskInterface;

trait Version
{
    function taskVersion()
    {
        return new VersionTask();
    }
}

class VersionTask implements TaskInterface
{
    use IO;

    /**
     * @var string
     */
    protected $version = '1.0';

    /**
     * @return string
     */
    public function run()
    {
        return $this->version;
    }
}
?>