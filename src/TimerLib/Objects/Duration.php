<?php


    namespace TimerLib\Objects;

    /**
     * Class Duration
     * @package TimerLib\Objects
     */
    class Duration
    {
        /**
         * The duration in nanoseconds
         *
         * @var float
         */
        private float $nanoseconds;

        /**
         * The duration in hours
         *
         * @var int
         */
        private int $hours;

        /**
         * The duration in minutes
         *
         * @var int
         */
        private int $minutes;

        /**
         * The duration in seconds
         *
         * @var int
         */
        private int $seconds;

        /**
         * The duration in milliseconds
         *
         * @var int
         */
        private int $milliseconds;

        /**
         * Constructs the duration from Microseconds
         *
         * @param float $microseconds
         * @return static
         */
        public static function fromMicroseconds(float $microseconds): self
        {
            return new self($microseconds * 1000);
        }

        /**
         * Constructs the duration from Nanoseconds
         *
         * @param float $nanoseconds
         * @return static
         */
        public static function fromNanoseconds(float $nanoseconds): self
        {
            return new self($nanoseconds);
        }

        /**
         * Duration constructor.
         *
         * @param float $nanoseconds
         */
        private function __construct(float $nanoseconds)
        {
            $this->nanoseconds = $nanoseconds;
            $timeInMilliseconds = $nanoseconds / 1000000;
            $hours = floor($timeInMilliseconds / 60 / 60 / 1000);
            $hoursInMilliseconds = $hours * 60 * 60 * 1000;
            $minutes = floor($timeInMilliseconds / 60 / 1000) % 60;
            $minutesInMilliseconds = $minutes * 60 * 1000;
            $seconds = floor(($timeInMilliseconds - $hoursInMilliseconds - $minutesInMilliseconds) / 1000);
            $secondsInMilliseconds = $seconds * 1000;
            $milliseconds = $timeInMilliseconds - $hoursInMilliseconds - $minutesInMilliseconds - $secondsInMilliseconds;
            $this->hours = (int) $hours;
            $this->minutes = $minutes;
            $this->seconds = (int) $seconds;
            $this->milliseconds = (int) $milliseconds;
        }

        /**
         * Gets the duration represented in Nanoseconds
         *
         * @return float
         */
        public function getNanoseconds(): float
        {
            return $this->nanoseconds;
        }

        /**
         * Gets the duration represented in Hours
         *
         * @return int
         */
        public function getHours(): int
        {
            return $this->hours;
        }

        /**
         * Gets the duration represented in Minutes
         *
         * @return int
         */
        public function getMinutes(): int
        {
            return $this->minutes;
        }

        /**
         * Gets the duration represented in Seconds
         *
         * @return int
         */
        public function getSeconds(): int
        {
            return $this->nanoseconds / 1000000000;
        }

        /**
         * Gets the duration represented in Milliseconds
         *
         * @return int
         */
        public function getMilliseconds(): int
        {
            return $this->nanoseconds / 1000000;
        }

        /**
         * Gets the duration represented in Microseconds
         *
         * @return float
         */
        public function getMicroseconds(): float
        {
            return $this->nanoseconds / 1000;
        }

        /**
         * Returns a string representation of the duration
         *
         * @return string
         */
        public function __toString()
        {
            $result = '';

            if ($this->hours > 0) {
                $result = sprintf('%02d', $this->hours) . ':';
            }

            $result .= sprintf('%02d', $this->minutes) . ':';
            $result .= sprintf('%02d', $this->seconds);

            if ($this->milliseconds > 0) {
                $result .= '.' . sprintf('%03d', $this->milliseconds);
            }

            return $result;
        }
    }