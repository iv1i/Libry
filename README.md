<p align="center"><img src="public/docs/icons/book.png" width="300" alt="Laravel Logo"></p><a id='links'></a>

# <p align="center">Libry</p>

### <p align="center">Минималистичный REST API для управления библиотекой</p>

## <img src="public/docs/icons/link.png" width="35" align="absmiddle"> Ссылки
### [Технологии](#technologies) | [Описание](#description) | [Маршруты](#routes) | [Инициализация](#init) | [Взаимодействие](#interaction)

## <img src="public/docs/icons/tools.png" width="35" align="absmiddle"> Используемые технологии <a id='technologies'></a>[<img src="public/docs/icons/up.png" width="20" align="absmiddle">](#links)

[PHP 8.2](https://www.php.net/) - Язык программироваия.

[Laravel 12](https://laravel.com/docs) - Фреймворк.

[Mysql 8.0](https://www.mysql.com/) - База данных.

[Docker](https://www.docker.com/) - Контейнеризация.

[Laravel Sail](https://laravel.su/docs/12.x/sail) - Docker-интерфейс.

[Laravel Sanctum](https://laravel.su/docs/12.x/sanctum) - Cистема аутентификации.

## <img src="public/docs/icons/book2.png" width="35" align="absmiddle"> Описание <a id='description'></a>[<img src="public/docs/icons/up.png" width="20" align="absmiddle">](#links)

Проект представляет собой RESTful API для управления библиотекой с тремя типами пользователей: гости, авторы и администраторы.

### Основные сущности

- **Книги** (3 типа: `Графическое (graphic)`, `Цифровое (digital)`, `Печатное (printed)`)
- **Авторы**
- **Жанры**

### Связи между сущностями

- Один автор → много книг
- Одна книга → много жанров
- Один жанр → много книг

### Технические особенности
- **Enum** для типов книг
- **Логирование** всех действий с книгами (`storage/logs/library.log`)
- **Пагинация** для всех списков
- **Фильтрация** и **сортировка** для книг

## <img src="public/docs/icons/route.png" width="35" align="absmiddle"> Маршруты <a id='routes'></a>[<img src="public/docs/icons/up.png" width="20" align="absmiddle">](#links)

### Публичные маршруты (без аутентификации)

| Метод | Эндпоинт                     | Описание                              |
|-------|------------------------------|---------------------------------------|
| GET   | `/api/public/books`          | Получить список книг (с пагинацией)   |
| GET   | `/api/public/books/{book}`   | Получить данные конкретной книги      |
| GET   | `/api/public/authors`        | Получить список авторов(с пагинацией) |
| GET   | `/api/public/authors/{author}` | Получить данные автора с его книгами|
| GET   | `/api/public/genres`         | Получить список жанров(с пагинацией)  |

### Маршруты для авторов

#### Аутентификация
| Метод | Эндпоинт               | Описание          |
|-------|------------------------|-------------------|
| POST  | `/api/author/login`    | Вход для автора   |
| POST  | `/api/author/logout`   | Выход для автора  |

#### Защищенные маршруты (требуется аутентификация)

| Метод | Эндпоинт                     | Описание                             |
|-------|------------------------------|--------------------------------------|
| GET   | `/api/author/books`          | Получить свои книги(с пагинацией)    |
| PUT   | `/api/author/profile`        | Обновить свои данные                 |
| PUT   | `/api/author/books/{book}`   | Обновить свою книгу                  |
| DELETE| `/api/author/books/{book}`   | Удалить свою книгу                   |

### Маршруты для администраторов

#### Аутентификация
| Метод | Эндпоинт              | Описание             |
|-------|-----------------------|----------------------|
| POST  | `/api/admin/login`    | Вход для администратора |
| POST  | `/api/admin/logout`   | Выход для администратора |

#### Защищенные маршруты (требуется аутентификация)

#### Управление авторами
| Метод | Эндпоинт                     | Описание                             |
|-------|------------------------------|--------------------------------------|
| GET   | `/api/admin/authors`         | Получить всех авторов(с пагинацией)   |
| POST  | `/api/admin/authors`         | Создать нового автора                |
| GET   | `/api/admin/authors/{author}` | Получить данные автора               |
| PUT   | `/api/admin/authors/{author}` | Обновить данные автора               |
| DELETE| `/api/admin/authors/{author}` | Удалить автора                       |

#### Управление книгами
| Метод | Эндпоинт               | Описание                                       |
|-------|------------------------|------------------------------------------------|
| GET   | `/api/admin/books`     | Получить все книги (с пагинацией)(с фильтрами) |
| POST  | `/api/admin/books`     | Создать новую книгу                            |
| GET   | `/api/admin/books/{book}` | Получить данные книги                          |
| PUT   | `/api/admin/books/{book}` | Обновить данные книги                          |
| DELETE| `/api/admin/books/{book}` | Удалить книгу                                  |

#### Управление жанрами
| Метод | Эндпоинт               | Описание                             |
|-------|------------------------|--------------------------------------|
| GET   | `/api/admin/genres`    | Получить все жанры(с пагинацией)     |
| POST  | `/api/admin/genres`    | Создать новый жанр                   |
| GET   | `/api/admin/genres/{genre}` | Получить данные жанра           |
| PUT   | `/api/admin/genres/{genre}` | Обновить данные жанра           |
| DELETE| `/api/admin/genres/{genre}` | Удалить жанр                    |

## <img src="public/docs/icons/rocket.png" width="30" align="absmiddle"> Инициализация <a id='init'></a>[<img src="public/docs/icons/up.png" width="20" align="absmiddle">](#links)
> [!NOTE]
> Рекомендуется использовать DNS 8.8.8.8 для избежания проблем с контейнерами.
### Предварительные требования

```bash
sudo apt update && sudo apt upgrade -y
```
### Установка зависимостей:
```bash
composer install
```
### Настройка окружения
```bash
cp .env.example .env
```
### Запуск Docker
> [!NOTE]
> По умолчанию в docker-compose.yml находится development версия.
```bash
cp docker/production/docker-compose.prod.yml docker-compose.yml
docker compose up -d --build
```
### Генерация ключа
```bash
docker compose exec app php artisan key:generate
```
### Инициализация БД
```bash
docker compose exec app php artisan migrate --seed
```
### Все команды
```bash
sudo apt update && sudo apt upgrade -y
```
```bash
composer install
cp .env.example .env
cp docker/production/docker-compose.prod.yml docker-compose.yml
docker compose up -d --build
docker compose exec app php artisan key:generate
sleep 5
docker compose exec app php artisan migrate --seed
```
### После успешного запуска система будет доступна по адресу: 
### `http://localhost`

## <img src="public/docs/icons/fire.png" width="35" align="absmiddle"> Взаимодействие с системой  <a id='interaction'></a>[<img src="public/docs/icons/up.png" width="20" align="absmiddle">](#links)
> [!NOTE]
> После успешного выполнения миграций и заполнения данных, у всех пользователей (авторов и администраторов) будет один и тот-же пароль = `password`.
### Данные для входа администратора:
```json
{ 
    "email": "admin@example.com", 
    "password": "password"
}
```
### Данные для входа автора:
```json
{ 
    "email": "Почта_автора", 
    "password": "password"
}
```
### Данные для создания и обновления книг:
```json
{
    "title": "Гарри Поттер",
    "description": "Описание книги (необязательное поле)",
    "author": "Генри Кавил",
    "type": "printed",
    "genres": "genre1,genre2"
}
```
### Данные для создания и обновления авторов:
```json
{
    "name": "Генри Кавил",
    "email": "genry@kavil.com",
    "password": "password"
}
```
### Данные для создания и обновления жанров:
```json
{
    "name": "new_genre"
}
```
### фильтрация книг у администратора:
```
GET /api/admin/books?title=Harry Potter&author=Генри Кавил&genres=tale&sort=title
```
