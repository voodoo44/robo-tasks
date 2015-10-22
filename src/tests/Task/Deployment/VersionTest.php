<?php

class VersionTest extends \Codeception\TestCase\Test
{
    use voodoo44\Robo\Task\Deployment\Version;

    /**
     * Try to get the correct version
     */
    public function testRun()
    {
        $version = $this->taskVersion()->run();

        $this->assertEquals('1.0', $version);
    }
}
