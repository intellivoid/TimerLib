<?php

    /** @noinspection PhpPropertyOnlyWrittenInspection */
    /** @noinspection PhpMultipleClassDeclarationsInspection */
    /** @noinspection PhpIllegalPsrClassPathInspection */
    /** @noinspection PhpUnused */

    namespace TimerLib\Exceptions;

    use RuntimeException;
    use Throwable;
    use TimerLib\Interfaces\Exception;

    /**
     * Class DurationNotAvailableException
     * @package TimerLib\Exceptions
     */
    class DurationNotAvailableException extends RuntimeException implements Exception
    {
        /**
         * @var Throwable|null
         */
        private ?Throwable $previous;

        /**
         * DurationNotAvailableException constructor.
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
