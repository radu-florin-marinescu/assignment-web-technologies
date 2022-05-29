# assignment-web-technologies

University Project for Web Technologies

## Install prerequisites

- [download XAMPP](https://www.apachefriends.org/download.html)
- [install XAMPP](https://www.apachefriends.org/faq_linux.html)

```bash
wget https://www.apachefriends.org/xampp-files/8.1.6/xampp-linux-x64-8.1.6-0-installer.run
```

```bash
chmod 755 xampp-linux-*-installer.run
```

```bash
sudo ./xampp-linux-*-installer.run
```

The default installation path is `/opt/lampp`

## Install project

```bash
cd /opt/lampp/htdocs
```

```bash
# Make a directory where the project will be installed
project_dir=webapp
sudo mkdir "${project_dir}"
```

Add permissions for current user

```bash
sudo chown $USER:$USER "${project_dir}"
```

Go to project directory and download the repository content `.`

```bash
repo="git@github.com:radu-florin-marinescu/assignment-web-technologies.git"
cd "${project_dir}" && git clone "${repo}" .
```

## Start project

```bash
sudo /opt/lampp/lampp start
```

## Inspect if it is running

Browser -> `localhost/webapp`

## Create database

```bash
sudo /opt/lampp/bin/mysql
```

```sql
create database proiect;
```

```sql
exit
```

## Import data

```bash
dbname=proiect
sudo /opt/lampp/bin/mysql "${dbname}" < database/script.sql
```

## Development

Edit files in project directory
