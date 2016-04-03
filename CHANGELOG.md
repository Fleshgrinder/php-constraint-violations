# Change Log
All notable changes to this project will be documented in this file.
This project adheres to [Semantic Versioning](http://semver.org/).

## [Unreleased]

## [0.1.0] - 2016-03-03
### Added
- `hasCause` method to `Violation`.
### Changed
- `Violation` constructor to accept `null` as cause; making the second argument effectively optional.
### Removed
- `UnexpectedValueException` creation in `ViolationCollector`; tried to avoid `null` usage but it makes no sense to do
   so here since the automatically created exception contains no useful information.

## [0.0.1] - 2016-03-25
### Changed
- `Iterator` to `IteratorAggregate` in `ViolationCollector` and internally to a `Generator`.
- PHP constraint from 7.0.1 to 7.0.0 (typo).
### Removed
- Unused `fleshgrinder/assertion` dependency.

## [0.0.0] - 2016-03-23
### Added
- Open Sourced

[Unreleased]: https://github.com/fleshgrinder/php-constraint-violations/compare/0.0.0...HEAD
[0.0.0]: https://github.com/Fleshgrinder/php-constraint-violations/compare/64cf101...0.0.0
