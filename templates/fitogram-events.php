<div class="kmc-fitogram-events">

    <?php foreach ($eventGroups as $eventGroup): ?>
        <div class="event-group">
            <div>
                <?php if ($showImage): ?>
                    <div class="event-group-image">
                        <img alt="" src='<?php echo $eventGroup->imageUrl; ?>' />
                    </div>
                <?php endif; ?>
                <h2>
                    <?php echo $eventGroup->name; ?>
                </h2>
            </div>

            <div class="event-group-details">
                <div class="content">
                    <?php echo $eventGroup->content; ?>
                </div>
                <div class="events">
                    <?php foreach ($eventGroup->events as $event): ?>
                        <?php
                        $dateFormatter = new IntlDateFormatter(
                            'de_DE',
                            IntlDateFormatter::FULL,
                            IntlDateFormatter::FULL,
                            $event->timeZoneId
                        );
                        $dateFormatter->setPattern("EEEE, d. MMMM y");

                        $timeFormatter = new IntlDateFormatter(
                            'de_DE',
                            IntlDateFormatter::FULL,
                            IntlDateFormatter::FULL,
                            $event->timeZoneId
                        );
                        $timeFormatter->setPattern("HH:mm");
                        ?>
                        <div class="event">
                            <span>
                                <?php echo $dateFormatter->format(strtotime($event->start)); ?>
                            </span>
                            <span class="time">
                                <?php echo $timeFormatter->format(strtotime($event->start)); ?> -
                                <?php echo $timeFormatter->format(strtotime($event->end)); ?>
                            </span>
                            <span class="registration-link">
                                <span>
                                    <a target="_blank" title="Anmeldung zum Kurs" rel="noopener"
                                        href="<?php echo $event->registrationLink; ?>">
                                        <span>Anmeldung</span>
                                    </a>
                                </span>
                            </span>
                        </div>
                    <?php endforeach; ?>
                </div>

            </div>
        </div>
    <?php endforeach; ?>
</div>