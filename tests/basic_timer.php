<?php

    require("ppm");
    ppm_import("net.intellivoid.timerlib");

    $timer = new \TimerLib\Timer();
    $timer->start();

    sleep(5);

    $timer->stop();

    print("Duration: " . $timer->getDuration()->getNanoseconds() . " nanoseconds" . PHP_EOL);
    print("Duration: " . $timer->getDuration()->getMicroseconds() . " microseconds" . PHP_EOL);
    print("Duration: " . $timer->getDuration()->getMilliseconds() . " milliseconds" . PHP_EOL);
    print("Duration: " . $timer->getDuration()->getSeconds() . " seconds" . PHP_EOL);
    print("Duration: " . $timer->getDuration()->getMinutes() . " minutes" . PHP_EOL);
    print("Duration: " . $timer->getDuration()->getHours() . " hours" . PHP_EOL);
    print("Duration: " . $timer->getDuration() . PHP_EOL);