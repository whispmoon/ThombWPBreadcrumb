<?php
/**
 * Breadcrumb
 * Thomb 
 * www.thomasbilliau.com
 */

function the_breadcrumb()
{
    if (!is_front_page()) {

        echo '<ol class="breadcrumb" itemscope itemtype="https://schema.org/BreadcrumbList">
        <li class="breadcrumb-item" itemprop="itemListElement" itemscope
        itemtype="https://schema.org/ListItem">
        <a title="homepage" class="breadcrumb-item"itemprop="item" href="';
        echo bloginfo('wpurl');
        echo '">
        <span itemprop="name">
        Home
        </span>
        </a>
        <meta itemprop="position" content="1" />
        </li>';

        if (is_category() || is_single()) {
            $category = get_the_category();
            echo '<li class="breadcrumb-item" itemprop="itemListElement" itemscope
            itemtype="https://schema.org/ListItem">
            <a itemprop="item" href="' . esc_url(get_category_link($category)) . '" >
            <span itemprop="name">' . $category[0]->name . '</span>
            </a>
            <meta itemprop="position" content="2" />
            </li> ';
        } elseif (is_archive() || is_single()) {
            if (is_day()) {
                echo '<li class="breadcrumb-item" itemprop="itemListElement" itemscope 
                itemtype="https://schema.org/ListItem">
                <span itemprop="name">';
                printf(__('%s', 'text_domain'), get_the_date());
                echo '</span>
                    <meta itemprop="position" content="2" />
                    </li>';
            } elseif (is_month()) {
                echo '<li class="breadcrumb-item" itemprop="itemListElement" itemscope 
                itemtype="https://schema.org/ListItem">
                <span itemprop="name">';
                printf(__('%s', 'text_domain'), get_the_date(_x('F Y', 'monthly archives date format', 'text_domain')));
                echo '</span>
                    <meta itemprop="position" content="2" />
                    </li>';
            } elseif (is_year()) {
                echo '<li class="breadcrumb-item" itemprop="itemListElement" itemscope 
                itemtype="https://schema.org/ListItem">
                <span itemprop="name">';
                printf(__('%s', 'text_domain'), get_the_date(_x('Y', 'yearly archives date format', 'text_domain')));
                echo '</span>
                    <meta itemprop="position" content="2" />
                    </li>';
            } else {
                echo '<li class="breadcrumb-item" itemprop="itemListElement" itemscope 
                itemtype="https://schema.org/ListItem">
                <span itemprop="name">';
                _e('Blog Archives', 'text_domain');
                echo '</span>
                    <meta itemprop="position" content="2" />
                    </li>';
            }
        }
        if (is_single()) {
            echo '<li class="breadcrumb-item" itemprop="itemListElement" itemscope
            itemtype="https://schema.org/ListItem">
            <span itemprop="name">' . the_title('', '', false) . '</span>
            <meta itemprop="position" content="3" />
            </li>';
        }
        if (is_page()) {
            echo '<li class="breadcrumb-item" itemprop="itemListElement" itemscope
            itemtype="https://schema.org/ListItem">
            <span itemprop="name">' . the_title('', '', false) . '</span>
            <meta itemprop="position" content="3" />
            </li>';
        }
        if (is_404()) {
            echo '<li class="breadcrumb-item" itemprop="itemListElement" itemscope
            itemtype="https://schema.org/ListItem">
            <span itemprop="name">' . __('Error 404') . '</span>
            <meta itemprop="position" content="2" />
            </li>';
        }
        if (is_search()) {
            echo '<li class="breadcrumb-item" itemprop="itemListElement" itemscope
            itemtype="https://schema.org/ListItem">
            <span itemprop="name">' . __('Le résultat de recherche: ') . ' ' .  get_search_query() . '</span>
            <meta itemprop="position" content="2" />
            </li>';
        }
        if (is_home()) {
            global $post;
            $page_for_posts_id = get_option('page_for_posts');
            if ($page_for_posts_id) {
                $post = get_page($page_for_posts_id);
                setup_postdata($post);
                echo '<li class="breadcrumb-item" itemprop="itemListElement" itemscope
                itemtype="https://schema.org/ListItem">
                    <span itemprop="name">' . the_title('', '', false) . '</span>
                    <meta itemprop="position" content="2" />
                    </li>';
                rewind_posts();
            }
        }
        echo '</ol>';
    }
}
