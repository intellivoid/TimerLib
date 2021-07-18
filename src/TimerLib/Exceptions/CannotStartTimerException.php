<?php

    /** @noinspection PhpPropertyOnlyWrittenInspection */
    /** @noinspection PhpMultipleClassDeclarationsInspection */
    /** @noinspection PhpIllegalPsrClassPathInspection */
    /** @noinspection PhpUnused */

    namespace TimerLib\Exceptions;

    use LogicException;
    use Throwable;
    use TimerLib\Interfaces\Exception;

    /**
     * Class CannotStartTimerException
     * @package TimerLib\Exceptions
     */
    class CannotStartTimerException extends LogicException implements Exception
    {
        /**
         * @var Throwable|null
         */
        private ?Throwable $previous;

        /**
         * NoActiveTimerException constructor.
         * @param string $message
         * @param int $code
         * @param Throwable|null $previous
         */
        public function __construct($message = "", $code = 0, Throwable $previous = null)
        {
            parent::__construct($message, $code, $previous);
            $this->message = $message;
            $this->code = $code;
            $this->previous = $previous;
        }
    }
