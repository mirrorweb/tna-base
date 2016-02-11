<?php
// 404 Redirection function - called in header.php
if (!function_exists('redirect_if_404')) :
	function redirect_if_404()
	{
		if (is_404()) {
			// Format string with placeholders for components
			$requested_page = $_SERVER['REQUEST_SCHEME'] . "://" . $_SERVER["HTTP_HOST"] . $_SERVER["REQUEST_URI"];
			// Sanitizing the URL before use
			$requested_page_safe = filter_var($requested_page, FILTER_SANITIZE_URL);
			// Staging URLs
			$staging_subdomains = array("devlb", "testlb", "livelb");
			$requested_page_safe = str_replace($staging_subdomains, "www", $requested_page_safe);
			// Format string for redirection app URL with single placeholder
			$redirect_app_url_format = "http://www.nationalarchives.gov.uk/PageNotFound/PageNotFound.aspx?url=%s";
			$redirection_url = sprintf($redirect_app_url_format, $requested_page_safe);
			wp_redirect($redirection_url, 301);
			exit;
		}
	}
endif;
add_filter('template_redirect', 'redirect_if_404');