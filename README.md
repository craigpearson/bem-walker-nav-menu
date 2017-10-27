[![Latest Stable Version](https://poser.pugx.org/benjamincrozat/bem-walker-nav-menu/v/stable)](https://packagist.org/packages/benjamincrozat/bem-walker-nav-menu)
[![License](https://poser.pugx.org/benjamincrozat/bem-walker-nav-menu/license)](https://packagist.org/packages/benjamincrozat/bem-walker-nav-menu)
[![Total Downloads](https://poser.pugx.org/benjamincrozat/bem-walker-nav-menu/downloads)](https://packagist.org/packages/benjamincrozat/bem-walker-nav-menu)

# BEM Walker Nav Menu

[BEM](http://getbem.com) naming for WordPress navigation menus.

## Installation

You can manually download it and install it in your plugins folder or install it via Composer:

```bash
composer require benjamincrozat/bem-walker-nav-menu
```

## Usage

```php
<nav class="nav">
    <?php
    wp_nav_menu([
        'walker' => new BC\WordPress\BEMWalkerNavMenu,
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

Extend the class to change the HTML classes.

```php
<?php

class CustomWalkerNavMenu extends \BC\WordPress\BEMWalkerNavMenu
{
    protected $prefix = 'c';

    protected $navListClass = 'menu__list';

    protected $navItemClass = 'menu__item';

    protected $navLinkClass = 'menu__link';

    protected $subNavClass = 'sub-menu';

    protected $subNavItemClass = 'sub-menu__item';

    protected $subNavLinkClass = 'sub-menu__link';
}
```

## License

[WTFPL](http://www.wtfpl.net/about/)
