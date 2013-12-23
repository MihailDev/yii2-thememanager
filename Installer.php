<?php

namespace yii\thememanager;

use Composer\Package\PackageInterface;
use Composer\Installer\LibraryInstaller;
use Composer\Repository\InstalledRepositoryInterface;

class Installer extends LibraryInstaller
{
    const EXTRA_WEBPATH = 'webpath';
    const EXTRA_THEMESPATH = 'themespath';
    const EXTRA_THEMES = 'themes';

	/**
	 * @inheritdoc
	 */
	public function supports($packageType)
	{
		return ($packageType === 'yii2-theme');
	}

    private $_webPath;

    public function getWebPath(){
        if($this->_webPath !== null)
            return $this->_webPath;

        $this->_webPath = "www";
        $extra = $this->composer->getPackage()->getExtra();
        if(isset($extra[self::EXTRA_WEBPATH]))
            $this->_webPath = $extra[self::EXTRA_WEBPATH];

        $this->filesystem->ensureDirectoryExists($this->_webPath);
        $this->_webPath = realpath($this->_webPath);

        return $this->_webPath;
    }

    private $_themesPath;

    public function getThemesPath(){
        if($this->_themesPath !== null)
            return $this->_themesPath;

        $this->_themesPath = "themes";
        $extra = $this->composer->getPackage()->getExtra();
        if(isset($extra[self::EXTRA_THEMESPATH]))
            $this->_themesPath = $extra[self::EXTRA_THEMESPATH];

        $this->_themesPath = $this->getWebPath()."/".$this->_themesPath;
        $this->filesystem->ensureDirectoryExists($this->_themesPath);
        $this->_themesPath = realpath($this->_themesPath);

        return $this->_themesPath;
    }

    /**
     * {@inheritDoc}
     */
    public function getInstallPath(PackageInterface $package)
    {
        return $this->getPackageBasePath($package);
    }

    protected function getPackageBasePath(PackageInterface $package)
    {
        $targetDir = $package->getTargetDir();
        $name = $targetDir ? $targetDir : $package->getPrettyName();

        $extra = $this->composer->getPackage()->getExtra();
        if(isset($extra[self::EXTRA_THEMES][$package->getName()]))
            $name = $extra[self::EXTRA_THEMES][$package->getName()];

        return $this->getThemesPath()."/".$name;
    }
}
