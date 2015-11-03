<?php
namespace voodoo44\Robo\Task\Deployment;
use Robo\Common\IO;
use Robo\Contract\TaskInterface;

trait GenerateConfiguration
{
    function taskGenerateConfiguration($files)
    {
        return new GenerateConfigurationTask($files);
    }
}

class GenerateConfigurationTask implements TaskInterface
{
    use IO;
    use \Robo\Task\File\loadTasks;
    use \Robo\Task\FileSystem\loadTasks;

    /**
     * @var string
     */
    protected $fileName = null;

    /**
     * @var array
     */
    protected $replace = array();

    /**
     * @var array
     */
    protected $files = array();

    /**
     * GenerateConfigurationTask constructor.
     *
     * @param array $files
     */
    public function __construct(array $files = array())
    {
        $this->files = $files;
    }

    /**
     * @param string $fileName
     *
     * @return $this
     */
    public function into($fileName = null)
    {
        if (is_string($fileName)) {
            $this->fileName = $fileName;
        }

        return $this;
    }

    /**
     * @param array $replace
     *
     * @return $this
     */
    public function replace(array $replace)
    {
        $this->replace = $replace;

        return $this;
    }

    /**
     * @param array $replacefrom
     * @param array $replaceto
     *
     * @return $this
     */
    protected function replaceconfiguration(array $replacefrom, array $replaceto)
    {
        // iterate over filelist and replace everything we need
        foreach ($this->files as $from => $to) {
            if (is_string($from) === true) {
                // copy file
                $this->taskFileSystemStack()
                    ->copy($from, $to, true)
                    ->run();

                // replace content
                $this->taskReplaceInFile($to)
                    ->from($replacefrom)
                    ->to($replaceto)
                    ->run();

                // remove old dist-files
                $this->taskFilesystemStack()
                    ->remove($from)
                    ->run();
            }
        }

        return $this;
    }

    /**
     * @return $this
     */
    protected function concatconfiguration()
    {
        $this->taskConcat($this->files)
            ->to($this->fileName)
            ->run();

        foreach($this->files as $configfile) {
            $this->taskFilesystemStack()
                ->remove($configfile)
                ->run();
        }

        return $this;
    }

    /**
     * @return $this
     */
    public function run()
    {
        // replace the configurationfile-content with real data
        $this->replaceconfiguration(array_keys($this->replace), array_values($this->replace));

        // concat into one file and delete old config files
        if ($this->fileName !== null) {
            $this->concatconfiguration();
        }

        return $this;
    }
}
?>