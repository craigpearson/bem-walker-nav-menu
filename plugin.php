<?php

/**
 * Plugin Name: BEM Nav Menu Walker
 * Plugin URI:  https://github.com/benjamincrozat/bem-nav-menu-walker
 * Description: BEM Nav Menu Walker for WordPress.
 * Version:     1.0.0
 * Author:      Benjamin Crozat
 * Author URI:  https://benjamincrozat.com
 * License:     WTFPL
 * License URI: http://www.wtfpl.net/about/
 */

namespace BC\WordPress;

if (!defined('WPINC')) {
    exit;
}

class WalkerNavMenu extends \Walker_Nav_Menu
{
    protected $navListClass    = 'nav__list';
    protected $navItemClass    = 'nav__item';
    protected $navLinkClass    = 'nav__link';
    protected $subNavClass     = 'sub-nav';
    protected $subNavItemClass = 'sub-nav__item';
    protected $subNavLinkClass = 'sub-nav__link';

    public function __construct()
    {
        add_filter('wp_nav_menu_args', function ($args) {
            $args['items_wrap'] = '<ul id="%1$s" class="' . $this->navListClass . '">%3$s</ul>';

            return $args;
        });
    }

    public function start_lvl(&$output, $depth = 0, $args = [])
    {
        $output .= '<ul class="' . $this->subNavClass . '">';
    }

    public function start_el(&$output, $item, $depth = 0, $args = [], $id = 0)
    {
        $classes = empty($item->classes) ? [] : (array) $item->classes;

        array_walk($classes, function (&$value) use ($depth) {
            $replacement = $depth ? $this->subNavItemClass : $this->navItemClass;

            $value = str_replace('menu-item-', $replacement . '--', $value);
            $value = str_replace('menu-item', $replacement, $value);
        });

        $classes[] = $this->navItemClass . '--' . $item->ID;

        $args = apply_filters('nav_menu_item_args', $args, $item, $depth);

        $class_names = join(' ', apply_filters('nav_menu_css_class', array_filter($classes), $item, $args, $depth));
        $class_names = $class_names ? ' class="' . esc_attr($class_names) . '"' : '';

        $id = apply_filters('nav_menu_item_id', $this->navItemClass . '--'. $item->ID, $item, $args, $depth);
        $id = $id ? ' id="' . esc_attr($id) . '"' : '';

        $output .= '<li' . $id . $class_names .'>';

        $atts = [];
        $atts['title']  = !empty($item->attr_title) ? $item->attr_title      : '';
        $atts['target'] = !empty($item->target)     ? $item->target          : '';
        $atts['rel']    = !empty($item->xfn)        ? $item->xfn             : '';
        $atts['href']   = !empty($item->url)        ? $item->url             : '';
        $atts['class']  = $depth                    ? $this->subNavLinkClass : $this->navLinkClass;

        $atts = apply_filters('nav_menu_link_attributes', $atts, $item, $args, $depth);

        $attributes = '';

        foreach ($atts as $attr => $value) {
            if (!empty($value)) {
                $value = ('href' === $attr) ? esc_url($value) : esc_attr($value);
                $attributes .= ' ' . $attr . '="' . $value . '"';
            }
        }

        $title = apply_filters('the_title', $item->title, $item->ID);

        $title = apply_filters('nav_menu_item_title', $title, $item, $args, $depth);

        $item_output = $args->before;
        $item_output .= '<a'. $attributes .'>';
        $item_output .= $args->link_before . $title . $args->link_after;
        $item_output .= '</a>';
        $item_output .= $args->after;

        $output .= apply_filters('walker_nav_menu_start_el', $item_output, $item, $depth, $args);
    }
}
