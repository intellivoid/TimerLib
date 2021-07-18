<?php

    require("ppm");
    ppm_import("net.intellivoid.timerlib");

    $timer = new \TimerLib\Timer();

    $timer->start();
    sleep(1);
    $timer->stop();

    $timer->start();
    sleep(1);
    $timer->stop();

    $timer->start();
    sleep(2);
    $timer->stop();

    $timer->start();
    sleep(2);
    $timer->stop();


    print("Times: " . PHP_EOL);
    foreach($timer->getTimeLogs() as $timeLog)
        print(" - " . $timeLog . PHP_EOL);
    print(PHP_EOL);


    print("Duration: " . $timer->getDuration()->getNanoseconds() . " nanoseconds" . PHP_EOL);
    print("Duration Avg: " . $timer->getAverageDuration()->getNanoseconds() . " nanoseconds" . PHP_EOL);

    print("Duration: " . $timer->getDuration()->getMicroseconds() . " microseconds" . PHP_EOL);
    print("Duration Avg: " . $timer->getAverageDuration()->getMicroseconds() . " microseconds" . PHP_EOL);

    print("Duration: " . $timer->getDuration()->getMilliseconds() . " milliseconds" . PHP_EOL);
    print("Duration Avg: " . $timer->getAverageDuration()->getMilliseconds() . " milliseconds" . PHP_EOL);

    print("Duration: " . $timer->getDuration()->getSeconds() . " seconds" . PHP_EOL);
    print("Duration Avg: " . $timer->getAverageDuration()->getSeconds() . " seconds" . PHP_EOL);

    print("Duration: " . $timer->getDuration()->getMinutes() . " minutes" . PHP_EOL);
    print("Duration Avg: " . $timer->getAverageDuration()->getMinutes() . " minutes" . PHP_EOL);

    print("Duration: " . $timer->getDuration()->getHours() . " hours" . PHP_EOL);
    print("Duration Avg: " . $timer->getAverageDuration()->getHours() . " hours" . PHP_EOL);

    print("Duration: " . $timer->getDuration() . PHP_EOL);
    print("Duration Avg: " . $timer->getAverageDuration() . PHP_EOL);