# phpBB Extension - marttiphpbb calendar Mono Input

[Topic on phpbb.com](https://www.phpbb.com/community/viewtopic.php?f=456&t=2487181)

## Description

This phpBB extension provides single calendar event per topic input for the [Calendar Extension Set](https://github.com/marttiphpbb/phpbb-ext-calendarmono/blob/master/doc/calendar-set.md)

## Requirements

* phpBB 3.3+
* PHP 7.1+
* The phpBB extension [JQuery UI Datepicker (helper ext)](https://github.com/marttiphpbb/phpbb-ext-jqueryuidatepicker)
* phpBB extension [Calendar Mono](https://github.com/marttiphpbb/phpbb-ext-calendarmono) for storing the Calendar Events.
* PHP compiled with --enable-calendar

When it's not possible for you to have PHP compiled with --enable-calendar see the [PHP Ext Calendar extension](https://github.com/marttiphpbb/phpbb-ext-phpextcalendar) for a possible solution.

## Screenshots

### Posting

![Posting](doc/posting.png)

### ACP: Range

![ACP Range](doc/acp_range.png)

### ACP: Forums

![ACP Forums](doc/acp_forums.png)

### ACP: Placement

![ACP Placement](doc/acp_placement.png)

### ACP: Date Format

![ACP Date Format](doc/acp_date_format.png)

### ACP: Placeholder

![ACP Placeholder](doc/acp_placeholder.png)

## Quick Install

You can install this on the latest release of phpBB by following the steps below:

* Create `marttiphpbb/calendarmonoinput` in the `ext` directory.
* Download and unpack the repository into `ext/marttiphpbb/calendarmonoinput`
* Enable `Calendar Mono Input` in the ACP at `Customise -> Manage extensions`.

## Uninstall

* Disable `Calendar Mono Input` in the ACP at `Customise -> Extension Management -> Extensions`.
* To permanently uninstall, click `Delete Data`. Optionally delete the `/ext/marttiphpbb/calendarmonoinput` directory.

## Support

* Report bugs and other issues to the [Issue Tracker](https://github.com/marttiphpbb/phpbb-ext-calendarmonoinput/issues).

## License

[GPL-2.0](license.txt)
