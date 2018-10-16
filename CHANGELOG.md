# Change Log
All notable changes to this project will be documented in this file.
This project adheres to [Semantic Versioning](http://semver.org/).

Handling empty arguments array gracefully. Updated unit tests, adding new test for empty arguments.

## [1.0.4] - 2018-10-17
#### Fixed
* Fixed <name> capturing group so it handles hyphens (Fixes #1)

## [1.0.3] - 2015-06-05
#### Changed
* Handling empty arguments array gracefully.
* Updated unit tests, adding new test for empty arguments.

## [1.0.2] - 2015-06-02
#### Changed
* Method `__get()` now throws E_USER_DEPRECATED. Instead, use `name()` and `value()` getter methods. Added some additional tests now that `Argument::__get()` is deprecated.
* Updated `find()` method to allow passing either string or an array of arguments. Will return the first one it finds, or false.

## [1.0.1] - 2015-03-28
#### Changed
- Using a single Regular Expression to find all arguments (thanks to http://stackoverflow.com/a/13141314)
- New command syntax supported
- 100% phpUnit test code coverage

## 1.0.0 - 2015-03-27
#### Added
- Initial release

[1.0.4]: https://github.com/pointybeard/cron/compare/1.0.3...1.0.4
[1.0.3]: https://github.com/pointybeard/cron/compare/1.0.2...1.0.3
[1.0.2]: https://github.com/pointybeard/cron/compare/1.0.1...1.0.2
[1.0.1]: https://github.com/pointybeard/cron/compare/1.0.0...1.0.1
