# fullcalendar-BS4-PHP-MySQL-JSON
FullCalendar 3 integration with boostrap4, php, mysql / bootstrap4, php, json

## Purpose

Updates and expands on jamelbaz's FullCalendar-BS3-PHP-MySQL repository.

* Supports event scheduling using JSON / MySQL event scheduling updated
* FullCalendar updated from 2.6.1 to 3.9.0
	* Clickable calendar date numbers
	* Added the calendar list view
	* Includes business hours and now indicator 
* Bootstrap updated from BS3 to BS4
* Event title and description display on hover integration (popper.js)
* Added event description field
* Revamped delete button
* Calendar resizing for optimal screen real estate 
* Week and Day views set to display times 8:00AM to 4:30PM without scroll

## Getting Started

* Go to your MySQL via localhost, create a table called "calendar", and create the tables found in calendar.sql

* Open bdd.php and enter your database password

* Go to localhost and navigate to the project directory

* index.php enables event scheduling integration with PHP and MySQL

* index-json.php and associated files enable event scheduling integration with PHP and JSON

# Features

* Add events by clicking and dragging on the calendar

* Edit/delete events by double clicking them

* Supports event title, description, start date/time, end date/time, and color attributes

* Utilizes popper.js to show event title and description on hover

## Additional Readings & Resources

* FullCalendar documentation: https://fullcalendar.io/docs#toc

## Built With

* Bootstrap4
* PHP5
* SQL/MySQL
* JSON/jQuery/JavaScript
* HTML5
* CSS3
* FullCalendar v3.9
* FullCalendar-BS3-PHP-MySQL Framework

## Contributing

When contributing to this repository, you may fork and submit a pull request. Add a description of what you are doing and I'll review it.

## Versioning

Version 1.0.0

## Authors

* **Matthew Waldron** - (http://waldronmatthew.com)
* **FullCalendar** - (https://fullcalendar.io)
* **jamelbaz** https://github.com/jamelbaz/FullCalendar-BS3-PHP-MySQL

## License

This project is licensed under the MIT License - see the [LICENSE.md](LICENSE.md) file for details.

## Acknowledgments

* Project forked from jamelbaz's repository: https://github.com/jamelbaz/FullCalendar-BS3-PHP-MySQL
* JSON blog code used in the creation of event php forms: https://www.taniarascia.com/how-to-use-json-data-with-php-or-javascript/
