## Структура проекта

```
Projectttt 2/
├── components/              # Компоненты (иконки)
│   └── icons/
│       ├── home.svg
│       ├── ai-agents.svg
│       ├── question.svg
│       ├── contacts.svg
│       └── news.svg
├── css/                     # CSS стили
│   ├── main.css            # Стили публичной части
│   └── admin.css           # Стили админ-панели
├── js/                      # JavaScript файлы
│   └── main.js             # Все JS скрипты проекта
├── protected/               # Защищенная директория
│   ├── config/             # Конфигурационные файлы
│   │   ├── main.php
│   │   └── database.php
│   ├── controllers/        # Контроллеры
│   │   ├── AisanaController.php
│   │   └── AdminController.php
│   ├── models/             # Модели данных
│   │   ├── News.php
│   │   ├── Course.php
│   │   ├── Project.php
│   │   ├── User.php
│   │   ├── LoginForm.php
│   │   └── ContactForm.php
│   ├── components/         # Компоненты приложения
│   │   ├── Controller.php
│   │   └── UserIdentity.php
│   ├── messages/           # Переводы
│   │   ├── ru/labels.php
│   │   ├── kz/labels.php
│   │   └── en/labels.php
│   └── data/              # SQL скрипты
│       └── complete_schema.sql
├── themes/                 # Темы оформления
│   └── new/               # Тема "new"
│       └── views/
│           ├── layouts/
│           │   └── main.php
│           ├── aisana/    # Публичные страницы
│           │   ├── index.php
│           │   ├── news.php
│           │   ├── newsView.php
│           │   ├── courses.php
│           │   ├── projects.php
│           │   ├── projectView.php
│           │   └── parts/
│           │       └── _agents.php
│           └── admin/     # Админ-панель
│               ├── login.php
│               ├── dashboard.php
│               ├── error.php
│               ├── news/
│               │   ├── index.php
│               │   ├── create.php
│               │   ├── update.php
│               │   ├── view.php
│               │   └── _form.php
│               ├── courses/
│               │   ├── index.php
│               │   ├── create.php
│               │   ├── update.php
│               │   ├── view.php
│               │   └── _form.php
│               └── projects/
│                   ├── index.php
│                   ├── create.php
│                   ├── update.php
│                   ├── view.php
│                   └── _form.php
├── uploads/               # Загруженные файлы
└── index.php              # Точка входа
```

## Таблицы базы данных

### 1. tbl_user - Пользователи для админ-панели

**Поля:**
- `id` (int, AUTO_INCREMENT, PRIMARY KEY)
- `username` (varchar(128), UNIQUE, NOT NULL)
- `password` (varchar(255), NOT NULL)
- `email` (varchar(128), UNIQUE, NOT NULL)
- `created_at` (datetime, NOT NULL)
- `updated_at` (datetime, NOT NULL)

**SQL:**
```sql
CREATE TABLE IF NOT EXISTS `tbl_user` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(128) NOT NULL,
  `password` varchar(255) NOT NULL,
  `email` varchar(128) NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `username` (`username`),
  UNIQUE KEY `email` (`email`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

INSERT INTO `tbl_user` (`username`, `password`, `email`, `created_at`, `updated_at`) 
VALUES ('admin', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'admin@ku.edu.kz', NOW(), NOW())
ON DUPLICATE KEY UPDATE `username`=`username`;
```

**По умолчанию создается пользователь:**
- Логин: `admin`
- Пароль: `admin123`

### 2. tbl_news - Новости

**Поля:**
- `id` (int, AUTO_INCREMENT, PRIMARY KEY)
- `title` (varchar(255), NOT NULL)
- `content` (text, NOT NULL)
- `excerpt` (text, NULL)
- `image` (longtext, NULL) - изображение в формате base64
- `slug` (varchar(255), UNIQUE, NOT NULL)
- `published` (tinyint(1), DEFAULT 0, INDEX)
- `created_at` (datetime, NULL)
- `updated_at` (datetime, NULL)

**SQL:**
```sql
CREATE TABLE IF NOT EXISTS `tbl_news` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(255) NOT NULL,
  `content` text NOT NULL,
  `excerpt` text DEFAULT NULL,
  `image` longtext DEFAULT NULL,
  `slug` varchar(255) NOT NULL,
  `published` tinyint(1) DEFAULT 0,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `slug` (`slug`),
  KEY `idx_published` (`published`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
```

### 3. tbl_courses - Курсы

**Поля:**
- `id` (int, AUTO_INCREMENT, PRIMARY KEY)
- `title` (varchar(255), NOT NULL)
- `description` (text, NOT NULL)
- `link` (varchar(500), NOT NULL)
- `published` (tinyint(1), DEFAULT 0, INDEX)
- `created_at` (datetime, NULL)
- `updated_at` (datetime, NULL)

**SQL:**
```sql
CREATE TABLE IF NOT EXISTS `tbl_courses` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(255) NOT NULL,
  `description` text NOT NULL,
  `link` varchar(500) NOT NULL,
  `published` tinyint(1) DEFAULT 0,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `idx_published` (`published`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
```

### 4. tbl_projects - Проекты

**Поля:**
- `id` (int, AUTO_INCREMENT, PRIMARY KEY)
- `title` (varchar(255), NOT NULL)
- `description` (text, NOT NULL)
- `goals` (text, NULL)
- `developers` (text, NULL)
- `contacts` (text, NULL)
- `logo` (longtext, NULL) - логотип в формате base64
- `screenshots` (text, NULL) - JSON массив с data URI скриншотов
- `published` (tinyint(1), DEFAULT 0, INDEX)
- `created_at` (datetime, NOT NULL)
- `updated_at` (datetime, NOT NULL)

**SQL:**
```sql
CREATE TABLE IF NOT EXISTS `tbl_projects` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(255) NOT NULL,
  `description` text NOT NULL,
  `goals` text DEFAULT NULL,
  `developers` text DEFAULT NULL,
  `contacts` text DEFAULT NULL,
  `logo` longtext DEFAULT NULL,
  `screenshots` text DEFAULT NULL,
  `published` tinyint(1) DEFAULT 0,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL,
  PRIMARY KEY (`id`),
  KEY `idx_published` (`published`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
```

**Примечание:** Все изображения хранятся в БД в формате base64 (data URI), а не как файлы на сервере.

## Файлы для переноса

### Контроллеры (2 файла)

```
protected/controllers/AisanaController.php
protected/controllers/AdminController.php
```

### Модели (6 файлов)

```
protected/models/News.php
protected/models/Course.php
protected/models/Project.php
protected/models/User.php
protected/models/LoginForm.php
protected/models/ContactForm.php
```

### Компоненты (2 файла)

```
protected/components/Controller.php
protected/components/UserIdentity.php
```

### Представления - Публичные страницы (8 файлов)

```
themes/new/views/layouts/main.php
themes/new/views/aisana/index.php
themes/new/views/aisana/parts/_agents.php
themes/new/views/aisana/news.php
themes/new/views/aisana/newsView.php
themes/new/views/aisana/courses.php
themes/new/views/aisana/projects.php
themes/new/views/aisana/projectView.php
```

### Представления - Админ-панель (17 файлов)

```
themes/new/views/admin/login.php
themes/new/views/admin/dashboard.php
themes/new/views/admin/error.php

themes/new/views/admin/news/index.php
themes/new/views/admin/news/create.php
themes/new/views/admin/news/update.php
themes/new/views/admin/news/view.php
themes/new/views/admin/news/_form.php

themes/new/views/admin/courses/index.php
themes/new/views/admin/courses/create.php
themes/new/views/admin/courses/update.php
themes/new/views/admin/courses/view.php
themes/new/views/admin/courses/_form.php

themes/new/views/admin/projects/index.php
themes/new/views/admin/projects/create.php
themes/new/views/admin/projects/update.php
themes/new/views/admin/projects/view.php
themes/new/views/admin/projects/_form.php
```

### CSS файлы (2 файла)

```
css/main.css
css/admin.css
```

### JavaScript файлы (1 файл)

```
js/main.js
```

### Иконки (5 файлов)

```
components/icons/home.svg
components/icons/ai-agents.svg
components/icons/question.svg
components/icons/contacts.svg
components/icons/news.svg
```

### Переводы (3 файла)

```
protected/messages/ru/labels.php
protected/messages/kz/labels.php
protected/messages/en/labels.php
```

## Итого файлов для переноса

- **Контроллеры:** 2 файла
- **Модели:** 6 файлов
- **Компоненты:** 2 файла
- **Представления:** 25 файлов
- **CSS:** 2 файла
- **JavaScript:** 1 файл
- **Иконки:** 5 файлов
- **Переводы:** 3 файла

**Всего: 46 файлов**

## Настройка конфигурации

### protected/config/main.php

Убедитесь, что указаны следующие настройки:

   ```php
   'defaultController'=>'aisana',
'theme'=>'new',
'language'=>'ru',
   'sourceLanguage'=>'ru',
   ```

Добавьте компонент messages:

   ```php
       'messages'=>array(
           'class'=>'CPhpMessageSource',
           'basePath'=>'protected/messages',
           'forceTranslation'=>true,
   ),
   ```

Добавьте URL правила:

   ```php
'urlManager'=>array(
    'urlFormat'=>'path',
    'showScriptName'=>true,
    'rules'=>array(
        'aisana/newsView/<slug:[\w\-]+>'=>'aisana/newsView',
        'aisana/projectView/<id:\d+>'=>'aisana/projectView',
        '<controller:\w+>/<action:\w+>'=>'<controller>/<action>',
    ),
   ),
   ```

### protected/config/database.php

Настройте подключение к базе данных:

```php
return array(
    'connectionString' => 'mysql:host=127.0.0.1;port=3306;dbname=ваша_база_данных',
    'emulatePrepare' => true,
    'username' => 'ваш_пользователь',
    'password' => 'ваш_пароль',
    'charset' => 'utf8mb4',
    'tablePrefix' => 'tbl_',
);
```

# aisanacrud
