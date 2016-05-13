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
    wp_nav_menu([
        'walker' => new BC\WordPress\WalkerNavMenu,
    ]);

    // Will generate:
    // <ul id="..." class="nav__list">
    //     <li class="nav__item ... nav__item--123">
    //         <a href="..." class="nav__link">...</a>
    //         <ul class="sub-nav">
    //             <li class="sub-nav__item">
    // ...
    ?>

</nav>
```

You can extend the class too. Here is an exemple where we change "nav" to "menu":

```php
<?php

namespace Your\Namespace;

class NavMenuWalker extends \BC\WordPress\NavMenuWalker
{
    protected $navListClass    = 'menu__list';
    protected $navItemClass    = 'menu__item';
    protected $navLinkClass    = 'menu__link';
    protected $subNavClass     = 'sub-menu';
    protected $subNavItemClass = 'sub-menu__item';
    protected $subNavLinkClass = 'sub-menu__link';
}
```

## License

[WTFPL](http://www.wtfpl.net/about/)
