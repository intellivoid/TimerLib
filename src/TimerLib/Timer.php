<?php

    /** @noinspection PhpPropertyOnlyWrittenInspection */
    /** @noinspection PhpMissingFieldTypeInspection */

    namespace TimerLib;

    use InvalidArgumentException;
    use TimerLib\Exceptions\CannotStartTimerException;
    use TimerLib\Exceptions\NoActiveTimerException;
    use TimerLib\Exceptions\DurationNotAvailableException;
    use TimerLib\Objects\Duration;
    use function hrtime;

    /**
     * Class Timer
     * @package TimerLib
     */
    class Timer
    {
        /**
         * @psalm-var list<float>
         * @var float[]
         */
        private array $timeLogs = [];

        /**
         * @var float
         */
        private float $startTime;

        /**
         * @var Duration|null
         */
        private $duration;

        /**
         * @var bool
         */
        private $is_running = false;

        /**
         * @var int
         */
        private $max_time_logs = 0;

        /**
         * Starts the timer
         */
        public function start(): void
        {
            if($this->is_running)
                throw new CannotStartTimerException("Cannot start a timer that's already running");

            $this->is_running = true;
            $this->duration = null;
            $this->startTime = (float) hrtime(true);
        }

        /**
         * Stops the timer and returns a Duration object
         *
         * @return Duration
         */
        public function stop(): Duration
        {
            if($this->is_running == false)
                throw new NoActiveTimerException("You cannot stop a timer that isn't running");

            $this->is_running = false;
            $end_time = (float) hrtime(true) - $this->startTime;
            $this->duration = Duration::fromNanoseconds($end_time);
            $this->timeLogs[] = $end_time;

            if($this->max_time_logs > 0 && count($this->timeLogs) > $this->max_time_logs)
            {
                while(count($this->timeLogs) > $this->max_time_logs)
                {
                    array_shift($this->timeLogs);
                }
            }

            return $this->duration;
        }

        /**
         * Stops and disregards the timer
         */
        public function cancel()
        {
            if($this->is_running == false)
                throw new NoActiveTimerException("You cannot stop a timer that isn't running");

            $this->is_running = false;
            $this->duration = null;
            $this->startTime = 0;
        }

        /**
         * Returns the duration of the timer (can only be called once the timer has been stopped after it was running)
         *
         * @return Duration
         */
        public function getDuration(): Duration
        {
            if($this->duration == null && $this->is_running)
                throw new DurationNotAvailableException("The duration results is not available while the timer is running");

            if($this->duration == null)
                throw new DurationNotAvailableException("The duration results is not available");

            return $this->duration;
        }

        /**
         * Gets the average duration based off the previous times
         *
         * @return Duration
         */
        public function getAverageDuration(): Duration
        {
            if(count($this->timeLogs) == 0)
                throw new DurationNotAvailableException("There are no start times to calculate an average from");

            if(count($this->timeLogs) == 1)
                throw new DurationNotAvailableException("There are not enough start times to calculate an average from");

            return Duration::fromNanoseconds(array_sum($this->timeLogs)/count($this->timeLogs));
        }

        /**
         * Indicates if the timer is currently running
         *
         * @return bool
         * @noinspection PhpUnused
         */
        public function isRunning(): bool
        {
            return $this->is_running;
        }

        /**
         * Returns an array of times with this timer
         *
         * @return array|float[]
         */
        public function getTimeLogs(): array
        {
            return $this->timeLogs;
        }

        /**
         * Clears the Timelog history
         * @noinspection PhpUnused
         */
        public function clearTimeLogs()
        {
            $this->timeLogs = [];
        }

        /**
         * Gets the current amount of logs
         *
         * @return int
         * @noinspection PhpUnused
         */
        public function getMaxTimeLogs(): int
        {
            return $this->max_time_logs;
        }

        /**
         * Sets the maximum amount of time logs to store in memory, older times will be removed from memory
         * Set the value to "0" for unlimited logs
         *
         * @param int $max_time_logs
         * @noinspection PhpUnused
         */
        public function setMaxTimeLogs(int $max_time_logs): void
        {
            if($max_time_logs < 0)
                throw new InvalidArgumentException("The parameter 'max_time_logs' cannot have a value less than 0");

            $this->max_time_logs = $max_time_logs;
        }
    }