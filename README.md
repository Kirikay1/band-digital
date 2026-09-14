# Band Digital

Статическая frontend-версия будущей WordPress-темы.

## Сборка стилей

Установить зависимости:

```bash
npm install
```

Следить за изменениями SCSS во время разработки. Команда обновляет файл, подключённый
к статическим HTML-страницам:

```bash
npm run watch
```

Собрать обычный CSS с Autoprefixer и минифицированный production-файл:

```bash
npm run build
```

Результаты сборки:

- `css/style.css` — читаемая версия с Autoprefixer и source map;
- `css/style.min.css` — минифицированная production-версия, подключённая к HTML;
- `css/style.css.map` — source map для разработки.

Перед публикацией обязательно выполнить `npm run build`: режим наблюдения использует
быструю компиляцию Sass, а полная сборка дополнительно запускает Autoprefixer и cssnano.

Проверить HTML, SCSS и форматирование:

```bash
npm run lint
```

Автоматически исправить форматирование:

```bash
npm run lint:css:fix
npm run format
```
