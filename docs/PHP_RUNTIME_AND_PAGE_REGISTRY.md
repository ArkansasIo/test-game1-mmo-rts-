# Universe Civilization: Empire at Wars PHP Runtime and Page Design Registry

## Local PHP runtime setup

The sandbox can run the modular preview with PHP 8.3 and the MySQL PDO extension. The following commands install the runtime and common extensions:

```bash
sudo apt-get update
sudo DEBIAN_FRONTEND=noninteractive apt-get install -y \
  php-cli php-mysql php-mbstring php-xml php-curl
```

Verify the installation:

```bash
php -v
php -m | grep -E 'PDO|pdo_mysql|mbstring|xml|curl'
```

From the project root, lint the game interface and registry files:

```bash
cd /home/ubuntu/stargatewars
php -l game.php
php -l config/page_designs.php
```

Start PHP’s built-in development server:

```bash
cd /home/ubuntu/stargatewars
php -S 127.0.0.1:8093
```

Open `http://127.0.0.1:8093/game.php`. The game interface is intentionally self-contained and does not require the MySQL connection. To run the authenticated game pages, configure the PDO credentials in the project configuration, import the SQL files, and browse to `http://127.0.0.1:8093/index.php?page=dashboard`.

For a persistent sandbox process, use a process supervisor or terminal session. A simple development-only command is:

```bash
nohup php -S 127.0.0.1:8093 > /tmp/stargatewars-php.log 2>&1 &
echo $!
```

The Python static server previously used on port 8092 cannot execute PHP; it serves `.php` files as downloads. PHP’s built-in server is therefore the correct local preview runtime.

## Registry loading flow

`game.php` loads `config/page_registry.php`, optionally merges `config/ogame_page_registry.php`, serializes the registry with safe JSON hex encoding, and injects the result into the browser-side navigation. The authenticated `index.php` controller loads `config/page_designs.php` for routes that use the reusable module workspace fallback.

## Economy module family

The economy-related page designs use the following layout families in `config/page_designs.php`:

```php
'economy' => [
    'template' => 'resource-management',
    'sections' => [
        'balance cards',
        'production rates',
        'vault transfer',
        'DefCon selector',
    ],
    'states' => [
        'ready',
        'insufficient-funds',
        'cooldown',
    ],
    'primary_action' => 'deposit',
],

'breakdown' => [
    'template' => 'formula-breakdown',
    'sections' => [
        'income formula',
        'modifier table',
        'forecast',
        'event history',
    ],
    'states' => [
        'ready',
        'no-data',
    ],
    'primary_action' => null,
],

'upgrade' => [
    'template' => 'upgrade-card',
    'sections' => [
        'current level',
        'next cost',
        'modifier preview',
        'confirmation',
    ],
    'states' => [
        'ready',
        'insufficient-funds',
        'max-level',
    ],
    'primary_action' => 'upgrade_up',
],
```

These designs cover resources, income, production upgrades, balances, and economic failure states. The corresponding registry pages include `resources`, `income`, and `unit-production`.

## Combat module family

The combat-related page designs use target selection, covert mission, and report layouts:

```php
'targets' => [
    'template' => 'target-table',
    'sections' => [
        'filters',
        'target rows',
        'action buttons',
        'protection badges',
    ],
    'states' => [
        'loading',
        'ready',
        'protected',
        'empty',
    ],
    'primary_action' => 'combat',
],

'covert' => [
    'template' => 'mission-form',
    'sections' => [
        'mission type',
        'agent quantity',
        'detection warning',
        'result report',
    ],
    'states' => [
        'ready',
        'validation-error',
        'detected',
        'success',
    ],
    'primary_action' => 'covert',
],

'reports' => [
    'template' => 'report-list',
    'sections' => [
        'unread count',
        'report table',
        'detail drawer',
        'mark-read control',
    ],
    'states' => [
        'loading',
        'ready',
        'empty',
    ],
    'primary_action' => 'message_read',
],
```

The registry maps these designs to `targets`, `spy`, `sabotage`, `attack-log`, `spy-log`, and `enemy-intelligence`. The server-side controller remains authoritative: target ownership, protection, available turns, CSRF tokens, cooldowns, and transactions are validated before combat or covert actions are committed.
