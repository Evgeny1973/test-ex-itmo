### test-ex-itmo
test exercise for itmo

**Задание**

Сделать CRUD-админку для управления авторами и книгами. У автора может быть много книг и книга может иметь много авторов.

Поля автора - ФИО в отдельных полях. Не должно быть двух авторов с одинаковым ФИО.
Поля книги: Название, год издания, ISBN, количество страниц. Не должно быть двух книг с одинаковым сочетанием названия и ISBN или названия и года издания.

**First start:**
```
git clone https://github.com/Evgeny1973/test-ex-itmo.git itmo
docker-compose up -d
docker exec -it php sh
composer install
php bin/console doctrine:database:create
php bin/console doctrine:migrations:migrate
php bin/console doctrine:fixtures:load
```

