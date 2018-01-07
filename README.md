[![Scrutinizer Code Quality](https://scrutinizer-ci.com/g/xvilo/customer-invoice-manager/badges/quality-score.png?b=master)](https://scrutinizer-ci.com/g/xvilo/customer-invoice-manager/?branch=master)
# Warning
THIS PROJECT IS **WORK IN PROGRESS**. ANY DOCUMENTATION HERE IS SUBJECT TO CHANGE AND IS CURRENTLY NOT ALWAYS WORKING. PLEASE LOOK FOR A VERSION TAG. 

# Customer invoice manager

Custom invoice manager is a small php application made from scratch. Why I made this application:

  - To keep track of my invoices.
  - To learn more about OOP PHP (and practice it).
  - Magic ✨

## Features

  - Twig templating
  - Inovice to PDF
  - Pay invoice online with stripe
  - Automatically e-mail invoices
  - Automatic payment reminders by e-mail
  - Automatic payment reminders by SMS (Twillio)
  - User management
  - Admin console

## Installation
1) From the command line:
```sh
$ git clone git@github.com:xvilo/customer-invoice-manager.git
$ composer install
```
2) Copy `settings-sample.php` to `settings.php`
3) Edit settings.php accordingly
4) Set your http root to `public/`
5) Install an instance of [https://redis.io](Redis).

## Running
You need to successfully complete the [#installation](installation steps) first. 
Then you need a running instance of [https://redis.io](Redis). 
Now load up your webbrowser.

## Development
If you want to read more information about the frontend development process. 
Please use the [DEVELOPMENT.md file](DEVELOPMENT.md)

## Future ToDo:
  - Fix all [features](#features) items!
  - Implement simple Redis queue with [https://github.com/bernardphp/bernard](Bernard). This will allow one to simple queue e-mails, text messages requiring tasks etc witouth any extra wait time for the user. 
