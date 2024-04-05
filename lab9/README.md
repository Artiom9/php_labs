# Отчет по девятойы лабораторной работе

1. [Описание проекта](#1-описание-проекта).
2. [Краткая документация к проекту](#2-краткая-документация-к-проекту).
3. [Список использованных источников](#3-список-использованных-источников).

## 1. Описание проекта

Этот проект представляет собой базу данных для блога, где пользователи могут регистрироваться, оставлять комментарии и взаимодействовать друг с другом. Основные компоненты проекта включают таблицы для пользователей и комментариев.

## 2. Краткая документация к проекту

Структура базы данных blog:

Таблица users:

- id (integer, primary key) - идентификатор пользователя
-  name (text) - имя пользователя
- surname (text) - фамилия пользователя
- email (text, unique key) - электронная почта пользователя (уникальный ключ)

Таблица comments:

- id (integer, primary key) - идентификатор комментария
- user_id (integer, foreign key) - ссылка на пользователя, который оставил комментарий
- comment (text) - текст комментария
- Таким образом, создана база данных blog с таблицами users и comments, соответствующими заданным структурам.

## 3. Список использованных источников

1. [MySQL Documentration](https://dev.mysql.com/doc/)