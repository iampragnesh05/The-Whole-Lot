<?php
/**
 * The Whole Lot - Blogs Helper Functions
 * JSON Flat-File Data Storage Handler
 */

define('BLOGS_DATA_FILE', __DIR__ . '/../data/blogs.json');

if (!function_exists('mb_substr')) {
    function mb_substr($str, $start, $length = null, $encoding = null) {
        return ($length === null) ? substr($str, $start) : substr($str, $start, $length);
    }
}

/**
 * Get all blogs
 * @param bool $only_published
 * @return array
 */
function get_all_blogs($only_published = true) {
    if (!file_exists(BLOGS_DATA_FILE)) {
        return [];
    }
    $content = file_get_contents(BLOGS_DATA_FILE);
    $blogs = json_decode($content, true);
    if (!is_array($blogs)) {
        return [];
    }
    
    if ($only_published) {
        $blogs = array_filter($blogs, function($item) {
            return isset($item['status']) && $item['status'] === 'published';
        });
    }
    
    // Sort descending by ID / creation
    usort($blogs, function($a, $b) {
        return ($b['id'] ?? 0) <=> ($a['id'] ?? 0);
    });
    
    return array_values($blogs);
}

/**
 * Get single blog by slug
 * @param string $slug
 * @return array|null
 */
function get_blog_by_slug($slug) {
    $slug = trim(strtolower($slug));
    $blogs = get_all_blogs(false);
    foreach ($blogs as $b) {
        if (strtolower($b['slug'] ?? '') === $slug) {
            return $b;
        }
    }
    return null;
}

/**
 * Get single blog by ID
 * @param int|string $id
 * @return array|null
 */
function get_blog_by_id($id) {
    $id = (int)$id;
    $blogs = get_all_blogs(false);
    foreach ($blogs as $b) {
        if ((int)($b['id'] ?? 0) === $id) {
            return $b;
        }
    }
    return null;
}

/**
 * Save blog (Insert or Update)
 * @param array $blog
 * @return array Saved blog with ID
 */
function save_blog($blog) {
    if (!file_exists(BLOGS_DATA_FILE)) {
        if (is_writable(dirname(BLOGS_DATA_FILE))) {
            @file_put_contents(BLOGS_DATA_FILE, json_encode([], JSON_PRETTY_PRINT));
        } else {
            return false;
        }
    }
    
    $blogs = get_all_blogs(false);
    $now = date('Y-m-d');
    
    if (empty($blog['id'])) {
        // Create new ID
        $max_id = 0;
        foreach ($blogs as $b) {
            if (($b['id'] ?? 0) > $max_id) {
                $max_id = (int)$b['id'];
            }
        }
        $blog['id'] = $max_id + 1;
        $blog['created_at'] = $now;
        $blog['updated_at'] = $now;
        
        // Ensure slug is unique
        $base_slug = !empty($blog['slug']) ? slugify($blog['slug']) : slugify($blog['title']);
        $slug = $base_slug;
        $counter = 1;
        while (get_blog_by_slug($slug) !== null) {
            $slug = $base_slug . '-' . $counter;
            $counter++;
        }
        $blog['slug'] = $slug;
        
        array_unshift($blogs, $blog);
    } else {
        // Update existing
        $id = (int)$blog['id'];
        $found = false;
        $blog['updated_at'] = $now;
        
        if (empty($blog['slug'])) {
            $blog['slug'] = slugify($blog['title']);
        } else {
            $blog['slug'] = slugify($blog['slug']);
        }
        
        foreach ($blogs as $key => $existing) {
            if ((int)($existing['id'] ?? 0) === $id) {
                $blog['created_at'] = $existing['created_at'] ?? $now;
                $blogs[$key] = array_merge($existing, $blog);
                $found = true;
                break;
            }
        }
        
        if (!$found) {
            $blogs[] = $blog;
        }
    }
    
    // Check writability before writing
    if (file_exists(BLOGS_DATA_FILE) && !is_writable(BLOGS_DATA_FILE)) {
        return false;
    }
    
    // Write back atomically
    $written = @file_put_contents(BLOGS_DATA_FILE, json_encode($blogs, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES));
    if ($written === false) {
        return false;
    }
    return $blog;
}

/**
 * Delete blog by ID
 * @param int $id
 * @return bool
 */
function delete_blog($id) {
    $id = (int)$id;
    $blogs = get_all_blogs(false);
    $initial_count = count($blogs);
    
    $blogs = array_filter($blogs, function($item) use ($id) {
        return (int)($item['id'] ?? 0) !== $id;
    });
    
    if (count($blogs) !== $initial_count) {
        if (file_exists(BLOGS_DATA_FILE) && !is_writable(BLOGS_DATA_FILE)) {
            return false;
        }
        $written = @file_put_contents(BLOGS_DATA_FILE, json_encode(array_values($blogs), JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES));
        return $written !== false;
    }
    return false;
}

/**
 * Slugify string
 * @param string $text
 * @return string
 */
function slugify($text) {
    $text = preg_replace('~[^\pL\d]+~u', '-', $text);
    $text = iconv('utf-8', 'us-ascii//TRANSLIT', $text);
    $text = preg_replace('~[^-\w]+~', '', $text);
    $text = trim($text, '-');
    $text = preg_replace('~-+~', '-', $text);
    $text = strtolower($text);
    return empty($text) ? 'n-a' : $text;
}

/**
 * Get distinct categories
 * @return array
 */
function get_blog_categories() {
    $blogs = get_all_blogs(true);
    $categories = [];
    foreach ($blogs as $b) {
        $cat = trim($b['category'] ?? 'General');
        if (!empty($cat)) {
            $categories[$cat] = ($categories[$cat] ?? 0) + 1;
        }
    }
    return $categories;
}
