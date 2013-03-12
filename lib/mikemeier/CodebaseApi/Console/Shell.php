<?php

namespace mikemeier\CodebaseApi\Console;

use Symfony\Component\Console\Application;
use Symfony\Component\Console\Shell as SymfonyShell;

use Symfony\Component\Finder\Finder;

class Shell
{
    /**
     * @var Application
     */
    protected $application;

    /**
     * @var SymfonyShell
     */
    protected $shell;

    /**
     * @var Shell
     */
    protected $reflected;

    const NAME = 'CodebaseApi';
    const VERSION = '1.0.0';

    /**
     * @param Application $application
     * @param SymfonyShell $shell
     */
    public function __construct(Application $application = null, SymfonyShell $shell = null)
    {
        $this->application = $application ?: new Application(self::NAME, self::VERSION);
        $this->shell = $shell ?: new SymfonyShell($this->application);
    }

    /**
     * @return Shell
     */
    public function registerCommands()
    {
        if (!is_dir($dir = realpath(__DIR__.'/../Command'))) {
            return;
        }

        $finder = new Finder();
        $finder->files()->name('*Command.php')->in($dir);

        $prefix = 'mikemeier\\CodebaseApi\\Command';
        foreach ($finder as $file) {
            $ns = $prefix;
            if ($relativePath = $file->getRelativePath()) {
                $ns .= '\\'.strtr($relativePath, '/', '\\');
            }
            $r = new \ReflectionClass($ns.'\\'.$file->getBasename('.php'));
            if ($r->isSubclassOf('Symfony\\Component\\Console\\Command\\Command') && !$r->isAbstract()) {
                $this->application->add($r->newInstance());
            }
        }

        return $this;
    }

    /**
     * @return SymfonyShell
     */
    public function getShell()
    {
        return $this->shell;
    }

    /**
     * @return Application
     */
    public function getApplication()
    {
        return $this->application;
    }

    public function run()
    {
        $this->shell->run();
    }
}