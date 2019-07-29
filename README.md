# FullCalendar-BS4-PHP-MySQL-JSON

A drag & drop event calendar with data permanence.

![FullCalendar with data permanence](pic.png?raw=true)

## Purpose

MySQL/JSON integration with fullcalendar

* FC updated from v2.6.1 to v3.9.0
* BS3 to BS4 update
* Event title/description hover added
* Repeating events (NEW!)
    * Weekday scheduling supported!
    * Recurring events, all-day events, multi-day events supported
    * Recurrence editing restricted to delete only
    * Available for JSON 
* Event scheduling
    * JSON scheduling added
    * Description field added for MySQL/JSON

## Getting Started

MySQL

1. Copy files to localhost
2. Create a table in DB called "calendar", and create the tables found in calendar.sql
3. Open bdd.php and enter DB credentials
4. Open index.php

JSON

1. Copy files to localhost
2. Open index-json.php

# Features

* Repeating events (NEW!)
    * Weekday scheduling supported!
    * Recurring events, all-day events, multi-day events supported
    * Recurrence editing restricted to delete only
    * Available for JSON 
* Event scheduling
    * JSON scheduling added
    * Description field added for JSON/MySQL
* FC updated from v2.6.1 to v3.9.0
* BS3 to BS4 update
* Event title/description onhover added

# Usage

JSON Object Event

```
[{"id":4,
  "rid":4,
  "repeat":"no",
  "title":"Meeting",
  "description":"some text for meeting",
  "start":"2019-01-11 10:30:00",
  "end":"2019-01-11 12:30:00",
  "color":"#000"
}]
```

MySQL Event Schema

```
('id', 'title', 'description', 'color', 'start', 'end')
(5, 'Meeting', 'some text for meeting', '#000', '2019-01-11 10:30:00', '2019-01-11 12:30:00')
```

* rid = recurrence id
* repeat = repeat status

## Additional Readings & Resources

* FullCalendar documentation: https://fullcalendar.io/docs#toc
* FullCalendar repo: https://github.com/fullcalendar/fullcalendar
* FullCalendar with MySQL event scheduling: https://github.com/jamelbaz/FullCalendar-BS3-PHP-MySQL

## Built With

* FC v3.9.0
* BS4
* PHP5/7
* JSON/MySQL
* JavaScript/jQuery
* HTML/CSS

## Contributing

Submit a PR and I'll review. Look for untagged issues to help with.

## Versioning

Version 1.1.0

## Authors

* **Matthew Waldron** - (http://waldronmatthew.com)
* **FullCalendar** - (https://fullcalendar.io)
* **jamelbaz** https://github.com/jamelbaz/FullCalendar-BS3-PHP-MySQL

## License

This project is licensed under the MIT License - see the [LICENSE.md](LICENSE.md) file for details.

## Acknowledgments

* Repo built on Adam Shaw's FC: https://github.com/fullcalendar/fullcalendar
* Repo forked from jamelbaz's repository: https://github.com/jamelbaz/FullCalendar-BS3-PHP-MySQL
* Code used for JSON event scheduling: https://www.taniarascia.com/how-to-use-json-data-with-php-or-javascript/
* Code used for event scheduling recurrences: https://stackoverflow.com/questions/7061802/php-function-for-get-all-mondays-within-date-range
