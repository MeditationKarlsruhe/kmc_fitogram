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
                <div class="left">
                    <div>
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
                                <span>
                                    <?php echo $timeFormatter->format(strtotime($event->start)); ?> -
                                    <?php echo $timeFormatter->format(strtotime($event->end)); ?>
                                </span>
                                <span class="mb-center maxbutton-4-center registration-link">
                                    <span class="maxbutton-4-container mb-container">
                                        <a class="maxbutton-4 maxbutton maxbutton-anmeldung" target="_blank"
                                            title="Anmeldung zum Kurs" rel="noopener"
                                            href="<?php echo $event->registrationLink; ?>">
                                            <span class="mb-text">Anmeldung</span>
                                        </a>
                                    </span>
                                </span>
                            </div>
                        <?php endforeach; ?>
                    </div>
                </div>

                <div class="right">
                    <div class="products">
                        <?php foreach ($eventGroup->events[0]->products as $product): ?>
                            <div class="product">
                                <strong>
                                    <?php echo $product->name ?>
                                </strong>
                                <br />
                                <?php
                                echo number_format($product->amount, 2)
                                    . " " . $product->currencySymbol
                                    . " / " . $product->displaySalesPriceRhythm; ?>
                            </div>
                        <?php endforeach; ?>
                        <div class="product">
                            <a href="/treuekarten/">Zu den Details</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    <?php endforeach; ?>
</div>