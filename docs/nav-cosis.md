# NavCosis (Sidebar Navigation) Component – TwigUI

A highly customizable sidebar navigation component for Laravel Blade, designed for **package-level use** and fully extensible by end users.

---

## ✨ Features

* **Configurable via presets:** Choose from dozens of built-in color schemes or add your own.
* **Two highlight modes:**

  * Standard (background highlight)
  * Text (color-only highlight)
* **Supports categories, dividers, tooltips, icons (FontAwesome/SVG), badges, disabled/external links, and submenus.**
* **Active route detection** (with pattern matching for nested routes, e.g., `/edit/123`).
* **Expandable/collapsible submenus,** auto-expands if any child is active.
* **Fully customizable classes:**

  * Pass custom classes for items, children, categories, icons, and borders.
  * Per-item class override (for e.g., custom colors on a label).
* **Multiple config file support:**

  * Load navigation items from `/config/twigui/navs/default.php`, or select other configs (`admin.php`, etc) by passing a string prop.
  * Pass an items array directly for programmatic control.
* **Theme-ready:**

  * Fully supports dark/light mode (switches colors and highlights seamlessly).
* **Publishable/extensible presets system:**

  * Preset color classes stored in `/resources/views/vendor/twigui/presets/nav/colors.php`.
  * End users can publish, edit, or extend color schemes.
* **Publishable nav config:**

  * Users can publish and customize `/config/twigui/navs/default.php` (and variants) for total control over nav structure.
* **Blade & Alpine.js powered:**

  * Alpine.js used for submenu state, no JS build step required.

---

## 🚀 Usage

### Basic Example

```
<x-nav-cosis />
```

Renders the default navigation using `default.php` and default color preset (`green`).

### Use another nav config:

```
<x-nav-cosis items="admin" />
```

This loads `/config/twigui/navs/admin.php`.

### Pass custom items array

```
<x-nav-cosis :items="$myNavArray" />
```

### Change color scheme

```
<x-nav-cosis base-color="blue" />
<x-nav-cosis base-color="violet" />
```

### Use text highlight mode

```
<x-nav-cosis highlight-mode="text" base-color="emerald" />
```

### Customize classes

```
<x-nav-cosis
    item-class="..."
    child-item-class="..."
    highlight-parent-class="..."
    highlight-child-class="..."
    category-class="..."
    icon-class="..."
    child-border-class="..."
/>
```

### Override per item

In your nav config/items array:

```php
[
    'label' => 'Danger',
    'route' => '/danger',
    'class' => 'text-red-700 bg-red-100 font-extrabold',
    'icon' => 'fas fa-skull-crossbones',
]
```

---

## 🛠️ Extending & Publishing

### Publish all presets

```
php artisan vendor:publish --tag=twigui-presets
```

This makes all color presets editable at:
`/resources/views/vendor/twigui/presets/nav/colors.php`

### Add custom colors

* Edit the published file, add a new key (see examples for syntax).
> **IMPORTANT:** add content in tailwind config

```js
    content: [
        /** other files **/
        './vendor/laracosis/ui/resources/views/**/*.php',
        './vendor/laracosis/ui/src/Components/**/*.php',
    ],
```

### Publish navigation configs

```
php artisan vendor:publish --tag=twigui-config
```

This copies `/config/twigui/navs/default.php` etc. to your app, so you can edit your nav structure.

---

## 🧩 Items Array Structure

Each item/category can support:

* `category`: string (label for group)
* `items`: array (nav items for group)

Each nav item can have:

* `label` (required)
* `route` (URL or named route)
* `icon` (FontAwesome class, SVG, or raw HTML)
* `tooltip` (string)
* `badge` (string or int)
* `divider` (bool)
* `external` (bool)
* `disabled` (bool)
* `class` (string, per-item class override)
* `label_class` (string, per-label class override)
* `match` (string or array, for active matching)
* `children` (array, for submenus)

---

## 💡 Tips & Notes

* **Customizing colors:**

  * Use any color preset in the published `colors.php`. Only those present and safelisted in Tailwind will work.
  * For more colors, add them to both the PHP and your safelist (or a Blade preset).

* **Performance:**

  * Loads all color presets at once, but they're small and cached by opcode cache in production.

* **Advanced:**

  * You can merge/override the presets programmatically if needed.
  * Structure allows multiple navs/configs for multi-tenant/admin/front sites.

---

## 📝 Example nav config

See `/config/twigui/navs/default.php` for a comprehensive, documented sample covering categories, dividers, external links, disabled, tooltips, submenus, etc.

---

## 🌈 Supported Colors

* `green`, `blue`, `violet`, `red`, `emerald`, `yellow`, `pink`, `sky`, `lime`, `slate`, `indigo`, `fuchsia`, `orange`, `teal`
* Extendable via published presets

---

## 🧑‍💻 Tech stack

* Laravel Blade
* Alpine.js (inline, no build step required)
* Tailwind CSS v3/v4 compatible (requires manual safelisting for dynamic classes)

---

## 📢 Got issues or suggestions?

Feel free to open an issue or PR!

---

## License

\[MIT]
