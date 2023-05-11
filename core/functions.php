<?php
    function renderTemplate($template, $params = []): bool|string
    {
        extract($params);
        ob_start();
        include $template;
        return ob_get_clean();
    }