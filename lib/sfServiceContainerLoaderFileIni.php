<?php

/*
 * This file is part of the symfony framework.
 *
 * (c) Fabien Potencier <fabien.potencier@symfony-project.com>
 *
 * This source file is subject to the MIT license that is bundled
 * with this source code in the file LICENSE.
 */

/**
 * sfServiceContainerLoaderFileIni loads parameters from INI files.
 *
 * @package    symfony
 * @subpackage service
 * @author     Fabien Potencier <fabien.potencier@symfony-project.com>
 * @version    SVN: $Id$
 */
class sfServiceContainerLoaderFileIni extends sfServiceContainerLoaderFile
{
  public function doLoad($files)
  {
    $parameters = array();
    foreach ($files as $file)
    {
      $path = $this->getAbsolutePath($file);
      if (!file_exists($path))
      {
        throw new InvalidArgumentException(sprintf('The %s file does not exist.', $file));
      }

      if (false === $result = parse_ini_file($path, true))
      {
        throw new InvalidArgumentException(sprintf('The %s file is not valid.', $file));
      }

      if (isset($result['parameters']) && is_array($result['parameters']))
      {
        $parameters = array_merge($parameters, $result['parameters']);
      }
    }

    return array(array(), $parameters);
  }
}
