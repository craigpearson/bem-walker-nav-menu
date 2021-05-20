<?php

namespace CP\BEM;

class navWalker extends \Walker_Nav_Menu
{
    /**
     * @var string
     */
    protected $prefix = '';

    /**
     * @var string
     */
    protected $navListClass = 'nav__list';

    /**
     * @var string
     */
    protected $navItemClass = 'nav__item';

    /**
     * @var string
     */
    protected $navLinkClass = 'nav__link';

    /**
     * @var string
     */
    protected $subNavClass = 'sub-nav';

    /**
     * @var string
     */
    protected $subNavItemClass = 'sub-nav__item';

    /**
     * @var string
     */
    protected $subNavLinkClass = 'sub-nav__link';

    public function __construct()
    {
        add_filter('wp_nav_menu_args', function ($args) {
            $args['items_wrap'] = '<ul id="%1$s" class="' . $args['menu_class'] . ' ' . $this->getPrefix() . $this->navListClass . '">%3$s</ul>';

            return $args;
        });
    }

    public function start_lvl(&$output, $depth = 0, $args = [])
    {
        $output .= sprintf('<ul class="%s">', $this->getPrefix() . $this->subNavClass);
    }

    public function start_el(&$output, $item, $depth = 0, $args = [], $id = 0)
    {
        $classes = empty($item->classes) ? [] : (array) $item->classes;

        array_walk($classes, function (&$value) use ($depth) {
            $replacement = $depth ? $this->getPrefix() . $this->subNavItemClass : $this->getPrefix() . $this->navItemClass;

            $value = str_replace('menu-item-', sprintf('%s--', $replacement), $value);
            $value = str_replace('menu-item', $replacement, $value);
        });

        $classes[] = sprintf('%s--%s', $this->getPrefix() . $this->navItemClass, $item->ID);

        $args = apply_filters('nav_menu_item_args', $args, $item, $depth);

        $class_names = join(' ', apply_filters('nav_menu_css_class', array_filter($classes), $item, $args, $depth));
        $class_names = $class_names ? sprintf(' class="%s"', esc_attr($class_names)) : '';

        $id = apply_filters('nav_menu_item_id', sprintf('%s--%s', $this->getPrefix() . $this->navItemClass, $item->ID), $item, $args, $depth);
        $id = $id ? sprintf(' id="%s"', esc_attr($id)) : '';

        $output .= sprintf('<li%s%s>', $id, $class_names);

        $atts = [];
        $atts['title']  = !empty($item->attr_title) ? $item->attr_title      : '';
        $atts['target'] = !empty($item->target)     ? $item->target          : '';
        $atts['rel']    = !empty($item->xfn)        ? $item->xfn             : '';
        $atts['href']   = !empty($item->url)        ? $item->url             : '';
        $atts['class']  = $depth                    ? $this->getPrefix() . $this->subNavLinkClass : $this->getPrefix() . $this->navLinkClass;

        $atts = apply_filters('nav_menu_link_attributes', $atts, $item, $args, $depth);

        $attributes = '';

        foreach ($atts as $attr => $value) {
            if (empty($value)) {
                continue;
            }

            $value       = 'href' === $attr ? esc_url($value) : esc_attr($value);
            $attributes .= sprintf('%s="%s"', $attr, $value);
        }

        $title = apply_filters('the_title', $item->title, $item->ID);

        $title = apply_filters('nav_menu_item_title', $title, $item, $args, $depth);

        $item_output  = $args->before;
        $item_output .= sprintf('<a %s>', $attributes);
        $item_output .= $args->link_before . $title . $args->link_after;
        $item_output .= '</a>';
        $item_output .= $args->after;

        $output .= apply_filters('walker_nav_menu_start_el', $item_output, $item, $depth, $args);
    }

    /**
     * @return string
     */
    protected function getPrefix()
    {
        if (empty($this->prefix)) {
            return '';
        }

        return $this->prefix;
    }
}
