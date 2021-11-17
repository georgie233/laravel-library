<?php

namespace Georgie\Utils;

class Results
{
  use \Georgie\Utils\Traits\Results;

  public static function getClass(){
      return new (\Georgie\Utils\Traits\Results);
  }
}
