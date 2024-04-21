# Jean Perrin Planning (JPP)

```bash
sudo /opt/lampp/manager-linux-x64.run
```

## Required Tech Stack and Config

```bash
$ php -v
PHP 8.1.2-1ubuntu2.14 (cli) (built: Aug 18 2023 11:41:11) (NTS)
Copyright (c) The PHP Group
Zend Engine v4.1.2, Copyright (c) Zend Technologies
    with Zend OPcache v8.1.2-1ubuntu2.14, Copyright (c), by Zend Technologies
```

```bash
$ sqlite3 --version
3.37.2 2022-01-06 13:25:41 872ba256cbf61d9290b571c0e6d82a20c224ca3ad82971edc46b29818d5dalt1
```

```bash
$ ls
doc  index.html  README.md  src
$ cd src/sql
/src/sql$ ls
emploi_temps.db  schema.sql  select_from_all_tables.sql
```

```bash
$ sqlite3 emploi_temps.db
SQLite version 3.37.2 2022-01-06 13:25:41
Enter ".help" for usage hints.
sqlite> .tables
departements      enseignants       promotions      
emplois_du_temps  matieres          salles 
```

```bash
# One of the interesting outputs format is tabular one (box, markdown, table) 
# ex.: To display departements content as table
sqlite> .mode table
sqlite> select * from departements;

# Other interesting way to achieve things properly is reading from files 
.read select_from_all_tables.sql # current tables are empty!

sqlite> .help # for more features
```

<https://www.sqlite.org/quickstart.html>
<https://www.sqlite.org/cli.html>

### Database Modeling

The current one (emploi_temps.db, schema.sql) is it convenient ?

***Get inspired***

- <https://github.com/trab-ml/AMDB>
