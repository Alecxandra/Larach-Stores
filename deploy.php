<?php
namespace Deployer;
require 'recipe/common.php';
set('ssh_type','native');
// Configuration
set('repository', 'https://github.com/Alecxandra/Larach-Stores.git');
set('shared_files', ['mysite/_config/local.yml']);
set('shared_dirs', ['assets']);
set('writable_dirs', []);
// Servers
/*server('production', '190.4.25.77')
	->user('root')
	->identityFile()
	->set('deploy_path', '/var/www/bantrab.hn');*/
server('development', '144.76.29.122')
	->user('root')
	->identityFile()
	->set('deploy_path', '/var/www/larachstores.premperhn.com');
// Tasks
desc('Restart PHP-FPM service');
task('php-fpm:restart', function () {
	// The user must have rights for restart service
	// /etc/sudoers: username ALL=NOPASSWD:/bin/systemctl restart php-fpm.service
	run('sudo systemctl restart php-fpm.service');
});
#after('deploy:symlink', 'php-fpm:restart');
desc('Deploy your project');
task('deploy', [
	'deploy:prepare',
	'deploy:lock',
	'deploy:release',
	'deploy:update_code',
	'deploy:shared',
	'deploy:writable',
	'deploy:vendors',
	'deploy:clear_paths',
	'deploy:symlink',
	'deploy:unlock',
	'cleanup',
	'success'
]);
after('deploy', 'success');
