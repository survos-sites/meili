# AGENTS.md

## Project Overview

This is a Symfony 8.0 PHP application serving as a backend for managing museum/collection data from CollectiveAccess systems. The codebase follows modern PHP 8.4+ practices with strict typing, Doctrine ORM, and comprehensive testing.

## Essential Commands

### Development Setup
```bash
# Install dependencies
composer install

# Clear and warmup cache
bin/console cache:clear
bin/console cache:warmup

# Database operations
bin/console doctrine:migrations:migrate
bin/console doctrine:schema:validate

# Asset management
bin/console asset-map:compile
bin/console assets:install
```

### Testing (CRITICAL)
```bash
# Run all tests
./bin/phpunit

# Run specific test file (SINGLE TEST COMMAND)
./bin/phpunit tests/YourTest.php

# Run tests with coverage
./bin/phpunit --coverage-text

# Generate new test
bin/console make:test
```

### Code Quality
```bash
# Lint container dependencies
bin/console lint:container

# Lint templates
bin/console lint:twig templates/

# Lint YAML configuration
bin/console lint:yaml config/

# Lint translations
bin/console lint:translations
```

### Custom Commands
```bash
# Fetch data from CollectiveAccess
bin/console ca:fetch

# Generate entities from profiles
bin/console code:entity

# Generate admin controllers
bin/console code:meili:admin
```

### Castor Tasks
```bash
# Build/setup task
castor build

# Data fetching
castor fetch
castor forte --limit=100
```

## Code Style Guidelines

### PHP Requirements
- **STRICT TYPES REQUIRED**: Every PHP file MUST start with `declare(strict_types=1);`
- **PHP 8.4+**: Use modern PHP features (constructor property promotion, readonly properties, enums, attributes)
- **PSR-4 Autoloading**: `App\` namespace maps to `src/`, `App\Tests\` maps to `tests/`

### Class Structure
```php
<?php

declare(strict_types=1);

namespace App\Entity;

use App\Repository\ObjRepository;
use Doctrine\ORM\Mapping\Entity;

#[Entity(repositoryClass: ObjRepository::class)]
final class Obj
{
    // Constructor property promotion with readonly
    public function __construct(
        private readonly string $requiredField
    ) {}
}
```

### Naming Conventions
- **Classes**: PascalCase (e.g., `CollectiveAccessGraphQLService`)
- **Methods**: camelCase (e.g., `searchObjects`, `flattenRecord`)
- **Properties**: camelCase (e.g., `caObjectRepresentationsMediaSmallUrl`)
- **Constants**: UPPER_SNAKE_CASE (e.g., `DEFAULT_BUNDLES`, `FILTERABLE_FIELDS`)
- **Files**: PascalCase.php for classes, kebab-case for commands

### Import Organization
```php
// Order: built-in, third-party, application imports
use App\Entity\Obj;
use App\Repository\ObjRepository;
use Doctrine\ORM\Mapping\Entity;
use Symfony\Component\Console\Attribute\AsCommand;
```

### Entity Patterns
- Use PHP 8 attributes for Doctrine mapping (`#[Entity]`, `#[Column]`, etc.)
- Final classes with readonly constructor properties
- Include Meilisearch integration with `#[MeiliIndex]` attributes
- Define constants for searchable/filterable fields
- Comprehensive PHPDoc with generation metadata

### Service Patterns
- Final classes with readonly constructor injection
- Private helper methods with descriptive names
- Environment variable resolution with fallbacks
- Proper error handling with typed exceptions

### Command Patterns
- Use `#[AsCommand]` attributes
- Constructor property promotion for dependencies
- Return `Command::SUCCESS` or `Command::FAILURE`
- Use `SymfonyStyle` for CLI output
- Structured argument/option handling with attributes

## Testing Requirements

### PHPUnit Configuration
- Configuration: `phpunit.dist.xml`
- Tests directory: `tests/`
- Strict error reporting enabled (`failOnDeprecation="true"`)
- Bootstrap file: `tests/bootstrap.php`
- Environment: `APP_ENV=test`

### Test Guidelines
- Place tests in `tests/` directory following PSR-4
- Use strict typing in test files
- Write comprehensive tests for business logic
- Test error conditions and edge cases

## Frontend & Asset Management

### JavaScript/TypeScript
- **AssetMapper** for modern asset handling
- **Importmap** for dependency management
- **Stimulus** for JavaScript controllers
- **Bootstrap 5** for CSS framework
- **Meilisearch** instant search integration

### Asset Structure
```
assets/
├── app.js              # Main entrypoint
├── admin.js            # Admin-specific JS
├── controllers/        # Stimulus controllers
├── styles/             # CSS files
└── icons/              # Icon assets
```

## Database & Environment

### Database
- PostgreSQL as default database
- Doctrine migrations for schema management
- Entity-first development approach
- Always validate schema after changes

### Environment Variables
- `.env` for development defaults
- `.env.local` for local overrides (DO NOT COMMIT)
- Standard Symfony env pattern (APP_ENV, DATABASE_URL, etc.)

### Search Integration
- Meilisearch for full-text search functionality
- Configurable indices with filterable/sortable fields
- Integration with admin interfaces

## Development Workflow

### When Adding New Features
1. Use strict types and modern PHP 8+ features
2. Follow PSR-4 autoloading conventions
3. Use readonly constructor properties for services
4. Implement proper error handling with typed exceptions
5. Add comprehensive PHPDoc for entities
6. Use attributes for Symfony/Doctrine configuration
7. Include proper unit tests
8. Run linting and tests before committing

### When Working with Data
1. Use JSONL format for data imports/exports
2. Implement proper data validation
3. Use Meilisearch for search functionality
4. Follow established entity patterns
5. Use proper type declarations for all data structures

### Error Handling
- Use typed exceptions for error handling
- Implement proper logging with Monolog
- Validate input data in services and controllers
- Handle database errors gracefully
- Provide meaningful error messages

## Key Dependencies
- **Symfony 8.0**: Main framework
- **Doctrine ORM**: Database layer
- **Meilisearch**: Search functionality
- **EasyAdmin**: Admin interfaces
- **PHPUnit**: Testing framework
- **AssetMapper**: Modern asset management

## Project Structure
```
src/
├── Command/           # Console commands
├── Controller/        # Web controllers
├── Entity/           # Doctrine entities
├── Repository/       # Doctrine repositories
├── Service/          # Business logic services
└── Twig/             # Twig extensions

templates/             # Twig templates
tests/                 # PHPUnit tests
config/                # Symfony configuration
assets/                # Frontend assets
```

Always maintain backward compatibility and follow semantic versioning when making changes.