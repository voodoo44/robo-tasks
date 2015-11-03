<?php

class GenerateConfigurationTest extends \Codeception\TestCase\Test
{
    use voodoo44\Robo\Task\Deployment\GenerateConfiguration;
    use \Robo\Task\File\loadTasks;
    use \Robo\Task\FileSystem\loadTasks;

    /**
     *
     */
    protected function setUp()
    {
        parent::setUp();

        $this->taskFilesystemStack()
            ->copy(dirname(dirname(__DIR__)) . '/Fixture/testconfig.ini.dist', 'testconfig.ini.dist')
            ->run();
    }

    /**
     * Try to generate a simple testconfiguration
     */
    public function testRun()
    {
        // replace with 'real' values
        $testreplace = array(
            '##foo.bar##' => 'bar',
            '##foo.baz##' => 'baz'
        );
        $this->taskGenerateConfiguration(array('testconfig.ini.dist' => dirname(dirname(__DIR__)) . '/Task/Deployment/testconfig.ini'))
            ->replace($testreplace)
            ->run();

        // check, if file was generated successful
        $this->assertFileExists(dirname(dirname(__DIR__)) . '/Task/Deployment/testconfig.ini');
        $this->assertFileEquals(dirname(dirname(__DIR__)) . '/Fixture/testconfigdump.ini', dirname(dirname(__DIR__)) . '/Task/Deployment/testconfig.ini');
    }
}
