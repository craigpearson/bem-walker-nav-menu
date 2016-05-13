[![Latest Stable Version](https://poser.pugx.org/benjamincrozat/bem-nav-menu-walker/v/stable)](https://packagist.org/packages/benjamincrozat/bem-nav-menu-walker)
[![License](https://poser.pugx.org/benjamincrozat/bem-nav-menu-walker/license)](https://packagist.org/packages/benjamincrozat/bem-nav-menu-walker)
[![Total Downloads](https://poser.pugx.org/benjamincrozat/bem-nav-menu-walker/downloads)](https://packagist.org/packages/benjamincrozat/bem-nav-menu-walker)

# BEM Nav Menu Walker

[BEM](http://getbem.com) Nav Menu Walker for WordPress.

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
        'walker' => new BC\WordPress\WalkerNavMenu
    ]);
    ?>

</nav>
```

## License

[WTFPL](http://www.wtfpl.net/about/)
