## Configuration START

$host_name = "demo.fsi-open.dev"
$db_name = "demo" # production env db name, should not be longer than 12 characters
$db_name_dev = "${db_name}-dev" # dev env db name, should not be longer than 12 characters
$db_name_tst = "${db_name}-tst" # tst env db name, should not be longer than 12 characters

## Configuration END

group { 'puppet': ensure => present }
Exec { path => [ '/bin/', '/sbin/', '/usr/bin/', '/usr/sbin/' ] }
File { owner => 0, group => 0, mode => 0644 }

file { "/var/lock/apache2":
  ensure => directory,
  owner => vagrant
}

file { "/dev/shm/fsi_demo":
  ensure => directory,
  purge => true,
  force => true,
  owner => vagrant,
  group => vagrant
}

exec { "ApacheUserChange" :
  command => "sed -i 's/export APACHE_RUN_USER=.*/export APACHE_RUN_USER=vagrant/ ; s/export APACHE_RUN_GROUP=.*/export APACHE_RUN_GROUP=vagrant/' /etc/apache2/envvars",
  require => [ Package["apache"], File["/var/lock/apache2"] ],
  notify  => Service['apache'],
}

class {'apt':
  always_apt_update => true,
}

Class['::apt::update'] -> Package <|
    title != 'python-software-properties'
and title != 'software-properties-common'
|>

    apt::key { '4F4EA0AAE5267A6C': }

apt::ppa { 'ppa:ondrej/php5-oldstable':
  require => Apt::Key['4F4EA0AAE5267A6C']
}

package { [
    'build-essential',
    'vim',
    'curl',
    'git-core',
    'mc'
  ]:
  ensure  => 'installed',
}

class { 'apache': }

apache::dotconf { 'custom':
  content => 'EnableSendfile Off',
}

apache::module { 'rewrite': }

apache::vhost { "${host_name}":
  server_name   => "${host_name}",
  serveraliases => [
    "www.${host_name}"
  ],
  docroot       => "/var/www/fsi_demo/web/",
  port          => '80',
  env_variables => [
    'VAGRANT VAGRANT'
  ],
  priority      => '1',
}

class { 'php':
  service             => 'apache',
  service_autorestart => false,
  module_prefix       => '',
}

php::module { 'php5-mysql': }
php::module { 'php5-sqlite': }
php::module { 'php5-cli': }
php::module { 'php5-curl': }
php::module { 'php5-intl': }
php::module { 'php5-mcrypt': }
php::module { 'php5-gd': }
php::module { 'php-apc': }

class { 'php::devel':
  require => Class['php'],
}

class { 'php::pear':
  require => Class['php'],
}

php::pear::module { 'PHPUnit':
  repository  => 'pear.phpunit.de',
  use_package => 'no',
  require => Class['php::pear']
}

php::ini { 'php_ini_configuration':
  value   => [
    'date.timezone = "Europe/Warsaw"',
    'display_errors = On',
    'error_reporting = -1',
    'short_open_tag = 0'
  ],
  notify  => Service['apache'],
  require => Class['php']
}

class { 'mysql::server':
  override_options => { 'root_password' => '', }
}

mysql::db { "${db_name}":
  grant    => [
    'ALL'
  ],
  user     => "${db_name}",
  password => "${db_name}",
  host     => 'localhost',
  charset  => 'utf8',
  require  => Class['mysql::server'],
}

mysql::db { "${db_name_tst}":
  grant    => [
    'ALL'
  ],
  user     => "${db_name_tst}",
  password => "${db_name_tst}",
  host     => 'localhost',
  charset  => 'utf8',
  require  => Class['mysql::server'],
}

mysql::db { "${db_name_dev}":
  grant    => [
    'ALL'
  ],
  user     => "${db_name_dev}",
  password => "${db_name_dev}",
  host     => 'localhost',
  charset  => 'utf8',
  require  => Class['mysql::server'],
}
