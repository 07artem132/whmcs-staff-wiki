<?php
/**
 *  Created by PhpStorm.
 *  User: Артём
 *  Date time: 14.07.19 9:06
 *
 */

namespace WHMCS\Module\Addon\StaffWiki\Exceptions;

use Exception;

/**
 * Class InvalidJSON
 * @package Api\Exceptions
 */
class InvalidJsonException extends Exception
{
    /**
     * InvalidJsonException constructor.
     * @param string $message
     */
    public function __construct( $message)
    {
        parent::__construct($message);

    }
}