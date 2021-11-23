# Laravel サンプル

## コマンド

- バージョン確認

```
$ ./vendor/bin/sail artisan -V
Laravel Framework 8.73.1
```

- 起動

```
$ ./vendor/bin/sail up
```

- デーモンとして起動

```
$ ./vendor/bin/sail up -d
```

- デーモンの停止

```
# ./vendor/bin/sail down
```

- コンテナへの接続

```
$ ./vendor/bin/sail shell
sail@5764fdbfcf4e:/var/www/html$
```

- 実行状況確認

```
$ ./vendor/bin/sail ps
        Name                       Command                  State                                             Ports
----------------------------------------------------------------------------------------------------------------------------------------------------------
sample_laravel.test_1   start-container                  Up             0.0.0.0:80->80/tcp,:::80->80/tcp, 8000/tcp
sample_mailhog_1        MailHog                          Up             0.0.0.0:1025->1025/tcp,:::1025->1025/tcp, 0.0.0.0:8025->8025/tcp,:::8025->8025/tcp
sample_meilisearch_1    tini -- /bin/sh -c ./meili ...   Up (healthy)   0.0.0.0:7700->7700/tcp,:::7700->7700/tcp
sample_mysql_1          /entrypoint.sh mysqld            Up (healthy)   0.0.0.0:3306->3306/tcp,:::3306->3306/tcp, 33060/tcp, 33061/tcp
sample_redis_1          docker-entrypoint.sh redis ...   Up (healthy)   0.0.0.0:6379->6379/tcp,:::6379->6379/tcp
sample_selenium_1       /opt/bin/entry_point.sh          Up             4444/tcp, 5900/tcp
```

- 対話的に検証

```
 ./vendor/bin/sail artisan tinker
Psy Shell v0.10.9 (PHP 8.0.13 — cli) by Justin Hileman
>>> exit
Exit:  Goodbye
```
### DB

- MySQLへ接続

```
$ ./vendor/bin/sail mysql
Welcome to the MySQL monitor.  Commands end with ; or \g.
Your MySQL connection id is 10
Server version: 8.0.27 MySQL Community Server - GPL

Copyright (c) 2000, 2021, Oracle and/or its affiliates.

Oracle is a registered trademark of Oracle Corporation and/or its
affiliates. Other names may be trademarks of their respective
owners.

Type 'help;' or '\h' for help. Type '\c' to clear the current input statement.

mysql>
```

- rootでログイン

```
$ docker exec -it sample_mysql_1 mysql -u root -p'password'
```

- tableのmigrationファイルを作成

```
$ ./vendor/bin/sail artisan make:migration create_customers_table
Created Migration: 2021_11_23_090010_create_customers_table
```

- migration

```
$ ./vendor/bin/sail artisan migrate
Migrating: 2021_11_23_090010_create_customers_table
Migrated:  2021_11_23_090010_create_customers_table (43.00ms)
```

- Factoryの作成

```
$ ./vendor/bin/sail artisan make:factory EloquentCustomerFactory
Factory created successfully.
```

### テストの作成

- Unitテスト

```
$ ./vendor/bin/sail artisan make:test CalculatePointServiceTest --unit
```

- Featureテスト

```
$ ./vendor/bin/sail artisan make:test HomeTest
```

### テストの実行

- 全体テスト

```
$ ./vendor/bin/sail test
```

- テストを指定

```
$ ./vendor/bin/sail test tests/Feature/HomeTest.php
```

## 参考

- https://zenn.dev/rabit334/articles/9eb078c128fb72
