
# books-liblary-with-mysql-and-redis-cluster

## Arsitektur

![Arsitektur](https://github.com/abdurrohman100/books-liblary-with-mysql-and-redis-cluster/blob/main/assets/Arsi.png)



## Konfiguras
### Redis

- Pada /etc/redis/redis.conf
Coomment
```
#bind 127.0.0.1 ::1
```

Ubah protected-mode menjadi no dan
```
protected-mode no
```

Tambahkan slave of pada Redis 1 dan Redis 2 menuju Redis Master 
```
slaveof 10.0.0.94 6379
```

- Buat file /etc/redis/sentinel.conf dan tambahkan konfigurasi berikut dimana 10.0.0.94 adalah IP Redis Master

```
sentinel myid 9862e14b6d9fb11c035c4a28d48573455a7876a2
sentinel monitor redis-primary 10.0.0.94 6379 2
sentinel down-after-milliseconds redis-primary 2000
sentinel failover-timeout redis-primary 5000
protected-mode no

# Run in production with systemd
logfile "/var/log/redis/sentinel.log"
pidfile "/var/run/redis/sentinel.pid"
daemonize yes
```

- Konfigurasi untuk Servis Sentinel
```
[Unit]
Description=Sentinel for Redis
After=network.target

[Service]
Type=forking
User=redis
Group=redis
PIDFile=/var/run/redis/sentinel.pid
ExecStart=/usr/bin/redis-server /etc/redis/sentinel.conf --sentinel
ExecStop=/bin/kill -s TERM $MAINPID
Restart=always

[Install]
WantedBy=multi-user.target
```

### HaProxy

Konfigurasi /etc/haproxy/haproxy.cfg

```
global
	daemon
	maxconn 256


defaults
	mode tcp
	timeout connect 5000ms
	timeout client 50000ms
	timeout server 50000ms


frontend http
	bind :8080
	default_backend stats


backend stats
	mode http
	stats enable

	stats enable
	stats uri /
	stats refresh 10s
	stats show-legends
	stats admin if TRUE


frontend redis-read
    bind *:6379
    default_backend redis-online


frontend redis-write
	bind *:6380
	default_backend redis-primary


backend redis-primary
	mode tcp
	balance first
	option tcp-check

	tcp-check send info\ replication\r\n
	tcp-check expect string role:master

	server redis-01:10.0.0.94:6379 10.0.0.94:6379 maxconn 1024 check inter 10s
	server redis-02:10.0.0.237:6379 10.0.0.237:6379 maxconn 1024 check inter 10s
	server redis-03:10.0.0.216:6379 10.0.0.216:6379 maxconn 1024 check inter 10s


backend redis-online
	mode tcp
	balance roundrobin
	option tcp-check

	tcp-check send PING\r\n
	tcp-check expect string +PONG

	server redis-01:10.0.0.94:6379 10.0.0.94:6379 maxconn 1024 check inter 10s
	server redis-02:10.0.0.237:6379 10.0.0.237:6379 maxconn 1024 check inter 10s
	server redis-03:10.0.0.216:6379 10.0.0.216:6379 maxconn 1024 check inter 10s
```




<p align="center"><a href="https://laravel.com" target="_blank"><img src="https://raw.githubusercontent.com/laravel/art/master/logo-lockup/5%20SVG/2%20CMYK/1%20Full%20Color/laravel-logolockup-cmyk-red.svg" width="400"></a></p>

<p align="center">
<a href="https://travis-ci.org/laravel/framework"><img src="https://travis-ci.org/laravel/framework.svg" alt="Build Status"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/dt/laravel/framework" alt="Total Downloads"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/v/laravel/framework" alt="Latest Stable Version"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/l/laravel/framework" alt="License"></a>
</p>

## About Laravel

Laravel is a web application framework with expressive, elegant syntax. We believe development must be an enjoyable and creative experience to be truly fulfilling. Laravel takes the pain out of development by easing common tasks used in many web projects, such as:

- [Simple, fast routing engine](https://laravel.com/docs/routing).
- [Powerful dependency injection container](https://laravel.com/docs/container).
- Multiple back-ends for [session](https://laravel.com/docs/session) and [cache](https://laravel.com/docs/cache) storage.
- Expressive, intuitive [database ORM](https://laravel.com/docs/eloquent).
- Database agnostic [schema migrations](https://laravel.com/docs/migrations).
- [Robust background job processing](https://laravel.com/docs/queues).
- [Real-time event broadcasting](https://laravel.com/docs/broadcasting).

Laravel is accessible, powerful, and provides tools required for large, robust applications.

## Learning Laravel

Laravel has the most extensive and thorough [documentation](https://laravel.com/docs) and video tutorial library of all modern web application frameworks, making it a breeze to get started with the framework.

If you don't feel like reading, [Laracasts](https://laracasts.com) can help. Laracasts contains over 1500 video tutorials on a range of topics including Laravel, modern PHP, unit testing, and JavaScript. Boost your skills by digging into our comprehensive video library.

## Laravel Sponsors

We would like to extend our thanks to the following sponsors for funding Laravel development. If you are interested in becoming a sponsor, please visit the Laravel [Patreon page](https://patreon.com/taylorotwell).

### Premium Partners

- **[Vehikl](https://vehikl.com/)**
- **[Tighten Co.](https://tighten.co)**
- **[Kirschbaum Development Group](https://kirschbaumdevelopment.com)**
- **[64 Robots](https://64robots.com)**
- **[Cubet Techno Labs](https://cubettech.com)**
- **[Cyber-Duck](https://cyber-duck.co.uk)**
- **[Many](https://www.many.co.uk)**
- **[Webdock, Fast VPS Hosting](https://www.webdock.io/en)**
- **[DevSquad](https://devsquad.com)**
- **[Curotec](https://www.curotec.com/services/technologies/laravel/)**
- **[OP.GG](https://op.gg)**
- **[CMS Max](https://www.cmsmax.com/)**
- **[WebReinvent](https://webreinvent.com/?utm_source=laravel&utm_medium=github&utm_campaign=patreon-sponsors)**
- **[Lendio](https://lendio.com)**
- **[Romega Software](https://romegasoftware.com)**

## Contributing

Thank you for considering contributing to the Laravel framework! The contribution guide can be found in the [Laravel documentation](https://laravel.com/docs/contributions).

## Code of Conduct

In order to ensure that the Laravel community is welcoming to all, please review and abide by the [Code of Conduct](https://laravel.com/docs/contributions#code-of-conduct).

## Security Vulnerabilities

If you discover a security vulnerability within Laravel, please send an e-mail to Taylor Otwell via [taylor@laravel.com](mailto:taylor@laravel.com). All security vulnerabilities will be promptly addressed.

## License

The Laravel framework is open-sourced software licensed under the [MIT license](https://opensource.org/licenses/MIT).

