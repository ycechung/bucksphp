<?php

// include header HTML and functions
require 'header.php';

// ?q= the term to search for
$search_term = isset($_GET['q']) ? trim($_GET['q']) : null;

// ?page= current page number
$current_page = isset($_GET['page']) ? (int)$_GET['page'] : 1;

// # of products to show per page
$per_page = 12;

// if something was searched for, build a WHERE clause and set a specific page title
if ( $search_term ) {
  $where = "WHERE name LIKE " . qstr('%' . $search_term . '%');
  $page_title = "Products matching: <i>" . h($_GET['q']) . "</i>";
}
// no search term. no where clause and use the default page title
else {
  $where = '';
  $page_title = "All Products";
}

// get page count for the current query
$row = $db->selectOne("SELECT COUNT(*) AS count FROM products " . $where);
$product_count = $row['count'];
$page_count = ceil($product_count / $per_page);

// if current page is invalid, set it to 1
if ( $current_page < 1 || $current_page > $page_count ) {
  $current_page = 1;
}

// if this isn't the last page, there's a next page
if ( $current_page < $page_count ) {
  $next_page = $current_page + 1;
}
else {
  $next_page = null;
}

// if this isn't the first page, there's a previous page
if ( $current_page > 1 ) {
  $prev_page = $current_page - 1;
}
else {
  $prev_page = null;
}

// calculate the index of the record to start with
$start = ($current_page - 1) * $per_page;

// select products sorted by name
$products = $db->selectAll("SELECT * FROM products " . $where . " ORDER BY name LIMIT " . (int)$start . ", " . (int)$per_page);

// Print the index template
print_template('index', array(
	'products' => $products,
  'page_title' => $page_title,
  'current_page' => $current_page,
  'page_count' => $page_count,
  'prev_page' => $prev_page,
  'next_page' => $next_page,
  'search_term' => $search_term
));
