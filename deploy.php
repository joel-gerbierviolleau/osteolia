<?php
namespace Deployer;

use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Dotenv\Dotenv;

require_once __DIR__.'/vendor/autoload.php';

require 'recipe/symfony.php';

$dotenv = new Dotenv();
$dotenv->loadEnv(__DIR__.'/.env');

// Project name
set('application', 'osteolia');

// Project repository
set('repository', $_ENV['DEPLOYER_REPO_URL']);

// Hosts
host($_ENV['DEPLOYER_HOST'])
    ->hostname($_ENV['DEPLOYER_HOSTNAME'])
    ->set('deploy_path', $_ENV['DEPLOYER_PATH'])
    ->port($_ENV['DEPLOYER_HOST_PORT']);

set('keep_releases', 4);

set('bin_dir', 'bin');

set('clear_paths', ['var/cache']);


// [Optional] Allocate tty for git clone. Default value is false.
set('git_tty', true); 

// Shared files/dirs between deploys 
add('shared_files', []);
add('shared_dirs', []);

// Writable dirs by web server 
add('writable_dirs', []);
    
// Tasks

task('build', function () {
    run('cd {{release_path}} && build');
});

// vous pouvez surcharger la recette de base en réécrivant la fonction
task('deploy:vendors', function () {
    if (!commandExist('unzip')) {
        writeln('To speed up composer installation setup "unzip" command with PHP zip extension https://goo.gl/sxzFcD');
    }
    run('cd {{release_path}} && {{bin/composer}} install --verbose --prefer-dist --no-progress --no-interaction --optimize-autoloader');

});

task('deploy:assets:install', function () {
    run('{{bin/php}} {{bin/console}} assets:install {{console_options}} --symlink');
})->desc('Install bundle assets');

task('deploy', [
    'deploy:info',
    'deploy:prepare',
    'deploy:lock',
    'deploy:release',
    'deploy:update_code',
    'deploy:clear_paths',
    'deploy:shared',
    'deploy:vendors',
    'deploy:cache:clear',
    'deploy:cache:warmup',
    'deploy:writable',
    'deploy:assets:install',
    'deploy:symlink',
    'deploy:unlock',
    'cleanup',
])->desc('Deploy your project');

// [Optional] if deploy fails automatically unlock.
after('deploy:failed', 'deploy:unlock');

// Migrate database before symlink new release.
before('deploy:symlink', 'database:migrate');

