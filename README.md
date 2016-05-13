[![Latest Stable Version](https://poser.pugx.org/benjamincrozat/bem-nav-menu-walker/v/stable)](https://packagist.org/packages/benjamincrozat/bem-nav-menu-walker)
[![License](https://poser.pugx.org/benjamincrozat/bem-nav-menu-walker/license)](https://packagist.org/packages/benjamincrozat/bem-nav-menu-walker)
[![Total Downloads](https://poser.pugx.org/benjamincrozat/bem-nav-menu-walker/downloads)](https://packagist.org/packages/benjamincrozat/bem-nav-menu-walker)

# BEM Nav Menu Walker

[BEM](http://getbem.com) Nav Menu Walker for WordPress.

## Installation

For now, you have to install it manually in your plugin folder.

If you use something like [wp-boilerplate](https://github.com/benjamincrozat/wp-boilerplate), just install it via Composer like so:

```bash
composer require benjamincrozat/bem-nav-menu-walker
```

## Usage

```php
<nav class="nav">

    <?php
    // Will generate:
    // <ul id="..." class="nav__list">
    //     <li class="nav__item ...">
    //         <a href="..." class="nav__link">...</a>
    // ...

    wp_nav_menu([
        'walker' => new BC\WordPress\WalkerNavMenu,
    ]);
    ?>

</nav>
```

## License

[WTFPL](http://www.wtfpl.net/about/)
