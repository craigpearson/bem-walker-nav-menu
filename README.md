[![Latest Stable Version](https://poser.pugx.org/benjamincrozat/bem-walker-nav-menu/v/stable)](https://packagist.org/packages/benjamincrozat/bem-walker-nav-menu)
[![License](https://poser.pugx.org/benjamincrozat/bem-walker-nav-menu/license)](https://packagist.org/packages/benjamincrozat/bem-walker-nav-menu)
[![Total Downloads](https://poser.pugx.org/benjamincrozat/bem-walker-nav-menu/downloads)](https://packagist.org/packages/benjamincrozat/bem-walker-nav-menu)

# BEM Walker Nav Menu

[BEM](http://getbem.com) Walker Nav Menu for WordPress.

## Installation

For now, you have to install it manually in your plugin folder.

If you use something like [wp-boilerplate](https://github.com/benjamincrozat/wp-boilerplate), just install it via Composer like so:

```bash
composer require benjamincrozat/bem-walker-nav-menu
```

## Usage

```php
<nav class="nav">

    <?php
    wp_nav_menu([
        'walker' => new BC\WordPress\BEMWalkerNavMenu\WalkerNavMenu,
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

class WalkerNavMenu extends \BC\WordPress\BEMWalkerNavMenu\WalkerNavMenu
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
